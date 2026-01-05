<div class="dropdown CRM_dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false"> <?php echo e(__('common.select')); ?>

    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
        <?php if(permissionCheck('customer.show_details')): ?>
            <a href="<?php echo e(route('customer.show_details',$customer->id)); ?>" class="dropdown-item" type="button"><?php echo e(__('common.details')); ?></a>
        <?php endif; ?>
        <?php if(permissionCheck('admin.customer.edit')): ?>
            <a href="<?php echo e(route('admin.customer.edit',$customer->id)); ?>" class="dropdown-item" type="button"><?php echo e(__('common.edit')); ?></a>
        <?php endif; ?>
        <?php if(permissionCheck('admin.customer.destroy')): ?>
            <a data-value="<?php echo e(route('admin.customer.destroy', $customer->id)); ?>" class="dropdown-item delete_customer" type="button"><?php echo e(__('common.delete')); ?></a>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Customer/Resources/views/customers/components/_action_td.blade.php ENDPATH**/ ?>