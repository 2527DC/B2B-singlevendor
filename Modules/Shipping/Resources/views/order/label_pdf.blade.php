<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$order->package_code}} | Print of Manifestation</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }
        table {
            border-collapse: collapse;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            color: #101010;
        }
        .invoice_wrapper{
            max-width: 1200px;
            margin: auto;
            background: #fff;
            padding: 20px;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }
        .border_none{
            border: 0px solid transparent;
            border-top: 0px solid transparent !important;
        }
        .invoice_part_iner{
            background-color: #fff;
        }

        .table_border thead{
            background-color: #F6F8FA;
        }
        .table td, .table th {
            padding: 5px 0;
            vertical-align: top;
            border-top: 0 solid transparent;
            color: #101010;
        }
        .table td , .table th {
            padding: 5px 0;
            vertical-align: top;
            border-top: 0 solid transparent;
            color: #101010;
        }
        .table_border tr{
            border-bottom: 1px solid #101010 !important;
        }
        th p span, td p span{
            color: #212E40;
        }
        .table th {
            color: #101010;
            border: 1px solid #101010 !important;
        }
        p{
            font-size: 14px;
            color: #101010;
        }
        h5{
            font-size: 12px;
            font-weight: 500;
        }
        h6{
            font-size: 10px;
            font-weight: 300;
        }
        .mt_40{
            margin-top: 40px;
        }
        .table_style th, .table_style td{
            padding: 20px;
        }
        .invoice_info_table td{
            font-size: 10px;
            padding: 0px;
        }


        .virtical_middle{
            vertical-align: middle !important;
        }
        .logo_img {
            max-width: 120px;
        }
        .logo_img img{
            width: 100%;
        }
        .border_bottom{
            border-bottom: 1px solid #000;
        }
        .line_grid{
            display: grid;
            grid-template-columns: 110px auto;
            grid-gap: 10px;
        }
        .line_grid span{
            display: flex;
            justify-content: space-between;
        }

        .line_grid2{
            display: grid;
            grid-template-columns:  auto 110px;
            grid-gap: 10px;
        }
        .line_grid2 span{
            display: flex;
            justify-content: space-between;
        }
        p{
            margin: 0;
        }
        .font_18 {
            font-size: 18px;
        }
        .mb-0{
            margin-bottom: 0;
        }
        .mb_30{
            margin-bottom: 30px !important;
        }
        .mb_15{
            margin-bottom: 15px !important;
        }
        .border_table{}
        .border_table thead tr th {
            padding: 5px;
        }
        .border_table tbody tr td {
            border: 1px solid #101010 !important;
            text-align: center;
            padding: 5px;
        }
        td, th{
            color: #101010;
            font-weight: 500;
            padding: 5px;

        }
        table{
            width: 100%;
        }

        .text_right{
            text-align: right!important;
        }
        .text_left{
            text-align: left!important;
        }
        .text_center{
            text-align: center!important;
        }
        .border_table tbody tr td.text_right{
            text-align: right!important;
        }
        .border_table tbody tr td.text_left{
            text-align: left!important;
        }
        .border_table tbody tr td.text_center{
            text-align: center!important;
        }
    </style>
</head>
<body>
<div class="invoice_wrapper">
    <!-- invoice print part here -->
    <div class="invoice_print mb_15">
        <div class="container">
            <div class="invoice_part_iner">
                <table class="table border_bottom mb_30">
                    <thead>
                    <tr>
                        <td>
                            <div class="logo_div">
                                <img src="{{showImage(app('general_setting')->logo)}}" alt="">
                            </div>
                        </td>
                        <td class="virtical_middle text_right invoice_info">
                            <h4 class="text_uppercase">{{app('general_setting')->company_name}}</h4>
                            <h4>{{app('general_setting')->phone}}</h4>
                            <h4>{{app('general_setting')->email}}</h4>
                            <h4>{{$order->order->order_number}}</h4>
                        </td>
                    </tr>
                    </thead>
                </table>


                <table class="table">
                    <tbody>
                        <tr>
                            <td style="width: 50%;">
                                <!-- single table  -->
                                <table>
                                    <tbody>

                                    <tr>
                                        <td>
                                            <p class="line_grid" >
                                                <span>
                                                    <span>{{__('shipping.destination')}}</span>
                                                </span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="line_grid" >
                                                <span>
                                                    <span>
                                                        @php
                                                            $customerName = '';
                                                            if(!empty($order->order->customer_id) && !empty($order->order->shipping_address)) {
                                                                $customerName = $order->order->shipping_address->name;
                                                            } elseif(!empty($order->order->guest_info->billing_name)) {
                                                                $customerName = $order->order->guest_info->billing_name;
                                                            }
                                                        @endphp
                                                        <span>{{ $customerName }}</span>
                                                    </span>
                                                </span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="line_grid" >
                                                <span>
                                                    <span>{{__('common.addresses')}}</span>
                                                    <span>:</span>
                                                </span>
                                                @php
                                                    $address = '';
                                                    if(!empty($order->order->customer_id) && !empty($order->order->billing_address)) {
                                                        $address = $order->order->billing_address->address;
                                                    } elseif(!empty($order->order->guest_info->billing_address)) {
                                                        $address = $order->order->guest_info->billing_address;
                                                    }
                                                @endphp
                                                {{ $address }}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="line_grid" >
                                                <span>
                                                    <span>{{__('common.city')}}</span>
                                                    <span>:</span>
                                                </span>
                                                @php
                                                    $city = '';
                                                    if(!empty($order->order->customer_id) && !empty($order->order->billing_address) && !empty($order->order->billing_address->getCity)) {
                                                        $city = $order->order->billing_address->getCity->name;
                                                    } elseif(!empty($order->order->guest_info->getShippingCity)) {
                                                        $city = $order->order->guest_info->getShippingCity->name;
                                                    } elseif(!empty($order->order->guest_info->getCity)) {
                                                        $city = $order->order->guest_info->getCity->name;
                                                    }
                                                @endphp
                                                {{ $city }}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="line_grid" >
                                                <span>
                                                    <span>{{__('common.state')}}</span>
                                                    <span>:</span>
                                                </span>
                                                @php
                                                    $state = '';
                                                    if(!empty($order->order->customer_id) && !empty($order->order->billing_address) && !empty($order->order->billing_address->getState)) {
                                                        $state = $order->order->billing_address->getState->name;
                                                    } elseif(!empty($order->order->guest_info->getShippingState)) {
                                                        $state = $order->order->guest_info->getShippingState->name;
                                                    } elseif(!empty($order->order->guest_info->getState)) {
                                                        $state = $order->order->guest_info->getState->name;
                                                    }
                                                @endphp
                                                {{ $state }}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="line_grid" >
                                                <span>
                                                    <span>{{__('common.country')}}</span>
                                                    <span>:</span>
                                                </span>
                                                @php
                                                    $country = '';
                                                    if(!empty($order->order->customer_id) && !empty($order->order->billing_address) && !empty($order->order->billing_address->getCountry)) {
                                                        $country = $order->order->billing_address->getCountry->name;
                                                    } elseif(!empty($order->order->guest_info->getShippingCountry)) {
                                                        $country = $order->order->guest_info->getShippingCountry->name;
                                                    } elseif(!empty($order->order->guest_info->getCountry)) {
                                                        $country = $order->order->guest_info->getCountry->name;
                                                    }
                                                @endphp
                                                {{ $country }}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="line_grid" >
                                                <span>
                                                    <span>{{__('common.postal_code')}}</span>
                                                    <span>:</span>
                                                </span>
                                                @php
                                                    $postalCode = '';
                                                    if(!empty($order->order->customer_id) && !empty($order->order->billing_address)) {
                                                        $postalCode = $order->order->billing_address->postal_code;
                                                    } elseif(!empty($order->order->guest_info->shipping_post_code)) {
                                                        $postalCode = $order->order->guest_info->shipping_post_code;
                                                    } elseif(!empty($order->order->guest_info->billing_post_code)) {
                                                        $postalCode = $order->order->guest_info->billing_post_code;
                                                    }
                                                @endphp
                                                {{ $postalCode }}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="line_grid" >
                                                <span>
                                                    <span>{{__('common.email')}}</span>
                                                    <span>:</span>
                                                </span>
                                                @php
                                                    $email = '';
                                                    if(!empty($order->order->customer_id)) {
                                                        $email = $order->order->customer_email;
                                                    } elseif(!empty($order->order->guest_info->shipping_email)) {
                                                        $email = $order->order->guest_info->shipping_email;
                                                    } elseif(!empty($order->order->guest_info->billing_email)) {
                                                        $email = $order->order->guest_info->billing_email;
                                                    }
                                                @endphp
                                                {{ $email }}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="line_grid" >
                                                <span>
                                                    <span>{{__('common.phone')}}</span>
                                                    <span>:</span>
                                                </span>
                                                @php
                                                    $phone = '';
                                                    if(!empty($order->order->customer_id)) {
                                                        $phone = $order->order->customer_phone;
                                                    } elseif(!empty($order->order->guest_info->shipping_phone)) {
                                                        $phone = $order->order->guest_info->shipping_phone;
                                                    } elseif(!empty($order->order->guest_info->billing_phone)) {
                                                        $phone = $order->order->guest_info->billing_phone;
                                                    }
                                                @endphp
                                                {{getNumberTranslate($phone)}}
                                            </p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!--/ single table  -->
                            </td>

                            <td style="width: 50%;">
                                <!-- single table  -->
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <p style="text-align: right;" class="line_grid2" >
                                                <span>
                                                    <span>{{__('shipping.Return address')}}</span>
                                                </span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="text-align: right;" class="line_grid2" >
                                                <span>
                                                    <span>{{$order->pickupPoint->name ?? ''}}</span>
                                                </span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="text-align: right;" class="line_grid2" >
                                                {{__('common.addresses')}}
                                                <span>
                                                    <span>:</span>
                                                    <span>{{$order->pickupPoint->address ?? ''}}</span>
                                                </span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="text-align: right;" class="line_grid2" >
                                                {{__('common.city')}}
                                                <span>
                                                    <span>:</span>
                                                    <span>{{$order->pickupPoint->city->name ?? ''}}</span>
                                                </span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="text-align: right;" class="line_grid2" >
                                                {{__('common.state')}}
                                                <span>
                                                    <span>:</span>
                                                    <span>{{$order->pickupPoint->state->name ?? ''}}</span>
                                                </span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="text-align: right;" class="line_grid2" >
                                                {{__('common.country')}}
                                                <span>
                                                    <span>:</span>
                                                    <span>{{$order->pickupPoint->country->name ?? ''}}</span>
                                                </span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="text-align: right;" class="line_grid2" >
                                                {{__('common.postal_code')}}
                                                <span>
                                                    <span>:</span>
                                                    <span>{{$order->pickupPoint->pin_code ?? ''}}</span>
                                                </span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="text-align: right;" class="line_grid2" >
                                               {{__('common.email')}}
                                                <span>
                                                    <span>:</span>
                                                    <span>{{$order->pickupPoint->email ?? ''}}</span>
                                                </span>
                                            </p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <p style="text-align: right;" class="line_grid2" >
                                                {{__('common.phone')}}
                                                <span>
                                                    <span>:</span>
                                                    <span>{{getNumberTranslate($order->pickupPoint->phone ?? '')}}</span>
                                                </span>
                                            </p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!--/ single table  -->
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- invoice print part end -->
    <table>
        <tbody>
            <tr>
                @php
                    $shippingConfig = sellerWiseShippingConfig($order->seller_id);
                    $labelCode = $shippingConfig['label_code'] ?? 'barcode';
                @endphp
                @if($labelCode == 'barcode' || $labelCode == 'both')
                <td>
                    {{__('common.package')}} # : {{getNumberTranslate($order->package_code)}} <br/><br/>
                </td>
                @endif
                @if($labelCode == 'qrcode' || $labelCode == 'both')
                <td>
                    @if($labelCode == 'qrcode')
                        {{__('common.package')}} # : {{getNumberTranslate($order->package_code)}} <br/><br/>
                    @endif
                </td>
                @endif
            </tr>
        </tbody>
    </table>
    <table class="table">
        <tbody>
            <tr>
                <td style="width: 50%;">
                    <table>
                        <tbody>
                        <tr>
                            <td>
                                <p class="line_grid" >
                            <span>
                                <span>{{__('shipping.weight')}}</span>
                                <span>:</span>
                            </span>
                                    {{getNumberTranslate($order->weight > 0 ? number_format($order->weight / 1000, 2):0)}} {{__('common.kg')}}
                                </p>
                            </td>
                        </tr>
                        @php
                            $packaging_info = false;
                            if($order->length && $order->breadth && $order->height){
                              $packaging_info = true;
                            }
                        @endphp
                        @if($packaging_info)
                        <tr>
                            <td>
                                <p class="line_grid" >
                            <span>
                                <span>{{__('common.dimensions')}}</span>
                                <span>:</span>
                            </span>
                                  {{getNumberTranslate($order->length)}} x {{getNumberTranslate($order->breadth)}} x {{getNumberTranslate($order->height)}}
                                </p>
                            </td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table border_table mb_30" >
        <thead>
            <tr>
                <th>{{__('product.sku')}}</th>
                <th>{{__('seller.shop_name')}}</th>
                <th>{{__('product.items')}}</th>
                <th>{{__('common.quantity')}}</th>
                <th>{{__('common.price')}}</th>
            </tr>
        </thead>
        <tbody>
            @php
                $sub_total = 0;
                $others = 0;
                $total = 0;
            @endphp
            @foreach($order->products as $key => $product)
                @if($product->seller_product_sku->product->product->is_physical  == 1)
                @php
                   $shopName =  !empty($product->seller_product_sku) && !empty($product->seller_product_sku->product->seller) && !empty($product->seller_product_sku->product->seller->SellerAccount) ?  $product->seller_product_sku->product->seller->SellerAccount->seller_shop_display_name:app('general_setting')->company_name;
                @endphp
                    <tr>
                        <td>{{$product->seller_product_sku->sku->sku ?? ''}}</td>
                        <th>
                            {{ $shopName }}
                        </th>
                        <td class="">{{$product->seller_product_sku->product->product_name ?? ''}}</td>
                        <td>{{getNumberTranslate($product->qty)}}</td>
                        <td class="text_right">{{single_price($product->price)}}</td>
                    </tr>
                    @php
                        $sub_total += $product->qty *  $product->price;
                    @endphp
                @endif
            @endforeach
            @php
                $others = $order->tax_amount + $order->shipping_cost;
                $total = $sub_total + $others;
                if(@$order->order->coupon){
                    $total = $total- @$order->order->coupon->discount_amount;
                }
            @endphp
            <tr>
                <td colspan="4" class="">{{__('order.sub_total')}}</td>
                <td class="text_right">{{single_price($sub_total)}}</td>
            </tr>
            <tr>
                <td colspan="4" class="">{{__('common.tax')}}/{{__('common.shipping')}}/{{__('common.others')}}/{{__('common.coupon')}}</td>
                <td class="text_right">{{single_price($others)}}</td>
            </tr>
            <tr>
                <td colspan="4" class="">{{__('order.total')}}</td>
                <td class="text_right" >{{single_price($total)}}</td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
        <tr>
            <td>{{__('pos.invoice_no')}}: {{getNumberTranslate($order->order->order_number)}} | {{__('pos.print_date_time')}}: {{dateConvert(showDate($order->created_at))}} {{ date("H:i",strtotime($order->created_at)) }}</td>
        </tr>
        @php
            $terms = \Modules\Shipping\Entities\LabelConfig::where('created_by',$order->seller_id)->get();
        @endphp
        @if(count($terms) > 0)
            <tr>
                <td>{{__('shipping.terms_and_conditions')}}</td>
            </tr>
            @foreach($terms as $key => $term)
                <tr>
                    <td>{{getNumberTranslate($key+1)}}.{{getNumberTranslate($term->condition)}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    <br>
    <hr>
    <br>
    <table>
        <tbody>
            <tr>
                @php
                    $shippingConfig = sellerWiseShippingConfig($order->seller_id);
                    $labelCode = $shippingConfig['label_code'] ?? 'barcode';
                @endphp
                @if($labelCode == 'barcode' || $labelCode == 'both')
                <td style="text-align:center">
                    @php
                        if(class_exists('DNS1D')) {
                            echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($order->package_code, 'C39+',3,33,array(1,1,1)) . '" alt="barcode" style="width: 250px;height: 25px;" />';
                        }
                    @endphp
                </td>
                @endif
                @if($labelCode == 'qrcode' || $labelCode == 'both')
                <td style="text-align:center">
                    @php
                        if(class_exists('DNS2D')) {
                            $code = DNS2D::getBarcodeSVG($order->package_code,'QRCODE',3,3);
                            $code = str_replace('<?xml version="1.0" standalone="no"?>','',$code);
                            echo $code;
                        }
                    @endphp
                </td>
                @endif
            </tr>
        </tbody>
    </table>
</div>
</body>
</html>