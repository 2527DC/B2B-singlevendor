<?php if(permissionCheck('customer.update_active_status')): ?>
<label class="switch_toggle" for="active_checkbox<?php echo e($customer->id); ?>">
    <input type="checkbox" id="active_checkbox<?php echo e($customer->id); ?>" <?php if($customer->is_active == 1): ?> checked <?php endif; ?> value="<?php echo e($customer->id); ?>" <?php if(!permissionCheck('customer.update_active_status')): ?> disabled <?php endif; ?> class="update_active_status" data-id="<?php echo e($customer->id); ?>">
    <div class="slider round"></div>
</label>
<?php endif; ?>
<?php /**PATH /var/www/html/Production_dev/Modules/Customer/Resources/views/customers/components/_status_td.blade.php ENDPATH**/ ?>