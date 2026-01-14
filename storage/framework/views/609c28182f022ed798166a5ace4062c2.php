<h4><?php echo e(__('menu.menu_list')); ?></h4>
<div class="">
    <div class="row">
        <div class="col-xl-12 menu_item_div" id="itemDiv">
            <?php $__currentLoopData = $backendMenuUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="closed_section" data-id="<?php echo e($section->backendmenu_id); ?>">
                    <!-- menu_setup_wrap  -->
                    <div class="section_nav">
                        <h5><?php echo e(__($section->backendMenu->name)); ?></h5>
                        <div class="setting_icons">
                            <i class="ti-close delete_section" data-id="<?php echo e($section->id); ?>"></i>
                            <i class="ti-angle-up toggle_up_down"></i>
                        </div>
                    </div>
                    <div class="dd menu_list">
                        <?php if($section->children->count()): ?>
                        <div class="dd-list menu-list" data-id="<?php echo e($section->id); ?>" data-section_id="<?php echo e($section->backendmenu_id); ?>">
                            <?php $__currentLoopData = $section->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!$menu->backendMenu->module or isModuleActive($menu->backendMenu->module)): ?>
                                    <?php if(permissionCheck($menu->backendMenu->route)): ?>
                                        <?php if(@$menu->backendMenu->route == 'payment_gateway.index' && auth()->user()->role->type == 'seller' && !app('general_setting')->seller_wise_payment): ?>
                                            <?php continue; ?>
                                        <?php endif; ?>
                                        <!-- dd-item  -->
                                        <div class="dd-item listed_menu" data-id="<?php echo e($menu->id); ?>" data-parent_id="<?php echo e($section->id); ?>" data-section_id="<?php echo e($section->id); ?>">
                                            <div class="dd-handle">
                                                <div class="menu_icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move icon-16 text-off mr5"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                                                </div> 
                                                <?php echo e(__($menu->backendMenu->name)); ?>

                                            </div>
                                            <div class="edit_icon">
                                                <span class="make-sub-menu toggle-menu-icon">
                                                    <i class="ti-back-left"></i>
                                                </span>
                                                <i class="ti-close remove_menu"></i>
                                            </div>
                                        </div>
                                        <?php $__currentLoopData = $menu->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(app('theme')->folder_path == 'amazy'): ?>
                                                <?php if($submenu->backendMenu->route == 'frontendcms.features.index'): ?>
                                                    <?php continue; ?>
                                                <?php endif; ?>
                                            <?php elseif(app('theme')->folder_path == 'default'): ?>
                                                <?php if($submenu->backendMenu->route == 'frontendcms.ads_bar.index' || $submenu->backendMenu->route == 'frontendcms.promotionbar.index' || $submenu->backendMenu->route == 'frontendcms.login_page'): ?>
                                                    <?php continue; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if(@$submenu->backendMenu->route == 'payment_gateway.index' && auth()->user()->role->type == 'seller' && !app('general_setting')->seller_wise_payment): ?>
                                                <?php continue; ?>
                                            <?php endif; ?>
                                            <?php if(!$submenu->backendMenu->module or isModuleActive($submenu->backendMenu->module)): ?>
                                                <?php if(permissionCheck($submenu->backendMenu->route)): ?>
                                                <div class="dd-item listed_menu ml_20" data-id="<?php echo e($submenu->id); ?>" data-parent_id="<?php echo e($menu->id); ?>" data-section_id="<?php echo e($section->id); ?>">
                                                    <div class="dd-handle">
                                                        <div class="menu_icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move icon-16 text-off mr5"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                                                        </div> 
                                                        <?php echo e(__($submenu->backendMenu->name)); ?>

                                                    </div>
                                                    <div class="edit_icon">
                                                        <span class="make-root-menu toggle-menu-icon">
                                                            <i class="ti-back-right"></i>
                                                        </span>
                                                        <i class="ti-close remove_menu"></i>
                                                    </div>
                                                    
                                                </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>    
                                <?php endif; ?>    
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php else: ?>
                        <div class="dd-list menu-list" data-id="<?php echo e($section->id); ?>" data-section_id="<?php echo e($section->backendmenu_id); ?>">
                            <span class="empty_list"><?php echo e(__('menu.no_more_items_available')); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!--/ menu_setup_wrap  -->
        </div>
    </div>
</div><?php /**PATH /var/www/html/mytestdhatri/Modules/SidebarManager/Resources/views/components/components.blade.php ENDPATH**/ ?>