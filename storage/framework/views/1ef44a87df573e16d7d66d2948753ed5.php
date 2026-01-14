<!-- Modal::start  -->
<div class="modal fade theme_modal" id="theme_modal" tabindex="-1" role="dialog" aria-labelledby="theme_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="product_quick_view ">
                <button type="button" class="close_modal_icon" data-bs-dismiss="modal">
                    <i class="ti-close"></i>
                </button>
                    <div class="product_details_img" style="background-image: url(<?php if($product->thum_img != null): ?> <?php echo e(showImage($product->thum_img)); ?> <?php else: ?> <?php echo e(showImage($product->product->thumbnail_image_source)); ?> <?php endif; ?>)"></div>
                    <div class="product_details_wrapper">
                        <div class="product_content_details mb_30">
                            <p> <span><?php echo e(__('defaultTheme.sku')); ?>:</span> <span id="sku_id_li_modal" class="stock_text"><?php echo e(@$product->skus->first()->sku->sku??'-'); ?></span></p>
                            <?php
                                $stock = 0;
                            ?>
                            <?php if($product->stock_manage == 1): ?>
                                <p> <span><?php echo e(__('defaultTheme.availability')); ?>:</span> <span class="stock_text" id="availability_modal"><?php echo e($product->skus->first()->product_stock); ?></span> <span class="stock_text"><?php echo e(__('common.in_stock')); ?></span></p>
                            <?php else: ?>
                                <p class="stock_text"> <span><?php echo e(__('defaultTheme.availability')); ?>:</span> <?php echo e(__('defaultTheme.unlimited')); ?></p>
                            <?php endif; ?>
                            <h3><?php echo e($product->product_name); ?></h3>
                            <h5 class="prise_text d-flex align-items-center"><?php echo e(getProductDiscountedPrice($product)); ?></h5>
                            <div class="pro_details_disPrise d-flex align-items-center gap_15">
                                <h4 class="discount_prise  m-0  ">
                                    <span class="text-decoration-line-through">
                                        <?php if($product->hasDeal || $product->hasDiscount == 'yes'): ?>
                                            <span><?php echo e(single_price($product->skus->max('sell_price'))); ?></span>
                                        <?php endif; ?>
                                    </span>
                                </h4>
                                <span class="diccount_percents">
                                    <?php if(@$product->hasDeal): ?>
                                        <?php if(@$product->hasDeal->discount >0): ?>
                                            <?php if(@$product->hasDeal->discount_type ==0): ?>
                                                -<?php echo e(@$product->hasDeal->discount); ?>%
                                            <?php else: ?>
                                                -<?php echo e(single_price(@$product->hasDeal->discount)); ?>

                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if(@$product->hasDiscount == 'yes'): ?>
                                            <?php if($product->discount > 0): ?>

                                                <?php if($product->discount_type == 0): ?>
                                                -<?php echo e(getNumberTranslate($product->discount)); ?>%
                                                <?php else: ?>
                                                -<?php echo e(single_price($product->discount)); ?>

                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="product_ratings">
                                <div class="stars justify-content-center">
                                    <?php if (isset($component)) { $__componentOriginal1fd0c6214335ac543ccaaf0de3ed891a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1fd0c6214335ac543ccaaf0de3ed891a = $attributes; } ?>
<?php $component = App\View\Components\Rating::resolve(['rating' => $rating] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('rating'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Rating::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1fd0c6214335ac543ccaaf0de3ed891a)): ?>
<?php $attributes = $__attributesOriginal1fd0c6214335ac543ccaaf0de3ed891a; ?>
<?php unset($__attributesOriginal1fd0c6214335ac543ccaaf0de3ed891a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1fd0c6214335ac543ccaaf0de3ed891a)): ?>
<?php $component = $__componentOriginal1fd0c6214335ac543ccaaf0de3ed891a; ?>
<?php unset($__componentOriginal1fd0c6214335ac543ccaaf0de3ed891a); ?>
<?php endif; ?>
                                </div>
                                <span>(<?php echo e($total_review); ?> <?php echo e(__('defaultTheme.review')); ?>)</span>
                            </div>
                            <?php if($product->product->product_type == 2): ?>

                                <?php $__currentLoopData = session()->get('item_details'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($item['attr_id'] === 1): ?>
                                            <div class="product_color_varient mb_20">
                                                <h5 class="font_14 f_w_500 theme_text3  text-capitalize d-block mb_10" ><?php echo e($item['name']); ?>:</h5>
                                                <div class="color_List d-flex gap_5 flex-wrap">
                                                    <input type="hidden" class="attr_value_name" name="attr_val_name_modal[]" value="<?php echo e($item['value'][0]); ?>">
                                                    <input type="hidden" class="attr_value_id" name="attr_val_id_modal[]" value="<?php echo e($item['id'][0]); ?>-<?php echo e($item['attr_id']); ?>">
                                                    <?php $__currentLoopData = $item['value']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ks => $value_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <label class="round_checkbox d-flex">
                                                            <input id="radio-<?php echo e($ks); ?>" name="color_filt" class="attr_val_name" type="radio" color="color" <?php if($ks === 0): ?> checked <?php endif; ?> data-value="<?php echo e($item['id'][$ks]); ?>" data-value-key="<?php echo e($item['attr_id']); ?>" value="<?php echo e($value_name); ?>"/>
                                                            <span class="checkmark modal_colors_<?php echo e($ks); ?> class_color_<?php echo e($item['code'][$ks]); ?>">
                                                                <div class="check_bg_color"></div>
                                                            </span>
                                                        </label>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if($item['attr_id'] != 1): ?>
                                            <div class="product_color_varient mb_20">
                                                <h5 class="font_14 f_w_500 theme_text3  text-capitalize d-block mb_10" ><?php echo e($item['name']); ?>:</h5>
                                                <div class="color_List d-flex gap_5 flex-wrap">
                                                    <input type="hidden" class="attr_value_name" name="attr_val_name_modal[]" value="<?php echo e($item['value'][0]); ?>">
                                                    <input type="hidden" class="attr_value_id" name="attr_val_id_modal[]" value="<?php echo e($item['id'][0]); ?>-<?php echo e($item['attr_id']); ?>">
                                                    <?php $__currentLoopData = $item['value']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m => $value_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a class="attr_val_name size_btn not_111 <?php if($m === 0): ?> selected_btn <?php endif; ?>" color="not" data-value-key="<?php echo e($item['attr_id']); ?>" data-value="<?php echo e($item['id'][$m]); ?>"><?php echo e($value_name); ?></a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            <input type="hidden" name="product_sku_id" id="product_sku_id_modal"
                                value="<?php echo e($product->product->product_type == 1?$product->skus->first()->id : $product->skus->first()->id); ?>">
                            <input type="hidden" name="seller_id" id="seller_id_modal" value="<?php echo e($product->user_id); ?>">
                            <input type="hidden" name="stock_manage_status" id="stock_manage_status_modal"
                                value="<?php echo e($product->stock_manage); ?>">
                            <input type="hidden" id="product_id_modal" name="product_id" value="<?php echo e($product->id); ?>">
                            <input type="hidden" id="maximum_order_qty_modal"
                                value="<?php echo e(@$product->product->max_order_qty); ?>">
                            <input type="hidden" id="minimum_order_qty_modal"
                                value="<?php echo e(@$product->product->minimum_order_qty); ?>">
                            <input type="hidden" name="product_type" class="product_type"
                                    value="<?php echo e($product->product->product_type); ?>">
                                    <input type="hidden" name="base_sku_price" id="base_sku_price_modal"
                                    value="
                                        <?php if(@$product->hasDeal): ?>
                                            <?php echo e(selling_price($product->skus->first()->sell_price,$product->hasDeal->discount_type,$product->hasDeal->discount)); ?>

                                        <?php else: ?>
                                            <?php if($product->hasDiscount == 'yes'): ?>
                                                <?php echo e(selling_price($product->skus->first()->sell_price,$product->discount_type,$product->discount)); ?>

                                            <?php else: ?>
                                                <?php echo e($product->skus->first()->sell_price); ?>

                                            <?php endif; ?>
                                        <?php endif; ?>
                                        ">
                                <input type="hidden" name="final_price" id="final_price_modal" value="
                                        <?php if(@$product->hasDeal): ?>
                                            <?php echo e(selling_price($product->skus->first()->sell_price,$product->hasDeal->discount_type,$product->hasDeal->discount)); ?>

                                        <?php else: ?>
                                            <?php if($product->hasDiscount == 'yes'): ?>
                                                <?php echo e(selling_price($product->skus->first()->sell_price,$product->discount_type,$product->discount)); ?>

                                            <?php else: ?>
                                                <?php echo e($product->skus->first()->sell_price); ?>

                                            <?php endif; ?>
                                        <?php endif; ?>
                                        ">
                                <input type="hidden" value="<?php echo e(textLimit($product->product_name, 28)); ?>" id="product_name_modal">
                                <input type="hidden" value="<?php echo e(singleProductURL(@$product->seller->slug, @$product->slug)); ?>" id="product_url_modal">
                                <input type="hidden" name="thumb_image" id="thumb_image_modal" value="<?php if($product->thum_img != null): ?> <?php echo e(showImage($product->thum_img)); ?> <?php else: ?> <?php echo e(showImage($product->product->thumbnail_image_source)); ?> <?php endif; ?>">
                            <div class="product_info">

                                <div class="single_pro_varient">
                                    <h5 class="font_14 f_w_500 theme_text3 " ><?php echo e(__('common.quantity')); ?>:</h5>
                                    <div class="product_number_count mr_5" data-target="amount-10">
                                        <button class="count_single_item inumber_decrement cart-qty-minus-modal qtyChangeMinus" value="-"> <i class="ti-minus"></i></button>
                                        <input id="qty_modal" name="qty" class="count_single_item input-number qty" type="text" data-value="<?php echo e(@$product->product->minimum_order_qty); ?>" value="<?php echo e(getNumberTranslate(@$product->product->minimum_order_qty)); ?>" readonly>
                                        <button class="count_single_item number_increment qtyChangePlus cart-qty-plus-modal" value="+"> <i class="ti-plus"></i></button>
                                    </div>

                                </div>
                                <div class="row mt_20">
                                    <h4><span><?php echo e(__('common.total')); ?>:</span>
                                        <span id="total_price_modal">
                                            <?php if(@$product->hasDeal): ?>
                                                <?php echo e(single_price(selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) * $product->product->minimum_order_qty)); ?>

                                            <?php else: ?>
                                                <?php if($product->hasDiscount == 'yes'): ?>
                                                    <?php echo e(single_price(selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) * $product->product->minimum_order_qty)); ?>

                                                <?php else: ?>
                                                    <?php echo e(single_price(@$product->skus->first()->sell_price * $product->product->minimum_order_qty)); ?>

                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </span>
                                    </h4>
                                </div>
                                <div class="row mt_30" id="add_to_cart_div_modal">
                                    <?php if($product->stock_manage == 1 && $product->skus->first()->product_stock >= $product->product->minimum_order_qty || $product->stock_manage == 0): ?>
                                        <div class="col-md-6">
                                            <a href="" id="add_to_cart_btn_modal" class="home10_primary_btn2 mb_20 w-100 text-center add_to_cart text-uppercase flex-fill text-center"><?php echo e(__('common.add_to_cart')); ?></a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="#" class="home10_primary_btn4  w-100 radius_5px mb_20 w-100 text-center justify-content-center text-uppercase buy_now_btn_modal" data-id="<?php echo e($product->id); ?>" data-type="product"><?php echo e(__('common.buy_now')); ?></a>
                                        </div>
                                    <?php else: ?>
                                        <div class="col-md-6">
                                            <button type="button" disabled class="amaz_primary_btn style2 mb_20  add_to_cart text-uppercase flex-fill text-center w-100"><?php echo e(__('defaultTheme.out_of_stock')); ?></button>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="add_wish_compare d-flex alingn-items-center mb-0">
                                    <a href="#" class="single_wish_compare add_to_wishlist_modal" id="wishlist_btn" data-product_id="<?php echo e($product->id); ?>"
                                        data-seller_id="<?php echo e($product->user_id); ?>">
                                        <i class="far fa-heart"></i> <?php echo e(__('defaultTheme.add_to_wishlist')); ?>

                                    </a>
                                    <a href="#" class="single_wish_compare" id="add_to_compare_btn"
                                    data-product_sku_id="#product_sku_id_modal"
                                    data-product_type="<?php echo e($product->product->product_type); ?>">
                                        <i class="ti-control-shuffle"></i> <?php echo e(__('defaultTheme.add_to_compare')); ?>

                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(@$product->hasDeal): ?>
        <input type="hidden" id="discount_type_modal" value="<?php echo e(@$product->hasDeal->discount_type); ?>">
        <input type="hidden" id="discount_modal" value="<?php echo e(@$product->hasDeal->discount); ?>">
    <?php else: ?>
        <?php if(@$product->hasDiscount == 'yes'): ?>
            <input type="hidden" id="discount_type_modal" value="<?php echo e($product->discount_type); ?>">
            <input type="hidden" id="discount_modal" value="<?php echo e($product->discount); ?>">
        <?php else: ?>
            <input type="hidden" id="discount_type_modal" value="<?php echo e($product->discount_type); ?>">
            <input type="hidden" id="discount_modal" value="0">
        <?php endif; ?>
    <?php endif; ?>

    <!-- for whole sale price -->
    <?php if(isModuleActive('WholeSale')): ?>
        <input type="hidden" id="getWholesalePriceModal" value="<?php if(@$product->skus->first()->wholeSalePrices->count()): ?><?php echo e(json_encode(@$product->skus->first()->wholeSalePrices)); ?> <?php else: ?> 0 <?php endif; ?>">
    <?php endif; ?>

    <input type="hidden" id="isWholeSaleActiveModal" value="<?php echo e(isModuleActive('WholeSale')); ?>">
    <input type="hidden" id="owner_modal" value="<?php echo e(encrypt($product->user_id)); ?>">
</div>
<!-- Modal::end  -->

<script>
    (function($){
        "use strict";

        $(document).ready(function(){
            var productType = $('.product_type').val();
            if (productType == 2) {
                '<?php if(session()->has('item_details')): ?>'+
                    '<?php $__currentLoopData = session()->get('item_details'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>'+
                        '<?php if($item['attr_id'] === 1): ?>'+
                            '<?php $__currentLoopData = $item['value']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $value_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>'+
                                $(".modal_colors_<?php echo e($k); ?>").css("background", "<?php echo e($item['code'][$k]); ?>");
                            '<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>'+
                        '<?php endif; ?>'+
                    '<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>'+
                '<?php endif; ?>'
            }
        });
    })(jQuery);
</script>
<?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/partials/product_add_to_cart_modal.blade.php ENDPATH**/ ?>