<?php $__env->startSection('content'); ?>
    <div class="amazy_dashboard_area dashboard_bg section_spacing6">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <!-- content ::start  -->
                    <div class="white_box style2 bg-white mb_30">
                        <div class="white_box_header gray_color_1 d-flex align-items-center gap_20 flex-wrap  theme_border justify-content-between ">
                            <div class="d-flex flex-column  ">
                                <div class="d-flex align-items-center flex-wrap gap_5">
                                    <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('common.order_id')); ?>:  </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(getNumberTranslate($order->order_number)); ?></p>
                                </div>
                                <div class="d-flex align-items-center flex-wrap gap_5">
                                    <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('defaultTheme.order_date')); ?> :  </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(getNumberTranslate($order->created_at)); ?></p>
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
                            </div>
                            <div class="d-flex flex-column  ">
                                <div class="d-flex align-items-center flex-wrap gap_5">
                                    <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('defaultTheme.order_amount')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"><?php echo e(single_price($order->grand_total)); ?></p>
                                </div>
                            </div>
                            <div class="d-flex flex-column  ">
                                <a  href="<?php echo e(route('frontend.my_purchase_order_pdf', encrypt($order->id))); ?>" download="" target="_blank" class="amaz_primary_btn gray_bg_btn min_200 radius_3px mb_5">+ <?php echo e(__('defaultTheme.download_invoice')); ?></a>
                            </div>
                        </div>
                        <div class="dashboard_white_box_body dashboard_orderDetails_body">
                            <?php $__currentLoopData = $order->packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="order_prise d-flex justify-content-between gap-2 flex-wrap amazy_bb2 pb_11 mb_10">
                                    <h4 class="font_16 f_w_700 m-0"><?php echo e(__('common.package')); ?> : <?php echo e(getNumberTranslate($package->package_code)); ?></h4>
                                    <?php if(isModuleActive('MultiVendor')): ?>
                                        <h4 class="font_16 f_w_700 m-0"><?php echo e(__('defaultTheme.sold_by')); ?>: <?php if($package->seller->role->type == 'seller'): ?> <?php echo e(@$package->seller->first_name); ?> <?php else: ?> <?php echo e(app('general_setting')->company_name); ?> <?php endif; ?></h4>
                                    <?php endif; ?>
                                    <?php if(app('general_setting')->price_with_vat): ?>
                                    <h4 class="font_16 f_w_700 m-0"><?php echo e(__('common.price')); ?>: <?php echo e(single_price($package->products->sum('total_price') + $package->gst_taxes->sum('amount'))); ?></h4>
                                    <?php else: ?>
                                    <h4 class="font_16 f_w_700 m-0"><?php echo e(__('common.price')); ?>: <?php echo e(single_price($package->products->sum('total_price') + $package->tax_amount + $package->gst_taxes->sum('amount'))); ?></h4>
                                    <?php endif; ?>
                                    <?php if($package->delivery_status==4 && $oneClickOrderComplete->status==1): ?>
                                        <div class="form-check">
                                            <label class="primary_checkbox d-flex">
                                                <input type="checkbox" class="attr_checkbox" value="1" id="is_received" data-package_id="<?php echo e($package->id); ?>" data-id="<?php echo e($order->id); ?>">
                                                <span class="checkmark mr_10"></span>
                                                <span class="label_name f_w_700"><?php echo e(__('setup.Is Received?')); ?></span>
                                            </label>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if($package->is_cancelled == 0): ?>
                                    <p class="font_14 f_w_400"><?php echo e($package->shipping_date); ?></p>
                                    <div class="order_details_progress ">
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
                                            <div class="icon position-relative order_process_icon">
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
                                            <div class="icon position-relative order_process_icon">
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
                                            <div class="icon position-relative order_process_icon">
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
                                            <div class="icon position-relative order_process_icon">
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
                                            <div class="icon position-relative order_process_icon">
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
                                            ?>
                                            <?php $__currentLoopData = $processes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $process): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="single_order_progress position-relative d-flex align-items-center flex-column">
                                                    <div class="icon position-relative order_process_icon">

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

                                    <div class="d-flex align-items-center gap_20 flex-wrap gray_color_1 dashboard_orderDetails_head  justify-content-between theme_border">
                                        <div class="d-flex flex-column ">
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('defaultTheme.package_code')); ?>:  </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(getNumberTranslate($package->package_code)); ?></p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column  ">
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('defaultTheme.order_amount')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(single_price($package->products->sum('total_price'))); ?></p>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column  ">
                                            <div class="d-flex align-items-center flex-wrap gap_5">
                                                <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('defaultTheme.tax_amount')); ?>:  </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(single_price($package->tax_amount)); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="d-flex align-items-center gap_20 flex-wrap gray_color_1 dashboard_orderDetails_head  justify-content-between theme_border">
                                        <h5 class="text-danger mt_20 w-100 text-center"><?php echo e(__('defaultTheme.order_cancelled')); ?></h5>
                                    </div>
                                <?php endif; ?>
                                <div class="table-responsive mb_10">
                                    <table class="table amazy_table3 style2 mb-0">
                                        <tbody>
                                            <?php
                                                $physical_product = 0;
                                            ?>
                                            <?php $__currentLoopData = $package->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($package_product->type == "gift_card"): ?>
                                                    <tr>
                                                        <td>
                                                            <a href="<?php echo e(route('frontend.gift-card.show',@$package_product->giftCard->sku)); ?>" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                                <div class="thumb">
                                                                    <img class="img-res" src="<?php echo e(showImage(@$package_product->giftCard->thumbnail_image)); ?>" alt="<?php echo e(textLimit(@$package_product->giftCard->name,28)); ?>" title="<?php echo e(textLimit(@$package_product->giftCard->name,28)); ?>">
                                                                </div>
                                                                <div class="summery_pro_content">
                                                                    <h4 class="font_16 f_w_700 text-nowrap m-0 theme_hover"><?php echo e(textLimit(@$package_product->giftCard->name,28)); ?></h4>
                                                                    <p class="font_14 f_w_400 m-0 ">
                                                                        <?php if($order->gift_card_uses->where('gift_card_id', $package_product->giftCard->id)->first() != null): ?>
                                                                        <?php echo e(__('order.Secret-Key')); ?>: <?php echo e($order->gift_card_uses->where('gift_card_id', $package_product->giftCard->id)->first()->secret_code); ?>

                                                                        <?php else: ?>
                                                                        <?php echo e(__('order.check_shipping_email_for_secret_key')); ?>

                                                                        <?php endif; ?>
                                                                    </p>
                                                                    <p><?php echo e(__('common.qty')); ?>: <?php echo e($package_product->qty); ?> <br>  <?php echo e(__('common.price')); ?>: <?php echo e(single_price($package_product->price)); ?></p>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td></td>

                                                <?php else: ?>
                                                    <?php if(@$package_product->seller_product_sku->sku->product->is_physical): ?>
                                                        <?php
                                                            $physical_product = 1;
                                                        ?>
                                                    <?php endif; ?>
                                                    <tr>
                                                        <td>
                                                            <a href="<?php echo e(singleProductURL(@$package_product->seller_product_sku->product->seller->slug, @$package_product->seller_product_sku->product->slug)); ?>" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                                <div class="thumb">
                                                                    <?php if(@$package_product->seller_product_sku->sku->product->product_type == 1): ?>
                                                                        <img class="img-res" src="<?php echo e(showImage(@$package_product->seller_product_sku->product->thum_img??@$package_product->seller_product_sku->sku->product->thumbnail_image_source)); ?>" alt="<?php echo e(@$package_product->seller_product_sku->product->product_name? textLimit(@$package_product->seller_product_sku->product->product_name, 28) : textLimit(@$package_product->seller_product_sku->sku->product->product_name, 28)); ?>" title="<?php echo e(@$package_product->seller_product_sku->product->product_name? textLimit(@$package_product->seller_product_sku->product->product_name, 28) : textLimit(@$package_product->seller_product_sku->sku->product->product_name, 28)); ?>">
                                                                    <?php else: ?>
                                                                        <img class="img-res" src="<?php echo e(showImage((@$package_product->seller_product_sku->sku->variant_image?@$package_product->seller_product_sku->sku->variant_image:@$package_product->seller_product_sku->product->thum_img)??@$package_product->seller_product_sku->product->product->thumbnail_image_source)); ?>" alt="<?php echo e(@$package_product->seller_product_sku->product->product_name? textLimit(@$package_product->seller_product_sku->product->product_name, 28) : textLimit(@$package_product->seller_product_sku->sku->product->product_name, 28)); ?>" title="<?php echo e(@$package_product->seller_product_sku->product->product_name? textLimit(@$package_product->seller_product_sku->product->product_name, 28) : textLimit(@$package_product->seller_product_sku->sku->product->product_name, 28)); ?>">
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="summery_pro_content">
                                                                    <h4 class="font_16 f_w_700 text-nowrap m-0 theme_hover"><?php echo e(@$package_product->seller_product_sku->product->product_name? textLimit(@$package_product->seller_product_sku->product->product_name, 28) : textLimit(@$package_product->seller_product_sku->sku->product->product_name, 28)); ?></h4>
                                                                    <?php if(@$package_product->seller_product_sku->product->is_digital): ?>
                                                                        <a download="" class="font_14 f_w_400 m-0" target="_blank" href="<?php echo e(route('digital_file_download', encrypt($package->files->where('product_sku_id', $package_product->seller_product_sku->product_sku_id)->where('customer_id', auth()->user()->id)->first()->id))); ?>"><i class="ti-download mr-1 green"></i>
                                                                            <?php echo e(__('common.download')); ?>

                                                                        </a>
                                                                    <?php endif; ?>
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
                                                                    <p><?php echo e(__('common.qty')); ?>: <?php echo e($package_product->qty); ?> <br>  <?php echo e(__('common.price')); ?>: <?php echo e(single_price($package_product->price)); ?></p>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td></td>

                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                    <div class="d-flex flex-column mt_10">
                                        <div class="d-flex align-items-center flex-wrap gap_5 justify-content-end">
                                            <?php if($order->is_confirmed == 0 && $package->is_cancelled == 0 || $order->is_confirmed == 1 && $package->is_cancelled == 0 && $package->delivery_status <= 2): ?>
                                                <a href="" data-id=<?php echo e($package->id); ?> class="amaz_primary_btn gray_bg_btn radius_3px order_cancel_by_id"><?php echo e(__('defaultTheme.cancel_order')); ?></a>
                                            <?php elseif($order->is_completed == 1 || $package->delivery_status >= 5): ?>
                                                <?php
                                                    $refund_status=app('business_settings')->where('type', 'refund_status')->first()->status;
                                                ?>
                                                <?php if(\Carbon\Carbon::now() <= $order->created_at->addDays(app('business_settings')->where('type', 'refund_times')->first()->status)  && $package->is_cancelled == 0 && $physical_product == 1 && !$package->refundPackage && $refund_status == 1): ?>
                                                    <a href="<?php echo e(route('refund.make_request', encrypt($package->id))); ?>" class="amaz_primary_btn gray_bg_btn radius_3px"><?php echo e(__('defaultTheme.open_dispute')); ?></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if($order->is_completed == 1): ?>
                                                <a href="<?php echo e(url('/')); ?>/profile/product-review?order_id=<?php echo e(base64_encode($order->id)); ?>&&package_id=<?php echo e(base64_encode($package->id)); ?>&&seller_id=<?php echo e(base64_encode($package->seller_id)); ?>" class="amaz_primary_btn gray_bg_btn radius_3px"><?php echo e(__('defaultTheme.write_a_review')); ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($package->carrier->type == 'Manual' && $package->carrier_order_id): ?>
                                <div class="d-flex align-items-center gap_20 flex-wrap gray_color_1 dashboard_orderDetails_head  justify-content-between theme_border">
                                    <div class="d-flex flex-column ">
                                        <div class="d-flex align-items-center flex-wrap gap_5">
                                            <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('shipping.shipping_by')); ?>:  </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(@$package->carrier->name); ?></p>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column  ">
                                        <div class="d-flex align-items-center flex-wrap gap_5">
                                            <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('shipping.tracking_id')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(@$package->carrier_order_id); ?></p>
                                        </div>
                                    </div>
                                    <?php if(@$package->carrier->tracking_url): ?>
                                    <div class="d-flex flex-column  ">
                                        <div class="d-flex align-items-center flex-wrap gap_5">
                                            <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('shipping.tracking_url')); ?>:  </h4> <a class="font_14 f_w_400 m-0 lh-base text_color" target="_blank" href="<?php echo e(str_replace("@",@$package->carrier_order_id,$package->carrier->tracking_url)); ?>"> <?php echo e(__('common.click_here')); ?></a>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <div class="order_details_list_box">
                                <div class="summery_order_body d-flex flex-wrap">
                                    <div class="summery_lists flex-fill">
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 ">
                                                <h4 class="font_16 f_w_700 text-nowrap m-0 theme_hover"><?php echo e(__('shipping.shipping_info')); ?> <?php if($order->delivery_type == 'pickup_location'): ?>(<?php echo e(__('shipping.collect_from_pickup_location')); ?>) <?php endif; ?></h4>
                                            </div>
                                        </div>
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.name')); ?></h5><span>:</span>
                                            </div>
                                            <p class="font_14 f_w_400 m-0"><?php echo e(@$order->address->shipping_name); ?></p>
                                        </div>
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.email')); ?></h5><span>:</span>
                                            </div>
                                            <p class="font_14 f_w_400 m-0"><?php echo e(@$order->address->shipping_email); ?></p>
                                        </div>
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.phone_number')); ?> </h5><span>:</span>
                                            </div>
                                            <p class="font_14 f_w_400 m-0"><?php echo e(getNumberTranslate(@$order->address->shipping_phone)); ?></p>
                                        </div>
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.address')); ?></h5><span>:</span>
                                            </div>
                                            <p class="font_14 f_w_400 m-0"><?php echo e(@$order->address->shipping_address); ?></p>
                                        </div>
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.city')); ?></h5><span>:</span>
                                            </div>
                                            <p class="font_14 f_w_400 m-0"><?php echo e(@$order->address->getShippingCity->name); ?></p>
                                        </div>
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.state')); ?></h5><span>:</span>
                                            </div>
                                            <p class="font_14 f_w_400 m-0"><?php echo e(@$order->address->getShippingState->name); ?></p>
                                        </div>
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.country')); ?></h5><span>:</span>
                                            </div>
                                            <p class="font_14 f_w_400 m-0"><?php echo e(@$order->address->getShippingCountry->name); ?></p>
                                        </div>
                                    </div>

                                    <div class="summery_lists flex-fill">
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 ">
                                                <h4 class="font_16 f_w_700 text-nowrap m-0 theme_hover"><?php echo e(__('shipping.billing_info')); ?> </h4>
                                            </div>
                                        </div>
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.name')); ?></h5><span>:</span>
                                            </div>
                                            <p class="font_14 f_w_400 m-0"><?php echo e(@$order->address->billing_name); ?></p>
                                        </div>
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.email')); ?></h5><span>:</span>
                                            </div>
                                            <p class="font_14 f_w_400 m-0"><?php echo e(@$order->address->billing_email); ?></p>
                                        </div>
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.phone_number')); ?> </h5><span>:</span>
                                            </div>
                                            <p class="font_14 f_w_400 m-0"><?php echo e(getNumberTranslate(@$order->address->billing_phone)); ?></p>
                                        </div>
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.address')); ?></h5><span>:</span>
                                            </div>
                                            <p class="font_14 f_w_400 m-0"><?php echo e(@$order->address->billing_address); ?></p>
                                        </div>
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.city')); ?></h5><span>:</span>
                                            </div>
                                            <p class="font_14 f_w_400 m-0"><?php echo e(@$order->address->getBillingCity->name); ?></p>
                                        </div>
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.state')); ?></h5><span>:</span>
                                            </div>
                                            <p class="font_14 f_w_400 m-0"><?php echo e(@$order->address->getBillingState->name); ?></p>
                                        </div>
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.country')); ?></h5><span>:</span>
                                            </div>
                                            <p class="font_14 f_w_400 m-0"><?php echo e(@$order->address->getBillingCountry->name); ?></p>
                                        </div>

                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 ">
                                                <h4 class="font_16 f_w_700 text-nowrap m-0 theme_hover"><?php echo e(__('defaultTheme.payment_info')); ?> </h4>
                                            </div>
                                        </div>
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.subtotal')); ?></h5><span>:</span>
                                            </div>
                                            <p class="font_14 f_w_400 m-0"><?php echo e(single_price($order->sub_total)); ?></p>
                                        </div>
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.discount')); ?></h5><span>:</span>
                                            </div>
                                            <p class="font_14 f_w_400 m-0">- <?php echo e(single_price($order->discount_total)); ?></p>
                                        </div>
                                        <?php if($order->coupon): ?>
                                            <div class="single_summery_list d-flex align-items-start gap_20">
                                                <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.coupon')); ?></h5><span>:</span>
                                                </div>
                                                <p class="font_14 f_w_400 m-0">- <?php echo e(single_price($order->coupon->discount_amount)); ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('defaultTheme.tax_amount')); ?></h5><span>:</span>
                                            </div>
                                            <p class="font_14 f_w_400 m-0">+ <?php echo e(single_price($order->tax_amount)); ?></p>
                                        </div>
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.shipping_charge')); ?></h5><span>:</span>
                                            </div>
                                            <p class="font_14 f_w_400 m-0"> + <?php echo e(single_price($order->shipping_total)); ?></p>
                                        </div>
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('common.grand_total')); ?></h5><span>:</span>
                                            </div>
                                            <p class="font_14 f_w_400 m-0"><?php echo e(single_price($order->grand_total)); ?></p>
                                        </div>
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('defaultTheme.paid_by')); ?></h5><span>:</span>
                                            </div>
                                            <p class="font_14 f_w_400 m-0"><?php echo e($order->GatewayName); ?></p>
                                        </div>
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 "><h5 class="font_14 f_w_500 m-0"><?php echo e(__('order.txn_id')); ?></h5><span>:</span>
                                            </div>
                                            <p class="font_14 f_w_400 m-0"> <?php if(@$order->order_payment->txn_id && @$order->order_payment->txn_id != 'none'): ?><?php echo e(@$order->order_payment->txn_id); ?> <?php else: ?> - <?php endif; ?></p>
                                        </div>
                                        <div class="single_summery_list d-flex align-items-start gap_20">
                                            <div class="order_text_head d-flex align-items-center justify-content-between font_14 f_w_500 text-nowrap"><h5 class="font_14 f_w_500 m-0"><?php echo e(__('defaultTheme.payment_status')); ?></h5><span>:</span>
                                            </div>
                                            <p class="font_14 f_w_400 m-0">
                                                <?php if($order->is_paid == 1): ?>
                                                    <?php echo e(__('common.paid')); ?>

                                                <?php else: ?>
                                                    <?php echo e(__('common.pending')); ?>

                                                <?php endif; ?>
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- content ::end    -->
                </div>
                <div class="col-xl-4 col-lg-4">
                    <!-- order state list component -->
                        <?php $__currentLoopData = $processes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $process): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="dashboard_white_box style3 rounded-0 bg-white mb_20">
                                <div class="dashboard_white_box_body">
                                <h4 class="font_20 f_w_700 mb-2"><?php echo e($process->name); ?></h4>
                                <p class="lineHeight1 font_14 f_w_400 mb-0"><?php echo e($process->description); ?></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <!-- order state list component -->
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
                                <form action="<?php echo e(route('frontend.my_purchase_order_package_cancel')); ?>" method="post" id="order_cancel_form">
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
        (function($) {

           "use strict";

            $(document).ready(function() {

                $(".next-step").trigger('click');
                $('#reason').niceSelect();
                $(document).on('click','.order_cancel_by_id', function(e){
                    e.preventDefault();
                    $('#orderCancelReasonModal').modal('show');
                    $('.order_id').val($(this).attr('data-id'));
                });

                $(document).on('click','#is_received', function(){
                    var order_id = $(this).data('id');
                    var package_id = $(this).data('package_id');
                    console.log(order_id);
                    $("#pre-loader").show();
                    $.post('<?php echo e(route('change_receive_status_by_customer')); ?>', {_token:'<?php echo e(csrf_token()); ?>', order_id:order_id, package_id:package_id}, function(data){
                        if (data == 1) {
                            toastr.success("<?php echo e(__('defaultTheme.order_has_been_recieved')); ?>", "<?php echo e(__('common.success')); ?>");
                        }else {
                            toastr.error("<?php echo e(__('defaultTheme.order_not_recieved')); ?> <?php echo e(__('common.error_message')); ?>", "<?php echo e(__('common.error')); ?>");
                        }
                        $("#pre-loader").hide();
                        window.location.reload();
                    });
                });

                $(document).on('click','.change_delivery_state_status', function(){
                    change_delivery_state_status($(this).attr('data-id'));
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

                $(document).on('submit', '#order_cancel_form', function(){
                    $("#pre-loader").show();
                    $('#orderCancelReasonModal').modal('hide');
                });
            });

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.amazy.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/pages/profile/order_details.blade.php ENDPATH**/ ?>