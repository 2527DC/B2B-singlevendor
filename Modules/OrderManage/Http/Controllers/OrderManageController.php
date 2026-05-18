<?php

namespace Modules\OrderManage\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\OrderManage\Services\OrderManageService;
use Modules\GiftCard\Services\GiftCardService;
use Modules\GiftCard\Repositories\GiftCardRepository;
use Modules\OrderManage\Repositories\DeliveryProcessRepository;
use Brian2694\Toastr\Facades\Toastr;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Modules\OrderManage\Repositories\CancelReasonRepository;
use Modules\UserActivityLog\Traits\LogActivity;
use Illuminate\Support\Facades\Log;

class OrderManageController extends Controller
{

    protected $ordermanageService;

    public function __construct(OrderManageService $ordermanageService)
    {
        $this->middleware('maintenance_mode');
        $this->ordermanageService = $ordermanageService;
    }

    public function index()
    {
        return view('ordermanage::index');
    }

    public function my_sales_index()
    {
        $deliveryProcessRepo = new DeliveryProcessRepository();
        $data['processes'] = $deliveryProcessRepo->getAll();
        
        // Get seller's drivers
        $seller_id = getParentSellerId();
        $data['drivers'] = \Modules\Driver\Entities\Driver::where('seller_id', $seller_id)
            ->where('is_active', 1)
            ->get();
        
        return view('ordermanage::order_manage.my_orders', $data);
    }

    public function my_sales_get_data()
    {
        if (isset($_GET['table'])) {
            $table = $_GET['table'];
            if ($table == 'pending_payment') {
                $order_package = $this->ordermanageService->myPendingPaymentSalesList();
            } elseif ($table == 'pending') {
                $order_package = $this->ordermanageService->myPendingSalesList();
            } elseif ($table == 'confirmed') {
                $order_package = $this->ordermanageService->myConfirmedSalesList();
            } elseif ($table == 'completed') {
                $order_package = $this->ordermanageService->myCompletedSalesList();
            } elseif ($table == 'canceled') {
                $order_package = $this->ordermanageService->myCancelledPaymentSalesList();
            } elseif ($table == 'all') {
                $order_package = $this->ordermanageService->mySalesList(); // I need to verify what the method is
            } else {
                $order_package = [];
            }
            return DataTables::of($order_package)
                ->addIndexColumn()
                ->addColumn('date', function ($order_package) {

                    return dateConvert($order_package->order->created_at);
                })
                ->addColumn('order_number', function ($order_package) {
                    return getNumberTranslate(@$order_package->order->order_number);
                })
                ->addColumn('email', function ($order_package) {
                    return ($order_package->order->customer_id) ? @$order_package->order->customer->email : @$order_package->order->guest_info->shipping_email;
                })
                ->addColumn('shop_name', function ($order_package) {
                    if ($order_package->order->customer_id) {
                        $shop = @$order_package->order->customer->store_name ? @$order_package->order->customer->store_name : @$order_package->order->customer->first_name . ' ' . @$order_package->order->customer->last_name;
                        $salesman = optional($order_package->order->customer->salesman)->name;
                        return $shop . ($salesman ? "<br/><small class='text-muted'>Salesman: $salesman</small>" : "");
                    }
                    return @$order_package->order->guest_info->shipping_name;
                })
                ->addColumn('order_state', function ($order_package) {
                    return view('ordermanage::order_manage.components._my_order_order_state_td', compact('order_package'));
                })
                ->addColumn('total_amount', function ($order_package) {
                    return single_price($order_package->products->sum('total_price') + $order_package->shipping_cost + $order_package->tax_amount);
                })
                ->addColumn('order_status', function ($order_package) {
                    return view('ordermanage::order_manage.components._my_order_status_td', compact('order_package'));
                })
                ->addColumn('vehicle_no', function ($order_package) {
                    return @$order_package->order->driver->vehicle_number ?? '--';
                })
                ->addColumn('action', function ($order_package) {
                    return view('ordermanage::order_manage.components._my_order_action_td', compact('order_package'));
                })
                ->rawColumns(['shop_name', 'order_status', 'is_paid', 'action', 'vehicle_no'])
                ->toJson();
        }
    }


    public function total_sales_index()
    {
        $deliveryProcessRepo = new DeliveryProcessRepository();
        $data['processes'] = $deliveryProcessRepo->getAll();
        return view('ordermanage::order_manage.total_sales', $data);
    }

    public function total_sales_get_data()
    {

        if (isset($_GET['table'])) {
            $table = $_GET['table'];
            if ($table == 'pending') {
                $order = $this->ordermanageService->totalSalesList()->where('is_confirmed', 0)->where('is_cancelled', 0);
            } elseif ($table == 'confirmed') {
                $order = $this->ordermanageService->totalSalesList()->where('is_confirmed', 1)->where('is_cancelled', 0)->where('is_completed', 0);
            } elseif ($table == 'completed') {
                $order = $this->ordermanageService->totalSalesList()->where('is_completed', 1)->where('is_cancelled',0);
            } elseif ($table == 'pending_payment') {
                $order = $this->ordermanageService->totalSalesList()->where('is_paid', 0)->where('is_cancelled', 0);
            } elseif ($table == 'canceled') {
                $order = $this->ordermanageService->totalSalesList()->where('is_cancelled', 1);
            } elseif ($table == 'inhouse') {
                $order = $this->ordermanageService->totalSalesList()->where('order_type', 'inhouse_order');
            } elseif ($table == 'all') {
                $order = $this->ordermanageService->totalSalesList();
            } else {
                $order = [];
            }

            return DataTables::of($order)
                ->addIndexColumn()
                ->addColumn('date', function ($order) {
                    return dateConvert($order->created_at);
                })
                ->editColumn('order_number', function ($order) {
                    return getNumberTranslate($order->order_number);
                })
                ->addColumn('customer_name', function ($order) {
                    if ($order->customer_id) {
                        $customer = @$order->customer->store_name ? @$order->customer->store_name : @$order->customer->first_name . ' ' . @$order->customer->last_name;
                        $salesman = optional($order->customer->salesman)->name;
                        return $customer . ($salesman ? "<br/><small class='text-muted'>Salesman: $salesman</small>" : "");
                    }
                    return @$order->guest_info->shipping_name;
                })
                ->addColumn('email', function ($order) {
                    return ($order->customer_id) ? @$order->customer->email : @$order->guest_info->shipping_email;
                })
                ->addColumn('customer_phone', function ($order) {
                    return ($order->customer_id) ? @trim(@$order->customer->phone) : @trim(@$order->guest_info->shipping_phone);
                })
                ->addColumn('total_qty', function ($order) {
                    $count = 0;
                    foreach($order->packages as $key => $package){
                        foreach($package->products as $product){
                            $count  += $product->qty;
                        }
                    }
                    return getNumberTranslate($count);

                })
                ->addColumn('mrp_price', function ($order) {
                    return single_price($order->grand_total);
                })
                ->addColumn('taxable_value', function ($order) {
                    $gst = 0;
                    foreach ($order->packages as $package) {
                        if ($package->gst_taxes) {
                            $gst += $package->gst_taxes->sum('amount');
                        }
                    }
                    if ($gst == 0) {
                        $gst = $order->tax_amount ?? 0;
                    }
                    return single_price($order->grand_total - $gst);
                })
                ->addColumn('gst_amount', function ($order) {
                    $gst = 0;
                    foreach ($order->packages as $package) {
                        if ($package->gst_taxes) {
                            $gst += $package->gst_taxes->sum('amount');
                        }
                    }
                    if ($gst == 0) {
                        $gst = $order->tax_amount ?? 0;
                    }
                    return single_price($gst);
                })
                ->addColumn('total_amount', function ($order) {
                    return single_price($order->grand_total);
                })
                ->addColumn('order_status', function ($order) {
                    return view('ordermanage::order_manage.components._order_status_td', compact('order'));
                })
                ->addColumn('is_paid', function ($order) {
                    return view('ordermanage::order_manage.components._is_paid_td', compact('order'));
                })
                ->addColumn('action', function ($order) use($table) {
                    return view('ordermanage::order_manage.components._action_td', compact('order', 'table'));
                })
                ->rawColumns(['customer_name', 'order_confirm','order_status', 'is_paid', 'action', 'mrp_price', 'taxable_value', 'gst_amount', 'total_amount'])
                ->make(true);
        } else {
            return [];
        }
    }



    public function show($id)
    {

        $data['order'] = $this->ordermanageService->findOrderByID($id);
        $deliveryProcessRepo = new DeliveryProcessRepository();
        $cancelReason = new CancelReasonRepository();
        $data['cancel_reasons'] = $cancelReason->getAll();
        $data['processes'] = $deliveryProcessRepo->getAll();
        
        // Get seller's drivers
        $data['drivers'] = \Modules\Driver\Entities\Driver::where('seller_id', auth()->id())
            ->where('is_active', 1)
            ->get();
        
        return view('ordermanage::order_manage.sale_details', $data);
    }

    public function my_sale_show($id)
    {
        $data['package'] = $this->ordermanageService->findOrderPackageByID($id);
        $data['order'] = $this->ordermanageService->findOrderByID($data['package']->order_id);
        $orderDeliveryRepo = new DeliveryProcessRepository;
        $data['processes'] = $orderDeliveryRepo->getAll();
        
        // Get seller's drivers
        $seller_id = getParentSellerId();
        $data['drivers'] = \Modules\Driver\Entities\Driver::where('seller_id', $seller_id)
            ->where('is_active', 1)
            ->get();
        
        $cancelReasonRepo = new CancelReasonRepository;
        $data['cancel_reasons'] = $cancelReasonRepo->getAll();
        
        return view('ordermanage::order_manage.my_sale_details', $data);
    }


    public function my_sale_show_for_refund($id)
    {
        $data['order'] = $this->ordermanageService->findOrderByID($id);
        $orderDeliveryRepo = new DeliveryProcessRepository;
        $data['processes'] = $orderDeliveryRepo->getAll();
        return view('ordermanage::order_manage.my_sale_details', $data);
    }


    public function sales_info_update(Request $request, $id)
    {
        Log::info('sales_info_update called', [
            'order_id' => $id,
            'request_data' => $request->except(['_token']),
        ]);
    
        $data = $request->all();
        unset($data['cancel_reason_id'], $data['_token']);
    
        if (!empty($request->cancel_reason_id)) {
            $data['cancel_reason_id'] = $request->cancel_reason_id;
        }
    
        try {
    
            Log::info('Calling orderInfoUpdate service', [
                'order_id' => $id,
                'payload' => $data,
            ]);
    
            $data['order'] = $this->ordermanageService->orderInfoUpdate($data, $id);
            
            if ($data['order'] === false) {
                Log::warning('Order update failed in service', [
                    'order_id' => $id,
                ]);

                Toastr::warning(__('order.please_create_account_for_deposite_main_income_seller_income_product_wise_tax_and_gst_tax'));
                return back();
            }

            // If delivery_status is provided and we are a seller, update our package too
            if (auth()->user()->role->type == 'seller' && isset($data['delivery_status'])) {
                $order = $this->ordermanageService->findOrderByID($id);
                $package = $order->packages->where('seller_id', getParentSellerId())->first();
                if ($package) {
                    $this->ordermanageService->updateDeliveryStatus($request->only(['delivery_status', 'note']), $package->id);
                }
            }
    
            Log::info('Sales info updated successfully', [
                'order_id' => $id,
            ]);
    
            Toastr::success(__('common.updated_successfully'), __('common.success'));
            return back();
    
        } catch (\Exception $e) {
    
            Log::error('Sales info update exception', [
                'order_id' => $id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
    
            Toastr::error(__('common.operation_failed'));
            return back();
        }
    }
    

    public function update_delivery(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $data['order'] = $this->ordermanageService->updateDeliveryStatus($request->except("_token"), $id);
            
            if ($data['order'] === false) {
                DB::rollBack();
                Toastr::warning(__('order.please_create_account_for_deposite_main_income_seller_income_product_wise_tax_and_gst_tax'));
                return back();
            }

            DB::commit();
            Toastr::success(__('common.status_updated_successfully'), __('common.success'));
            LogActivity::successLog('delivery update successful.');
            return back();
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'));
            DB::rollBack();
            return back();
        }
    }

    public function bulk_update_delivery(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_ids' => 'required_without:package_ids|array',
            'package_ids' => 'required_without:order_ids|array',
            'delivery_status' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => __('validation.failed'), 'errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $orderIds = $request->input('order_ids');
            $deliveryStatus = $request->input('delivery_status');
            $note = $request->input('note', null);

            Log::info('bulk_update_delivery called', [
                'user_id' => auth()->id(),
                'order_ids' => $orderIds,
                'delivery_status' => $deliveryStatus
            ]);

            $processedPackages = 0;
            $skippedOrders = [];

            // If package_ids supplied, process them directly (package-level selection)
            $packageIds = $request->input('package_ids', []);
            if (!empty($packageIds) && is_array($packageIds)) {
                foreach ($packageIds as $pkgId) {
                    try {
                        $package = $this->ordermanageService->findOrderPackageByID($pkgId);
                    } catch (\Exception $e) {
                        Log::warning('bulk_update_delivery package not found', ['package_id' => $pkgId]);
                        $skippedOrders[] = ['package_id' => $pkgId, 'reason' => 'package_not_found'];
                        continue;
                    }

                    // Only process if parent order is confirmed
                    if (!isset($package->order) || $package->order->is_confirmed != 1) {
                        Log::info('bulk_update_delivery skipped package because order not confirmed', ['package_id' => $pkgId, 'order_id' => $package->order_id ?? null]);
                        $skippedOrders[] = ['package_id' => $pkgId, 'reason' => 'order_not_confirmed'];
                        continue;
                    }

                    $payload = [
                        'delivery_status' => $deliveryStatus,
                        'note' => $note
                    ];
                    try {
                        $result = $this->ordermanageService->updateDeliveryStatus($payload, $pkgId);
                        Log::info('bulk_update_delivery package processed', ['package_id' => $pkgId, 'result' => $result]);
                        $processedPackages++;
                    } catch (\Exception $e) {
                        Log::error('bulk_update_delivery package error', ['package_id' => $pkgId, 'error' => $e->getMessage()]);
                        $skippedOrders[] = ['package_id' => $pkgId, 'reason' => 'error'];
                    }
                }
            } else {
                foreach ($orderIds as $orderId) {
                    $order = $this->ordermanageService->findOrderByID($orderId);
                    if (!$order) {
                        $skippedOrders[] = ['order_id' => $orderId, 'reason' => 'order_not_found'];
                        continue;
                    }

                    // Only process confirmed orders
                    if ($order->is_confirmed != 1) {
                        $skippedOrders[] = ['order_id' => $orderId, 'reason' => 'order_not_confirmed'];
                        continue;
                    }

                    if (!isset($order->packages) || count($order->packages) == 0) {
                        $skippedOrders[] = ['order_id' => $orderId, 'reason' => 'no_packages'];
                        continue;
                    }

                    foreach ($order->packages as $package) {
                        $payload = [
                            'delivery_status' => $deliveryStatus,
                            'note' => $note
                        ];
                        try {
                            $result = $this->ordermanageService->updateDeliveryStatus($payload, $package->id);
                            Log::info('bulk_update_delivery package processed', ['order_id' => $orderId, 'package_id' => $package->id, 'result' => $result]);
                            $processedPackages++;
                        } catch (\Exception $e) {
                            Log::error('bulk_update_delivery package error', ['order_id' => $orderId, 'package_id' => $package->id, 'error' => $e->getMessage()]);
                        }
                    }
                }
            }

            DB::commit();
            Log::info('bulk_update_delivery summary', ['processed_packages' => $processedPackages, 'skipped_orders' => $skippedOrders]);
            LogActivity::successLog('Bulk delivery update completed.');
            return response()->json(['message' => __('common.updated_successfully'), 'processed_packages' => $processedPackages, 'skipped_orders' => $skippedOrders], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            LogActivity::errorLog($e->getMessage());
            return response()->json(['message' => __('common.operation_failed')], 500);
        }
    }

    public function change_delivery_status_by_customer(Request $request)
    {
        try {
            $this->ordermanageService->updateDeliveryStatusRecieve($request->package_id);
            LogActivity::successLog('delivery status change by customer successful.');
            return 1;
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return 0;
        }
    }

    public function globalPrint($id)
    {
        $data['order'] = $this->ordermanageService->findOrderByID($id);
        return view('ordermanage::order_manage.sale_print', $data);

    }

    public function personalPrint($id)
    {
        $data['order'] = $this->ordermanageService->findOrderByID($id);
        return view('ordermanage::order_manage.my_sale_print', $data);

    }

    public function send_gift_card_code(Request $request)
    {

        try {
            $giftCardService = new GiftCardService(new GiftCardRepository());
            $giftcard_use_status = $giftCardService->giftCardUseStatus($request->except('_token'));
            $response = null;
            if($giftcard_use_status){
                $response = $giftCardService->send_code_to_mail($request->except('_token'));
            }else{
                return response()->json([
                    'msg' => 'Gift Card Already Used'
                ], 422);
            }
            LogActivity::successLog('Send gift card code successful.');
            return $response;
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return false;
        }
    }

    public function send_digital_file_access(Request $request)
    {
        try {
            DB::beginTransaction();
            $response = $this->ordermanageService->sendDigitalFileAccess($request->except("_token"));
            if ($response == false) {
                DB::rollBack();
            } else {
                DB::commit();
            }
            LogActivity::successLog('Send digital file access successful.');
            return $response;
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            DB::rollBack();
            return false;
        }
    }

    public function download($slug)
    {
        try {
            $response = $this->ordermanageService->DigitalFileDownload($slug);
            return response()->download($response);
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return back();
        }
    }

    public function orderConfirm($id){
        try {
            DB::beginTransaction();
            $result = $this->ordermanageService->orderConfirm($id);
            DB::commit();
            if($result == 'done'){
                Toastr::success(__('common.status_updated_successfully'), __('common.success'));
            }else{
                Toastr::error(__('common.error_message'), __('common.error'));
            }
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error(__('common.operation_failed'));
            LogActivity::errorLog($e->getMessage());
            return back();
        }
    }

    public function bulk_confirm_pending(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_ids' => 'required|array'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => __('validation.failed'), 'errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $orderIds = $request->input('order_ids');
            $processedOrders = 0;

            foreach ($orderIds as $orderId) {
                // orderConfirm handles order level confirmation
                $result = $this->ordermanageService->orderConfirm($orderId);
                if ($result == 'done') {
                    $processedOrders++;
                }
            }

            DB::commit();
            LogActivity::successLog('Bulk confirm pending orders completed.');
            return response()->json(['message' => __('common.updated_successfully'), 'processed_orders' => $processedOrders], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('bulk_confirm_pending exception', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            LogActivity::errorLog($e->getMessage());
            return response()->json(['message' => __('common.operation_failed')], 500);
        }
    }

    public function rto_confirmed(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => __('validation.failed'), 'errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $package_id = $request->input('package_id');
            $package = \App\Models\OrderPackageDetail::with('order')->findOrFail($package_id);
            $order = $package->order;

            if (!$order) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            // 1. Mark order as cancelled
            $order->update([
                'is_cancelled' => 1,
                'is_confirmed' => 2, // 2 is cancelled status for is_confirmed
                'order_status' => 0, // cancelled
            ]);

            // 2. Mark all packages of this order as cancelled
            foreach ($order->packages as $pkg) {
                $pkg->update([
                    'is_cancelled' => 1,
                    'delivery_status' => 0 // 0 is cancelled / inactive
                ]);
            }

            // 3. Process Wallet Refund if paid via wallet
            if (@$order->order_payment->payment_method == 2 && $order->customer_id) {
                $wallet_service = new \Modules\Wallet\Repositories\WalletRepository;
                $wallet_service->cartPaymentData($order->id, $order->grand_total, "Refund Back", $order->customer_id, 'registered');
            }

            // 4. Create an entry in return_requests
            $returnRequest = \Modules\Refund\Entities\ReturnRequest::create([
                'order_id' => $order->id,
                'package_id' => $package->id,
                'customer_id' => $order->customer_id ?? \App\Models\User::where('role_id', 4)->first()?->id ?? 1,
                'seller_id' => $package->seller_id,
                'driver_id' => $order->driver_id,
                'status' => 'completed',
                'return_type' => 'delivery_failure',
                'reason' => 'RTO (Return To Origin) - Customer Refused or Delivery Failed',
                'note' => 'Automatically created via RTO option in Confirmed Orders list.',
                'pick_up_address' => optional($order->shipping_address)->shipping_address ?? 'Same as shipping address',
            ]);

            DB::commit();
            LogActivity::successLog('Order RTO processed successfully.');
            return response()->json([
                'message' => 'Order RTO processed successfully. Order marked as cancelled and Return Request created as completed.',
                'return_request_id' => $returnRequest->id
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('rto_confirmed exception', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            LogActivity::errorLog($e->getMessage());
            return response()->json(['message' => __('common.operation_failed')], 500);
        }
    }


    public function track_order_configuration()
    {
        try {
            $trackOrderConfiguration = $this->ordermanageService->getTrackOrderConfiguration();
            return view('ordermanage::track_order_configuration', compact('trackOrderConfiguration'));
        } catch (\Exception $e) {
            Toastr::error(__('common.operation_failed'));
            LogActivity::errorLog($e->getMessage());
            return back();
        }
    }

    public function track_order_configuration_update(Request $request)
    {
        try {
            $this->ordermanageService->trackOrderConfigurationUpdate($request);
            Toastr::success(__('common.updated_successfully'), __('common.success'));
            LogActivity::successLog('track order configuration updated.');
            return back();
        } catch (\Exception $e) {
            Toastr::error(__('common.operation_failed'));
            LogActivity::errorLog($e->getMessage());
            return back();
        }

    }

    public function getPackageInfo(Request $request){
        $package = $this->ordermanageService->getPackageInfo($request->id);
        return view('ordermanage::order_manage.components._modal_for_package_manage',compact('package'));
    }

    /**
     * Get delivery status history for an order or package
     */
    public function getDeliveryStatusHistory(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'order_id' => 'nullable|integer',
                'package_id' => 'nullable|integer'
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => __('validation.failed'), 'errors' => $validator->errors()], 422);
            }

            $query = \Modules\OrderManage\Entities\OrderDeliveryStatusHistory::query();

            if ($request->has('order_id') && $request->order_id) {
                $query->where('order_id', $request->order_id);
            }

            if ($request->has('package_id') && $request->package_id) {
                $query->where('package_id', $request->package_id);
            }

            $history = $query->with(['changedBy', 'previousDeliveryProcess', 'newDeliveryProcess'])
                ->orderByDesc('created_at')
                ->get();

            return response()->json([
                'message' => 'Success',
                'data' => $history,
                'count' => $history->count()
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching delivery status history', ['error' => $e->getMessage()]);
            return response()->json(['message' => __('common.operation_failed')], 500);
        }
    }

    /**
     * Bulk assign driver to multiple orders
     */
    public function bulk_assign_driver(Request $request)
    {
        Log::info('bulk_assign_driver STARTED',  ['request_data' => $request->all()]);
        
        $validator = Validator::make($request->all(), [
            'order_ids' => 'required|array',
            'driver_id' => 'nullable'
        ]);

        if ($validator->fails()) {
            Log::warning('bulk_assign_driver validation failed', ['errors' => $validator->errors()]);
            return response()->json(['message' => __('validation.failed'), 'errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $orderIds = $request->input('order_ids');
            $driverId = $request->input('driver_id');
            if ($driverId === '') {
                $driverId = null;
            }

            Log::info('bulk_assign_driver processing', ['order_ids' => $orderIds, 'driver_id' => $driverId, 'seller_id' => auth()->id()]);

            // Verify driver belongs to seller if driver_id is provided
            if ($driverId) {
                $seller_id = getParentSellerId();
                $driver = \Modules\Driver\Entities\Driver::where('id', $driverId)
                    ->where('seller_id', $seller_id)
                    ->first();
                
                if (!$driver) {
                    Log::warning('bulk_assign_driver driver not found or unauthorized', ['driver_id' => $driverId, 'seller_id' => $seller_id]);
                    return response()->json(['message' => __('order.driver_not_found_or_unauthorized')], 403);
                }
                Log::info('Driver verified', ['driver_id' => $driverId, 'driver_name' => $driver->name]);
            }

            $processedOrders = 0;
            foreach ($orderIds as $orderId) {
                Log::info('Processing order', ['order_id' => $orderId]);
                
                $order = $this->ordermanageService->findOrderByID($orderId);
                
                if (!$order) {
                    Log::warning('Order not found', ['order_id' => $orderId]);
                    continue;
                }

                // Verify order belongs to seller (check packages)
                $belongsToSeller = false;
                foreach ($order->packages as $package) {
                    if ($package->seller_id == auth()->id()) {
                        $belongsToSeller = true;
                        break;
                    }
                }

                if (!$belongsToSeller) {
                    Log::warning('Order does not belong to seller', ['order_id' => $orderId, 'seller_id' => auth()->id()]);
                    continue;
                }

                // Update driver_id and assigned_date
                Log::info('Setting driver_id', ['order_id' => $orderId, 'old_driver_id' => $order->driver_id, 'new_driver_id' => $driverId]);
                $order->driver_id = $driverId;
                $order->assigned_date = $driverId ? now() : null;
                $saved = $order->save();
                Log::info('Save result', ['order_id' => $orderId, 'saved' => $saved, 'driver_id_after_save' => $order->driver_id, 'assigned_date' => $order->assigned_date]);

                // Automatically change status to 'shipped' (ID 3) when driver is assigned
                if ($driverId && $saved) {
                    foreach ($order->packages as $package) {
                        // Only update packages belonging to this seller
                        if ($package->seller_id == auth()->id()) {
                            if ($package->delivery_status != 3) {
                                try {
                                    $this->ordermanageService->updateDeliveryStatus([
                                        'delivery_status' => 3,
                                        'note' => 'System: Automatically marked as Shipped on driver assignment.'
                                    ], $package->id);
                                    Log::info('Auto-shipped package', ['package_id' => $package->id, 'order_id' => $orderId]);
                                } catch (\Exception $e) {
                                    Log::error('Auto-shipped failed', ['package_id' => $package->id, 'error' => $e->getMessage()]);
                                }
                            }
                        }
                    }
                }

                $processedOrders++;
            }

            DB::commit();
            Log::info('bulk_assign_driver completed successfully', ['processed_orders' => $processedOrders]);
            LogActivity::successLog('Bulk driver assignment completed.');
            return response()->json(['message' => __('common.updated_successfully'), 'processed_orders' => $processedOrders], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('bulk_assign_driver exception', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            LogActivity::errorLog($e->getMessage());
            return response()->json(['message' => __('common.operation_failed')], 500);
        }
    }

    /**
     * Assign driver to a single order
     */
    public function assign_driver(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'driver_id' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => __('validation.failed'), 'errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $order = $this->ordermanageService->findOrderByID($id);
            
            if (!$order) {
                return response()->json(['message' => __('order.order_not_found')], 404);
            }

            // Verify order belongs to seller
            $belongsToSeller = false;
            foreach ($order->packages as $package) {
                if ($package->seller_id == auth()->id()) {
                    $belongsToSeller = true;
                    break;
                }
            }

            if (!$belongsToSeller) {
                return response()->json(['message' => __('order.unauthorized')], 403);
            }

            $driverId = $request->input('driver_id');
            if ($driverId === '') {
                $driverId = null;
            }

            // Verify driver belongs to seller if driver_id is provided
            if ($driverId) {
                $seller_id = getParentSellerId();
                $driver = \Modules\Driver\Entities\Driver::where('id', $driverId)
                    ->where('seller_id', $seller_id)
                    ->first();
                
                if (!$driver) {
                    return response()->json(['message' => __('order.driver_not_found_or_unauthorized')], 403);
                }
            }

            // Update driver_id and assigned_date
            $order->driver_id = $driverId;
            $order->assigned_date = $driverId ? now() : null;
            $order->save();

            DB::commit();
            LogActivity::successLog('Driver assigned to order.');
            return response()->json(['message' => __('common.updated_successfully')], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            LogActivity::errorLog($e->getMessage());
            return response()->json(['message' => __('common.operation_failed')], 500);
        }
    }
}
