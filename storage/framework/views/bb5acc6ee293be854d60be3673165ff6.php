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

<div class="mb_30 mt_30">
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
<?php /**PATH /var/www/DhatriProduction/resources/views/frontend/amazy/partials/_review_filter.blade.php ENDPATH**/ ?>