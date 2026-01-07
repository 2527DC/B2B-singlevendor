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
                        <?php if(permissionCheck('refund.process_update')): ?>
                            <a class="dropdown-item edit_reason" data-value="<?php echo e($item); ?>" type="button"><?php echo e(__('common.edit')); ?></a>
                        <?php endif; ?>
                        <?php if(permissionCheck('refund.process_destroy')): ?>
                            <a class="dropdown-item delete-item" data-value="<?php echo e(route('refund.process_destroy', $item->id)); ?>"><?php echo e(__('common.delete')); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- shortby  -->
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Refund/Resources/views/admin/refund_process/process_list.blade.php ENDPATH**/ ?>