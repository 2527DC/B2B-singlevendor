<!-- shortby  -->
<div class="dropdown CRM_dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo e(__('common.select')); ?>

    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
        <a class="dropdown-item product_detail" data-id="<?php echo e($products->id); ?>"><?php echo e(__('common.view')); ?></a>
        <?php if(permissionCheck('product.edit')): ?>
            <?php if($type == "superadmin" || $type == "admin" || $type == "staff" || $products->is_approved == 0): ?>
                <a class="dropdown-item edit_brand" href="<?php if($type == 'superadmin' || $type == 'admin' || $type == "staff"): ?><?php echo e(route('product.edit', $products->id)); ?> <?php else: ?> <?php echo e(route('seller.my-product.edit', $products->id)); ?> <?php endif; ?>"><?php echo e(__('common.edit')); ?></a>
            <?php endif; ?>
        <?php endif; ?>
        <?php if(permissionCheck('product.clone')): ?>
            <a class="dropdown-item edit_brand" href="<?php if($type == 'superadmin' || $type == 'admin' || $type == "staff"): ?><?php echo e(route('product.clone', $products->id)); ?> <?php else: ?> <?php echo e(route('seller.my-product.clone', $products->id)); ?> <?php endif; ?>"><?php echo e(__('common.clone')); ?></a>
        <?php endif; ?>
        <?php if(permissionCheck('product.stock.update')): ?>
            <a class="dropdown-item manage_stock" href="javascript:void(0);" data-id="<?php echo e($products->id); ?>" data-type="<?php echo e($products->product_type); ?>" data-name="<?php echo e($products->product_name); ?>"><?php echo e(__('product.manage_stock')); ?></a>
        <?php endif; ?>
        <?php if(permissionCheck('product.destroy')): ?>
            <?php if($type == "superadmin" || $type == "admin" || $type == "staff" || $products->is_approved == 0): ?>
            <a class="dropdown-item delete_product" data-type="<?php echo e($type); ?>" data-id="<?php echo e($products->id); ?>"><?php echo e(__('common.delete')); ?></a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<!-- shortby  -->
<?php /**PATH /var/www/html/Production_dev/Modules/Product/Resources/views/products/components/_product_action_td.blade.php ENDPATH**/ ?>