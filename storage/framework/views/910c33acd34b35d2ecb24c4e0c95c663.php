
<?php $__env->startSection('title'); ?>
    <?php echo e(__('defaultTheme.select_shipping')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- checkout_v3_area::start  -->
    <form action="<?php echo e(route('frontend.checkout')); ?>" method="GET" enctype="multipart/form-data" id="mainOrderForm">
        <input type="hidden" name="step" value="select_payment">
        <div id="mainDiv">
            <div class="checkout_v3_area">
                <div class="checkout_v3_left d-flex justify-content-end">
                    <div class="checkout_v3_inner">
                        <div class="shiping_address_box checkout_form m-0">
                            <div class="billing_address">

                                <div class="row">
                                    <div class="col-12">
                                        <div class="shipingV3_info mb_30">
                                            <div class="single_shipingV3_info d-flex align-items-start">
                                                <span><?php echo e(__('defaultTheme.contact')); ?></span>
                                                <h5 class="m-0 flex-fill"><?php echo e($address->email); ?></h5>
                                                <a href="<?php echo e(url()->previous()); ?>" class="edit_info_text"><?php echo e(__('common.change')); ?></a>
                                            </div>
                                            <div class="single_shipingV3_info d-flex align-items-start">
                                                <span><?php echo e(__('defaultTheme.ship_to')); ?></span>
                                                <h5 class="m-0 flex-fill"><?php echo e($address->address); ?></h5>
                                                <a href="<?php echo e(url()->previous()); ?>" class="edit_info_text"><?php echo e(__('common.change')); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <h3 class="check_v3_title2 mb_13 "><?php echo e(__('defaultTheme.shipping_method')); ?></h3>
                                    </div>
                                    <input type="hidden" value="home_delivery" name="delivery_type">
                                <?php
                                    $can_process = [];
                                ?>
                                <?php if(isModuleActive('INTShipping')): ?>
                                    <div class="col-12">
                                        <?php $__currentLoopData = $cartData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $shipcart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($shipcart->product_type == 'product' && @$shipcart->product->product->product->is_physical): ?>
                                                <div class="ck-cart-box">
                                                    <ul class="ck-cart-list">
                                                        <li class="d-grid align-items-center">
                                                            <div class="d-flex align-items-center">
                                                                <div class="img">
                                                                    <img src="<?php if($shipcart->product->product->product->product_type == 1): ?>
                                                                    <?php echo e(showImage($shipcart->product->product->product->thumbnail_image_source)); ?>

                                                                    <?php else: ?>
                                                                    <?php echo e(showImage(@$shipcart->product->sku->variant_image?@$shipcart->product->sku->variant_image:@$shipcart->product->product->product->thumbnail_image_source)); ?>

                                                                    <?php endif; ?>" alt="<?php echo e($shipcart->product->product->product_name); ?>" title="<?php echo e($shipcart->product->product->product_name); ?>">
                                                                </div>

                                                                <div class="content">
                                                                    <h6 class="mb-0"><?php echo e($shipcart->product->product->product_name); ?></h6>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <p class="text-end"><?php echo e(single_price($shipcart->price)); ?></p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <?php
                                                        $products = \Modules\INTShipping\Entities\SellerProductShippingProfile::where('seller_product_id',$shipcart->product->product_id)->get();
                                                        $rates = [];
                                                        foreach ($products as $product) {

                                                            if($shipping_address != null){
                                                                $zones =  \Modules\INTShipping\Entities\ShippingZone::with('rates')->where('shipping_profile_id',$product->shipping_profile_id)->WhereHas('state_list', function($query) use($address){
                                                                        return $query->where('state_id', $address->state);
                                                                    })->get();
                                                            }else{

                                                                $zones =  \Modules\INTShipping\Entities\ShippingZone::with('rates')->where('shipping_profile_id',$product->shipping_profile_id)->WhereHas('state_list', function($query) use($shipping_address){
                                                                    return $query->where('state_id', $shipping_address->state);
                                                                })->get();
                                                            }

                                                            if($zones){
                                                                foreach($zones as $zone){
                                                                    foreach($zone->rates as $rate){
                                                                        $rates[] = $rate;
                                                                    }
                                                                }
                                                            }
                                                        }

                                                    ?>
                                                    <?php if(count($rates) > 0): ?>
                                                    <?php
                                                        $can_process[] = 1;
                                                    ?>

                                                        <select name="intshipping_cartItem[]" id="uniqueCartId<?php echo e($shipcart->id); ?>" class="theme_select w-100 ck-select intshiping" data-id="<?php echo e($shipcart->id); ?>">
                                                            <option value="0" selected disabled><?php echo e(__('defaultTheme.select_shipping')); ?></option>

                                                            <?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                <?php
                                                                    $product_shipping_cost = 0;
                                                                ?>
                                                                <?php if($rate->base_on_item == 1): ?>

                                                                        <?php
                                                                             $product_shipping_cost = ($shipcart->product->sku->weight * $shipcart->qty / 100) * $rate->rate_cost + ($shipcart->product->sku->additional_shipping * $shipcart->qty);
                                                                        ?>
                                                                        <option value="<?php echo e(($product_shipping_cost)); ?> <?php echo e($rate->id); ?>"><?php echo e($rate->rate_name); ?> - <?php echo e(single_price($product_shipping_cost)); ?> - <?php echo e($rate->shipment_time); ?></option>

                                                                <?php elseif($rate->base_on_item == 2): ?>

                                                                        <?php
                                                                        $product_shipping_cost = ($shipcart->total_price / 100) * $rate->rate_cost + ($shipcart->product->sku->additional_shipping * $shipcart->qty);
                                                                        ?>
                                                                        <option value="<?php echo e(($product_shipping_cost)); ?> <?php echo e($rate->id); ?>"><?php echo e($rate->rate_name); ?> - <?php echo e(single_price($product_shipping_cost)); ?> - <?php echo e($rate->shipment_time); ?></option>

                                                                <?php else: ?>

                                                                        <?php
                                                                            if(sellerWiseShippingConfig(1)['amount_multiply_with_qty']){
                                                                                $product_shipping_cost = ($rate->rate_cost + $shipcart->product->sku->additional_shipping) * $shipcart->qty;
                                                                            }else{
                                                                                $product_shipping_cost = $rate->rate_cost + ($shipcart->product->sku->additional_shipping * $shipcart->qty);
                                                                            }
                                                                        ?>
                                                                        <option value="<?php echo e($product_shipping_cost); ?> <?php echo e($rate->id); ?>"><?php echo e($rate->rate_name); ?> - <?php echo e(single_price($product_shipping_cost)); ?> - <?php echo e($rate->shipment_time); ?></option>

                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <span class="text-danger" id="error_intship_cart_item_<?php echo e($shipcart->id); ?>"></span>
                                                    <?php else: ?>
                                                    <?php
                                                        $can_process[] = 0;
                                                    ?>
                                                    <div class="w-100 mt-3">
                                                        <div class="alert alert-warning">
                                                            <p>This Item can not be shipped in your country.</p>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <input type="hidden" name="shipping_method_cost" id="shipping_method_cost" value="0">
                                    <input type="hidden" name="shipping_method" id="shipping_method">
                                <?php else: ?>
                                  <?php
                                    $can_process[] = 1;
                                  ?>
                                    <div class="col-12 mb_25">
                                        <?php
                                            $additional_cost = 0;
                                            $totalItemPrice = 0;
                                            $totalItemWeight = 0;
                                            $physical_count = 0;
                                        ?>
                                        <?php if(!isModuleActive('MultiVendor')): ?>
                                            <?php $__currentLoopData = $cartData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ct => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($item->product_type == 'product' && @$item->product->product->product->is_physical): ?>
                                                    <?php
                                                        $additional_cost += $item->product->sku->additional_shipping;
                                                        $totalItemPrice += $item->total_price;
                                                        $totalItemWeight += !empty($item->product->sku->weight) ? $item->product->sku->weight * $item->qty : 0;
                                                        $physical_count += 1;
                                                    ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($physical_count > 0): ?>
                                                <?php
                                                    $skip_method = null;
                                                    $disabled = [];
                                                ?>
                                                <?php $__currentLoopData = $shipping_methods->where('id','>',1)->where('request_by_user', 1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $shipping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $cost = 0;
                                                        if($shipping->cost_based_on == 'Price'){
                                                            if($totalItemPrice > 0){
                                                                $cost = ($totalItemPrice / 100) * $shipping->cost + $additional_cost;
                                                            }

                                                        }elseif ($shipping->cost_based_on == 'Weight'){
                                                            if($totalItemWeight > 0){
                                                                $cost = ($totalItemWeight / 100) * $shipping->cost + $additional_cost;
                                                            }
                                                        }else{
                                                            if($shipping->cost > 0){
                                                                if(sellerWiseShippingConfig(1)['amount_multiply_with_qty']){
                                                                    $cost = ($shipping->cost + $additional_cost) * $item->qty;
                                                                }else{
                                                                    $cost = $shipping->cost + $additional_cost;
                                                                }
                                                            }
                                                        }
                                                        $checkoutRepo = new \App\Repositories\CheckoutRepository();
                                                        $tax_total = $checkoutRepo->totalAmountForPayment($cartData,$shipping,$address)['tax_total'];
                                                        // $total_check = $cost + $totalItemPrice + $tax_total;
                                                        $total_check = $totalItemPrice + $tax_total;
                                                    ?>
                                                    <?php if($shipping->minimum_shopping >= $total_check): ?>
                                                        <?php
                                                            $disabled[] = $shipping->id;
                                                        ?>
                                                    <?php else: ?>
                                                        <?php if($skip_method == null): ?>
                                                            <?php
                                                                $skip_method = $shipping->id;
                                                            ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                    <div class="standard_shiping_box">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <label class="primary_checkbox d-inline-flex style4 flex-wrap">
                                                                <input type="radio" data-cost="<?php echo e($cost); ?>" name="shipping_method" class="shipping_method" value="<?php if(in_array($shipping->id, $disabled)): ?><?php else: ?><?php echo e(encrypt($shipping->id)); ?><?php endif; ?>" <?php echo e($shipping->id == $skip_method?'checked':''); ?> <?php if(in_array($shipping->id, $disabled)): ?> disabled <?php endif; ?>>
                                                                <span class="checkmark mr_10"></span>
                                                                <span class="label_name f_w_500 mute_text"><?php echo e($shipping->method_name); ?></span>
                                                                <span class="label_name f_w_500 mute_text ml_15 text-nowrap">
                                                                    [
                                                                        <?php echo e(sellerWiseShippingConfig(1)['carrier_show_for_customer'] == 1 ? $shipping->carrier->name. '-' :''); ?>

                                                                        <?php echo e($shipping->shipment_time); ?> -

                                                                        [<span class="required_mark_theme">
                                                                        <?php if($shipping->cost_based_on == 'Price'): ?>
                                                                            Per Hundred
                                                                        <?php elseif($shipping->cost_based_on == 'Weight'): ?>
                                                                            Per 100 Gm
                                                                        <?php else: ?>
                                                                            Flat Rate
                                                                        <?php endif; ?>
                                                                        </span>]
                                                                    ]
                                                                </span>
                                                            </label>
                                                            <?php if($shipping->id == $skip_method): ?>
                                                                <input type="hidden" id="shipping_method_cost" value="<?php echo e($cost); ?>">
                                                            <?php endif; ?>
                                                            <span class="text-nowrap"><?php echo e(single_price($cost)); ?></span>
                                                        </div>
                                                        <div>
                                                            <span class="label_name f_w_500 mute_text ml_15"><?php echo e(__('shipping.minimum_shopping_amount')); ?> (<?php echo e(__('shipping.without_shipping_cost')); ?>): <?php echo e(single_price($shipping->minimum_shopping)); ?></span>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <?php
                                                    $email_shipping = \Modules\Shipping\Entities\ShippingMethod::first();
                                                ?>

                                                <div class="standard_shiping_box">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <label class="primary_checkbox d-inline-flex style4">
                                                            <input type="radio" data-cost="<?php echo e(0); ?>" class="shipping_method" name="shipping_method" value="<?php echo e(encrypt(1)); ?>" checked>
                                                            <span class="checkmark mr_10"></span>
                                                            <span class="label_name f_w_500 mute_text"><?php echo e($email_shipping->method_name); ?></span>
                                                            <span class="label_name f_w_500 mute_text ml_15">
                                                                [
                                                                    <?php echo e(sellerWiseShippingConfig(1)['carrier_show_for_customer'] == 1 ? $email_shipping->carrier->name. '-' :''); ?>

                                                                    <?php echo e($email_shipping->shipment_time); ?>

                                                                ]
                                                            </span>
                                                        </label>
                                                        <input type="hidden" id="shipping_method_cost" value="0">
                                                        <span><?php echo e(single_price(0)); ?></span>
                                                    </div>
                                                </div>

                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                    <?php if($errors->has('shipping_method')): ?>
                                        <div class="col-12 mb_30 shipping_error">
                                            <span class="text-danger"><?php echo e(__('shipping.minium_shopping_amount_is_not_fulfill')); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-12">
                                        <div class="check_v3_btns flex-wrap d-flex align-items-center">
                                            <?php if(isModuleActive('INTShipping')): ?>
                                              <button <?php echo e(in_array(0,$can_process) ? 'disabled':''); ?> type="submit" class="amaz_primary_btn style2 <?php echo e(in_array(0,$can_process) ? 'disabled':''); ?> min_200 text-center text-uppercase" id="IntshippingBtn"><?php echo e(__('defaultTheme.continue_to_payment')); ?></button>
                                            <?php else: ?>
                                              <button type="submit" class="amaz_primary_btn style2  min_200 text-center text-uppercase "><?php echo e(__('defaultTheme.continue_to_payment')); ?></button>
                                           <?php endif; ?>
                                            <a href="<?php echo e(url('/checkout')); ?>" class="return_text"><?php echo e(__('defaultTheme.return_to_information')); ?></a>
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
                                $subtotal = 0;
                                $actual_price = 0;
                                $tax = 0;

                            ?>
                            <?php $__currentLoopData = $cartData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $sameStateTaxes = \Modules\GST\Entities\GstTax::whereIn('id', app('gst_config')['within_a_single_state'])->get();
                                    $diffStateTaxes = \Modules\GST\Entities\GstTax::whereIn('id', app('gst_config')['between_two_different_states_or_a_state_and_a_Union_Territory'])->get();
                                    $flatTax = \Modules\GST\Entities\GstTax::where('id', app('gst_config')['flat_tax_id'])->first();
                                ?>
                                <?php if($cart->product_type == 'product'): ?>
                                    <div class="singleVendor_product_lists">
                                        <div class="singleVendor_product_list d-flex align-items-center">
                                            <div class="thumb single_thumb">
                                                <img src="
                                                    <?php if($cart->product->product->product->product_type == 1): ?>
                                                    <?php echo e(showImage($cart->product->product->product->thumbnail_image_source)); ?>

                                                    <?php else: ?>
                                                    <?php echo e(showImage(@$cart->product->sku->variant_image?@$cart->product->sku->variant_image:@$cart->product->product->product->thumbnail_image_source)); ?>

                                                    <?php endif; ?>
                                                " alt="<?php echo e(\Illuminate\Support\Str::limit(@$cart->product->product->product_name, 28, $end='...')); ?>" title="<?php echo e(\Illuminate\Support\Str::limit(@$cart->product->product->product_name, 28, $end='...')); ?>">
                                            </div>
                                            <div class="product_list_content">
                                                <h4><a href="<?php echo e(singleProductURL($cart->product->product->seller->slug, $cart->product->product->slug)); ?>"><?php echo e(\Illuminate\Support\Str::limit(@$cart->product->product->product_name, 28, $end='...')); ?></a></h4>
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
                                                $subtotal += $cart->product->sell_price * $cart->qty;
                                            }
                                        }else{
                                            $subtotal += $cart->product->sell_price * $cart->qty;
                                        }
                                    ?>
                                    <?php if(app('general_setting')->price_with_vat): ?>
                                    <?php
                                    $tax += $cart->product->product->tax * $cart->qty;
                                    ?>
                                    <?php else: ?>
                                        <?php if(file_exists(base_path().'/Modules/GST/') && $cart->product->product->product->is_physical == 1): ?>

                                            <?php if($address && app('gst_config')['enable_gst'] == "gst"): ?>
                                                <?php if(\app\Traits\PickupLocation::pickupPointAddress(1)->state_id == $address->state): ?>

                                                    <?php if($cart->product->product->product->gstGroup): ?>
                                                        <?php
                                                            $sameStateTaxesGroup = json_decode($cart->product->product->product->gstGroup->same_state_gst);
                                                            $sameStateTaxesGroup = (array) $sameStateTaxesGroup;
                                                        ?>
                                                        <?php $__currentLoopData = $sameStateTaxesGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sameStateTax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                                $gstAmount = ($cart->total_price * $sameStateTax) / 100;
                                                                $tax += $gstAmount;
                                                            ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>

                                                        <?php $__currentLoopData = $sameStateTaxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sameStateTax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                                $gstAmount = ($cart->total_price * $sameStateTax->tax_percentage) / 100;
                                                                $tax += $gstAmount;
                                                            ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                <?php else: ?>

                                                    <?php if($cart->product->product->product->gstGroup): ?>
                                                        <?php
                                                            $diffStateTaxesGroup = json_decode($cart->product->product->product->gstGroup->outsite_state_gst);
                                                            $diffStateTaxesGroup = (array) $diffStateTaxesGroup;
                                                        ?>
                                                        <?php $__currentLoopData = $diffStateTaxesGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $diffStateTax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                                $gstAmount = ($cart->total_price * $diffStateTax) / 100;
                                                                $tax += $gstAmount;
                                                            ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>

                                                        <?php $__currentLoopData = $diffStateTaxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $diffStateTax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                                $gstAmount = ($cart->total_price * $diffStateTax->tax_percentage) / 100;
                                                                $tax += $gstAmount;
                                                            ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                            <?php elseif(app('gst_config')['enable_gst'] == "flat_tax"): ?>

                                                <?php if($cart->product->product->product->gstGroup): ?>
                                                    <?php
                                                        $flatTaxGroup = json_decode($cart->product->product->product->gstGroup->same_state_gst);
                                                        $flatTaxGroup = (array) $flatTaxGroup;
                                                    ?>
                                                    <?php $__currentLoopData = $flatTaxGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sameStateTax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $gstAmount = $cart->total_price * $sameStateTax / 100;
                                                            $tax += $gstAmount;
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <?php
                                                        $gstAmount = $cart->total_price * $flatTax->tax_percentage / 100;
                                                        $tax += $gstAmount;
                                                    ?>
                                                <?php endif; ?>

                                            <?php endif; ?>

                                        <?php else: ?>
                                            <?php if($cart->product->product->product->gstGroup): ?>
                                                <?php
                                                    $sameStateTaxesGroup = json_decode($cart->product->product->product->gstGroup->same_state_gst);
                                                    $sameStateTaxesGroup = (array) $sameStateTaxesGroup;
                                                ?>
                                                <?php $__currentLoopData = $sameStateTaxesGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sameStateTax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $gstAmount = ($cart->total_price * $sameStateTax) / 100;
                                                        $tax += $gstAmount;
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <?php $__currentLoopData = $sameStateTaxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sameStateTax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $gstAmount = ($cart->total_price * $sameStateTax->tax_percentage) / 100;
                                                        $tax += $gstAmount;
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>

                                        <?php endif; ?>
                                    <?php endif; ?>

                                <?php else: ?>
                                    <div class="singleVendor_product_lists">
                                        <div class="singleVendor_product_list d-flex align-items-center">
                                            <div class="thumb single_thumb">
                                                <img src="<?php echo e(showImage(@$cart->giftCard->thumbnail_image)); ?>" alt="<?php echo e(\Illuminate\Support\Str::limit(@$cart->giftCard->name, 28, $end='...')); ?>" title="<?php echo e(\Illuminate\Support\Str::limit(@$cart->giftCard->name, 28, $end='...')); ?>">
                                            </div>
                                            <div class="product_list_content">
                                                <h4><a href="<?php echo e(route('frontend.gift-card.show',$cart->giftCard->sku)); ?>"><?php echo e(\Illuminate\Support\Str::limit(@$cart->giftCard->name, 28, $end='...')); ?></a></h4>
                                                <h5 class="d-flex align-items-center"><span class="product_count_text" ><?php echo e(getNumberTranslate($cart->qty)); ?><span>x</span></span><?php echo e(single_price($cart->price)); ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        $actual_price += $cart->total_price;
                                        $subtotal += $cart->giftCard->sell_price * $cart->qty;
                                    ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php
                            if (app('general_setting')->price_with_vat){
                                $total = $actual_price;
                            }else {
                                $total = $actual_price + $tax;
                            }
                                $discount = $subtotal - $actual_price;
                                $totalCostWithoutShipping = $total;
                            ?>

                        <?php endif; ?>

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
                                    <span>+ <span id="shipping_cost"></span></span>
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
                                    <span>+ <?php echo e(single_price($tax)); ?></span>
                                </div>
                            </div>
                            <div class="total_amount d-flex align-items-center flex-wrap">
                                <div class="single_total_left flex-fill">
                                    <span class="total_text"><?php echo e(__('common.total')); ?> (Incl. <?php echo e(__('common.vat/tax/gst')); ?>)</span>
                                </div>
                                <input type="hidden" id="total" value="<?php echo e($total); ?>">
                                <div class="single_total_right">
                                    <span class="total_text"><span id="grand_total"></span></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- checkout_v3_area::end  -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                let shipping_amount = $('#shipping_method_cost').val();
                if(shipping_amount != undefined){
                    shipping_cost(shipping_amount);
                }else{
                    shipping_cost(0);
                    shipping_amount = 0;
                }
                let total = $('#total').val();
                let format_total = parseFloat(total) + parseFloat(shipping_amount);
                grand_total(format_total);

                $(document).on('click', '.shipping_method', function(){
                    let cost = $(this).data('cost');
                    shipping_cost(cost);
                    grand_total(parseFloat(total) + parseFloat(cost));
                    $('#shipping_method_cost').val(cost);
                });

                function shipping_cost(cost){
                    $('#shipping_cost').text(currency_format(cost));
                }
                function grand_total(total){
                    $('#grand_total').text(currency_format(total));
                }

                const unique = (value, index, self) => {
                    return self.indexOf(value) === index
                }
                const cartId = [];
                $(document).on('change', '.intshiping', function(){
                    const cartitem = $(this).data('id');
                    cartId.push(cartitem);
                    const uniqueCartId = cartId.filter(unique);
                    var cartCost = 0;
                    const ratrId = [];
                    for (let i = 0; i < uniqueCartId.length; i++) {
                        var itemvalue = $('#uniqueCartId'+uniqueCartId[i]).val();
                        const myArray = itemvalue.split(" ");
                            ratrId.push(myArray[1]);
                            cartCost += parseFloat(myArray[0]);
                            $('#error_intship_cart_item_'+uniqueCartId[i]).text('');
                        }
                    const cost = parseFloat(cartCost);
                    shipping_cost(cost);
                    grand_total(parseFloat(total) + parseFloat(cost));
                    $('#shipping_method_cost').val(cost);
                    $('#shipping_method').val(JSON.stringify(ratrId));
                });
                function selectIntshippingValidation(e){
                    var is_validate = 0;
                    $("select[name*='intshipping_cartItem']").each(function () {
                        var cartitem = $(this).data('id');
                        var item =$('#uniqueCartId'+cartitem).val();
                            if ($('#uniqueCartId'+cartitem).val() == null) {
                                $('#error_intship_cart_item_'+cartitem).text('Please Select Shipping Method');
                                is_validate = 1;
                            }
                    });
                    if(is_validate == 1){
                        e.preventDefault();
                    }
                }
                $(document).on('click', '#IntshippingBtn', function(e){
                    selectIntshippingValidation(e);
                });
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.amazy.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/pages/shipping_step.blade.php ENDPATH**/ ?>