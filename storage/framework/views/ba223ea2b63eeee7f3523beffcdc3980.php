<?php if($activity->type == 0): ?>
    <span class="badge_4"><?php echo e(__('common.error')); ?></span>
<?php elseif($activity->type == 1): ?>
    <span class="badge_1"><?php echo e(__('common.success')); ?></span>
<?php elseif($activity->type == 2): ?>
    <span class="badge_3"><?php echo e(__('common.warning')); ?></span>
<?php else: ?>
    <span class="badge_2"><?php echo e(__('common.info')); ?></span>
<?php endif; ?>
<?php /**PATH /var/www/html/mytestdhatri/Modules/UserActivityLog/Resources/views/components/_type_td.blade.php ENDPATH**/ ?>