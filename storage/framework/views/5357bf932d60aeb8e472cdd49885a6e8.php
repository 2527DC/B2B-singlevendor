<table class="table Crm_table_active3">
    <thead>
    <tr>
        <th scope="col" width="5%"><?php echo e(__('common.id')); ?></th>
        <th scope="col" width="15%"><?php echo e(__('shipping.method_name')); ?></th>
        <th scope="col" width="10%"><?php echo e(__('shipping.is_active')); ?></th>
        <th scope="col" width="10%"><?php echo e(__('shipping.shipment_time')); ?></th>
        <th scope="col" width="15%"><?php echo e(__('shipping.carrier')); ?></th>
        <th scope="col" width="10%"><?php echo e(__('shipping.based_on')); ?></th>
        <th scope="col" width="10%"><?php echo e(__('shipping.min_shopping')); ?></th>
        <th scope="col" width="10%"><?php echo e(__('shipping.cost')); ?></th>
        <th scope="col" width="15%"><?php echo e(__('common.action')); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <th><?php echo e(getNumberTranslate($key+1)); ?></th>
            <td><?php echo e($method->method_name); ?></td>
            <td>
                <label class="switch_toggle" for="active_checkbox<?php echo e($method->id); ?>">
                    <input type="checkbox" id="active_checkbox<?php echo e($method->id); ?>" <?php if($method->is_active == 1): ?> checked <?php endif; ?> <?php if(permissionCheck('shipping_methods.update_status')): ?> class="status_change" value="<?php echo e($method->id); ?>" data-id="<?php echo e($method->id); ?>" <?php else: ?> disabled <?php endif; ?>>
                    <div class="slider round"></div>
                </label>
            </td>
            <td><?php echo e(getNumberTranslate($method->shipment_time)); ?></td>
            <td><?php echo e($method->carrier->name); ?></td>
            <td>
            <?php
                switch ($method->cost_based_on) {
                    case 'Price':
                    echo __('shipping.price');
                    break;
                    case 'Weight':
                    echo __('shipping.weight');
                    break;
                    case 'Flat':
                    echo __('shipping.flat');
                    break;
                }
            ?>
        </td>
            <td><?php echo e(single_price($method->minimum_shopping)); ?></td>
            <td><?php echo e(single_price($method->cost)); ?></td>
            <td>
                <div class="dropdown CRM_dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo e(__('common.select')); ?>

                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                        <?php if(permissionCheck('shipping_methods.update')): ?>
                            <a class="dropdown-item edit_method" data-id="<?php echo e($method->id); ?>" type="button"><?php echo e(__('common.edit')); ?></a>
                        <?php endif; ?>
                        <?php if($method->id > 1 && permissionCheck('shipping_methods.destroy')): ?>
                            <a class="dropdown-item delete_method" data-id="<?php echo e($method->id); ?>"><?php echo e(__('common.delete')); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH /var/www/DhatriProduction/Modules/Shipping/Resources/views/shipping_methods/components/_method_list.blade.php ENDPATH**/ ?>