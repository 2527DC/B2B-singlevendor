<?php
    $processes = \Modules\OrderManage\Entities\DeliveryProcess::all();
?>
<div class="d-flex align-items-center ml-4">
    <select class="primary_select bulk_delivery_status mr-2" style="min-width: 150px;">
        <option value=""><?php echo e(__('common.select_action')); ?></option>
         <?php $__currentLoopData = $processes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $process): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($process->id); ?>"><?php echo e($process->name); ?></option>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <button class="primary_btn_2 small_btn apply_bulk_action_btn"><?php echo e(__('common.apply')); ?></button>
</div>
<?php /**PATH /var/www/html/Production_dev/Modules/OrderManage/Resources/views/order_manage/components/_bulk_action_ui.blade.php ENDPATH**/ ?>