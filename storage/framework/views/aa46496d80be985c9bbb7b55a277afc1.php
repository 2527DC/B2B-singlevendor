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
<form action="<?php echo e(route('frontend.checkout')); ?>" method="GET" enctype="multipart/form-data" id="mainOrderForm">
    <div class="checkout_v3_area">
        <div class="checkout_v3_left d-flex justify-content-end">
            <div class="checkout_v3_inner">
                <?php if(auth()->guard()->guest()): ?>
                    <div class="checout_head">
                        <i class="ti-folder"></i>
                        <p><?php echo e(__('defaultTheme.returning_customer')); ?>? <a href="<?php echo e(url('/login')); ?>"><?php echo e(__('defaultTheme.click_here_to_login')); ?></a></p>
                    </div>
                <?php endif; ?>
                <?php if(isModuleActive('MultiVendor')): ?>
                    <?php
                        $total = 0;
                        $subtotal = 0;
                        $actual_price = 0;
                        $tax = 0;
                        $current_pkg = 0;
                        $index = 0;
                        $total_shipping_charge = 0;
                        $is_physical_count = 0;
                    ?>

                    <?php
                        $package_wise_shipping = session()->get('package_wise_shipping');
                    ?>
                    <div class="checout_head_title d-flex align-items-center ">
                        <span class="flex-fill"><?php echo e(getNumberTranslate($total_items)); ?>  <?php echo e(__('common.items')); ?></span>
                        <span><?php echo e(__('common.quantity')); ?></span>
                        <span><?php echo e(__('common.price')); ?></span>
                    </div>
                    <?php $__currentLoopData = $cartData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller_id => $packages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $seller = App\Models\User::where('id',$seller_id)->first();
                            $is_physical_count = $package_wise_shipping[$seller_id]['physical_count'];
                            $seller_actual_price = 0;
                            $current_pkg ++;
                            $total_shipping_charge += $package_wise_shipping[$seller_id]['shipping_cost'];
                        ?>
                        <?php if(isModuleActive('INTShipping')): ?>
                            <?php
                                $profiles = \Modules\INTShipping\Entities\ShippingProfile::where('user_id',$seller_id)->get();
                            ?>
                        <?php endif; ?>
                        <div class="checkout_shiped_box mb_20">
                            <?php if(!isModuleActive('INTShipping')): ?>
                                <div class="checout_shiped_head flex-wrap d-flex align-items-center ">
                                    <span class="package_text flex-fill"><?php echo e(__('common.package')); ?> <?php echo e(getNumberTranslate($current_pkg)); ?> <?php echo e(__('common.of')); ?> <?php echo e(getNumberTranslate($total_package)); ?></span>
                                    <p class="flex-wrap">
                                        <span class="Shipped_text"><?php echo e(__('defaultTheme.shipping')); ?> :</span>
                                        <span class="name_text text-nowrap">
                                            <a class="link_style font_16 f_w_700 text-nowrap m-0 theme_hover text_color" href="javascript:void(0)">
                                                <?php if($is_physical_count > 0): ?>
                                                <span id="shipping_methods" data-target="shipping_methods_<?php echo e($package_wise_shipping[$seller_id]['seller_id']); ?>"><?php echo e(single_price($package_wise_shipping[$seller_id]['shipping_cost'])); ?> <?php echo e(__('common.via')); ?> <?php echo e($package_wise_shipping[$seller_id]['shipping_method']); ?>   <?php echo e($package_wise_shipping[$seller_id]['shipping_time']); ?> =></span>
                                                <?php else: ?>
                                                <?php echo e(single_price($package_wise_shipping[$seller_id]['shipping_cost'])); ?> <?php echo e(__('common.via')); ?> <?php echo e($package_wise_shipping[$seller_id]['shipping_method']); ?>   <?php echo e($package_wise_shipping[$seller_id]['shipping_time']); ?>

                                                <?php endif; ?>
                                            </a>
                                    </span>
                                    </p>
                                </div>
                            <?php endif; ?>
                            <div class="checout_shiped_products">
                                <div class="table-responsive mb-0">
                                    <table class="table amazy_table3 style3 mb-0">
                                        <tbody>
                                        <?php if(isModuleActive('INTShipping')): ?>
                                            <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($item->product_type == 'product' && @$item->product->product->product->is_physical): ?>
                                                    <?php
                                                        $is_physical_count += 1;
                                                    ?>
                                                <?php endif; ?>
                                                <?php if($item->product_type == 'product'): ?>
                                                    <?php
                                                        $actual_price += $item->total_price;
                                                        $seller_actual_price += $item->total_price;
                                                        $pro_price = 0;
                                                        if (isModuleActive('WholeSale')){
                                                            $w_main_price = 0;
                                                            $wholeSalePrices = $item->product->wholeSalePrices;
                                                            if($wholeSalePrices->count()){
                                                                foreach ($wholeSalePrices as $w_p){
                                                                    if ( ($w_p->min_qty<=$item->qty) && ($w_p->max_qty >=$item->qty) ){
                                                                        $w_main_price = $w_p->sell_price;
                                                                    }
                                                                    elseif($w_p->max_qty < $item->qty){
                                                                        $w_main_price = $w_p->sell_price;
                                                                    }
                                                                }
                                                            }

                                                            if ($w_main_price!=0){
                                                                $subtotal += $w_main_price * $item->qty;
                                                                $pro_price = $w_main_price;
                                                            }else{
                                                                $subtotal += @$item->product->sell_price * $item->qty;
                                                                $tax += @$item->product->product->tax * $item->qty;
                                                                $pro_price = @$item->product->sell_price;
                                                            }
                                                        }else{
                                                            $subtotal += @$item->product->sell_price * $item->qty;
                                                            $tax += @$item->product->product->tax * $item->qty;
                                                            $pro_price = @$item->product->sell_price;
                                                        }
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <a href="<?php echo e(singleProductURL(@$item->seller->slug, @$item->product->product->slug)); ?>" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                                <div class="thumb">
                                                                    <img src="<?php if(@$item->product->product->product->product_type == 1): ?>
                                                                                <?php echo e(showImage(@$item->product->product->product->thumbnail_image_source)); ?>

                                                                            <?php else: ?>
                                                                                <?php echo e(showImage(@$item->product->sku->variant_image?@$item->product->sku->variant_image:@$item->product->product->product->thumbnail_image_source)); ?>

                                                                            <?php endif; ?>" alt="<?php echo e(textLimit(@$item->product->product->product_name, 28)); ?>" title="<?php echo e(textLimit(@$item->product->product->product_name, 28)); ?>">
                                                                </div>
                                                                <div class="summery_pro_content">
                                                                    <h4 class="font_16 f_w_700 text-nowrap m-0 theme_hover"><?php echo e(textLimit(@$item->product->product->product_name, 28)); ?></h4>
                                                                    <p class="font_14 f_w_400 m-0 ">
                                                                        <?php if($item->product->product->product->product_type == 2): ?>
                                                                            <?php
                                                                                $countCombinatiion = count(@$item->product->product_variations);
                                                                            ?>
                                                                            <?php $__currentLoopData = $item->product->product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $combination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <?php if($combination->attribute->id == 1): ?>
                                                                                    <?php echo e($combination->attribute->name); ?>: <?php echo e($combination->attribute_value->color->name); ?>

                                                                                <?php else: ?>
                                                                                    <?php echo e($combination->attribute->name); ?>: <?php echo e($combination->attribute_value->value); ?>

                                                                                <?php endif; ?>

                                                                                <?php if($countCombinatiion > $key +1): ?>
                                                                                    ,
                                                                                <?php endif; ?>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php endif; ?>
                                                                    </p>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td class="d-none d-md-table-cell">
                                                            <div class="d-flex align-items-center gap_7">
                                                                <?php if($item->product->product->hasDeal): ?>
                                                                    <?php if($item->product->product->hasDeal->discount > 0): ?>
                                                                        <?php if($item->product->product->hasDeal->discount_type == 0): ?>
                                                                            <span class="green_badge text-nowrap">-<?php echo e(getNumberTranslate($item->product->product->hasDeal->discount)); ?>%</span>
                                                                            <span class="font_16 f_w_500 mute_text text-decoration-line-through text-nowrap"><?php echo e(single_price($pro_price)); ?></span>
                                                                        <?php else: ?>
                                                                            <span class="green_badge text-nowrap">-<?php echo e(single_price($item->product->product->hasDeal->discount)); ?></span>
                                                                            <span class="font_16 f_w_500 mute_text text-decoration-line-through text-nowrap"><?php echo e(single_price($pro_price)); ?></span>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                <?php else: ?>
                                                                    <?php if(@$item->product->product->hasDiscount == 'yes'): ?>
                                                                        <?php if($item->product->product->discount_type == 0): ?>
                                                                            <span class="green_badge text-nowrap">-<?php echo e($item->product->product->discount); ?>%</span>
                                                                            <span class="font_16 f_w_500 mute_text text-decoration-line-through text-nowrap"><?php echo e(single_price($pro_price)); ?></span>
                                                                        <?php else: ?>
                                                                            <span class="green_badge text-nowrap">-<?php echo e(single_price($item->product->product->discount)); ?></span>
                                                                            <span class="font_16 f_w_500 mute_text text-decoration-line-through text-nowrap"><?php echo e(single_price($pro_price)); ?></span>
                                                                        <?php endif; ?>
                                                                    <?php else: ?>
                                                                        <span class="font_16 f_w_500 mute_text text-nowrap"><?php echo e(single_price($pro_price)); ?></span>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>

                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h4 class="font_16_top f_w_500 m-0 text-nowrap"><?php echo e(__('common.qty')); ?>: <?php echo e(getNumberTranslate($item->qty)); ?></h4>
                                                        </td>
                                                        <td>
                                                            <h4 class="font_16 f_w_500 m-0 text-nowrap"><?php echo e(single_price($item->total_price)); ?></h4>
                                                        </td>
                                                    </tr>

                                                <?php else: ?>
                                                <?php
                                                    $actual_price += $item->total_price;
                                                    $seller_actual_price += $item->total_price;
                                                ?>
                                                <?php if(is_null($item->giftCard->type)): ?>
                                                    <?php
                                                        $subtotal += $item->giftCard->sell_price * $item->qty;
                                                    ?>
                                                <?php else: ?>
                                                    <?php
                                                        $subtotal += $item->giftCard->addGiftCardInfo->gift_sell_price * $item->qty;
                                                    ?>
                                                <?php endif; ?>
                                                    <tr>
                                                        <td>
                                                            <a href="<?php echo e(route('frontend.gift-card.show',$item->giftCard->sku)); ?>" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                                <div class="thumb">
                                                                    <img src="<?php echo e(showImage($item->giftCard->thumbnail_image)); ?>" alt="<?php echo e(textLimit(@$item->giftCard->name, 28)); ?>" title="<?php echo e(textLimit(@$item->giftCard->name, 28)); ?>">
                                                                </div>
                                                                <div class="summery_pro_content">
                                                                    <h4 class="font_16 f_w_700 text-nowrap m-0 theme_hover"><?php echo e(textLimit(@$item->giftCard->name, 28)); ?></h4>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center gap_7">
                                                                <?php if(is_null($item->giftCard->type)): ?>
                                                                    <?php if($item->giftCard->hasDiscount()): ?>
                                                                        <?php if($item->giftCard->discount_type == 0): ?>
                                                                            <span class="green_badge text-nowrap">-<?php echo e($item->giftCard->discount); ?>%</span>
                                                                        <?php else: ?>
                                                                            <span class="green_badge text-nowrap">-<?php echo e(single_price($item->giftCard->discount)); ?></span>
                                                                        <?php endif; ?>
                                                                        <span class="font_16 f_w_500 mute_text text-decoration-line-through text-nowrap"><?php echo e(single_price($item->giftCard->sell_price)); ?></span>
                                                                    <?php else: ?>
                                                                        <span class="font_16 f_w_500 mute_text text-nowrap"><?php echo e(single_price($item->giftCard->sell_price)); ?></span>
                                                                    <?php endif; ?>
                                                                <?php else: ?>
                                                                    <?php if($item->giftCard->addGiftCardInfo->hasDiscount()): ?>
                                                                        <?php if($item->giftCard->addGiftCardInfo->gift_discount_type == 0): ?>
                                                                            <span class="green_badge text-nowrap">-<?php echo e($item->giftCard->addGiftCardInfo->gift_discount_amount); ?>%</span>
                                                                        <?php else: ?>
                                                                            <span class="green_badge text-nowrap">-<?php echo e(single_price($item->giftCard->addGiftCardInfo->gift_discount_amount)); ?></span>
                                                                        <?php endif; ?>
                                                                        <span class="font_16 f_w_500 mute_text text-decoration-line-through text-nowrap"><?php echo e(single_price($item->giftCard->addGiftCardInfo->gift_selling_price)); ?></span>
                                                                    <?php else: ?>
                                                                        <span class="font_16 f_w_500 mute_text text-nowrap"><?php echo e(single_price($item->giftCard->addGiftCardInfo->gift_selling_price)); ?></span>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h4 class="font_16_top f_w_500 m-0 text-nowrap"><?php echo e(__('common.qty')); ?>: <?php echo e($item->qty); ?></h4>
                                                        </td>
                                                        <td>
                                                            <h4 class="font_16 f_w_500 m-0 text-nowrap"><?php echo e(single_price($item->total_price)); ?></h4>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                <?php if($item->product_type == 'product' && @$item->product->product->product->is_physical): ?>
                                                <?php
                                                    $isIntselected = \Modules\INTShipping\Entities\SellerProductShippingProfile::where('seller_product_id',$item->product->product->product->id)->first();
                                                ?>
                                                <?php if(!empty($isIntselected) && isModuleActive('INTShipping') && !empty($shipping_address)): ?>
                                                    <tr class="custom-tr" >
                                                        <td colspan="4" class="p-0 border-0">
                                                        <?php
                                                            $products = \Modules\INTShipping\Entities\SellerProductShippingProfile::whereHas('profile',function($query) use ($seller_id){
                                                                return $query->where('user_id',$seller_id);
                                                            })->where('seller_product_id',$item->product->product_id)->get();
                                                            $rates = [];

                                                            foreach ($products as $product) {
                                                                if($shipping_address != null){
                                                                    $zones =  \Modules\INTShipping\Entities\ShippingZone::where('shipping_profile_id',$product->shipping_profile_id)->WhereHas('state_list', function($query) use($shipping_address){
                                                                        return $query->where('state_id', $shipping_address->state);
                                                                    })->get();
                                                                }else{
                                                                    $zones = [];
                                                                }

                                                                foreach($zones as $zone){
                                                                    foreach($zone->rates as $rate){
                                                                        $rates[] = $rate;
                                                                    }
                                                                }
                                                            }
                                                        ?>

                                                        <select name="intshipping_cartItem[]" id="uniqueCartId<?php echo e($item->id); ?>" class="theme_select w-100 ck-select intshiping border-top-0" data-id="<?php echo e($item->id); ?>">
                                                            <option value="0" selected disabled><?php echo e(__('defaultTheme.select_shipping')); ?></option>
                                                            <?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php
                                                                    $product_shipping_cost = 0;
                                                                ?>
                                                                <?php if($rate->base_on_item == 1): ?>
                                                                    <?php if($rate->minimum * 1000 <= $item->product->sku->weight && $rate->maximum * 1000 >= $item->product->sku->weight): ?>
                                                                        <?php
                                                                            $product_shipping_cost = ($item->product->sku->weight * $item->qty / 100) * $rate->rate_cost + ($item->product->sku->additional_shipping * $item->qty);
                                                                        ?>
                                                                        <option value="<?php echo e(($product_shipping_cost)); ?> <?php echo e($rate->id); ?>"><?php echo e($rate->rate_name); ?> - <?php echo e(single_price($product_shipping_cost)); ?> - <?php echo e($rate->shipment_time); ?></option>
                                                                    <?php endif; ?>
                                                                <?php elseif($rate->base_on_item == 2): ?>
                                                                    <?php if($rate->minimum <= $item->price && $rate->maximum >= $item->price): ?>
                                                                        <?php
                                                                            $product_shipping_cost = ($item->total_price / 100) * $rate->rate_cost + ($item->product->sku->additional_shipping * $item->qty);
                                                                        ?>
                                                                        <option value="<?php echo e(($product_shipping_cost)); ?> <?php echo e($rate->id); ?>"><?php echo e($rate->rate_name); ?> - <?php echo e(single_price($product_shipping_cost)); ?> - <?php echo e($rate->shipment_time); ?></option>
                                                                    <?php endif; ?>
                                                                <?php else: ?>
                                                                    <?php if($rate->minimum <= $item->price && $rate->maximum >= $item->price): ?>
                                                                        <?php
                                                                            if(sellerWiseShippingConfig($seller_id)['amount_multiply_with_qty']){
                                                                                $product_shipping_cost = ($rate->rate_cost + $item->product->sku->additional_shipping) * $item->qty;
                                                                            }else{
                                                                                $product_shipping_cost = $rate->rate_cost + ($item->product->sku->additional_shipping * $item->qty);
                                                                            }
                                                                        ?>
                                                                        <option value="<?php echo e($product_shipping_cost); ?> <?php echo e($rate->id); ?>"><?php echo e($rate->rate_name); ?> - <?php echo e(single_price($product_shipping_cost)); ?> - <?php echo e($rate->shipment_time); ?></option>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <span class="text-danger" id="error_intship_cart_item_<?php echo e($item->id); ?>"></span>

                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($item->product_type == 'product' && @$item->product->product->product->is_physical): ?>
                                                    <?php
                                                        $is_physical_count += 1;
                                                    ?>
                                                <?php endif; ?>
                                                <?php if($item->product_type == 'product'): ?>
                                                    <?php
                                                        $actual_price += $item->total_price;
                                                        $seller_actual_price += $item->total_price;
                                                        $pro_price = 0;
                                                        if (isModuleActive('WholeSale')){
                                                            $w_main_price = 0;
                                                            $wholeSalePrices = $item->product->wholeSalePrices;
                                                            if($wholeSalePrices->count()){
                                                                foreach ($wholeSalePrices as $w_p){
                                                                    if ( ($w_p->min_qty<=$item->qty) && ($w_p->max_qty >=$item->qty) ){
                                                                        $w_main_price = $w_p->sell_price;
                                                                    }
                                                                    elseif($w_p->max_qty < $item->qty){
                                                                        $w_main_price = $w_p->sell_price;
                                                                    }
                                                                }
                                                            }

                                                            if ($w_main_price!=0){
                                                                $subtotal += $w_main_price * $item->qty;
                                                                $pro_price = $w_main_price;
                                                            }else{
                                                                $subtotal += @$item->product->sell_price * $item->qty;
                                                                $tax += @$item->product->product->tax * $item->qty;
                                                                $pro_price = @$item->product->sell_price;
                                                            }
                                                        }else{
                                                            $subtotal += @$item->product->sell_price * $item->qty;
                                                            $tax += @$item->product->product->tax * $item->qty;
                                                            $pro_price = @$item->product->sell_price;
                                                        }
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <a href="<?php echo e(singleProductURL(@$item->seller->slug, @$item->product->product->slug)); ?>" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                                <div class="thumb">
                                                                    <img src="<?php if(@$item->product->product->product->product_type == 1): ?>
                                                                                <?php echo e(showImage(@$item->product->product->product->thumbnail_image_source)); ?>

                                                                            <?php else: ?>
                                                                                <?php echo e(showImage(@$item->product->sku->variant_image?@$item->product->sku->variant_image:@$item->product->product->product->thumbnail_image_source)); ?>

                                                                            <?php endif; ?>" alt="<?php echo e(textLimit(@$item->product->product->product_name, 28)); ?>" title="<?php echo e(textLimit(@$item->product->product->product_name, 28)); ?>">
                                                                </div>
                                                                <div class="summery_pro_content">
                                                                    <h4 class="font_16 f_w_700 text-nowrap m-0 theme_hover"><?php echo e(textLimit(@$item->product->product->product_name, 28)); ?></h4>
                                                                    <p class="font_14 f_w_400 m-0 ">
                                                                        <?php if($item->product->product->product->product_type == 2): ?>
                                                                            <?php
                                                                                $countCombinatiion = count(@$item->product->product_variations);
                                                                            ?>
                                                                            <?php $__currentLoopData = $item->product->product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $combination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <?php if($combination->attribute->id == 1): ?>
                                                                                    <?php echo e($combination->attribute->name); ?>: <?php echo e($combination->attribute_value->color->name); ?>

                                                                                <?php else: ?>
                                                                                    <?php echo e($combination->attribute->name); ?>: <?php echo e($combination->attribute_value->value); ?>

                                                                                <?php endif; ?>

                                                                                <?php if($countCombinatiion > $key +1): ?>
                                                                                    ,
                                                                                <?php endif; ?>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php endif; ?>
                                                                    </p>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>

                                                            <?php if(!Session::has('auction_type')): ?>
                                                            <div class="d-flex align-items-center gap_7">
                                                                <?php if($item->product->product->hasDeal): ?>
                                                                    <?php if($item->product->product->hasDeal->discount > 0): ?>
                                                                        <?php if($item->product->product->hasDeal->discount_type == 0): ?>
                                                                            <span class="green_badge text-nowrap">-<?php echo e($item->product->product->hasDeal->discount); ?>%</span>
                                                                            <span class="font_16 f_w_500 mute_text text-decoration-line-through text-nowrap"><?php echo e(single_price($pro_price)); ?></span>
                                                                        <?php else: ?>
                                                                            <span class="green_badge text-nowrap">-<?php echo e(single_price($item->product->product->hasDeal->discount)); ?></span>
                                                                            <span class="font_16 f_w_500 mute_text text-decoration-line-through text-nowrap"><?php echo e(single_price($pro_price)); ?></span>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                <?php else: ?>
                                                                    <?php if(@$item->product->product->hasDiscount == 'yes'): ?>
                                                                        <?php if($item->product->product->discount_type == 0): ?>
                                                                            <span class="green_badge text-nowrap">-<?php echo e($item->product->product->discount); ?>%</span>
                                                                            <span class="font_16 f_w_500 mute_text text-decoration-line-through text-nowrap"><?php echo e(single_price($pro_price)); ?></span>
                                                                        <?php else: ?>
                                                                            <span class="green_badge text-nowrap">-<?php echo e(single_price($item->product->product->discount)); ?></span>
                                                                            <span class="font_16 f_w_500 mute_text text-decoration-line-through text-nowrap"><?php echo e(single_price($pro_price)); ?></span>
                                                                        <?php endif; ?>
                                                                    <?php else: ?>
                                                                        <span class="font_16 f_w_500 mute_text text-nowrap"><?php echo e(single_price($pro_price)); ?></span>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>

                                                            </div>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <h4 class="font_16_top f_w_500 m-0 text-nowrap"><?php echo e(__('common.qty')); ?>: <?php echo e(getNumberTranslate($item->qty)); ?></h4>
                                                        </td>
                                                        <td>
                                                            <h4 class="font_16 f_w_500 m-0 text-nowrap"><?php echo e(single_price($item->total_price)); ?></h4>
                                                        </td>
                                                    </tr>

                                                <?php else: ?>
                                                <?php
                                                    $actual_price += $item->total_price;
                                                    $seller_actual_price += $item->total_price;
                                                    $subtotal += $item->giftCard->sell_price * $item->qty;
                                                ?>
                                                <tr>
                                                    <td>
                                                        <a href="<?php echo e(route('frontend.gift-card.show',$item->giftCard->sku)); ?>" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                            <div class="thumb">
                                                                <img src="<?php echo e(showImage($item->giftCard->thumbnail_image)); ?>" alt="<?php echo e(textLimit(@$item->giftCard->name, 28)); ?>" title="<?php echo e(textLimit(@$item->giftCard->name, 28)); ?>">
                                                            </div>
                                                            <div class="summery_pro_content">
                                                                <h4 class="font_16 f_w_700 text-nowrap m-0 theme_hover"><?php echo e(textLimit(@$item->giftCard->name, 28)); ?></h4>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap_7">
                                                            <?php if($item->giftCard->hasDiscount()): ?>
                                                                <?php if($item->giftCard->discount_type == 0): ?>
                                                                    <span class="green_badge text-nowrap">-<?php echo e($item->giftCard->discount); ?>%</span>
                                                                <?php else: ?>
                                                                    <span class="green_badge text-nowrap">-<?php echo e(single_price($item->giftCard->discount)); ?></span>
                                                                <?php endif; ?>
                                                                <span class="font_16 f_w_500 mute_text text-decoration-line-through text-nowrap"><?php echo e(single_price($item->giftCard->sell_price)); ?></span>
                                                            <?php else: ?>
                                                                <span class="font_16 f_w_500 mute_text text-nowrap"><?php echo e(single_price($item->giftCard->sell_price)); ?></span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h4 class="font_16_top f_w_500 m-0 text-nowrap"><?php echo e(__('common.qty')); ?>: <?php echo e(getNumberTranslate($item->qty)); ?></h4>
                                                    </td>
                                                    <td>
                                                        <h4 class="font_16 f_w_500 m-0 text-nowrap"><?php echo e(single_price($item->total_price)); ?></h4>
                                                    </td>
                                                </tr>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php
                            $total_check = $package_wise_shipping[$seller_id]['shipping_cost'] + $package_wise_shipping[$seller_id]['additional_cost'] + $seller_actual_price;

                            $a_carriers = \Modules\Shipping\Entities\Carrier::where('type','Automatic')->whereHas('carrierConfigFrontend',function ($q) use ($seller){
                                $q->where('seller_id',$seller->id)->where('carrier_status',1);
                            });
                            $m_carriers = \Modules\Shipping\Entities\Carrier::where('type','Manual')->where('status', 1)->where('created_by',$seller->id);
                            if(sellerWiseShippingConfig(1)['seller_use_shiproket']){
                                $carriers = $a_carriers->unionAll($m_carriers)->get()->pluck('id')->toArray();
                            }else{
                                $carriers = $m_carriers->get()->pluck('id')->toArray();
                            }
                            $seller_shippings = $shipping_methods->where('request_by_user',$seller->id)->where('minimum_shopping','<=', $total_check);
                            if(count($seller_shippings) < 1){
                                $seller_shippings = $shipping_methods->where('request_by_user',$seller->id)->whereIn('carrier_id',$carriers);
                            }
                        ?>
                        <?php if(!isModuleActive('INTShipping')): ?>
                            <?php echo $__env->make('frontend.amazy.partials._cart_shipping_method', ['shipping_methods' => $seller_shippings, 'package'=>$package_wise_shipping[$seller_id],'is_physical_count' => $is_physical_count], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <div class="shiping_address_box checkout_form m-0">
                    <h3 class="check_v3_title mb_25"><?php echo e(__('defaultTheme.contact_information')); ?></h3>
                    <?php if(auth()->check()): ?>
                        <div class="Contact_sVendor_box d-flex align-items-center mb_30">
                            <div class="thumb">
                                <img class="img-fluid" src="<?php echo e(showImage(auth()->user()->avatar?auth()->user()->avatar:'frontend/default/img/avatar.jpg')); ?>" alt="<?php echo e(textLimit(auth()->user()->first_name.' '.auth()->user()->last_name,28)); ?>" title="<?php echo e(textLimit(auth()->user()->first_name.' '.auth()->user()->last_name,28)); ?>">
                            </div>
                            <div class="Contact_sVendor_info">
                                <h5><?php echo e(textLimit(auth()->user()->first_name.' '.auth()->user()->last_name,28)); ?> <span>(<?php echo e(auth()->user()->email); ?>)</span> </h5>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="mb_20">
                            <label for="name" class="primary_label2 style3"><?php echo e(__('common.email')); ?> <span>*</span></label>
                            <input class="primary_input3 style5 radius_3px" type="email" id="email" placeholder="<?php echo e(__('common.email')); ?>"  value="<?php echo e($shipping_address?$shipping_address->email:''); ?>" name="email">
                        </div>
                    <?php endif; ?>
                    <div class="col-12 mb_25">
                        <label class="primary_checkbox d-flex">
                            <input type="checkbox" name="news_letter" value="1" checked>
                            <span class="checkmark mr_15"></span>
                            <span class="label_name f_w_400 "><?php echo e(__('defaultTheme.email_me_with_news_and_offers')); ?></span>
                        </label>
                    </div>
                    <div class="billing_address">
                        <div class="shipping_delivery_div">
                            <?php
                                $delivery_info = null;
                            ?>
                            <h3 class="check_v3_title mb_25"> <span class="address_title"><?php if(!$delivery_info || $delivery_info && $delivery_info['delivery_type'] == 'home_delivery'): ?> <?php echo e(__('shipping.shipping_address')); ?> <?php else: ?> <?php echo e(__('common.billing_address')); ?> <?php endif; ?></span>
                                <?php if($shipping_address): ?>
                                    <span id="address_btn">
                                        <a href="javascript:void(0)" class="amaz_badge_btn3 text-uppercase text-nowrap link_btn_design"><?php echo e(__('common.edit')); ?></a>
                                    </span>
                                <?php elseif(isModuleActive('INTShipping') && isModuleActive('MultiVendor')): ?>
                                    <span id="address_btn">
                                        <a href="javascript:void(0)" class="amaz_badge_btn3 text-uppercase text-nowrap saveAddress"><?php echo e(__('common.save')); ?></a>
                                    </span>
                                <?php endif; ?>
                            </h3>

                            <?php if(!isModuleActive('MultiVendor')): ?>
                                <?php
                                    if(session()->has('delivery_info')){
                                        $delivery_info = session()->get('delivery_info');
                                    }
                                ?>
                                <div class="delivery_type_button">
                                    <label class="primary_bulet_checkbox">
                                        <input type="radio" name="delivery_type" class="payment_method"  value="home_delivery" <?php if(!$delivery_info || $delivery_info && $delivery_info['delivery_type'] == 'home_delivery'): ?> checked <?php endif; ?>>
                                        <span class="checkmark"></span>
                                    </label>
                                    <a><?php echo e(__('shipping.home_delivery')); ?></a>
                                    <?php if(session()->has('buy_it_now') && @$cartData->where('is_buy_now', 1)->first()->product_type == 'gift_card'): ?>
                                    <?php else: ?>
                                        <?php if(count($pickup_locations) > 0): ?>
                                            <label class="primary_bulet_checkbox ml_10">
                                                <input type="radio" name="delivery_type" class="payment_method"  value="pickup_location" <?php if($delivery_info && $delivery_info['delivery_type'] == 'pickup_location'): ?> checked <?php endif; ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                            <a><?php echo e(__('shipping.pickup_location')); ?></a>

                                            <div class="pick_location_list_div mt_30 <?php if(!$delivery_info || $delivery_info && $delivery_info['delivery_type'] == 'home_delivery'): ?> d-none <?php endif; ?>">
                                                <label class="primary_label2 style2"><?php echo e(__('shipping.pickup_location')); ?> <span>*</span></label>
                                                <select class="theme_select style2 wide" name="pickup_location" id="pickup_location" autocomplete="off">
                                                    <option value=""><?php echo e(__('defaultTheme.select_from_options')); ?></option>
                                                    <?php $__currentLoopData = $pickup_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pickup_location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e(base64_encode($pickup_location->id)); ?>" <?php if($delivery_info && $delivery_info['delivery_type'] == 'pickup_location' && $delivery_info['pickup_location'] == base64_encode($pickup_location->id)): ?> selected <?php endif; ?>>
                                                            <?php echo e($pickup_location->pickup_location); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <span class="text-danger pick_location_list_div <?php if(!$delivery_info || $delivery_info && $delivery_info['delivery_type'] == 'home_delivery'): ?> d-none <?php endif; ?>" id="error_pickup_location"><?php echo e($errors->first('pickup_location')); ?></span>

                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>

                            <?php endif; ?>
                        </div>
                        <div class="row shipping_address_div mb_30 <?php echo e($shipping_address?'':"d-none"); ?>">
                            <?php
                                $user_name = '';
                                $user_email = '';
                                $user_phone = '';
                            ?>
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table-borderless">
                                        <tr>
                                            <td> <?php echo e(__('common.name')); ?></td>
                                            <td>: <?php echo e($shipping_address?$shipping_address->name:$user_name); ?></td>
                                        </tr>
                                        <tr>
                                            <td> <?php echo e(__('common.address')); ?></td>
                                            <td>: <?php echo e($shipping_address?$shipping_address->address:''); ?></td>
                                        </tr>
                                        <tr>
                                            <td> <?php echo e(__('common.email')); ?></td>
                                            <td>:  <?php echo e($shipping_address?$shipping_address->email:$user_email); ?></td>
                                        </tr>
                                        <tr>
                                            <td> <?php echo e(__('common.phone')); ?></td>
                                            <td>: <?php echo e(getNumberTranslate($shipping_address?$shipping_address->phone:$user_phone)); ?></td>
                                        </tr>
                                        <tr>
                                            <td> <?php echo e(__('common.postal_code_or_pin_code')); ?></td>
                                            <td>: <?php echo e(getNumberTranslate($shipping_address?$shipping_address->postal_code:'')); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row shipping_address_edit_div <?php echo e($shipping_address?'d-none':""); ?>">
                            <?php
                                $user_name = '';
                                $user_email = '';
                                $user_phone = '';
                            ?>
                            <?php if(auth()->check()): ?>
                                <div class="col-lg-12">
                                    <label class="primary_label2 style2" for="name"><?php echo e(__('defaultTheme.address_list')); ?> <span>*</span></label>
                                    <select class="theme_select style2 wide mb_20" name="address_id" id="address_id">
                                        <option value="0"><?php echo e(__('defaultTheme.new_address')); ?></option>
                                        <?php $__currentLoopData = auth()->user()->customerAddresses->where('is_updated',0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($address->id); ?>" <?php if($shipping_address && $shipping_address->id == $address->id): ?> selected <?php endif; ?> ><?php echo e($address->address); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <?php
                                    $user_name = auth()->user()->first_name;
                                    $user_email = auth()->user()->email?auth()->user()->email:'';
                                    $user_phone = auth()->user()->phone?auth()->user()->phone:'';
                                ?>
                            <?php endif; ?>
                            <div class="col-lg-6 mb_20">
                                <label class="primary_label2 style3"><?php echo e(__('common.name')); ?> <span>*</span></label>
                                <input class="primary_input3 style5 radius_3px" id="name" name="name" value="<?php echo e($shipping_address?$shipping_address->name:$user_name); ?>" type="text"  placeholder="<?php echo e(__('common.name')); ?>">
                                <span class="text-danger" id="error_name"><?php echo e($errors->first('name')); ?></span>
                            </div>

                            <?php if($checkoutField[0]->field_name=='address' && $checkoutField[0]->visibility==1): ?>
                            <div class="col-lg-6 mb_20">
                                <label class="primary_label2 style3" for="address"><?php echo e(__('common.address')); ?> <?php if($checkoutField[0]->required==1): ?> <span>*</span> <?php endif; ?> </label>
                                <input class="primary_input3 style5 radius_3px" name="address" id="address" type="text"  placeholder="<?php echo e(__('common.address')); ?>" value="<?php echo e($shipping_address?$shipping_address->address:''); ?>">
                                <span class="text-danger" id="error_address"><?php echo e($errors->first('address')); ?></span>
                            </div>
                            <?php endif; ?>

                            <?php if(auth()->check()): ?>
                            <div class="col-lg-6 mb_20">
                                <label class="primary_label2 style3" for="email"><?php echo e(__('common.email')); ?> <span>*</span></label>
                                <input class="primary_input3 style5 radius_3px" type="email" name="email" id="email" placeholder="<?php echo e(__('common.email')); ?>" value="<?php echo e($shipping_address?$shipping_address->email:$user_email); ?>">
                                <span class="text-danger" id="error_email"><?php echo e($errors->first('email')); ?></span>
                            </div>
                            <?php endif; ?>

                            <div class="col-lg-6 mb_20">
                                <label class="primary_label2 style3" for="phone"><?php echo e(__('common.phone')); ?> <span>*</span></label>
                                <input class="primary_input3 style5 radius_3px" type="text" name="phone" data-min="<?php echo e(app('general_setting')->min_digit); ?>" data-max="<?php echo e(app('general_setting')->max_digit); ?>" value="<?php echo e($shipping_address?$shipping_address->phone:$user_phone); ?>" id="phone" placeholder="<?php echo e(__('common.phone')); ?>">
                                <span class="text-danger" id="error_phone"><?php echo e($errors->first('phone')); ?></span>
                            </div>

                            <?php if($checkoutField[3]->field_name=='country' && $checkoutField[3]->visibility==1): ?>
                            <div class="col-lg-6 mb_20">
                                <label class="primary_label2 style3"><?php echo e(__('common.country')); ?> <?php if($checkoutField[3]->required==1): ?> <span>*</span> <?php endif; ?> </label>
                                <select class="theme_select style2 wide" name="country" id="country" autocomplete="off">
                                    <option value=""><?php echo e(__('defaultTheme.select_from_options')); ?></option>
                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($country->id); ?>" <?php if($shipping_address && $shipping_address->country == $country->id): ?> selected <?php elseif(!$shipping_address && app('general_setting')->default_country == $country->id): ?> selected <?php endif; ?>><?php echo e($country->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="text-danger" id="error_country"><?php echo e($errors->first('country')); ?></span>
                            </div>
                            <?php endif; ?>

                            <?php if($checkoutField[2]->field_name=='state' && $checkoutField[2]->visibility==1): ?>
                            <div class="col-lg-6 mb_20">
                                <label class="primary_label2 style3"><?php echo e(__('common.state')); ?> <?php if($checkoutField[2]->required==1): ?> <span>*</span> <?php endif; ?> </label>
                                <select class="theme_select style2 wide" name="state" id="state" autocomplete="off">
                                    <option value=""><?php echo e(__('defaultTheme.select_from_options')); ?></option>
                                    <?php if(app('general_setting')->default_country != null): ?>
                                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($state->id); ?>" <?php if($shipping_address && $shipping_address->state == $state->id): ?> selected <?php elseif(app('general_setting')->default_state == $state->id): ?> selected <?php endif; ?>><?php echo e($state->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <span class="text-danger" id="error_state"><?php echo e($errors->first('state')); ?></span>
                            </div>
                            <?php endif; ?>

                            <?php if($checkoutField[1]->field_name=='city' && $checkoutField[1]->visibility==1): ?>
                            <div class="col-lg-6 mb_20">
                                <label class="primary_label2 style3"><?php echo e(__('common.city')); ?> <?php if($checkoutField[1]->required==1): ?><span>*</span> <?php endif; ?> </label>
                                <select class="theme_select style2 wide" name="city" id="city" autocomplete="off">
                                    <option value=""><?php echo e(__('defaultTheme.select_from_options')); ?></option>
                                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($city->id); ?>" <?php if($shipping_address && $shipping_address->city == $city->id): ?> selected <?php endif; ?>><?php echo e($city->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="text-danger" id="error_city"><?php echo e($errors->first('city')); ?></span>
                            </div>
                            <?php endif; ?>

                            <?php if($checkoutField[4]->field_name=='postal' && $checkoutField[4]->visibility==1): ?>
                            <div class="col-lg-6 mb_20">
                                <label class="primary_label2 style3" for="postal_code"><?php echo e(__('common.postal_code_or_pin_code')); ?> <?php if($postalCodeRequired): ?> <?php if($checkoutField[4]->required==1): ?><span>*</span> <?php endif; ?> <?php endif; ?></label>
                                <input class="primary_input3 style5 radius_3px" type="text"  id="postal_code" name="postal_code" placeholder="<?php echo e(__('common.postal_code')); ?>" value="<?php echo e($shipping_address?$shipping_address->postal_code:''); ?>">
                                <span class="text-danger" id="error_postal_code"><?php echo e($errors->first('postal_code')); ?></span>
                            </div>
                            <?php endif; ?>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="primary_label2 style2" for="note"><?php echo e(__('common.note')); ?></label>
                                <textarea  name="note" id="note" placeholder="<?php echo e(__('common.note')); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('common.note')); ?>'" class="primary_textarea4 radius_5px mb_25"></textarea>
                                <span class="text-danger"  id="error_note"></span>
                            </div>
                            <?php if(env('NOCAPTCHA_FOR_CHECKOUT') == "true" && env('NOCAPTCHA_INVISIBLE') != "true"): ?>
                            <div class="col-12 mb_20">
                                <div class="g-recaptcha" data-callback="callback" data-sitekey="<?php echo e(env('NOCAPTCHA_SITEKEY')); ?>"></div>
                                <span class="text-danger" id="captcha_response"><?php echo e($errors->first('g-recaptcha-response')); ?></span>
                            </div>
                            <?php endif; ?>
                            <div class="col-12 mb_25">
                                <label class="primary_checkbox d-flex">
                                    <input value="1" id="term_check" checked type="checkbox">
                                    <span class="checkmark mr_15"></span>
                                    <span class="label_name f_w_400 "><?php echo e(__('defaultTheme.I agree with the terms and conditions')); ?>.</span>
                                    <span id="error_term_check" class="text-danger"></span>
                                </label>
                            </div>
                            <div class="col-12">
                                <div class="check_v3_btns flex-wrap d-flex align-items-center">
                                    <?php if(isModuleActive('MultiVendor')): ?>
                                        <input type="hidden" name="step" value="select_payment">
                                        <?php if(env('NOCAPTCHA_FOR_CHECKOUT') == "true" && env('NOCAPTCHA_INVISIBLE') == "true"): ?>
                                            <button type="button" class="g-recaptcha amaz_primary_btn style2  min_200 text-center text-uppercase" data-sitekey="<?php echo e(env('NOCAPTCHA_SITEKEY')); ?>" data-size="invisible" data-callback="onSubmit"><?php echo e(__('defaultTheme.continue_to_shipping')); ?></button>
                                        <?php else: ?>
                                            <button type="submit" class="amaz_primary_btn style2  min_200 text-center text-uppercase "><?php echo e(__('defaultTheme.continue_to_shipping')); ?></button>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div id="next_step_btn_div">
                                            <?php if(!$delivery_info || $delivery_info && $delivery_info['delivery_type'] == 'home_delivery'): ?>
                                                <input type="hidden" name="step" value="select_shipping">
                                                <?php if(env('NOCAPTCHA_FOR_CHECKOUT') == "true" && env('NOCAPTCHA_INVISIBLE') == "true"): ?>
                                                    <button type="button" class="g-recaptcha amaz_primary_btn style2  min_200 text-center text-uppercase" data-sitekey="<?php echo e(env('NOCAPTCHA_SITEKEY')); ?>" data-size="invisible" data-callback="onSubmit"><?php echo e(__('defaultTheme.continue_to_shipping')); ?></button>
                                                <?php else: ?>
                                                    <button type="submit" class="amaz_primary_btn style2  min_200 text-center text-uppercase "><?php echo e(__('defaultTheme.continue_to_shipping')); ?></button>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <input type="hidden" name="step" value="select_payment">
                                                <input type="hidden" name="shipping_method" value="<?php echo e(encrypt($free_shipping_for_pickup_location->id)); ?>">
                                                <?php if(env('NOCAPTCHA_FOR_CHECKOUT') == "true" && env('NOCAPTCHA_INVISIBLE') == "true"): ?>
                                                    <button type="button" class="g-recaptcha amaz_primary_btn style2  min_200 text-center text-uppercase" data-sitekey="<?php echo e(env('NOCAPTCHA_SITEKEY')); ?>" data-size="invisible" data-callback="onSubmit"><?php echo e(__('defaultTheme.continue_to_payment')); ?></button>
                                                <?php else: ?>
                                                    <button type="submit" class="amaz_primary_btn style2  min_200 text-center text-uppercase "><?php echo e(__('defaultTheme.continue_to_payment')); ?></button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <a href="<?php echo e(url('/cart')); ?>" class="return_text"><?php echo e(__('defaultTheme.return_to_cart')); ?></a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="checkout_v3_right d-flex justify-content-start">
            <div class="order_sumery_box flex-fill">
                <?php if(!isModuleActive('MultiVendor')): ?>
                    <?php
                        $total = 0;
                        $tax = 0;
                        $subtotal = 0;
                        $actual_price = 0;
                    ?>
                    <?php $__currentLoopData = $cartData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($cart->product_type == 'product'): ?>

                            <div class="singleVendor_product_lists">
                                <div class="singleVendor_product_list d-flex align-items-center cart_thumb_div">
                                    <div class="thumb">
                                        <img src="
                                        <?php if($cart->product->product->product->product_type == 1): ?>
                                        <?php echo e(showImage($cart->product->product->product->thumbnail_image_source)); ?>

                                        <?php else: ?>
                                        <?php echo e(showImage(@$cart->product->sku->variant_image?@$cart->product->sku->variant_image:@$cart->product->product->product->thumbnail_image_source)); ?>

                                        <?php endif; ?>
                                        " alt="<?php echo e(textLimit(@$cart->product->product->product_name, 28)); ?>" title="<?php echo e(textLimit(@$cart->product->product->product_name, 28)); ?>">
                                    </div>
                                    <div class="product_list_content">
                                        <h4><a href="<?php echo e(singleProductURL(@$cart->seller->slug, @$cart->product->product->slug)); ?>"><?php echo e(textLimit(@$cart->product->product->product_name, 28)); ?></a></h4>
                                        <?php if($cart->product->product->product->product_type == 2): ?>
                                            <?php
                                                $countCombinatiion = count(@$cart->product->product_variations);
                                            ?>
                                            <p>
                                            <?php $__currentLoopData = $cart->product->product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $combination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                        <h5 class="d-flex align-items-center"><span class="product_count_text"><?php echo e(getNumberTranslate($cart->qty)); ?><span>x</span></span><?php echo e(single_price($cart->price)); ?></h5>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $actual_price += $cart->total_price;
                                if (isModuleActive('WholeSale')){
                                    $w_main_price = 0;
                                    $wholeSalePrices = $cart->product->wholeSalePrices;
                                    if($wholeSalePrices->count()){
                                        foreach ($wholeSalePrices as $w_p){
                                            if ( ($w_p->min_qty<=$cart->qty) && ($w_p->max_qty >=$cart->qty) ){
                                                $w_main_price = $w_p->sell_price;
                                            }
                                            elseif($w_p->max_qty < $cart->qty){
                                                $w_main_price = $w_p->sell_price;
                                            }
                                        }
                                    }

                                    if ($w_main_price!=0){
                                        $subtotal += $w_main_price * $cart->qty;
                                    }else{
                                        if (app('general_setting')->price_with_vat){
                                            $tax += $cart->product->product->tax * $cart->qty;
                                            $subtotal += ($cart->product->sell_price * $cart->qty);
                                        }else {
                                            $subtotal += ($cart->product->sell_price * $cart->qty);
                                        }
                                    }
                                }else{
                                    if (app('general_setting')->price_with_vat){
                                        $tax += $cart->product->product->tax * $cart->qty;
                                            $subtotal += ($cart->product->sell_price * $cart->qty);
                                    }else {
                                        $subtotal += ($cart->product->sell_price * $cart->qty);
                                    }
                                }
                            ?>
                        <?php else: ?>
                            <div class="singleVendor_product_lists">
                                <div class="singleVendor_product_list d-flex align-items-center cart_thumb_div">
                                    <div class="thumb">
                                        <img src="<?php echo e(showImage(@$cart->giftCard->thumbnail_image)); ?>" alt="<?php echo e(textLimit(@$cart->giftCard->name, 28)); ?>" title="<?php echo e(textLimit(@$cart->giftCard->name, 28)); ?>">
                                    </div>
                                    <div class="product_list_content">
                                        <h4><a href="<?php echo e(route('frontend.gift-card.show',$cart->giftCard->sku)); ?>"><?php echo e(textLimit(@$cart->giftCard->name, 28)); ?></a></h4>
                                        <h5 class="d-flex align-items-center"><span class="product_count_text"><?php echo e($cart->qty); ?><span>x</span></span><?php echo e(single_price($cart->price)); ?></h5>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $actual_price += $cart->total_price;
                                $tax += $cart->giftCard->tax * $cart->qty;
                                $subtotal += ($cart->giftCard->sell_price * $cart->qty) + $tax;
                            ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <h3 class="check_v3_title mb_25"><?php echo e(__('common.order_summary')); ?></h3>
                <div class="subtotal_lists">
                    <div class="single_total_list d-flex align-items-center">
                        <div class="single_total_left flex-fill">
                            <h4><?php echo e(__('common.subtotal')); ?></h4>
                        </div>
                        <div class="single_total_right">
                            <?php if(Session::has('auction_type')): ?>
                                <span>+ <?php echo e(single_price(Session::get('auction_price'))); ?></span>
                            <?php else: ?>
                                <?php if(app('general_setting')->price_with_vat): ?>
                                    <span>+ <?php echo e(single_price($subtotal - $tax)); ?> </span>
                                <?php else: ?>
                                    <span>+ <?php echo e(single_price($subtotal)); ?> </span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="single_total_list d-flex align-items-center flex-wrap">
                        <div class="single_total_left flex-fill">
                            <h4><?php echo e(__('common.shipping_charge')); ?></h4>
                            <?php if(isModuleActive('MultiVendor')): ?>
                                <?php if(isModuleActive('INTShipping')): ?>
                                    <p><?php echo e(__('defaultTheme.product_wise_shipping_charge')); ?></p>
                                <?php else: ?>
                                    <p><?php echo e(__('defaultTheme.package_wise_shipping_charge')); ?></p>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="single_total_right">
                            <span id="shipping_cost">
                                <?php if(isModuleActive('MultiVendor')): ?>
                                    <?php if(isModuleActive('INTShipping')): ?>
                                    + <?php echo e(single_price(0)); ?>

                                    <?php else: ?>
                                    + <?php echo e(single_price($total_shipping_charge)); ?>

                                    <?php endif; ?>
                                <?php else: ?>
                                <?php echo e(__('defaultTheme.calculated_at_next_step')); ?>

                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                    <?php
                        if(isModuleActive('MultiVendor')){
                            if(isModuleActive('INTShipping')){
                                $total = $actual_price;
                            }else{
                                $total = $actual_price + $total_shipping_charge;
                            }
                        }else{
                            $total = $actual_price;
                            $discount = $subtotal - $actual_price;
                        }
                    ?>

                    <div class="single_total_list d-flex align-items-center flex-wrap">
                        <div class="single_total_left flex-fill">
                            <h4><?php echo e(__('common.discount')); ?></h4>
                        </div>
                        <div class="single_total_right">
                            <?php if(Session::has('auction_type')): ?>
                                <span>+ <?php echo e(single_price(0)); ?></span>
                            <?php else: ?>
                                <span>-<?php echo e(single_price($discount)); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="single_total_list d-flex align-items-center flex-wrap">
                        <div class="single_total_left flex-fill">
                            <h4><?php echo e(__('common.vat/tax/gst')); ?></h4>
                        </div>
                        <div class="single_total_right">
                            <?php if(app('general_setting')->price_with_vat): ?>
                            <span>+ <?php echo e(single_price($tax)); ?></span>
                            <?php else: ?>
                            <span><?php echo e(__('defaultTheme.calculated_at_next_step')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                        $coupon = 0;
                        $coupon_id = null;
                        $total_for_coupon = $actual_price;
                    ?>
                    <div class="total_amount d-flex align-items-center flex-wrap">
                        <div class="single_total_left flex-fill">
                            <span class="total_text"><?php echo e(__('common.total')); ?></span>
                        </div>
                        <div class="single_total_right">
                            <?php if(isModuleActive('INTShipping')): ?>
                            <input type="hidden" id="total" value="<?php echo e($total); ?>">
                            <span class="total_text"><span id="grand_total"><?php echo e(single_price($total-$coupon)); ?></span></span>
                            <?php else: ?>
                               <span class="total_text"><span><?php echo e(single_price($total-$coupon)); ?></span></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php /**PATH /var/www/DhatriProduction/resources/views/frontend/amazy/partials/_checkout_details.blade.php ENDPATH**/ ?>