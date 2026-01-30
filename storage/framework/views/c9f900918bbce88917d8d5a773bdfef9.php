<!-- purchase_history_modal::start  -->
<style>
    @media (max-with:767px){
        .sumery_product_details{
            width: 700px
        }
    .summery_pro_content{
        padding-left: 40px;
    }

    }

</style>
<div class="modal fade theme_modal2" id="purchase_history_modal" tabindex="-1" role="dialog" aria-labelledby="theme_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="summery_modal_body">
                    <div class="summery_modal_header d-flex align-items-center gap-2 flex-wrap">
                        <h5 class="font_16 f_w_700 m-0 flex-fill"><?php echo e(__('order.order_code')); ?> : <?php echo e(getNumberTranslate($package->order->order_number)); ?></h5>
                        <?php if(isModuleActive('MultiVendor')): ?>
                            <h5 class="font_16 f_w_700 m-0 flex-fill"><?php echo e(__('common.package_code')); ?> : <?php echo e(getNumberTranslate($package->order->order_number)); ?></h5>
                        <?php endif; ?>
                        <button type="button" class="close_modal_icon" data-bs-dismiss="modal">
                            <i class="ti-close"></i>
                        </button>
                    </div>
                    <div class="summery_modal_body_inner ">
                        <div class="order_place_progress mb_30">
                            <?php if($package->carrier->slug == 'Shiprocket'): ?>
                                <?php
                                    $status = $order_status[$package->id];
                                    $ready_to_ship = false;
                                    $pickup= false;
                                    $ship= false;
                                    $delivered= false;
                                    switch ($status){
                                        case "READY TO SHIP":
                                            $ready_to_ship = true;
                                            break;
                                        case 'PICKUP':
                                        $ready_to_ship = true;
                                        $pickup= true;
                                        break;
                                        case 'SHIPPED':
                                        $ready_to_ship = true;
                                        $pickup= true;
                                        $ship= true;
                                        break;
                                        case 'DELIVERED':
                                        $ready_to_ship = true;
                                        $pickup= true;
                                        $ship= true;
                                        $delivered= true;
                                        break;
                                    }
                                ?>

                                <div class="single_order_progress position-relative d-flex align-items-center flex-column">
                                        <div class="icon position-relative ">
                                            <?php if($package->delivery_status >= 1): ?>
                                                <svg  width="30" height="30" viewBox="0 0 30 30">
                                                    <g  data-name="1" transform="translate(-613 -335)">
                                                        <circle  data-name="Ellipse 239" cx="15" cy="15" r="15" transform="translate(613 335)" fill="#50cd89"></circle>
                                                        <path  data-name="Path 4193" d="M95.541,18.379a1.528,1.528,0,0,1-1.16-.533l-3.665-4.276a1.527,1.527,0,0,1,2.319-1.988l2.4,2.8L103,5.245c1.172-1.642,2.4-.733,1.222.916L96.784,17.739a1.528,1.528,0,0,1-1.175.638Z" transform="translate(530.651 338.622)" fill="#fff"></path>
                                                    </g>
                                                </svg>
                                            <?php else: ?>
                                                <svg  width="30" height="30" viewBox="0 0 30 30">
                                                    <g  data-name="1" transform="translate(-613 -335)">
                                                        <g  data-name="Ellipse 239" transform="translate(613 335)" fill="none" stroke="#f1ece8" stroke-width="2">
                                                        <circle cx="15" cy="15" r="15" stroke="none"></circle>
                                                        <circle cx="15" cy="15" r="14" fill="none"></circle>
                                                        </g>
                                                        <circle  data-name="Ellipse 240" cx="5" cy="5" r="5" transform="translate(623 345)" fill="#f1ece8"></circle>
                                                    </g>
                                                </svg>
                                            <?php endif; ?>
                                        </div>
                                        <h5 class="font_14 f_w_500 m-0 text-nowrap"><?php echo e(__('common.pending')); ?></h5>
                                </div>

                                    <div class="single_order_progress position-relative d-flex align-items-center flex-column">
                                        <div class="icon position-relative ">
                                            <?php if($ready_to_ship): ?>
                                                <svg  width="30" height="30" viewBox="0 0 30 30">
                                                    <g  data-name="1" transform="translate(-613 -335)">
                                                        <circle  data-name="Ellipse 239" cx="15" cy="15" r="15" transform="translate(613 335)" fill="#50cd89"></circle>
                                                        <path  data-name="Path 4193" d="M95.541,18.379a1.528,1.528,0,0,1-1.16-.533l-3.665-4.276a1.527,1.527,0,0,1,2.319-1.988l2.4,2.8L103,5.245c1.172-1.642,2.4-.733,1.222.916L96.784,17.739a1.528,1.528,0,0,1-1.175.638Z" transform="translate(530.651 338.622)" fill="#fff"></path>
                                                    </g>
                                                </svg>
                                            <?php elseif($package->delivery_status >= 1 && !$ready_to_ship): ?>
                                                <svg  width="30" height="30" viewBox="0 0 30 30">
                                                    <g  data-name="1" transform="translate(-613 -335)">
                                                        <g  data-name="Ellipse 239" transform="translate(613 335)" fill="none" stroke="#50cd89" stroke-width="2">
                                                        <circle cx="15" cy="15" r="15" stroke="none"></circle>
                                                        <circle cx="15" cy="15" r="14" fill="none"></circle>
                                                        </g>
                                                        <circle  data-name="Ellipse 240" cx="5" cy="5" r="5" transform="translate(623 345)" fill="#50cd89"></circle>
                                                    </g>
                                                </svg>
                                            <?php else: ?>
                                                <svg  width="30" height="30" viewBox="0 0 30 30">
                                                    <g  data-name="1" transform="translate(-613 -335)">
                                                        <g  data-name="Ellipse 239" transform="translate(613 335)" fill="none" stroke="#f1ece8" stroke-width="2">
                                                        <circle cx="15" cy="15" r="15" stroke="none"></circle>
                                                        <circle cx="15" cy="15" r="14" fill="none"></circle>
                                                        </g>
                                                        <circle  data-name="Ellipse 240" cx="5" cy="5" r="5" transform="translate(623 345)" fill="#f1ece8"></circle>
                                                    </g>
                                                </svg>
                                            <?php endif; ?>

                                        </div>
                                        <h5 class="font_14 f_w_500 m-0 text-nowrap"><?php echo e(__('shipping.ready_to_ship')); ?></h5>
                                    </div>

                                <div class="single_order_progress position-relative d-flex align-items-center flex-column">
                                    <div class="icon position-relative ">
                                        <?php if($pickup): ?>
                                            <svg  width="30" height="30" viewBox="0 0 30 30">
                                                <g  data-name="1" transform="translate(-613 -335)">
                                                    <circle  data-name="Ellipse 239" cx="15" cy="15" r="15" transform="translate(613 335)" fill="#50cd89"></circle>
                                                    <path  data-name="Path 4193" d="M95.541,18.379a1.528,1.528,0,0,1-1.16-.533l-3.665-4.276a1.527,1.527,0,0,1,2.319-1.988l2.4,2.8L103,5.245c1.172-1.642,2.4-.733,1.222.916L96.784,17.739a1.528,1.528,0,0,1-1.175.638Z" transform="translate(530.651 338.622)" fill="#fff"></path>
                                                </g>
                                            </svg>
                                        <?php elseif($ready_to_ship && !$pickup): ?>
                                            <svg  width="30" height="30" viewBox="0 0 30 30">
                                                <g  data-name="1" transform="translate(-613 -335)">
                                                    <g  data-name="Ellipse 239" transform="translate(613 335)" fill="none" stroke="#50cd89" stroke-width="2">
                                                    <circle cx="15" cy="15" r="15" stroke="none"></circle>
                                                    <circle cx="15" cy="15" r="14" fill="none"></circle>
                                                    </g>
                                                    <circle  data-name="Ellipse 240" cx="5" cy="5" r="5" transform="translate(623 345)" fill="#50cd89"></circle>
                                                </g>
                                            </svg>
                                        <?php else: ?>
                                            <svg  width="30" height="30" viewBox="0 0 30 30">
                                                <g  data-name="1" transform="translate(-613 -335)">
                                                    <g  data-name="Ellipse 239" transform="translate(613 335)" fill="none" stroke="#f1ece8" stroke-width="2">
                                                    <circle cx="15" cy="15" r="15" stroke="none"></circle>
                                                    <circle cx="15" cy="15" r="14" fill="none"></circle>
                                                    </g>
                                                    <circle  data-name="Ellipse 240" cx="5" cy="5" r="5" transform="translate(623 345)" fill="#f1ece8"></circle>
                                                </g>
                                            </svg>
                                        <?php endif; ?>
                                    </div>
                                    <h5 class="font_14 f_w_500 m-0 mute_text  text-nowrap"><?php echo e(__('shipping.pickup')); ?></h5>
                                </div>

                                <div class="single_order_progress position-relative d-flex align-items-center flex-column">
                                    <div class="icon position-relative ">
                                        <?php if($ship): ?>
                                            <svg  width="30" height="30" viewBox="0 0 30 30">
                                                <g  data-name="1" transform="translate(-613 -335)">
                                                    <circle  data-name="Ellipse 239" cx="15" cy="15" r="15" transform="translate(613 335)" fill="#50cd89"></circle>
                                                    <path  data-name="Path 4193" d="M95.541,18.379a1.528,1.528,0,0,1-1.16-.533l-3.665-4.276a1.527,1.527,0,0,1,2.319-1.988l2.4,2.8L103,5.245c1.172-1.642,2.4-.733,1.222.916L96.784,17.739a1.528,1.528,0,0,1-1.175.638Z" transform="translate(530.651 338.622)" fill="#fff"></path>
                                                </g>
                                            </svg>
                                        <?php elseif($pickup && !$ship): ?>
                                            <svg  width="30" height="30" viewBox="0 0 30 30">
                                                <g  data-name="1" transform="translate(-613 -335)">
                                                    <g  data-name="Ellipse 239" transform="translate(613 335)" fill="none" stroke="#50cd89" stroke-width="2">
                                                    <circle cx="15" cy="15" r="15" stroke="none"></circle>
                                                    <circle cx="15" cy="15" r="14" fill="none"></circle>
                                                    </g>
                                                    <circle  data-name="Ellipse 240" cx="5" cy="5" r="5" transform="translate(623 345)" fill="#50cd89"></circle>
                                                </g>
                                            </svg>
                                        <?php else: ?>
                                            <svg  width="30" height="30" viewBox="0 0 30 30">
                                                <g  data-name="1" transform="translate(-613 -335)">
                                                    <g  data-name="Ellipse 239" transform="translate(613 335)" fill="none" stroke="#f1ece8" stroke-width="2">
                                                    <circle cx="15" cy="15" r="15" stroke="none"></circle>
                                                    <circle cx="15" cy="15" r="14" fill="none"></circle>
                                                    </g>
                                                    <circle  data-name="Ellipse 240" cx="5" cy="5" r="5" transform="translate(623 345)" fill="#f1ece8"></circle>
                                                </g>
                                            </svg>
                                        <?php endif; ?>
                                    </div>
                                    <h5 class="font_14 f_w_500 m-0 mute_text text-nowrap"><?php echo e(__('common.shipped')); ?></h5>
                                </div>

                                <div class="single_order_progress position-relative d-flex align-items-center flex-column">
                                    <div class="icon position-relative ">
                                        <?php if($delivered): ?>
                                            <svg  width="30" height="30" viewBox="0 0 30 30">
                                                <g  data-name="1" transform="translate(-613 -335)">
                                                    <circle  data-name="Ellipse 239" cx="15" cy="15" r="15" transform="translate(613 335)" fill="#50cd89"></circle>
                                                    <path  data-name="Path 4193" d="M95.541,18.379a1.528,1.528,0,0,1-1.16-.533l-3.665-4.276a1.527,1.527,0,0,1,2.319-1.988l2.4,2.8L103,5.245c1.172-1.642,2.4-.733,1.222.916L96.784,17.739a1.528,1.528,0,0,1-1.175.638Z" transform="translate(530.651 338.622)" fill="#fff"></path>
                                                </g>
                                            </svg>
                                        <?php elseif($ship && !$delivered): ?>
                                            <svg  width="30" height="30" viewBox="0 0 30 30">
                                                <g  data-name="1" transform="translate(-613 -335)">
                                                    <g  data-name="Ellipse 239" transform="translate(613 335)" fill="none" stroke="#50cd89" stroke-width="2">
                                                    <circle cx="15" cy="15" r="15" stroke="none"></circle>
                                                    <circle cx="15" cy="15" r="14" fill="none"></circle>
                                                    </g>
                                                    <circle  data-name="Ellipse 240" cx="5" cy="5" r="5" transform="translate(623 345)" fill="#50cd89"></circle>
                                                </g>
                                            </svg>
                                        <?php else: ?>
                                            <svg  width="30" height="30" viewBox="0 0 30 30">
                                                <g  data-name="1" transform="translate(-613 -335)">
                                                    <g  data-name="Ellipse 239" transform="translate(613 335)" fill="none" stroke="#f1ece8" stroke-width="2">
                                                    <circle cx="15" cy="15" r="15" stroke="none"></circle>
                                                    <circle cx="15" cy="15" r="14" fill="none"></circle>
                                                    </g>
                                                    <circle  data-name="Ellipse 240" cx="5" cy="5" r="5" transform="translate(623 345)" fill="#f1ece8"></circle>
                                                </g>
                                            </svg>
                                        <?php endif; ?>
                                    </div>
                                    <h5 class="font_14 f_w_500 m-0 mute_text text-nowrap"><?php echo e(__('order.delivered')); ?></h5>
                                </div>
                            <?php else: ?>
                                <?php
                                    $next_step = null;
                                    $processes = $package->processes;
                                ?>
                                <?php $__currentLoopData = $processes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $process): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="single_order_progress position-relative d-flex align-items-center flex-column">
                                        <div class="icon position-relative ">

                                            <?php if($package->delivery_status >= $process->id): ?>
                                                <svg  width="30" height="30" viewBox="0 0 30 30">
                                                    <g  data-name="1" transform="translate(-613 -335)">
                                                        <circle  data-name="Ellipse 239" cx="15" cy="15" r="15" transform="translate(613 335)" fill="#50cd89"></circle>
                                                        <path  data-name="Path 4193" d="M95.541,18.379a1.528,1.528,0,0,1-1.16-.533l-3.665-4.276a1.527,1.527,0,0,1,2.319-1.988l2.4,2.8L103,5.245c1.172-1.642,2.4-.733,1.222.916L96.784,17.739a1.528,1.528,0,0,1-1.175.638Z" transform="translate(530.651 338.622)" fill="#fff"></path>
                                                    </g>
                                                </svg>
                                                <?php
                                                    $next_step = $key + 1;
                                                ?>
                                            <?php else: ?>
                                                <?php if($next_step == $key): ?>
                                                    <svg  width="30" height="30" viewBox="0 0 30 30">
                                                        <g  data-name="1" transform="translate(-613 -335)">
                                                            <g  data-name="Ellipse 239" transform="translate(613 335)" fill="none" stroke="#50cd89" stroke-width="2">
                                                            <circle cx="15" cy="15" r="15" stroke="none"></circle>
                                                            <circle cx="15" cy="15" r="14" fill="none"></circle>
                                                            </g>
                                                            <circle  data-name="Ellipse 240" cx="5" cy="5" r="5" transform="translate(623 345)" fill="#50cd89"></circle>
                                                        </g>
                                                    </svg>
                                                <?php else: ?>
                                                    <svg  width="30" height="30" viewBox="0 0 30 30">
                                                        <g  data-name="1" transform="translate(-613 -335)">
                                                            <g  data-name="Ellipse 239" transform="translate(613 335)" fill="none" stroke="#f1ece8" stroke-width="2">
                                                            <circle cx="15" cy="15" r="15" stroke="none"></circle>
                                                            <circle cx="15" cy="15" r="14" fill="none"></circle>
                                                            </g>
                                                            <circle  data-name="Ellipse 240" cx="5" cy="5" r="5" transform="translate(623 345)" fill="#f1ece8"></circle>
                                                        </g>
                                                    </svg>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <h5 class="font_14 f_w_500 m-0 text-nowrap"><?php echo e($process->name); ?></h5>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                        <!-- summery_order_box  -->
                        <div class="summery_order_box">
                            <div class="summery_modal_bodyHeader">
                                <h5 class="font_16 f_w_700 m-0"><?php echo e(__('common.order_summary')); ?></h5>
                            </div>
                            <div class="summery_order_body d-flex flex-wrap">
                                <div class="summery_lists flex-fill">
                                    <h5 class="font_14 f_w_600 m-0 pb_10"><?php echo e(__('defaultTheme.shipping_info')); ?> <?php if($package->order->delivery_type == 'pickup_location'): ?>(<?php echo e(__('shipping.collect_from_pickup_location')); ?>) <?php endif; ?></h5>
                                    <div class="single_summery_list d-flex align-items-start gap_20">
                                        <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.name')); ?></h5><span>:</span>
                                        </div>
                                        <p class="font_14 f_w_400 m-0"><?php echo e(@$package->order->address->shipping_name); ?></p>
                                    </div>
                                    <div class="single_summery_list d-flex align-items-start gap_20">
                                        <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.email')); ?></h5><span>:</span>
                                        </div>
                                        <p class="font_14 f_w_400 m-0"><?php echo e(@$package->order->address->shipping_email); ?></p>
                                    </div>
                                    <div class="single_summery_list d-flex align-items-start gap_20">
                                        <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.phone_number')); ?> </h5><span>:</span>
                                        </div>
                                        <p class="font_14 f_w_400 m-0"><?php echo e(getNumberTranslate(@$package->order->address->shipping_phone)); ?></p>
                                    </div>
                                    <div class="single_summery_list d-flex align-items-start gap_20">
                                        <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.address')); ?></h5><span>:</span>
                                        </div>
                                        <p class="font_14 f_w_400 m-0"><?php echo e(@$package->order->address->shipping_address); ?></p>
                                    </div>
                                    <div class="single_summery_list d-flex align-items-start gap_20">
                                        <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.city')); ?></h5><span>:</span>
                                        </div>
                                        <p class="font_14 f_w_400 m-0"><?php echo e(@$package->order->address->getShippingCity->name); ?></p>
                                    </div>
                                    <div class="single_summery_list d-flex align-items-start gap_20">
                                        <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.state')); ?></h5><span>:</span>
                                        </div>
                                        <p class="font_14 f_w_400 m-0"><?php echo e(@$package->order->address->getShippingState->name); ?></p>
                                    </div>
                                    <div class="single_summery_list d-flex align-items-start gap_20">
                                        <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.country')); ?></h5><span>:</span>
                                        </div>
                                        <p class="font_14 f_w_400 m-0"><?php echo e(@$package->order->address->getShippingCountry->name); ?></p>
                                    </div>
                                </div>
                                <div class="summery_lists flex-fill">
                                    <h5 class="font_14 f_w_600 m-0 pb_10"><?php echo e(__('common.billing_info')); ?></h5>
                                    <div class="single_summery_list d-flex align-items-start gap_20">
                                        <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.name')); ?></h5><span>:</span>
                                        </div>
                                        <p class="font_14 f_w_400 m-0"><?php echo e(@$package->order->address->billing_name); ?></p>
                                    </div>
                                    <div class="single_summery_list d-flex align-items-start gap_20">
                                        <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.email')); ?></h5><span>:</span>
                                        </div>
                                        <p class="font_14 f_w_400 m-0"><?php echo e(@$package->order->address->billing_email); ?></p>
                                    </div>
                                    <div class="single_summery_list d-flex align-items-start gap_20">
                                        <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.phone_number')); ?> </h5><span>:</span>
                                        </div>
                                        <p class="font_14 f_w_400 m-0"><?php echo e(getNumberTranslate(@$package->order->address->billing_phone)); ?></p>
                                    </div>
                                    <div class="single_summery_list d-flex align-items-start gap_20">
                                        <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.address')); ?></h5><span>:</span>
                                        </div>
                                        <p class="font_14 f_w_400 m-0"><?php echo e(@$package->order->address->billing_address); ?></p>
                                    </div>
                                    <div class="single_summery_list d-flex align-items-start gap_20">
                                        <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.city')); ?></h5><span>:</span>
                                        </div>
                                        <p class="font_14 f_w_400 m-0"><?php echo e(@$package->order->address->getBillingCity->name); ?></p>
                                    </div>
                                    <div class="single_summery_list d-flex align-items-start gap_20">
                                        <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.state')); ?></h5><span>:</span>
                                        </div>
                                        <p class="font_14 f_w_400 m-0"><?php echo e(@$package->order->address->getBillingState->name); ?></p>
                                    </div>
                                    <div class="single_summery_list d-flex align-items-start gap_20">
                                        <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.country')); ?></h5><span>:</span>
                                        </div>
                                        <p class="font_14 f_w_400 m-0"><?php echo e(@$package->order->address->getBillingCountry->name); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="sumery_product_details">
                                <div class="summery_modal_bodyHeader">
                                    <h5 class="font_16 f_w_700 m-0"><?php echo e(__('defaultTheme.order_details')); ?></h5>
                                </div>
                                <div class="table-responsive mb_30">
                                    <table class="table amazy_table3 mb-0">
                                        <thead>
                                            <tr>
                                                <th class="font_14 f_w_700" scope="col"><?php echo e(__('common.products')); ?></th>
                                                <th class="font_14 f_w_700 border-start-0 border-end-0" scope="col"><?php echo e(__('common.price')); ?></th>
                                                <th class="font_14 f_w_700 border-start-0 border-end-0" scope="col"><?php echo e(__('common.quantity')); ?></th>
                                                <th class="font_14 f_w_700 border-start-0 border-end-0" scope="col"><?php echo e(__('common.subtotal')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $package->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($package_product->type == "gift_card"): ?>
                                                    <tr>
                                                        <td>
                                                            <a href="<?php echo e(route('frontend.gift-card.show',@$package_product->giftCard->sku)); ?>" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                                <div class="thumb">
                                                                    <img src="<?php echo e(showImage(@$package_product->giftCard->thumbnail_image)); ?>" alt="<?php echo e(textLimit(@$package_product->giftCard->name,22)); ?>" title="<?php echo e(textLimit(@$package_product->giftCard->name,22)); ?>">
                                                                </div>
                                                                <div class="summery_pro_content">
                                                                    <h4 class="font_16 f_w_700 text-nowrap m-0 theme_hover"><?php echo e(textLimit(@$package_product->giftCard->name,22)); ?></h4>
                                                                    <p class="font_14 f_w_400 m-0 ">
                                                                        <?php if($package->order->gift_card_uses->where('gift_card_id', $package_product->giftCard->id)->first() != null): ?>
                                                                            <?php echo e(__('order.Secret-Key')); ?> : <?php echo e($package->order->gift_card_uses->where('gift_card_id', $package_product->giftCard->id)->first()->secret_code); ?>

                                                                        <?php else: ?>
                                                                        <?php echo e(__('order.check_shipping_email_for_secret_key')); ?>

                                                                        <?php endif; ?>
                                                                    </p>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <h4 class="font_16 f_w_500 m-0 text-nowrap"><?php echo e(single_price($package_product->price)); ?></h4>
                                                        </td>
                                                        <td>
                                                            <h4 class="font_16 f_w_500 m-0 text-nowrap"><?php echo e(__('common.qty')); ?>: <?php echo e(getNumberTranslate($package_product->qty)); ?></h4>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center gap_10">
                                                                <h5 class="font_16 f_w_500 m-0 text-nowrap"><?php echo e(single_price($package_product->price * $package_product->qty )); ?></h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php else: ?>
                                                    <tr>
                                                        <td>
                                                            <a href="<?php echo e(singleProductURL(@$package->seller->slug, @$package_product->seller_product_sku->product->slug)); ?>" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                                <div class="thumb">
                                                                    <img src="
                                                                    <?php if(@$package_product->seller_product_sku->sku->product->product_type == 1): ?>
                                                                        <?php echo e(showImage(@$package_product->seller_product_sku->product->thum_img??@$package_product->seller_product_sku->sku->product->thumbnail_image_source)); ?>

                                                                    <?php else: ?>
                                                                        <?php echo e(showImage((@$package_product->seller_product_sku->sku->variant_image?@$package_product->seller_product_sku->sku->variant_image:@$package_product->seller_product_sku->product->thum_img)??@$package_product->seller_product_sku->product->product->thumbnail_image_source)); ?>

                                                                    <?php endif; ?>
                                                                    " alt="<?php echo e(@$package_product->seller_product_sku->product->product_name? textLimit(@$package_product->seller_product_sku->product->product_name, 18) : textLimit(@$package_product->seller_product_sku->sku->product->product_name, 18)); ?>" title="<?php echo e(@$package_product->seller_product_sku->product->product_name? textLimit(@$package_product->seller_product_sku->product->product_name, 18) : textLimit(@$package_product->seller_product_sku->sku->product->product_name, 18)); ?>">
                                                                </div>
                                                                <div class="summery_pro_content">
                                                                    <h4 class="font_16 f_w_700 text-nowrap m-0 theme_hover"><?php echo e(@$package_product->seller_product_sku->product->product_name? textLimit(@$package_product->seller_product_sku->product->product_name, 18) : textLimit(@$package_product->seller_product_sku->sku->product->product_name, 18)); ?></h4>
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
                                                            <h4 class="font_16 f_w_500 m-0 text-nowrap"><?php echo e(single_price($package_product->price)); ?></h4>
                                                        </td>
                                                        <td>
                                                            <h4 class="font_16 f_w_500 m-0 text-nowrap"><?php echo e(getNumberTranslate($package_product->qty)); ?></h4>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center gap_10">
                                                                <h5 class="font_16 f_w_500 m-0 text-nowrap"><?php echo e(single_price($package_product->price * $package_product->qty )); ?></h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="subtotal_and_payment_information d-flex flex-wrap gap-3">
                                <div class="thumb flex-fill">
                                    <?php if($package->order->order_payment->payment_method == 1): ?>
                                        <img class="img-fluid" src="<?php echo e(url('/')); ?>/public/frontend/amazy/img/amazPorduct/cash_on_delivery.png " alt="<?php echo e($package->order->order_payment->GatewayName); ?>" title="<?php echo e($package->order->order_payment->GatewayName); ?>">
                                    <?php else: ?>
                                        <h5 class="payemntgateway_test f_w_700 m-0"><?php echo e(gateway_name($package->order->order_payment->GatewayName)); ?></h5>
                                    <?php endif; ?>
                                </div>
                                <div class="total_sumery_amount">
                                    <div class="single_amount pb-1 d-flex align-items-center justify-content-between">
                                        <h5 class="font_16 f_w_700 m-0"><?php echo e(__('common.subtotal')); ?></h5>
                                        <p class="font_14 f_w_500 m-0"><?php echo e(single_price($package->products->sum('total_price'))); ?></p>
                                    </div>
                                    <div class="single_amount pb-1 d-flex align-items-center justify-content-between">
                                        <h5 class="font_16 f_w_700 m-0"><?php echo e(__('shipping.shipping_fee')); ?></h5>
                                        <p class="font_14 f_w_500 m-0"><?php echo e(single_price($package->shipping_cost)); ?></p>
                                    </div>
                                    <div class="single_amount d-flex align-items-center justify-content-between">
                                        <h5 class="font_16 f_w_700 m-0"><?php echo e(__('gst.TAX/GST/VAT')); ?></h5>
                                        <p class="font_14 f_w_500 m-0"><?php echo e(single_price($package->tax_amount)); ?></p>
                                    </div>
                                    <div class="amazy_bb mt_20  mb_28"></div>
                                    <div class="single_amount d-flex align-items-center justify-content-between">
                                        <h5 class="font_14 f_w_700 m-0"><?php echo e(__('common.total')); ?></h5>
                                        <h5 class="font_14 f_w_700 m-0"><?php echo e(single_price($package->products->sum('total_price')+$package->shipping_cost+$package->tax_amount)); ?></h5>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- purchase_history_modal::end  -->
<?php /**PATH /var/www/html/Production_dev/resources/views/frontend/amazy/pages/profile/partials/purchase_order_modal.blade.php ENDPATH**/ ?>