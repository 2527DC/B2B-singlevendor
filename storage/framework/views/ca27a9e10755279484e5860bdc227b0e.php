<table class="table Crm_table_active3">
    <thead>
        <tr>
            <th scope="col"><?php echo e(__('common.sl')); ?></th>
            <th scope="col"><?php echo e(__('common.name')); ?></th>
            <th scope="col"><?php echo e(__('common.type')); ?></th>
            <th scope="col"><?php echo e(__('common.location')); ?></th>
            <th scope="col"><?php echo e(__('common.status')); ?></th>
            <th scope="col"><?php echo e(__('common.action')); ?></th>
        </tr>
    </thead>
    <tbody id="mainTbody">

        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr data-id="<?php echo e($menu->id); ?>">
            <td><?php echo e(getNumberTranslate($key < 9?'0':'')); ?><?php echo e(getNumberTranslate($key + 1)); ?></td>
            <td><?php echo e($menu->name); ?></td>
            <td class="text-nowrap">
                <?php if($menu->menu_type == 'mega_menu'): ?>
                <?php echo e(__('menu.mega_menu')); ?>

                <?php elseif($menu->menu_type == 'multi_mega_menu'): ?>
                <?php echo e(__('menu.multi_mega_menu')); ?>

                <?php elseif($menu->menu_type == 'normal_menu'): ?>
                <?php echo e(__('menu.regular_menu')); ?>

                <?php endif; ?>
            </td>
            <td>
                <?php if($menu->menu_position == 'top_navbar'): ?>
                <?php echo e(__('menu.top_navbar')); ?>

                <?php elseif($menu->menu_position == 'navbar'): ?>
                <?php echo e(__('menu.navbar')); ?>

                <?php elseif($menu->menu_position == 'main_menu'): ?>
                <?php echo e(__('menu.main_menu')); ?>

                <?php endif; ?>
            </td>

            <td>
                <label class="switch_toggle" for="checkbox_<?php echo e($menu->id); ?>">
                    <input type="checkbox" id="checkbox_<?php echo e($menu->id); ?>" <?php echo e($menu->status == 1?'checked':''); ?> <?php if(!permissionCheck('menu.status')): ?> disabled <?php endif; ?> class="menu_status_change"  value="<?php echo e($menu->id); ?>" data-id="<?php echo e($menu->id); ?>">
                    <div class="slider round"></div>
                </label>
            </td>
            <td>

                <div class="dropdown CRM_dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button"
                            id="dropdownMenu2" data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                        <?php echo e(__('common.select')); ?>

                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                        <?php if(permissionCheck('menu.setup')): ?>
                            <a href="<?php echo e(route('menu.setup',$menu->id)); ?>" class="dropdown-item setup_menu"><?php echo e(__('common.setup')); ?></a>
                        <?php endif; ?>
                        <?php if(permissionCheck('menu.edit')): ?>
                            <?php if($menu->id > 2): ?>
                            <a data-id="<?php echo e(encrypt($menu->id)); ?>" class="dropdown-item edit_menu" ><?php echo e(__('common.edit')); ?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(permissionCheck('menu.delete')): ?>
                            <?php if($menu->id > 2): ?>
                            <a data-id="<?php echo e($menu->id); ?>" class="dropdown-item delete_menu" ><?php echo e(__('common.delete')); ?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>

            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>
</table>
<?php /**PATH /var/www/DhatriProduction/Modules/Menu/Resources/views/menu/components/list.blade.php ENDPATH**/ ?>