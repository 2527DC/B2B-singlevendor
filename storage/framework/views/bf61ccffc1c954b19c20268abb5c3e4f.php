<table class="table Crm_table_active3">
    <thead>
    <tr>
        <th scope="col"><?php echo e(__('common.sl')); ?></th>
        <th scope="col"><?php echo e(__('common.name')); ?></th>
        <th scope="col"><?php echo e(__('gst.rate')); ?> (%)</th>
        <th scope="col"><?php echo e(__('common.status')); ?></th>
        <th scope="col" width="10%"><?php echo e(__('common.action')); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $gst_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $gst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <th><?php echo e(getNumberTranslate($key+1)); ?></th>
            <td><?php echo e($gst->name); ?></td>
            <td><?php echo e(getNumberTranslate($gst->tax_percentage)); ?></td>
            <td>
                <?php if($gst->is_active == 1): ?>
                    <span class="badge_1"><?php echo e(__('common.active')); ?></span>
                <?php else: ?>
                    <span class="badge_4"><?php echo e(__('common.inactive')); ?></span>
                <?php endif; ?>
            </td>
            <td>
                <!-- shortby  -->
                <div class="dropdown CRM_dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo e(__('common.select')); ?>

                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                        <?php if(permissionCheck('gst_tax.update')): ?>
                            <a class="dropdown-item edit_gst" data-value="<?php echo e($gst); ?>" type="button"><?php echo e(__('common.edit')); ?></a>
                        <?php endif; ?>
                        <?php if(permissionCheck('gst_tax.destroy')): ?>
                            <a class="dropdown-item delete_gst" data-id="<?php echo e($gst->id); ?>"><?php echo e(__('common.delete')); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- shortby  -->
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH /var/www/DhatriProduction/Modules/GST/Resources/views/gst/gst_list.blade.php ENDPATH**/ ?>