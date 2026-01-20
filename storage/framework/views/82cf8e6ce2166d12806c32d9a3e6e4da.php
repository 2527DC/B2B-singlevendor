<table class="table Crm_table_active3">
    <thead>
    <tr>
        <th scope="col"><?php echo e(__('common.sl')); ?></th>
        <th scope="col"><?php echo e(__('product.attribute_name')); ?></th>
        <th scope="col" width="60%"><?php echo e(__('common.description')); ?></th>
        <th scope="col"><?php echo e(__('common.status')); ?></th>
        <th scope="col"><?php echo e(__('common.action')); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $variant_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <th><?php echo e(getNumberTranslate($key+1)); ?></th>
            <td><?php echo e($variant_value->name); ?></td>
            <td><?php echo e($variant_value->description); ?></td>
            <td>
                <?php if($variant_value->status == 1): ?>
                    <span class="badge_1"><?php echo e(__("common.active")); ?></span>
                <?php else: ?>
                    <span class="badge_4"><?php echo e(__("common.inactive")); ?></span>
                <?php endif; ?>
            </td>
            <td>
                <!-- shortby  -->
                <div class="dropdown CRM_dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo e(__('common.select')); ?>

                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                         <a data-id="<?php echo e($variant_value->id); ?>" class="dropdown-item show_attribute"><?php echo e(__('common.view')); ?></a>
                         <?php if(permissionCheck('product.attribute.edit')): ?>
                             <a class="dropdown-item edit_variant" data-value="<?php echo e($variant_value->id); ?>" type="button"><?php echo e(__('common.edit')); ?></a>
                         <?php endif; ?>
                         <?php if(permissionCheck('product.attribute.destroy')): ?>
                             <a class="dropdown-item delete_attribute" data-value="<?php echo e(route('product.attribute.destroy', $variant_value->id)); ?>"><?php echo e(__('common.delete')); ?></a>
                         <?php endif; ?>
                    </div>
                </div>
                <!-- shortby  -->
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>
</table>
<?php /**PATH /var/www/DhatriProduction/Modules/Product/Resources/views/attributes/attributes_list.blade.php ENDPATH**/ ?>