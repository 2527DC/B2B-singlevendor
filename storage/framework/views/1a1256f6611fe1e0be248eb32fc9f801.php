<style>
    .cart_thumb_div .summery_pro_content {
        max-width: calc(100% - var(--thum-width)) !important;
    }
    @media (max-width: 767.98px){
        .cart_thumb_div .summery_pro_content{
            padding-left: 20px !important;
        }

    }
    .min_hight_70{
        min-height: 100vh;
    }
</style>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('defaultTheme.checkout')); ?> <?php echo e(__('common.summary')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="amazy_dashboard_area dashboard_bg section_spacing6 min_hight_70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="white_box style2 bg-white mb_20">
                        <div class="white_box_header d-flex align-items-center gap_20 flex-wrap  amazy_bb3 justify-content-center ">
                            <div class="title text-center">
                                <h3 class="m-0"><?php echo e(__('defaultTheme.thank_you_for_your_purchase')); ?>!</h3>
                                <p><?php echo e(__('defaultTheme.your_order_number_is')); ?> <?php echo e(getNumberTranslate($order->order_number)); ?></p>
                            </div>
                        </div>
                        <div class="dashboard_white_box_body">
                            <?php $__currentLoopData = $order->packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card rounded-0 mb-3">
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap">
                                            <div class="flex-fill">
                                                <?php $__currentLoopData = $package->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($package_product->type == "gift_card"): ?>
                                                        <a href="<?php echo e(route('frontend.gift-card.show',$package_product->giftCard->sku)); ?>" class="d-flex align-items-center gap_20 w-100 flex-fill <?php if(!$loop->last): ?> amazy_bb3 <?php endif; ?> cart_thumb_div">
                                                            <div class="thumb">
                                                                <img src="<?php echo e(showImage(@$package_product->giftCard->thumbnail_image)); ?>" alt="<?php echo e(textLimit(@$package_product->giftCard->name, 28)); ?>" title="<?php echo e(textLimit(@$package_product->giftCard->name, 28)); ?>">
                                                            </div>
                                                            <div class="summery_pro_content">
                                                                <h4 class="font_16 f_w_700 m-0 theme_hover"><?php echo e(textLimit(@$package_product->giftCard->name, 28)); ?></h4>
                                                            </div>
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(singleProductURL(@$package_product->seller_product_sku->product->seller->slug, @$package_product->seller_product_sku->product->slug)); ?>" class="d-flex align-items-center gap_20 w-100 flex-fill <?php if(!$loop->last): ?> amazy_bb3 <?php endif; ?> cart_thumb_div">
                                                            <div class="thumb">
                                                                <?php if(@$package_product->seller_product_sku->sku->product->product_type == 1): ?>
                                                                    <?php
                                                                        $image = !empty($package_product->seller_product_sku->product->thum_img) ? $package_product->seller_product_sku->product->thum_img:$package_product->seller_product_sku->sku->product->thumbnail_image_source;
                                                                    ?>

                                                                    <img src="<?php echo e(showImage($image)); ?>" alt="<?php echo e(textLimit(@$package_product->seller_product_sku->product->product_name, 28)); ?>" title="<?php echo e(textLimit(@$package_product->seller_product_sku->product->product_name, 28)); ?>">
                                                                <?php else: ?>
                                                                    <?php
                                                                        $image = !empty($package_product->seller_product_sku->sku->variant_image) ? $package_product->seller_product_sku->sku->variant_image:$package_product->seller_product_sku->product->thum_img;
                                                                    ?>
                                                                    <img src="<?php echo e(showImage($image)); ?>" alt="<?php echo e(textLimit(@$package_product->seller_product_sku->product->product_name, 28)); ?>" title="<?php echo e(textLimit(@$package_product->seller_product_sku->product->product_name, 28)); ?>">
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="summery_pro_content">
                                                                <h4 class="font_16 f_w_700 m-0 theme_hover"><?php echo e(textLimit(@$package_product->seller_product_sku->product->product_name, 28)); ?></h4>
                                                                <?php if($package_product->seller_product_sku->sku->product->product_type == 2): ?>
                                                                    <p class="font_14 f_w_400 m-0">
                                                                    <?php $__currentLoopData = $package_product->seller_product_sku->product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $combination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php if($combination->attribute->id == 1): ?>
                                                                            <?php echo e($combination->attribute->name); ?>: <?php echo e($combination->attribute_value->color->name); ?>

                                                                        <?php else: ?>
                                                                            <?php echo e($combination->attribute->name); ?>: <?php echo e($combination->attribute_value->value); ?>

                                                                        <?php endif; ?>
                                                                        <?php if(!$loop->last): ?>, <?php endif; ?>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </a>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>

                                            <h4 class="font_16 f_w_500 m-0 text-capitalize"><?php echo e($package->shipping_date); ?></h4>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex justify-content-between align-items-center g-2 mb_20 flex-wrap">
                                <p><?php echo e(__('defaultTheme.for_more_details_track_your_delivery_status_order')); ?> <span class="f_w_600"><?php echo e(__('customer_panel.my_account')); ?> > <?php echo e(__('order.my_order')); ?></span></p>
                                <a href="<?php echo e(route('frontend.my_purchase_order_detail', encrypt($order->id))); ?>" class="amaz_primary_btn style2 text-nowrap "><?php echo e(__('common.view_order')); ?></a>
                            </div>
                            <div class="table-responsive mb_10">
                                <table class="table amazy_table3 style2 mb-0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p><i class="ti-email"></i> <?php echo e(__('defaultTheme.we_have_a_confirmation_email_to')); ?> <?php echo e($order->customer_email); ?> <?php echo e(__('defaultTheme.with_the_order_details')); ?></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-between align-items-center g-2 mb_20 border gray_color_1 p-3">
                                <h4 class="f_w_500 font_25 m-0 text-capitalize"><?php echo e(__('defaultTheme.order_summary')); ?></h4>
                                <span  class="f_w_500 font_20 m-0 text-capitalize secondary_text "><?php echo e(single_price($order->grand_total)); ?></span>
                            </div>
                            <div class="continue_shoping text-center">
                                <a class="amaz_primary_btn style2 text-nowrap" href="<?php echo e(route('frontend.welcome')); ?>"><?php echo e(__('defaultTheme.continue_shopping')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.amazy.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/pages/checkout_summary.blade.php ENDPATH**/ ?>