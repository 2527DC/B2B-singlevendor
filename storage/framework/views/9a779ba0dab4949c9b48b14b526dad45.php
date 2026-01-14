<table id="lms_table" class="table Crm_table_active3">
    <thead>
    <tr>
        <th><?php echo e(__('page-builder.SL')); ?></th>
        <th><?php echo e(__('page-builder.Title')); ?></th>
        <th><?php echo e(__('page-builder.Slug')); ?></th>
        <th><?php echo e(__('page-builder.Status')); ?></th>
        <th><?php echo e(__('common.action')); ?></th>

    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(app('theme')->folder_path == 'default' && $row->slug == 'about-us' || $row->slug == 'about-us' && !permissionCheck('frontendcms.about-us.index')): ?>
            <?php continue; ?>
        <?php endif; ?>
        <tr>
            <td><?php echo e($loop->iteration); ?></td>
            <td><?php echo e($row->title); ?></td>
            <td><?php echo e($row->slug); ?></td>
            <td>
                <label class="switch_toggle" for="checkbox<?php echo e($row->id); ?>">
                    <input type="checkbox" id="checkbox<?php echo e($row->id); ?>" data-id="<?php echo e($row->id); ?>" class="status_change" <?php echo e($row->status ? 'checked' : ''); ?> value="<?php echo e($row->id); ?>">
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
                        <?php if(permissionCheck('page_builder.pages.design.update')): ?>
                            <a href="<?php echo e(route('page_builder.pages.design',$row->id)); ?>" class="dropdown-item"><?php echo e(__('page-builder.Design')); ?></a>
                        <?php endif; ?>
                        <?php if(permissionCheck('page_builder.pages.show')): ?>
                            <a href="<?php echo e(route('page_builder.pages.show',$row->id)); ?>" class="dropdown-item"><?php echo e(__('common.view')); ?></a>
                        <?php endif; ?>
                        <?php if(permissionCheck('page_builder.pages.update')): ?>
                            <a href="#" class="dropdown-item edit_row" data-url="<?php echo e(route('page_builder.pages.edit',$row->id)); ?>"><?php echo e(__('common.edit')); ?></a>
                        <?php endif; ?>
                        <?php if(permissionCheck('page_builder.pages.destroy')): ?>
                            <?php if($row->slug == 'about-us' || $row->slug == 'affiliate'): ?>
                            <?php else: ?>
                                <a href="#" class="dropdown-item delete_row" data-url="<?php echo e(route('page_builder.pages.deleteModal',$row->id)); ?>" type="button"><?php echo e(__('common.delete')); ?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH /var/www/html/mytestdhatri/Modules/AoraPageBuilder/Resources/views/pages/list.blade.php ENDPATH**/ ?>