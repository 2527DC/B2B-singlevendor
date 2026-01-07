<table class="table Crm_table_active3">
    <thead>
    <tr>
        <th scope="col"><?php echo e(__('common.sl')); ?></th>
        <th scope="col"><?php echo e(__('shipping.pickup_location')); ?></th>
        <th scope="col"><?php echo e(__('common.phone')); ?></th>
        <th scope="col"><?php echo e(__('common.address')); ?></th>
        <th scope="col"><?php echo e(__('shipping.pin_code')); ?></th>
        <th scope="col"><?php echo e(__('shipping.is_active')); ?></th>
        <th scope="col"><?php echo e(__('shipping.is_default')); ?></th>
        <th scope="col"><?php echo e(__('common.action')); ?></th>
    </tr>
    </thead>
    <tbody>
<?php if($pickup_locations): ?>
    <?php $__currentLoopData = $pickup_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <th><?php echo e(getNumberTranslate($key+1)); ?></th>
            <td><?php echo e($row->pickup_location); ?></td>

            <td><?php echo e(getNumberTranslate($row->phone)); ?></td>
            <td><?php echo e($row->address); ?></td>
            <td><?php echo e(getNumberTranslate($row->pin_code)); ?></td>
            <td>
                <label class="switch_toggle" for="active_checkbox<?php echo e($row->id); ?>">
                    <input type="checkbox" id="active_checkbox<?php echo e($row->id); ?>"
                           <?php if($row->status == 1): ?> checked <?php endif; ?> <?php if(permissionCheck('shipping.pickup_locations.status')): ?> class="status_change" value="<?php echo e($row->id); ?>" data-id="<?php echo e($row->id); ?>" <?php else: ?> disabled <?php endif; ?>>
                    <div class="slider round"></div>
                </label>
            </td>
            <td>
                <label class="switch_toggle" for="default_checkbox<?php echo e($row->id); ?>">
                    <input type="checkbox" id="default_checkbox<?php echo e($row->id); ?>"
                           <?php if($row->is_default == 1): ?> checked <?php endif; ?> <?php if(permissionCheck('shipping.pickup_locations.set_default')): ?> class="set_default" value="<?php echo e($row->id); ?>" data-id="<?php echo e($row->id); ?>" <?php else: ?> disabled <?php endif; ?>>
                    <div class="slider round"></div>
                </label>
            </td>
            <td>
                <div class="dropdown CRM_dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo e(__('common.select')); ?>

                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                        <?php if(permissionCheck('shipping.pickup_locations.show')): ?>
                            <a class="dropdown-item view_row" data-id="<?php echo e($row->id); ?>" type="button"><?php echo e(__('common.view')); ?></a>
                        <?php endif; ?>
                        <?php if(permissionCheck('shipping.pickup_locations.update')): ?>
                            <a class="dropdown-item edit_row" data-id="<?php echo e($row->id); ?>" type="button"><?php echo e(__('common.edit')); ?></a>
                        <?php endif; ?>
                        <?php if( permissionCheck('shipping.pickup_locations.destroy')): ?>
                            <a class="dropdown-item delete_row" data-id="<?php echo e($row->id); ?>"><?php echo e(__('common.delete')); ?></a>
                        <?php endif; ?>
                    </div>
                </div>

            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
    </tbody>
</table>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Shipping/Resources/views/pickup_locations/components/_list.blade.php ENDPATH**/ ?>