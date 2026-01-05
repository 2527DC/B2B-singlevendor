<div class="col-xl-10">
    <div class="compare_title_div">
        <h3 class="fs-4 fw-bold mb_30"><?php echo e(__('defaultTheme.product_compare')); ?></h3>
        <?php if(count($products) > 0): ?>
            <a href="#" class="reset_compare_text reset_compare"><?php echo e(__('defaultTheme.reset_compare')); ?></a>
        <?php endif; ?>
    </div>
    <div class="comparing_box_area mb_30">
        <?php if(count($products) > 0): ?>
        <div class="compare_product_descList">

            <div class="single_product_list product_tricker compare_product">

                <ul class="comparison_lists style2">
                    <li>
                        <?php echo e(__('common.name')); ?>

                    </li>
                    <li>
                        <?php echo e(__('defaultTheme.sku')); ?>

                    </li>
                    <?php if(isModuleActive('MultiVendor')): ?>
                    <li>
                        <?php echo e(__('common.seller')); ?>

                    </li>
                    <?php endif; ?>
                    <?php
                        $data = $products[0];
                        $total_key = 2;
                        $attribute_list = [];
                    ?>
                    <?php if(@$data->product->product->product_type == 2): ?>
                        <?php $__currentLoopData = @$data->product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $combination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $total_key += 1;
                            $attribute_list[] = @$combination->attribute->name;
                        ?>
                            <li><?php echo e(@$combination->attribute->name); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="compare_product_carousel">
            <div class="compare_product_active owl-carousel">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sellerProductSKU): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!-- single item  -->
                    <div class="single_product_list product_tricker compare_product">
                        <div class="product_widget5 style5">
                            <div class="product_thumb_upper">
                                <?php
                                        if(@$sellerProductSKU->product->product->product_type == 1){
                                            if(@$sellerProductSKU->product->thum_img != null){
                                                $thumbnail = showImage(@$sellerProductSKU->product->thum_img);
                                            }else{
                                                $thumbnail = showImage(@$sellerProductSKU->product->product->thumbnail_image_source);
                                            }
                                        }else{
                                            $thumbnail = showImage(@$sellerProductSKU->sku->variant_image?@$sellerProductSKU->sku->variant_image:@$sellerProductSKU->product->product->thumbnail_image_source);
                                        }

                                        $price_qty = getProductDiscountedPrice(@$sellerProductSKU->product);
                                        $showData = [
                                            'name' => @$sellerProductSKU->product->product_name,
                                            'url' => singleProductURL(@$sellerProductSKU->product->seller->slug, @$sellerProductSKU->product->slug),
                                            'price' => $price_qty,
                                            'thumbnail' => $thumbnail
                                        ];
                                    ?>
                                    <a href="<?php echo e(singleProductURL(@$sellerProductSKU->product->seller->slug, @$sellerProductSKU->product->slug)); ?>" class="thumb">
                                        <img src="<?php echo e($thumbnail); ?>" alt="<?php echo e(@$sellerProductSKU->product->product_name); ?>" title="<?php echo e(@$sellerProductSKU->product->product_name); ?>">
                                    </a>
                                    <div class="product_action">
                                        <a href="" class="add_to_wishlist <?php echo e($sellerProductSKU->product->is_wishlist() == 1?'is_wishlist':''); ?>" data-product_id="<?php echo e($sellerProductSKU->product->id); ?>" data-seller_id="<?php echo e($sellerProductSKU->product->user_id); ?>">
                                            <i class="far fa-heart" title="<?php echo e(__('defaultTheme.wishlist')); ?>"></i>
                                        </a>
                                        <a href="" class="remove_from_compare" data-id="<?php echo e($sellerProductSKU->id); ?>">
                                            <i class="ti-trash" title="<?php echo e(__('common.delete')); ?>"></i>
                                        </a>
                                    </div>

                                    <div class="product_badge">
                                        <?php if($sellerProductSKU->product->hasDeal): ?>
                                            <?php if($sellerProductSKU->product->hasDeal->discount >0): ?>
                                                <span class="d-flex align-items-center discount">
                                                    <?php if($sellerProductSKU->product->hasDeal->discount_type ==0): ?>
                                                        <?php echo e(getNumberTranslate($sellerProductSKU->product->hasDeal->discount)); ?> % <?php echo e(__('common.off')); ?>

                                                    <?php else: ?>
                                                        <?php echo e(single_price($sellerProductSKU->product->hasDeal->discount)); ?> <?php echo e(__('common.off')); ?>

                                                    <?php endif; ?>
                                                </span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if($sellerProductSKU->product->hasDiscount == 'yes'): ?>
                                                <?php if($sellerProductSKU->product->discount >0): ?>
                                                    <span class="d-flex align-items-center discount">
                                                        <?php if($sellerProductSKU->product->discount_type ==0): ?>
                                                            <?php echo e(getNumberTranslate($sellerProductSKU->product->discount)); ?> % <?php echo e(__('common.off')); ?>

                                                        <?php else: ?>
                                                            <?php echo e(single_price($sellerProductSKU->product->discount)); ?> <?php echo e(__('common.off')); ?>

                                                        <?php endif; ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(isModuleActive('ClubPoint')): ?>
                                        <span class="d-flex align-items-center point">
                                            <svg width="16" height="14" viewBox="0 0 16 14" fill="none" >
                                                <path d="M15 7.6087V10.087C15 11.1609 12.4191 12.5652 9.23529 12.5652C6.05153 12.5652 3.47059 11.1609 3.47059 10.087V8.02174M3.71271 8.2357C4.42506 9.18404 6.628 10.0737 9.23529 10.0737C12.4191 10.0737 15 8.74704 15 7.60704C15 6.96683 14.1872 6.26548 12.9115 5.77313M12.5294 3.47826V5.95652C12.5294 7.03044 9.94847 8.43478 6.76471 8.43478C3.58094 8.43478 1 7.03044 1 5.95652V3.47826M6.76471 5.9433C9.94847 5.9433 12.5294 4.61661 12.5294 3.47661C12.5294 2.33578 9.94847 1 6.76471 1C3.58094 1 1 2.33578 1 3.47661C1 4.61661 3.58094 5.9433 6.76471 5.9433Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <?php echo e(getNumberTranslate(@$product->product->club_point)); ?>

                                        </span>
                                        <?php endif; ?>
                                        <?php if(isModuleActive('WholeSale') && @$sellerProductSKU->product->skus->first()->wholeSalePrices != ''): ?>
                                            <span class="d-flex align-items-center sale"><?php echo e(__('common.wholesale')); ?></span>
                                        <?php endif; ?>
                                    </div>
                            </div>
                            <div class="product_star mx-auto">
                                <?php
                                $reviews = @$sellerProductSKU->product->reviews->where('status',1)->pluck('rating');
                                if(count($reviews)>0){
                                    $value = 0;
                                    $rating = 0;
                                    foreach($reviews as $review){
                                        $value += $review;
                                    }
                                    $rating = $value/count($reviews);
                                    $total_review = count($reviews);
                                }else{
                                    $rating = 0;
                                    $total_review = 0;
                                }
                            ?>
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
                            <div class="product__meta text-center">
                                <span class="product_banding "><?php echo e($sellerProductSKU->product->brand->name ?? " "); ?></span>
                                <a href="<?php echo e(singleProductURL($sellerProductSKU->product->seller->slug, $sellerProductSKU->product->slug)); ?>">
                                    <h4><?php if($sellerProductSKU->product->product_name): ?> <?php echo e(textLimit($sellerProductSKU->product->product_name, 50)); ?> <?php else: ?> <?php echo e(textLimit($sellerProductSKU->product->product->product_name, 50)); ?> <?php endif; ?></h4>
                                </a>
                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                    <?php
                                    $price = 0;
                                    $shipping_method = 0;

                                    if(@$sellerProductSKU->product->hasDeal){
                                        $price = selling_price(@$sellerProductSKU->sell_price,@$sellerProductSKU->product->hasDeal->discount_type,@$sellerProductSKU->product->hasDeal->discount);
                                    }
                                    else{
                                        if($sellerProductSKU->product->hasDiscount == 'yes'){
                                            $price = selling_price(@$sellerProductSKU->sell_price,@$sellerProductSKU->product->discount_type,@$sellerProductSKU->product->discount);
                                        }else{
                                            $price = @$sellerProductSKU->sell_price;
                                        }
                                    }
                                ?>
                                    <a class="amaz_primary_btn addToCart" data-product_sku_id="<?php echo e($sellerProductSKU->id); ?>" data-seller_id="<?php echo e(@$sellerProductSKU->product->user_id); ?>" data-shipping_method="<?php echo e($shipping_method); ?>" data-price="<?php echo e($price); ?>" data-prod_info="<?php echo e(json_encode($showData)); ?>">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"></path>
                                            </svg>

                                      </a>
                                    <p>
                                        <span>
                                            <?php if(getProductwitoutDiscountPrice($sellerProductSKU->product->product) != single_price(0)): ?>
                                            <del>
                                                <?php echo e(getProductwitoutDiscountPrice($sellerProductSKU->product->product)); ?>

                                            </del>
                                            <?php endif; ?>
                                        </span>
                                        <strong>
                                            <?php echo e(getProductDiscountedPrice($sellerProductSKU->product->product)); ?>

                                        </strong>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <ul class="comparison_lists">
                            <li>
                                <?php echo e(textLimit($sellerProductSKU->product->product_name,35)); ?>

                            </li>
                            <li>
                                <?php echo e(@$sellerProductSKU->sku->sku??'-'); ?>

                            </li>
                            <?php if(isModuleActive('MultiVendor')): ?>
                                <li>
                                    <?php if($sellerProductSKU->product->seller->role->type == 'seller'): ?>
                                        <?php if(@$sellerProductSKU->product->seller->SellerAccount->seller_shop_display_name): ?>
                                            <?php echo e(@$sellerProductSKU->product->seller->SellerAccount->seller_shop_display_name); ?>

                                        <?php else: ?>
                                            <?php echo e($sellerProductSKU->product->seller->first_name .' '.$sellerProductSKU->product->seller->last_name); ?>

                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php echo e(app('general_setting')->company_name); ?>

                                    <?php endif; ?>
                                </li>
                            <?php endif; ?>

                            <?php
                                $key_count = 2;
                            ?>
                            <?php if(@$sellerProductSKU->product->product->product_type == 2): ?>
                                <?php $__currentLoopData = @$sellerProductSKU->product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $combination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $key_count += 1;
                                    ?>
                                    <?php if($attribute_list[$key] == @$combination->attribute->name): ?>
                                        <?php if(@$combination->attribute->id == 1): ?>
                                            <li><?php echo e(@$combination->attribute_value->color->name); ?></li>
                                        <?php else: ?>
                                            <li><?php echo e(@$combination->attribute_value->value); ?></li>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <li>-</li>
                                    <?php endif; ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            <?php if($total_key > $key_count): ?>
                                <?php for($key_count; $key_count < $total_key; $key_count++): ?>
                                    <li>-</li>
                                <?php endfor; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php else: ?>
            <h4 class="test-center compare_empty"><?php echo e(__('defaultTheme.compare_list_is_empty')); ?></h4>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/partials/_compare_list.blade.php ENDPATH**/ ?>