<style>
    @media (max-width:767px){
        .sumery_product_details .table-responsive table{
            width: 700px
        }
        .summery_pro_content{
            padding-left: 40px;
        }
        .font_16_top{
            padding-left: 20px;
        }
        .sumery_product_details .amazy_table3 tbody tr td{
            padding: 10px
        }
    }
</style>
<?php $__env->startSection('content'); ?>
<div class="amazy_dashboard_area dashboard_bg section_spacing6">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <?php echo $__env->make('frontend.amazy.pages.profile.partials._menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="col-xl-8 col-lg-8">
                <div class="order_tab_box d-flex justify-content-between gap-2 flex-wrap mb_20">
                    <ul class="nav amazy_order_tabs d-inline-flex" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php if(Request::get('myPurchaseOrderList') != null || (Request::get('myPurchaseOrderListNotPaid') == null && Request::get('toShipped') == null && Request::get('toRecievedList') == null)): ?> active <?php endif; ?>" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><?php echo e(__('common.all')); ?></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php if(Request::get('myPurchaseOrderListNotPaid') != null): ?> active <?php endif; ?>" id="Pay-tab" data-bs-toggle="tab" data-bs-target="#Pay" type="button" role="tab" aria-controls="Pay" aria-selected="false"><?php echo e(__('defaultTheme.to_pay')); ?></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php if(Request::get('toShipped') != null): ?> active <?php endif; ?>" id="Ship-tab" data-bs-toggle="tab" data-bs-target="#Ship" type="button" role="tab" aria-controls="Ship" aria-selected="false"><?php echo e(__('defaultTheme.to_ship')); ?></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php if(Request::get('toRecievedList') != null): ?> active <?php endif; ?>" id="Receive-tab" data-bs-toggle="tab" data-bs-target="#Receive" type="button" role="tab" aria-controls="Receive" aria-selected="false"><?php echo e(__('defaultTheme.to_recieve')); ?></button>
                        </li>
                    </ul>
                    <form class="p-0" action="<?php echo e(route('frontend.my_purchase_order_list')); ?>" method="get" id="rnForm">
                        <div class="d-flex align-items-center">
                            <select class="amaz_select5" id="rn" name="rn">
                                <?php if(isset($rn)): ?>
                                    <option value="5" <?php if($rn == 5): ?> selected <?php endif; ?>><?php echo e(__('common.last')); ?> <?php echo e(getNumberTranslate(5)); ?> <?php echo e(__('common.orders')); ?></option>
                                    <option value="10" <?php if($rn == 10): ?> selected <?php endif; ?>><?php echo e(__('common.last')); ?> <?php echo e(getNumberTranslate(10)); ?> <?php echo e(__('common.orders')); ?></option>
                                    <option value="20" <?php if($rn == 20): ?> selected <?php endif; ?>><?php echo e(__('common.last')); ?> <?php echo e(getNumberTranslate(20)); ?> <?php echo e(__('common.orders')); ?></option>
                                    <option value="40" <?php if($rn == 40): ?> selected <?php endif; ?>><?php echo e(__('common.last')); ?> <?php echo e(getNumberTranslate(40)); ?> <?php echo e(__('common.orders')); ?></option>
                                <?php else: ?>
                                    <option value="5"><?php echo e(__('common.last')); ?> <?php echo e(getNumberTranslate(5)); ?> <?php echo e(__('common.orders')); ?></option>
                                    <option value="10"><?php echo e(__('common.last')); ?> <?php echo e(getNumberTranslate(10)); ?> <?php echo e(__('common.orders')); ?></option>
                                    <option value="20"><?php echo e(__('common.last')); ?> <?php echo e(getNumberTranslate(20)); ?> <?php echo e(__('common.orders')); ?></option>
                                    <option value="40"><?php echo e(__('common.last')); ?> <?php echo e(getNumberTranslate(40)); ?> <?php echo e(__('common.orders')); ?></option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </form>
                </div>
                <!-- tab-content  -->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade <?php if(Request::get('myPurchaseOrderList') != null || (Request::get('myPurchaseOrderListNotPaid') == null && Request::get('toShipped') == null && Request::get('toRecievedList') == null)): ?> show active <?php endif; ?>" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <?php if(count($orders) > 0): ?>

                            <!-- content ::start  -->
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="white_box style2 bg-white mb_20">
                                    <div class="white_box_header d-flex align-items-center gap_20 flex-wrap  amazy_bb3 justify-content-between ">
                                        <div class="d-flex flex-column  ">
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('common.order_id')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(getNumberTranslate($order->order_number)); ?></p>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('defaultTheme.order_date')); ?> : </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(getNumberTranslate($order->created_at)); ?></p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column ">
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('common.status')); ?>: </h4>
                                                <p class="font_14 f_w_400 m-0 lh-base">
                                                    <?php if($order->is_cancelled == 1): ?>
                                                        <?php echo e(__('common.cancelled')); ?>

                                                    <?php elseif($order->is_completed == 1): ?>
                                                        <?php echo e(__('common.completed')); ?>

                                                    <?php else: ?>
                                                        <?php if($order->is_confirmed == 1): ?>
                                                            <?php echo e(__('common.confirmed')); ?>

                                                        <?php elseif($order->is_confirmed == 2): ?>
                                                            <?php echo e(__('common.declined')); ?>

                                                        <?php else: ?>
                                                            <?php echo e(__('common.pending')); ?>

                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('defaultTheme.order_amount')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(single_price($order->grand_total)); ?></p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column  ">
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('defaultTheme.paid_by')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e($order->GatewayName); ?></p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column  ">
                                            <a download="" class="amaz_primary_btn gray_bg_btn min_200 radius_3px" href="<?php echo e(route('frontend.my_purchase_order_pdf', encrypt($order->id))); ?>" target="_blank"><?php echo e(__('defaultTheme.download_invoice')); ?></a>
                                        </div>
                                    </div>
                                    <div class="dashboard_white_box_body">
                                        <div class="table-responsive mb_10">
                                            <table class="table amazy_table3 style2 mb-0">
                                                <tbody>
                                                    <?php $__currentLoopData = $order->packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php $__currentLoopData = $package->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($package_product->type == "gift_card"): ?>
                                                                <tr>
                                                                    <td>
                                                                        <a href="<?php echo e(route('frontend.gift-card.show',@$package_product->giftCard->sku)); ?>" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                                            <div class="thumb">
                                                                                <img src="<?php echo e(showImage(@$package_product->giftCard->thumbnail_image)); ?>" alt="<?php echo e(textLimit(@$package_product->giftCard->name,22)); ?>" title="<?php echo e(textLimit(@$package_product->giftCard->name,22)); ?>">
                                                                            </div>
                                                                            <div class="summery_pro_content">
                                                                                <h4 class="font_16 f_w_700 text-nowrap m-0 theme_hover"><?php echo e(textLimit(@$package_product->giftCard->name,22)); ?></h4>
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                    <td>

                                                                    </td>
                                                                    <td>
                                                                        <h4 class="font_16_top f_w_500 m-0 text-nowrap"><?php echo e(__('common.qty')); ?>: <?php echo e(getNumberTranslate($package_product->qty)); ?></h4>
                                                                    </td>
                                                                    <td>
                                                                        <h4 class="font_16 f_w_500 m-0 text-nowrap"><?php echo e(single_price($package_product->price)); ?></h4>
                                                                    </td>
                                                                </tr>
                                                            <?php else: ?>
                                                                <tr>
                                                                    <td>
                                                                        <a href="<?php echo e(singleProductURL(@$package_product->seller_product_sku->product->seller->slug, @$package_product->seller_product_sku->product->slug)); ?>" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                                            <div class="thumb">
                                                                                <?php if(@$package_product->seller_product_sku->sku->product->product_type == 1): ?>

                                                                                <?php
                                                                                    $image = !empty($package_product->seller_product_sku->product->thum_img) ? $package_product->seller_product_sku->product->thum_img:$package_product->seller_product_sku->sku->product->thumbnail_image_source;
                                                                                ?>
                                                                                    <img src="<?php echo e(showImage($image)); ?>" alt="<?php if(@$package_product->seller_product_sku->product->product_name): ?> <?php echo e(textLimit(@$package_product->seller_product_sku->product->product_name,22)); ?> <?php else: ?> <?php echo e(textLimit(@$package_product->seller_product_sku->sku->product->product_name,22)); ?> <?php endif; ?>" title="<?php if(@$package_product->seller_product_sku->product->product_name): ?> <?php echo e(textLimit(@$package_product->seller_product_sku->product->product_name,22)); ?> <?php else: ?> <?php echo e(textLimit(@$package_product->seller_product_sku->sku->product->product_name,22)); ?> <?php endif; ?>">
                                                                                <?php else: ?>
                                                                                <?php
                                                                                    $image = !empty($package_product->seller_product_sku->sku->variant_image) ? $package_product->seller_product_sku->sku->variant_image:$package_product->seller_product_sku->product->thum_img;
                                                                                ?>
                                                                                    <img src="<?php echo e(showImage($image)); ?>" alt="<?php if(@$package_product->seller_product_sku->product->product_name): ?> <?php echo e(textLimit(@$package_product->seller_product_sku->product->product_name,22)); ?> <?php else: ?> <?php echo e(textLimit(@$package_product->seller_product_sku->sku->product->product_name,22)); ?> <?php endif; ?>" title="<?php if(@$package_product->seller_product_sku->product->product_name): ?> <?php echo e(textLimit(@$package_product->seller_product_sku->product->product_name,22)); ?> <?php else: ?> <?php echo e(textLimit(@$package_product->seller_product_sku->sku->product->product_name,22)); ?> <?php endif; ?>">
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            <div class="summery_pro_content">
                                                                                <h4 class="font_16 f_w_700 text-nowrap m-0 theme_hover"><?php if(@$package_product->seller_product_sku->product->product_name): ?> <?php echo e(textLimit(@$package_product->seller_product_sku->product->product_name,22)); ?> <?php else: ?> <?php echo e(textLimit(@$package_product->seller_product_sku->sku->product->product_name,22)); ?> <?php endif; ?></h4>
                                                                                <?php if(@$package_product->seller_product_sku->sku->product->product_type == 2): ?>
                                                                                    <p class="font_14 f_w_400 m-0 ">
                                                                                        <?php
                                                                                            $countCombinatiion = count(@$package_product->seller_product_sku->product_variations);
                                                                                        ?>
                                                                                        <?php $__currentLoopData = @$package_product->seller_product_sku->product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $combination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                                                    </td>
                                                                    <td>

                                                                    </td>
                                                                    <td>
                                                                        <h4 class="font_16_top f_w_500 m-0 text-nowrap"><?php echo e(__('common.qty')); ?>: <?php echo e(getNumberTranslate($package_product->qty)); ?></h4>
                                                                    </td>
                                                                    <td>
                                                                        <h4 class="font_16 f_w_500 m-0 text-nowrap"><?php echo e(single_price($package_product->price)); ?></h4>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="d-flex justify-content-end flex-wrap gap_10">
                                            <a href="<?php echo e(route('frontend.my_purchase_order_detail', encrypt($order->id))); ?>" class="amaz_primary_btn style2 text-nowrap "><?php echo e(__('defaultTheme.order_details')); ?></a>
                                            <?php if($order->is_confirmed == 0): ?>
                                                <?php if($order->is_cancelled == 0): ?>
                                                    <a data-id=<?php echo e($order->id); ?> class="amaz_primary_btn gray_bg_btn min_200 radius_3px ml_10 order_cancel_by_id" href=""><?php echo e(__('defaultTheme.cancel_order')); ?></a>
                                                <?php else: ?>
                                                    <a class="amaz_primary_btn gray_bg_btn min_200 radius_3px ml_10" disabled><?php echo e(__('defaultTheme.order_cancelled')); ?></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <!-- content ::end    -->
                            <?php if(strpos($_SERVER['REQUEST_URI'], 'rn')): ?>
                                <?php echo $__env->make(theme('pages.profile.partials.paginations'), ['orders' => $orders->appends('rn',$rn), 'request_type' => request()->myPurchaseOrderList], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make(theme('pages.profile.partials.paginations'), ['orders' => $orders, 'request_type' => request()->myPurchaseOrderList], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="row">
                                <div class="col-lg-12 empty_list">
                                    <span class="text-canter"><?php echo e(__('order.no_order_found')); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="tab-pane fade <?php if(Request::get('myPurchaseOrderListNotPaid') != null): ?> show active <?php endif; ?>" id="Pay" role="tabpanel" aria-labelledby="Pay-tab">
                        <?php if(count($no_paid_orders) > 0): ?>
                            <?php $__currentLoopData = $no_paid_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $no_paid_order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <!-- content ::start  -->
                                <div class="white_box style2 bg-white mb_20">
                                    <div class="white_box_header d-flex align-items-center gap_20 flex-wrap  amazy_bb3 justify-content-between ">
                                        <div class="d-flex flex-column  ">
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('common.order_id')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(getNumberTranslate($no_paid_order->order_number)); ?></p>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('defaultTheme.order_date')); ?> : </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(getNumberTranslate($no_paid_order->created_at)); ?></p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column ">
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('common.status')); ?>: </h4>
                                                <p class="font_14 f_w_400 m-0 lh-base">
                                                    <?php if($no_paid_order->is_cancelled == 1): ?>
                                                        <?php echo e(__('common.cancelled')); ?>

                                                    <?php elseif($no_paid_order->is_completed == 1): ?>
                                                        <?php echo e(__('common.completed')); ?>

                                                    <?php else: ?>
                                                        <?php if($no_paid_order->is_confirmed == 1): ?>
                                                            <?php echo e(__('common.status')); ?></span>: <?php echo e(__('common.confirmed')); ?>

                                                        <?php elseif($no_paid_order->is_confirmed == 2): ?>
                                                            <?php echo e(__('common.status')); ?></span>: <?php echo e(__('common.declined')); ?>

                                                        <?php else: ?>
                                                            <?php echo e(__('common.status')); ?></span>: <?php echo e(__('common.pending')); ?>

                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('defaultTheme.order_amount')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(single_price($no_paid_order->grand_total)); ?></p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column  ">
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('defaultTheme.paid_by')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(@$no_paid_order->GatewayName); ?></p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column  ">
                                            <a href="<?php echo e(route('frontend.my_purchase_order_pdf', encrypt($no_paid_order->id))); ?>" download="" target="_blank" class="amaz_primary_btn gray_bg_btn min_200 radius_3px">+ <?php echo e(__('defaultTheme.download_invoice')); ?></a>
                                        </div>
                                    </div>
                                    <div class="dashboard_white_box_body">
                                        <div class="table-responsive mb_10">
                                            <table class="table amazy_table3 style2 mb-0">
                                                <tbody>
                                                    <?php $__currentLoopData = $no_paid_order->packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php $__currentLoopData = $package->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($package_product->type == "gift_card"): ?>
                                                                <tr>
                                                                    <td>
                                                                        <a href="<?php echo e(route('frontend.gift-card.show',@$package_product->giftCard->sku)); ?>" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                                            <div class="thumb">
                                                                                <img src="<?php echo e(showImage(@$package_product->giftCard->thumbnail_image)); ?>" alt="<?php echo e(textLimit(@$package_product->giftCard->name,22)); ?>" title="<?php echo e(textLimit(@$package_product->giftCard->name,22)); ?>">
                                                                            </div>
                                                                            <div class="summery_pro_content">
                                                                                <h4 class="font_16 f_w_700 text-nowrap m-0 theme_hover"><?php echo e(textLimit(@$package_product->giftCard->name,22)); ?></h4>
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                    <td>

                                                                    </td>
                                                                    <td>
                                                                        <h4 class="font_16_top f_w_500 m-0 "><?php echo e(__('common.qty')); ?>: <?php echo e(getNumberTranslate($package_product->qty)); ?></h4>
                                                                    </td>
                                                                    <td>
                                                                        <h4 class="font_16 f_w_500 m-0 "><?php echo e(single_price($package_product->price)); ?></h4>
                                                                    </td>
                                                                </tr>
                                                            <?php else: ?>
                                                                <tr>
                                                                    <td>
                                                                        <a href="<?php echo e(singleProductURL(@$package_product->seller_product_sku->product->seller->slug, @$package_product->seller_product_sku->product->slug)); ?>" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                                            <div class="thumb">
                                                                                <?php if(@$package_product->seller_product_sku->sku->product->product_type == 1): ?>
                                                                                    <img src="<?php echo e(showImage(@$package_product->seller_product_sku->product->thum_img??@$package_product->seller_product_sku->sku->product->thumbnail_image_source)); ?>" alt="<?php echo e(@$package_product->seller_product_sku->product->product_name?textLimit(@$package_product->seller_product_sku->product->product_name,22):textLimit(@$package_product->seller_product_sku->sku->product->product_name,22)); ?>" title="<?php echo e(@$package_product->seller_product_sku->product->product_name?textLimit(@$package_product->seller_product_sku->product->product_name,22):textLimit(@$package_product->seller_product_sku->sku->product->product_name,22)); ?>">
                                                                                <?php else: ?>

                                                                                    <img src="<?php echo e(showImage((@$package_product->seller_product_sku->sku->variant_image?@$package_product->seller_product_sku->sku->variant_image:@$package_product->seller_product_sku->product->thum_img)??@$package_product->seller_product_sku->product->product->thumbnail_image_source)); ?>" title="<?php echo e(@$package_product->seller_product_sku->product->product_name?textLimit(@$package_product->seller_product_sku->product->product_name,22):textLimit(@$package_product->seller_product_sku->sku->product->product_name,22)); ?>" alt="<?php echo e(@$package_product->seller_product_sku->product->product_name?textLimit(@$package_product->seller_product_sku->product->product_name,22):textLimit(@$package_product->seller_product_sku->sku->product->product_name,22)); ?>">
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            <div class="summery_pro_content">
                                                                                <h4 class="font_16 f_w_700 text-nowrap m-0 theme_hover"><?php echo e(@$package_product->seller_product_sku->product->product_name?textLimit(@$package_product->seller_product_sku->product->product_name,22):textLimit(@$package_product->seller_product_sku->sku->product->product_name,22)); ?></h4>
                                                                                <?php if($package_product->seller_product_sku->sku->product->product_type == 2): ?>
                                                                                <p class="font_14 f_w_400 m-0 ">
                                                                                    <?php
                                                                                        $countCombinatiion = count(@$package_product->seller_product_sku->product_variations);
                                                                                    ?>
                                                                                    <?php $__currentLoopData = @$package_product->seller_product_sku->product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $combination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <?php if($combination->attribute->id == 1): ?>
                                                                                            <?php echo e($combination->attribute->name); ?>: <?php echo e($combination->attribute_value->color->name); ?>

                                                                                        <?php else: ?>
                                                                                            <?php echo e($combination->attribute->name); ?>: <?php echo e($combination->attribute_value->value); ?>

                                                                                        <?php endif; ?>

                                                                                        <?php if($countCombinatiion > $key +1): ?>
                                                                                            ,
                                                                                        <?php endif; ?>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                </p>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                    <td>

                                                                    </td>
                                                                    <td>
                                                                        <h4 class="font_16_top f_w_500 m-0 "><?php echo e(__('common.qty')); ?>: <?php echo e(getNumberTranslate($package_product->qty)); ?></h4>
                                                                    </td>
                                                                    <td>
                                                                        <h4 class="font_16 f_w_500 m-0 "><?php echo e(single_price($package_product->price)); ?></h4>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <a href="<?php echo e(route('frontend.my_purchase_order_detail', encrypt($no_paid_order->id))); ?>" class="amaz_primary_btn style2 text-nowrap "><?php echo e(__('defaultTheme.order_details')); ?></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- content ::end    -->
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make(theme('pages.profile.partials.paginations'), ['orders' => $no_paid_orders, 'request_type' => request()->myPurchaseOrderListNotPaid], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php else: ?>
                            <div class="row">
                                <div class="col-lg-12 empty_list">
                                    <span class="text-canter"><?php echo e(__('order.no_order_found')); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="tab-pane fade <?php if(Request::get('toShipped') != null): ?> show active <?php endif; ?>" id="Ship" role="tabpanel" aria-labelledby="Ship-tab">
                        <?php if(count($to_shippeds) > 0): ?>
                            <?php $__currentLoopData = $to_shippeds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order_package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <!-- content ::start  -->
                                <div class="white_box style2 bg-white mb_20">
                                    <div class="white_box_header d-flex align-items-center gap_20 flex-wrap  amazy_bb3 justify-content-between ">
                                        <div class="d-flex flex-column  ">
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('common.order_id')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(getNumberTranslate(@$order_package->order->order_number)); ?></p>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('defaultTheme.order_date')); ?> : </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(getNumberTranslate(@$order_package->order->created_at)); ?></p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column ">
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('common.status')); ?>: </h4>
                                                <p class="font_14 f_w_400 m-0 lh-base">
                                                    <?php if(@$order_package->order->is_cancelled == 1): ?>
                                                        <?php echo e(__('common.cancelled')); ?>

                                                    <?php elseif(@$order_package->order->is_completed == 1): ?>
                                                        <?php echo e(__('common.completed')); ?>

                                                    <?php else: ?>
                                                        <?php if(@$order_package->order->is_confirmed == 1): ?>
                                                            <?php echo e(__('common.confirmed')); ?>

                                                        <?php elseif(@$order_package->order->is_confirmed == 2): ?>
                                                            <?php echo e(__('common.declined')); ?>

                                                        <?php else: ?>
                                                            <?php echo e(__('common.pending')); ?>

                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('defaultTheme.order_amount')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(single_price(@$order_package->order->grand_total)); ?></p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column  ">
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('defaultTheme.paid_by')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(@$order_package->order->GatewayName); ?></p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column  ">
                                            <a href="<?php echo e(route('frontend.my_purchase_order_pdf', encrypt(@$order_package->order->id))); ?>" download="" target="_blank" class="amaz_primary_btn gray_bg_btn min_200 radius_3px">+ <?php echo e(__('defaultTheme.download_invoice')); ?></a>
                                        </div>
                                    </div>
                                    <div class="dashboard_white_box_body">
                                        <div class="table-responsive mb_10">
                                            <table class="table amazy_table3 style2 mb-0">
                                                <tbody>
                                                    <?php $__currentLoopData = $order_package->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($package_product->type == "gift_card"): ?>
                                                            <tr>
                                                                <td>
                                                                    <a href="<?php echo e(route('frontend.gift-card.show',@$package_product->giftCard->sku)); ?>" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                                        <div class="thumb">
                                                                            <img src="<?php echo e(showImage(@$package_product->giftCard->thumbnail_image)); ?>" alt="<?php echo e(textLimit(@$package_product->giftCard->name,22)); ?>" title="<?php echo e(textLimit(@$package_product->giftCard->name,22)); ?>">
                                                                        </div>
                                                                        <div class="summery_pro_content">
                                                                            <h4 class="font_16 f_w_700 text-nowrap m-0 theme_hover"><?php echo e(textLimit(@$package_product->giftCard->name,22)); ?></h4>
                                                                        </div>
                                                                    </a>
                                                                </td>
                                                                <td></td>
                                                                <td>
                                                                    <h4 class="font_16_top f_w_500 m-0 "><?php echo e(__('common.qty')); ?>: <?php echo e(getNumberTranslate($package_product->qty)); ?></h4>
                                                                </td>
                                                                <td>
                                                                    <h4 class="font_16 f_w_500 m-0 "> <?php echo e(single_price($package_product->price)); ?></h4>
                                                                </td>
                                                            </tr>
                                                        <?php else: ?>
                                                            <tr>
                                                                <td>
                                                                    <a href="<?php echo e(singleProductURL(@$package_product->seller_product_sku->product->seller->slug, @$package_product->seller_product_sku->product->slug)); ?>" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                                        <div class="thumb">
                                                                            <?php if(@$package_product->seller_product_sku->sku->product->product_type == 1): ?>
                                                                                <img src="<?php echo e(showImage(@$package_product->seller_product_sku->product->thum_img??@$package_product->seller_product_sku->sku->product->thumbnail_image_source)); ?>" alt="<?php echo e(@$package_product->seller_product_sku->product->product_name?textLimit(@$package_product->seller_product_sku->product->product_name,22):textLimit(@$package_product->seller_product_sku->sku->product->product_name,22)); ?>" title="<?php echo e(@$package_product->seller_product_sku->product->product_name?textLimit(@$package_product->seller_product_sku->product->product_name,22):textLimit(@$package_product->seller_product_sku->sku->product->product_name,22)); ?>">
                                                                            <?php else: ?>

                                                                                <img src="<?php echo e(showImage((@$package_product->seller_product_sku->sku->variant_image?@$package_product->seller_product_sku->sku->variant_image:@$package_product->seller_product_sku->product->thum_img)??@$package_product->seller_product_sku->product->product->thumbnail_image_source)); ?>" alt="<?php echo e(@$package_product->seller_product_sku->product->product_name?textLimit(@$package_product->seller_product_sku->product->product_name,22):textLimit(@$package_product->seller_product_sku->sku->product->product_name,22)); ?>" title="<?php echo e(@$package_product->seller_product_sku->product->product_name?textLimit(@$package_product->seller_product_sku->product->product_name,22):textLimit(@$package_product->seller_product_sku->sku->product->product_name,22)); ?>">
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <div class="summery_pro_content">
                                                                            <h4 class="font_16 f_w_700 text-nowrap m-0 theme_hover"><?php echo e(@$package_product->seller_product_sku->product->product_name?textLimit(@$package_product->seller_product_sku->product->product_name,22):textLimit(@$package_product->seller_product_sku->sku->product->product_name,22)); ?></h4>
                                                                            <?php if($package_product->seller_product_sku->sku->product->product_type == 2): ?>
                                                                                <p class="font_14 f_w_400 m-0 ">
                                                                                    <?php
                                                                                        $countCombinatiion = count(@$package_product->seller_product_sku->product_variations);
                                                                                    ?>
                                                                                    <?php $__currentLoopData = @$package_product->seller_product_sku->product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $combination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <?php if($combination->attribute->id == 1): ?>
                                                                                            <?php echo e($combination->attribute->name); ?>: <?php echo e($combination->attribute_value->color->name); ?>

                                                                                        <?php else: ?>
                                                                                            <?php echo e($combination->attribute->name); ?>: <?php echo e($combination->attribute_value->value); ?>

                                                                                        <?php endif; ?>

                                                                                        <?php if($countCombinatiion > $key +1): ?>
                                                                                            ,
                                                                                        <?php endif; ?>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                </p>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </a>
                                                                </td>
                                                                <td></td>
                                                                <td>
                                                                    <h4 class="font_16_top f_w_500 m-0 "><?php echo e(__('common.qty')); ?>: <?php echo e(getNumberTranslate($package_product->qty)); ?></h4>
                                                                </td>
                                                                <td>
                                                                    <h4 class="font_16 f_w_500 m-0 "><?php echo e(single_price($package_product->price)); ?></h4>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <a href="<?php echo e(route('frontend.my_purchase_order_detail', encrypt($order_package->order->id))); ?>" class="amaz_primary_btn style2 text-nowrap "><?php echo e(__('defaultTheme.order_details')); ?></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- content ::end    -->
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make(theme('pages.profile.partials.paginations'), ['orders' => $to_shippeds, 'request_type' => request()->toShipped], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php else: ?>
                            <div class="row">
                                <div class="col-lg-12 empty_list">
                                    <span class="text-canter"><?php echo e(__('order.no_order_found')); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="tab-pane fade <?php if(Request::get('toRecievedList') != null): ?> show active <?php endif; ?>" id="Receive" role="tabpanel" aria-labelledby="Receive-tab">
                        <?php if(count($to_recieves) > 0): ?>
                            <?php $__currentLoopData = $to_recieves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order_package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <!-- content ::start  -->
                                <div class="white_box style2 bg-white mb_20">
                                    <div class="white_box_header d-flex align-items-center gap_20 flex-wrap  amazy_bb3 justify-content-between ">
                                        <div class="d-flex flex-column  ">
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('common.order_id')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(@$order_package->order->order_number); ?></p>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('defaultTheme.order_date')); ?> : </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(@$order_package->order->created_at); ?></p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column ">
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('common.status')); ?>: </h4>
                                                <p class="font_14 f_w_400 m-0 lh-base">
                                                    <?php if(@$order_package->order->is_cancelled == 1): ?>
                                                        <?php echo e(__('common.cancelled')); ?>

                                                    <?php elseif(@$order_package->order->is_completed == 1): ?>
                                                        <?php echo e(__('common.completed')); ?>

                                                    <?php else: ?>
                                                        <?php if(@$order_package->order->is_confirmed == 1): ?>
                                                            <?php echo e(__('common.confirmed')); ?>

                                                        <?php elseif(@$order_package->order->is_confirmed == 2): ?>
                                                            <?php echo e(__('common.declined')); ?>

                                                        <?php else: ?>
                                                            <?php echo e(__('common.pending')); ?>

                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('defaultTheme.order_amount')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(single_price($order_package->order->grand_total)); ?></p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column  ">
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('defaultTheme.paid_by')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(@$order_package->order->GatewayName); ?></p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column  ">
                                            <a download="" href="<?php echo e(route('frontend.my_purchase_order_pdf', encrypt(@$order_package->order->id))); ?>" target="_blank" class="amaz_primary_btn gray_bg_btn min_200 radius_3px">+ <?php echo e(__('defaultTheme.download_invoice')); ?></a>
                                        </div>
                                    </div>
                                    <div class="dashboard_white_box_body">
                                        <div class="table-responsive mb_10">
                                            <table class="table amazy_table3 style2 mb-0">
                                                <tbody>
                                                    <?php $__currentLoopData = $order_package->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($package_product->type == "gift_card"): ?>
                                                            <tr>
                                                                <td>
                                                                    <a href="<?php echo e(route('frontend.gift-card.show',@$package_product->giftCard->sku)); ?>" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                                        <div class="thumb">
                                                                            <img src="<?php echo e(showImage(@$package_product->giftCard->thumbnail_image)); ?>" alt="<?php echo e(textLimit(@$package_product->giftCard->name,22)); ?>" title="<?php echo e(textLimit(@$package_product->giftCard->name,22)); ?>">
                                                                        </div>
                                                                        <div class="summery_pro_content">
                                                                            <h4 class="font_16 f_w_700 text-nowrap m-0 theme_hover"><?php echo e(textLimit(@$package_product->giftCard->name,22)); ?></h4>
                                                                        </div>
                                                                    </a>
                                                                </td><td>
                                                                </td>
                                                                <td>
                                                                    <h4 class="font_16_top f_w_500 m-0 "><?php echo e(__('common.qty')); ?>: <?php echo e(getNumberTranslate($package_product->qty)); ?></h4>
                                                                </td>
                                                                <td>
                                                                    <h4 class="font_16 f_w_500 m-0 "><?php echo e(single_price($package_product->price)); ?></h4>
                                                                </td>
                                                            </tr>
                                                        <?php else: ?>
                                                            <tr>
                                                                <td>
                                                                    <a href="<?php echo e(singleProductURL(@$package_product->seller_product_sku->product->seller->slug, @$package_product->seller_product_sku->product->slug)); ?>" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                                        <div class="thumb">
                                                                            <?php if(@$package_product->seller_product_sku->sku->product->product_type == 1): ?>
                                                                                <img src="<?php echo e(showImage(@$package_product->seller_product_sku->product->thum_img??@$package_product->seller_product_sku->sku->product->thumbnail_image_source)); ?>" alt="<?php echo e(@$package_product->seller_product_sku->product->product_name?textLimit(@$package_product->seller_product_sku->product->product_name,22):textLimit(@$package_product->seller_product_sku->sku->product->product_name,22)); ?>" title="<?php echo e(@$package_product->seller_product_sku->product->product_name?textLimit(@$package_product->seller_product_sku->product->product_name,22):textLimit(@$package_product->seller_product_sku->sku->product->product_name,22)); ?>">
                                                                            <?php else: ?>
                                                                                <img src="<?php echo e(showImage((@$package_product->seller_product_sku->sku->variant_image?@$package_product->seller_product_sku->sku->variant_image:@$package_product->seller_product_sku->product->thum_img)??@$package_product->seller_product_sku->product->product->thumbnail_image_source)); ?>" alt="<?php echo e(@$package_product->seller_product_sku->product->product_name?textLimit(@$package_product->seller_product_sku->product->product_name,22):textLimit(@$package_product->seller_product_sku->sku->product->product_name,22)); ?>" title="<?php echo e(@$package_product->seller_product_sku->product->product_name?textLimit(@$package_product->seller_product_sku->product->product_name,22):textLimit(@$package_product->seller_product_sku->sku->product->product_name,22)); ?>">
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <div class="summery_pro_content">
                                                                            <h4 class="font_16 f_w_700 text-nowrap m-0 theme_hover"><?php echo e(@$package_product->seller_product_sku->product->product_name?textLimit(@$package_product->seller_product_sku->product->product_name,22):textLimit(@$package_product->seller_product_sku->sku->product->product_name,22)); ?></h4>
                                                                            <?php if($package_product->seller_product_sku->sku->product->product_type == 2): ?>
                                                                                <p class="font_14 f_w_400 m-0 ">
                                                                                    <?php
                                                                                        $countCombinatiion = count(@$package_product->seller_product_sku->product_variations);
                                                                                    ?>
                                                                                    <?php $__currentLoopData = @$package_product->seller_product_sku->product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $combination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <?php if($combination->attribute->id == 1): ?>
                                                                                            <?php echo e($combination->attribute->name); ?>: <?php echo e($combination->attribute_value->color->name); ?>

                                                                                        <?php else: ?>
                                                                                            <?php echo e($combination->attribute->name); ?>: <?php echo e($combination->attribute_value->value); ?>

                                                                                        <?php endif; ?>

                                                                                        <?php if($countCombinatiion > $key +1): ?>
                                                                                            ,
                                                                                        <?php endif; ?>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                </p>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </a>
                                                                </td>
                                                                <td></td>
                                                                <td>
                                                                    <h4 class="font_16_top f_w_500 m-0 "><?php echo e(__('common.qty')); ?>: <?php echo e(getNumberTranslate($package_product->qty)); ?></h4>
                                                                </td>
                                                                <td>
                                                                    <h4 class="font_16 f_w_500 m-0 "><?php echo e(single_price($package_product->price)); ?></h4>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="d-flex justify-content-end flex-wrap gap_10">
                                            <a href="<?php echo e(route('frontend.my_purchase_order_detail', encrypt($order_package->order->id))); ?>" class="amaz_primary_btn style2 text-nowrap "><?php echo e(__('defaultTheme.order_details')); ?></a>
                                            <?php if(\Carbon\Carbon::now() <= $order_package->order->created_at->addDays(app('business_settings')->where('type', 'refund_times')->first()->status) && $order->is_cancelled == 0 && $order->is_completed == 1): ?>
                                                <a href="<?php echo e(route('refund.make_request', encrypt($order_package->order->id))); ?>" class="amaz_primary_btn gray_bg_btn min_200 radius_3px ml_10"><?php echo e(__('defaultTheme.open_dispute')); ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- content ::end    -->
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make(theme('pages.profile.partials.paginations'), ['orders' => $to_recieves, 'request_type' => request()->toRecievedList], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php else: ?>
                            <div class="row">
                                <div class="col-lg-12 empty_list">
                                    <span class="text-canter"><?php echo e(__('order.no_order_found')); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- cancel order modal -->
    <div class="modal fade login_modal about_modal" id="orderCancelReasonModal" tabindex="-1" role="dialog" aria-labelledby="asq_about_form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                <div data-bs-dismiss="modal" class="close_modal">
                    <i class="ti-close"></i>
                </div>
                <!-- infix_login_area::start  -->
                    <div class="infix_login_area p-0">
                        <div class="login_area_inner">
                            <h3 class="sign_up_text mb_20 fs-5"><?php echo e(__('common.select_cancel_reason')); ?></h3>
                            <form action="<?php echo e(route('frontend.order_cancel_by_customer')); ?>" method="post" id="order_cancel_form">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-12 mb_30">
                                        <div class="form-group input_div_mb">
                                            <label class="primary_label2 style4"><?php echo e(__('refund.reason')); ?> <span>*</span></label>
                                            <select class="primary_input3 radius_3px style6" name="reason" id="reason" autocomplete="off">
                                                <?php $__currentLoopData = $cancel_reasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cancel_reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($cancel_reason->id); ?>"><?php echo e($cancel_reason->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <input type="hidden" id="order_id" name="order_id" class="form-control order_id" required>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="home10_primary_btn2 text-center f_w_700"><?php echo e(__('common.send')); ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- infix_login_area::end  -->

                </div>
            </div>
        </div>
    </div>
    <!-- cancel order modal -->
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>

        (function($){
            "use strict";

            $(document).ready(function(){
                $(document).on('click', '.change_delivery_state_status', function(event){
                    event.preventDefault();
                    let package_id = $(this).data('package_id');
                    change_delivery_state_status(package_id);
                });

                function change_delivery_state_status(el)
                {
                    $("#pre-loader").show();
                    $.post('<?php echo e(route('change_delivery_status_by_customer')); ?>', {_token:'<?php echo e(csrf_token()); ?>', package_id:el}, function(data){
                        if (data == 1) {
                            toastr.success("<?php echo e(__('defaultTheme.order_has_been_recieved')); ?>", "<?php echo e(__('common.success')); ?>");
                        }else {
                            toastr.error("<?php echo e(__('defaultTheme.order_not_recieved')); ?> <?php echo e(__('common.error_message')); ?>", "<?php echo e(__('common.error')); ?>");
                        }
                        $("#pre-loader").hide();
                    });
                }

                $(document).on('change', '#rn', function(){    // 2nd (A)
                    $("#rnForm").submit();
                });

                $('#reason').niceSelect();
                $(document).on('click','.order_cancel_by_id', function(e){
                    e.preventDefault();
                    $('#orderCancelReasonModal').modal('show');
                    $('.order_id').val($(this).attr('data-id'));
                });

                $(document).on('submit', '#order_cancel_form', function(){
                    $("#pre-loader").show();
                    $('#orderCancelReasonModal').modal('hide');
                });
            });
        })(jQuery);

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.amazy.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Production_dev/resources/views/frontend/amazy/pages/profile/order.blade.php ENDPATH**/ ?>