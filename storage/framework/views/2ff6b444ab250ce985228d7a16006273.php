<?php $__env->startPush('styles'); ?>
<style>
    .banner_img {
    width: 100%;
    position: relative;
    overflow: hidden;
    display: block;
    padding-bottom: 31.5%;
}

.banner_img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!-- home_banner::start  -->
    <?php
        $headers = \Modules\Appearance\Entities\Header::all();
    ?>
    <?php if (isset($component)) { $__componentOriginale117b68bd6bcffc67a43b51f9ba0c170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale117b68bd6bcffc67a43b51f9ba0c170 = $attributes; } ?>
<?php $component = App\View\Components\SliderComponent::resolve(['headers' => $headers] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('slider-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\SliderComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale117b68bd6bcffc67a43b51f9ba0c170)): ?>
<?php $attributes = $__attributesOriginale117b68bd6bcffc67a43b51f9ba0c170; ?>
<?php unset($__attributesOriginale117b68bd6bcffc67a43b51f9ba0c170); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale117b68bd6bcffc67a43b51f9ba0c170)): ?>
<?php $component = $__componentOriginale117b68bd6bcffc67a43b51f9ba0c170; ?>
<?php unset($__componentOriginale117b68bd6bcffc67a43b51f9ba0c170); ?>
<?php endif; ?>
<!-- home_banner::end  -->
<?php
    $best_deal = $widgets->where('section_name','best_deals')->first();
?>
<div id="best_deals" class="amaz_section section_spacing <?php echo e($best_deal->status == 0?'d-none':''); ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section__title d-flex align-items-center gap-3 mb_30 flex-wrap">
                    <h3 id="best_deals_title" class="m-0 flex-fill"><?php echo e($best_deal->title); ?></h3>
                    <a href="<?php echo e(route('frontend.category-product',['slug' =>  ($best_deal->section_name), 'item' =>'product'])); ?>" class="title_link d-flex align-items-center lh-1">
                        <span class="title_text"><?php echo e(__('common.view_all')); ?></span>
                        <span class="title_icon">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <input type="hidden" class="productQtyCount" value="<?php echo e($best_deal->getProductByQuery()->count()); ?>">
                <div class="trending_product_active owl-carousel">
                    <?php $__currentLoopData = $best_deal->getProductByQuery(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="product_widget5 mb_30 style5">
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
                                    <?php if(app('general_setting')->lazyload == 1): ?>
                                        <img data-src="<?php echo e($thumbnail); ?>" src="<?php echo e(showImage(themeDefaultImg())); ?>"
                                        alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>"
                                        class="lazyload">
                                    <?php else: ?>
                                        <img  src="<?php echo e($thumbnail); ?>"  alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>" >
                                    <?php endif; ?>
                                </a>
                                <?php if(isGuestAddtoCart() == true): ?>
                                <div class="product_action">
                                    <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                        data-producttype="<?php echo e(@$product->product->product_type); ?>"
                                        data-seller=<?php echo e($product->user_id); ?>

                                        data-product-sku=<?php echo e(@$product->skus->first()->id); ?>

                                        data-product-id=<?php echo e($product->id); ?>>
                                        <i class="ti-control-shuffle"
                                            title="<?php echo e(__('defaultTheme.compare')); ?>"></i>
                                    </a>
                                    <a href="javascript:void(0)"
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
                                    <?php if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count()): ?>
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
                                    <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                        <a class="amaz_primary_btn w-100" href="<?php echo e(url('/login')); ?>" style="text-indent: 0;">
                                            <?php echo e(__('defaultTheme.login_to_order')); ?>

                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- amaz_section::start  -->
<?php
    $feature_categories = $widgets->where('section_name','feature_categories')->first();
?>
<div id="feature_categories" class="amaz_section <?php echo e($feature_categories->status == 0?'d-none':''); ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section__title d-flex align-items-center gap-3 mb_30 flex-wrap ">
                    <h3 id="feature_categories_title" class="m-0 flex-fill"><?php echo e($feature_categories->title); ?></h3>
                    <a href="<?php echo e(url('/category')); ?>" class="title_link d-flex align-items-center lh-1">
                        <span class="title_text"><?php echo e(__('common.view_all')); ?></span>
                        <span class="title_icon">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $feature_categories->getCategoryByQuery(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xxl-3 col-lg-4 col-md-6">
                    <div class="amaz_home_cartBox amaz_cat_bg1 d-flex justify-content-between mb_30">
                        <div class="img_box">
                            <?php if(app('general_setting')->lazyload == 1): ?>
                             <img class="lazyload" src="<?php echo e(showImage(themeDefaultImg())); ?>" data-src="<?php echo e(showImage(@$category->categoryImage->image?@$category->categoryImage->image:'frontend/default/img/default_category.png')); ?>" alt="<?php echo e(@$category->name); ?>" title="<?php echo e(@$category->name); ?>">
                            <?php else: ?>
                            <img src="<?php echo e(showImage(@$category->categoryImage->image?@$category->categoryImage->image:'frontend/default/img/default_category.png')); ?>" alt="<?php echo e(@$category->name); ?>" title="<?php echo e(@$category->name); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="amazcat_text_box">
                            <h4>
                                <a><?php echo e(textLimit($category->name,25)); ?></a>
                            </h4>
                            <p class="lh-1"><?php echo e(getNumberTranslate($category->sellerProducts->count())); ?> <?php echo e(__('common.products')); ?></p>
                            <a class="shop_now_text" href="<?php echo e(route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])); ?>"><?php echo e(__('common.shop_now')); ?> »</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<!-- amaz_section::end  -->
<!-- new  -->
<!-- new  -->
<!-- amaz_section::start  -->
<?php
    $filter_category_1 = $widgets->where('section_name','filter_category_1')->first();
    $category = @$filter_category_1->customSection->category;
?>

<div id="filter_category_1" class="amaz_section section_spacing2 <?php echo e(@$filter_category_1->status == 0?'d-none':''); ?>">
    <div class="container ">
        <?php if($category): ?>

             <div class="row no-gutters">
                <div class="col-xl-5 p-0 col-lg-12">
                    <div class="House_Appliances_widget">
                        <div class="House_Appliances_widget_left d-flex flex-column flex-fill">
                            <h4 id="filter_category_title"><?php echo e($filter_category_1->title); ?></h4>
                            <ul class="nav nav-tabs flex-fill flex-column border-0" id="myTab10" role="tablist">
                                <?php $__currentLoopData = @$category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link <?php echo e($key == 0?'active':''); ?>" id="tab_link_<?php echo e($subcat->id); ?>" data-bs-toggle="tab" data-bs-target="#house_appliance_tab_pane_subcat_<?php echo e($subcat->id); ?>" type="button" role="tab" aria-controls="Dining" aria-selected="true"><?php echo e($subcat->name); ?></button>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <a href="<?php echo e(route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])); ?>" class="title_link d-flex align-items-center lh-1">
                                <span class="title_text"><?php echo e(__('common.more_deals')); ?></span>
                                <span class="title_icon">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            </a>
                        </div>
                        <a href="<?php echo e(route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])); ?>" class="House_Appliances_widget_right overflow-hidden p-0 <?php echo e($filter_category_1->customSection->field_2?'':'d-none'); ?>">
                            <img class="h-100 lazyload" data-src="<?php echo e(showImage($filter_category_1->customSection->field_2)); ?>" src="<?php echo e(showImage(themeDefaultImg())); ?>" alt="<?php echo e(@$filter_category_1->title); ?>" title="<?php echo e(@$filter_category_1->title); ?>">
                        </a>
                    </div>
                </div>

                <div class="col-xl-7 p-0 col-lg-12">
                    <div class="tab-content" id="myTabContent10">
                        <?php if($category->subCategories->count()): ?>
                            <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tab-pane fade <?php echo e($key == 0?'show active':''); ?>" id="house_appliance_tab_pane_subcat_<?php echo e($subcat->id); ?>" role="tabpanel" aria-labelledby="Dining-tab">
                                    <!-- content  -->
                                    <div class="House_Appliances_product">
                                        <?php $__currentLoopData = $subcat->sellerProductTake(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="product_widget5 style4 mb-0 style5">
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
                                                    <?php if(app('general_setting')->lazyload == 1): ?>
                                                       <img data-src="<?php echo e($thumbnail); ?>" src="<?php echo e(showImage(themeDefaultImg())); ?>"
                                                        alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>"
                                                        class="lazyload">
                                                    <?php else: ?>
                                                       <img src="<?php echo e($thumbnail); ?>" alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>"   >
                                                    <?php endif; ?>
                                                </a>
                                                <?php if(isGuestAddtoCart()): ?>
                                                    <div class="product_action">
                                                        <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                            data-producttype="<?php echo e(@$product->product->product_type); ?>"
                                                            data-seller=<?php echo e($product->user_id); ?>

                                                            data-product-sku=<?php echo e(@$product->skus->first()->id); ?>

                                                            data-product-id=<?php echo e($product->id); ?>>
                                                            <i class="ti-control-shuffle"
                                                                title="<?php echo e(__('defaultTheme.compare')); ?>"></i>
                                                        </a>
                                                        <a href="javascript:void(0)"
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
                                                    <?php if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count()): ?>
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
                                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                    <a href="<?php echo e(url('/login')); ?>" class="amaz_primary_btn w-100" style="text-indent: 0;">

                                                        <?php echo e(__('defaultTheme.login_to_order')); ?>

                                                    </a>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <!-- content  -->
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="tab-pane fade show active" id="house_appliance_tab_pane_subcat_1" role="tabpanel" aria-labelledby="Dining-tab">
                                <!-- content  -->
                                <div class="House_Appliances_product">
                                    <?php $__currentLoopData = $category->sellerProductTake(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="product_widget5 style4 mb-0 style5">
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
                                                <?php if(app('general_setting')->lazyload == 1): ?>
                                                <img data-src="<?php echo e($thumbnail); ?>" src="<?php echo e(showImage(themeDefaultImg())); ?>"
                                                    alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>"
                                                    class="lazyload">

                                                <?php else: ?>
                                                <img  src="<?php echo e($thumbnail); ?>" alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>">
                                                <?php endif; ?>
                                            </a>
                                            <?php if(isGuestAddtoCart()): ?>
                                            <div class="product_action">
                                                <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                    data-producttype="<?php echo e(@$product->product->product_type); ?>"
                                                    data-seller=<?php echo e($product->user_id); ?>

                                                    data-product-sku=<?php echo e(@$product->skus->first()->id); ?>

                                                    data-product-id=<?php echo e($product->id); ?>>
                                                    <i class="ti-control-shuffle"
                                                        title="<?php echo e(__('defaultTheme.compare')); ?>"></i>
                                                </a>
                                                <a href="javascript:void(0)"
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
                                                <?php if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count()): ?>
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
                                            <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                <a href="<?php echo e(url('/login')); ?>" class="amaz_primary_btn w-100" style="text-indent: 0;">
                                                    <?php echo e(__('defaultTheme.login_to_order')); ?>

                                                </a>

                                            </div>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <!-- content  -->
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
    $filter_category_2 = $widgets->where('section_name','filter_category_2')->first();
    $category = @$filter_category_2->customSection->category;
?>

<div id="filter_category_2" class="amaz_section section_spacing2 <?php echo e(@$filter_category_2->status == 0?'d-none':''); ?>">
    <div class="container ">
        <?php if($category): ?>
            <div class="row no-gutters">
                <div class="col-xl-5 p-0 col-lg-12">
                    <div class="House_Appliances_widget">
                        <div class="House_Appliances_widget_left d-flex flex-column flex-fill">
                            <h4 id="filter_category_title"><?php echo e($filter_category_2->title); ?></h4>
                            <ul class="nav nav-tabs flex-fill flex-column border-0" id="myTab10" role="tablist">
                                <?php $__currentLoopData = @$category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link <?php echo e($key == 0?'active':''); ?>" id="tab_link_<?php echo e($subcat->id); ?>" data-bs-toggle="tab" data-bs-target="#fashion_tab_pane_subcat_<?php echo e($subcat->id); ?>" type="button" role="tab" aria-controls="Dining" aria-selected="true"><?php echo e($subcat->name); ?></button>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <a href="<?php echo e(route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])); ?>" class="title_link d-flex align-items-center lh-1">
                                <span class="title_text"><?php echo e(__('common.more_deals')); ?></span>
                                <span class="title_icon">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            </a>
                        </div>
                        <a href="<?php echo e(route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])); ?>" class="House_Appliances_widget_right overflow-hidden p-0 <?php echo e($filter_category_2->customSection->field_2?'':'d-none'); ?>">
                            <img class="h-100 lazyload" data-src="<?php echo e(showImage($filter_category_2->customSection->field_2)); ?>" src="<?php echo e(showImage(themeDefaultImg())); ?>" alt="<?php echo e(@$filter_category_2->title); ?>" title="<?php echo e(@$filter_category_2->title); ?>">
                        </a>
                    </div>
                </div>
                <div class="col-xl-7 p-0 col-lg-12">
                    <div class="tab-content" id="myTabContent10">
                        <?php if($category->subCategories->count()): ?>
                            <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tab-pane fade <?php echo e($key == 0?'show active':''); ?>" id="fashion_tab_pane_subcat_<?php echo e($subcat->id); ?>" role="tabpanel" aria-labelledby="Dining-tab">
                                    <!-- content  -->
                                    <div class="House_Appliances_product">
                                        <?php $__currentLoopData = $subcat->sellerProductTake(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="product_widget5 style4 mb-0 style5">
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
                                                    <?php if(app('general_setting')->lazyload == 1): ?>
                                                    <img data-src="<?php echo e($thumbnail); ?>" src="<?php echo e(showImage(themeDefaultImg())); ?>"
                                                        alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>"
                                                        class="lazyload">
                                                    <?php else: ?>
                                                    <img  src="<?php echo e($thumbnail); ?>"   alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>">
                                                    <?php endif; ?>
                                                </a>
                                                <?php if(isGuestAddtoCart()): ?>
                                                <div class="product_action">
                                                    <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                        data-producttype="<?php echo e(@$product->product->product_type); ?>"
                                                        data-seller=<?php echo e($product->user_id); ?>

                                                        data-product-sku=<?php echo e(@$product->skus->first()->id); ?>

                                                        data-product-id=<?php echo e($product->id); ?>>
                                                        <i class="ti-control-shuffle"
                                                            title="<?php echo e(__('defaultTheme.compare')); ?>"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
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
                                                    <?php if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count()): ?>
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

                                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                    <a class="amaz_primary_btn w-100" href="<?php echo e(url('/login')); ?>" style="text-indent: 0;">
                                                        <?php echo e(__('defaultTheme.login_to_order')); ?>

                                                    </a>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <!-- content  -->
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="tab-pane fade show active" id="fashion_tab_pane_subcat_1" role="tabpanel" aria-labelledby="Dining-tab">
                                <!-- content  -->
                                <div class="House_Appliances_product">
                                    <?php $__currentLoopData = $category->sellerProductTake(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="product_widget5 style4 mb-0 style5">
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
                                                <?php if(app('general_setting')->lazyload == 1): ?>
                                                    <img data-src="<?php echo e($thumbnail); ?>" src="<?php echo e(showImage(themeDefaultImg())); ?>"
                                                        alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>"
                                                        class="lazyload">
                                                <?php else: ?>
                                                    <img  src="<?php echo e($thumbnail); ?>"
                                                    alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>"
                                                    >
                                                <?php endif; ?>
                                            </a>
                                            <?php if(isGuestAddtoCart()): ?>
                                                <div class="product_action">
                                                    <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                        data-producttype="<?php echo e(@$product->product->product_type); ?>"
                                                        data-seller=<?php echo e($product->user_id); ?>

                                                        data-product-sku=<?php echo e(@$product->skus->first()->id); ?>

                                                        data-product-id=<?php echo e($product->id); ?>>
                                                        <i class="ti-control-shuffle"
                                                            title="<?php echo e(__('defaultTheme.compare')); ?>"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
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
                                                <?php if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count()): ?>
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
                                            <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                <a class="amaz_primary_btn w-100" href="<?php echo e(url('/login')); ?>" style="text-indent:0;">
                                                    <?php echo e(__('defaultTheme.login_to_order')); ?>

                                                </a>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <!-- content  -->
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
    $filter_category_3 = $widgets->where('section_name','filter_category_3')->first();
    $category = @$filter_category_3->customSection->category;
?>

<div id="filter_category_3" class="amaz_section section_spacing2 <?php echo e(@$filter_category_3->status == 0?'d-none':''); ?>">
    <div class="container ">
        <?php if($category): ?>
            <div class="row no-gutters">
                <div class="col-xl-5 p-0 col-lg-12">
                    <div class="House_Appliances_widget">
                        <div class="House_Appliances_widget_left d-flex flex-column flex-fill">
                            <h4 id="filter_category_title"><?php echo e($filter_category_3->title); ?></h4>
                            <ul class="nav nav-tabs flex-fill flex-column border-0" id="myTab10" role="tablist">
                                <?php $__currentLoopData = @$category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link <?php echo e($key == 0?'active':''); ?>" id="tab_link_<?php echo e($subcat->id); ?>" data-bs-toggle="tab" data-bs-target="#electronics_tab_pane_subcat_<?php echo e($subcat->id); ?>" type="button" role="tab" aria-controls="Dining" aria-selected="true"><?php echo e($subcat->name); ?></button>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <a href="<?php echo e(route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])); ?>" class="title_link d-flex align-items-center lh-1">
                                <span class="title_text"><?php echo e(__('common.more_deals')); ?></span>
                                <span class="title_icon">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            </a>
                        </div>
                        <a href="<?php echo e(route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])); ?>" class="House_Appliances_widget_right overflow-hidden p-0 <?php echo e($filter_category_3->customSection->field_2?'':'d-none'); ?>">
                            <img class="h-100 lazyload" data-src="<?php echo e(showImage($filter_category_3->customSection->field_2)); ?>" src="<?php echo e(showImage(themeDefaultImg())); ?>" alt="<?php echo e(@$filter_category_3->title); ?>" title="<?php echo e(@$filter_category_3->title); ?>">
                        </a>
                    </div>
                </div>
                <div class="col-xl-7 p-0 col-lg-12">
                    <div class="tab-content" id="myTabContent10">
                        <?php if($category->subCategories->count()): ?>
                            <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tab-pane fade <?php echo e($key == 0?'show active':''); ?>" id="electronics_tab_pane_subcat_<?php echo e($subcat->id); ?>" role="tabpanel" aria-labelledby="Dining-tab">
                                    <!-- content  -->
                                    <div class="House_Appliances_product">
                                        <?php $__currentLoopData = $subcat->sellerProductTake(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="product_widget5 style4 mb-0 style5">
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
                                                    <?php if(app('general_setting')->lazyload == 1): ?>
                                                      <img data-src="<?php echo e($thumbnail); ?>" src="<?php echo e(showImage(themeDefaultImg())); ?>"
                                                        alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>"
                                                        class="lazyload">
                                                    <?php else: ?>
                                                      <img  src="<?php echo e($thumbnail); ?>"  alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>" >
                                                    <?php endif; ?>
                                                </a>
                                                <?php if(isGuestAddtoCart()): ?>
                                                <div class="product_action">
                                                    <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                        data-producttype="<?php echo e(@$product->product->product_type); ?>"
                                                        data-seller=<?php echo e($product->user_id); ?>

                                                        data-product-sku=<?php echo e(@$product->skus->first()->id); ?>

                                                        data-product-id=<?php echo e($product->id); ?>>
                                                        <i class="ti-control-shuffle"
                                                            title="<?php echo e(__('defaultTheme.compare')); ?>"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
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
                                                    <?php if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count()): ?>
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
                                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                    <a class="amaz_primary_btn w-100" href="<?php echo e(url('/login')); ?>" style="text-indent:0; ">

                                                        <?php echo e(__('defaultTheme.login_to_order')); ?>

                                                    </a>

                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <!-- content  -->
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="tab-pane fade show active" id="electronics_tab_pane_subcat_1" role="tabpanel" aria-labelledby="Dining-tab">
                                <!-- content  -->
                                <div class="House_Appliances_product">
                                    <?php $__currentLoopData = $category->sellerProductTake(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="product_widget5 style4 mb-0 style5">
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

                                                    <?php if(app('general_setting')->lazyload == 1): ?>
                                                      <img data-src="<?php echo e($thumbnail); ?>" src="<?php echo e(showImage(themeDefaultImg())); ?>"
                                                        alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>"
                                                        class="lazyload">
                                                    <?php else: ?>
                                                      <img  src="<?php echo e($thumbnail); ?>"  alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>" >
                                                    <?php endif; ?>
                                            </a>
                                            <?php if(isGuestAddtoCart()): ?>
                                            <div class="product_action">
                                                <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                    data-producttype="<?php echo e(@$product->product->product_type); ?>"
                                                    data-seller=<?php echo e($product->user_id); ?>

                                                    data-product-sku=<?php echo e(@$product->skus->first()->id); ?>

                                                    data-product-id=<?php echo e($product->id); ?>>
                                                    <i class="ti-control-shuffle"
                                                        title="<?php echo e(__('defaultTheme.compare')); ?>"></i>
                                                </a>
                                                <a href="javascript:void(0)"
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
                                                <?php if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count()): ?>
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
                                            <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                <a class="amaz_primary_btn w-100" href="<?php echo e(url('/login')); ?>" style="text-indent: 0;">

                                                    <?php echo e(__('defaultTheme.login_to_order')); ?>

                                                </a>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <!-- content  -->
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- amaz_section::end  -->
<!-- cta::start  -->
<div class="amaz_section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <?php if (isset($component)) { $__componentOriginale3583eaf448e65fee9299b47668d6d8c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3583eaf448e65fee9299b47668d6d8c = $attributes; } ?>
<?php $component = App\View\Components\RandomAdsComponent::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('random-ads-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\RandomAdsComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3583eaf448e65fee9299b47668d6d8c)): ?>
<?php $attributes = $__attributesOriginale3583eaf448e65fee9299b47668d6d8c; ?>
<?php unset($__attributesOriginale3583eaf448e65fee9299b47668d6d8c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3583eaf448e65fee9299b47668d6d8c)): ?>
<?php $component = $__componentOriginale3583eaf448e65fee9299b47668d6d8c; ?>
<?php unset($__componentOriginale3583eaf448e65fee9299b47668d6d8c); ?>
<?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- cta::end  -->

<?php
    $top_rating = $widgets->where('section_name','top_rating')->first();
    $peoples_choice = $widgets->where('section_name','people_choices')->first();
    $top_picks = $widgets->where('section_name','top_picks')->first();
?>
<div class="amaz_section section_spacing3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="nav amzcart_tabs d-flex align-items-center justify-content-center flex-wrap " id="myTab" role="tablist">
                    <li class="nav-item <?php echo e($top_rating->status == 0 ? 'd-none' : ''); ?>" role="presentation" id="top_rating">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><span id="top_rating_title"><?php echo e($top_rating->title); ?></span></button>
                    </li>
                    <li class="nav-item <?php echo e($peoples_choice->status == 0 ? 'd-none' : ''); ?>" role="presentation" id="people_choices">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><span id="people_choice_title"><?php echo e($peoples_choice->title); ?></span></button>
                    </li>
                    <li class="nav-item <?php echo e($top_picks->status == 0 ? 'd-none' : ''); ?>" role="presentation" id="top_picks">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false"><span id="top_picks_title"><?php echo e($top_picks->title); ?></span></button>
                    </li>
                </ul>
            </div>
            <div class="col-xl-12">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade <?php echo e($top_rating->status == 0 ? 'hide' : 'show active'); ?>" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <!-- conttent  -->
                        <div class="amaz_fieature_active fieature_crousel_area owl-carousel">
                            <?php $__currentLoopData = $top_rating->getHomePageProductByQuery(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="product_widget5 mb_30 style5">
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
                                            <?php if(app('general_setting')->lazyload == 1): ?>
                                                <img data-src="<?php echo e($thumbnail); ?>" src="<?php echo e(showImage(themeDefaultImg())); ?>"
                                                alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>"
                                                class="lazyload">
                                            <?php else: ?>
                                                <img  src="<?php echo e($thumbnail); ?>"  alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>" >
                                            <?php endif; ?>
                                    </a>
                                    <?php if(isGuestAddtoCart()): ?>
                                        <div class="product_action">
                                            <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                data-producttype="<?php echo e(@$product->product->product_type); ?>"
                                                data-seller=<?php echo e($product->user_id); ?>

                                                data-product-sku=<?php echo e(@$product->skus->first()->id); ?>

                                                data-product-id=<?php echo e($product->id); ?>>
                                                <i class="ti-control-shuffle"
                                                    title="<?php echo e(__('defaultTheme.compare')); ?>"></i>
                                            </a>
                                            <a href="javascript:void(0)"
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
                                        <?php if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count()): ?>
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
                                





<div class="product__meta px-3 text-center">
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
                                        <?php if(isset($product->product->mrp) || isset($product->mrp)): ?>
                                            <del>
                                                <?php echo e(single_price($product->product->mrp ?? $product->mrp)); ?>

                                            </del>
                                        <?php endif; ?>

                                        <strong>
                                            <?php echo e(getProductDiscountedPrice(@$product)); ?>

                                        </strong>
                                    </p>

                                        </div>
                                    <?php else: ?>
                                        <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                            <a class="amaz_primary_btn w-100" href="<?php echo e(url('/login')); ?>"  style="text-indent: 0;">

                                                <?php echo e(__('defaultTheme.login_to_order')); ?>

                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>












                            </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <!-- conttent  -->
                    </div>
                    <div class="tab-pane fade <?php echo e($peoples_choice->status == 1 && $top_rating->status == 0 ? 'show active': 'hide'); ?>" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <!-- conttent  -->
                        <div class="amaz_fieature_active fieature_crousel_area owl-carousel">
                            <?php $__currentLoopData = $peoples_choice->getHomePageProductByQuery(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="product_widget5 mb_30 style5">
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
                                        <?php if(app('general_setting')->lazyload == 1): ?>
                                            <img data-src="<?php echo e($thumbnail); ?>" src="<?php echo e(showImage(themeDefaultImg())); ?>"
                                            alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>"
                                            class="lazyload">
                                        <?php else: ?>
                                            <img  src="<?php echo e($thumbnail); ?>"  alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>" >
                                        <?php endif; ?>
                                    </a>

                                    <?php if(isGuestAddtoCart()): ?>
                                        <div class="product_action">
                                            <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                data-producttype="<?php echo e(@$product->product->product_type); ?>"
                                                data-seller=<?php echo e($product->user_id); ?>

                                                data-product-sku=<?php echo e(@$product->skus->first()->id); ?>

                                                data-product-id=<?php echo e($product->id); ?>>
                                                <i class="ti-control-shuffle"
                                                    title="<?php echo e(__('defaultTheme.compare')); ?>"></i>
                                            </a>
                                            <a href="javascript:void(0)"
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
                                <div class="product__meta px-3 text-center">
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
                                        <!-- <p>
                                            <?php if(getProductwitoutDiscountPrice(@$product) != single_price(0)): ?>
                                                <del>
                                                    <?php echo e(getProductwitoutDiscountPrice(@$product)); ?>

                                                </del>
                                                <?php endif; ?>
                                            <strong>
                                                <?php echo e(getProductDiscountedPrice(@$product)); ?>

                                            </strong>
                                        </p> -->

                                        <p class="d-flex flex-column text-end m-0">

                                            
                                            <strong class="text-dark">
                                                <?php echo e(getProductDiscountedPrice(@$product)); ?>

                                            </strong>

                                            
                                            <?php if(isset($product->product->mrp) || isset($product->mrp)): ?>
                                                <del class="text-muted">
                                                    <?php echo e(single_price($product->product->mrp ?? $product->mrp)); ?>

                                                </del>
                                            <?php endif; ?>

                                        </p>

                                    </div>
                                    <?php else: ?>
                                    <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                        <a class="amaz_primary_btn w-100"  style="text-indent: 0;" href="<?php echo e(url('/login')); ?>" >

                                            <?php echo e(__('defaultTheme.login_to_order')); ?>

                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <!-- <p class="d-flex flex-column text-end m-0">

                                    
                                    <strong class="text-dark">
                                        <?php echo e(getProductDiscountedPrice(@$product)); ?>

                                    </strong>

                                    
                                    <?php if(isset($product->product->mrp) || isset($product->mrp)): ?>
                                        <del class="text-muted">
                                            <?php echo e(single_price($product->product->mrp ?? $product->mrp)); ?>

                                        </del>
                                    <?php endif; ?>

                                </p> -->

                            </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <!-- conttent  -->
                    </div>
                    <div class="tab-pane fade <?php echo e($top_picks->status == 1 && $peoples_choice->status == 0 && $top_rating->status == 0 ? 'show active': 'hide'); ?>" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <!-- conttent  -->
                        <div class="amaz_fieature_active fieature_crousel_area owl-carousel">
                            <?php $__currentLoopData = $top_picks->getHomePageProductByQuery(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="product_widget5 mb_30 style5">
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
                                            <?php if(app('general_setting')->lazyload == 1): ?>
                                                <img data-src="<?php echo e($thumbnail); ?>" src="<?php echo e(showImage(themeDefaultImg())); ?>"
                                                alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>"
                                                class="lazyload">
                                            <?php else: ?>
                                                <img  src="<?php echo e($thumbnail); ?>"  alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>" >
                                            <?php endif; ?>
                                        </a>
                                        <?php if(isGuestAddtoCart()): ?>
                                            <div class="product_action">
                                                <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                    data-producttype="<?php echo e(@$product->product->product_type); ?>"
                                                    data-seller=<?php echo e($product->user_id); ?>

                                                    data-product-sku=<?php echo e(@$product->skus->first()->id); ?>

                                                    data-product-id=<?php echo e($product->id); ?>>
                                                    <i class="ti-control-shuffle"
                                                        title="<?php echo e(__('defaultTheme.compare')); ?>"></i>
                                                </a>
                                                <a href="javascript:void(0)"
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








                                    <div class="product__meta px-3 text-center">
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
                                               <p class="d-flex flex-column text-end m-0">

                                        
                                        <strong class="text-dark">
                                            <?php echo e(getProductDiscountedPrice(@$product)); ?>

                                        </strong>

                                        
                                        <?php if(isset($product->product->mrp) || isset($product->mrp)): ?>
                                            <del class="text-muted">
                                                <?php echo e(single_price($product->product->mrp ?? $product->mrp)); ?>

                                            </del>
                                        <?php endif; ?>

                                    </p>
                                            </div>
                                        <?php else: ?>

                                        <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                            <a class="amaz_primary_btn w-100"  style="text-indent: 0;" href="<?php echo e(url('/login')); ?>">
                                                <?php echo e(__('defaultTheme.login_to_order')); ?>

                                            </a>
                                        </div>
                                        <?php endif; ?>
                                    </div>

                                   

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <!-- conttent  -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
    $discount_banner = $widgets->where('section_name','discount_banner')->first();
?>
<div id="discount_banner" class="amaz_section amaz_deal_area <?php echo e($discount_banner->status == 0?'d-none':''); ?>">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-md-6 col-lg-4 mb_20 <?php echo e(!@$discount_banner->customSection->field_4?'d-none':''); ?>">
                <a href="<?php echo e(@$discount_banner->customSection->field_4); ?>" class="mb_30">
                    <img data-src="<?php echo e(showImage(@$discount_banner->customSection->field_1)); ?>" src="<?php echo e(showImage(themeDefaultImg())); ?>" alt="<?php echo e($discount_banner->title); ?>" title="<?php echo e($discount_banner->title); ?>" class="img-fluid lazyload">
                </a>
            </div>
            <div class="col-xl-4 col-md-6 col-lg-4 mb_20 <?php echo e(!@$discount_banner->customSection->field_5?'d-none':''); ?>">
                <a href="<?php echo e(@$discount_banner->customSection->field_5); ?>" class=" mb_30">
                    <img data-src="<?php echo e(showImage(@$discount_banner->customSection->field_2)); ?>" src="<?php echo e(showImage(themeDefaultImg())); ?>" alt="<?php echo e($discount_banner->title); ?>" title="<?php echo e($discount_banner->title); ?>" class="img-fluid lazyload">
                </a>
            </div>
            <div class="col-xl-4 col-md-6 col-lg-4 mb_20 <?php echo e(!@$discount_banner->customSection->field_6?'d-none':''); ?>">
                <a href="<?php echo e(@$discount_banner->customSection->field_6); ?>" class=" mb_30">
                    <img data-src="<?php echo e(showImage(@$discount_banner->customSection->field_3)); ?>" src="<?php echo e(showImage(themeDefaultImg())); ?>" alt="<?php echo e($discount_banner->title); ?>" title="<?php echo e($discount_banner->title); ?>" class="img-fluid lazyload">
                </a>
            </div>
        </div>
    </div>
</div>

<!-- amaz_recomanded::start  -->

<?php
    $more_products = $widgets->where('section_name','more_products')->first();
?>
<div class="amaz_recomanded_area <?php echo e($more_products->status == 0?'d-none':''); ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="more_products" class="amaz_recomanded_box mb_60">
                    <div class="amaz_recomanded_box_head">
                        <h4 class="mb-0"><?php echo e($more_products->title); ?></h4>
                    </div>
                    <div class="amaz_recomanded_box_body2 dataApp">
                        <?php $__currentLoopData = $more_products->getHomePageProductByQuery(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="product_widget5 style5">
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
                                    <?php if(app('general_setting')->lazyload == 1): ?>
                                        <img data-src="<?php echo e($thumbnail); ?>" src="<?php echo e(showImage(themeDefaultImg())); ?>"
                                        alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>"
                                        class="lazyload">
                                    <?php else: ?>
                                        <img  src="<?php echo e($thumbnail); ?>"  alt="<?php echo e(@$product->product_name); ?>" title="<?php echo e(@$product->product_name); ?>" >
                                    <?php endif; ?>
                                </a>
                                <?php if(isGuestAddtoCart()): ?>
                                <div class="product_action">
                                    <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                        data-producttype="<?php echo e(@$product->product->product_type); ?>"
                                        data-seller=<?php echo e($product->user_id); ?>

                                        data-product-sku=<?php echo e(@$product->skus->first()->id); ?>

                                        data-product-id=<?php echo e($product->id); ?>>
                                        <i class="ti-control-shuffle"
                                            title="<?php echo e(__('defaultTheme.compare')); ?>"></i>
                                    </a>
                                    <a href="javascript:void(0)"
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
                                    
                                    <?php if(!empty($product->product->mrp)): ?>
                                        <del class="text-muted">
                                            <?php echo e(single_price($product->product->mrp)); ?>

                                        </del>
                                    <?php endif; ?>

                                    
                                    <strong>
                                        <?php echo e(getProductDiscountedPrice(@$product)); ?>

                                    </strong>
                                </p>

                                </div>
                                <?php else: ?>
                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                    <a class="amaz_primary_btn w-100" style="text-indent: 0;" href="<?php echo e(url('/login')); ?>">

                                        <?php echo e(__('defaultTheme.login_to_order')); ?>

                                    </a>
                                </div>

                                <?php endif; ?>
                            </div>
                        </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center">
                <?php if($more_products->getHomePageProductByQuery()->lastPage() > 1): ?>
                <a id="loadmore" class="amaz_primary_btn2 min_200 load_more_btn_homepage"><?php echo e(__('common.load_more')); ?></a>
                <?php endif; ?>

                <input type="hidden" id="login_check" value="<?php if(auth()->check()): ?> 1 <?php else: ?> 0 <?php endif; ?>">
            </div>
        </div>
    </div>
</div>
<!-- amaz_recomanded::end -->
<?php if (isset($component)) { $__componentOriginal0ca921cbd7467434b81b6d7d790713d0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0ca921cbd7467434b81b6d7d790713d0 = $attributes; } ?>
<?php $component = App\View\Components\TopBrandComponent::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('top-brand-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\TopBrandComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0ca921cbd7467434b81b6d7d790713d0)): ?>
<?php $attributes = $__attributesOriginal0ca921cbd7467434b81b6d7d790713d0; ?>
<?php unset($__attributesOriginal0ca921cbd7467434b81b6d7d790713d0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0ca921cbd7467434b81b6d7d790713d0)): ?>
<?php $component = $__componentOriginal0ca921cbd7467434b81b6d7d790713d0; ?>
<?php unset($__componentOriginal0ca921cbd7467434b81b6d7d790713d0); ?>
<?php endif; ?>
<!-- amaz_brand::start  -->

<!-- amaz_brand::end  -->

<!-- Popular Searches::start  -->
<?php if (isset($component)) { $__componentOriginale01fa611887af4a6933a59a1a10ddce6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale01fa611887af4a6933a59a1a10ddce6 = $attributes; } ?>
<?php $component = App\View\Components\PopularSearchComponent::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('popular-search-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\PopularSearchComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale01fa611887af4a6933a59a1a10ddce6)): ?>
<?php $attributes = $__attributesOriginale01fa611887af4a6933a59a1a10ddce6; ?>
<?php unset($__attributesOriginale01fa611887af4a6933a59a1a10ddce6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale01fa611887af4a6933a59a1a10ddce6)): ?>
<?php $component = $__componentOriginale01fa611887af4a6933a59a1a10ddce6; ?>
<?php unset($__componentOriginale01fa611887af4a6933a59a1a10ddce6); ?>
<?php endif; ?>
<!-- Popular Searches::end  -->

<?php echo $__env->make(theme('partials._subscription_modal'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(theme('partials.add_to_cart_script'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make(theme('partials.add_to_compare_script'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('frontend.amazy.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Production_dev/resources/views/frontend/amazy/welcome.blade.php ENDPATH**/ ?>