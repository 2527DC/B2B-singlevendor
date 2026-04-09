<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bulk Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .page-break {
            page-break-after: always;
        }

        .header-left {
            width: 50%;
            vertical-align: top;
        }

        .header-right {
            width: 50%;
            vertical-align: top;
            text-align: right;
        }

        h1 {
            margin: 0 0 5px 0;
            font-size: 24px;
            font-weight: bold;
        }

        .seller-name {
            font-weight: bold;
            text-transform: uppercase;
        }

        .divider {
            border-top: 2px solid #000;
            margin: 10px 0;
        }

        .thin-divider {
            border-top: 1px solid #000;
            margin: 10px 0;
        }

        .address-box {
            vertical-align: top;
            width: 50%;
        }

        .address-title {
            font-weight: bold;
            font-size: 10px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .items-table {
            margin-top: 10px;
        }

        .items-table th {
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
            padding: 5px 2px;
            text-align: right;
            font-size: 10px;
        }

        .items-table th:nth-child(1),
        .items-table th:nth-child(2) {
            text-align: left;
        }

        .items-table td {
            padding: 5px 2px;
            vertical-align: top;
            text-align: right;
        }

        .items-table td:nth-child(1),
        .items-table td:nth-child(2) {
            text-align: left;
        }

        .total-row td {
            border-top: 1px solid #000;
            border-bottom: 2px solid #000;
            font-weight: bold;
            padding: 5px 2px;
        }

        .net-payable {
            text-align: right;
            padding: 10px 0;
            font-weight: bold;
            font-size: 14px;
        }

        .amount-words {
            text-align: right;
            font-weight: bold;
            font-size: 12px;
        }

        .footer {
            margin-top: 40px;
        }

        .footer td {
            vertical-align: top;
        }

        .signature {
            text-align: right;
        }

        .signatory-title {
            font-weight: bold;
        }

        .declaration {
            font-size: 9px;
            text-align: justify;
            margin-top: 20px;
        }

        .barcode {
            text-align: right;
            margin-top: 10px;
        }

        .metadata {
            font-size: 10px;
        }

        .metadata td {
            padding: 1px 0;
        }
    </style>
</head>

<body>
    @foreach($orders as $index => $order)
        @php
            $seller = @$order->seller;
            $seller_name = @$seller->role->type == 'seller' ? (@$seller->SellerAccount->seller_shop_display_name ?: $seller->first_name) : app('general_setting')->company_name;
            $customer = $order->order->customer_id ? $order->order : $order->order->guest_info;
            $shipping_addr = $order->order->customer_id ? $order->order->shipping_address : $order->order->guest_info;
            $billing_addr = $order->order->customer_id ? $order->order->billing_address : $order->order->guest_info;
        @endphp

        <table>
            <tr>
                <td class="header-left">
                    <h1>Tax Invoice</h1>
                    <div class="seller-name">{{ $seller_name }} @if(@$seller->SellerBusinessInformation->business_tax_id)
                    GSTIN:{{$seller->SellerBusinessInformation->business_tax_id}} @endif</div>
                    <div>{{ @$seller->SellerBusinessInformation->business_address1 ?: app('general_setting')->address }}
                    </div>
                    <div>{{ @$seller->SellerBusinessInformation->business_city }}
                        {{ @$seller->SellerBusinessInformation->business_state }}
                        {{ @$seller->SellerBusinessInformation->business_postcode }}</div>
                </td>
                <td class="header-right">
                    <table class="metadata" style="width:100%; text-align:right;">
                        <tr>
                            <td width="60%">Inv. No.</td>
                            <td width="40%">{{ $order->package_code }}</td>
                        </tr>
                        <tr>
                            <td>Order #</td>
                            <td>{{ $order->order->order_number }}</td>
                        </tr>
                        <tr>
                            <td>Inv. Date</td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-weight:bold;">ORIGINAL FOR RECIPIENT</td>
                        </tr>
                    </table>
                    <div class="barcode">
                        <div style="margin-top:10px;">{{ $order->package_code }}</div>
                    </div>
                </td>
            </tr>
        </table>

        <div class="divider"></div>

        <table>
            <tr>
                <td class="address-box">
                    <div class="address-title">SHIP TO</div>
                    <div style="font-weight:bold;">{{ $shipping_addr->shipping_name ?? $shipping_addr->name }}</div>
                    <div>{{ $shipping_addr->shipping_address ?? $shipping_addr->address }}</div>
                    <div>{{ @$shipping_addr->getShippingCity->name ?? @$shipping_addr->getCity->name }},
                        {{ @$shipping_addr->getShippingState->name ?? @$shipping_addr->getState->name }}
                        {{ $shipping_addr->shipping_postcode ?? $shipping_addr->postal_code }}</div>
                    <div>Phone: {{ $shipping_addr->shipping_phone ?? $shipping_addr->phone }}</div>
                </td>
                <td class="address-box">
                    <div class="address-title">BILL TO</div>
                    <div style="font-weight:bold;">{{ $billing_addr->billing_name ?? $billing_addr->name }}</div>
                    <div>{{ $billing_addr->billing_address ?? $billing_addr->address }}</div>
                    <div>{{ @$billing_addr->getBillingCity->name ?? @$billing_addr->getCity->name }},
                        {{ @$billing_addr->getBillingState->name ?? @$billing_addr->getState->name }}
                        {{ $billing_addr->billing_postcode ?? $billing_addr->postal_code }}</div>
                </td>
            </tr>
        </table>

        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 5%;">SNo.</th>
                    <th style="width: 35%;">Item(s)</th>
                    <th style="width: 10%;">Quantity</th>
                    <th style="width: 10%;">Rate</th>
                    <th style="width: 15%;">Taxable Value</th>
                    <th style="width: 10%;">Tax</th>
                    <th style="width: 15%;">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @php 
                                                $total_qty = 0;
                    $total_taxable = 0;
                    $total_tax = $order->tax_amount;
                    $total_amount = 0;
                @endphp
        @foreach ($order->products as $key => $package_product)
            @php
                $is_gift = $package_product->type == "gift_card";
                $name = $is_gift ? @$package_product->giftCard->name : @$package_product->seller_product_sku->sku->product->product_name;
                $qty = $package_product->qty;
                $rate = $package_product->price;
                $total = $rate * $qty;
                $total_qty += $qty;
                $total_taxable += $total;
                $total_amount += $total;
            @endphp
            <tr>
                    <td>{{ $key + 1 }}</td>
                <td>
                        {{ $name }}
                    @if(!$is_gift && @$package_product->seller_product_sku->sku->product->product_type == 2)
                        <br><span style="font-size:9px;">
                        @foreach (@$package_product->seller_product_sku->product_variations as $combination)
                            {{ $combination->attribute->name }}: {{ $combination->attribute_value->value }}
                        @endforeach
                        </span>
                    @endif
                    </td>
                    <td>{{ $qty }}</td>
                        <td>{{ single_price($rate) }}</td>
                        <td>{{ single_price($total) }}</td>
                        <td>-</td>
                        <td>{{ single_price($total) }}</td>
                    </tr>
        @endforeach
                <!-- Additional rows for tax, shipping, discounts -->
                @if($order->tax_amount > 0)
                    <tr>
                        <td></td>
                        <td>Tax</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ single_price($order->tax_amount) }}</td>
                        <td>{{ single_price($order->tax_amount) }}</td>
                    </tr>
                @endif
                @if($order->shipping_cost > 0)
                    <tr>
                        <td></td>
                        <td>Shipping Charge</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ single_price($order->shipping_cost) }}</td>
                    </tr>
                @endif
                @if(@$order->order->coupon->discount_amount > 0)
                            <tr>
                                <td></td>
                                <td>Coupon Discount</td>
                                <td></td>
                                <td></td>
                    <td></td>
                                <td></td>
                                <td>-{{ single_price($order->order->coupon->discount_amount) }}</td>
                            </tr>
                @endif

                <tr class="total-row">
                    <td colspan="2">INVOICE TOTAL</td>
                <td>{{ $total_qty }}</td>

                                   <td></td>
                    <td>{{ single_price($total_taxable) }}</td>
                    <td>{{ single_price($order->tax_amount) }}</td>
                    @php
                        $grand_total = $order->subTotal() + $order->tax_amount + $order->shipping_cost - @$order->order->coupon->discount_amount;
                    @endphp
                    <td>{{ single_price($grand_total) }}</td>
                </tr>
            </tbody>
        </table>


                           <table style="width: 100%; margin-top: 20px;">
            <tr>
                <td style="width: 50%; vertical-align: top;">
                <table style="border: 1px solid #000; border-radius: 5px; width: 220px; border-col
                               lapse: separate; padding: 5px;">
                        <tr>
                            <td style="vertical-align: middle; width: 60px;">

                                                               @php
                                                                $upi_id = "50200093720385@hdfc0005661.ifsc.npci";
                                                                $upi_link = "upi://pay?pa=" . $upi_id . "&pn=" . urlencode("Shree Dhatri Enterprises") . "&am=" . $grand_total . "&cu=INR";
                                                            @endphp
                                <img src="data:image/png;base64,{{ (new \Milon\Barcode\DNS2D)->getBarcodePNG($upi_link, 'QRCODE') }}" alt="QR Code" style="width: 60px; height: 60px;">
                            </td>
                            <td style="vertical-align: middle; padding-left: 8px;">
                                <div style="font-size: 14px; font-weight: bold; margin-bottom: 2px;">{{ single_price($grand_total) }}</div>
                                <div style="font-size: 9px; line-height: 1.2;">to be collected at time of delivery</div>
                                <div style="font-weight: bold; font-size: 11px; margin-top: 3px;">SCAN QR TO PAY</div>
                            </td>
                        </tr>



                                            </table>



                                                <div style="
                                margin-top: 15px; font-size: 10px; line
                                -height: 1.4;">

                                                <strong 
                                style="font-size: 11px;">Bank Details
                                :</strong>

                                                <table style="font-size: 10px; margin-top: 2px; width: 100%;">
                            <tr><td style="padding: 1px 0; width: 60px;">A/c Name</td><td style="padding: 1px 0;">: Shree Dhatri Enterprises</td></tr>
                            <tr><td style="padding: 1px 0;">Bank</td><td style="padding: 1px 0;">: HDFC Bank</td></tr>
                            <tr><td style="padding: 1px 0;">A/C No</td><td style="padding: 1px 0;">: 50200093720385</td></tr>
                            <tr><td style="padding: 1px 0;">IFSC</td><td style="padding: 1px 0;">: HDFC0005661</td></tr>
                        </table>
                    </div>
                </td>
                <td style="width: 50%; vertical-align: top; text-align: right;">

                                                   <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="padding: 5px; text-align: left;">
                                <span style="font-size: 11px; font-weight: bold;">Net Payable Amount</span><br>
                                <span style="font-size: 9px; font-weight: normal;">( Rounded off to nearest<br>integer value )</span>
                            </td>
                            <td style="padding: 5px; text-align: right; font-weight: bold; font-size: 14px;">
                                {{ single_price($grand_total) }}
                            </
                       td>

                                           </tr>
                    </table>
                    @if(class_exists('NumberFormatter'))
                        <div style="margin-top: 5px; font-size: 9px; text-align: right;">
                            Rupees {{ ucwords((new \NumberFormatter("en_IN", \NumberFormatter::SPELLOUT))->format($grand_total)) }} Only
                        </div>
                    @endif
                </td>
            </tr>
        </table>
        <div style="margin-top:15px; font-size: 9px;">
            <strong>NOTE</strong> - Rate mentioned above is inclusive of taxes.
        </div>

        <div class="thin-divider"></div>

        <table class="footer">
            <tr>
                <td style="width: 50%;">
                    <div style="font-weight:bold;">GENERATED ON {{ app('general_setting')->company_name }}</div>
                    <div class="declaration">
                        For help write to us on {{ app('general_setting')->email }}.<br>
                        Or call us on {{ app('general_setting')->phone }}
                    </div>
                </td>
                <td style="width: 50%;" class="signature">


                                       <div style="margin-top: 40px; margin-bottom: 20px;">
                        <span style="font-weight:bold; font-size:12px;">Authorised Signatory</span>
                    </div>
                    <div class="declaration">
                        Declaration : We declare that the invoice shows the actual price of the goods described and the particulars are true and correct. The correctness of HSN code and GST rate on the goods is responsibility of the seller. This is a computer-generated invoice.
                    </div>
            </td>
            </tr>
            </table>


        @if($index < count($orders) - 1)
            <div class="page-break"></div>
        @endif
    @endforeach
</body>
</html>
