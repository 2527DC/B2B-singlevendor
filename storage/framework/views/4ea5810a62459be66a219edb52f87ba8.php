<h4><?php echo e(__('appearance.live_preview')); ?></h4>
<div class="mt_30">
    <nav class="preview_menu_wrapper" >
        <ul id="previewMenu">
            <?php $__currentLoopData = $backendMenuUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $preview_section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="preview_section">
                    <?php echo e(__(@$preview_section->backendMenu->name)); ?>

                </li>
                <?php if($preview_section->children->count()): ?>
                    <?php $__currentLoopData = $preview_section->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $preview_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!$preview_menu->backendMenu->module or isModuleActive($preview_menu->backendMenu->module)): ?>

                            <?php if(permissionCheck($preview_menu->backendMenu->route)): ?>
                                <?php if(@$preview_menu->backendMenu->route == 'payment_gateway.index' && auth()->user()->role->type == 'seller' && !app('general_setting')->seller_wise_payment): ?>
                                    <?php continue; ?>
                                <?php endif; ?>
                                <li class="">
                                    <a href="javascript:;" class="<?php if($preview_menu->children->count()): ?> has-arrow <?php endif; ?>">
                                        <div class="nav_icon_small">
                                            <span class="<?php echo e($preview_menu->backendMenu->icon?$preview_menu->backendMenu->icon:'fas fa-users'); ?>"></span>
                                        </div>
                                        <div class="nav_title">
                                            <span><?php echo e(__(@$preview_menu->backendMenu->name)); ?></span>
                                        </div>
                                    </a>
                                    <?php if($preview_menu->children->count()): ?>
                                        <ul>
                                            <?php $__currentLoopData = $preview_menu->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $preview_submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(app('theme')->folder_path == 'amazy'): ?>
                                                    <?php if($preview_submenu->backendMenu->route == 'frontendcms.features.index'): ?>
                                                        <?php continue; ?>
                                                    <?php endif; ?>
                                                <?php elseif(app('theme')->folder_path == 'default'): ?>
                                                    <?php if($preview_submenu->backendMenu->route == 'frontendcms.ads_bar.index' || $preview_submenu->backendMenu->route == 'frontendcms.promotionbar.index' || $preview_submenu->backendMenu->route == 'frontendcms.login_page'): ?>
                                                        <?php continue; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if(@$preview_submenu->backendMenu->route == 'payment_gateway.index' && auth()->user()->role->type == 'seller' && !app('general_setting')->seller_wise_payment): ?>
                                                    <?php continue; ?>
                                                <?php endif; ?>
                                                <?php if(!$preview_submenu->backendMenu->module or isModuleActive($preview_submenu->backendMenu->module)): ?>
                                                    <?php if(permissionCheck($preview_submenu->backendMenu->route)): ?>
                                                        <li><a href="javascript:;"><?php echo e(__($preview_submenu->backendMenu->name)); ?></a></li>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </nav>
</div><?php /**PATH /var/www/html/mytestdhatri/Modules/SidebarManager/Resources/views/components/live_preview.blade.php ENDPATH**/ ?>