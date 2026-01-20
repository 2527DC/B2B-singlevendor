<div class="main-title">
    <h3 class="mb-30">
        <?php echo e(__('menu.add_menu')); ?> </h3>
</div>
<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
<form method="POST" action="" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="create_form">
    <div class="white-box">
        <div class="add-visitor">
            <div class="row">
            <?php if(isModuleActive('FrontendMultiLang')): ?>
                <div class="col-lg-12">
                    <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                        <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item">
                                <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#element<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <div class="tab-content">
                        <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="element<?php echo e($language->code); ?>">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="name"><?php echo e(__('common.name')); ?><span class="text-danger">*</span></label>
                                        <input class="primary_input_field name" type="text" id="name<?php echo e($language->code); ?>" name="name[<?php echo e($language->code); ?>]" autocomplete="off" placeholder="<?php echo e(__('common.name')); ?>">
                                        <span class="text-danger" id="error_name_<?php echo e($language->code); ?>"></span>
                                    </div>
                                </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-lg-12">
                    <div class="primary_input mb-25">
                        <label class="primary_input_label" for="name"><?php echo e(__('common.name')); ?><span class="text-danger">*</span></label>
                        <input class="primary_input_field name" type="text" id="name" name="name" autocomplete="off" placeholder="<?php echo e(__('common.name')); ?>">
                        <span class="text-danger" id="error_name"></span>
                    </div>
                </div>
            <?php endif; ?>
                <div class="col-lg-12">
                    <div class="primary_input mb-25">
                        <label class="primary_input_label" for="slug"> <?php echo e(__('common.slug')); ?> <span class="text-danger">*</span></label>
                        <input class="primary_input_field slug" type="text" id="slug" name="slug" autocomplete="off" placeholder="<?php echo e(__('common.slug')); ?>">
                        <span class="text-danger"  id="error_slug"></span>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="primary_input mb-25">
                        <label class="primary_input_label" for="icon"> <?php echo e(__('common.icon')); ?> (<?php echo e(__('menu.use_themefy_or_fontawesome_icon')); ?>) </label>
                        <input class="primary_input_field icp" type="text" id="icon" name="icon" autocomplete="off" placeholder="ti-briefcase">
                        <span class="text-danger"  id="error_icon"></span>
                    </div>
                </div>
                 <div class="col-xl-12">
                    <div class="primary_input">
                        <label class="primary_input_label" for=""><?php echo e(__('common.status')); ?></label>
                        <ul id="theme_nav" class="permission_list sms_list ">
                            <li>
                                <label data-id="bg_option" class="primary_checkbox d-flex mr-12 extra_width">
                                    <input name="status" id="status_active" value="1" class="active" type="radio">
                                    <span class="checkmark"></span>
                                </label>
                                <p><?php echo e(__('common.active')); ?></p>
                            </li>
                            <li>
                                <label data-id="color_option" class="primary_checkbox d-flex mr-12 extra_width">
                                    <input name="status" value="0" id="status_inactive" checked="true" class="de_active" type="radio">
                                    <span class="checkmark"></span>
                                </label>
                                <p><?php echo e(__('common.inactive')); ?></p>
                            </li>
                        </ul>
                        <span class="text-danger" id="error_status"></span>
                    </div>
                </div>
                <div class="form-group col-xl-12 in_parent_div " id="menu_type_div">
                    <div class="primary_input mb-15">
                        <label class="primary_input_label" for=""><?php echo e(__('menu.menu_type')); ?> <span class="text-danger">*</span></label>
                        <select name="menu_type" id="menu_type" class="primary_select mb-15">
                            <option data-display="<?php echo e(__('menu.select_menu_type')); ?>" value=""><?php echo e(__('menu.select_menu_type')); ?></option>
                            <option value="multi_mega_menu"><?php echo e(__('menu.multi_mega_menu')); ?></option>
                            <option value="mega_menu"><?php echo e(__('menu.mega_menu')); ?></option>
                            <option value="normal_menu"><?php echo e(__('menu.regular_menu')); ?></option>
                        </select>
                        <span class="text-danger" id="error_menu_type"></span>
                    </div>
                </div>
                <div class="form-group col-xl-12 in_parent_div " id="display_position_div">
                    <div class="primary_input mb-15">
                        <label class="primary_input_label" for=""><?php echo e(__('menu.display_location')); ?> <span class="text-danger">*</span></label>
                        <select name="menu_position" id="menu_position" class="primary_select mb-15">
                            <option data-display="<?php echo e(__('menu.select_display_location')); ?>" value=""><?php echo e(__('menu.select_display_location')); ?></option>
                            <option value="top_navbar"><?php echo e(__('menu.top_bar')); ?></option>
                            <option value="main_menu"><?php echo e(__('menu.main_menu')); ?></option>
                        </select>
                        <span class="text-danger" id="error_menu_position"></span>
                    </div>
                </div>
            </div>
                <div class="row mt-40">
                        <div class="col-lg-12 text-center">
                            <button id="create_btn" type="submit" class="primary-btn fix-gr-bg submit_btn" data-toggle="tooltip" title="" data-original-title=""><span class="ti-check"></span><?php echo e(__('common.save')); ?> </button>
                        </div>
                </div>
        </div>
    </div>
</form>

<?php /**PATH /var/www/DhatriProduction/Modules/Menu/Resources/views/menu/components/create.blade.php ENDPATH**/ ?>