<?php
    $all_select_count = 0;
    $subtotal = 0;
    $tax = 0;
    $discount = 0;
    $actual_price = 0;
    $shipping_cost = 0;
    $sellect_seller = 0;
    $selected_product_check  = 0;

    foreach ($cartData as $key => $items) {
        $all_select_count += count($items);
        $sellect_seller  = $key;
        $p = 0;
        foreach ($items as $key => $data) {
            $tax_amount = !empty($data->product) && !empty($data->product->product) && !empty($data->product->product->tax) ? $data->product->product->tax :0;
            $tax += ($tax_amount * $data->qty) ;
            if ($data->is_select == 1) {
                $all_select_count = $all_select_count - 1;
                $selected_product_check ++;
                $p = 1;
            }
        }
        if($p == 1){
            $shipping_cost += 20;

        }
    }
?>
<div class="checkout_v3_area">
    <form id="cart_form">
        <div class="checkout_v3_left d-flex justify-content-end mb-0">
            <?php if(count($cartData) > 0): ?>

                <div class="checkout_v3_inner w-100">

                    <?php if(!isModuleActive('MultiVendor')): ?>
                        <?php if($free_shipping): ?>
                            <div class="free_shipping_message">
                                <h5><?php echo e(__('shipping.shipping_charge_free_from')); ?> <span><?php echo e(single_price($free_shipping->minimum_shopping)); ?></span></h5>
                            </div>
                        <?php endif; ?>

                        <div class="amazy_table4">
                            <div class="amazy_table4_head mb_20 d-none d-lg-flex ">
                                <div class="row d-none d-lg-flex flex-fill">
                                    <div class="col-md-5 fw-600"> <h4 class="font_14 f_w_700 m-0 text-nowrap priamry_text text-uppercase"><?php echo e(__('common.products')); ?></h4> </div>
                                    <div class="col fw-600"> <h4 class="font_14 f_w_700 m-0 text-nowrap priamry_text text-uppercase"><?php echo e(__('common.price')); ?></h4> </div>
                                    <div class="col fw-600"> <h4 class="font_14 f_w_700 m-0 text-nowrap priamry_text text-uppercase"><?php echo e(__('common.quantity')); ?></h4> </div>
                                    <div class="col fw-600"> <h4 class="font_14 f_w_700 m-0 text-nowrap priamry_text text-uppercase"><?php echo e(__('common.subtotal')); ?></h4> </div>
                                    <div class="col-auto fw-600"> <h4 class="font_14 f_w_700 m-0 text-nowrap priamry_text text-uppercase"><?php echo e(__('common.remove')); ?></h4> </div>
                                </div>
                            </div>
                            <ul class="amazy_table4_body">
                                <?php $__currentLoopData = $cartData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin_id => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($cart->product_type == 'product'): ?>
                                            <?php if($cart->is_select == 1): ?>
                                                <?php
                                                    $pro_price = 0;
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
                                                            $pro_price = $w_main_price;
                                                        }else{
                                                            $subtotal += $cart->product->sell_price * $cart->qty;
                                                            $pro_price = $cart->product->sell_price;
                                                        }
                                                    }else{
                                                        $subtotal += $cart->product->sell_price * $cart->qty;
                                                        $pro_price = $cart->product->sell_price;
                                                    }

                                                ?>
                                            <?php endif; ?>
                                            <li class="list-group-item px-0 px-lg-3 mb_10">
                                                <div class="row gutters-5 align-items-center m-0">
                                                    <div class="col-lg-5 d-flex p-0">
                                                        <a href="<?php echo e(singleProductURL(@$cart->seller->slug, @$cart->product->product->slug)); ?>" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                            <div class="thumb">
                                                                <img src="
                                                                <?php if(@$cart->product->product->product->product_type == 1): ?>
                                                                <?php echo e(showImage(@$cart->product->product->product->thumbnail_image_source)); ?>

                                                                <?php else: ?>
                                                                <?php echo e(showImage(@$cart->product->sku->variant_image?@$cart->product->sku->variant_image:@$cart->product->product->product->thumbnail_image_source)); ?>

                                                                <?php endif; ?>
                                                                " alt="<?php echo e(textLimit(@$cart->product->product->product_name, 30)); ?>" title="<?php echo e(textLimit(@$cart->product->product->product_name, 30)); ?>">
                                                            </div>
                                                            <div class="summery_pro_content">
                                                                <h4 class="font_16 f_w_700 m-0 theme_hover"><?php echo e(textLimit(@$cart->product->product->product_name, 30)); ?></h4>
                                                                <p class="font_14 f_w_400 m-0 ">
                                                                    <?php if(@$cart->product->product->product->product_type == 2): ?>
                                                                        <?php $__currentLoopData = @$cart->product->product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $combination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php if(@$combination->attribute->id == 1): ?>
                                                                                <?php echo e(@$combination->attribute->name); ?>: <?php echo e(@$combination->attribute_value->color->name); ?>

                                                                            <?php else: ?>
                                                                                <?php echo e(@$combination->attribute->name); ?>: <?php echo e(@$combination->attribute_value->value); ?>

                                                                            <?php endif; ?>
                                                                            <?php if($key < count(@$cart->product->product_variations)-1): ?>,<?php endif; ?>

                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php endif; ?>
                                                                </p>

                                                                <div class="d-flex flex-wrap align-items-center gap-10 mt-3">
                                                                    <div class="d-block d-lg-none">
                                                                        <div class="product_number_count style_4" data-target="amount-3">
                                                                            <button class="count_single_item inumber_decrement change_qty" data-qty_id="#qty_<?php echo e($cart->id); ?>" data-change_amount="1" data-maximum_qty="#maximum_qty_<?php echo e($cart->id); ?>"
                                                                                data-minimum_qty="#minimum_qty_<?php echo e($cart->id); ?>" data-product_stock="<?php echo e(@$cart->product->product_stock); ?>" data-stock_manage="<?php echo e(@$cart->product->product->stock_manage); ?>" data-wholesale="#getWholesalePrice_<?php echo e($cart->id); ?>" data-cart_id="<?php echo e($cart->id); ?>" type="button" value="-"> <i class="ti-minus"></i></button>
                                                                            <input name="qty[]" id="qty_<?php echo e($cart->id); ?>" maxlength="12" data-value="<?php echo e($cart->qty); ?>" value="<?php echo e(getNumberTranslate($cart->qty)); ?>" class="count_single_item input-number qty" type="text" data-qty_id="#qty_<?php echo e($cart->id); ?>" data-change_amount="1" data-maximum_qty="#maximum_qty_<?php echo e($cart->id); ?>"
                                                                            data-minimum_qty="#minimum_qty_<?php echo e($cart->id); ?>" data-product_stock="<?php echo e(@$cart->product->product_stock); ?>" data-stock_manage="<?php echo e(@$cart->product->product->stock_manage); ?>" data-wholesale="#getWholesalePrice_<?php echo e($cart->id); ?>" data-cart_id="<?php echo e($cart->id); ?>">
                                                                            <input type="hidden" value="<?php echo e($cart->id); ?>" name="cart_id[]">
                                                                            <input type="hidden" id="maximum_qty_<?php echo e($cart->id); ?>" value="<?php echo e(@$cart->product->product->product->max_order_qty); ?>">
                                                                            <input type="hidden" id="minimum_qty_<?php echo e($cart->id); ?>" value="<?php echo e(@$cart->product->product->product->minimum_order_qty); ?>">
                                                                            <button class="count_single_item number_increment change_qty" data-qty_id="#qty_<?php echo e($cart->id); ?>" data-change_amount="1" data-maximum_qty="#maximum_qty_<?php echo e($cart->id); ?>"
                                                                                data-minimum_qty="#minimum_qty_<?php echo e($cart->id); ?>" data-product_stock="<?php echo e(@$cart->product->product_stock); ?>" data-stock_manage="<?php echo e(@$cart->product->product->stock_manage); ?>" data-wholesale="#getWholesalePrice_<?php echo e($cart->id); ?>" data-cart_id="<?php echo e($cart->id); ?>" type="button" value="+"> <i class="ti-plus"></i></button>

                                                                            <!-- for wholesale module -->
                                                                            <?php if(isModuleActive('WholeSale')): ?>
                                                                                <input type="hidden" id="getWholesalePrice_<?php echo e($cart->id); ?>" value="<?php if(@$cart->product->wholeSalePrices->count()): ?><?php echo e(json_encode(@$cart->product->wholeSalePrices)); ?> <?php else: ?> 0 <?php endif; ?>">
                                                                            <?php endif; ?>

                                                                        </div>
                                                                    </div>

                                                                    <div class="d-inline">
                                                                        <h4 class="font_16 f_w_700 m-0 lh-1 d-inline d-lg-none text-nowrap">
                                                                            <?php echo e(single_price($cart->total_price)); ?>

                                                                        </h4>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-lg col-4 order-1 order-lg-0 my-3 my-lg-0 d-none d-lg-block">
                                                        <span class="opacity-60 font_12 d-block d-lg-none"><?php echo e(__('common.price')); ?></span>
                                                        <?php if($cart->product->product->hasDeal): ?>
                                                            <?php if($cart->product->product->hasDeal->discount > 0): ?>
                                                                <?php if($cart->product->product->hasDeal->discount_type == 0): ?>
                                                                    <span class="green_badge text-nowrap">-<?php echo e(getNumberTranslate($cart->product->product->hasDeal->discount)); ?>%</span>
                                                                <?php else: ?>
                                                                    <span class="green_badge text-nowrap">-<?php echo e(single_price($cart->product->product->hasDeal->discount)); ?></span>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <?php if(@$cart->product->product->hasDiscount == 'yes'): ?>
                                                                <?php if($cart->product->product->discount_type == 0): ?>
                                                                    <span class="green_badge text-nowrap">-<?php echo e(getNumberTranslate($cart->product->product->discount)); ?>%</span>
                                                                <?php else: ?>
                                                                    <span class="green_badge text-nowrap">-<?php echo e(single_price($cart->product->product->discount)); ?></span>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        <h4 class="font_16 f_w_700 m-0 text-nowrap set_base_price<?php echo e($cart->id); ?>"><?php echo e(single_price(isset($pro_price)?$pro_price:@$cart->product->sell_price)); ?></h4>
                                                        <input type="hidden" class="get_base_price<?php echo e($cart->id); ?>" value="<?php echo e(single_price(isset($pro_price)?$pro_price:@$cart->product->sell_price)); ?>">
                                                    </div>
                                                    <div class="col-lg col-6 order-4 order-lg-0 d-none d-lg-block">
                                                        <div class="product_number_count style_4" data-target="amount-3">
                                                            <button class="count_single_item inumber_decrement change_qty" data-qty_id="#qty_<?php echo e($cart->id); ?>" data-change_amount="1" data-maximum_qty="#maximum_qty_<?php echo e($cart->id); ?>"
                                                                data-minimum_qty="#minimum_qty_<?php echo e($cart->id); ?>" data-product_stock="<?php echo e(@$cart->product->product_stock); ?>" data-stock_manage="<?php echo e(@$cart->product->product->stock_manage); ?>" data-wholesale="#getWholesalePrice_<?php echo e($cart->id); ?>" data-cart_id="<?php echo e($cart->id); ?>" type="button" value="-"> <i class="ti-minus"></i></button>
                                                            <input name="qty[]" id="qty_<?php echo e($cart->id); ?>" maxlength="12" data-value="<?php echo e($cart->qty); ?>" value="<?php echo e(getNumberTranslate($cart->qty)); ?>" class="count_single_item input-number qty" type="text" data-qty_id="#qty_<?php echo e($cart->id); ?>" data-change_amount="1" data-maximum_qty="#maximum_qty_<?php echo e($cart->id); ?>"
                                                            data-minimum_qty="#minimum_qty_<?php echo e($cart->id); ?>" data-product_stock="<?php echo e(@$cart->product->product_stock); ?>" data-stock_manage="<?php echo e(@$cart->product->product->stock_manage); ?>" data-wholesale="#getWholesalePrice_<?php echo e($cart->id); ?>" data-cart_id="<?php echo e($cart->id); ?>">
                                                            <input type="hidden" value="<?php echo e($cart->id); ?>" name="cart_id[]">
                                                            <input type="hidden" id="maximum_qty_<?php echo e($cart->id); ?>" value="<?php echo e(@$cart->product->product->product->max_order_qty); ?>">
                                                            <input type="hidden" id="minimum_qty_<?php echo e($cart->id); ?>" value="<?php echo e(@$cart->product->product->product->minimum_order_qty); ?>">
                                                            <button class="count_single_item number_increment change_qty" data-qty_id="#qty_<?php echo e($cart->id); ?>" data-change_amount="1" data-maximum_qty="#maximum_qty_<?php echo e($cart->id); ?>"
                                                                data-minimum_qty="#minimum_qty_<?php echo e($cart->id); ?>" data-product_stock="<?php echo e(@$cart->product->product_stock); ?>" data-stock_manage="<?php echo e(@$cart->product->product->stock_manage); ?>" data-wholesale="#getWholesalePrice_<?php echo e($cart->id); ?>" data-cart_id="<?php echo e($cart->id); ?>" type="button" value="+"> <i class="ti-plus"></i></button>

                                                            <!-- for wholesale module -->
                                                            <?php if(isModuleActive('WholeSale')): ?>
                                                                <input type="hidden" id="getWholesalePrice_<?php echo e($cart->id); ?>" value="<?php if(@$cart->product->wholeSalePrices->count()): ?><?php echo e(json_encode(@$cart->product->wholeSalePrices)); ?> <?php else: ?> 0 <?php endif; ?>">
                                                            <?php endif; ?>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg col-4 order-3 order-lg-0 my-3 my-lg-0 d-none d-lg-block">
                                                        <span class="opacity-60 font_12 d-none d-sm-block d-lg-none"><?php echo e(__('common.total')); ?></span>
                                                        <h4 class="font_16 f_w_700 m-0 lh-1 d-none d-lg-block">
                                                            <?php echo e(single_price($cart->total_price)); ?>

                                                        </h4>
                                                    </div>
                                                    <div class="col-lg-auto order-5 order-lg-0 text-end">

                                                        <span class="close_icon style_2 lh-1 cart_item_delete_btn cursor_pointer" data-id="<?php echo e($cart->id); ?>" data-product_id="<?php echo e($cart->product_id); ?>" data-unique_id="#delete_item_<?php echo e($cart->id); ?>" id="delete_item_<?php echo e($cart->id); ?>">
                                                            <svg  width="12.249" height="15.076" viewBox="0 0 12.249 15.076">
                                                                <g  transform="translate(-48)">
                                                                    <path  data-name="Path 1449" d="M59.071,1.884H56.48V1.413A1.415,1.415,0,0,0,55.067,0H53.182a1.415,1.415,0,0,0-1.413,1.413v.471H49.178A1.179,1.179,0,0,0,48,3.062V4.711a.471.471,0,0,0,.471.471h.257l.407,8.547a1.412,1.412,0,0,0,1.412,1.346H57.7a1.412,1.412,0,0,0,1.412-1.346l.407-8.547h.257a.471.471,0,0,0,.471-.471V3.062A1.179,1.179,0,0,0,59.071,1.884Zm-6.36-.471a.472.472,0,0,1,.471-.471h1.884a.472.472,0,0,1,.471.471v.471H52.711ZM48.942,3.062a.236.236,0,0,1,.236-.236h9.893a.236.236,0,0,1,.236.236V4.24H48.942Zm9.23,10.623a.471.471,0,0,1-.471.449H50.547a.471.471,0,0,1-.471-.449l-.4-8.5h8.905Z" fill="#00124e"></path>
                                                                    <path  data-name="Path 1450" d="M240.471,215.067a.471.471,0,0,0,.471-.471v-6.125a.471.471,0,1,0-.942,0V214.6A.471.471,0,0,0,240.471,215.067Z" transform="translate(-186.347 -201.875)" fill="#00124e"></path>
                                                                    <path  data-name="Path 1451" d="M320.471,215.067a.471.471,0,0,0,.471-.471v-6.125a.471.471,0,1,0-.942,0V214.6A.471.471,0,0,0,320.471,215.067Z" transform="translate(-263.991 -201.875)" fill="#00124e"></path>
                                                                    <path  data-name="Path 1452" d="M160.471,215.067a.471.471,0,0,0,.471-.471v-6.125a.471.471,0,0,0-.942,0V214.6A.471.471,0,0,0,160.471,215.067Z" transform="translate(-108.702 -201.875)" fill="#00124e"></path>
                                                                </g>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php else: ?>
                                            <?php if($cart->is_select == 1): ?>
                                                <?php
                                                    $subtotal += $cart->giftCard->sell_price * $cart->qty;
                                                ?>
                                            <?php endif; ?>

                                            <li class="list-group-item px-0 px-lg-3 mb_10">
                                                <div class="row gutters-5 align-items-center">
                                                    <div class="col-lg-5 d-flex">
                                                        <a href="<?php echo e(route('frontend.gift-card.show',$cart->giftCard->sku)); ?>" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                            <div class="thumb">
                                                                <img src="<?php echo e(showImage(@$cart->giftCard->thumbnail_image)); ?>" alt="<?php echo e(textLimit(@$cart->giftCard->name, 30)); ?>" title="<?php echo e(textLimit(@$cart->giftCard->name, 30)); ?>">
                                                            </div>
                                                            <div class="summery_pro_content">
                                                                <h4 class="font_16 f_w_700 m-0 theme_hover"><?php echo e(textLimit(@$cart->giftCard->name, 30)); ?></h4>
                                                            </div>
                                                        </a>
                                                    </div>

                                                    <div class="col-lg col-4 order-1 order-lg-0 my-3 my-lg-0">
                                                        <span class="opacity-60 font_12 d-block d-lg-none"><?php echo e(__('common.price')); ?></span>

                                                        <h4 class="font_16 f_w_700 m-0 text-nowrap"><?php echo e(single_price($cart->price)); ?></h4>
                                                    </div>
                                                    <div class="col-lg col-6 order-4 order-lg-0">
                                                        <div class="product_number_count style_4" data-target="amount-3">
                                                            <input type="hidden" value="<?php echo e($cart->id); ?>" name="cart_id[]">
                                                            <input type="hidden" id="maximum_qty_<?php echo e($cart->id); ?>" value="">
                                                            <input type="hidden" id="minimum_qty_<?php echo e($cart->id); ?>" value="1">
                                                            <button class="count_single_item inumber_decrement change_qty" data-qty_id="#qty_<?php echo e($cart->id); ?>" data-cart_id="<?php echo e($cart->id); ?>" data-change_amount="1" data-maximum_qty="#maximum_qty_<?php echo e($cart->id); ?>"
                                                                data-minimum_qty="#minimum_qty_<?php echo e($cart->id); ?>" data-product_stock="0" data-stock_manage="0" data-wholesale="#getWholesalePrice_<?php echo e($cart->id); ?>" type="button" value="-"> <i class="ti-minus"></i></button>
                                                            <input name="qty[]" id="qty_<?php echo e($cart->id); ?>" data-value="<?php echo e($cart->qty); ?>" value="<?php echo e(getNumberTranslate($cart->qty)); ?>" class="count_single_item input-number qty" type="text" data-qty_id="#qty_<?php echo e($cart->id); ?>" data-cart_id="<?php echo e($cart->id); ?>" data-change_amount="1" data-maximum_qty="#maximum_qty_<?php echo e($cart->id); ?>"
                                                            data-minimum_qty="#minimum_qty_<?php echo e($cart->id); ?>" data-product_stock="0" data-stock_manage="0" data-wholesale="#getWholesalePrice_<?php echo e($cart->id); ?>">
                                                            <button class="count_single_item number_increment change_qty" data-qty_id="#qty_<?php echo e($cart->id); ?>" data-cart_id="<?php echo e($cart->id); ?>" data-change_amount="1" data-maximum_qty="#maximum_qty_<?php echo e($cart->id); ?>"
                                                                data-minimum_qty="#minimum_qty_<?php echo e($cart->id); ?>" data-product_stock="0" data-stock_manage="0" data-wholesale="#getWholesalePrice_<?php echo e($cart->id); ?>" type="button" value="+"> <i class="ti-plus"></i></button>
                                                            <!-- for wholesale module -->
                                                            <?php if(isModuleActive('WholeSale')): ?>
                                                                <input type="hidden" id="getWholesalePrice_<?php echo e($cart->id); ?>" value="0">
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg col-4 order-3 order-lg-0 my-3 my-lg-0">
                                                        <span class="opacity-60 font_12 d-block d-lg-none"><?php echo e(__('common.total')); ?></span>
                                                        <h4 class="font_16 f_w_700 m-0 lh-1">
                                                            <?php echo e(single_price($cart->total_price)); ?>

                                                        </h4>
                                                    </div>
                                                    <div class="col-lg-auto col-6 order-5 order-lg-0 text-end">
                                                        <span class="close_icon style_2 lh-1 cart_item_delete_btn cursor_pointer" data-id="<?php echo e($cart->id); ?>" data-product_id="<?php echo e($cart->product_id); ?>" data-unique_id="#delete_item_<?php echo e($cart->id); ?>" id="delete_item_<?php echo e($cart->id); ?>">
                                                            <svg  width="12.249" height="15.076" viewBox="0 0 12.249 15.076">
                                                                <g  transform="translate(-48)">
                                                                    <path  data-name="Path 1449" d="M59.071,1.884H56.48V1.413A1.415,1.415,0,0,0,55.067,0H53.182a1.415,1.415,0,0,0-1.413,1.413v.471H49.178A1.179,1.179,0,0,0,48,3.062V4.711a.471.471,0,0,0,.471.471h.257l.407,8.547a1.412,1.412,0,0,0,1.412,1.346H57.7a1.412,1.412,0,0,0,1.412-1.346l.407-8.547h.257a.471.471,0,0,0,.471-.471V3.062A1.179,1.179,0,0,0,59.071,1.884Zm-6.36-.471a.472.472,0,0,1,.471-.471h1.884a.472.472,0,0,1,.471.471v.471H52.711ZM48.942,3.062a.236.236,0,0,1,.236-.236h9.893a.236.236,0,0,1,.236.236V4.24H48.942Zm9.23,10.623a.471.471,0,0,1-.471.449H50.547a.471.471,0,0,1-.471-.449l-.4-8.5h8.905Z" fill="#00124e"></path>
                                                                    <path  data-name="Path 1450" d="M240.471,215.067a.471.471,0,0,0,.471-.471v-6.125a.471.471,0,1,0-.942,0V214.6A.471.471,0,0,0,240.471,215.067Z" transform="translate(-186.347 -201.875)" fill="#00124e"></path>
                                                                    <path  data-name="Path 1451" d="M320.471,215.067a.471.471,0,0,0,.471-.471v-6.125a.471.471,0,1,0-.942,0V214.6A.471.471,0,0,0,320.471,215.067Z" transform="translate(-263.991 -201.875)" fill="#00124e"></path>
                                                                    <path  data-name="Path 1452" d="M160.471,215.067a.471.471,0,0,0,.471-.471v-6.125a.471.471,0,0,0-.942,0V214.6A.471.471,0,0,0,160.471,215.067Z" transform="translate(-108.702 -201.875)" fill="#00124e"></path>
                                                                </g>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($cart->is_select == 1): ?>
                                            <?php
                                                $actual_price += $cart->total_price;
                                            ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>
                        </div>
                    <?php else: ?>
                        <div class="amazy_table4">
                            <div class="amazy_table4_head mb_20 d-none d-lg-flex ">
                                <div class="row d-none d-lg-flex flex-fill">
                                    <div class="col-md-5 fw-600"> <h4 class="font_14 f_w_700 m-0 text-nowrap priamry_text text-uppercase"><?php echo e(__('common.products')); ?></h4> </div>
                                    <div class="col fw-600"> <h4 class="font_14 f_w_700 m-0 text-nowrap priamry_text text-uppercase"><?php echo e(__('common.price')); ?></h4> </div>
                                    <div class="col fw-600"> <h4 class="font_14 f_w_700 m-0 text-nowrap priamry_text text-uppercase"><?php echo e(__('common.quantity')); ?></h4> </div>
                                    <div class="col fw-600"> <h4 class="font_14 f_w_700 m-0 text-nowrap priamry_text text-uppercase"><?php echo e(__('common.subtotal')); ?></h4> </div>
                                    <div class="col-auto fw-600"> <h4 class="font_14 f_w_700 m-0 text-nowrap priamry_text text-uppercase"><?php echo e(__('common.remove')); ?></h4> </div>
                                </div>
                            </div>
                            <?php $__currentLoopData = $cartData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller_id => $cartItems): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $seller = App\Models\User::where('id',$seller_id)->first();
                                    $select_count = count($cartItems);
                                ?>
                                <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        if($data->is_select == 1){
                                                $select_count = $select_count - 1;
                                        }else{
                                            $select_count = $select_count;
                                        }
                                    ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div class="checkout_shiped_box mb_20">
                                    <ul class="amazy_table4_body">
                                        <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($cart->product_type == 'product'): ?>
                                                <?php if($cart->is_select == 1): ?>
                                                    <?php
                                                        $pro_price = 0;
                                                        if (isModuleActive('WholeSale')){
                                                            $w_main_price = 0;
                                                            $wholeSalePrices = @$cart->product->wholeSalePrices;
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
                                                                $pro_price = $w_main_price;
                                                            }else{
                                                                $subtotal += $cart->product->sell_price * $cart->qty;
                                                                $pro_price = $cart->product->sell_price;
                                                            }
                                                        }else{
                                                            $subtotal += $cart->product->sell_price * $cart->qty;
                                                            $pro_price = $cart->product->sell_price;
                                                        }
                                                    ?>
                                                <?php endif; ?>

                                                <li class="list-group-item px-0 px-lg-3 mb_10">
                                                    <div class="row gutters-5 m-0 align-items-center">
                                                        <div class="col-lg-5 d-flex p-0">
                                                            <a href="<?php echo e(singleProductURL(@$cart->seller->slug, @$cart->product->product->slug)); ?>" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                                <div class="thumb">
                                                                    <img src="
                                                                        <?php if(@$cart->product->product->product->product_type == 1): ?>
                                                                            <?php echo e(showImage(@$cart->product->product->product->thumbnail_image_source)); ?>

                                                                        <?php else: ?>
                                                                            <?php echo e(showImage(@$cart->product->sku->variant_image?@$cart->product->sku->variant_image:@$cart->product->product->product->thumbnail_image_source)); ?>

                                                                        <?php endif; ?>
                                                                    " alt="<?php echo e(textLimit(@$cart->product->product->product_name, 35)); ?>" title="<?php echo e(textLimit(@$cart->product->product->product_name, 35)); ?>">
                                                                </div>
                                                                <div class="summery_pro_content">
                                                                    <h4 class="font_16 f_w_700 m-0 theme_hover"><?php echo e(textLimit(@$cart->product->product->product_name, 35)); ?></h4>
                                                                    <p class="font_14 f_w_400 m-0 ">
                                                                        <?php if(@$cart->product->product->product->product_type == 2): ?>
                                                                            <?php $__currentLoopData = @$cart->product->product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $combination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <?php if(@$combination->attribute->id == 1): ?>
                                                                                    <?php echo e(@$combination->attribute->name); ?>: <?php echo e(@$combination->attribute_value->color->name); ?>

                                                                                <?php else: ?>
                                                                                    <?php echo e(@$combination->attribute->name); ?>: <?php echo e(@$combination->attribute_value->value); ?>

                                                                                <?php endif; ?>
                                                                                <?php if($key < count(@$cart->product->product_variations)-1): ?>,<?php endif; ?>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php endif; ?>
                                                                    </p>


                                                                    <div class="d-flex flex-wrap align-items-center gap-10 mt-3">
                                                                        <div class="d-block d-lg-none">
                                                                            <div class="product_number_count style_4" data-target="amount-3">
                                                                                <button class="count_single_item inumber_decrement change_qty" data-qty_id="#qty_<?php echo e($cart->id); ?>" data-change_amount="1" data-maximum_qty="#maximum_qty_<?php echo e($cart->id); ?>"
                                                                                    data-minimum_qty="#minimum_qty_<?php echo e($cart->id); ?>" data-product_stock="<?php echo e($cart->product->product_stock); ?>" data-stock_manage="<?php echo e($cart->product->product->stock_manage); ?>" data-wholesale="#getWholesalePrice_<?php echo e($cart->id); ?>" data-cart_id="<?php echo e($cart->id); ?>" type="button" value="-"> <i class="ti-minus"></i></button>
                                                                                <input name="qty[]" id="qty_<?php echo e($cart->id); ?>" maxlength="12" data-value="<?php echo e($cart->qty); ?>" value="<?php echo e(getNumberTranslate($cart->qty)); ?>" class="count_single_item input-number qty" type="text" data-qty_id="#qty_<?php echo e($cart->id); ?>" data-change_amount="1" data-maximum_qty="#maximum_qty_<?php echo e($cart->id); ?>"
                                                                                data-minimum_qty="#minimum_qty_<?php echo e($cart->id); ?>" data-product_stock="<?php echo e($cart->product->product_stock); ?>" data-stock_manage="<?php echo e($cart->product->product->stock_manage); ?>" data-wholesale="#getWholesalePrice_<?php echo e($cart->id); ?>" data-cart_id="<?php echo e($cart->id); ?>">
                                                                                <input type="hidden" value="<?php echo e($cart->id); ?>" name="cart_id[]">
                                                                                <input type="hidden" id="maximum_qty_<?php echo e($cart->id); ?>" value="<?php echo e($cart->product->product->product->max_order_qty); ?>">
                                                                                <input type="hidden" id="minimum_qty_<?php echo e($cart->id); ?>" value="<?php echo e($cart->product->product->product->minimum_order_qty); ?>">
                                                                                <button class="count_single_item number_increment change_qty" data-qty_id="#qty_<?php echo e($cart->id); ?>" data-change_amount="1" data-maximum_qty="#maximum_qty_<?php echo e($cart->id); ?>"
                                                                                    data-minimum_qty="#minimum_qty_<?php echo e($cart->id); ?>" data-product_stock="<?php echo e($cart->product->product_stock); ?>" data-stock_manage="<?php echo e($cart->product->product->stock_manage); ?>" data-wholesale="#getWholesalePrice_<?php echo e($cart->id); ?>" data-cart_id="<?php echo e($cart->id); ?>" type="button" value="+"> <i class="ti-plus"></i></button>

                                                                                    <!-- for wholesale module -->
                                                                                    <?php if(isModuleActive('WholeSale')): ?>
                                                                                        <input type="hidden" id="getWholesalePrice_<?php echo e($cart->id); ?>" value="<?php if(@$cart->product->wholeSalePrices->count()): ?><?php echo e(json_encode(@$cart->product->wholeSalePrices)); ?> <?php else: ?> 0 <?php endif; ?>">
                                                                                    <?php endif; ?>
                                                                            </div>
                                                                        </div>

                                                                        <div class="d-inline">
                                                                            <h4 class="font_16 f_w_700 m-0 lh-1 d-inline d-lg-none text-nowrap">
                                                                                <?php echo e(single_price($cart->total_price)); ?>

                                                                            </h4>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>

                                                        <div class="col-lg col-4 order-1 order-lg-0 my-3 my-lg-0 d-none d-lg-block">
                                                            <span class="opacity-60 font_12 d-block d-lg-none"><?php echo e(__('common.price')); ?></span>
                                                            <?php if($cart->product->product->hasDeal): ?>
                                                                <?php if($cart->product->product->hasDeal->discount > 0): ?>
                                                                    <?php if($cart->product->product->hasDeal->discount_type == 0): ?>
                                                                        <span class="green_badge text-nowrap">-<?php echo e(getNumberTranslate($cart->product->product->hasDeal->discount)); ?>%</span>
                                                                    <?php else: ?>
                                                                        <span class="green_badge text-nowrap">-<?php echo e(single_price($cart->product->product->hasDeal->discount)); ?></span>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <?php if(@$cart->product->product->hasDiscount == 'yes'): ?>
                                                                    <?php if($cart->product->product->discount_type == 0): ?>
                                                                        <span class="green_badge text-nowrap">-<?php echo e(getNumberTranslate($cart->product->product->discount)); ?>%</span>
                                                                    <?php else: ?>
                                                                        <span class="green_badge text-nowrap">-<?php echo e(single_price($cart->product->product->discount)); ?></span>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                            <h4 class="font_16 f_w_700 m-0 set_base_price<?php echo e($cart->id); ?>"><?php echo e(single_price(isset($pro_price)?$pro_price:@$cart->product->sell_price)); ?></h4>
                                                            <input type="hidden" class="get_base_price<?php echo e($cart->id); ?>" value="<?php echo e(single_price(isset($pro_price)?$pro_price:@$cart->product->sell_price)); ?>">
                                                        </div>
                                                        <div class="col-lg col-6 order-4 order-lg-0 d-none d-lg-block">
                                                            <div class="product_number_count style_4" data-target="amount-3">
                                                                <button class="count_single_item inumber_decrement change_qty" data-qty_id="#qty_<?php echo e($cart->id); ?>" data-change_amount="1" data-maximum_qty="#maximum_qty_<?php echo e($cart->id); ?>"
                                                                    data-minimum_qty="#minimum_qty_<?php echo e($cart->id); ?>" data-product_stock="<?php echo e($cart->product->product_stock); ?>" data-stock_manage="<?php echo e($cart->product->product->stock_manage); ?>" data-wholesale="#getWholesalePrice_<?php echo e($cart->id); ?>" data-cart_id="<?php echo e($cart->id); ?>" type="button" value="-"> <i class="ti-minus"></i></button>
                                                                <input name="qty[]" id="qty_<?php echo e($cart->id); ?>" maxlength="12" data-value="<?php echo e($cart->qty); ?>" value="<?php echo e(getNumberTranslate($cart->qty)); ?>" class="count_single_item input-number qty" type="text" data-qty_id="#qty_<?php echo e($cart->id); ?>" data-change_amount="1" data-maximum_qty="#maximum_qty_<?php echo e($cart->id); ?>"
                                                                data-minimum_qty="#minimum_qty_<?php echo e($cart->id); ?>" data-product_stock="<?php echo e($cart->product->product_stock); ?>" data-stock_manage="<?php echo e($cart->product->product->stock_manage); ?>" data-wholesale="#getWholesalePrice_<?php echo e($cart->id); ?>" data-cart_id="<?php echo e($cart->id); ?>">
                                                                <input type="hidden" value="<?php echo e($cart->id); ?>" name="cart_id[]">
                                                                <input type="hidden" id="maximum_qty_<?php echo e($cart->id); ?>" value="<?php echo e($cart->product->product->product->max_order_qty); ?>">
                                                                <input type="hidden" id="minimum_qty_<?php echo e($cart->id); ?>" value="<?php echo e($cart->product->product->product->minimum_order_qty); ?>">
                                                                <button class="count_single_item number_increment change_qty" data-qty_id="#qty_<?php echo e($cart->id); ?>" data-change_amount="1" data-maximum_qty="#maximum_qty_<?php echo e($cart->id); ?>"
                                                                    data-minimum_qty="#minimum_qty_<?php echo e($cart->id); ?>" data-product_stock="<?php echo e($cart->product->product_stock); ?>" data-stock_manage="<?php echo e($cart->product->product->stock_manage); ?>" data-wholesale="#getWholesalePrice_<?php echo e($cart->id); ?>" data-cart_id="<?php echo e($cart->id); ?>" type="button" value="+"> <i class="ti-plus"></i></button>

                                                                    <!-- for wholesale module -->
                                                                    <?php if(isModuleActive('WholeSale')): ?>
                                                                        <input type="hidden" id="getWholesalePrice_<?php echo e($cart->id); ?>" value="<?php if(@$cart->product->wholeSalePrices->count()): ?><?php echo e(json_encode(@$cart->product->wholeSalePrices)); ?> <?php else: ?> 0 <?php endif; ?>">
                                                                    <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg col-4 order-3 order-lg-0 my-3 my-lg-0 d-none d-lg-block">
                                                            <span class="opacity-60 font_12 d-none d-sm-block d-lg-none"><?php echo e(__('common.total')); ?></span>
                                                            <h4 class="font_16 f_w_700 m-0 lh-1 text-nowrap d-none d-lg-block">
                                                                <?php echo e(single_price($cart->total_price)); ?>

                                                            </h4>
                                                        </div>
                                                        <div class="col-lg-auto order-5 order-lg-0 text-end">
                                                            <span class="close_icon style_2 lh-1 cart_item_delete_btn cursor_pointer" data-id="<?php echo e($cart->id); ?>" data-product_id="<?php echo e($cart->product_id); ?>" data-unique_id="#delete_item_<?php echo e($cart->id); ?>" id="delete_item_<?php echo e($cart->id); ?>">
                                                                <svg  width="12.249" height="15.076" viewBox="0 0 12.249 15.076">
                                                                    <g  transform="translate(-48)">
                                                                        <path  data-name="Path 1449" d="M59.071,1.884H56.48V1.413A1.415,1.415,0,0,0,55.067,0H53.182a1.415,1.415,0,0,0-1.413,1.413v.471H49.178A1.179,1.179,0,0,0,48,3.062V4.711a.471.471,0,0,0,.471.471h.257l.407,8.547a1.412,1.412,0,0,0,1.412,1.346H57.7a1.412,1.412,0,0,0,1.412-1.346l.407-8.547h.257a.471.471,0,0,0,.471-.471V3.062A1.179,1.179,0,0,0,59.071,1.884Zm-6.36-.471a.472.472,0,0,1,.471-.471h1.884a.472.472,0,0,1,.471.471v.471H52.711ZM48.942,3.062a.236.236,0,0,1,.236-.236h9.893a.236.236,0,0,1,.236.236V4.24H48.942Zm9.23,10.623a.471.471,0,0,1-.471.449H50.547a.471.471,0,0,1-.471-.449l-.4-8.5h8.905Z" fill="#00124e"></path>
                                                                        <path  data-name="Path 1450" d="M240.471,215.067a.471.471,0,0,0,.471-.471v-6.125a.471.471,0,1,0-.942,0V214.6A.471.471,0,0,0,240.471,215.067Z" transform="translate(-186.347 -201.875)" fill="#00124e"></path>
                                                                        <path  data-name="Path 1451" d="M320.471,215.067a.471.471,0,0,0,.471-.471v-6.125a.471.471,0,1,0-.942,0V214.6A.471.471,0,0,0,320.471,215.067Z" transform="translate(-263.991 -201.875)" fill="#00124e"></path>
                                                                        <path  data-name="Path 1452" d="M160.471,215.067a.471.471,0,0,0,.471-.471v-6.125a.471.471,0,0,0-.942,0V214.6A.471.471,0,0,0,160.471,215.067Z" transform="translate(-108.702 -201.875)" fill="#00124e"></path>
                                                                    </g>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php else: ?>
                                                <?php if($cart->is_select == 1): ?>
                                                    <?php if(is_null($cart->giftCard->type)): ?>
                                                        <?php
                                                            $subtotal += $cart->giftCard->sell_price * $cart->qty;
                                                        ?>
                                                    <?php else: ?>
                                                        <?php
                                                            $subtotal += $cart->giftCard->addGiftCardInfo->gift_selling_price * $cart->qty;
                                                        ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <li class="list-group-item px-0 px-lg-3 mb_10">
                                                    <div class="row gutters-5 align-items-center">
                                                        <div class="col-lg-5 d-flex">
                                                            <?php if(is_null($cart->giftCard->type)): ?>
                                                                <a href="<?php echo e(route('frontend.gift-card.show',$cart->giftCard->sku)); ?>" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                                    <div class="thumb">
                                                                        <img src="<?php echo e(showImage(@$cart->giftCard->thumbnail_image)); ?>" alt="<?php echo e(textLimit(@$cart->giftCard->name, 35)); ?>" title="<?php echo e(textLimit(@$cart->giftCard->name, 35)); ?>">
                                                                    </div>
                                                                    <div class="summery_pro_content">
                                                                        <h4 class="font_16 f_w_700 m-0 theme_hover"><?php echo e(textLimit(@$cart->giftCard->name, 35)); ?></h4>
                                                                    </div>
                                                                </a>
                                                            <?php else: ?>
                                                                <a href="<?php echo e(route('frontend.gift-card.show.multiple',$cart->giftCard->sku)); ?>" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                                    <div class="thumb">
                                                                        <img src="<?php echo e(showImage(@$cart->giftCard->thumbnail_image)); ?>" alt="<?php echo e(textLimit(@$cart->giftCard->name, 35)); ?>" title="<?php echo e(textLimit(@$cart->giftCard->name, 35)); ?>">
                                                                    </div>
                                                                    <div class="summery_pro_content">
                                                                        <h4 class="font_16 f_w_700 m-0 theme_hover"><?php echo e(textLimit(@$cart->giftCard->name, 35)); ?></h4>
                                                                    </div>
                                                                </a>
                                                            <?php endif; ?>
                                                        </div>

                                                        <div class="col-lg col-4 order-1 order-lg-0 my-3 my-lg-0">
                                                            <span class="opacity-60 font_12 d-block d-lg-none"><?php echo e(__('common.price')); ?></span>
                                                            <h4 class="font_16 f_w_700 m-0 text-nowrap"><?php echo e(single_price($cart->price)); ?></h4>
                                                        </div>
                                                        <div class="col-lg col-6 order-4 order-lg-0">
                                                            <div class="product_number_count style_4" data-target="amount-1">
                                                                <input type="hidden" value="<?php echo e($cart->id); ?>" name="cart_id[]">
                                                                <input type="hidden" id="maximum_qty_<?php echo e($cart->id); ?>" value="">
                                                                <input type="hidden" id="minimum_qty_<?php echo e($cart->id); ?>" value="1">
                                                                <button class="count_single_item inumber_decrement change_qty" data-qty_id="#qty_<?php echo e($cart->id); ?>" data-cart_id="<?php echo e($cart->id); ?>" data-change_amount="1" data-maximum_qty="#maximum_qty_<?php echo e($cart->id); ?>"
                                                                    data-minimum_qty="#minimum_qty_<?php echo e($cart->id); ?>" data-product_stock="0" data-stock_manage="0" data-wholesale="#getWholesalePrice_<?php echo e($cart->id); ?>" type="button" value="-"> <i class="ti-minus"></i></button>
                                                                <input name="qty[]" id="qty_<?php echo e($cart->id); ?>" data-value="<?php echo e($cart->qty); ?>" value="<?php echo e(getNumberTranslate($cart->qty)); ?>" class="count_single_item input-number qty" type="text" data-qty_id="#qty_<?php echo e($cart->id); ?>" data-cart_id="<?php echo e($cart->id); ?>" data-change_amount="1" data-maximum_qty="#maximum_qty_<?php echo e($cart->id); ?>"
                                                                data-minimum_qty="#minimum_qty_<?php echo e($cart->id); ?>" data-product_stock="0" data-stock_manage="0" data-wholesale="#getWholesalePrice_<?php echo e($cart->id); ?>">
                                                                <button class="count_single_item number_increment change_qty" data-qty_id="#qty_<?php echo e($cart->id); ?>" data-cart_id="<?php echo e($cart->id); ?>" data-change_amount="1" data-maximum_qty="#maximum_qty_<?php echo e($cart->id); ?>"
                                                                    data-minimum_qty="#minimum_qty_<?php echo e($cart->id); ?>" data-product_stock="0" data-stock_manage="0" data-wholesale="#getWholesalePrice_<?php echo e($cart->id); ?>" type="button" value="+"> <i class="ti-plus"></i></button>

                                                                <!-- for wholesale module -->
                                                                <?php if(isModuleActive('WholeSale')): ?>
                                                                    <input type="hidden" id="getWholesalePrice_<?php echo e($cart->id); ?>" value="0">
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg col-4 order-3 order-lg-0 my-3 my-lg-0">
                                                            <span class="opacity-60 font_12 d-block d-lg-none"><?php echo e(__('common.total')); ?></span>
                                                            <h4 class="font_16 f_w_700 m-0 lh-1 text-nowrap">
                                                                <?php echo e(single_price($cart->total_price)); ?>

                                                            </h4>
                                                        </div>
                                                        <div class="col-lg-auto col-6 order-5 order-lg-0 text-end">
                                                            <span class="close_icon style_2 lh-1 cart_item_delete_btn cursor_pointer" data-id="<?php echo e($cart->id); ?>" data-product_id="<?php echo e($cart->product_id); ?>" data-unique_id="#delete_item_<?php echo e($cart->id); ?>" id="delete_item_<?php echo e($cart->id); ?>">
                                                                <svg  width="12.249" height="15.076" viewBox="0 0 12.249 15.076">
                                                                    <g  transform="translate(-48)">
                                                                        <path  data-name="Path 1449" d="M59.071,1.884H56.48V1.413A1.415,1.415,0,0,0,55.067,0H53.182a1.415,1.415,0,0,0-1.413,1.413v.471H49.178A1.179,1.179,0,0,0,48,3.062V4.711a.471.471,0,0,0,.471.471h.257l.407,8.547a1.412,1.412,0,0,0,1.412,1.346H57.7a1.412,1.412,0,0,0,1.412-1.346l.407-8.547h.257a.471.471,0,0,0,.471-.471V3.062A1.179,1.179,0,0,0,59.071,1.884Zm-6.36-.471a.472.472,0,0,1,.471-.471h1.884a.472.472,0,0,1,.471.471v.471H52.711ZM48.942,3.062a.236.236,0,0,1,.236-.236h9.893a.236.236,0,0,1,.236.236V4.24H48.942Zm9.23,10.623a.471.471,0,0,1-.471.449H50.547a.471.471,0,0,1-.471-.449l-.4-8.5h8.905Z" fill="#00124e"></path>
                                                                        <path  data-name="Path 1450" d="M240.471,215.067a.471.471,0,0,0,.471-.471v-6.125a.471.471,0,1,0-.942,0V214.6A.471.471,0,0,0,240.471,215.067Z" transform="translate(-186.347 -201.875)" fill="#00124e"></path>
                                                                        <path  data-name="Path 1451" d="M320.471,215.067a.471.471,0,0,0,.471-.471v-6.125a.471.471,0,1,0-.942,0V214.6A.471.471,0,0,0,320.471,215.067Z" transform="translate(-263.991 -201.875)" fill="#00124e"></path>
                                                                        <path  data-name="Path 1452" d="M160.471,215.067a.471.471,0,0,0,.471-.471v-6.125a.471.471,0,0,0-.942,0V214.6A.471.471,0,0,0,160.471,215.067Z" transform="translate(-108.702 -201.875)" fill="#00124e"></path>
                                                                    </g>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($cart->is_select == 1): ?>
                                                <?php
                                                    $actual_price += $cart->total_price;
                                                ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                    <div class="d-flex gap_10 align-items-center flex-wrap mt_20">
                        <div class="d-none d-lg-flex align-items-center gap_10 flex-fill flex-wrap">
                            <a href="<?php echo e(url('/')); ?>" class="amaz_primary_btn2 style3"><?php echo e(__('defaultTheme.continue_shopping')); ?></a>
                        </div>
                        <a class="amaz_primary_btn min_200 style2 cursor_pointer <?php if(count($cartData) > 0): ?> process_to_checkout_check <?php endif; ?>" data-value="<?php echo e($selected_product_check); ?>"><?php echo e(__('defaultTheme.proceed_to_checkout')); ?></a>
                    </div>
                </div>
            <!-- for wholesale module -->
            <input type="hidden" id="isWholeSaleActive" value="<?php echo e(isModuleActive('WholeSale')); ?>">
            <!-- for wholesale module -->
            <?php endif; ?>
        </div>
        <?php if(count($cartData) < 1): ?>
            <div class="col-lg-12 text-center mb_50">
                <span class="product_not_found"><?php echo e(__('defaultTheme.no_product_found')); ?></span>
            </div>
        <?php endif; ?>
    </form>
    <div class="checkout_v3_right d-flex justify-content-start checkout_summery_div">
        <?php
            $grand_total = $actual_price;
            $discount = $subtotal -$actual_price;
        ?>
        <div class="order_sumery_box flex-fill">
            <h3 class="check_v3_title mb_25"><?php echo e(__('common.order_summary')); ?></h3>
            <div class="subtotal_lists">
                <div class="single_total_list d-flex align-items-center">
                    <div class="single_total_left flex-fill">
                        <h4><?php echo e(__('common.subtotal')); ?></h4>
                    </div>
                    <div class="single_total_right">
                        <?php if(app('general_setting')->price_with_vat): ?>
                        <span>+ <?php echo e(single_price($subtotal - $tax)); ?></span>
                        <?php else: ?>
                            <span>+ <?php echo e(single_price($subtotal)); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="single_total_list d-flex align-items-center flex-wrap">
                    <div class="single_total_left flex-fill">
                        <h4><?php echo e(__('common.shipping_charge')); ?></h4>
                    </div>
                    <div class="single_total_right">
                        <span><?php echo e(__('defaultTheme.calculated_at_next_step')); ?></span>
                    </div>
                </div>
                <div class="single_total_list d-flex align-items-center flex-wrap">
                    <div class="single_total_left flex-fill">
                        <h4><?php echo e(__('common.discount')); ?></h4>
                    </div>
                    <div class="single_total_right">
                        <span>- <?php echo e(single_price($discount)); ?></span>
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
                <div class="total_amount d-flex align-items-center flex-wrap">
                    <div class="single_total_left flex-fill">
                        <span class="total_text"><?php echo e(__('common.total')); ?></span>
                    </div>
                    <div class="single_total_right">
                        <span class="total_text" id="grand_total" data-amount='<?php echo e(str_replace(',','',number_format($grand_total,2))); ?>'><span><?php echo e(single_price($grand_total)); ?></span></span>
                    </div>
                </div>

                <div class="total_amount d-flex align-items-center flex-wrap mt-2 mb-2">
                   <div id="TabbyPromo"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/Production_dev/resources/views/frontend/amazy/partials/_cart_details.blade.php ENDPATH**/ ?>