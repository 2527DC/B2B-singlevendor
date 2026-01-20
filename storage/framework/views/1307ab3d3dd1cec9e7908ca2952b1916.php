

<?php $__env->startSection('title'); ?>
    <?php echo e(__('blog.blog')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="amazy_blog_section section_spacing6">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        
                        <?php if($posts->count() > 0): ?>
                            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-4 col-md-6 d-flex">
                                    <div class="amazy_blog_Widget mb_35 style2">
                                        <a href="<?php echo e(route('blog.single.page',$post->slug)); ?>" class="thumb">
                                            <img src="<?php echo e(isset($post->image_url)? showImage($post->image_url):showImage('backend/img/default.png')); ?>" alt="<?php echo e($post->title); ?>" title="<?php echo e($post->title); ?>">
                                        </a>
                                        <div class="blog_content">
                                            <span><?php echo e(dateConvert($post->published_at)); ?></span>
                                            <a href="<?php echo e(route('blog.single.page',$post->slug)); ?>">
                                                <h4><?php echo e($post->title); ?></h4>
                                            </a>
                                            <p><?php echo e($post->excerpt); ?></p>
                                            <a href="<?php echo e(route('blog.single.page',$post->slug)); ?>" class="amazy_readMore_link">+ <?php echo e(__('blog.Read more')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php if($posts->lastPage() > 1): ?>
                                <div class="col-12">
                                    <?php if (isset($component)) { $__componentOriginal44b74027c2291d639abf8a70f559de1b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal44b74027c2291d639abf8a70f559de1b = $attributes; } ?>
<?php $component = App\View\Components\PaginationComponent::resolve(['items' => $posts,'type' => ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="col-lg-12 col-md-12">
                                <div class="card h-100">
                                    <div class="single-post post-style-1 p-2">
                                    <strong><?php echo e(__('blog.no_post_found')); ?></strong>
                                    </div><!-- single-post -->
                                </div><!-- card -->
                            </div><!-- col-lg-4 col-md-6 -->
                        <?php endif; ?>
                        
                    </div>
                </div>
                <?php echo $__env->make('frontend.amazy.pages.blog.partials._sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.amazy.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/resources/views/frontend/amazy/pages/blog/posts.blade.php ENDPATH**/ ?>