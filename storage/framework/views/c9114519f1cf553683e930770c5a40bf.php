<div class="">
    <!-- table-responsive -->
    <table class="table Crm_table_active3">
        <thead>
            <tr>
                <th scope="col" width="10%"><?php echo e(__('common.sl')); ?></th>
                <th scope="col" width="20%"><?php echo e(__('common.title')); ?></th>
                <th scope="col" width="20%"><?php echo e(__('common.slug')); ?></th>
                <th scope="col" width="20%"><?php echo e(__('common.page_link')); ?></th>
                <th scope="col" width="15%"><?php echo e(__('common.status')); ?></th>
                <th scope="col" width="15%"><?php echo e(__('common.action')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $pageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($item->module == 'Lead'): ?>
                    <?php continue; ?>
                <?php endif; ?>
                <tr>
                    <td><?php echo e(getNumberTranslate($key + 1)); ?></td>
                    <td><?php echo e($item->title); ?></td>
                    <td><?php echo e($item->slug); ?></td>
                    <td><a target="_blank" href="<?php echo e(url('/'.$item->slug)); ?>"><?php echo e(__('common.click_here')); ?></a></td>
                    <td>
                        <label class="switch_toggle" for="checkbox<?php echo e($item->id); ?>">
                            <input type="checkbox" id="checkbox<?php echo e($item->id); ?>" <?php echo e($item->status?'checked':''); ?> value="<?php echo e($item->id); ?>" data-value="<?php echo e($item); ?>" class="statusChange" <?php if(!permissionCheck('frontendcms.dynamic-page.status')): ?> disabled <?php endif; ?>>
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

                                <?php if(permissionCheck('frontendcms.dynamic-page.update')): ?>
                                    <a href="<?php echo e(route('frontendcms.dynamic-page.edit', $item->id)); ?>" class="dropdown-item edit_brand"><?php echo e(__('common.edit')); ?></a>
                                <?php endif; ?>
                                <?php if(permissionCheck('frontendcms.dynamic-page.delete')): ?>
                                    <a href="" class="dropdown-item delete_page" data-id="<?php echo e($item->id); ?>"><?php echo e(__('common.delete')); ?></a>
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
<?php /**PATH /var/www/DhatriProduction/Modules/FrontendCMS/Resources/views/dynamic_page/components/list.blade.php ENDPATH**/ ?>