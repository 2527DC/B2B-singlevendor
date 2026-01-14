<div class="single_role_blocks">

    <?php
        // SAFE module name (avoid array issues)
        $moduleName = is_array(__($Module->translation ?? $Module->name))
            ? ($Module->name ?? '')
            : __($Module->translation ?? $Module->name);
    ?>

    <div class="single_permission" id="<?php echo e($Module->id); ?>">
        <div class="permission_header d-flex align-items-center justify-content-between">
            <div>
                <input
                    type="checkbox"
                    name="module_id[]"
                    value="<?php echo e($Module->id); ?>"
                    id="Main_Module_<?php echo e($key); ?>"
                    class="common-radio permission-checkAll main_module_id_<?php echo e($Module->id); ?>"
                    <?php echo e($role->permissions->contains('id', $Module->id) ? 'checked' : ''); ?>

                >
                <label for="Main_Module_<?php echo e($key); ?>">
                    <?php echo e($moduleName); ?>

                </label>
            </div>

            <div class="arrow collapsed"
                 data-toggle="collapse"
                 data-target="#Role<?php echo e($Module->id); ?>">
            </div>
        </div>

        <div id="Role<?php echo e($Module->id); ?>" class="collapse">
            <div class="permission_body">
                <ul>

                    <?php $__currentLoopData = $SubMenuList->where('parent_id', $Module->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $SubMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        
                        <?php if(isModuleActive('MultiVendor') && $SubMenu->name === 'Company Reviews'): ?>
                            <?php continue; ?>
                        <?php endif; ?>

                        <?php if(app('theme')->folder_path === 'amazy'): ?>
                            <?php if($SubMenu->route === 'frontendcms.features.index'): ?>
                                <?php continue; ?>
                            <?php endif; ?>
                        <?php elseif(app('theme')->folder_path === 'default'): ?>
                            <?php if(
                                $SubMenu->route === 'frontendcms.ads_bar.index' ||
                                $SubMenu->route === 'frontendcms.promotionbar.index' ||
                                $SubMenu->route === 'frontendcms.login_page'
                            ): ?>
                                <?php continue; ?>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if(!$SubMenu->module || isModuleActive($SubMenu->module)): ?>

                            <?php
                                // SAFE submenu label
                                $subMenuLabel = is_array(__($SubMenu->translation ?? $SubMenu->name))
                                    ? ($SubMenu->name ?? '')
                                    : __($SubMenu->translation ?? $SubMenu->name);
                            ?>

                            <li>
                                <div class="submodule">
                                    <input
                                        id="Sub_Module_<?php echo e($SubMenu->id); ?>"
                                        name="module_id[]"
                                        value="<?php echo e($SubMenu->id); ?>"
                                        class="infix_csk common-radio module_id_<?php echo e($Module->id); ?> module_link"
                                        <?php echo e($role->permissions->contains('id', $SubMenu->id) ? 'checked' : ''); ?>

                                        type="checkbox"
                                    >

                                    <label for="Sub_Module_<?php echo e($SubMenu->id); ?>">
                                        <?php if($SubMenu->name === 'Seller Reviews'): ?>
                                            <?php echo e(isModuleActive('MultiVendor')
                                                ? __('Seller Reviews')
                                                : __('review.company_reviews')); ?>

                                        <?php elseif($SubMenu->name === 'Inhouse Product Sale'): ?>
                                            <?php echo e(isModuleActive('MultiVendor')
                                                ? $subMenuLabel
                                                : __('product.product_sale')); ?>

                                        <?php else: ?>
                                            <?php echo e($subMenuLabel); ?>

                                        <?php endif; ?>
                                    </label>
                                    <br>
                                </div>

                                <ul class="option">
                                    <?php $__currentLoopData = $ActionList->where('parent_id', $SubMenu->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php if(!$action->module || isModuleActive($action->module)): ?>

                                            <?php
                                                // SAFE action name
                                                $actionName = is_array(__($action->translation ?? $action->name))
                                                    ? ($action->name ?? '')
                                                    : __($action->translation ?? $action->name);
                                            ?>

                                            <li>
                                                <div class="module_link_option_div" id="<?php echo e($SubMenu->id); ?>">
                                                    <input
                                                        id="Option_<?php echo e($action->id); ?>"
                                                        name="module_id[]"
                                                        value="<?php echo e($action->id); ?>"
                                                        class="infix_csk common-radio
                                                               module_id_<?php echo e($Module->id); ?>

                                                               module_option_<?php echo e($Module->id); ?>_<?php echo e($SubMenu->id); ?>

                                                               module_link_option"
                                                        <?php echo e($role->permissions->contains('id', $action->id) ? 'checked' : ''); ?>

                                                        type="checkbox"
                                                    >

                                                    <label for="Option_<?php echo e($action->id); ?>">
                                                        <?php echo e($actionName); ?>

                                                    </label>
                                                    <br>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>

                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/mytestdhatri/Modules/RolePermission/Resources/views/page-components/permissionModule.blade.php ENDPATH**/ ?>