<div class="dropdown CRM_dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo e(__('common.select')); ?>

    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
        <?php if(permissionCheck('marketing.subscriber.delete')): ?>
            <a class="dropdown-item delete_subscription" data-id="<?php echo e($subscriber->id); ?>"><?php echo e(__('common.delete')); ?></a>
        <?php endif; ?>
        <?php if(!$subscriber->is_verified): ?>
            <a class="dropdown-item send_verification_link" data-id="<?php echo e($subscriber->id); ?>"><?php echo e(__('marketing.Send verify link')); ?></a>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Marketing/Resources/views/subscribers/components/_action_td.blade.php ENDPATH**/ ?>