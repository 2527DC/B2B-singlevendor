<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($order->package_code); ?> <?php echo e(__('shipping.invoice')); ?></title>
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

        .text_right{
            text-align: right;
        }
        .text_left{
            text-align: left!important;
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
        @page {
            footer: page-footer;
        }
    </style>
</head>
<body>
<div class="invoice_wrapper">
    <!-- invoice print part here -->
    <div class="invoice_print mb_30">
        <div class="container">
            <div class="invoice_part_iner">
                <table class="table border_bottom mb_30">
                    <thead>
                    <tr>
                        <td>
                            <div class="logo_div">
                                <img src="<?php echo e(showImage(app('general_setting')->logo)); ?>" alt="">
                            </div>
                        </td>
                        <td class="virtical_middle text_right invoice_info">
                            <h4 class="text_uppercase"><?php echo e(app('general_setting')->company_name); ?></h4>
                            <h4><?php echo e(app('general_setting')->phone); ?></h4>
                            <h4><?php echo e(app('general_setting')->email); ?></h4>
                            <h4><?php echo e($order->order->order_number); ?></h4>
                        </td>
                    </tr>
                    </thead>
                </table>
                <!-- middle content  -->
                <table class="table">
                    <tbody>
                    <tr>
                        <td style="width: 50%">
                            <!-- single table  -->
                            <table class="mb_30">
                                <tbody>
                                <tr>
                                    <td>
                                        <h5 class="font_18 mb-0" ><?php echo e(__('shipping.billing_info')); ?></h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="line_grid_2" >
                                                        <span>
                                                            <span><?php echo e(__('common.name')); ?></span>
                                                            <span>:</span>
                                                        </span>
                                            <?php echo e(($order->order->customer_id) ? $order->order->shipping_address->name : $order->order->guest_info->billing_name); ?>

                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="line_grid_2" >
                                                        <span>
                                                            <span><?php echo e(__('common.email')); ?></span>
                                                            <span>:</span>
                                                        </span>
                                            <?php echo e(($order->order->customer_id) ? $order->order->customer_email : $order->order->guest_info->billing_email); ?>

                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="line_grid_2" >
                                                        <span>
                                                            <span><?php echo e(__('common.phone')); ?></span>
                                                            <span>:</span>
                                                        </span>
                                            <?php echo e(getNumberTranslate(($order->order->customer_id) ? $order->order->customer_phone : $order->order->guest_info->billing_phone)); ?>

                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="line_grid_2" >
                                                        <span>
                                                            <span><?php echo e(__('common.address')); ?></span>
                                                            <span>:</span>
                                                        </span>
                                            <?php echo e(($order->order->customer_id) ? $order->order->billing_address->address : $order->order->guest_info->billing_address); ?>

                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="line_grid_2" >
                                                        <span>
                                                            <span><?php echo e(__('common.city')); ?></span>
                                                            <span>:</span>
                                                        </span>
                                            <?php echo e(($order->order->customer_id) ? @$order->order->billing_address->getCity->name : @$order->order->guest_info->getBillingCity->name); ?>

                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="line_grid_2" >
                                                        <span>
                                                            <span><?php echo e(__('common.state')); ?></span>
                                                            <span>:</span>
                                                        </span>
                                            <?php echo e(($order->order->customer_id) ? @$order->order->billing_address->getState->name : @$order->order->guest_info->getBillingState->name); ?>

                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="line_grid_2" >
                                                        <span>
                                                            <span><?php echo e(__('common.country')); ?></span>
                                                            <span>:</span>
                                                        </span>
                                            <?php echo e(($order->order->customer_id) ? @$order->order->billing_address->getCountry->name : @$order->order->guest_info->getBillingCountry->name); ?>

                                        </p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <!--/ single table  -->
                        </td>
                        <td style="width: 50%">
                            <!-- single table  -->
                            <table class="mb_30">
                                <tbody>
                                <tr>
                                    <td>
                                        <h5 class="font_18 mb-0" ><?php echo e(__('shipping.company_info')); ?></h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="line_grid" >
                                                         <span>
                                                             <span><?php echo e(__('common.name')); ?></span>
                                                             <span>:</span>
                                                         </span>
                                            <?php echo e(app('general_setting')->company_name); ?>

                                        </p>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        <p class="line_grid" >
                                                         <span>
                                                             <span><?php echo e(__('common.email')); ?></span>
                                                             <span>:</span>
                                                         </span>
                                            <?php echo e(app('general_setting')->email); ?>

                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="line_grid" >
                                                         <span>
                                                             <span><?php echo e(__('common.phone')); ?></span>
                                                             <span>:</span>
                                                         </span>
                                            <?php echo e(getNumberTranslate(app('general_setting')->phone)); ?>

                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="line_grid" >
                                                         <span>
                                                             <span><?php echo e(__('common.website')); ?></span>
                                                             <span>:</span>
                                                         </span>
                                            <?php echo e(app('general_setting')->website_url); ?>

                                        </p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <!--/ single table  -->
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%">
                            <!-- single table  -->
                            <table>
                                <tbody>
                                <tr>
                                    <td>
                                        <h5 class="font_18 mb-0" ><?php echo e(__('shipping.shipping_info')); ?></h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="line_grid_2" >
                                                        <span>
                                                            <span><?php echo e(__('common.name')); ?></span>
                                                            <span>:</span>
                                                        </span>
                                            <?php echo e(($order->order->customer_id) ? $order->order->shipping_address->name : $order->order->guest_info->shipping_name); ?>

                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="line_grid_2" >
                                                        <span>
                                                            <span><?php echo e(__('common.email')); ?></span>
                                                            <span>:</span>
                                                        </span>
                                            <?php echo e(($order->order->customer_id) ? $order->order->shipping_address->email : $order->order->guest_info->shipping_email); ?>

                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="line_grid_2" >
                                                        <span>
                                                            <span><?php echo e(__('common.phone')); ?></span>
                                                            <span>:</span>
                                                        </span>
                                            <?php echo e(getNumberTranslate(($order->order->customer_id) ? $order->order->shipping_address->phone : $order->order->guest_info->shipping_phone)); ?>

                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="line_grid_2" >
                                                        <span>
                                                            <span><?php echo e(__('common.address')); ?></span>
                                                            <span>:</span>
                                                        </span>
                                            <?php echo e(($order->order->customer_id) ? $order->order->shipping_address->address : $order->order->guest_info->shipping_address); ?>

                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="line_grid_2" >
                                                        <span>
                                                            <span><?php echo e(__('common.city')); ?></span>
                                                            <span>:</span>
                                                        </span>
                                            <?php echo e(($order->order->customer_id) ? @$order->order->shipping_address->getCity->name : $order->order->guest_info->getShippingCity->name); ?>

                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="line_grid_2" >
                                                        <span>
                                                            <span><?php echo e(__('common.state')); ?></span>
                                                            <span>:</span>
                                                        </span>
                                            <?php echo e(($order->order->customer_id) ? @$order->order->shipping_address->getState->name : $order->order->guest_info->getShippingState->name); ?>

                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="line_grid_2" >
                                                        <span>
                                                            <span><?php echo e(__('common.country')); ?></span>
                                                            <span>:</span>
                                                        </span>
                                            <?php echo e(($order->order->customer_id) ? $order->order->shipping_address->getCountry->name : $order->order->guest_info->getShippingCountry->name); ?>

                                        </p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <!--/ single table  -->
                        </td>
                        <td style="width: 50%">
                            <table>
                                <tbody>
                                <tr>
                                    <td>
                                        <!-- single table  -->
                                        <table class="mb_30">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <h5 class="font_18 mb-0" ><?php echo e(__('shipping.order_info')); ?></h5>
                                                </td>
                                            </tr>
                                            <?php if($order->order->customer_id == null): ?>
                                                <tr>
                                                    <td>
                                                        <p class="line_grid" >
                                                                        <span>
                                                                            <span><?php echo e(__('common.secret_id')); ?></span>
                                                                            <span>:</span>
                                                                        </span>
                                                            <?php echo e($order->order->guest_info->guest_id); ?>

                                                        </p>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <td>
                                                    <p class="line_grid" >
                                                                        <span>
                                                                            <span><?php echo e(__('order.is_paid')); ?></span>
                                                                            <span>:</span>
                                                                        </span>
                                                        <?php echo e($order->order->is_paid == 1 ? 'Yes' : 'No'); ?>

                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p class="line_grid" >
                                                                        <span>
                                                                            <span><?php echo e(__('common.subtotal')); ?></span>
                                                                            <span>:</span>
                                                                        </span>
                                                        <?php echo e(single_price($order->subTotal())); ?>

                                                    </p>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <p class="line_grid" >
                                                                        <span>
                                                                            <span><?php echo e(__('common.shipping_charge')); ?></span>
                                                                            <span>:</span>
                                                                        </span>
                                                        <?php echo e(single_price($order->shipping_cost)); ?>

                                                    </p>
                                                </td>
                                            </tr>
                                            <?php if(@$order->order->coupon): ?>
                                            <tr>
                                                <td>
                                                    <p class="line_grid" >
                                                        <span>
                                                            <span><?php echo e(__('common.coupon')); ?> <?php echo e(__('common.discount')); ?></span>
                                                            <span>:</span>
                                                        </span>
                                                        - <?php echo e(single_price(@$order->order->coupon->discount_amount)); ?>

                                                    </p>
                                                </td>
                                            </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <td>
                                                    <p class="line_grid" >
                                                                        <span>
                                                                            <span><?php echo e(__('common.tax')); ?></span>
                                                                            <span>:</span>
                                                                        </span>
                                                        <?php echo e(single_price($order->tax_amount)); ?>

                                                    </p>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <p class="line_grid" >
                                                                        <span>
                                                                            <span><?php echo e(__('common.grand_total')); ?></span>
                                                                            <span>:</span>
                                                                        </span>
                                                        <?php echo e(single_price($order->subTotal() + $order->tax_amount + $order->shipping_cost - @$order->order->coupon->discount_amount)); ?>

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
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <table class="table">
        <tbody>
        <tr>
            <td style="width: 50%">
                <p class="line_grid_2">
                                <span>
                                    <span><?php echo e(__('common.package')); ?></span>
                                    <span>:</span>
                                </span>
                    <?php echo e(getNumberTranslate($order->package_code)); ?>

                </p>
            </td>
            <?php if(isModuleActive('MultiVendor')): ?>
                <td style="width: 50%">
                    <p class="line_grid_auto grid_end">
                                <span>
                                    <span><?php echo e(__('shipping.shop_name')); ?></span>
                                    <span>:</span>
                                </span>
                        <?php if(@$order->seller->role->type == 'seller'): ?>
                            <?php echo e((@$order->seller->SellerAccount->seller_shop_display_name) ? @$order->seller->SellerAccount->seller_shop_display_name : @$order->seller->first_name); ?>

                        <?php else: ?>
                            <?php echo e(app('general_setting')->company_name); ?>

                        <?php endif; ?>
                    </p>
                </td>
            <?php endif; ?>
        </tr>
        <tr>
            <td style="width: 50%">
                <?php if(file_exists(base_path().'/Modules/GST/') && (app('gst_config')['enable_gst'] == "gst" || app('gst_config')['enable_gst'] == "flat_tax")): ?>
                    <?php $__currentLoopData = $order->gst_taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $gst_tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p class="line_grid_2 ">
                                        <span>
                                            <span><?php echo e($gst_tax->gst->name); ?></span>
                                            <span>:</span>
                                        </span>
                            <?php echo e(single_price($gst_tax->amount)); ?>

                        </p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </td>
            <td style="width: 50%">
                <p class="line_grid_auto grid_end">
                                <span>
                                    <span><?php echo e(__('shipping.shipping_method')); ?></span>
                                    <span>:</span>
                                </span>
                    <?php echo e($order->shipping->method_name); ?>

                </p>
            </td>
        </tr>
        </tbody>
    </table>
    <h3 class="center title_text"><?php echo e(__('order.ordered_products')); ?></h3>
    <table class="table border_table mb_30">
        <thead>
            <tr>
                <th><?php echo e(__('common.name')); ?></th>
                <th><?php echo e(__('common.details')); ?></th>
                <th><?php echo e(__('common.price')); ?></th>
                <th><?php echo e(__('common.total')); ?></th>
            </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text_left">
                            <?php if($package_product->type == "gift_card"): ?>
                                <?php echo e(@$package_product->giftCard->name); ?>

                            <?php else: ?>
                                <?php echo e(@$package_product->seller_product_sku->sku->product->product_name); ?>

                            <?php endif; ?>
                        </td>
                        <?php if($package_product->type == "gift_card"): ?>
                            <td><?php echo e(__('common.qty')); ?> : <?php echo e($package_product->qty); ?></td>
                        <?php else: ?>
                            <?php if(@$package_product->seller_product_sku->sku->product->product_type == 2): ?>
                                <td>
                                    <?php echo e(__('common.qty')); ?> : <?php echo e($package_product->qty); ?>

                                    <br>
                                    <?php
                                        $countCombinatiion = count(@$package_product->seller_product_sku->product_variations);
                                    ?>
                                    <?php $__currentLoopData = @$package_product->seller_product_sku->product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $combination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($combination->attribute->id == 1): ?>
                                            <div class="box_grid ">
                                                <span><?php echo e($combination->attribute->name); ?>:</span><span class='box' style="background-color:<?php echo e($combination->attribute_value->value); ?>"></span>
                                            </div>
                                        <?php else: ?>
                                            <?php echo e($combination->attribute->name); ?>:
                                            <?php echo e($combination->attribute_value->value); ?>

                                        <?php endif; ?>
                                        <?php if($countCombinatiion > $key + 1): ?>
                                            <br>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                            <?php else: ?>
                                <td><?php echo e(__('common.qty')); ?> : <?php echo e($package_product->qty); ?></td>
                            <?php endif; ?>
                        <?php endif; ?>

                        <td><?php echo e(single_price($package_product->price)); ?></td>
                        <td><?php echo e(single_price($package_product->price * $package_product->qty)); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>



    </table>
</div>
</body>
</html>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Shipping/Resources/views/order/invoice_pdf.blade.php ENDPATH**/ ?>