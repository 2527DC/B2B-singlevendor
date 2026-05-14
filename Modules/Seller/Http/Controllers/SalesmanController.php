<?php

namespace Modules\Seller\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Salesman;
use App\Models\User;
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
}
