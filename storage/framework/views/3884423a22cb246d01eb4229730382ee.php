<?php
    $total_number_of_item_per_page = $products->perPage();
    $total_number_of_items = $products->total() > 0 ? $products->total() : 0;
    $total_number_of_pages = $total_number_of_items / $total_number_of_item_per_page;
    $reminder = $total_number_of_items % $total_number_of_item_per_page;
    if ($reminder > 0) {
        $total_number_of_pages += 1;
    }
    $current_page = $products->currentPage();
    $previous_page = $products->currentPage() - 1;
    if ($current_page == $products->lastPage()) {
        $show_end = $total_number_of_items;
    } else {
        $show_end = $total_number_of_item_per_page * $current_page;
    }

    $show_start = 0;
    if ($total_number_of_items > 0) {
        $show_start = $total_number_of_item_per_page * $previous_page + 1;
    }
?>
<div class="row ">
    <div class="col-12">
        <div class="box_header d-flex flex-wrap align-items-center justify-content-between">
            <h5 class="font_16 f_w_500 mr_10 mb-0"><?php echo e(__('defaultTheme.showing')); ?> <?php if($show_start == $show_end): ?> <?php echo e(getNumberTranslate($show_end)); ?>

                <?php else: ?>
                    <?php echo e(getNumberTranslate($show_start)); ?> - <?php echo e(getNumberTranslate($show_end)); ?> <?php endif; ?> <?php echo e(__('defaultTheme.out_of_total')); ?> <?php echo e(getNumberTranslate($total_number_of_items)); ?>

                <?php echo e(__('common.products')); ?></h5>
            <div class="box_header_right ">
                <div class="short_select d-flex align-items-center gap_10 flex-wrap">
                    <div class="prduct_showing_style">
                        <ul class="nav align-items-center" id="myTab" role="tablist">
                            <li class="nav-item lh-1">
                                <a class="nav-link view-product active" id="home-tab" data-bs-toggle="tab"
                                    href="#home" role="tab" aria-controls="home" aria-selected="true">
                                    <img src="<?php echo e(showImage('frontend/amazy/img/svg/grid_view.svg')); ?>" alt="Gird View"
                                        title="Gird View">
                                </a>
                            </li>
                            <li class="nav-item lh-1">
                                <a class="nav-link view-product" id="profile-tab" data-bs-toggle="tab" href="#profile"
                                    role="tab" aria-controls="profile" aria-selected="false">
                                    <img src="<?php echo e(showImage('frontend/amazy/img/svg/list_view.svg')); ?>" alt="List View"
                                        title="List View">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="shorting_box d-none d-md-block">
                        <select name="paginate_by" class="amaz_select getFilterUpdateByIndex" id="paginate_by">
                            <option value="9" <?php if(isset($paginate) && $paginate == '9'): ?> selected <?php endif; ?>>
                                <?php echo e(__('common.show')); ?> <?php echo e(getNumberTranslate(9)); ?> <?php echo e(__('common.item’s')); ?></option>
                            <option value="12" <?php if(isset($paginate) && $paginate == '12'): ?> selected <?php endif; ?>>
                                <?php echo e(__('common.show')); ?> <?php echo e(getNumberTranslate(12)); ?> <?php echo e(__('common.item’s')); ?>

                            </option>
                            <option value="16" <?php if(isset($paginate) && $paginate == '16'): ?> selected <?php endif; ?>>
                                <?php echo e(__('common.show')); ?> <?php echo e(getNumberTranslate(16)); ?> <?php echo e(__('common.item’s')); ?>

                            </option>
                            <option value="25" <?php if(isset($paginate) && $paginate == '25'): ?> selected <?php endif; ?>>
                                <?php echo e(__('common.show')); ?> <?php echo e(getNumberTranslate(25)); ?> <?php echo e(__('common.item’s')); ?>

                            </option>
                            <option value="30" <?php if(isset($paginate) && $paginate == '30'): ?> selected <?php endif; ?>>
                                <?php echo e(__('common.show')); ?> <?php echo e(getNumberTranslate(30)); ?> <?php echo e(__('common.item’s')); ?>

                            </option>
                        </select>
                    </div>
                    <div class="shorting_box">
                        <select class="amaz_select getFilterUpdateByIndex" name="sort_by" id="product_short_list">
                            <option disabled selected><?php echo e(__('amazy.Sorting by')); ?></option>
                            <option value="new" <?php if(isset($sort_by) && $sort_by == 'new'): ?> selected <?php endif; ?>>
                                <?php echo e(__('common.new')); ?></option>
                            <option value="old" <?php if(isset($sort_by) && $sort_by == 'old'): ?> selected <?php endif; ?>>
                                <?php echo e(__('common.old')); ?></option>
                            <option value="alpha_asc" <?php if(isset($sort_by) && $sort_by == 'alpha_asc'): ?> selected <?php endif; ?>>
                                <?php echo e(__('defaultTheme.name_a_to_z')); ?></option>
                            <option value="alpha_desc" <?php if(isset($sort_by) && $sort_by == 'alpha_desc'): ?> selected <?php endif; ?>>
                                <?php echo e(__('defaultTheme.name_z_to_a')); ?></option>
                            <option value="low_to_high" <?php if(isset($sort_by) && $sort_by == 'low_to_high'): ?> selected <?php endif; ?>>
                                <?php echo e(__('defaultTheme.price_low_to_high')); ?></option>
                            <option value="high_to_low" <?php if(isset($sort_by) && $sort_by == 'high_to_low'): ?> selected <?php endif; ?>>
                                <?php echo e(__('defaultTheme.price_high_to_low')); ?></option>
                        </select>
                    </div>
                    <div class="flex-fill text-end">
                        <div class="category_toggler d-inline-block d-lg-none  gj-cursor-pointer">
                            <svg  width="19.5" height="13" viewBox="0 0 19.5 13">
                                <g id="filter-icon" transform="translate(28)">
                                    <rect id="Rectangle_1" data-name="Rectangle 1" width="19.5" height="2"
                                        rx="1" transform="translate(-28)" fill="#fd4949" />
                                    <rect id="Rectangle_2" data-name="Rectangle 2" width="15.5" height="2"
                                        rx="1" transform="translate(-26 5.5)" fill="#fd4949" />
                                    <rect id="Rectangle_3" data-name="Rectangle 3" width="5" height="2"
                                        rx="1" transform="translate(-20.75 11)" fill="#fd4949" />
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tab-content mb_30" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <!-- content  -->
        <div class="row custom_rowProduct">
            <?php if(count($products) > 0): ?>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(get_class($product) == \Modules\Seller\Entities\SellerProduct::class): ?>
                        <input type="hidden" name="base_sku_price" id="base_sku_price"
                            value="
                        <?php if(@$product->hasDeal): ?> <?php echo e(selling_price(@$product->skus->first()->sell_price, @$product->hasDeal->discount_type, @$product->hasDeal->discount)); ?>

                        <?php else: ?>
                            <?php if(@$product->hasDiscount == 'yes'): ?>
                            <?php echo e(selling_price(@$product->skus->first()->sell_price, @$product->discount_type, @$product->discount)); ?>

                            <?php else: ?>
                            <?php echo e(@$product->skus->first()->sell_price); ?> <?php endif; ?>
                        <?php endif; ?>
                    ">
                    <div class="col-xl-4 col-md-6 col-sm-6 col-6 d-flex">
                        <div class="product_widget5 mb_30 style5 w-100">
                            <div class="product_thumb_upper">
                                <?php
                                    if (@$product->thum_img != null) {
                                        $thumbnail = showImage(@$product->thum_img);
                                    } else {
                                        $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                    }
                                    $price_qty = getProductDiscountedPrice(@$product);
                                    $showData = [
                                        'name' => @$product->product_name,
                                        'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                        'price' => $price_qty,
                                        'thumbnail' => $thumbnail,
                                    ];
                                ?>
                                <a href="<?php echo e(singleProductURL($product->seller->slug, $product->slug)); ?>"
                                    class="thumb">
                                    <img data-src="<?php echo e($thumbnail); ?>" src="<?php echo e(showImage(themeDefaultImg())); ?>"
                                        alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>"
                                        class="lazyload">
                                </a>
                                <?php if(isGuestAddtoCart()): ?>
                                <div class="product_action">
                                    <a href="" class="addToCompareFromThumnail"
                                        data-producttype="<?php echo e(@$product->product->product_type); ?>"
                                        data-seller=<?php echo e($product->user_id); ?>

                                        data-product-sku=<?php echo e(@$product->skus->first()->id); ?>

                                        data-product-id=<?php echo e($product->id); ?>>
                                        <i class="ti-control-shuffle"
                                            title="<?php echo e(__('defaultTheme.compare')); ?>"></i>
                                    </a>
                                    <a href=""
                                        class="add_to_wishlist <?php echo e($product->is_wishlist() == 1 ? 'is_wishlist' : ''); ?>"
                                        id="wishlistbtn_<?php echo e($product->id); ?>"
                                        data-product_id="<?php echo e($product->id); ?>"
                                        data-seller_id="<?php echo e($product->user_id); ?>">
                                        <i class="far fa-heart" title="<?php echo e(__('defaultTheme.wishlist')); ?>"></i>
                                    </a>
                                    <a class="quickView" data-product_id="<?php echo e($product->id); ?>"
                                        data-type="product">
                                        <i class="ti-eye" title="<?php echo e(__('defaultTheme.quick_view')); ?>"></i>
                                    </a>
                                </div>
                                <?php endif; ?>
                                <div class="product_badge">
                                    <?php if(isGuestAddtoCart()): ?>
                                        <?php if($product->hasDeal): ?>
                                            <?php if($product->hasDeal->discount >0): ?>
                                                <span class="d-flex align-items-center discount">
                                                    <?php if($product->hasDeal->discount_type ==0): ?>
                                                        <?php echo e(getNumberTranslate($product->hasDeal->discount)); ?> % <?php echo e(__('common.off')); ?>

                                                    <?php else: ?>
                                                        <?php echo e(single_price($product->hasDeal->discount)); ?> <?php echo e(__('common.off')); ?>

                                                    <?php endif; ?>
                                                </span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if($product->hasDiscount == 'yes'): ?>
                                                <?php if($product->discount >0): ?>
                                                    <span class="d-flex align-items-center discount">
                                                        <?php if($product->discount_type ==0): ?>
                                                            <?php echo e(getNumberTranslate($product->discount)); ?> % <?php echo e(__('common.off')); ?>

                                                        <?php else: ?>
                                                            <?php echo e(single_price($product->discount)); ?> <?php echo e(__('common.off')); ?>

                                                        <?php endif; ?>
                                                    </span>
                                                <?php endif; ?>
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
                                    <?php if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices != ''): ?>
                                        <span class="d-flex align-items-center sale"><?php echo e(__('common.wholesale')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="product_star mx-auto">
                                <?php
                                    $reviews = @$product->reviews->where('status', 1)->pluck('rating');

                                    if (count($reviews) > 0) {
                                        $value = 0;
                                        $rating = 0;
                                        foreach ($reviews as $review) {
                                            $value += $review;
                                        }
                                        $rating = $value / count($reviews);
                                        $total_review = count($reviews);
                                    } else {
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
                                <span class="product_banding "><?php echo e(@$product->brand->name ?? " "); ?></span>
                                <a href="<?php echo e(singleProductURL(@$product->seller->slug, $product->slug)); ?>">
                                    <h4><?php if($product->product_name): ?> <?php echo e(textLimit(@$product->product_name, 50)); ?> <?php else: ?> <?php echo e(textLimit(@$product->product->product_name, 50)); ?> <?php endif; ?></h4>
                                </a>
                                <?php if(isGuestAddtoCart()): ?>
                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                    <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="<?php echo e(@$product->product->product_type); ?>" data-seller=<?php echo e($product->user_id); ?> data-product-sku=<?php echo e(@$product->skus->first()->id); ?>

                                        <?php if(@$product->hasDeal): ?>
                                            data-base-price=<?php echo e(selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount)); ?>

                                        <?php else: ?>
                                            <?php if(@$product->hasDiscount == 'yes'): ?>
                                                data-base-price=<?php echo e(selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount)); ?>

                                            <?php else: ?>
                                                data-base-price=<?php echo e(@$product->skus->first()->sell_price); ?>

                                            <?php endif; ?>
                                        <?php endif; ?>
                                        data-shipping-method=0
                                        data-product-id=<?php echo e($product->id); ?>

                                        data-stock_manage="<?php echo e($product->stock_manage); ?>"
                                        data-stock="<?php echo e(@$product->skus->first()->product_stock); ?>"
                                        data-min_qty="<?php echo e(@$product->product->minimum_order_qty); ?>"
                                        data-prod_info="<?php echo e(json_encode($showData)); ?>"
                                        >
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                            <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                        </svg>
                                        <?php echo e(__('defaultTheme.add_to_cart')); ?>

                                    </a>
                                    <p>
                                        <?php if(getProductwitoutDiscountPrice(@$product) != single_price(0)): ?>
                                            <del>
                                                <?php echo e(getProductwitoutDiscountPrice(@$product)); ?>

                                            </del>
                                        <?php endif; ?>
                                        <strong>
                                            <?php echo e(getProductDiscountedPrice(@$product)); ?>

                                        </strong>
                                    </p>
                                </div>
                                <?php else: ?>
                                <div class="product_price d-flex align-items-center justify-content-between">
                                    <a class="amaz_primary_btn w-100 " style="text-indent: 0;" href="<?php echo e(url('/login')); ?>">
                                        <?php echo e(__("defaultTheme.login_to_order")); ?>

                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                        <div class="col-xl-4 col-md-6 col-sm-6 d-flex">
                            <div class="product_widget5 mb_30 style5 w-100">
                                <div class="product_thumb_upper">
                                    <?php
                                    $thumbnail = showImage($product->thumbnail_image);
                                    $price_qty = getGiftcardwithDiscountPrice(@$product);
                                    $cart_price = 0;
                                    if($product->type == 'gift_card'){
                                        $url = route('frontend.gift-card.show.multiple', $product->slug);
                                        $base_price = getGiftcardwithDiscountPrice($product);
                                        $cardList = \Modules\GiftCard\Entities\AddGiftCard::where('digilat_gift_id',$product->id)->orderBy('gift_selling_price','ASC')->first();
                                        if($cardList)
                                        {
                                            $cart_price = selling_price(@$cardList->gift_selling_price, @$cardList->gift_discount_type, @$cardList->gift_discount_amount);
                                        }else{
                                            $cart_price = $cardList->gift_selling_price;
                                        }
                                    }else{
                                        $url = route('frontend.gift-card.show', $product->slug);
                                        $base_price = single_price($product->selling_price);
                                        $cart_price = $product->selling_price;
                                    }
                                    $showData = [
                                        'name' => @$product->product_name,
                                        'url' => $url,
                                        'price' => $price_qty,
                                        'thumbnail' => $thumbnail,
                                    ];

                                ?>
                                    <a href="<?php echo e($url); ?>" class="thumb">
                                        <img src="<?php echo e($thumbnail); ?>" alt="<?php echo e(@$product->product_name); ?>"
                                            title="<?php echo e(@$product->product_name); ?>" class="lazyload">
                                    </a>
                                    <?php if(isGuestAddtoCart()): ?>
                                    <div class="product_action">
                                        <a href="" class="add_to_wishlist_from_search <?php echo e(@$product->IsWishlist == 1?'is_wishlist':''); ?>" id="wishlistbtn_<?php echo e($product->id); ?>" data-product_id="<?php echo e($product->id); ?>" data-type="gift_card" data-seller_id="1"> <i class="ti-heart"></i> </a>
                                        <a class="add_to_cart_gift_thumnail" data-gift-card-id="<?php echo e($product->id); ?>" data-seller="1"
                                            data-base-price="<?php echo e($cart_price); ?>"
                                            data-prod_info = "<?php echo e(json_encode($showData)); ?>"
                                            href="javascript:void(0)"
                                            > <i class="ti-bag"></i> </a>
                                    </div>
                                    <?php endif; ?>
                                    <div class="product_badge">
                                    <?php if(isGuestAddtoCart()): ?>
                                        <?php if($product->hasDiscount()): ?>
                                            <?php if($product->discount > 0): ?>
                                                <span class="badge_1">
                                                    <?php if(@$product->discount_type ==0): ?>
                                                        -<?php echo e(getNumberTranslate(@$product->discount)); ?>%
                                                    <?php else: ?>
                                                        -<?php echo e(single_price(@$product->discount)); ?>

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
                                    </div>
                                </div>
                                <div class="product_star mx-auto">
                                    <?php
                                        $reviews = @$product->reviews->where('status', 1)->pluck('rating');

                                        if (count($reviews) > 0) {
                                            $value = 0;
                                            $rating = 0;
                                            foreach ($reviews as $review) {
                                                $value += $review;
                                            }
                                            $rating = $value / count($reviews);
                                            $total_review = count($reviews);
                                        } else {
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
                                    <span class="product_banding "><?php echo e(@$product->brand->name ?? " "); ?></span>
                                    <a href="<?php echo e(route('frontend.gift-card.show.multiple', $product->slug)); ?>">
                                        <h4>
                                            <?php echo e(textLimit($product->product_name, 28)); ?>

                                        </h4>
                                    </a>
                                    <?php if(isGuestAddtoCart()): ?>
                                    <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                        <a class="amaz_primary_btn add_cart add_to_cart add_to_cart_gift_thumnail" data-gift-card-id="<?php echo e($product->id); ?>"
                                            data-seller="1" data-base-price="<?php echo e($cart_price); ?>"
                                            data-prod_info= "<?php echo e(json_encode($showData)); ?>"
                                            href="javascript:void(0)"
                                            >
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                            </svg>
                                            <?php echo e(__('defaultTheme.add_to_cart')); ?></a>
                                        <p>
                                            <span>
                                                <?php if(getGiftcardwithoutDiscountPrice(@$product) != single_price(0)): ?>
                                                    <?php echo e(getGiftcardwithoutDiscountPrice(@$product)); ?>

                                                <?php endif; ?>
                                            </span>
                                           <?php echo e(getGiftcardwithDiscountPrice($product)); ?>

                                        </p>
                                    </div>
                                    <?php else: ?>
                                    <div class="product_price d-flex align-items-center justify-content-between">
                                        <a class="amaz_primary_btn w-100 " style="text-indent: 0;" href="<?php echo e(url('/login')); ?>">
                                            <?php echo e(__("defaultTheme.login_to_order")); ?>

                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="text-center alert alert-danger">
                        <?php echo e(__('defaultTheme.no_product_found')); ?>

                    </div>
                </div>
            <?php endif; ?>
        </div>
        <!--/ content  -->
    </div>
    <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <!-- content  -->
        <div class="row">
            <?php if(count($products) > 0): ?>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(get_class($product) == \Modules\Seller\Entities\SellerProduct::class): ?>
                        <div class="col-xl-12">
                            <div class="product_widget5 mb_30 list_style_product">
                                <div class="product_thumb_upper m-0">
                                    <?php
                                        if (@$product->thum_img != null) {
                                            $thumbnail = showImage(@$product->thum_img);
                                        } else {
                                            $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                        }
                                        $price_qty = getProductDiscountedPrice(@$product->product);
                                        $showData = [
                                            'name' => @$product->product->product_name,
                                            'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                            'price' => $price_qty,
                                            'thumbnail' => $thumbnail,
                                        ];
                                    ?>
                                    <a href="<?php echo e(singleProductURL(@$product->seller->slug, $product->slug)); ?>"
                                        class="thumb">
                                        <img src="<?php echo e($thumbnail); ?>"
                                            alt="<?php echo e(@$product->product_name ? @$product->product_name : @$product->product->product_name); ?>"
                                            title="<?php echo e(@$product->product_name ? @$product->product_name : @$product->product->product_name); ?>">
                                    </a>
                                    <?php if(isGuestAddtoCart() == true): ?>
                                    <div class="product_action">
                                        <a href="" class="addToCompareFromThumnail"
                                            data-producttype="<?php echo e(@$product->product->product_type); ?>"
                                            data-seller=<?php echo e($product->user_id); ?>

                                            data-product-sku=<?php echo e(@$product->skus->first()->id); ?>

                                            data-product-id=<?php echo e($product->id); ?>>
                                            <i class="ti-control-shuffle" title="<?php echo e(__('defaultTheme.compare')); ?>"></i>
                                        </a>
                                        <a href=""
                                            class="add_to_wishlist <?php echo e($product->is_wishlist() == 1 ? 'is_wishlist' : ''); ?>"
                                            id="wishlistbtn_<?php echo e($product->id); ?>" data-product_id="<?php echo e($product->id); ?>"
                                            data-seller_id="<?php echo e($product->user_id); ?>">
                                            <i class="far fa-heart" title="<?php echo e(__('defaultTheme.wishlist')); ?>"></i>
                                        </a>
                                        <a class="quickView" data-product_id="<?php echo e($product->id); ?>" data-type="product">
                                            <i class="ti-eye" title="<?php echo e(__('defaultTheme.quick_view')); ?>"></i>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                    <div class="product_badge">
                                        <?php if(isGuestAddtoCart() == true): ?>
                                            <?php if($product->hasDeal): ?>
                                                <?php if($product->hasDeal->discount >0): ?>
                                                    <span class="d-flex align-items-center discount">
                                                        <?php if($product->hasDeal->discount_type ==0): ?>
                                                            <?php echo e(getNumberTranslate($product->hasDeal->discount)); ?> % <?php echo e(__('common.off')); ?>

                                                        <?php else: ?>
                                                            <?php echo e(single_price($product->hasDeal->discount)); ?> <?php echo e(__('common.off')); ?>

                                                        <?php endif; ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if($product->hasDiscount == 'yes'): ?>
                                                    <?php if($product->discount >0): ?>
                                                        <span class="d-flex align-items-center discount">
                                                            <?php if($product->discount_type ==0): ?>
                                                                <?php echo e(getNumberTranslate($product->discount)); ?> % <?php echo e(__('common.off')); ?>

                                                            <?php else: ?>
                                                                <?php echo e(single_price($product->discount)); ?> <?php echo e(__('common.off')); ?>

                                                            <?php endif; ?>
                                                        </span>
                                                    <?php endif; ?>
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
                                        <?php if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices != ''): ?>
                                            <span class="d-flex align-items-center sale"><?php echo e(__('common.wholesale')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="product__meta text-start">
                                    <span class="product_banding "><?php echo e(@$product->brand->name ?? " "); ?></span>
                                    <div class="product_star mt-0 mb-3">
                                        <?php
                                            $reviews = @$product->reviews->where('status', 1)->pluck('rating');

                                            if (count($reviews) > 0) {
                                                $value = 0;
                                                $rating = 0;
                                                foreach ($reviews as $review) {
                                                    $value += $review;
                                                }
                                                $rating = $value / count($reviews);
                                                $total_review = count($reviews);
                                            } else {
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
                                    <a href="<?php echo e(singleProductURL(@$product->seller->slug, $product->slug)); ?>">
                                        <h4><?php if($product->product_name): ?> <?php echo e(textLimit(@$product->product_name, 50)); ?> <?php else: ?> <?php echo e(textLimit(@$product->product->product_name, 50)); ?> <?php endif; ?></h4>
                                    </a>

                                    <?php if(isGuestAddtoCart() == true): ?>
                                    <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                        <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="<?php echo e(@$product->product->product_type); ?>" data-seller=<?php echo e($product->user_id); ?> data-product-sku=<?php echo e(@$product->skus->first()->id); ?>

                                            <?php if(@$product->hasDeal): ?>
                                                data-base-price=<?php echo e(selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount)); ?>

                                            <?php else: ?>
                                                <?php if(@$product->hasDiscount == 'yes'): ?>
                                                    data-base-price=<?php echo e(selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount)); ?>

                                                <?php else: ?>
                                                    data-base-price=<?php echo e(@$product->skus->first()->sell_price); ?>

                                                <?php endif; ?>
                                            <?php endif; ?>
                                            data-shipping-method=0
                                            data-product-id=<?php echo e($product->id); ?>

                                            data-stock_manage="<?php echo e($product->stock_manage); ?>"
                                            data-stock="<?php echo e(@$product->skus->first()->product_stock); ?>"
                                            data-min_qty="<?php echo e(@$product->product->minimum_order_qty); ?>"
                                            data-prod_info="<?php echo e(json_encode($showData)); ?>"
                                            >
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                            </svg>
                                            <?php echo e(__('defaultTheme.add_to_cart')); ?>

                                        </a>
                                        <p class="d-flex flex-wrap gap-2 align-items-center">
                                            <?php if(getProductwitoutDiscountPrice(@$product) != single_price(0)): ?>
                                                <del>
                                                    <?php echo e(getProductwitoutDiscountPrice(@$product)); ?>

                                                </del>
                                            <?php endif; ?>
                                            <strong>
                                                <?php echo e(getProductDiscountedPrice(@$product)); ?>

                                            </strong>
                                        </p>
                                    </div>
                                    <?php else: ?>
                                    <div class="product_price d-flex align-items-center justify-content-between">
                                        <a class="amaz_primary_btn w-100 " style="text-indent: 0;" href="<?php echo e(url('/login')); ?>">
                                            <?php echo e(__("defaultTheme.login_to_order")); ?>

                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                    <div class="col-xl-12">
                        <div class="product_widget5 mb_30 list_style_product">
                            <div class="product_thumb_upper m-0">
                                <?php
                                    $thumbnail = showImage($product->thumbnail_image);
                                    $price_qty = getGiftcardwithDiscountPrice(@$product);
                                    $showData = [];
                                    $showData = [
                                        'name' => @$product->product_name,
                                        'url' => route('frontend.gift-card.show',$product->slug),
                                        'price' => $price_qty,
                                        'thumbnail' => $thumbnail
                                    ];
                                ?>
                                <a href="<?php echo e(route('frontend.gift-card.show',$product->slug)); ?>" class="thumb">
                                    <img src="<?php echo e($thumbnail); ?>" alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>">
                                </a>
                                <?php if(isGuestAddtoCart() == true): ?>
                                <div class="product_action">
                                    <a href="" class="add_to_wishlist_from_search <?php echo e(@$product->IsWishlist == 1?'is_wishlist':''); ?>" id="wishlistbtn_<?php echo e($product->id); ?>" data-product_id="<?php echo e($product->id); ?>" data-type="gift_card" data-seller_id="1"> <i class="ti-heart"></i> </a>
                                    <a class="add_to_cart_gift_thumnail" data-gift-card-id="<?php echo e($product->id); ?>" data-seller="1"
                                        data-base-price="<?php if($product->hasDiscount()): ?> <?php echo e(selling_price($product->sell_price, $product->discount_type, $product->discount)); ?> <?php else: ?> <?php echo e($product->sell_price); ?> <?php endif; ?>"
                                        data-prod_info = "<?php echo e(json_encode($showData)); ?>"
                                        href="javascript:void(0)"
                                        > <i class="ti-bag"></i> </a>
                                </div>
                                <?php endif; ?>
                                <div class="product_badge">
                                    <?php if(isGuestAddtoCart() == true): ?>
                                        <?php if($product->hasDiscount()): ?>
                                                <?php if($product->discount > 0): ?>
                                                    <span class="badge_1">
                                                        <?php if(@$product->discount_type ==0): ?>
                                                            -<?php echo e(getNumberTranslate(@$product->discount)); ?>%
                                                        <?php else: ?>
                                                            -<?php echo e(single_price(@$product->discount)); ?>

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
                                </div>
                            </div>
                            <div class="product__meta text-start">
                                <span class="product_banding "><?php echo e(@$product->brand->name ?? " "); ?></span>
                                <div class="product_star mt-0 mb-3">
                                    <?php
                                        $reviews = @$product->reviews->where('status', 1)->pluck('rating');

                                        if (count($reviews) > 0) {
                                            $value = 0;
                                            $rating = 0;
                                            foreach ($reviews as $review) {
                                                $value += $review;
                                            }
                                            $rating = $value / count($reviews);
                                            $total_review = count($reviews);
                                        } else {
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
                                <a href="<?php echo e(singleProductURL(@$product->seller->slug, $product->slug)); ?>">
                                    <h4><?php if($product->product_name): ?> <?php echo e(textLimit(@$product->product_name, 50)); ?> <?php else: ?> <?php echo e(textLimit(@$product->product->product_name, 50)); ?> <?php endif; ?></h4>
                                </a>

                                <?php if(isGuestAddtoCart() == true): ?>
                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                    <a class="amaz_primary_btn add_cart add_to_cart add_to_cart_gift_thumnail" data-gift-card-id="<?php echo e($product->id); ?>"
                                        data-seller="1" data-base-price="<?php if($product->hasDiscount()): ?> <?php echo e(selling_price($product->sell_price, $product->discount_type, $product->discount)); ?> <?php else: ?> <?php echo e($product->sell_price); ?> <?php endif; ?>"
                                        data-prod_info= "<?php echo e(json_encode($showData)); ?>"
                                        href="javascript:void(0)">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                            <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                        </svg>
                                        <?php echo e(__('defaultTheme.add_to_cart')); ?>

                                    </a>
                                    <p class="d-flex flex-wrap gap-2 align-items-center">
                                        <?php if(getGiftcardwithoutDiscountPrice(@$product) != single_price(0)): ?>
                                            <del>
                                                <?php echo e(getGiftcardwithoutDiscountPrice(@$product)); ?>

                                            </del>
                                        <?php endif; ?>
                                        <strong>
                                            <?php echo e(getGiftcardwithDiscountPrice($product)); ?>

                                        </strong>
                                    </p>
                                </div>
                                <?php else: ?>
                                    <div class="product_price d-flex align-items-center justify-content-between">
                                        <a class="amaz_primary_btn w-100 " style="text-indent: 0;" href="<?php echo e(url('/login')); ?>">
                                            <?php echo e(__("defaultTheme.login_to_order")); ?>

                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="text-center alert alert-danger">
                        <?php echo e(__('defaultTheme.no_product_found')); ?>

                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <input type="hidden" name="filterCatCol" class="filterCatCol" value="0">
    <!--/ content  -->
    <?php if($products->lastPage() > 1): ?>
        <?php if (isset($component)) { $__componentOriginal44b74027c2291d639abf8a70f559de1b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal44b74027c2291d639abf8a70f559de1b = $attributes; } ?>
<?php $component = App\View\Components\PaginationComponent::resolve(['items' => $products,'type' => ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('pagination-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\PaginationComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal44b74027c2291d639abf8a70f559de1b)): ?>
<?php $attributes = $__attributesOriginal44b74027c2291d639abf8a70f559de1b; ?>
<?php unset($__attributesOriginal44b74027c2291d639abf8a70f559de1b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal44b74027c2291d639abf8a70f559de1b)): ?>
<?php $component = $__componentOriginal44b74027c2291d639abf8a70f559de1b; ?>
<?php unset($__componentOriginal44b74027c2291d639abf8a70f559de1b); ?>
<?php endif; ?>
    <?php endif; ?>
</div>
<?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/partials/listing_paginate_data.blade.php ENDPATH**/ ?>