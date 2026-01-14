<h4><?php echo e(__('menu.available_menu_items')); ?></h4>
<div class="">
    <div class="row">
        <div class="col-xl-12">
            <!-- menu_setup_wrap  -->
            <div class="dd available_list">
                <div class="dd-list min-height-400 available-items-container" data-id="remove" data-section_id="remove" id="available_list">
                    
                    <!-- dd-item  -->
                    <?php if($unused_menus->count()): ?>
                        <?php $__currentLoopData = $unused_menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!$menu->backendMenu->module or isModuleActive($menu->backendMenu->module)): ?>
                                <?php if(permissionCheck($menu->backendMenu->route)): ?>
                                    <?php if(@$menu->backendMenu->route == 'payment_gateway.index' && auth()->user()->role->type == 'seller' && !app('general_setting')->seller_wise_payment): ?>
                                        <?php continue; ?>
                                    <?php endif; ?>
                                    <div class="dd-item listed_menu" data-id="<?php echo e($menu->id); ?>" data-parent_id= "<?php echo e($menu->parent_id); ?>">
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
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <span class=' empty_list'><?php echo e(__('menu.no_more_items_available')); ?></span>
                    <?php endif; ?>
                    
                </div>
            </div>
            <!--/ menu_setup_wrap  -->
        </div>
    </div>
</div><?php /**PATH /var/www/html/mytestdhatri/Modules/SidebarManager/Resources/views/components/available_list.blade.php ENDPATH**/ ?>