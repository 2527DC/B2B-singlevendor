<div class="row">
    <div class="col-lg-12">
        <table class="table Crm_table_active3">
            <thead>
                <tr>
                    <th scope="col" class=" text-center"><?php echo e(__('common.sl')); ?></th>
                    <th  scope="col" class=""><?php echo e(__('common.name')); ?></th>
                    <th  scope="col" class=""><?php echo e(__('appearance.column_size')); ?></th>
                    <th  scope="col" class=""><?php echo e(__('common.status')); ?></th>
                    <th  scope="col" class=""><?php echo e(__('common.action')); ?></th>
                </tr>
            </thead>
            <tbody id="sku_tbody">
                <?php $__currentLoopData = $headers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(getNumberTranslate($key + 1)); ?></td>
                        <td><?php echo e($header->name); ?></td>
                        <td><?php echo e(getNumberTranslate($header->column_size)); ?> zzz</td>
                        <td>
                            <label class="switch_toggle" for="checkbox<?php echo e($header->id); ?>">
                                <input type="checkbox" id="checkbox<?php echo e($header->id); ?>" <?php echo e($header->is_enable?'checked':''); ?> value="<?php echo e($header->id); ?>" <?php if(!permissionCheck('appearance.slider.update_status')): ?> disabled <?php endif; ?> class="update_active_status" data-id="<?php echo e($header->id); ?>">
                                <div class="slider round"></div>
                            </label>
                        </td>
                        <td>
                            <!-- shortby  -->
                            <div class="dropdown CRM_dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo e(__('common.select')); ?>

                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                    <?php if(permissionCheck('appearance.slider.setup')): ?>
                                        <a href="<?php echo e(route('appearance.slider.setup',$header->id)); ?>" class="dropdown-item edit_brand"><?php echo e(__('common.setup')); ?></a>
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
</div>
<?php /**PATH /var/www/html/Production_dev/Modules/Appearance/Resources/views/header/components/list.blade.php ENDPATH**/ ?>