<div class="">
    <table class="table Crm_table_active3">
        <thead>
            <tr>
                <th scope="col"><?php echo e(__('common.sl')); ?></th>
                <th scope="col"><?php echo e(__('common.name')); ?></th>
                <th scope="col"><?php echo e(__('common.status')); ?></th>
                <th class="w_160"><?php echo e(__('common.action')); ?>

                </th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $QueryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(getNumberTranslate($key +1)); ?></td>
                    <td><?php echo e($item->name); ?></td>
                    <td>
                        <label class="switch_toggle" for="checkbox<?php echo e($item->id); ?>">
                            <input type="checkbox" id="checkbox<?php echo e($item->id); ?>" <?php echo e($item->status?'checked':''); ?> value="<?php echo e($item->id); ?>" data-value="<?php echo e($item); ?>" class="statusChange" <?php if(!permissionCheck('frontendcms.query.status')): ?> disabled <?php endif; ?>>
                            <div class="slider round"></div>
                        </label>
                    </td>
                    <td>
                        <div class="dropdown CRM_dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo e(__('common.select')); ?>

                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                <?php if(permissionCheck('frontendcms.query.update')): ?>
                                    <a href="" data-value="<?php echo e($item); ?>" class="dropdown-item edit_query"><?php echo e(__('common.edit')); ?></a>
                                <?php endif; ?>
                                <?php if(permissionCheck('frontendcms.query.delete')): ?>
                                    <a href="" class="dropdown-item delete_query" data-id="<?php echo e($item->id); ?>"><?php echo e(__('common.delete')); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php /**PATH /var/www/DhatriProduction/Modules/FrontendCMS/Resources/views/contact_content/components/query_list.blade.php ENDPATH**/ ?>