<?php $__env->startSection('styles'); ?>

<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/ordermanage/css/sale_details.css'))); ?>" />

<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <div id="add_product">
        <section class="admin-visitor-area up_st_admin_visitor">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="box_header common_table_header">
                            <div class="main-title d-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(getNumberTranslate($order->order_number)); ?> </h3>
                                <ul class="d-flex float-right">
                                    <li><a href="<?php echo e(route('order_manage.print_order_details', $order->id)); ?>"
                                            target="_blank"
                                            class="primary-btn fix-gr-bg radius_30px mr-10"><?php echo e(__('order.print')); ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 student-details">
                        <div class="white_box_50px box_shadow_white" id="printableArea">
                            <div class="row align-items-center pb-30 border-bottom row-gap-24">
                                <div class="col-md-6 col-sm-6">
                                    <div class="logo_div mx-auto mx-sm-0">
                                        <img src="<?php echo e(showImage(app('general_setting')->logo)); ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 text-sm-right text-center">
                                    <h4><?php echo e(getNumberTranslate($order->order_number)); ?></h4>
                                </div>
                            </div>
                            <div class="row mt-30">
                                <?php if($order->customer_id): ?>
                                    <div class="col-md-6 col-lg-6">
                                        <table class="table-borderless clone_line_table">
                                            <tr>
                                                <td><strong><?php echo e(__('defaultTheme.billing_info')); ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.name')); ?></td>
                                                <td>: <?php echo e(@$order->address->billing_name); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.email')); ?></td>
                                                <td><a class="link_color" href="mailto:<?php echo e(@$order->address->billing_email); ?>">:
                                                        <?php echo e(@$order->address->billing_email); ?></a></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.phone')); ?></td>
                                                <td>: <?php echo e(@getNumberTranslate($order->address->billing_phone)); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.address')); ?></td>
                                                <td>: <?php echo e(@$order->address->billing_address); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.city')); ?></td>
                                                <td>: <?php echo e(@$order->address->getBillingCity->name); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.state')); ?></td>
                                                <td>: <?php echo e(@$order->address->getBillingState->name); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.country')); ?></td>
                                                <td>: <?php echo e(@$order->address->getBillingCity->name); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.postcode')); ?></td>
                                                <td>: <?php echo e(@getNumberTranslate($order->address->billing_postcode)); ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <div class="col-md-6 col-lg-6">
                                        <table class="table-borderless clone_line_table">
                                            <tr>
                                                <td><strong><?php echo e(__('defaultTheme.billing_info')); ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.name')); ?></td>
                                                <td>: <?php echo e($order->guest_info->billing_name); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.email')); ?></td>
                                                <td><a class="link_color" href="mailto:<?php echo e($order->guest_info->billing_email); ?>">: <?php echo e($order->guest_info->billing_email); ?></a></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.phone')); ?></td>
                                                <td>: <?php echo e(getNumberTranslate($order->guest_info->billing_phone)); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.address')); ?></td>
                                                <td>: <?php echo e($order->guest_info->billing_address); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.city')); ?></td>
                                                <td>: <?php echo e(@$order->guest_info->getBillingCity->name); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.state')); ?></td>
                                                <td>: <?php echo e(@$order->guest_info->getBillingState->name); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.country')); ?></td>
                                                <td>: <?php echo e(@$order->guest_info->getBillingCountry->name); ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                <?php endif; ?>
                                <div class="col-md-6 col-lg-6">
                                    <?php if($order->customer_id): ?>
                                        <table class="table-borderless clone_line_table">
                                            <tr>
                                                <td><strong><?php echo e(__('defaultTheme.shipping_info')); ?> <?php if($order->delivery_type == 'pickup_location'): ?>(Collect from Pickup location) <?php endif; ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.name')); ?></td>
                                                <td>: <?php echo e(@$order->address->shipping_name); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.email')); ?></td>
                                                <td><a class="link_color" href="mailto:<?php echo e(@$order->address->shipping_email); ?>">:
                                                        <?php echo e(@$order->address->shipping_email); ?></a></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.phone')); ?></td>
                                                <td>: <?php echo e(getNumberTranslate(@$order->address->shipping_phone)); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.address')); ?></td>
                                                <td>: <?php echo e(@$order->address->shipping_address); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.city')); ?></td>
                                                <td>: <?php echo e(@$order->address->getShippingCity->name); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.state')); ?></td>
                                                <td>: <?php echo e(@$order->address->getShippingState->name); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.country')); ?></td>
                                                <td>: <?php echo e(@$order->address->getShippingCountry->name); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.postcode')); ?></td>
                                                <td>: <?php echo e(getNumberTranslate(@$order->address->shipping_postcode)); ?></td>
                                            </tr>
                                        </table>
                                    <?php else: ?>
                                        <table class="table-borderless clone_line_table">
                                            <tr>
                                                <td><strong><?php echo e(__('defaultTheme.shipping_info')); ?> <?php if($order->delivery_type == 'pickup_location'): ?>(Collect from Pickup location) <?php endif; ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.secret_id')); ?></td>
                                                <td>: <?php echo e($order->guest_info->guest_id); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.name')); ?></td>
                                                <td>: <?php echo e($order->guest_info->shipping_name); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.email')); ?></td>
                                                <td><a class="link_color" href="mailto:<?php echo e($order->guest_info->shipping_email); ?>">: <?php echo e($order->guest_info->shipping_email); ?></a></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.phone')); ?></td>
                                                <td>: <?php echo e(getNumberTranslate($order->guest_info->shipping_phone)); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.address')); ?></td>
                                                <td>: <?php echo e($order->guest_info->shipping_address); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.city')); ?></td>
                                                <td>: <?php echo e(@$order->guest_info->getShippingCity->name); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.state')); ?></td>
                                                <td>: <?php echo e(@$order->guest_info->getShippingState->name); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.country')); ?></td>
                                                <td>: <?php echo e(@$order->guest_info->getShippingCountry->name); ?></td>
                                            </tr>
                                        </table>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row mt-30">

                                <div class="col-md-6 col-lg-6">
                                    <table class="table-borderless clone_line_table">
                                        <tr>
                                            <td><strong><?php echo e(__('defaultTheme.payment_info')); ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('common.payment_method')); ?></td>
                                            <td>: <?php echo e($order->GatewayName); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('common.amount')); ?></td>
                                            <td>: <?php echo e(single_price(@$order->order_payment->amount)); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('order.txn_id')); ?></td>
                                            <td>: <?php echo e(@$order->order_payment->txn_id); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('common.date')); ?></td>
                                            <td>:
                                                <?php echo e(dateConvert(@$order->order_payment->created_at)); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('defaultTheme.payment_status')); ?></td>
                                            <td>:
                                                <?php if($order->is_paid == 1): ?>
                                                    <span><?php echo e(__('common.paid')); ?></span>
                                                <?php else: ?>
                                                    <span><?php echo e(__('common.pending')); ?></span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <?php if(isModuleActive('Affiliate')): ?>
                                    <?php if($order->affiliateUser): ?>
                                    <div class="col-md-6 col-lg-6">
                                        <table class="table-borderless clone_line_table">
                                            <tr>
                                                <td><strong><?php echo e(__('affiliate.affiliate_user')); ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.name')); ?></td>
                                                <td>: <a target="_blank" class="link_color" href="<?php echo e(route('affiliate.user.show',$order->affiliateUser->payment_to)); ?>"><?php echo e(@$order->affiliateUser->user->first_name); ?></a></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.email')); ?></td>
                                                <td>: <?php echo e(@$order->affiliateUser->user->email); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.phone')); ?></td>
                                                <td>: <?php echo e(@$order->affiliateUser->user->phone); ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="row mt-30">
                                <?php $__currentLoopData = $order->packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order_package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-12 mt-30">
                                        <?php if($order_package->is_cancelled == 1): ?>
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label red" for="">
                                                    <?php echo e(__('defaultTheme.order_cancelled')); ?> - (<?php echo e($order_package->package_code); ?>)
                                                </label>
                                            </div>

                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label sub-title" for="">
                                                    <?php echo e(@$order_package->cancel_reason->name); ?>

                                                </label>
                                            </div>
                                        <?php endif; ?>
                                        <div class="box_header common_table_header">
                                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('common.package')); ?>:
                                                <?php echo e(getNumberTranslate($order_package->package_code)); ?> <?php if($order_package->delivery_process): ?>
                                                    <small>(<?php echo e(@$order_package->delivery_process->name); ?>)</small>
                                                <?php endif; ?>
                                            </h3>
                                            <?php if(isModuleActive('MultiVendor')): ?>
                                            <ul class="d-flex float-right">
                                                <li>
                                                    <strong>
                                                        <?php if($order_package->seller->role->type == 'seller'): ?>
                                                            <?php echo e(@$order_package->seller->SellerAccount->seller_shop_display_name ? @$order_package->seller->SellerAccount->seller_shop_display_name : @$order_package->seller->first_name); ?>

                                                        <?php else: ?>
                                                            <?php echo e(app('general_setting')->company_name); ?>

                                                        <?php endif; ?>

                                                    </strong>
                                                </li>
                                            </ul>
                                            <?php endif; ?>
                                        </div>
                                        <div class="box_header common_table_header justify-content-lg-end">

                                            <ul class="d-flex float-right">
                                                <li> <strong><?php echo e(__('shipping.shipping_method')); ?> : <?php echo e($order_package->shipping->method_name); ?></strong></li>
                                            </ul>
                                        </div>

                                        <div class="QA_section QA_section_heading_custom check_box_table">
                                            <div class="QA_table ">
                                                <!-- table-responsive -->
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th scope="col"><?php echo e(__('common.sl')); ?></th>
                                                            <th scope="col"><?php echo e(__('common.image')); ?></th>
                                                            <th scope="col"><?php echo e(__('common.name')); ?></th>
                                                            <th scope="col"><?php echo e(__('common.details')); ?></th>
                                                            <th scope="col"><?php echo e(__('common.price')); ?></th>
                                                            <th scope="col"><?php echo e(__('common.tax')); ?>/<?php echo e(__('gst.gst')); ?></th>
                                                            <th scope="col"><?php echo e(__('common.total')); ?></th>
                                                        </tr>
                                                        <?php $__currentLoopData = $order_package->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td><?php echo e(getNumberTranslate($key + 1)); ?></td>
                                                                <td>
                                                                    <div class="product_img_div">
                                                                        <?php if($package_product->type == "gift_card"): ?>
                                                                            <img src="<?php echo e(showImage(@$package_product->giftCard->thumbnail_image)); ?>" alt="#">
                                                                        <?php else: ?>
                                                                            <?php
                                                                                $image = !empty($package_product->seller_product_sku->product->thum_img) ? $package_product->seller_product_sku->product->thum_img:$package_product->seller_product_sku->sku->product->thumbnail_image_source;
                                                                            ?>
                                                                            <?php if(@$package_product->seller_product_sku->sku->product->product_type == 1): ?>
                                                                                <img src="<?php echo e(showImage($image)); ?>"
                                                                                     alt="#">
                                                                            <?php else: ?>
                                                                            <?php
                                                                                $image = !empty($package_product->seller_product_sku->sku->variant_image) ? $package_product->seller_product_sku->sku->variant_image:$package_product->seller_product_sku->product->thum_img;
                                                                            ?>
                                                                                <img src="<?php echo e(showImage($image)); ?>"
                                                                                     alt="#">
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                <?php if($package_product->type == "gift_card"): ?>
                                                                    <span class="text-nowrap"><?php echo e(substr(@$package_product->giftCard->name,0,22)); ?> <?php if(strlen(@$package_product->giftCard->name) > 22): ?>... <?php endif; ?></span><br>
                                                                    <a class="green gift_card_div pointer" data-gift-card-id='<?php echo e($package_product->giftCard->id); ?>' data-qty='<?php echo e($package_product->qty); ?>' data-customer-mail='<?php echo e(($order->customer_id) ? $order->customer_email : $order->guest_info->shipping_email); ?>' data-order-id='<?php echo e($order->id); ?>'>
                                                                        <i class="ti-email mr-1 green"></i>
                                                                        <?php echo e(($order->gift_card_uses->where('gift_card_id', $package_product->giftCard->id)->first() != null && $order->gift_card_uses->where('gift_card_id', $package_product->giftCard->id)->first()->is_mail_sent) ? "__('order.sent_already')" : "__('order.send_code_now')"); ?>

                                                                    </a>
                                                                <?php else: ?>
                                                                    <span class="text-nowrap"><?php echo e(substr(@$package_product->seller_product_sku->sku->product->product_name,0,22)); ?> <?php if(strlen(@$package_product->seller_product_sku->sku->product->product_name) > 22): ?>... <?php endif; ?></span>
                                                                    <?php if(  @$package_product->seller_product_sku->product->product->is_physical == 0 && @$package_product->seller_product_sku->sku->digital_file): ?>
                                                                        <br><a class="green is_digital_div pointer" data-customer-id='<?php echo e($order->customer_id); ?>' data-product-sku-id='<?php echo e(@$package_product->seller_product_sku->product_sku_id); ?>' data-seller-sku-id='<?php echo e(@$package_product->seller_product_sku->id); ?>' data-seller-id='<?php echo e($order_package->seller_id); ?>' data-package-id='<?php echo e($order_package->id); ?>' data-qty='<?php echo e($package_product->qty); ?>' data-customer-mail='<?php echo e(($order->customer_id) ? @$order->address->shipping_email : @$order->guest_info->shipping_email); ?>' data-order-id='<?php echo e($order->id); ?>'><i class="ti-email mr-1 green"></i>
                                                                            <?php echo e(__('order.sent_link_to_mail')); ?>

                                                                        </a>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                                </td>
                                                                <?php if($package_product->type == "gift_card"): ?>
                                                                    <td class="text-nowrap"><?php echo e(__('common.qty')); ?>: <?php echo e(getNumberTranslate($package_product->qty)); ?></td>
                                                                <?php else: ?>
                                                                    <?php if(@$package_product->seller_product_sku->sku->product->product_type == 2): ?>
                                                                        <td class="text-nowrap">
                                                                            <?php echo e(__('common.qty')); ?>: <?php echo e(getNumberTranslate($package_product->qty)); ?>

                                                                            <br>
                                                                            <?php
                                                                                $countCombinatiion = count(@$package_product->seller_product_sku->product_variations);
                                                                            ?>
                                                                            <?php $__currentLoopData = @$package_product->seller_product_sku->product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $combination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <?php if($combination->attribute->id == 1): ?>
                                                                                    <div class="box_grid ">
                                                                                        <span><?php echo e($combination->attribute->name); ?>:</span><span class='box variant_color' style="background-color:<?php echo e($combination->attribute_value->value); ?>"></span>
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
                                                                        <td class="text-nowrap"><?php echo e(__('common.qty')); ?>: <?php echo e(getNumberTranslate($package_product->qty)); ?></td>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                                <td class="text-nowrap"><?php echo e(single_price($package_product->price)); ?></td>
                                                                <td class="text-nowrap"><?php echo e(single_price($package_product->tax_amount)); ?></td>
                                                                <td class="text-nowrap"><?php echo e(single_price($package_product->price * $package_product->qty + $package_product->tax_amount)); ?></td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="row mt-30">
                                <div class="col-md-12 col-lg-12">
                                    <table class="table-borderless clone_line_table w-100">
                                        <tr>
                                            <td><strong><?php echo e(__('order.order_info')); ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('order.is_paid')); ?></td>
                                            <td class="pl-25 text-nowrap">: <?php echo e($order->is_paid == 1 ? __('common.yes') : __('common.no')); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('order.subtotal')); ?></td>
                                            <td class="pl-25 text-nowrap">: <?php echo e(single_price($order->sub_total)); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('common.discount')); ?></td>
                                            <td class="pl-25 text-nowrap">: - <?php echo e(single_price($order->discount_total)); ?></td>
                                        </tr>
                                        <?php if($order->coupon): ?>
                                        <tr>
                                            <td><?php echo e(__('common.coupon')); ?> <?php echo e(__('common.discount')); ?></td>
                                            <td class="pl-25 text-nowrap">: - <?php echo e(single_price($order->coupon->discount_amount)); ?></td>
                                        </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <td><?php echo e(__('common.shipping_charge')); ?></td>
                                            <td class="pl-25 text-nowrap">:+ <?php echo e(single_price($order->shipping_total)); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('common.tax')); ?>/<?php echo e(__('gst.gst')); ?></td>
                                            <td class="pl-25 text-nowrap">:+ <?php echo e(single_price($order->tax_amount)); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('order.grand_total')); ?></td>
                                            <td class="pl-25 text-nowrap">: <?php echo e(single_price($order->grand_total)); ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <?php if(@$order->order_payment->payment_method == 7): ?>
                                    <div class="col-md-6 col-lg-6">
                                        <table class="table-borderless clone_line_table">
                                            <tr>
                                                <td><strong><?php echo e(__('order.bank_details')); ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.bank_name')); ?></td>
                                                <td>: <?php echo e(@$order->order_payment->item_details->bank_name); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.branch_name')); ?></td>
                                                <td>: <?php echo e(@$order->order_payment->item_details->branch_name); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.account_number')); ?></td>
                                                <td>: <?php echo e(@$order->order_payment->item_details->account_number); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('wallet.account_holder')); ?></td>
                                                <td>: <?php echo e(@$order->order_payment->item_details->account_holder); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('common.attachment')); ?></td>
                                                <td>: <a href="<?php echo e(asset(asset_path(@$order->order_payment->item_details->image_src))); ?>" target="_blank"><?php echo e(__('common.check')); ?></a> </td>
                                            </tr>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 student-details">
                        <?php if($order->is_cancelled != 1): ?>
                            <form action="<?php echo e(route('order_manage.order_update_info', $order->id)); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="row white_box p-25 ml-0 mr-0 box_shadow_white">
                                    <div class="col-lg-12 p-0">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label" for="">
                                                <strong><?php echo e(__('order.order_confirmation')); ?></strong> </label>
                                            <select class="primary_select mb-25" name="is_confirmed" id="is_confirmed">
                                                <?php if($order->is_confirmed == 1 && $order->is_completed == 1): ?>
                                                    <option value="1" <?php if($order->is_confirmed == 1): ?> selected <?php endif; ?>><?php echo e(__('order.confirmed')); ?>

                                                    </option>
                                                <?php elseif($order->is_confirmed == 1 && $order->is_completed == 0): ?>
                                                    <option value="1" <?php if($order->is_confirmed == 1): ?> selected <?php endif; ?>><?php echo e(__('order.confirmed')); ?>

                                                    </option>
                                                    <option value="2" <?php if($order->is_confirmed == 2): ?> selected <?php endif; ?>><?php echo e(__('order.declined')); ?>

                                                    </option>
                                                <?php else: ?>
                                                    <option value="0" <?php if($order->is_confirmed == 0): ?> selected <?php endif; ?>><?php echo e(__('order.pending')); ?>

                                                    </option>
                                                    <option value="1" <?php if($order->is_confirmed == 1): ?> selected <?php endif; ?>><?php echo e(__('order.confirmed')); ?>

                                                    </option>
                                                    <option value="2" <?php if($order->is_confirmed == 2): ?> selected <?php endif; ?>><?php echo e(__('order.declined')); ?>

                                                    </option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 p-0 d-none" id="cancel_reason_selector">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label" for="">
                                                <strong><?php echo e(__('common.cancel_reason')); ?></strong> </label>
                                                <select class="primary_select mb-25" name="cancel_reason_id" id="cancel_reason_id">
                                                    <option value="" selected> <?php echo e(__('common.select_cancel_reason')); ?></option>
                                                    <?php $__currentLoopData = $cancel_reasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                     <option value="<?php echo e($reason->id); ?>"><?php echo e($reason->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-0" id="is_paid_div">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label" for="">
                                                <strong><?php echo e(__('order.payment_status')); ?></strong> </label>
                                            <select class="primary_select mb-25" name="is_paid" id="is_paid">
                                                <option value="0" <?php if($order->is_paid == 0): ?> selected <?php endif; ?>><?php echo e(__('order.pending')); ?></option>
                                                <option value="1" <?php if($order->is_paid == 1): ?> selected <?php endif; ?>><?php echo e(__('order.paid')); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-0" id='is_completed_div'>
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label" for="">
                                                <strong><?php echo e(__('order.is_completed')); ?></strong> </label>
                                            <select class="primary_select mb-25" name="is_completed" id="is_completed">
                                                <option value="0" <?php if($order->is_completed == 0): ?> selected <?php endif; ?>><?php echo e(__('order.pending')); ?></option>
                                                <option value="1" <?php if($order->is_completed == 1): ?> selected <?php endif; ?>><?php echo e(__('order.complete')); ?>

                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php if(!isModuleActive('MultiVendor')): ?>
                                    <?php
                                        $package = $order->packages->first();
                                    ?>
                                    <div class="col-lg-12 p-0" id='delivery_status_div'>
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label" for="">
                                                <strong><?php echo e(__('order.delivery_status')); ?></strong></label>
                                            <select class="primary_select mb-25" name="delivery_status"
                                                id="delivery_status">
                                                <?php $__currentLoopData = $processes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $process): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($process->id); ?>" <?php if(@$package->delivery_status == $process->id): ?> selected <?php endif; ?>>
                                                        <?php echo e($process->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <input type="hidden" id="current_package_status" value="<?php echo e(@$package->delivery_status); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-0 d-none" id="delivery_note">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label" for="">
                                                <strong><?php echo e(__('order.note')); ?></strong> </label>
                                            <textarea class="primary_textarea height_112 address"
                                                placeholder="<?php echo e(__('order.note')); ?>" name="note"
                                                spellcheck="false"></textarea>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-lg-12 p-0 text-center">
                                        <button class="primary_btn_2"><i class="ti-check"></i><?php echo e(__('common.update')); ?>

                                        </button>
                                    </div>
                                </div>
                            </form>
                        <?php else: ?>
                            <div class="row white_box_50px box_shadow_white">
                                <div class="col-lg-12 p-0">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label red" for="">
                                            <?php echo e(__('defaultTheme.order_cancelled')); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12 p-0">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label sub-title" for="">
                                            <b class="f_w_500 text-uppercase"><?php echo e(__('order.reason')); ?>:</b> <?php echo e(@$order->cancel_reason->name); ?>

                                        </label>
                                        <label class="primary_input_label sub-details" for="">
                                            <b class="f_w_500 text-uppercase"><?php echo e(__('common.details')); ?>:</b> <?php echo e(@$order->cancel_reason->description); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if($order->note != null): ?>
                            <div class="row white_box p-25 ml-0 mr-0 box_shadow_white mt-20">
                                <div class="description_box">
                                    <h4 class="f_s_14 f_w_500 mb_10"><?php echo e(__('common.order')); ?> <?php echo e(__('common.note')); ?>:</h4>
                                    <p class="f_w_400">
                                        <?php echo e($order->note); ?>

                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>




                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        (function($){
            "use strict";
            $(document).ready(function(){
                $(document).on('click','.gift_card_div', function(){
                    var gift_card_id = $(this).attr("data-gift-card-id");
                    var order_id = $(this).attr("data-order-id");
                    var mail = $(this).attr("data-customer-mail");
                    var qty = $(this).attr("data-qty");
                    $(this).text('Sending.....');
                    var _this = this;
                    $.post('<?php echo e(route('send_gift_card_code_to_customer')); ?>', {_token:'<?php echo e(csrf_token()); ?>', order_id:order_id, mail:mail, gift_card_id:gift_card_id, qty:qty}, function(data){

                        if (data == "true" || data == 1) {
                            toastr.success("<?php echo e(__('common.mail_has_been_sent_successful')); ?>","<?php echo e(__('common.success')); ?>")
                            $(_this).text('Sent')
                        }else {
                            toastr.error("<?php echo e(__('common.error_message')); ?>","<?php echo e(__('common.error')); ?>");
                            $(_this).text("<?php echo e(__('order.send_code_now')); ?>")
                        }

                    }).fail(function(response) {
                        if(response.responseJSON.msg){
                            toastr.error(response.responseJSON.msg ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            $(_this).text('Already Used')
                            return false;
                        }
                    });
                });

                $(document).on('click', '.is_digital_div', function(){
                    var customer_id = $(this).attr("data-customer-id");
                    var seller_id = $(this).attr("data-seller-id");
                    var order_id = $(this).attr("data-order-id");
                    var package_id = $(this).attr("data-package-id");
                    var seller_product_sku_id = $(this).attr("data-seller-sku-id");
                    var product_sku_id = $(this).attr("data-product-sku-id");
                    var mail = $(this).attr("data-customer-mail");
                    var qty = $(this).attr("data-qty");
                    $(this).text('Sending.....');
                    var _this = this;
                    $.post('<?php echo e(route('send_digital_file_access_to_customer')); ?>', {_token:'<?php echo e(csrf_token()); ?>', customer_id:customer_id, seller_id:seller_id, order_id:order_id, package_id:package_id, seller_product_sku_id:seller_product_sku_id, product_sku_id:product_sku_id, mail:mail, qty:qty}, function(data){
                        if (data == "true" || data == 1) {
                            toastr.success("<?php echo e(__('common.mail_has_been_sent_successful')); ?>","<?php echo e(__('common.success')); ?>")
                            $(_this).text('Sent')
                        }else {
                            toastr.error("<?php echo e(__('common.error_message')); ?>","<?php echo e(__('common.error')); ?>");
                            $(_this).text("<?php echo e(__('order.send_code_now')); ?>")
                        }
                    });
                });

                $(document).on('change', '#delivery_status', function(event){
                    var current_status = $('#current_package_status').val();
                    var change_status = $('#delivery_status').val();
                    if(current_status != change_status){
                        $('#delivery_note').removeClass('d-none');
                    }else{
                        $('#delivery_note').addClass('d-none');
                    }
                });

                $(document).on('change','#is_confirmed',function(){
                    let selected_status = $(this).val();
                    if(selected_status == 2){
                        $('#cancel_reason_selector').removeClass('d-none');
                        $("#is_paid_div").addClass('d-none');
                        $("#is_completed_div").addClass('d-none');
                        $("#delivery_status_div").addClass('d-none');
                    }else{
                        $('#cancel_reason_selector').addClass('d-none');
                        $("#is_paid_div").removeClass('d-none');
                        $("#is_completed_div").removeClass('d-none');
                        $("#delivery_status_div").removeClass('d-none');
                    }
                })
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/OrderManage/Resources/views/order_manage/sale_details.blade.php ENDPATH**/ ?>