<?php

namespace Modules\Seller\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Salesman;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomerSalesmanExport;
use App\Imports\CustomerSalesmanImport;

class SalesmanController extends Controller
{
    /**
     * Display a listing of salesmen for the current seller.
     */
    public function index()
    {
        $salesmen = Salesman::where('seller_id', Auth::id())->latest()->get();

        $salesmanIds = $salesmen->pluck('salesman_id');
        $customersBySalesman = User::whereIn('salesman_id', $salesmanIds)
            ->get()
            ->groupBy('salesman_id');

        foreach ($salesmen as $salesman) {
            $customers = $customersBySalesman->get($salesman->salesman_id) ?? collect();
            $customerIds = $customers->pluck('id');

            $salesman->total_customers = $customers->count();

            $ordersQuery = Order::whereIn('customer_id', $customerIds);
            $salesman->total_orders = $ordersQuery->count();
            $salesman->total_amount = $ordersQuery->sum('grand_total');
        }

        return view('backEnd.salesman.index', compact('salesmen'));
    }

    /**
     * Store a newly created salesman.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        Salesman::create([
            'seller_id' => Auth::id(),
            'name' => $request->name,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('seller.salesmen.index')->with('success', 'Salesman created successfully.');
    }

    /**
     * Update an existing salesman.
     */
    public function update(Request $request, $id)
    {
        $salesman = Salesman::where('seller_id', Auth::id())->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        $salesman->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('seller.salesmen.index')->with('success', 'Salesman updated successfully.');
    }

    /**
     * Delete a salesman.
     */
    public function destroy($id)
    {
        $salesman = Salesman::where('seller_id', Auth::id())->findOrFail($id);

        // Unmap customers that were assigned to this salesman
        User::where('salesman_id', $salesman->salesman_id)->update(['salesman_id' => null]);

        $salesman->delete();

        return redirect()->route('seller.salesmen.index')->with('success', 'Salesman deleted successfully.');
    }

    /**
     * Download Excel template with all customers and empty salesman_id column.
     */
    public function downloadExcel()
    {
        $sellerId = Auth::id();
        return Excel::download(new CustomerSalesmanExport($sellerId), 'customer_salesman_mapping.xlsx');
    }

    /**
     * Upload Excel file with salesman_id mappings.
     */
    public function uploadExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240',
        ]);

        try {
            $sellerId = Auth::id();
            $import = new CustomerSalesmanImport($sellerId);
            Excel::import($import, $request->file('file'));

            $stats = $import->getStats();

            Log::info('Salesman Excel Upload completed', [
                'seller_id' => $sellerId,
                'rows_processed' => $stats['processed'],
                'rows_updated' => $stats['updated'],
                'rows_skipped' => $stats['skipped'],
            ]);

            return redirect()->route('seller.salesmen.index')
                ->with('success', "Excel imported successfully. {$stats['updated']} customers updated, {$stats['skipped']} rows skipped.");

        } catch (\Exception $e) {
            Log::error('Salesman Excel Upload failed', [
                'seller_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return redirect()->route('seller.salesmen.index')
                ->with('error', 'Failed to import Excel: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified salesman details.
     */
    public function show($id)
    {
        $salesman = Salesman::where('seller_id', Auth::id())->findOrFail($id);

        // Fetch mapped customers
        $customers = User::where('salesman_id', $salesman->salesman_id)->get();

        // Fetch all orders for these customers
        $customerIds = $customers->pluck('id');
        $orders = Order::whereIn('customer_id', $customerIds)->latest()->get();

        // Group orders by customer for easy stats
        $ordersByCustomer = $orders->groupBy('customer_id');

        foreach ($customers as $customer) {
            $customerOrders = $ordersByCustomer->get($customer->id) ?? collect();
            $customer->total_orders_count = $customerOrders->count();
            $customer->total_orders_value = $customerOrders->sum('grand_total');
        }

        // Categorize orders by status
        $rtoOrderIds = \Modules\Refund\Entities\ReturnRequest::whereIn('order_id', $orders->pluck('id'))
            ->where('return_type', 'delivery_failure')
            ->pluck('order_id')
            ->toArray();

        $completedOrders = collect();
        $cancelledOrders = collect();
        $rtoOrders = collect();
        $pendingOrders = collect();

        foreach ($orders as $order) {
            $isRto = in_array($order->id, $rtoOrderIds);

            if ($order->is_cancelled == 1) {
                if ($isRto) {
                    $rtoOrders->push($order);
                } else {
                    $cancelledOrders->push($order);
                }
            } elseif ($order->is_confirmed == 1 && $order->is_completed == 1) {
                $completedOrders->push($order);
            } else {
                $pendingOrders->push($order);
            }
        }

        // Prepare data for the view
        $totalCustomersCount = $customers->count();
        $totalOrdersCount = $orders->count();
        $totalOrderAmount = $orders->sum('grand_total');

        return view('backEnd.salesman.show', compact(
            'salesman',
            'customers',
            'completedOrders',
            'cancelledOrders',
            'rtoOrders',
            'pendingOrders',
            'totalCustomersCount',
            'totalOrdersCount',
            'totalOrderAmount'
        ));
    }
}
