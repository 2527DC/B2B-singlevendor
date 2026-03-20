<?php

namespace Modules\Refund\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Refund\Services\RefundService;
use Modules\Refund\Repositories\RefundReasonRepository;
use Modules\Refund\Repositories\RefundProcessRepository;
use App\Repositories\OrderRepository;
use \Modules\GeneralSetting\Repositories\GeneralSettingRepository;
use Brian2694\Toastr\Facades\Toastr;
use Modules\Refund\Http\Requests\RefundCreateRequest;
use Modules\UserActivityLog\Traits\LogActivity;
use Yajra\DataTables\Facades\DataTables;
use Modules\Refund\Entities\RefundProduct;
use Modules\Refund\Entities\RefundRequestDetail;
use Modules\Refund\Entities\RefundRequest;

class RefundController extends Controller
{
    protected $refundService;
    public function __construct(RefundService $refundService)
    {
        $this->middleware('maintenance_mode');
        $this->refundService = $refundService;
    }
    public function all_refund_request_index()
    {
        return view('refund::admin.refund_requests.index');
    }
    public function all_refund_request_data(Request $request)
    {
        $data = $this->refundService->getRequestAll();
        if ($request->table == 'confirmed') {
            $data = $data->where('is_confirmed', 1);
        } else {
            $data = $data->where('is_confirmed', 0);
        }
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('date', function ($data) {
                return dateConvert($data->created_at);
            })
            ->addColumn('email', function ($data) {
                if ($data->customer_id && $data->customer) {
                    return $data->customer->email ?? 'N/A';
                }
                return optional($data->order)->guest_info->shipping_email ?? 'N/A';
            })
            ->addColumn('order_id', function ($data) {
                return getNumberTranslate(optional($data->order)->order_number ?? 'N/A');
            })
            ->addColumn('total_amount', function ($data) {
                return single_price($data->total_return_amount);
            })
            ->addColumn('request_status', function ($data) {
                if ($data->is_confirmed == 1 && $data->is_confirmed == 1)
                    return '<h6><span class="badge_1">' . __("common.completed") . '</span></h6>';
                elseif ($data->is_confirmed == 1)
                    return '<h6><span class="badge_1">' . __("common.confirmed") . '</span></h6>';
                elseif ($data->is_confirmed == 2)
                    return '<h6><span class="badge_4">' . __("common.declined") . ' </span></h6>';
                else
                    return '<h6><span class="badge_4">' . __("common.pending") . ' </span></h6>';
            })
            ->addColumn('is_refunded', function ($data) {
                if ($data->is_refunded == 1)
                    return '<h6><span class="badge_1">' . __('common.refunded') . '</span></h6>';
                else
                    return '<h6><span class="badge_4">' . __('common.pending') . '</span></h6>';
            })
            ->addColumn('action', function ($data) {
                return view('refund::admin.refund_requests.components.refund_action_td', compact('data'));
            })
            ->rawColumns(['request_status', 'is_refunded', 'action'])
            ->toJson();
    }
    public function all_refund_request_confirmed_index()
    {
        return view('refund::admin.refund_requests.confirmed_index');
    }
    public function seller_refund_request_list()
    {
        $seller_id = getParentSellerId();
        $refund_request_details = $this->refundService->getRequestSeller();
        $drivers = \Modules\Driver\Entities\Driver::where('seller_id', $seller_id)
            ->where('is_active', 1)
            ->get();
        return view('refund::seller.refund_requests.index',compact('refund_request_details', 'drivers'));
    }
    public function seller_refund_request_data()
    {
        $data = $this->refundService->getRequestSeller();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('date', function ($data) {
                return dateConvert(optional($data->refund_request)->created_at ?? now());
            })
            ->addColumn('email', function ($data) {
                if ($data->refund_request && $data->refund_request->customer_id && $data->refund_request->customer) {
                    return $data->refund_request->customer->email ?? 'N/A';
                }
                return optional(optional($data->refund_request)->order)->guest_info->shipping_email ?? 'N/A';
            })
            ->addColumn('order_id', function ($data) {
                return getNumberTranslate(optional(optional($data->refund_request)->order)->order_number ?? 'N/A');
            })
            ->addColumn('total_amount', function ($data) {
                return single_price($data->refund_request->total_return_amount);
            })
            ->addColumn('request_status', function ($data) {
                if ($data->refund_request->is_confirmed == 1 && $data->refund_request->is_confirmed == 1)
                    return '<h6><span class="badge_1">' . __("common.completed") . '</span></h6>';
                elseif ($data->refund_request->is_confirmed == 1)
                    return '<h6><span class="badge_1">' . __("common.confirmed") . '</span></h6>';
                elseif ($data->refund_request->is_confirmed == 2)
                    return '<h6><span class="badge_4">' . __("common.declined") . ' </span></h6>';
                else
                    return '<h6><span class="badge_4">' . __("common.pending") . ' </span></h6>';
            })
            ->addColumn('is_refunded', function ($data) {
                if ($data->refund_request->is_refunded == 1)
                    return '<h6><span class="badge_1">' . __('common.refunded') . '</span></h6>';
                else
                    return '<h6><span class="badge_4">' . __('common.pending') . '</span></h6>';
            })
            ->addColumn('action', function ($data) {
                return view('refund::seller.refund_requests.refund_action_td', compact('data'));
            })
            ->rawColumns(['request_status', 'is_refunded', 'action'])
            ->toJson();
    }
    public function my_refund_index()
    {
        $data['my_refund_items'] = $this->refundService->getRequestForCustomer();
        if (auth()->user()->role->type != 'customer') {
            return view('backEnd.pages.customer_data.refund', $data);
        } else {
            return view(theme('pages.profile.refunds.refund'), $data);
        }
    }
    public function config_index()
    {
        return view('refund::admin.refund_config.index');
    }
    public function make_refund_request($id)
    {
        $orderRepo = new OrderRepository;
        $refundReasonRepo = new RefundReasonRepository;
        $data['shipping_methods'] = $this->refundService->getActiveShippingMethod();
        $data['package'] = $orderRepo->orderPackageFindByID(decrypt($id));
        $data['reasons'] = $refundReasonRepo->getAll();
        return view(theme('pages.profile.refunds.create'), $data);
    }
    public function reasons_list()
    {
        return view('refund::admin.refund_reasons.index');
    }
    public function store(RefundCreateRequest $request)
    {
        // 🔹 Log incoming refund request (safe logging)
        \Log::info('Refund Store API called', [
            'user_id'    => auth()->id(),
            'ip'         => $request->ip(),
            'url'        => $request->fullUrl(),
            'method'     => $request->method(),
            'payload'    => $request->except(['_token', 'product_images_']),
            'has_images' => $request->hasFile('product_images_'),
            'image_count'=> $request->hasFile('product_images_') 
                                ? count($request->file('product_images_')) 
                                : 0,
        ]);
    
        if ($request->product_images_) {
            foreach ($request->product_images_ as $product) {
                $extensions = ["jpeg", "png", "jpg", "gif"];
    
                if (!in_array($product->extension(), $extensions)) {
                    Toastr::error(
                        "Invalid file! Only jpeg, png, jpg, gif are allowed to upload",
                        'error'
                    );
                    return redirect()->back();
                }
            }
        }
    
        if (empty($request->product_ids)) {
            Toastr::error(__('common.select_product_first'));
            return back();
        }
    
        DB::beginTransaction();
        try {
            $this->refundService->store($request->except("_token"), auth()->user());
    
            DB::commit();
            Toastr::success(__('common.created_successfully'), __('common.success'));
            LogActivity::successLog('Refund store successful.');
    
            return redirect()->route('refund.frontend.index');
    
        } catch (\Exception $e) {
    
            // 🔴 Log error with request context
            \Log::error('Refund Store Failed', [
                'user_id' => auth()->id(),
                'error'   => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'payload' => $request->except(['_token', 'product_images_']),
            ]);
    
            DB::rollBack();
            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }
    
    public function show($id)
    {
        $data['refund_request'] = $this->refundService->findByID($id);
        $refundProcessRepo = new RefundProcessRepository();
        $data['processes'] = $refundProcessRepo->getAll();
        return view('refund::admin.refund_requests.details', $data);
    }
    public function seller_show($id)
    {
        $data['refund_detail'] = $this->refundService->findDetailByID($id);
        $refundProcessRepo = new RefundProcessRepository;
        $data['processes'] = $refundProcessRepo->getAll();
        $data['seller_commision'] = $this->refundService->getRefundCommision($id);
        return view('refund::seller.refund_requests.details', $data);
    }
    public function my_refund_show($id)
    {
        $data['refund_request'] = $this->refundService->findByID(decrypt($id));
        $refundProcessRepo = new RefundProcessRepository;
        $data['processes'] = $refundProcessRepo->getAll();
        return view(theme('pages.profile.refunds.details'), $data);
    }
    public function update_refund_request_by_admin(Request $request, $id)
    {
        try {
            $this->refundService->updateRefundRequestByAdmin($request->except("_token"), $id);
            Toastr::success(__('common.updated_successfully'), __('common.success'));
            LogActivity::successLog('Update refund request by admin successful.');
            return back();
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.operation_failed'));
            return back();
        }
    }
    public function update_refund_state_by_seller(Request $request, $id)
    {
        try {
            $this->refundService->updateRefundStateBySeller($request->except("_token"), $id);
            Toastr::success(__('common.updated_successfully'), __('common.success'));
            LogActivity::successLog('Update refund state by seller successful.');
            return back();
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.operation_failed'));
            return back();
        }
    }
    public function config_update(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        try {
            $general_settings = new GeneralSettingRepository;
            $general_settings->updateActivationStatus($request->only('id', 'status'));
            Toastr::success(__('common.updated_successfully'), __('common.success'));
            LogActivity::successLog('Config update successful.');
            return back();
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }
    public function getRefundPackage(Request $request){
        $refund_detail = $this->refundService->findDetailByID($request->id);
        $refundProcessRepo = new RefundProcessRepository;
        $processes = $refundProcessRepo->getAll();
        return view('refund::admin.refund_requests.components._modal_for_package_manage',compact('refund_detail','processes'));
    }
    public function seller_rvp_data(Request $request)
    {
        $seller_id = getParentSellerId();
        $type = $request->type; // assigned or unassigned
        $query = RefundRequest::with(['order', 'driver', 'refund_details' => function($q) use($seller_id){
                $q->where('seller_id', $seller_id);
            }])
            ->where('is_confirmed', 1)
            ->whereHas('refund_details', function($q) use($seller_id){
                $q->where('seller_id', $seller_id);
            });

        if($type == 'assigned'){
            $query->whereNotNull('driver_id');
        }elseif($type == 'unassigned'){
            $query->whereNull('driver_id');
        }

        $query = $query->latest();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('order_id', function ($data) {
                return getNumberTranslate(optional($data->order)->order_number ?? 'N/A');
            })
            ->addColumn('total_amount', function ($data) {
                return single_price($data->total_return_amount);
            })
            ->addColumn('date', function ($data) {
                return dateConvert($data->created_at);
            })
            ->addColumn('vehicle_number', function ($data) {
                return optional($data->driver)->vehicle_number ?? 'N/A';
            })
            ->addColumn('delivery_status', function ($data) {
                $status = $data->delivery_status ?? 'processing';
                $color = 'orange';
                if($status == 'picked_up') $color = 'blue';
                if($status == 'completed') $color = 'green';
                return '<span class="badge badge-'. $color .'">'. __("common." . $status) .'</span>';
            })
            ->addColumn('refund_status', function ($data) {
                return $data->is_refunded == 1 ? '<span class="badge badge-green">'.__("common.paid").'</span>' : '<span class="badge badge-orange">'.__("common.pending").'</span>';
            })
            ->addColumn('action', function ($data) {
                return '<button type="button" class="primary-btn radius_30px mr-10 fix-gr-bg expand_request" data-id="' . $data->id . '">'.__('common.details').'</button>';
            })
            ->addColumn('checkbox', function ($data) {
                return '<input type="checkbox" class="rvp_checkbox" name="rvp_ids[]" value="' . $data->id . '">';
            })
            ->rawColumns(['checkbox', 'action', 'delivery_status', 'refund_status'])
            ->toJson();
    }

    public function rvp_request_products(Request $request)
    {
        $seller_id = getParentSellerId();
        $request_id = $request->request_id;
        
        $products = RefundProduct::with(['seller_product_sku.product'])
            ->whereHas('refund_request_detail', function($q) use($seller_id, $request_id){
                $q->where('seller_id', $seller_id)->where('refund_request_id', $request_id);
            })->get();

        return view('refund::seller.refund_requests.components._rvp_products_list', compact('products'));
    }

    public function rvp_bulk_assign_driver(Request $request)
    {
        try{
            $request_ids = $request->ids; // These are RefundRequest IDs
            $driver_id = $request->driver_id;
            
            if(!empty($request_ids)){
                RefundRequest::whereIn('id', $request_ids)->update(['driver_id' => $driver_id]);
                return response()->json(['message' => __('common.operation_successful')], 200);
            }
            
            return response()->json(['message' => 'No valid refund requests found for selection.'], 404);
            
        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return response()->json(['message' => __('common.operation_failed')], 500);
        }
    }

    public function rvp_bulk_complete(Request $request)
    {
        try{
            $request_ids = $request->ids; // These are RefundRequest IDs
            
            if(!empty($request_ids)){
                RefundRequest::whereIn('id', $request_ids)->update([
                    'is_completed' => 1,
                    'delivery_status' => 'completed'
                ]);
                return response()->json(['message' => __('common.operation_successful')], 200);
            }
            
            return response()->json(['message' => 'No valid refund requests found for selection.'], 404);
            
        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return response()->json(['message' => __('common.operation_failed')], 500);
        }
    }
}
