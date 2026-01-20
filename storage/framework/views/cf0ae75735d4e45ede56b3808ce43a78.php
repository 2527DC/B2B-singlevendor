<table class="table Crm_table_active3">
    <thead>
    <tr>
        <th scope="col"><?php echo e(__('common.sl')); ?></th>
        <th scope="col"><?php echo e(__('common.name')); ?></th>
        <th scope="col"><?php echo e(__('common.status')); ?></th>
        <th scope="col" width="10%"><?php echo e(__('common.action')); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <th><?php echo e(getNumberTranslate( $key+1)); ?></th>
            <td><?php echo e($unit->name); ?></td>
            <td>
                <?php if($unit->status == 1): ?>
                    <span class="badge_1"><?php echo e(__('common.active')); ?></span>
                <?php else: ?>
                    <span class="badge_4"><?php echo e(__('common.inactive')); ?></span>
                <?php endif; ?>
            </td>
            <td>
                <?php if(permissionCheck('product.units.update') || permissionCheck('product.units.destroy')): ?>
                    <!-- shortby  -->
                    <div class="dropdown CRM_dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo e(__('common.select')); ?>

                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                            <a data-id="<?php echo e($unit->id); ?>" class="dropdown-item copy_id"><?php echo e(__('product.Copy ID')); ?></a>
                            <?php if(permissionCheck('product.units.update')): ?>
                                <a class="dropdown-item edit_unit" data-value="<?php echo e($unit); ?>" type="button"><?php echo e(__('common.edit')); ?></a>
                            <?php endif; ?>
                            <?php if(permissionCheck('product.units.destroy')): ?>
                                <a class="dropdown-item delete_unit" data-value="<?php echo e(route('product.units.destroy', $unit->id)); ?>"><?php echo e(__('common.delete')); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- shortby  -->
                <?php else: ?>
                    <button class="primary_btn_2" type="button">

                        <?php echo e(__('common.you_don_t_have_this_permission')); ?>

                    </button>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH /var/www/DhatriProduction/Modules/Product/Resources/views/units/units_list.blade.php ENDPATH**/ ?>