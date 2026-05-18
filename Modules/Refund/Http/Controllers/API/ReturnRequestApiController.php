<?php

namespace Modules\Refund\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Refund\Entities\ReturnRequest;
use App\Models\Order;
use App\Models\OrderPackageDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
* @group Driver Return Request
*
* APIs for Driver to initiate Return Requests
*/
class ReturnRequestApiController extends Controller
{
    /**
     * Store a Return Request
     * 
     * @bodyParam order_id integer required The ID of the order.
     * @bodyParam package_id integer optional The ID of the package.
     * @bodyParam return_type string required Type of return (delivery_failure, customer_return).
     * @bodyParam reason string optional Reason for return.
     * @bodyParam note string optional Additional notes.
     * @bodyParam pick_up_address string optional Pickup address.
     * 
     * @response {
     *      "message": "Return request created successfully",
     *      "data": {
     *          "id": 1,
     *          "order_id": 10,
     *          "status": "picked_up",
     *          ...
     *      }
     * }
     */
    public function store(Request $request)
    {
        Log::info('Return Request API hit', $request->all());

        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'package_id' => 'nullable|exists:order_package_details,id',
            'return_type' => 'required|string|in:delivery_failure,customer_return',
            'reason' => 'nullable|string|max:255',
            'note' => 'nullable|string',
            'pick_up_address' => 'nullable|string',
        ]);

        try {
            $order = Order::findOrFail($request->order_id);
            $package = null;
            if ($request->package_id) {
                $package = OrderPackageDetail::findOrFail($request->package_id);
            }

            // If package_id is not provided but the order has packages, we might need to handle it.
            // For now, if package_id is missing, we'll try to find the first package associated with the seller if possible, 
            // or just use the order's first package.
            if (!$request->package_id) {
                $package = $order->packages->first();
            }

            // Determine seller_id
            $seller_id = $package ? $package->seller_id : null;
            
            // If still no seller_id (rare), fallback to a logical choice or error
            if (!$seller_id) {
                return response()->json([
                    'message' => 'Seller not found for this order/package'
                ], 422);
            }

            $returnRequest = ReturnRequest::create([
                'order_id' => $request->order_id,
                'package_id' => $request->package_id ?? ($package ? $package->id : null),
                'customer_id' => $order->customer_id ?? \App\Models\User::where('role_id', 4)->first()?->id ?? 1,
                'seller_id' => $seller_id,
                'driver_id' => auth('sanctum')->id(), // Authenticated driver
                'status' => 'picked_up',
                'return_type' => $request->return_type,
                'reason' => $request->reason,
                'note' => $request->note,
                'pick_up_address' => $request->pick_up_address,
            ]);

            // ✅ Automatically cancel the order and packages, and assign to this driver
            $order->update([
                'is_cancelled' => 1,
                'driver_id' => auth('sanctum')->id(),
                'order_status' => 'cancelled' // Assuming 'cancelled' status slug exists
            ]);

            foreach ($order->packages as $pkg) {
                $pkg->update(['is_cancelled' => 1]);
            }

            return response()->json([
                'message' => 'Return request created and order cancelled successfully',
                'data' => $returnRequest
            ], 201);

        } catch (\Exception $e) {
            Log::error('Error creating return request: ' . $e->getMessage());
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get Driver's Return Requests
     * 
     * @queryParam from_date date optional Filter requests from this date (Y-m-d format). Example: 2026-02-01
     * @queryParam to_date date optional Filter requests to this date (Y-m-d format). Example: 2026-02-16
     * 
     * @response {
     *      "data": [
     *          {
     *              "id": 1,
     *              "order_id": 10,
     *              "status": "pending",
     *              "created_at": "2026-02-15T10:30:00.000000Z",
     *              ...
     *          }
     *      ],
     *      "message": "success"
     * }
     */
    public function index(Request $request)
    {
        // Validate date parameters if provided
        $request->validate([
            'from_date' => 'nullable|date|date_format:Y-m-d',
            'to_date' => 'nullable|date|date_format:Y-m-d|after_or_equal:from_date',
        ]);

        $query = ReturnRequest::with(['order', 'customer', 'seller'])
            ->where('driver_id', auth('sanctum')->id());

        // Apply date filters if provided
        if ($request->has('from_date') && $request->from_date) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->has('to_date') && $request->to_date) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $returns = $query->latest()->get();

        return response()->json([
            'data' => $returns,
            'message' => 'success',
            'filters' => [
                'from_date' => $request->from_date ?? null,
                'to_date' => $request->to_date ?? null,
            ]
        ], 200);
    }

    /**
     * Update Return Request Status (Driver)
     * 
     * @bodyParam status string required The new status (picked_up, at_warehouse).
     * 
     * @response {
     *      "message": "Status updated successfully",
     *      "data": { ... }
     * }
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:picked_up,at_warehouse',
        ]);

        try {
            $returnRequest = ReturnRequest::where('driver_id', auth('sanctum')->id())->findOrFail($id);
            $returnRequest->update([
                'status' => $request->status
            ]);

            return response()->json([
                'message' => 'Status updated successfully',
                'data' => $returnRequest
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get Single Return Request Details
     * 
     * @response {
     *      "message": "success",
     *      "data": { ... }
     * }
     */
    public function show($id)
    {
        try {
            $returnRequest = ReturnRequest::with([
                'order', 
                'order.customer', 
                'order.address', // Assuming 'address' relationship exists in Order model
                'package', 
                'package.products' // Assuming 'products' relationship exists in OrderPackageDetail
            ])
            ->where('driver_id', auth('sanctum')->id())
            ->findOrFail($id);

            return response()->json([
                'data' => $returnRequest,
                'message' => 'success'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Return request not found or access denied',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Get RTO Requests for a Driver
     * 
     * @queryParam driver_id integer required The ID of the driver.
     * 
     * @response {
     *      "message": "success",
     *      "data": [
     *          {
     *              "id": 1,
     *              "order_id": 10,
     *              "driver_id": 5,
     *              ...
     *          }
     *      ]
     * }
     */
    public function getRtoRequests(Request $request)
    {
        $request->validate([
            'driver_id' => 'required|integer|exists:drivers,id',
        ]);

        try {
            $requests = \Modules\Refund\Entities\RefundRequest::with(['order', 'customer', 'refund_details'])
                ->where('driver_id', $request->driver_id)
                ->latest()
                ->get();

            return response()->json([
                'data' => $requests,
                'message' => 'success'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update Refund Request Status to picked_up
     * 
     * @response {
     *      "message": "Refund request updated to picked_up successfully",
     *      "data": { ... }
     * }
     */
    public function updateRefundStatus($id)
    {
        try {
            $refundRequest = \Modules\Refund\Entities\RefundRequest::findOrFail($id);
            $refundRequest->update([
                'delivery_status' => 'picked_up'
            ]);

            return response()->json([
                'message' => 'Refund request updated to picked_up successfully',
                'data' => $refundRequest
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
