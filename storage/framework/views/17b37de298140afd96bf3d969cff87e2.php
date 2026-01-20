<?php
    $total_number_of_item_per_page = $products->perPage();
    $total_number_of_items = ($products->total() > 0) ? $products->total() : 0;
    $total_number_of_pages = $total_number_of_items / $total_number_of_item_per_page;
    $reminder = $total_number_of_items % $total_number_of_item_per_page;
    if ($reminder > 0) {
        $total_number_of_pages += 1;
    }
    $current_page = $products->currentPage();
    $previous_page = $products->currentPage() - 1;
    if($current_page == $products->lastPage()){
    $show_end = $total_number_of_items;
    }else{
    $show_end = $total_number_of_item_per_page * $current_page;
    }
    $show_start = 0;
    if($total_number_of_items > 0){
      $show_start = ($total_number_of_item_per_page * $previous_page) + 1;
    }
?>
<div class="category_product_page">
    <div class="product_page_tittle">
        <div class="row">
          <div class="col-lg-4 mb-10 mt-15">
            <p class="text-lowercase"><?php echo e(__('defaultTheme.showing')); ?> <?php if($show_start == $show_end): ?> <?php echo e(getNumberTranslate($show_end)); ?> <?php else: ?> <?php echo e(getNumberTranslate($show_start)); ?> - <?php echo e(getNumberTranslate($show_end)); ?> <?php endif; ?> <?php echo e(__('defaultTheme.out_of_total')); ?> <?php echo e(getNumberTranslate($total_number_of_items)); ?> <?php echo e(__('common.products')); ?></p>
          </div>
        <div class="col-lg-4 mb-10">
          <div class="short_by">
            <select name="paginate_by" class="primary_select paginate_no" id="paginate_by">
                <option value="12" <?php if(isset($paginate) && $paginate == "12"): ?> selected <?php endif; ?>><?php echo e(getNumberTranslate(12)); ?></option>
                <option value="16" <?php if(isset($paginate) && $paginate == "16"): ?> selected <?php endif; ?>><?php echo e(getNumberTranslate(16)); ?></option>
                <option value="30" <?php if(isset($paginate) && $paginate == "30"): ?> selected <?php endif; ?>><?php echo e(getNumberTranslate(30)); ?></option>
            </select>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="short_by">
            <select name="sort_by" onchange="getFilterUpdateByIndex()" class="primary_select sort_by" id="product_short_list">
                <option value="new" <?php if(isset($sort_by) && $sort_by == "new"): ?> selected <?php endif; ?>><?php echo e(__('common.new')); ?></option>
                <option value="old" <?php if(isset($sort_by) && $sort_by == "old"): ?> selected <?php endif; ?>><?php echo e(__('common.old')); ?></option>
                <option value="low_to_high" <?php if(isset($sort_by) && $sort_by == "low_to_high"): ?> selected <?php endif; ?>><?php echo e(__('common.price')); ?> (<?php echo e(__('defaultTheme.low_to_high')); ?>)</option>
                <option value="high_to_low" <?php if(isset($sort_by) && $sort_by == "high_to_low"): ?> selected <?php endif; ?>><?php echo e(__('common.price')); ?> (<?php echo e(__('defaultTheme.high_to_low')); ?>)</option>
            </select>
          </div>
        </div>
        </div>
    </div>
    <input type="hidden" name="filterCatCol" class="filterCatCol" value="0">
    <?php if(count($products) > 0): ?>
      <div class="row mt-20">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($product->type =='product'): ?>
              <div class="col-xl-3 col-lg-6 col-lg-3 col-sm-6 col-md-6 single_product_item">
            <div class="single_product_list product_tricker">
              <div class="product_img">
                <a href="<?php echo e(singleProductURL($product->seller->slug, $product->slug)); ?>" target="_blank" class="product_img_iner">
                  <img <?php if(@$product->product->thum_img != null): ?> src="<?php echo e(showImage(@$product->product->thum_img)); ?>" <?php else: ?> src="<?php echo e(showImage(@$product->product->product->thumbnail_image_source)); ?>" <?php endif; ?> alt="<?php echo e(@$product->product->product->product_name); ?>" class="img-fluid" />
                </a>
                <div class="socal_icon">
                  <a href="" class="addToCompareFromThumnail" data-producttype="<?php echo e(@$product->product->product->product_type); ?>" data-seller=<?php echo e(@$product->product->user_id); ?> data-product-sku=<?php echo e(@$product->product->skus->first()->id); ?> data-product-id=<?php echo e(@$product->product->id); ?>><i class="ti-control-shuffle" title="<?php echo e(__('defaultTheme.compare')); ?>"></i> </a>
                  <a href="" class="quickView" data-producttype="<?php echo e(@$product->product->product->product_type); ?>" data-seller=<?php echo e(@$product->product->user_id); ?> data-product-sku=<?php echo e(@$product->product->skus->first()->id); ?>

                    <?php if(@$product->product->hasDeal): ?>
                        data-base-price=<?php echo e(selling_price(@$product->product->skus->first()->selling_price,@$product->product->hasDeal->discount_type,$product->product->hasDeal->discount)); ?>

                    <?php else: ?>
                      <?php if(@$product->product->hasDiscount == 'yes'): ?>
                        data-base-price=<?php echo e(selling_price(@$product->product->skus->first()->selling_price,@$product->product->discount_type,@$product->product->discount)); ?>

                      <?php else: ?>
                        data-base-price=<?php echo e(@$product->product->skus->first()->selling_price); ?>

                      <?php endif; ?>
                    <?php endif; ?>
                    data-shipping-method=<?php echo e(@$product->product->product->shippingMethods->first()->shipping_method_id); ?>

                    data-product-id=<?php echo e(@$product->product->id); ?>

                    data-stock_manage="<?php echo e($product->product->stock_manage); ?>"
                    data-stock="<?php echo e(@$product->product->skus->first()->product_stock); ?>"
                    data-min_qty="<?php echo e($product->product->product->minimum_order_qty); ?>"
                    > <i class="ti-eye" title="<?php echo e(__('defaultTheme.quick_view')); ?>"></i></a>
                  <a class="removeFromWhishlist" data-product-id='<?php echo e($product->id); ?>'> <i class="ti-trash" title="<?php echo e(__('common.delete')); ?>"></i> </a>
                </div>
              </div>
              <div class="product_text">
                <h5>
                  <a href="<?php echo e(singleProductURL($product->seller->slug, $product->slug)); ?>" target="_blank"><?php if(@$product->product->product_name): ?> <?php echo e(substr(@$product->product->product_name,0,35)); ?> <?php if(strlen(@$product->product->product_name) > 35): ?>... <?php endif; ?> <?php else: ?> <?php echo e(substr(@$product->product->product->product_name,0,35)); ?> <?php if(strlen(@$product->product->product->product_name) > 35): ?>... <?php endif; ?> <?php endif; ?></a>
                </h5>
                <div class="product_review_star d-flex justify-content-between align-items-center flex-wrap">
                  <p class="text-nowrap">
                    <?php if(@$product->product->hasDeal): ?>
                      <?php if(@$product->product->product->product_type == 1): ?>
                        <?php echo e(single_price(selling_price(@$product->product->skus->first()->selling_price,@$product->product->hasDeal->discount_type,@$product->product->hasDeal->discount))); ?>

                      <?php else: ?>
                          <?php if(selling_price(@$product->product->skus->min('selling_price'),@$product->product->hasDeal->discount_type,@$product->product->hasDeal->discount) === selling_price(@$product->product->skus->max('selling_price'),@$product->product->hasDeal->discount_type,@$product->product->hasDeal->discount)): ?>
                              <?php echo e(single_price(selling_price(@$product->product->skus->min('selling_price'),@$product->product->hasDeal->discount_type,@$product->product->hasDeal->discount))); ?>

                          <?php else: ?>
                              <?php echo e(single_price(selling_price(@$product->product->skus->min('selling_price'),@$product->product->hasDeal->discount_type,@$product->product->hasDeal->discount))); ?> - <?php echo e(single_price(selling_price(@$product->product->skus->max('selling_price'),@$product->product->hasDeal->discount_type,@$product->product->hasDeal->discount))); ?>

                          <?php endif; ?>
                      <?php endif; ?>
                    <?php else: ?>
                      <?php if(@$product->product->product->product_type == 1): ?>
                        <?php if(@$product->product->hasDiscount == 'yes'): ?>
                          <?php echo e(single_price(selling_price(@$product->product->skus->first()->selling_price,@$product->product->discount_type,@$product->product->discount))); ?>

                        <?php else: ?>
                          <?php echo e(single_price(@$product->product->skus->first()->selling_price)); ?>

                        <?php endif; ?>
                      <?php else: ?>
                        <?php if(@$product->product->hasDiscount == 'yes'): ?>
                          <?php if(selling_price(@$product->product->skus->min('selling_price'),@$product->product->discount_type,@$product->product->product->discount) === selling_price(@$product->product->product->skus->max('selling_price'),@$product->product->product->discount_type,@$product->product->product->discount)): ?>
                              <?php echo e(single_price(selling_price($product->product->skus->min('selling_price'),$product->product->discount_type,$product->product->discount))); ?>

                          <?php else: ?>
                              <?php echo e(single_price(selling_price(@$product->product->skus->min('selling_price'),@$product->product->discount_type,$product->product->discount))); ?> - <?php echo e(single_price(selling_price(@$product->product->skus->max('selling_price'),@$product->product->discount_type,@$product->product->discount))); ?>

                          <?php endif; ?>
                        <?php else: ?>
                          <?php if(@$product->product->skus->min('selling_price') === @$product->product->skus->max('selling_price')): ?>
                              <?php echo e(single_price(@$product->product->skus->min('selling_price'))); ?>

                          <?php else: ?>
                              <?php echo e(single_price(@$product->product->skus->min('selling_price'))); ?> - <?php echo e(single_price(@$product->product->skus->max('selling_price'))); ?>

                          <?php endif; ?>
                        <?php endif; ?>
                      <?php endif; ?>
                    <?php endif; ?>
                  </p>
                  <div class="review_star_icon text-nowrap">
                    <?php
                        $reviews = @$product->product->reviews->where('status',1)->pluck('rating');
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
                    <?php if($rating == 0): ?>
                      <i class="fas fa-star non_rated "></i>
                      <i class="fas fa-star non_rated "></i>
                      <i class="fas fa-star non_rated "></i>
                      <i class="fas fa-star non_rated "></i>
                      <i class="fas fa-star non_rated "></i>
                      <?php elseif($rating < 1 && $rating > 0): ?>
                      <i class="fas fa-star-half-alt"></i>
                      <i class="fas fa-star non_rated "></i>
                      <i class="fas fa-star non_rated "></i>
                      <i class="fas fa-star non_rated "></i>
                      <i class="fas fa-star non_rated "></i>
                      <?php elseif($rating <= 1 && $rating > 0): ?>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star non_rated "></i>
                      <i class="fas fa-star non_rated "></i>
                      <i class="fas fa-star non_rated "></i>
                      <i class="fas fa-star non_rated "></i>
                      <?php elseif($rating < 2 && $rating > 1): ?>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star-half-alt"></i>
                      <i class="fas fa-star non_rated "></i>
                      <i class="fas fa-star non_rated "></i>
                      <i class="fas fa-star non_rated "></i>
                      <?php elseif($rating <= 2 && $rating > 1): ?>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star non_rated "></i>
                      <i class="fas fa-star non_rated "></i>
                      <i class="fas fa-star non_rated "></i>
                      <?php elseif($rating < 3 && $rating > 2): ?>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star-half-alt"></i>
                      <i class="fas fa-star non_rated "></i>
                      <i class="fas fa-star non_rated "></i>
                      <?php elseif($rating <= 3 && $rating > 2): ?>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star "></i>
                      <i class="fas fa-star non_rated "></i>
                      <i class="fas fa-star non_rated "></i>
                      <?php elseif($rating < 4 && $rating > 3): ?>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star "></i>
                      <i class="fas fa-star-half-alt"></i>
                      <i class="fas fa-star non_rated "></i>
                      <?php elseif($rating <= 4 && $rating > 3): ?>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star "></i>
                      <i class="fas fa-star "></i>
                      <i class="fas fa-star non_rated "></i>
                      <?php elseif($rating < 5 && $rating > 4): ?>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star "></i>
                      <i class="fas fa-star "></i>
                      <i class="fas fa-star-half-alt"></i>
                      <?php else: ?>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star "></i>
                      <i class="fas fa-star "></i>
                      <i class="fas fa-star "></i>
                      <?php endif; ?>
                  </div>
                </div>
                <div class="product_review_count d-flex justify-content-between align-items-center flex-wrap">
                  <span class="text-nowrap">
                    <?php if($product->product->hasDeal): ?>
                      <?php if($product->product->hasDeal->discount > 0): ?>
                        <?php if($product->product->product->product_type == 1): ?>
                          <?php echo e(single_price($product->product->skus->first()->selling_price)); ?>

                        <?php else: ?>
                          <?php if($product->product->skus->min('selling_price') === $product->product->skus->max('selling_price')): ?>
                            <?php echo e(single_price($product->product->skus->min('selling_price'))); ?>

                          <?php else: ?>
                            <?php echo e(single_price($product->product->skus->min('selling_price'))); ?> - <?php echo e(single_price($product->product->skus->max('selling_price'))); ?>

                          <?php endif; ?>
                        <?php endif; ?>
                      <?php endif; ?>
                    <?php else: ?>
                      <?php if(@$product->product->hasDiscount == 'yes'): ?>
                        <?php if(@$product->product->product->product_type == 1): ?>
                        <?php echo e(single_price(@$product->product->skus->first()->selling_price)); ?>

                        <?php else: ?>
                          <?php if(@$product->product->skus->min('selling_price') === @$product->product->skus->max('selling_price')): ?>
                            <?php echo e(single_price(@$product->product->skus->min('selling_price'))); ?>

                          <?php else: ?>
                            <?php echo e(single_price(@$product->product->skus->min('selling_price'))); ?> - <?php echo e(single_price(@$product->product->skus->max('selling_price'))); ?>

                          <?php endif; ?>
                        <?php endif; ?>
                      <?php endif; ?>
                    <?php endif; ?>
                  </span>
                  <p class="text-nowrap"><?php echo e(getNumberTranslate(sprintf("%.2f",$rating))); ?>/<?php echo e(getNumberTranslate(5)); ?> (<?php echo e(getNumberTranslate($total_review<10?'0':'')); ?><?php echo e(getNumberTranslate($total_review)); ?> <?php echo e(__('defaultTheme.review')); ?>)</p>
                </div>
                <?php if($product->product->hasDeal): ?>
                  <?php if($product->product->hasDeal->discount > 0): ?>
                    <span class="price_off">
                      <?php if($product->product->hasDeal->discount_type == 0): ?>
                        <?php echo e(getNumberTranslate($product->product->hasDeal->discount)); ?> % <?php echo e(__('common.off')); ?>

                      <?php else: ?>
                      <?php echo e(single_price($product->product->hasDeal->discount)); ?> <?php echo e(__('common.off')); ?>

                      <?php endif; ?>
                    </span>
                  <?php endif; ?>
                <?php else: ?>
                  <?php if(@$product->product->hasDiscount == 'yes'): ?>
                    <span class="price_off">
                      <?php if($product->product->discount_type == 0): ?>
                        <?php echo e(getNumberTranslate($product->product->discount)); ?> % <?php echo e(__('common.off')); ?>

                      <?php else: ?>
                      <?php echo e(single_price($product->product->discount)); ?> <?php echo e(__('common.off')); ?>

                      <?php endif; ?>
                    </span>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
            </div>
        </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
      <div class="col-lg-12">
        <div class="pagination_part">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="<?php echo e($products->previousPageUrl()); ?>"> <i class="ti-arrow-left"></i> </a></li>
                    <?php for($i=1; $i <= $total_number_of_pages; $i++): ?>
                        <?php if(($products->currentPage() + 2) == $i): ?>
                            <li class="page-item"><a class="page-link" href="<?php echo e($products->url($i)); ?>"><?php echo e($i); ?></a></li>
                        <?php endif; ?>
                        <?php if(($products->currentPage() + 1) == $i): ?>
                            <li class="page-item"><a class="page-link" href="<?php echo e($products->url($i)); ?>"><?php echo e($i); ?></a></li>
                        <?php endif; ?>
                        <?php if($products->currentPage() == $i): ?>
                            <li class="page-item <?php if(request()->toRecievedList == $i || request()->toRecievedList == null): ?> active <?php endif; ?>"><a class="page-link" href="<?php echo e($products->url($i)); ?>"><?php echo e($i); ?></a></li>
                        <?php endif; ?>
                        <?php if(($products->currentPage() - 1) == $i): ?>
                            <li class="page-item"><a class="page-link" href="<?php echo e($products->url($i)); ?>"><?php echo e($i); ?></a></li>
                        <?php endif; ?>
                        <?php if(($products->currentPage() - 2) == $i): ?>
                            <li class="page-item"><a class="page-link" href="<?php echo e($products->url($i)); ?>"><?php echo e($i); ?></a></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <li class="page-item"><a class="page-link" href="<?php echo e($products->nextPageUrl()); ?>"> <i class="ti-arrow-right"></i> </a></li>
                </ul>
            </nav>
        </div>
      </div>
    <?php else: ?>
    <div class="row mt-20">
      <div class="col-lg-12 text-center">
        <p class="mt-200"><?php echo e(__('defaultTheme.no_product_in_wishlist')); ?></p>
      </div>
    </div>
    <?php endif; ?>
  </div>
<?php /**PATH /var/www/DhatriProduction/resources/views/backEnd/pages/customer_data/_wishlist_with_paginate.blade.php ENDPATH**/ ?>