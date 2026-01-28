<?php if($order->is_paid == 1): ?>
    <h6><span class="badge_1"><?php echo e(__('common.paid')); ?></span></h6>
<?php else: ?>
    <h6><span class="badge_4"><?php echo e(__('common.pending')); ?></span></h6>
<?php endif; ?>
<?php /**PATH /var/www/DhatriProduction/Modules/OrderManage/Resources/views/order_manage/components/_is_paid_td.blade.php ENDPATH**/ ?>