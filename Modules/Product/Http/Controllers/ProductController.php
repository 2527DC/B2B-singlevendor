<?php
namespace Modules\Product\Http\Controllers;
use App\Traits\Notification;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Modules\GST\Services\GSTService;
use Modules\Product\Entities\Category;
use Modules\Setup\Services\TagService;
use Illuminate\Support\Facades\Artisan;
use Yajra\DataTables\Facades\DataTables;
use Modules\Product\Services\BrandService;
use Modules\Seller\Entities\SellerProduct;
use Modules\Product\Services\ProductService;
use App\Traits\Notification as NotificationTrait;
use Modules\Product\Services\UnitTypeService;
use \Modules\Product\Services\CategoryService;
use Modules\Product\Services\AttributeService;
use Modules\Shipping\Services\ShippingService;
use Modules\UserActivityLog\Traits\LogActivity;
use Modules\GST\Repositories\GstConfigureRepository;
use Modules\Product\Repositories\CategoryRepository;
use Modules\WholeSale\Services\WholesalePriceService;
use Modules\GeneralSetting\Entities\EmailTemplateType;
use Modules\OrderManage\Entities\CustomerNotification;
use Modules\GoldPrice\Repositories\GoldPriceRepository;
use Modules\Product\Http\Requests\CreateProductRequest;

use Modules\GeneralSetting\Entities\NotificationSetting;
use Modules\WholeSale\Repositories\WholesalePriceRepository;
use Illuminate\Support\Facades\Log;
class ProductController extends Controller
{
    use Notification;
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->middleware('maintenance_mode');
        $this->productService = $productService;
    }

    public function index()
    {
        return view('product::products.index');
    }

    public function bulk_product_upload_page()
    {
        return view('product::products.bulk_upload');
    }

    public function bulk_product_store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xls,xlsx|max:2048'
        ]);
        ini_set('max_execution_time', 0);
        DB::beginTransaction();
        try {
            $this->productService->csvUploadProduct($request->except("_token"));
            DB::commit();
            Toastr::success(__('common.uploaded_successfully'), __('common.success'));
            LogActivity::successLog('bulk product upload successful.');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            if ($e->getCode() == 23000) {
                Toastr::error(__('common.duplicate_entry_is_exist_in_your_file'));
            } else {
                Toastr::error(__('common.invalid_csv_file'));
            }
            LogActivity::errorLog($e->getMessage());
            return back();
        }
    }

    public function related_product(Request $request)
    {
        if($request->ajax()){
          $products = $this->productService->related_product($request->all());
            if ($products->count() >= 1 ) {
            return view('product::products.components._related_product_render',compact('products'))->render();
            } else {
                return response()->json([
                    'status'=>'nothing_found',
                ]);
            }
        }
    }




    public function upsale_product(Request $request)
    {
        if($request->ajax())
        {
          $products = $this->productService->upsale_product($request->except("_token"));
          if ($products->count() >= 1 ) {
              return view('product::products.components._upsale_product_render',compact('products'))->render();
            } else {
                return response()->json([
                    'status'=>'nothing_found',
                ]);
            }
        }
    }

    public function crosssale_product(Request $request)
    {
        if($request->ajax()){
           $products = $this->productService->crosssale_product($request->except("_token"));
           if ($products->count() >= 1 ) {
              return view('product::products.components._crosssale_product_render',compact('products'))->render();
            } else {
                return response()->json([
                    'status'=>'nothing_found',
                ]);
            }
        }
    }

    public function reportedProducts()
    {
        $products = $this->productService->getReportedProduct();
        return DataTables::of($products)
                            ->addIndexColumn()
                            ->editColumn('product_name',function($products){
                                return $products->product->product_name;
                            })
                            ->addColumn('logo', function ($products) {
                                return view('product::products.components._product_logo_td')->with(['products' => $products->product]);
                            })
                            ->editColumn('user',function($products){
                                return !empty($products->user) ? $products->user->name:'Guest';
                            })
                            ->editColumn('email',function($products){
                                return $products->email;
                            })
                            ->addColumn('reason',function($products){
                                return !empty($products->reason) ? $products->reason->name:'';
                            })
                            ->addColumn('action',function($products){
                                return view('product::products.components._report_action')->with(['reason' => $products]);
                            })
                            ->rawColumns(['logo', 'action'])
                            ->toJson();

    }

    public function getData()
    {
        $user = auth()->user();

        $status_slider = '_all_product_';
        if(isset($_GET['table'])){
            $products = $this->productService->getFilterdProduct($_GET['table']);
            $status_slider = '_'.$_GET['table'].'_';
        }else{
            if($user->role->type == 'seller'){
                $products = $this->productService->getSellerProduct();
            }else{
                $products = $this->productService->getProduct();
            }
        }


        $type = $user->role->type;
        return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('product_type', function ($products) {
                return view('product::products.components._product_type_td', compact('products'));
            })
            ->editColumn('product_name', function ($products) {
                return @$products->product_name ?? '';
            })
            ->addColumn('brand', function ($products) {
                return @$products->brand->name ?? '';
            })
            ->addColumn('logo', function ($products) {
                return view('product::products.components._product_logo_td', compact('products'));
            })
            ->addColumn('status', function ($products) use ($type,$status_slider) {
                return view('product::products.components._product_status_td', compact('products', 'type', 'status_slider'));
            })
            ->addColumn('action', function ($products) use ($type) {
                return view('product::products.components._product_action_td', compact('products', 'type'));
            })
            ->addColumn('stock', function ($products) use ($type) {
                return view('product::products.components._product_stock_td', compact('products'));
            })
            ->rawColumns(['product_type', 'logo', 'status', 'action','stock'])
            ->toJson();
    }

    public function requestGetData()
    {
        $products = $this->productService->getRequestProduct();
        return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('product_type', function ($products) {
                return view('product::products.components._product_type_td', compact('products'));
            })
            ->editColumn('product_name', function ($products) {
                return @$products->product_name ?? '';
            })
            ->addColumn('brand', function ($products) {
                return @$products->brand->name;
            })
            ->addColumn('logo', function ($products) {
                return view('product::products.components._product_logo_td', compact('products'));
            })
            ->addColumn('seller', function ($products) {
                return @$products->seller->first_name;
            })
            ->addColumn('approval', function ($products) {
                return view('product::products.components._request_product_approval_td', compact('products'));
            })
            ->addColumn('action', function ($products) {
                return view('product::products.components._request_product_action_td', compact('products'));
            })
            ->rawColumns(['product_type', 'logo', 'status', 'action'])
            ->toJson();
    }

    public function skuGetData()
    {
        $skus = $this->productService->getAllSKU();
        return DataTables::of($skus)
            ->addIndexColumn()
            ->editColumn('product', function ($skus) {
                return @$skus->product->product_name;
            })
            ->addColumn('brand', function ($skus) {
                return @$skus->product->brand->name;
            })
            ->addColumn('purchase_price', function ($skus) {

                return '<p class="text-nowrap">' . @$skus->sku . '</p>';
            })
            ->addColumn('selling_price', function ($skus) {

                return single_price(@$skus->selling_price);
            })
            ->addColumn('logo', function ($skus) {
                return view('product::products.components._sku_logo_td', compact('skus'));
            })
            ->addColumn('action', function ($skus) {
                return view('product::products.components._sku_action_td', compact('skus'));
            })
            ->rawColumns(['product_type', 'logo', 'status', 'action', 'purchase_price'])
            ->toJson();
    }

    public function create(CategoryService $categoryService, UnitTypeService $unitTypeService, BrandService $brandService, TagService $tagService, AttributeService $attributeService, ShippingService $shippingService,GSTService $gstService)
    {
        $data['units'] = $unitTypeService->getActiveAll();
        $data['attributes'] = $attributeService->getActiveAll();
        $data['products'] = $this->productService->allbyPaginate();
        $data['shippings'] = $shippingService->getActiveAll()->where('id', '!=', 1);
        $gstGroup_repo = new GstConfigureRepository();
        if (app('gst_config')['enable_gst'] == "only_tax") {
            $data['gst_lists'] = $gstService->getActiveList();
        }else{
            $data['gst_groups'] = $gstGroup_repo->getGroup();
        }
        $data['first_category'] = $categoryService->firstCategory();
        if(isModuleActive('GoldPrice')){
            $goldPriceRepo = new GoldPriceRepository();
            $data['gold_prices'] = $goldPriceRepo->getAll();
        }
        return view('product::products.create', $data);
    }

    
    public function store(CreateProductRequest $request)
    {
        DB::beginTransaction();
    
        try {
            // Create product
            $this->productService->create($request->except("_token"));
    
            if (auth()->user()->role_id != 1) {
                $notificationSetting = DB::table('notification_settings')
                    ->where('slug', 'seller-product-create')
                    ->first();
    
                if ($notificationSetting) {
                    $admin_notification = (array) json_decode($notificationSetting->admin_msg);
                    $langs = getLanguageList();
    
                    $adminNot = new CustomerNotification();
    
                    foreach ($langs as $lang) {
                        if (isset($admin_notification[$lang->code])) {
                            $adminNot->setTranslation(
                                'title',
                                $lang->code,
                                $admin_notification[$lang->code]
                            );
                        }
                    }
    
                    $adminNot->customer_id = 1;
                    $adminNot->url = "#";
                    $adminNot->save();
                }
            }
    
            DB::commit();
    
            Toastr::success(__('common.added_successfully'), __('common.success'));
    
            // ✅ Normal Laravel success log
            Log::info('Product created successfully', [
                'user_id' => auth()->id(),
                'request_from' => $request->request_from,
                'payload' => $request->except('_token'),
            ]);
    
            if ($request->request_from == 'main_product_form') {
                return redirect()->route('product.index');
            } elseif ($request->request_from == 'seller_product_form') {
                return redirect()->route('seller.product.index');
            } elseif ($request->request_from == 'inhouse_product_form') {
                return redirect()->route('admin.my-product.index');
            }
    
        } catch (\Exception $e) {
            DB::rollBack();
    
            // ❌ Normal Laravel error log
            Log::error('Product creation failed', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
    
            Toastr::error(__('common.error_message'));
            return back();
        }
    }
    
    public function show(Request $request)
    {
        $data['product'] = $this->productService->findById($request->id);
        return view('product::products.product_detail', $data);
    }

    public function edit($id, CategoryService $categoryService, UnitTypeService $unitTypeService, BrandService $brandService, TagService $tagService, AttributeService $attributeService, ShippingService $shippingService,GSTService $gstService)
    {
        try {
            $data['product'] = $this->productService->findById($id);
            $data['relatedProducts'] = $data['product']->relatedProducts()->paginate(20);
            $data['crossSales'] = $data['product']->crossSales()->paginate(20);
            $data['upSales'] = $data['product']->upSales()->paginate(20);
            $data['units'] = $unitTypeService->getActiveAll();
            $data['attributes'] = $attributeService->getActiveAll();
            $data['shippings'] = $shippingService->getActiveAll();
            if (app('gst_config')['enable_gst'] == "only_tax") {
                $data['gst_lists'] = $gstService->getActiveList();
            }else{
                $gstGroup_repo = new GstConfigureRepository();
                $data['gst_groups'] = $gstGroup_repo->getGroup();
            }
            $data['first_category'] = $categoryService->firstCategory();
            if(isModuleActive('WholeSale')){
                $wholesalePriceService = new WholesalePriceService(new WholesalePriceRepository());
                $data['wholesale_price'] = $wholesalePriceService->getAllWholesalePrice($id);
            }
            if(isModuleActive('GoldPrice')){
                $goldPriceRepo = new GoldPriceRepository();
                $data['gold_prices'] = $goldPriceRepo->getAll();
            }
            return view('product::products.edit', $data);
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return back();
        }
    }

    public function clone($id, CategoryService $categoryService, UnitTypeService $unitTypeService, BrandService $brandService, TagService $tagService, AttributeService $attributeService, ShippingService $shippingService,GSTService $gstService)
    {
        try {
            $data['product'] = $this->productService->findById($id);
            $data['relatedProducts'] = $data['product']->relatedProducts()->paginate(20);
            $data['crossSales'] = $data['product']->crossSales()->paginate(20);
            $data['upSales'] = $data['product']->upSales()->paginate(20);
            $data['units'] = $unitTypeService->getActiveAll();
            $data['attributes'] = $attributeService->getActiveAll();
            $data['shippings'] = $shippingService->getActiveAll();
            $data['products'] = $this->productService->all();
            if (app('gst_config')['enable_gst'] == "only_tax") {
                $data['gst_lists'] = $gstService->getActiveList();
            }else{
                $gstGroup_repo = new GstConfigureRepository();
                $data['gst_groups'] = $gstGroup_repo->getGroup();
            }
            $data['first_category'] = $categoryService->firstCategory();
            if(isModuleActive('GoldPrice')){
                $goldPriceRepo = new GoldPriceRepository();
                $data['gold_prices'] = $goldPriceRepo->getAll();
            }
            return view('product::products.clone', $data);
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return back();
        }
    }

    
    public function update(CreateProductRequest $request, $id)
    {
        DB::beginTransaction();
        
        Log::debug("=== PRODUCT UPDATE METHOD STARTED ===");
        Log::debug("Product ID: {$id}");
        Log::debug("Request Method: " . $request->method());
        Log::debug("User Role: " . (auth()->user()->role->type ?? 'Unknown'));
        Log::debug("User ID: " . auth()->id());
        
        try {
            // Check if user is seller
            if(auth()->user()->role->type == 'seller'){
                Log::debug("User is SELLER - Checking product approval status...");
                $product_for_req = $this->productService->findById($id);
                
                if($product_for_req->is_approved){
                    Log::warning("Seller attempted to edit already approved product ID: {$id}");
                    Log::debug("Product Name: " . ($product_for_req->name ?? 'N/A'));
                    Log::debug("Product Approval Status: " . ($product_for_req->is_approved ? 'Approved' : 'Not Approved'));
                    
                    Toastr::error('Product already Approved. You Dont have Permission To Edit.');
                    return redirect()->route('seller.product.index');
                }
                Log::debug("Product is NOT approved - seller can edit");
            }
            
            // Check if product attributes are editable
            Log::debug("Checking if product attributes are editable...");
            $attributeEditable = product_attribute_editable($id);
            Log::debug("Product attribute editable check: " . ($attributeEditable ? 'Editable' : 'Not Editable'));
            
            if($attributeEditable === false && $request->new_attribute_added == 1){
                Log::warning("Product attribute editing not possible for product ID: {$id}");
                Log::debug("new_attribute_added value: " . $request->new_attribute_added);
                Log::debug("Product already used - cannot add new attributes");
                
                Toastr::error(__('Product Already Used. Atrribute Add Not Posible.'),__('common.error'));
                return back();
            }
            
            Log::debug("Product can be updated. Processing update...");
            
            // Log request data (excluding sensitive info)
            Log::debug("=== REQUEST DATA SUMMARY ===");
            Log::debug("Request keys: " . implode(', ', array_keys($request->except('_token', 'password', 'password_confirmation'))));
            Log::debug("Has files: " . ($request->hasFile('images') ? 'Yes' : 'No'));
            Log::debug("New attribute added flag: " . ($request->new_attribute_added ?? 'Not set'));
            
            // Perform the update
            $startTime = microtime(true);
            Log::debug("Calling productService->update()...");
            
            $this->productService->update($request->except("_token"), $id);
            
            $updateTime = round((microtime(true) - $startTime) * 1000, 2);
            Log::debug("Product service update completed in: {$updateTime}ms");
            
            // Commit transaction
            DB::commit();
            Log::debug("Database transaction COMMITTED");
            
            // Log success
            Log::info("Product updated successfully - ID: {$id}");
            LogActivity::successLog("Product updated - ID: {$id} by User: " . auth()->user()->name);
            
            Toastr::success(__('common.updated_successfully'), __('common.success'));
            
            // Redirect based on user role
            $user = auth()->user();
            $redirectRoute = match($user->role->type) {
                'superadmin', 'admin', 'staff' => 'product.index',
                default => 'seller.product.index',
            };
            
            Log::debug("Redirecting user to route: {$redirectRoute}");
            Log::debug("User role for redirect: " . $user->role->type);
            
            return redirect()->route($redirectRoute);
            
        } catch (\Exception $e) {
            Log::error("=== PRODUCT UPDATE ERROR ===");
            Log::error("Error updating product ID: {$id}");
            Log::error("Error Message: " . $e->getMessage());
            Log::error("Error File: " . $e->getFile());
            Log::error("Error Line: " . $e->getLine());
            Log::error("Error Code: " . $e->getCode());
            
            // Log request data on error for debugging
            Log::error("Request Data on Error: " . json_encode($request->except(['_token', 'password', 'password_confirmation', 'card_number', 'cvv'])));
            
            // Rollback transaction
            DB::rollBack();
            Log::error("Database transaction ROLLED BACK");
            
            // Log to UserActivityLog
            try {
                $errorContext = [
                    'product_id' => $id,
                    'user_id' => auth()->id(),
                    'user_role' => auth()->user()->role->type ?? 'Unknown',
                    'error_file' => $e->getFile(),
                    'error_line' => $e->getLine()
                ];
                
                LogActivity::errorLog("Product update failed: " . $e->getMessage() . " | Context: " . json_encode($errorContext));
            } catch (\Exception $logException) {
                Log::warning("Failed to log to UserActivityLog: " . $logException->getMessage());
            }
            
            Toastr::error(__('common.error_message'));
            return back()->withInput();
        }
    }

    public function destroy(Request $request)
    {
        try {
            $result = $this->productService->deleteById($request->id);
            if ($result == "not_possible") {
                return response()->json([
                    'msg' => __('product.this_product_already_used_on_order_or_somewhere_so_delete_not_possible')
                ]);
            } else {
                LogActivity::successLog('Product deleted.');
                Toastr::success(__('common.deleted_successfully'), __('common.success'));
            }
            return $this->loadTableData();
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'));
            return back();
        }
    }

    public function metaImgDelete(Request $request)
    {
        try {
            return $this->productService->metaImgDeleteById($request->id);
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'));
            return response()->json([
                'error' => $e->getMessage()
            ], 503);
        }
    }

    public function sku_combination(Request $request)
    {
        $options = array();
        $variant_sku_prefix = $request->variant_sku_prefix;
        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'. $no;
                $data = array();
                if ($request[$name]) {
                    foreach ($request[$name] as $key => $item) {
                        array_push($data, $item);
                    }
                }
                array_push($options, $data);
            }
        }
        $attribute = $request->choice_no;
        $combinations = combinations($options);
        $selling_price_sku = !empty($request->old_sku_price)?explode(',',$request->old_sku_price):[];
        $sku_stock = !empty($request->old_sku_stock)?explode(',',$request->old_sku_stock):[];
        $old_sku = !empty($request->old_sku)?explode(',',$request->old_sku):[];
        return view('product::products.sku_combinations', compact('combinations', 'variant_sku_prefix', 'attribute','selling_price_sku','sku_stock','old_sku'));
    }

    public function sku_combination_edit(Request $request)
    {
        $product = $this->productService->findById($request->id);

        if($request->variant_sku_prefix) {
            $variant_sku_prefix = $request->variant_sku_prefix;
        }else{
            $variant_sku_prefix = $product->variant_sku_prefix;
        }

        $options = array();
        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_' . $no;
                $data = array();
                if ($request[$name]) {
                    foreach ($request[$name] as $key => $item) {
                        array_push($data, $item);
                    }
                }
                array_push($options, $data);
            }
        }

        $attribute = $request->choice_no;
        $combinations = combinations($options);
        return view('product::products.sku_combinations_edit', compact('combinations', 'variant_sku_prefix', 'product', 'attribute'));


    }

    public function update_status(Request $request)
    {
        try {
            $product = $this->productService->findById($request->id);
            $product->update([
                'status' => $request->status
            ]);
            if (!isModuleActive('MultiVendor')) {
                $product->sellerProducts->where('user_id', 1)->first()->update([
                    'status' => $request->status
                ]);
            }
            foreach ($product->skus as $sku) {
                $product_sku = $this->productService->findProductSkuById($sku->id);
                $product_sku->status = $request->status;
                $product_sku->save();
            }
            if($request->status == 0){
                // Send Notification
                $notificationUrl = route('seller.product.index');
                $notificationUrl = str_replace(url('/'),'',$notificationUrl);
                $this->notificationUrl = $notificationUrl;
                $this->adminNotificationUrl = '/products';
                $this->routeCheck = 'product.index';
                $this->typeId = EmailTemplateType::where('type', 'product_disable_email_template')->first()->id;
                if(isModuleActive('MultiVendor')){
                    $sellerProducts = SellerProduct::where('product_id', $product->id)->get();
                    foreach ($sellerProducts as $sellerProduct) {
                        $notification = NotificationSetting::where('slug','product-disable')->first();
                        if ($notification) {
                            $this->notificationSend($notification->id, $sellerProduct->user_id);
                        }
                    }
                }else{
                    $notification = NotificationSetting::where('slug','product-disable')->first();
                    if ($notification) {
                        $this->notificationSend($notification->id, 1);
                    }
                }
            }
            LogActivity::successLog('product status update successful.');
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return $e->getMessage();
        }
        return $this->loadTableData();
    }

    public function update_sku_status(Request $request)
    {
        try {
            $product_sku = $this->productService->findProductSkuById($request->id);
            $product_sku->status = $request->status;
            $product_sku->save();
            LogActivity::successLog('Update sku status successful.');
            return 1;
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return 0;
        }
    }

    public function updateSkuStatusByID(Request $request)
    {
        try {
            $product_sku = $this->productService->findProductSkuById($request->id);
            $product_sku->status = $request->status;
            $product_sku->save();
            LogActivity::successLog('Update sku status successful.');
            return $this->loadTableData();
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return response()->json([
                'error' => $e->getMessage()
            ], 503);
        }
    }

    public function deleteSkuByID(Request $request)
    {
        try {
            $product_sku = $this->productService->findProductSkuById($request->id);
            $product_sku->delete();
            LogActivity::successLog('delete sku  successful.');
            return $this->loadTableData();
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return response()->json([
                'error' => $e->getMessage()
            ], 503);
        }
    }

    public function updateSkuByID(Request $request)
    {
        $request->validate([
            'selling_price' => 'required'
        ]);
        try {
            $this->productService->updateSkuByID($request->except('_token'));
            LogActivity::successLog('Update sku  successful.');
            return $this->loadTableData();
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return response()->json([
                'error' => $e->getMessage()
            ], 503);
        }
    }

    public function approved(Request $request)
    {
        try {
            $this->productService->productApproved($request->except('_token'));
            LogActivity::successLog('product approve  successful.');
            return $this->loadTableData();
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return response()->json([
                'error' => $e->getMessage()
            ], 503);
        }
    }

    private function loadTableData()
    {
        try {
            return response()->json([
                'RequestProductList' =>  (string)view('product::products.request_product_list'),
                'ProductList' =>  (string)view('product::products.product_list'),
                'ProductSKUList' =>  (string)view('product::products.sku_list'),
                'ProductDisabledList' =>  (string)view('product::products.disabled_product_list'),
                'ProductAlertList' =>  (string)view('product::products.alert_product_list'),
            ], 200);
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.operation_failed'));
            return response()->json([
                'error' => 'something gone wrong'
            ], 503);
        }
    }

    public function recent_view_product_config()
    {
        return view('product::recently_views.config');
    }

    public function recent_view_product_config_update(Request $request)
    {
        try {
            $this->productService->updateRecentViewedConfig($request->except('_token'));
            Toastr::success(__('common.updated_successfully'), __('common.success'));
            LogActivity::successLog('Recent view product config update successful.');
            return back();
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return $e;
        }
    }

    public function recently_view_product_cronejob()
    {
        try {
            Artisan::call('command:reset_recent_viewed_product');
            return back();
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return back();
        }
    }

    public function ChangeProductGroup(Request $request){
        $gstGroupRepo = new GstConfigureRepository();
        $group = $gstGroupRepo->getGroupById($request->id);
        return view('product::products.components._group_gst_list', compact('group'));
    }

    public function getcategoryData(Request $request){
        $categoryRepo = new CategoryRepository(new Category());
        $categories = $categoryRepo->getCategoryBySearch($request->search,$request->depend);
        return response()->json($categories);
    }

    public function getParentcategoryData(Request $request){
        $categoryRepo = new CategoryRepository(new Category());
        $categories = $categoryRepo->getParentCategoryBySearch($request->search);
        return response()->json($categories);
    }

    public function getProductByAjax(Request $request){
        $products = $this->productService->getByAjax($request->search);
        return response()->json($products);
    }

    public function getSellerProductByAjax(Request $request){
        $products = $this->productService->getSellerProductByAjax($request->search);
        return response()->json($products);
    }

    /**
     * Get all SKUs for a product with current stock
     */
    public function getProductSkus(Request $request)
    {
        try {
            $product = $this->productService->findById($request->product_id);
            $skus = $product->skus->map(function($sku) use ($product) {
                $variation = '';
                if ($product->product_type == 2) {
                    $variations = $sku->product_variations->map(function($var) {
                        return $var->attribute->name . ': ' . $var->attribute_value->name;
                    });
                    $variation = $variations->implode(', ');
                }
                
                return [
                    'id' => $sku->id,
                    'sku' => $sku->sku,
                    'variation' => $variation,
                    'current_stock' => $sku->product_stock ?? 0,
                    'selling_price' => $sku->selling_price,
                ];
            });
            
            return response()->json([
                'success' => true,
                'product_name' => $product->product_name,
                'product_type' => $product->product_type,
                'skus' => $skus
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update stock for a product SKU (IN/OUT)
     */
    public function updateStock(Request $request)
    {
        $request->validate([
            'sku_id' => 'required|integer',
            'stock_type' => 'required|in:add,subtract,set',
            'quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $sku = $this->productService->findProductSkuById($request->sku_id);
            $previousStock = $sku->product_stock ?? 0;
            
            // Calculate new stock based on type
            switch ($request->stock_type) {
                case 'add':
                    $newStock = $previousStock + $request->quantity;
                    $historyType = 'in';
                    break;
                case 'subtract':
                    $newStock = max(0, $previousStock - $request->quantity);
                    $historyType = 'out';
                    break;
                case 'set':
                    $newStock = $request->quantity;
                    $historyType = 'set';
                    break;
            }
            
            // Update SKU stock
            $sku->product_stock = $newStock;
            $sku->save();
            
            // Create stock history record
            \Modules\Product\Entities\StockHistory::create([
                'product_sku_id' => $sku->id,
                'type' => $historyType,
                'quantity' => $request->quantity,
                'previous_stock' => $previousStock,
                'new_stock' => $newStock,
                'note' => $request->note ?? null,
                'user_id' => auth()->id(),
            ]);
            
            DB::commit();
            
            LogActivity::successLog('Stock updated for SKU: ' . $sku->sku);
            
            return response()->json([
                'success' => true,
                'message' => __('common.updated_successfully'),
                'new_stock' => $newStock
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            LogActivity::errorLog($e->getMessage());
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get stock history for a product SKU
     */
    public function getStockHistory(Request $request)
    {
        try {
            $sku = $this->productService->findProductSkuById($request->sku_id);
            $history = \Modules\Product\Entities\StockHistory::where('product_sku_id', $sku->id)
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->limit(50)
                ->get()
                ->map(function($record) {
                    return [
                        'date' => $record->created_at->format('Y-m-d H:i'),
                        'type' => $record->type,
                        'quantity' => $record->quantity,
                        'previous_stock' => $record->previous_stock,
                        'new_stock' => $record->new_stock,
                        'note' => $record->note,
                        'user' => $record->user->name ?? 'System',
                    ];
                });
            
            return response()->json([
                'success' => true,
                'sku' => $sku->sku,
                'current_stock' => $sku->product_stock ?? 0,
                'product_name' => $sku->product->product_name,
                'history' => $history
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

}

