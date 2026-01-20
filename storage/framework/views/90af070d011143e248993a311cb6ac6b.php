<?php
    $headerSliderSection = $headers->where('type','slider')->first();
?>

<div class="bannerUi_active owl-carousel <?php echo e($headerSliderSection->is_enable == 0?'d-none':''); ?>">
    <?php
        $sliders = $headerSliderSection->sliders();
    ?>
    <?php if(count($sliders) > 0): ?>
        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a class="banner_img" href="
                <?php if($slider->data_type == 'url'): ?>
                    <?php echo e($slider->url); ?>

                <?php elseif($slider->data_type == 'product'): ?>
                    <?php echo e(singleProductURL(@$slider->product->seller->slug, @$slider->product->slug)); ?>

                <?php elseif($slider->data_type == 'category'): ?>
                    <?php echo e(route('frontend.category-product',['slug' => @$slider->category->slug, 'item' =>'category'])); ?>

                <?php elseif($slider->data_type == 'brand'): ?>
                    <?php echo e(route('frontend.category-product',['slug' => @$slider->brand->slug, 'item' =>'brand'])); ?>

                <?php elseif($slider->data_type == 'tag'): ?>
                    <?php echo e(route('frontend.category-product',['slug' => @$slider->tag->name, 'item' =>'tag'])); ?>

                <?php else: ?>
                    <?php echo e(url('/category')); ?>

                <?php endif; ?>
                " <?php echo e($slider->is_newtab == 1?'target="_blank"':''); ?>>
                <img class="img-fluid" src="<?php echo e(showImage($slider->slider_image)); ?>" alt="<?php echo e(@$slider->name); ?>" title="<?php echo e(@$slider->name); ?>">
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<?php /**PATH /var/www/DhatriProduction/resources/views/frontend/amazy/components/slider-component.blade.php ENDPATH**/ ?>