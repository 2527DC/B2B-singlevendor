<!-- shortby  -->
<div class="dropdown CRM_dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo e(__('common.select')); ?>

    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
        <a href="<?php echo e(route('checkpincode.edit', $checkPincodes->id)); ?>" class="dropdown-item product_detail" data-id="<?php echo e($checkPincodes->id); ?>"><?php echo e(__('common.edit')); ?></a>
        <button class="dropdown-item product_detail delete_pincode" data-id="<?php echo e($checkPincodes->id); ?>"><?php echo e(__('common.delete')); ?></button> 
    </div>
</div>
<!-- shortby  -->
<?php /**PATH /var/www/html/mytestdhatri/Modules/CheckPincode/Resources/views/component/_projectPincodeAction.blade.php ENDPATH**/ ?>