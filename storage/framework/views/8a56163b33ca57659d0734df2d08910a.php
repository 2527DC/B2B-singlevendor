
<div class="product_thumb_div">
    <?php if($products->thumbnail_image_source != null): ?>
        <img class="productImg" src="<?php echo e(showImage($products->thumbnail_image_source)); ?>" alt="<?php echo e($products->product_name); ?>">
    <?php else: ?>
        <img class="productImg" src="<?php echo e(showImage('backend/img/default.png')); ?>" alt="<?php echo e($products->product_name); ?>">
    <?php endif; ?>
</div>
<?php /**PATH /var/www/DhatriProduction/Modules/Product/Resources/views/products/components/_product_logo_td.blade.php ENDPATH**/ ?>