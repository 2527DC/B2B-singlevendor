<?php if(permissionCheck('order_manage.show_details')): ?>
    <div class="dropdown CRM_dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false"> <?php echo e(__('common.select')); ?>

        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
            <a href="<?php echo e(route('order_manage.show_details',$order->id)); ?>" class="dropdown-item" type="button"><?php echo e(__('common.details')); ?></a>
            <?php if($table == 'pending'): ?>
            <a href="<?php echo e(route('admin.order.confirm', $order->id)); ?>" class="dropdown-item" type="button"><?php echo e(__('common.confirm')); ?></a>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <button class="primary_btn_2" type="button"><?php echo e(__('common.you_don_t_have_this_permission')); ?></button>
<?php endif; ?>
<?php /**PATH /var/www/html/Production_dev/Modules/OrderManage/Resources/views/order_manage/components/_action_td.blade.php ENDPATH**/ ?>