<div id="top_brands" class="amaz_brand <?php echo e($top_brands->status == 0?'d-none':''); ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section__title d-flex align-items-center gap-3 mb_30">
                    <h3 id="top_brands_title" class="m-0 flex-fill"><?php echo e($top_brands->title); ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="amazBrand_boxes">
                    <?php $__currentLoopData = $top_brands->getBrandByQuery(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('frontend.category-product',['slug' => $brand->slug, 'item' =>'brand'])); ?>" class="single_brand d-flex align-items-center justify-content-center">
                            <?php if(app('general_setting')->lazyload == 1): ?>
                            <img data-src="<?php echo e(showImage($brand->logo?$brand->logo:'frontend/default/img/brand_image.png')); ?>" src="<?php echo e(showImage(themeDefaultImg())); ?>" class="lazyload" alt="<?php echo e($brand->name); ?>" title="<?php echo e($brand->name); ?>">
                            <?php else: ?>
                            <img src="<?php echo e(showImage($brand->logo?$brand->logo:'frontend/default/img/brand_image.png')); ?>" alt="<?php echo e($brand->name); ?>" title="<?php echo e($brand->name); ?>">

                            <?php endif; ?>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/Production_dev/resources/views/frontend/amazy/components/top-brand-component.blade.php ENDPATH**/ ?>