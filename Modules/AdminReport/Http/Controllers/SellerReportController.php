<?php

namespace Modules\AdminReport\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AdminReport\Services\SellerReportService;
use Yajra\DataTables\Facades\DataTables;

class SellerReportController extends Controller
{
    protected $sellerReportService;
    public function __construct(SellerReportService $sellerReportService)
    {
        $this->sellerReportService = $sellerReportService;
        $this->middleware('maintenance_mode');
    }

    public function product(Request $request)
    {
        return view('adminreport::seller.product.index');
    }

    public function order(Request $request)
    {
        $type = $request->type;
        $start_date = NULL;
        $end_date = NULL;
        if ($request->has('start_date')) {
            $start_date = date('Y-m-d', strtotime($request->start_date));
            $end_date = date('Y-m-d', strtotime($request->end_date));
        }
        return view('adminreport::seller.order.index', compact('type', 'start_date', 'end_date'));
    }

    public function order_data(Request $request)
    {
        if (isset($_GET['table'])) {
            $start_date = date('Y-m-d', strtotime($request->start_date));
            $end_date = date('Y-m-d', strtotime($request->end_date. '+1 day'));
            $table = $_GET['table'];

            if ($table == 'pending') {
                $order_query = $this->sellerReportService->order()->where('is_confirmed', 0)->whereBetween('created_at', [$start_date, $end_date]);
            } elseif ($table == 'confirmed') {
                $order_query = $this->sellerReportService->order()->where('is_confirmed', 1)->whereBetween('created_at', [$start_date, $end_date]);
            } elseif ($table == 'completed') {
                $order_query = $this->sellerReportService->order()->where('is_completed', 1)->whereBetween('created_at', [$start_date, $end_date]);
            } elseif ($table == 'inhouse') {
                $order_query = $this->sellerReportService->order()->where('order_type', 'inhouse_order')->whereBetween('created_at', [$start_date, $end_date]);
            } elseif ($table == 'all') {
                $order_query = $this->sellerReportService->order()->whereBetween('created_at', [$start_date, $end_date]);
            } else {
                $order_query = null;
            }

            if ($order_query) {
                $orders = $order_query->get();
            } else {
                $orders = collect();
            }

            $rows = collect();
            $seller_id = getParentSellerId();

            foreach ($orders as $o) {
                $packages = $o->packages->where('seller_id', $seller_id);
                foreach ($packages as $package) {
                    $existingInvoice = \Illuminate\Support\Facades\DB::table('invoices')
                        ->where('order_package_id', $package->id)
                        ->first();
                    $invoice_number = $existingInvoice ? $existingInvoice->invoice_number : '';

                    foreach ($package->products as $package_product) {
                        $product_name = '';
                        if ($package_product->type == 'gift_card') {
                            $product_name = @$package_product->giftCard->name;
                        } else {
                            $product_name = @$package_product->seller_product_sku->sku->product->product_name;
                        }

                        $customer_gst = ($o->customer_id) ? @$o->customer->gst_number : '';
                        $seller_name = (@$package->seller->SellerAccount->seller_shop_display_name) 
                            ? @$package->seller->SellerAccount->seller_shop_display_name 
                            : @$package->seller->first_name;

                        $rows->push([
                            'id' => $o->id,
                            'order_number' => $o->order_number,
                            'created_at' => $o->created_at,
                            'customer_id' => $o->customer_id,
                            
                            // "Shop name to customer name" -> Shop Name becomes Customer Name column
                            'shop_name' => ($o->customer_id) ? @$o->customer->store_name : '',
                            
                            // "customer name to Seller name" -> Customer Name becomes Seller Name column
                            'customer_name' => $seller_name,

                            'phone' => ($o->customer_id) ? @$o->address->shipping_phone : @$o->guest_info->shipping_phone,
                            'address' => ($o->customer_id) ? @$o->address->shipping_address : @$o->guest_info->shipping_address,
                            'pincode' => ($o->customer_id) ? @$o->address->shipping_postcode : @$o->guest_info->shipping_post_code,
                            
                            'product_name' => $product_name,
                            'invoice_number' => $invoice_number,
                            'customer_gst' => $customer_gst,
                            'total_qty' => $package_product->qty,
                            'total_amount' => single_price($package_product->price * $package_product->qty),
                            
                            'order_status' => $o->order_status,
                            'is_paid' => $o->is_paid,
                            'payment_status_text' => ($o->is_paid) ? 'Paid' : 'Pending',
                            'order_obj' => $o,
                        ]);
                    }
                }
            }

            return DataTables::of($rows)
                ->addIndexColumn()
                ->addColumn('date', function ($row) {
                    return date(app('general_setting')->dateFormat->format, strtotime($row['created_at']));
                })
                ->addColumn('order_status', function ($row) {
                    $order = $row['order_obj'];
                    return view('ordermanage::order_manage.components._order_status_td', compact('order'))->render();
                })
                ->addColumn('is_paid', function ($row) {
                    $order = $row['order_obj'];
                    return view('ordermanage::order_manage.components._is_paid_td', compact('order'))->render();
                })
                ->rawColumns(['order_status', 'is_paid'])
                ->make(true);
        } else {
            return [];
        }
    }


    public function top_customer()
    {
        return view('adminreport::seller.top_customer.index');
    }

    public function top_customer_data()
    {
        $data = $this->sellerReportService->topCustomer();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function ($data) {
                return $data->user->first_name . " " . $data->user->last_name;
            })
            ->addColumn('email', function ($data) {
                return $data->user->email;
            })
            ->addColumn('phone', function ($data) {
                return getNumberTranslate($data->user->phone);
            })
            ->addColumn('total', function ($data) {
                return getNumberTranslate(round($data->total, 2));
            })
            ->addColumn('joined_at', function ($data) {
                if($data->user) {
                    return dateConvert($data->created_at);
               }else{
                   return '';
               }
            })
            ->toJson();
    }

    public function top_selling_item()
    {
        return view('adminreport::seller.top_selling_item.index');
    }

    public function top_selling_item_data()
    {
        $data = $this->sellerReportService->topSellingItem();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('seller', function ($data) {
                return $data->seller->first_name . " " . $data->seller->last_name;
            })
            ->addColumn('product', function ($data) {
                return $data->product_name;
            })
            ->addColumn('total_sale', function ($data) {
                return $data->total_sale;
            })
            ->addColumn('avg_rating', function ($data) {
                return $data->avg_rating;
            })
            ->toJson();
    }

    public function review()
    {
        return view('adminreport::seller.review.index');
    }

    public function review_data()
    {
        $data = $this->sellerReportService->review();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('seller', function ($data) {
                return $data->seller->first_name . " " . $data->seller->last_name;
            })
            ->addColumn('number_of_review', function ($data) {
                return $data->number_of_review;
            })
            ->addColumn('rating', function ($data) {
                return round($data->rating, 2);
            })
            ->toJson();
    }

}
