@extends('backEnd.master')
@section('styles')
<link rel="stylesheet" href="{{asset(asset_path('modules/ordermanage/css/my_sale_details.css'))}}" />
<style>
    .badge_1 { background: #34D399; color: #fff; padding: 2px 10px; border-radius: 10px; } /* Green - Completed */
    .badge_2 { background: #FBBF24; color: #000; padding: 2px 10px; border-radius: 10px; } /* Yellow - Picked Up/At Warehouse */
    .badge_3 { background: #EF4444; color: #fff; padding: 2px 10px; border-radius: 10px; } /* Red - Cancelled */
    .badge_4 { background: #3B82F6; color: #fff; padding: 2px 10px; border-radius: 10px; } /* Blue - Pending */
    .product_img_div img { width: 50px; height: 50px; object-fit: cover; }
</style>
@endsection
@section('mainContent')
    @php
        $order = $returnRequest->order;
        $package = $returnRequest->package;
        $order_packages = $package;
    @endphp
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex col-12 justify-content-between align-items-center">
                            <h3 class="mb-0">Return Request: #{{ $returnRequest->id }}</h3>
                            <div>
                                <span class="badge_1" style="font-size: 14px; padding: 5px 15px;">{{ ucfirst(str_replace('_', ' ', $returnRequest->status)) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-8">
                    <!-- Return Request Information Box -->
                    <div class="white_box_50px box_shadow_white mb-20">
                        <div class="row pb-30 border-bottom">
                            <div class="col-md-12">
                                <h4>Return Info</h4>
                            </div>
                        </div>
                        <div class="row mt-30">
                            <div class="col-md-12">
                                <table class="table-borderless clone_line_table">
                                    <tr>
                                        <td><strong>Return Type</strong></td>
                                        <td>: {{ str_replace('_', ' ', ucfirst($returnRequest->return_type)) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Reason</strong></td>
                                        <td>: {{ $returnRequest->reason ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('common.date') }}</strong></td>
                                        <td>: {{ dateConvert($returnRequest->created_at) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        @if($returnRequest->note)
                            <div class="row mt-20 border-top pt-20">
                                <div class="col-12">
                                    <strong>{{ __('common.note') }}:</strong>
                                    <p>{{ $returnRequest->note }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    @if($order && $package)
                        <!-- Order Details White Box -->
                        <div class="white_box_50px box_shadow_white">
                            <div class="row pb-30 border-bottom">
                                <div class="col-md-6 col-lg-6">
                                    <div class="logo_div">
                                        <img src="{{showImage(app('general_setting')->logo)}}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 text-right">
                                    <h4>{{getNumberTranslate($order->order_number)}}</h4>
                                </div>
                            </div>
                            <div class="row mt-30">
                                <div class="col-md-6 col-lg-6">
                                    <table class="table-borderless clone_line_table">
                                        <tr>
                                            <td><strong>{{__('defaultTheme.billing_info')}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.name')}}</td>
                                            <td>: {{($order->customer_id) ? @$order->address->billing_name : @$order->guest_info->billing_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.email')}}</td>
                                            <td><a class="link_color" href="mailto:{{($order->customer_id) ? @$order->address->billing_email : @$order->guest_info->billing_email}}">: {{($order->customer_id) ? @$order->address->billing_email : @$order->guest_info->billing_email}}</a></td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.phone')}}</td>
                                            <td>: {{getNumberTranslate(($order->customer_id) ? @$order->address->billing_phone : @$order->guest_info->billing_phone)}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.address')}}</td>
                                            <td>: {{($order->customer_id) ? @$order->address->billing_address : @$order->guest_info->billing_address}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.city')}}</td>
                                            <td>: {{($order->customer_id) ? @$order->address->getBillingCity->name : @$order->guest_info->getBillingCity->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.state')}}</td>
                                            <td>: {{($order->customer_id) ? @$order->address->getBillingState->name : @$order->guest_info->getBillingState->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.country')}}</td>
                                            <td>: {{($order->customer_id) ? @$order->address->getBillingCity->name : @$order->guest_info->getBillingCountry->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.postcode')}}</td>
                                            <td>: {{getNumberTranslate(($order->customer_id) ? @$order->address->billing_postcode : @$order->guest_info->billing_post_code)}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <table class="table-borderless clone_line_table">
                                        <tr>
                                            <td><strong>{{__('defaultTheme.seller_info')}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.name')}}</td>
                                            <td>:  {{app('general_setting')->company_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.phone')}}</td>
                                            <td>:  <a class="link_color" href="tel:{{getNumberTranslate(app('general_setting')->phone)}}">{{getNumberTranslate(app('general_setting')->phone)}}</a></td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.email')}}</td>
                                            <td>:  <a class="link_color" href="mailto:{{app('general_setting')->email}}">{{app('general_setting')->email}}</a></td>
                                        </tr>
                                        <tr>
                                            <td>{{__('order.website')}}</td>
                                            <td>
                                                @if (getParentSeller()->slug)
                                                    <a href="#" class="text-break-all">:  {{route('frontend.seller',getParentSeller()->slug)}}</a>
                                                @elseif(!is_null(app('general_setting')->website_url))
                                                    <a href="#">:  {{ app('general_setting')->website_url }}</a>
                                                @else
                                                    <a href="#">:  {{route('frontend.seller',base64_encode(getParentSellerId()))}}</a>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-30">
                                <div class="col-md-6 col-lg-6">
                                    <table class="table-borderless clone_line_table">
                                        <tr>
                                            <td><strong>{{__('defaultTheme.shipping_info')}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.name')}}</td>
                                            <td>: {{($order->customer_id) ? @$order->address->shipping_name : @$order->guest_info->shipping_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.email')}}</td>
                                            <td><a class="link_color" href="mailto:{{($order->customer_id) ? @$order->address->shipping_email : @$order->guest_info->shipping_email}}">: {{($order->customer_id) ? @$order->address->shipping_email : @$order->guest_info->shipping_email}}</a></td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.phone')}}</td>
                                            <td>: {{getNumberTranslate(($order->customer_id) ? @$order->address->shipping_phone : @$order->guest_info->shipping_phone)}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.address')}}</td>
                                            <td>: {{($order->customer_id) ? @$order->address->shipping_address : @$order->guest_info->shipping_address}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.city')}}</td>
                                            <td>: {{($order->customer_id) ? @$order->address->getShippingCity->name : @$order->guest_info->getShippingCity->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.state')}}</td>
                                            <td>: {{($order->customer_id) ? @$order->address->getShippingState->name : @$order->guest_info->getShippingState->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.country')}}</td>
                                            <td>: {{($order->customer_id) ? @$order->address->getShippingCountry->name : @$order->guest_info->getShippingCountry->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.postcode')}}</td>
                                            <td>: {{getNumberTranslate(($order->customer_id) ? @$order->address->shipping_postcode : @$order->guest_info->shipping_post_code)}}</td>
                                        </tr>
                                    </table>
                                </div>
                                @php
                                    $seller_id = getParentSellerId();
                                    $total_gst = 0;
                                @endphp
                                @if (file_exists(base_path().'/Modules/GST/') && (app('gst_config')['enable_gst'] == "gst" || app('gst_config')['enable_gst'] == "flat_tax"))
                                    @foreach ($order_packages->gst_taxes as $key => $gst_tax)
                                        @php
                                            $total_gst += $gst_tax->amount;
                                        @endphp
                                    @endforeach
                                @endif
                                <div class="col-md-6 col-lg-6">
                                    <table class="table-borderless clone_line_table">
                                        <tr>
                                            <td><strong>{{__('defaultTheme.payment_info')}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.payment_method')}}</td>
                                            <td>: {{$order->GatewayName}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.amount')}}</td>
                                            <td>: {{single_price($order_packages->products->sum('total_price') + $order_packages->shipping_cost + $order_packages->tax_amount + $total_gst)}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('order.txn_id')}}</td>
                                            <td>: {{@$order->order_payment->txn_id}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.date')}}</td>
                                            <td>: {{dateConvert(@$order->order_payment->created_at)}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('defaultTheme.payment_status')}}</td>
                                            <td>:
                                                @if ($order->is_paid == 1)
                                                    <span>{{__('common.paid')}}</span>
                                                @else
                                                    <span>{{__('common.pending')}}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="row mt-30">
                                <div class="col-12 mt-30">
                                    <div class="box_header common_table_header">
                                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('common.package')}}: {{ getNumberTranslate($order_packages->package_code) }}</h3>
                                        @if(optional($order_packages->shipping)->method_name)
                                            <ul class="d-flex float-right">
                                                <li> <strong>{{__('shipping.shipping_method')}} : {{ $order_packages->shipping->method_name }}</strong></li>
                                            </ul>
                                        @endif
                                    </div>

                                    <div class="QA_section QA_section_heading_custom check_box_table">
                                        <div class="QA_table ">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">{{__('common.sl')}}</th>
                                                            <th scope="col">{{__('common.image')}}</th>
                                                            <th scope="col">{{__('common.name')}}</th>
                                                            <th scope="col">{{__('common.qty')}}</th>
                                                            <th scope="col">{{__('common.price')}}</th>
                                                            <th scope="col">{{__('common.tax')}}</th>
                                                            <th scope="col">{{__('common.total')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($order_packages->products as $key => $package_product)
                                                            <tr>
                                                                <td>{{ getNumberTranslate($key + 1) }}</td>
                                                                <td>
                                                                    <div class="product_img_div">
                                                                        @if ($package_product->type == "gift_card")
                                                                            <img src="{{showImage(@$package_product->giftCard->thumbnail_image)}}"
                                                                                 alt="#">
                                                                        @else
                                                                            @php
                                                                                $image = !empty($package_product->seller_product_sku->product->thum_img) ? $package_product->seller_product_sku->product->thum_img:$package_product->seller_product_sku->sku->product->thumbnail_image_source;
                                                                            @endphp
                                                                            @if (@$package_product->seller_product_sku->sku->product->product_type == 1)
                                                                                <img src="{{showImage(@$package_product->seller_product_sku->product->thum_img??@$package_product->seller_product_sku->sku->product->thumbnail_image_source)}}"
                                                                                     alt="#">
                                                                            @else
                                                                            @php
                                                                                $image = !empty($package_product->seller_product_sku->sku->variant_image) ? $package_product->seller_product_sku->sku->variant_image:$package_product->seller_product_sku->product->thum_img;
                                                                            @endphp
                                                                                <img src="{{showImage(@$package_product->seller_product_sku->sku->variant_image?@$package_product->seller_product_sku->sku->variant_image:@$package_product->seller_product_sku->product->thum_img??@$package_product->seller_product_sku->product->product->thumbnail_image_source)}}"
                                                                                     alt="#">
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                                <td class="text-nowrap">
                                                                    @if ($package_product->type == "gift_card")
                                                                        {{ @$package_product->giftCard->name }}
                                                                    @else
                                                                        {{ @$package_product->seller_product_sku->sku->product->product_name }}
                                                                    @endif
                                                                </td>
                                                                @if ($package_product->type == "gift_card")
                                                                    <td>{{__('common.qty')}}: {{ getNumberTranslate($package_product->qty) }}</td>
                                                                @else
                                                                    @if (@$package_product->seller_product_sku->sku->product->product_type == 2)
                                                                        <td class="text-nowrap">
                                                                            {{__('common.qty')}}: {{ getNumberTranslate($package_product->qty) }}
                                                                            <br>
                                                                            @php
                                                                                $countCombinatiion = count(@$package_product->seller_product_sku->product_variations);
                                                                            @endphp
                                                                            @foreach (@$package_product->seller_product_sku->product_variations as $key => $combination)
                                                                                @if ($combination->attribute->id == 1)
                                                                                    <div class="box_grid ">
                                                                                        <span>{{ $combination->attribute->name }}:</span><span class='box variant_color' style="background-color:{{ $combination->attribute_value->value }}"></span>
                                                                                    </div>
                                                                                @else
                                                                                    {{ $combination->attribute->name }}:
                                                                                    {{ $combination->attribute_value->value }}
                                                                                @endif
                                                                                @if ($countCombinatiion > $key + 1)
                                                                                    <br>
                                                                                @endif
                                                                            @endforeach
                                                                        </td>
                                                                    @else
                                                                        <td>{{__('common.qty')}}: {{ getNumberTranslate($package_product->qty) }}</td>
                                                                    @endif
                                                                @endif

                                                                <td class="text-nowrap">{{ single_price($package_product->price) }}</td>
                                                                <td class="text-nowrap">{{ single_price($package_product->tax_amount) }}</td>
                                                                <td class="text-nowrap">{{ single_price($package_product->price * $package_product->qty + $package_product->tax_amount) }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-30">
                                <div class="col-md-6">
                                    <table class="table-borderless clone_line_table">
                                        <tr>
                                            <td><strong>{{__('order.order_info')}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="info_tbl">{{__('order.is_paid')}}</td>
                                            <td>: {{ $order->is_paid == 1 ? __('common.yes') : __('common.no') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="info_tbl">{{__('order.is_cancelled')}}</td>
                                            <td>: {{ $order->is_cancelled == 1 ? __('common.yes') : __('common.no') }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table-borderless clone_line_table ml-md-auto mt-md-0 mt-2">
                                        <tr>
                                            <td><strong>{{__('common.order_summary')}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="info_tbl">{{__('order.subtotal')}}</td>
                                            <td>: {{single_price($order_packages->products->sum('total_price'))}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('common.discount')}}</td>
                                            <td class="pl-25 text-nowrap">: - {{ single_price($order->discount_total) }}</td>
                                        </tr>
                                        @if($order->coupon)
                                        <tr>
                                            <td>{{__('common.coupon')}} {{__('common.discount')}}</td>
                                            <td class="pl-25 text-nowrap">: - {{single_price($order->coupon->discount_amount)}}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td class="info_tbl">{{__('common.shipping_charge')}}</td>
                                            <td>: {{single_price($order_packages->shipping_cost)}}</td>
                                        </tr>

                                        <tr>
                                            <td class="info_tbl">{{__('common.tax')}}/{{__('gst.gst')}}</td>
                                            <td>: {{single_price($order_packages->tax_amount)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="info_tbl">{{__('order.grand_total')}}</td>
                                            @php
                                                $coupon_discount = !empty($order->coupon) && !empty($order->coupon->discount_amount) ? $order->coupon->discount_amount:0;
                                            @endphp
                                            <td>: {{single_price(( ($order_packages->products->sum('total_price') - $order->discount_total) - $coupon_discount) + $order_packages->shipping_cost + $order_packages->tax_amount )}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-lg-4">
                    <div class="white_box p-25 box_shadow_white">
                        <h4 class="mb-15">{{ __('common.action') }}</h4>
                        
                        <div class="primary_input mb-25">
                            <label class="primary_input_label"><strong>Update Status</strong></label>
                            <select class="primary_select mb-15" id="detail_status">
                                <option value="pending" @if($returnRequest->status == 'pending') selected @endif>{{ __('common.pending') }}</option>
                                <option value="picked_up" @if($returnRequest->status == 'picked_up') selected @endif>Picked Up</option>
                                <option value="at_warehouse" @if($returnRequest->status == 'at_warehouse') selected @endif>At Warehouse</option>
                                <option value="completed" @if($returnRequest->status == 'completed') selected @endif>{{ __('common.completed') }}</option>
                                <option value="cancelled" @if($returnRequest->status == 'cancelled') selected @endif>{{ __('common.cancelled') }}</option>
                            </select>
                            <button type="button" class="primary-btn fix-gr-bg w-100 mt-10" id="update_status_btn">{{ __('common.update') }}</button>
                        </div>

                        <div class="mt-20">
                            <label class="primary_input_label"><strong>Assign Driver</strong></label>
                            <div class="primary_input mb-15">
                                <select class="primary_select mb-15" id="detail_driver_id">
                                    <option value="">Select Driver</option>
                                    @foreach ($drivers as $driver)
                                        <option value="{{ $driver->id }}" @if ($returnRequest->driver_id == $driver->id) selected @endif>
                                            {{ $driver->name }}@if($driver->vehicle_number) - {{$driver->vehicle_number}}@endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="button" class="primary-btn fix-gr-bg w-100" id="assign_driver_detail_btn">
                                Assign Driver
                            </button>
                        </div>
                    </div>
                    
                    <div class="white_box p-25 box_shadow_white mt-20">
                        <h4 class="mb-15">Driver Info</h4>
                        @if($returnRequest->driver)
                            <p><strong>{{ __('common.name') }}:</strong> {{ $returnRequest->driver->name }}</p>
                            <p><strong>{{ __('common.phone') }}:</strong> {{ $returnRequest->driver->phone }}</p>
                        @else
                            <p>No driver assigned</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push("scripts")
    <script type="text/javascript">
        (function($){
            "use strict";
            $(document).ready(function(){
                $('#assign_driver_detail_btn').on('click', function(){
                    var driverId = $('#detail_driver_id').val();
                    if(driverId == '') driverId = null;
                    var returnId = {{ $returnRequest->id }};

                    var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('meta[name="_token"]').attr('content');
                    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': csrfToken } });
                    $.ajax({
                        url: "{{ route('refund.seller_return_request_assign_driver') }}",
                        method: 'POST',
                        data: { id: returnId, driver_id: driverId },
                        beforeSend: function(){
                            $('#assign_driver_detail_btn').prop('disabled', true);
                        },
                        success: function(res){
                            toastr.success(res.message || 'Driver assigned successfully', 'Success');
                            $('#assign_driver_detail_btn').prop('disabled', false);
                            setTimeout(function(){
                                window.location.reload();
                            }, 1000);
                        },
                        error: function(err){
                            var msg = 'Operation failed';
                            if(err.responseJSON && err.responseJSON.message) {
                                msg = err.responseJSON.message;
                            }
                            toastr.error(msg, 'Error');
                            $('#assign_driver_detail_btn').prop('disabled', false);
                        }
                    });
                });

                $('#update_status_btn').on('click', function(){
                    var status = $('#detail_status').val();
                    var returnId = {{ $returnRequest->id }};

                    var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('meta[name="_token"]').attr('content');
                    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': csrfToken } });
                    $.ajax({
                        url: "{{ route('refund.seller_return_request_update_status') }}",
                        method: 'POST',
                        data: { id: returnId, status: status },
                        beforeSend: function(){
                            $('#update_status_btn').prop('disabled', true);
                        },
                        success: function(res){
                            toastr.success(res.message || 'Status updated successfully', 'Success');
                            $('#update_status_btn').prop('disabled', false);
                            setTimeout(function(){
                                window.location.reload();
                            }, 1000);
                        },
                        error: function(err){
                            var msg = 'Operation failed';
                            if(err.responseJSON && err.responseJSON.message) {
                                msg = err.responseJSON.message;
                            }
                            toastr.error(msg, 'Error');
                            $('#update_status_btn').prop('disabled', false);
                        }
                    });
                });
            });
        })(jQuery);
    </script>
@endpush
