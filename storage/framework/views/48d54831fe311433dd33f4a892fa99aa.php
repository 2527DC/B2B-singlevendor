<table class="table Crm_table_active3">
    <thead>
    <tr>
        <th scope="col"><?php echo e(__('common.id')); ?></th>
        <th scope="col"><?php echo e(__('refund.process')); ?></th>
        <th scope="col"><?php echo e(__('refund.description')); ?></th>
        <th scope="col"><?php echo e(__('common.action')); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <th><?php echo e(getNumberTranslate($key+1)); ?></th>
            <td><?php echo e($item->name); ?></td>
            <td><?php echo e($item->description); ?></td>
            <td>
                <!-- shortby  -->
                <div class="dropdown CRM_dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo e(__('common.select')); ?>

                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                        <?php if(permissionCheck('order_manage.cancel_reason_update')): ?>
                            <a class="dropdown-item edit_reason" data-value="<?php echo e($item); ?>" type="button"><?php echo e(__('common.edit')); ?></a>
                        <?php else: ?>
                            <a class="dropdown-item" type="button"><?php echo e(__('common.not_editable')); ?></a>
                        <?php endif; ?>
                        <?php if(permissionCheck('order_manage.cancel_reason_destroy')): ?>
                        <a class="dropdown-item delete_item" data-value="<?php echo e(route('order_manage.cancel_reason_destroy', $item->id)); ?>"><?php echo e(__('common.delete')); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- shortby  -->
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH /var/www/html/mytestdhatri/Modules/OrderManage/Resources/views/cancel_reasons/reason_list.blade.php ENDPATH**/ ?>