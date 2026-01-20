<table class="table Crm_table_active">
    <thead>
    <tr>
        <th scope="col"><?php echo e(__('common.sl')); ?></th>
        <th scope="col"><?php echo e(__('common.name')); ?></th>
        <th scope="col"><?php echo e(__('general_settings.activate')); ?></th>
        <th scope="col"><?php echo e(__('common.action')); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $carriers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e(getNumberTranslate( $key + 1)); ?></td>
            <td>
                <?php echo e($row->name); ?>

                <?php if(config('app.sync')): ?>
                    <?php if($row->slug == 'Shiprocket'): ?>
                        <span class="demo_addons">Addon</span>
                    <?php elseif($row->slug == 'Torod'): ?>
                       <span class="demo_addons">Addon</span>
                    <?php endif; ?>
                <?php endif; ?>
            </td>
            <?php if($row->slug == 'Shiprocket'): ?>
                <?php
                    $carrierConfig = $row->carrierConfig;
                ?>
                 <?php if($carrierConfig): ?>
                    <td class="text-left">
                        <label class="switch_toggle" for="checkbox<?php echo e($row->id); ?>">
                            <input data-carrier="<?php echo e($row->id); ?>" type="checkbox" id="checkbox<?php echo e($row->id); ?>" <?php if($row->carrierConfig->carrier_status == 1): ?> checked <?php endif; ?> <?php if(permissionCheck('shipping.carriers.status')): ?> value="<?php echo e($row->carrierConfig->id); ?>" class="carrier_activate" <?php else: ?> disabled <?php endif; ?>>
                            <div class="slider round"></div>
                        </label>
                    </td>
                <?php else: ?>
                    <td class="text-left">
                        <label class="switch_toggle disable_shiprocket" for="checkbox<?php echo e($row->id); ?>">
                            <input title="Carrier Config Done First" type="checkbox" id="checkbox<?php echo e($row->id); ?>"  class="carrier_dissable" disabled >
                            <div class="slider round"></div>
                        </label>
                    </td>
                <?php endif; ?>
            <?php else: ?>
                <td class="text-left">
                    <label class="switch_toggle" for="checkbox<?php echo e($row->id); ?>">
                        <input data-carrier="<?php echo e($row->id); ?>" type="checkbox" id="checkbox<?php echo e($row->id); ?>" <?php if($row->status == 1): ?> checked <?php endif; ?> <?php if(permissionCheck('shipping.carriers.status')): ?> value="<?php echo e($row->id); ?>" class="carrier_activate" <?php else: ?> disabled <?php endif; ?>>
                        <div class="slider round"></div>
                    </label>
                </td>
            <?php endif; ?>
            <td>
                <?php if($row->type != 'Automatic'): ?>
                <div class="dropdown CRM_dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo e(__('common.select')); ?>

                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">

                        <a href="#" data-id="<?php echo e($row->id); ?>" class="edit_carrier dropdown-item"><?php echo e(__('common.edit')); ?></a>
                        <?php if(permissionCheck('shipping.carrier.update')): ?>
                        <?php endif; ?>
                        <?php if(permissionCheck('shipping.carrier.destroy')): ?>
                        <?php endif; ?>
                        <a href="#" data-id="<?php echo e($row->id); ?>" class="delete_carrier dropdown-item"><?php echo e(__('common.delete')); ?></a>

                    </div>
                </div>
                <?php else: ?>
                <?php echo e(__('common.not_editable')); ?>

                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH /var/www/DhatriProduction/Modules/Shipping/Resources/views/carriers/list.blade.php ENDPATH**/ ?>