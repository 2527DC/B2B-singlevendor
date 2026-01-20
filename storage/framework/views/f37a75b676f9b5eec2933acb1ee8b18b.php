
<div class="product_thumb_div">
    <?php if($skus->variant_image != null): ?>
    <img src="<?php echo e(showImage($skus->variant_image)); ?>" alt="<?php echo e($skus->product->product_name); ?>">
    <?php elseif($skus->product->thumbnail_image_source != null): ?>
        <img src="<?php echo e(showImage($skus->product->thumbnail_image_source)); ?>" alt="<?php echo e($skus->product->product_name); ?>">
    <?php else: ?>
        <img src="<?php echo e(showImage('backend/img/default.png')); ?>" alt="<?php echo e($skus->product->product_name); ?>">
    <?php endif; ?>

</div>
<?php /**PATH /var/www/DhatriProduction/Modules/Product/Resources/views/products/components/_sku_logo_td.blade.php ENDPATH**/ ?>