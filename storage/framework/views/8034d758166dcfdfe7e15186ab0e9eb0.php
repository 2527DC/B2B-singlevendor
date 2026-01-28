<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(__('common.document')); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/ordermanage/css/sale_print.css'))); ?>" />
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
                                    <h4><?php echo e(getNumberTranslate(app('general_setting')->phone)); ?></h4>
                                    <h4><?php echo e(app('general_setting')->email); ?></h4>
                                    <h4><?php echo e(getNumberTranslate($order->order_number)); ?></h4>
                                </td>
                            </tr>
                        </thead>
                    </table>
                    <!-- middle content  -->
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                   <!-- single table  -->
                                   <table class="mb_20">
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
                                                        <?php echo e(($order->customer_id) ? @$order->address->billing_name : @$order->guest_info->billing_name); ?>

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
                                                        <?php echo e(($order->customer_id) ? @$order->address->billing_email : @$order->guest_info->billing_email); ?>

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
                                                        <?php echo e(($order->customer_id) ? getNumberTranslate(@$order->address->billing_phone) : getNumberTranslate(@$order->guest_info->billing_phone)); ?>

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
                                                        <?php echo e(($order->customer_id) ? @$order->address->billing_address : @$order->guest_info->billing_address); ?>

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
                                                        <?php echo e(($order->customer_id) ? @$order->address->getBillingCity->name : @$order->guest_info->getBillingCity->name); ?>

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
                                                        <?php echo e(($order->customer_id) ? @$order->address->getBillingState->name : @$order->guest_info->getBillingState->name); ?>

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
                                                        <?php echo e(($order->customer_id) ? @$order->address->getBillingCountry->name : @$order->guest_info->getBillingCountry->name); ?>

                                                    </p>
                                                </td>
                                           </tr>
                                       </tbody>
                                   </table>
                                   <!--/ single table  -->
                                </td>
                                <td>
                                    <!-- single table  -->
                                    <table class="mb_20">
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
                                                         <?php echo e(app('general_setting')->system_domain); ?>

                                                     </p>
                                                 </td>
                                            </tr>
                                            <tr>
                                                 <td>
                                                     <p class="line_grid" >
                                                         <span>
                                                             <span><?php echo e(__('common.order')); ?> <?php echo e(__('common.date')); ?></span>
                                                             <span>:</span>
                                                         </span>
                                                        <?php echo e(dateConvert(@$order->created_at)); ?>

                                                     </p>
                                                 </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!--/ single table  -->
                                </td>
                            </tr>
                            <tr>
                                <td>
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
                                                        <?php echo e(($order->customer_id) ? @$order->address->shipping_name : @$order->guest_info->shipping_name); ?>

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
                                                        <?php echo e(($order->customer_id) ? $order->address->shipping_email : $order->guest_info->shipping_email); ?>

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
                                                        <?php echo e(($order->customer_id) ? getNumberTranslate($order->address->shipping_phone) : getNumberTranslate($order->guest_info->shipping_phone)); ?>

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
                                                        <?php echo e(($order->customer_id) ? $order->address->shipping_address : $order->guest_info->shipping_address); ?>

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
                                                        <?php echo e(($order->customer_id) ? @$order->address->getShippingCity->name : $order->guest_info->getShippingCity->name); ?>

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
                                                        <?php echo e(($order->customer_id) ? @$order->address->getShippingState->name : $order->guest_info->getShippingState->name); ?>

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
                                                        <?php echo e(($order->customer_id) ? @$order->address->getShippingCountry->name : $order->guest_info->getShippingCountry->name); ?>

                                                    </p>
                                                </td>
                                           </tr>
                                       </tbody>
                                   </table>
                                   <!--/ single table  -->
                                </td>
                                <td>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                   <!-- single table  -->
                                                   <table class="mb_20">
                                                       <tbody>
                                                           <tr>
                                                               <td>
                                                                   <h5 class="font_18 mb-0" ><?php echo e(__('shipping.order_info')); ?></h5>
                                                               </td>
                                                           </tr>
                                                           <?php if($order->customer_id == null): ?>
                                                           <tr>
                                                                <td>
                                                                    <p class="line_grid" >
                                                                        <span>
                                                                            <span><?php echo e(__('common.secret_id')); ?></span>
                                                                            <span>:</span>
                                                                        </span>
                                                                        <?php echo e($order->guest_info->guest_id); ?>

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
                                                                        <?php echo e($order->is_paid == 1 ? 'Yes' : 'No'); ?>

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
                                                                        <?php echo e(single_price($order->sub_total)); ?>

                                                                    </p>
                                                                </td>
                                                           </tr>
                                                           <tr>
                                                                <td>
                                                                    <p class="line_grid" >
                                                                        <span>
                                                                            <span><?php echo e(__('common.discount')); ?></span>
                                                                            <span>:</span>
                                                                        </span>
                                                                        - <?php echo e(single_price($order->discount_total)); ?>

                                                                    </p>
                                                                </td>
                                                           </tr>
                                                           <?php if($order->coupon): ?>
                                                           <tr>
                                                                <td>
                                                                    <p class="line_grid" >
                                                                        <span>
                                                                            <span><?php echo e(__('common.coupon')); ?> <?php echo e(__('common.discount')); ?></span>
                                                                            <span>:</span>
                                                                        </span>
                                                                        - <?php echo e(single_price($order->coupon->discount_amount)); ?>

                                                                    </p>
                                                                </td>
                                                           </tr>
                                                           <?php endif; ?>
                                                           <tr>
                                                                <td>
                                                                    <p class="line_grid" >
                                                                        <span>
                                                                            <span><?php echo e(__('common.shipping_charge')); ?></span>
                                                                            <span>:</span>
                                                                        </span>
                                                                        <?php echo e(single_price($order->shipping_total)); ?>

                                                                    </p>
                                                                </td>
                                                           </tr>
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
                                                           <?php if(file_exists(base_path().'/Modules/GST/') && (app('gst_config')['enable_gst'] == "gst" || app('gst_config')['enable_gst'] == "flat_tax")): ?>
                                                               <tr>
                                                                    <td>
                                                                        <p class="line_grid" >
                                                                            <span>
                                                                                <span><?php echo e(__('gst.total_gst')); ?></span>
                                                                                <span>:</span>
                                                                            </span>
                                                                            <?php echo e(single_price($order->TotalGstAmount)); ?>

                                                                        </p>
                                                                    </td>
                                                               </tr>
                                                           <?php endif; ?>
                                                           <tr>
                                                                <td>
                                                                    <p class="line_grid" >
                                                                        <span>
                                                                            <span><?php echo e(__('common.grand_total')); ?></span>
                                                                            <span>:</span>
                                                                        </span>
                                                                        <?php echo e(single_price($order->grand_total)); ?>

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
        <!-- invoice print part end -->
        <h3 class="center title_text"><?php echo e(__('order.ordered_products')); ?></h3>
        <?php $__currentLoopData = $order->packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order_package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <table class="table">
                <tbody>
                    <tr>
                        <td>
                            <p class="line_grid_2">
                                <span>
                                    <span><?php echo e(__('common.package')); ?></span>
                                    <span>:</span>
                                </span>
                                <?php echo e(getNumberTranslate($order_package->package_code)); ?>

                            </p>
                        </td>
                        <?php if(isModuleActive('MultiVendor')): ?>
                        <td>
                            <p class="line_grid_auto grid_end">
                                <span>
                                    <span><?php echo e(__('shipping.shop_name')); ?></span>
                                    <span>:</span>
                                </span>
                                <?php if(@$order_package->seller->role->type == 'seller'): ?>
                                    <?php echo e((@$order_package->seller->SellerAccount->seller_shop_display_name) ? @$order_package->seller->SellerAccount->seller_shop_display_name : @$order_package->seller->first_name); ?>

                                <?php else: ?>
                                    <?php echo e(app('general_setting')->company_name); ?>

                                <?php endif; ?>
                            </p>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td>
                            <?php if(file_exists(base_path().'/Modules/GST/') && (app('gst_config')['enable_gst'] == "gst" || app('gst_config')['enable_gst'] == "flat_tax")): ?>
                                <?php $__currentLoopData = $order_package->gst_taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $gst_tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                        <td>
                            <p class="line_grid_auto grid_end">
                                <span>
                                    <span><?php echo e(__('shipping.shipping_method')); ?></span>
                                    <span>:</span>
                                </span>
                                <?php echo e($order_package->shipping->method_name); ?>

                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="table border_table mb_20" >
                <tr>
                    <th scope="col" width="30%" class="text_left"><?php echo e(__('common.name')); ?></th>
                    <th scope="col" class="text_left"><?php echo e(__('common.details')); ?></th>
                    <th scope="col" class="text-right"><?php echo e(__('common.price')); ?></th>
                    <th scope="col" class="text-right"><?php echo e(__('common.total')); ?></th>
                </tr>
                <?php $__currentLoopData = $order_package->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php if($package_product->type == "gift_card"): ?>
                                <?php echo e(@$package_product->giftCard->name); ?>

                            <?php else: ?>
                                <?php echo e(@$package_product->seller_product_sku->sku->product->product_name); ?>

                            <?php endif; ?>
                        </td>
                        <?php if($package_product->type == "gift_card"): ?>
                            <td><?php echo e(__('common.qty')); ?>: <?php echo e(getNumberTranslate($package_product->qty)); ?></td>
                        <?php else: ?>
                            <?php if(@$package_product->seller_product_sku->sku->product->product_type == 2): ?>
                                <td>
                                    <?php echo e(__('common.qty')); ?>: <?php echo e(getNumberTranslate( $package_product->qty)); ?>

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
                                        <?php if(getNumberTranslate($countCombinatiion > $key + 1)): ?>
                                            <br>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                            <?php else: ?>
                                <td><?php echo e(__('common.qty')); ?>: <?php echo e(getNumberTranslate($package_product->qty)); ?></td>
                            <?php endif; ?>
                        <?php endif; ?>

                        <td class="text-right"><?php echo e(single_price($package_product->price)); ?></td>
                        <td class="text-right"><?php echo e(single_price($package_product->price * $package_product->qty)); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
            <hr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>


    <script src="<?php echo e(asset(asset_path('backend/js/jquery.min.js'))); ?>"></script>
    <script type="text/javascript">
        (function($){
            "use strict";
            $(document).ready(function() {
                window.print();
            });
        })(jQuery);
    </script>
</body>
</html>
<?php /**PATH /var/www/DhatriProduction/Modules/OrderManage/Resources/views/order_manage/sale_print.blade.php ENDPATH**/ ?>