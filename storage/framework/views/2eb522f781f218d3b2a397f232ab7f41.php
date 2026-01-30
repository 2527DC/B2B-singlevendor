<?php if($type == "superadmin" || $type == "admin" || $type == "staff"): ?>
<label class="switch_toggle" for="checkbox<?php echo e($status_slider); ?><?php echo e($products->id); ?>">
    <input type="checkbox" id="checkbox<?php echo e($status_slider); ?><?php echo e($products->id); ?>" <?php if($products->status == 1): ?> checked <?php endif; ?> <?php if(permissionCheck('product.update_active_status')): ?> value="<?php echo e($products->id); ?>" data-id="<?php echo e($products->id); ?>" class="product_status_change" <?php else: ?> disabled <?php endif; ?>>
    <div class="slider round"></div>
</label>
<?php else: ?>

    <?php if($products->is_approved == 1): ?><span class="badge_1"><?php echo e(__('common.approved')); ?></span><?php else: ?><span class="badge_2"><?php echo e(__('common.pending')); ?></span><?php endif; ?>

<?php endif; ?>
<?php /**PATH /var/www/html/Production_dev/Modules/Product/Resources/views/products/components/_product_status_td.blade.php ENDPATH**/ ?>