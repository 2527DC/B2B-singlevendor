    <div class="product_reviews_wrapper">
        <div class="product_reviews_wrapper_head d-flex align-items-center justify-content-between">
            <h4 class="font_20 f_w_700 m-0"><?php echo e(__('review.customer_feedback')); ?> </h4>
        </div>
        <div class="course_cutomer_reviews">
            <div class="course_feedback">
                <?php
                    $all_ratings = $all_reviews->pluck('rating');
                    if(count($all_ratings)>0){
                        $value = 0;
                        $rating = 0;
                        foreach($all_ratings as $review){
                            $value += $review;
                        }
                        $rating = $value/count($all_ratings);
                        $total_review = count($all_ratings);
                    }else{
                        $rating = 0;
                        $total_review = 1;
                    }
                    $five_stars = ($all_reviews->where('rating',5)->count() * 100)/$total_review;
                    $four_stars = ($all_reviews->where('rating',4)->count() * 100)/$total_review;
                    $three_stars = ($all_reviews->where('rating',3)->count() * 100)/$total_review;
                    $two_stars = ($all_reviews->where('rating',2)->count() * 100)/$total_review;
                    $one_stars = ($all_reviews->where('rating',1)->count() * 100)/$total_review;

                    $sumation_of_stars = $five_stars + $four_stars +  $three_stars + $two_stars + $one_stars;

                    $five_star_fill = ($sumation_of_stars * $five_stars) / 100;
                    $four_star_fill = ($sumation_of_stars * $four_stars) / 100;
                    $three_star_fill = ($sumation_of_stars * $three_stars) / 100;
                    $two_star_fill = ($sumation_of_stars * $two_stars) / 100;
                    $one_star_fill = ($sumation_of_stars * $one_stars) / 100;

                ?>
                <div class="course_feedback_left">
                    <h2><?php echo e(getNumberTranslate(round($rating,1))); ?></h2>
                    <div class="feedmak_stars">
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
                    <span><?php echo e(getNumberTranslate(count($all_ratings))); ?> <?php echo e(__('review.verified_ratings')); ?></span>
                </div>
                <div class="feedbark_progressbar">
                    <div class="single_progrssbar">
                        <div class="progress">
                            <div class="progress-bar"  role="progressbar" aria-valuenow="<?php echo e($five_star_fill); ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="rating_percent d-flex align-items-center">
                            <div class="feedmak_stars d-flex align-items-center">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span><?php echo e(getNumberTranslate($five_stars)); ?>%</span>
                        </div>
                    </div>
                    <div class="single_progrssbar">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo e($four_star_fill); ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="rating_percent d-flex align-items-center">
                            <div class="feedmak_stars d-flex align-items-center">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span><?php echo e(getNumberTranslate($four_stars)); ?>%</span>
                        </div>
                    </div>
                    <div class="single_progrssbar">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo e($three_star_fill); ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="rating_percent d-flex align-items-center">
                            <div class="feedmak_stars d-flex align-items-center">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span><?php echo e(getNumberTranslate($three_stars)); ?>%</span>
                        </div>
                    </div>
                    <div class="single_progrssbar">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo e($two_star_fill); ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="rating_percent d-flex align-items-center">
                            <div class="feedmak_stars d-flex align-items-center">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span><?php echo e(getNumberTranslate($two_stars)); ?>%</span>
                        </div>
                    </div>
                    <div class="single_progrssbar">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo e($one_star_fill); ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="rating_percent d-flex align-items-center">
                            <div class="feedmak_stars d-flex align-items-center">
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span><?php echo e(getNumberTranslate($one_stars)); ?>%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rating_filter_area">
                <div class="single_filter">
                    <button class="filter-review" data-review='0'>
                        <span class="value">All</span>
                    </button>
                </div>
                <div class="single_filter">
                    <button class="filter-review" data-review='5'>
                        <i class="fas fa-star"></i>
                        <span class="value">5</span>
                    </button>
                </div>
                <div class="single_filter">
                    <button class="filter-review" data-review='4'>
                        <i class="fas fa-star"></i>
                        <span class="value">4</span>
                    </button>
                </div>
                <div class="single_filter">
                    <button class="filter-review" data-review='3'>
                        <i class="fas fa-star"></i>
                        <span class="value">3</span>
                    </button>
                </div>
                <div class="single_filter">
                    <button class="filter-review" data-review='2'>
                        <i class="fas fa-star"></i>
                        <span class="value">2</span>
                    </button>
                </div>
                <div class="single_filter">
                    <button class="filter-review" data-review='1'>
                        <i class="fas fa-star"></i>
                        <span class="value">1</span>
                    </button>
                </div>
            </div>
            <div class="customers_reviews" id="all-reviews">
                <?php if(count($reviews) > 0): ?>
                    <?php $__currentLoopData = @$reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="single_reviews flex-column">
                            <div class="single_reviews">
                                <div class="thumb">
                                    <?php if(@$review->customer->avatar != null): ?>
                                        <?php echo e(\Illuminate\Support\Str::limit(@$review->customer->first_name,1,$end='')); ?><?php echo e(\Illuminate\Support\Str::limit(@$review->customer->last_name,1,$end='')); ?>

                                    <?php elseif($review->is_anonymous == 1): ?>
                                        <img src="<?php echo e(showImage('frontend/default/img/avatar.jpg')); ?>" alt="<?php echo e(\Illuminate\Support\Str::limit(@$review->customer->first_name,1,$end='')); ?><?php echo e(\Illuminate\Support\Str::limit(@$review->customer->last_name,1,$end='')); ?>" title="<?php echo e(\Illuminate\Support\Str::limit(@$review->customer->first_name,1,$end='')); ?><?php echo e(\Illuminate\Support\Str::limit(@$review->customer->last_name,1,$end='')); ?>"/>
                                    <?php else: ?>
                                        <img src="<?php echo e(showImage(@$review->customer->avatar)); ?>" alt="<?php echo e(\Illuminate\Support\Str::limit(@$review->customer->first_name,1,$end='')); ?><?php echo e(\Illuminate\Support\Str::limit(@$review->customer->last_name,1,$end='')); ?>" title="<?php echo e(\Illuminate\Support\Str::limit(@$review->customer->first_name,1,$end='')); ?><?php echo e(\Illuminate\Support\Str::limit(@$review->customer->last_name,1,$end='')); ?>"/>
                                    <?php endif; ?>
                                </div>
                                <div class="review_content w-100">
                                    <div class="review_content_head d-flex justify-content-between align-items-start flex-wrap">
                                        <div class="review_content_head_left">
                                            <h4 class="f_w_700 font_20" ><?php echo e($review->is_anonymous==1?'Unknown Name':@$review->customer->first_name.' '.@$review->customer->last_name); ?></h4>
                                            <div class="rated_customer d-flex align-items-center">
                                                <div class="feedmak_stars">
                                                    <?php
                                                        $rating = $review->rating;
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
                                                <span><?php echo e($review->updated_at->diffForHumans()); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <p><?php echo e($review->review); ?></p>

                                    <?php if($review->images->count()): ?>
                                        <div class="review_file mt-3">
                                            <?php
                                                $video = ['mp4'];
                                                if (@$review->product->thum_img != null) {
                                                    $thumbnail = showImage(@$review->product->thum_img);
                                                } else {
                                                    $thumbnail = showImage(@$review->product->product->thumbnail_image_source);
                                                }
                                            ?>
                                            <?php $__currentLoopData = $review->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $ext = explode('.',$image->image);

                                                ?>
                                                <?php if(in_array(trim($ext[1]),$video)): ?>

                                                    <div class="review_img_div">
                                                        <div class="review_img_div review_video_item">
                                                            <a href="<?php echo e(showImage($image->image)); ?>">
                                                                <img src="<?php echo e(asset($thumbnail)); ?>" alt="<?php echo e($review->product->product->product_name); ?>">
                                                            </a>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="review_img_div">
                                                        <img class="review_img lightboxed" src="<?php echo e(showImage($image->image)); ?>" alt="<?php echo e($review->review); ?>" rel="group<?php echo e($review->id); ?>">
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if(@$review->reply): ?>
                                <div class="single_reviews">
                                    <div class="thumb">
                                        <?php if(@$review->customer->avatar != null): ?>
                                            <?php echo e(\Illuminate\Support\Str::limit(@$review->customer->first_name,1,$end='')); ?><?php echo e(\Illuminate\Support\Str::limit(@$review->customer->last_name,1,$end='')); ?>

                                        <?php elseif($review->is_anonymous == 1): ?>
                                            <img src="<?php echo e(showImage('frontend/default/img/avatar.jpg')); ?>" alt="<?php echo e(\Illuminate\Support\Str::limit(@$review->customer->first_name,1,$end='')); ?><?php echo e(\Illuminate\Support\Str::limit(@$review->customer->last_name,1,$end='')); ?>" title="<?php echo e(\Illuminate\Support\Str::limit(@$review->customer->first_name,1,$end='')); ?><?php echo e(\Illuminate\Support\Str::limit(@$review->customer->last_name,1,$end='')); ?>"/>
                                        <?php else: ?>
                                            <img src="<?php echo e(showImage(@$review->customer->avatar)); ?>" alt="<?php echo e(\Illuminate\Support\Str::limit(@$review->customer->first_name,1,$end='')); ?><?php echo e(\Illuminate\Support\Str::limit(@$review->customer->last_name,1,$end='')); ?>" title="<?php echo e(\Illuminate\Support\Str::limit(@$review->customer->first_name,1,$end='')); ?><?php echo e(\Illuminate\Support\Str::limit(@$review->customer->last_name,1,$end='')); ?>"/>
                                        <?php endif; ?>
                                    </div>
                                    <div class="review_content">
                                        <div class="review_content_head d-flex justify-content-between align-items-start flex-wrap">
                                            <div class="review_content_head_left">
                                                <h4 class="f_w_700 font_20" ><?php echo e(@$review->seller->first_name); ?></h4>
                                                <div class="rated_customer d-flex align-items-center">
                                                    <span><?php echo e($review->reply->created_at->diffForHumans()); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <p><?php echo e(@$review->reply->review); ?></p>

                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php else: ?>
                <p><?php echo e(__('defaultTheme.no_review_found')); ?></p>
                <?php endif; ?>
            </div>
        </div>

    </div>
    <div class="mb_30 mt_30" id="review-pager">
        <?php if($reviews->lastPage() > 1): ?>
            <?php if (isset($component)) { $__componentOriginal44b74027c2291d639abf8a70f559de1b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal44b74027c2291d639abf8a70f559de1b = $attributes; } ?>
<?php $component = App\View\Components\PaginationComponent::resolve(['items' => $reviews,'type' => ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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


<?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/partials/_product_review_with_paginate.blade.php ENDPATH**/ ?>