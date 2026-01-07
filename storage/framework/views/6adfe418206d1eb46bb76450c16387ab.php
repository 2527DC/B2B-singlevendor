<div class="">
<!-- table-responsive -->
    <table class="table Crm_table_active3">
        <thead>
            <tr>
                <th scope="col"><?php echo e(__('common.sl')); ?></th>
                <th scope="col"><?php echo e(__('common.name')); ?></th>
                <th scope="col"><?php echo e(__('common.details')); ?></th>
                <th scope="col"><?php echo e(__('common.status')); ?></th>
                <th scope="col"><?php echo e(__('common.action')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $DepartmentList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th><?php echo e(getNumberTranslate($key + 1)); ?></th>
                    <td><?php echo e($item->name); ?></td>
                    <td><?php echo e($item->details); ?></td>
                    <td>
                        <span class="<?php echo e($item->status == 1?'badge_1':'badge_2'); ?>"><?php echo e(showStatus($item->status)); ?></span>
                    </td>
                    <td>
                        <!-- shortby  -->
                        <div class="dropdown CRM_dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                    id="dropdownMenu2" data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                <?php echo e(__('common.select')); ?>

                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                <?php if(permissionCheck('departments.edit')): ?>
                                <a href="" class="dropdown-item edit_department" data-value="<?php echo e($item); ?>"><?php echo e(__('common.edit')); ?></a>
                                <?php endif; ?>

                                <?php if(permissionCheck('departments.delete')): ?>
                                <a href="" class="dropdown-item delete_department" data-id="<?php echo e($item->id); ?>"><?php echo e(__('common.delete')); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- shortby  -->
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Setup/Resources/views/department/components/list.blade.php ENDPATH**/ ?>