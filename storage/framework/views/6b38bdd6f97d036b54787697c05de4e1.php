
<?php if($order->is_cancelled == 1): ?>
    <h6><span class="badge_4"><?php echo e(__('common.cancelled')); ?></span></h6>
<?php elseif($order->is_completed == 1): ?>
    <h6><span class="badge_1"><?php echo e(__('common.completed')); ?></span></h6>
<?php else: ?>
    <?php if($order->is_confirmed == 1): ?>
        <h6><span class="badge_1"><?php echo e(__('common.confirmed')); ?></span></h6>
    <?php elseif($order->is_confirmed == 2): ?>
        <h6><span class="badge_4"><?php echo e(__('common.declined')); ?></span></h6>
    <?php else: ?>
        <h6><span class="badge_4"><?php echo e(__('common.pending')); ?></span></h6>
    <?php endif; ?>
<?php endif; ?><?php /**PATH /var/www/DhatriProduction/Modules/Customer/Resources/views/customers/components/_show_order_status_td.blade.php ENDPATH**/ ?>