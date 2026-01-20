<!-- shortby  -->
<div class="dropdown CRM_dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo e(__('common.select')); ?>

    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
        <?php if(permissionCheck('product.sku.update')): ?>
            <a class="dropdown-item edit_sku" href="" data-value="<?php echo e($skus); ?>"><?php echo e(__('common.edit')); ?></a>
        <?php endif; ?>
        

    </div>
</div>
<!-- shortby  -->
<?php /**PATH /var/www/DhatriProduction/Modules/Product/Resources/views/products/components/_sku_action_td.blade.php ENDPATH**/ ?>