<?php if($transaction->status == 1): ?>
    <span><?php echo e(__('common.approved')); ?></span>
<?php else: ?>
    <label class="switch_toggle" for="active_checkbox<?php echo e($transaction->id); ?>">
        <input type="checkbox" id="active_checkbox<?php echo e($transaction->id); ?>" <?php if($transaction->status == 1): ?> checked <?php endif; ?> value="<?php echo e($transaction->id); ?>" <?php if(permissionCheck('wallet_charge.update_status')): ?> data-id="<?php echo e($transaction->id); ?>" class="update_status" <?php else: ?> disabled <?php endif; ?>>
        <div class="slider round"></div>
    </label>
<?php endif; ?>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Wallet/Resources/views/backend/admin/components/_approval_td.blade.php ENDPATH**/ ?>