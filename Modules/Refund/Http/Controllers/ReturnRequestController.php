<?php

namespace Modules\Refund\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Refund\Entities\ReturnRequest;
use Yajra\DataTables\Facades\DataTables;
use Brian2694\Toastr\Facades\Toastr;

class ReturnRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('maintenance_mode');
    }

    public function seller_return_request_list()
    {
        $seller_id = getParentSellerId();
        $data['drivers'] = \Modules\Driver\Entities\Driver::where('seller_id', $seller_id)
            ->where('is_active', 1)
            ->get();
        return view('refund::seller.return_requests.index', $data);
    }

    public function seller_return_request_data(Request $request)
    {
        $seller_id = getParentSellerId();
        $query = ReturnRequest::with(['order', 'customer', 'driver'])
            ->where('seller_id', $seller_id);

        // Apply date filters if provided (from DataTables or custom filters)
        if ($request->has('from_date') && $request->from_date) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->has('to_date') && $request->to_date) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $data = $query->orderBy('id', 'desc');

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('date', function ($data) {
                return dateConvert($data->created_at);
            })
            ->addColumn('order_id', function ($data) {
                return getNumberTranslate(optional($data->order)->order_number ?? ('#' . $data->order_id));
            })
            ->addColumn('shop_name', function ($data) {
                return optional($data->customer)->store_name ?? 'N/A';
            })
            ->addColumn('total_amount', function ($data) {
                return $data->order ? single_price($data->order->grand_total) : 'N/A';
            })
            ->addColumn('driver_name', function ($data) {
                return optional($data->driver)->name ?? 'N/A';
            })
            ->addColumn('status', function ($data) {
                $class = 'badge_4'; // pending
                if ($data->status == 'completed') $class = 'badge_1'; // green
                elseif ($data->status == 'cancelled') $class = 'badge_3'; // red
                elseif ($data->status == 'at_warehouse') $class = 'badge_violet'; // violet
                elseif ($data->status == 'picked_up') $class = 'badge_2'; // yellow
                
                $statusText = __("refund." . $data->status);
                if (str_contains($statusText, 'refund.')) {
                    $statusText = __("common." . $data->status);
                }
                if (str_contains($statusText, 'common.')) {
                    $statusText = str_replace('_', ' ', ucfirst($data->status));
                }
                
                return '<h6><span class="badge ' . $class . '">' . $statusText . '</span></h6>';
            })
            ->addColumn('action', function ($data) {
                return view('refund::seller.return_requests.return_action_td', compact('data'));
            })
            ->rawColumns(['status', 'action'])
            ->toJson();
    }

    public function bulk_update_status(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'status' => 'required|string'
        ]);

        try {
            $seller_id = getParentSellerId();
            ReturnRequest::where('seller_id', $seller_id)
                ->whereIn('id', $request->ids)
                ->update(['status' => $request->status]);

            return response()->json(['message' => __('common.updated_successfully')], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => __('common.operation_failed')], 500);
        }
    }

    public function update_status(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required|string'
        ]);

        try {
            $seller_id = getParentSellerId();
            $returnRequest = ReturnRequest::where('seller_id', $seller_id)->findOrFail($request->id);
            $returnRequest->update(['status' => $request->status]);

            return response()->json(['message' => __('common.updated_successfully')], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => __('common.operation_failed')], 500);
        }
    }

    public function complete(Request $request, $id)
    {
        try {
            $seller_id = getParentSellerId();
            $returnRequest = ReturnRequest::where('seller_id', $seller_id)->findOrFail($id);
            $returnRequest->update([
                'status' => 'completed'
            ]);

            Toastr::success(__('common.updated_successfully'), __('common.success'));
            return redirect()->route('refund.seller_return_request_list');
        } catch (\Exception $e) {
            Toastr::error(__('common.error_message'), __('common.error'));
            return redirect()->back();
        }
    }

    public function assign_driver(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'driver_id' => 'nullable'
        ]);

        try {
            $seller_id = getParentSellerId();
            $returnRequest = ReturnRequest::where('seller_id', $seller_id)->findOrFail($request->id);
            
            $driverId = $request->driver_id;
            if ($driverId) {
                $driver = \Modules\Driver\Entities\Driver::where('id', $driverId)
                    ->where('seller_id', $seller_id)
                    ->first();
                if (!$driver) {
                    return response()->json(['message' => __('order.driver_not_found_or_unauthorized')], 403);
                }
            }

            $returnRequest->update(['driver_id' => $driverId]);

            return response()->json(['message' => __('common.updated_successfully')], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => __('common.operation_failed')], 500);
        }
    }

    public function bulk_assign_driver(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'driver_id' => 'nullable'
        ]);

        try {
            $seller_id = getParentSellerId();
            $driverId = $request->driver_id;
            
            if ($driverId) {
                $driver = \Modules\Driver\Entities\Driver::where('id', $driverId)
                    ->where('seller_id', $seller_id)
                    ->first();
                if (!$driver) {
                    return response()->json(['message' => __('order.driver_not_found_or_unauthorized')], 403);
                }
            }

            ReturnRequest::where('seller_id', $seller_id)
                ->whereIn('id', $request->ids)
                ->update(['driver_id' => $driverId]);

            return response()->json(['message' => __('common.updated_successfully')], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => __('common.operation_failed')], 500);
        }
    }

    public function show($id)
    {
        $seller_id = getParentSellerId();
        $data['returnRequest'] = ReturnRequest::with(['order', 'package.products.seller_product_sku.product', 'customer', 'driver'])
            ->where('seller_id', $seller_id)
            ->findOrFail($id);
            
        $data['drivers'] = \Modules\Driver\Entities\Driver::where('seller_id', $seller_id)
            ->where('is_active', 1)
            ->get();
            
        return view('refund::seller.return_requests.show', $data);
    }
}
