<div class="box_header common_table_header">
    <div class="main-title d-md-flex">
        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('product.edit_attribute')); ?></h3>
    </div>
</div>
<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
<form action="" method="POST" id="attributeEditForm">
    <div class="white_box_50px box_shadow_white mb-20">
        <div class="row">
            <input type="hidden" class="edit_id" value="<?php echo e($attribute->id); ?>">
            <?php if(isModuleActive('FrontendMultiLang')): ?>
            <div class="col-lg-12">
                <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                    <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item lang_code" data-id="<?php echo e($language->code); ?>">
                            <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#element<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <div class="tab-content">
                    <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="element<?php echo e($language->code); ?>">
                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('common.name')); ?> <span class="text-danger">*</span></label>
                                    <input name="name[<?php echo e($language->code); ?>]" class="primary_input_field name" placeholder="<?php echo e(__('common.name')); ?>" type="text" value="<?php echo e(isset($attribute)?$attribute->getTranslation('name',$language->code):old('name.'.$language->code)); ?>">
                                    <span class="text-danger" id="edit_name_<?php echo e($language->code); ?>_error"></span>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('common.description')); ?></label>
                                    <textarea class="primary_textarea height_112 description" placeholder="<?php echo e(__('common.description')); ?>" name="description[<?php echo e($language->code); ?>]" spellcheck="false"><?php echo e(isset($attribute)?$attribute->getTranslation('description',$language->code):old('description.'.$language->code)); ?></textarea>
                                    <span class="text-danger" id="edit_description_error"></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php else: ?>
            <div class="col-xl-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for=""><?php echo e(__('common.name')); ?> <span class="text-danger">*</span></label>
                    <input name="name" class="primary_input_field name" placeholder="<?php echo e(__('common.name')); ?>" type="text" value="<?php echo e($attribute->name); ?>">
                    <span class="text-danger" id="edit_name_error"></span>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for=""><?php echo e(__('common.description')); ?></label>
                    <textarea class="primary_textarea height_112 description" placeholder="<?php echo e(__('common.description')); ?>" name="description" spellcheck="false"><?php echo e($attribute->description); ?></textarea>
                    <span class="text-danger" id="edit_description_error"></span>
                </div>
            </div>
        <?php endif; ?>
            <div class="col-xl-12">
                <div class="primary_input">
                    <label class="primary_input_label" for=""><?php echo e(__('common.status')); ?> <span class="text-danger">*</span></label>
                    <ul id="theme_nav" class="permission_list sms_list ">
                        <li>
                            <label data-id="bg_option"
                                   class="primary_checkbox d-flex mr-12">
                                <input name="status" value="1" class="active" <?php echo e($attribute->status == 1?'checked':''); ?> type="radio">
                                <span class="checkmark"></span>
                            </label>
                            <p><?php echo e(__("common.active")); ?></p>
                        </li>
                        <li>
                            <label data-id="color_option"
                                   class="primary_checkbox d-flex mr-12">
                                <input name="status" value="0" class="de_active" <?php echo e($attribute->status == 0?'checked':''); ?>

                                       type="radio">
                                <span class="checkmark"></span>
                            </label>
                            <p><?php echo e(__("common.inactive")); ?></p>
                        </li>
                    </ul>
                    <span class="text-danger" id="edit_status_error"></span>
                </div>
            </div>
            <div class="col-lg-12">
                <strong><?php echo e(__("product.attribute_value")); ?> <span class="text-danger">*</span></strong>
                <div class="QA_section2 QA_section_heading_custom check_box_table">
                    <div class="QA_table mb_15">
                        <!-- table-responsive -->
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <?php if($attribute->id == 1): ?>
                                        <?php if(count($attribute->values) > 0): ?>
                                            <?php $__currentLoopData = $attribute->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($key === 0): ?>
                                                    <tr class="variant_edit_row_lists">
                                                        <td class="pl-0 pb-0 border-0 w-auto">
                                                            <input type='text' class='basic placeholder_input' name="edit_variant_values[]" id='basic' value='<?php echo e($items->value); ?>' />
                                                            <input type="hidden" name="color_with_id[]" value="<?php echo e($items->value); ?>-<?php echo e($items->id); ?>"/>
                                                        </td>
                                                        <td class="pl-0 pb-0 border-0">
                                                            <input type='text' class='placeholder_input' placeholder='<?php echo e(__('product.color_name')); ?>' name="edit_variant_c_name[]" value='<?php echo e($items->color->name); ?>' />
                                                        </td>
                                                        <td class="pl-0 pb-0 pr-0 border-0">
                                                            <div class="add_items_button pt-10">
                                                                <button type="button" class="primary-btn primary-circle add_color_variant_edit_row  fix-gr-bg">
                                                                    <i class="ti-plus"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php else: ?>
                                                    <tr class="variant_edit_row_lists">
                                                        <td class="pl-0 pb-0 border-0">
                                                        <input type='text' class='basic placeholder_input' name="edit_variant_values[]" id='basic' value='<?php echo e($items->value); ?>' />
                                                        <input type="hidden" name="color_with_id[]" value="<?php echo e($items->value); ?>-<?php echo e($items->id); ?>"/>
                                                        </td>
                                                        <td class="pl-0 pb-0 border-0">
                                                            <input type='text' class='placeholder_input' placeholder='<?php echo e(__('product.color_name')); ?>' name="edit_variant_c_name[]" value='<?php echo e($items->color->name); ?>' />
                                                        </td>
                                                        <td class="pl-0 pb-0 pr-0 remove_edit border-0">
                                                            <?php if(!$items->productVariation): ?>
                                                                <div class="items_min_icon "><i class="ti-trash"></i></div>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if(count($attribute->values) > 0): ?>
                                            <?php $__currentLoopData = $attribute->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($key == 0): ?>
                                                    <tr class="variant_edit_row_lists">
                                                        <td class="pl-0 pb-0 border-0">
                                                            <input class="placeholder_input" value="<?php echo e($items->value); ?>" placeholder="-" name="edit_variant_values[]" type="text">
                                                            <input type="hidden" class="d-none" name="value_id[]" value="<?php echo e($items->id); ?>">
                                                            <input type="hidden" class="d-none" name="value_with_id[]" value="<?php echo e($items->value); ?>-<?php echo e($items->id); ?>">
                                                        </td>
                                                        <td class="pl-0 pb-0 pr-0 border-0">
                                                            <div class="add_items_button pt-10">
                                                                <button type="button" class="primary-btn primary-circle add_single_variant_edit_row  fix-gr-bg">
                                                                    <i class="ti-plus"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php else: ?>
                                                    <tr class="variant_edit_row_lists">
                                                        <td class="pl-0 pb-0 border-0">
                                                            <input class="placeholder_input" value="<?php echo e($items->value); ?>" placeholder="-" name="edit_variant_values[]" type="text">
                                                            <input type="hidden" class="d-none" name="value_id[]" value="<?php echo e($items->id); ?>">
                                                            <input type="hidden" class="d-none" name="value_with_id[]" value="<?php echo e($items->value); ?>-<?php echo e($items->id); ?>">
                                                        </td>
                                                        <td class="pl-0 pb-0 pr-0 remove_edit border-0">
                                                            <?php if(!$items->productVariation): ?>
                                                            <div class="items_min_icon "><i class="ti-trash"></i></div>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                        <tr class="variant_edit_row_lists">
                                            <td class="pl-0 pb-0 border-0">
                                                <input class="placeholder_input" name="edit_variant_values[]" placeholder="-" type="text">
                                            </td>
                                            <td class="pl-0 pb-0 pr-0 border-0">
                                                <div class="add_items_button pt-10">
                                                    <button type="button" class="primary-btn radius_30px add_single_variant_edit_row  fix-gr-bg">
                                                        <i class="ti-plus"></i><?php echo e(__('product.add_value')); ?>

                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(permissionCheck('product.attribute.store')): ?>
                <div class="col-lg-12 text-center">
                    <div class="d-flex justify-content-center pt_20">
                        <button type="submit" class="primary-btn semi_large2  fix-gr-bg"
                                id="save_button_parent"><i
                                class="ti-check"></i><?php echo e(__('common.update')); ?>

                        </button>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-lg-12 mt-5 text-center">
                    <span class="alert alert-warning" role="alert">
                        <strong><?php echo e(__('common.you_don_t_have_this_permission')); ?></strong>
                    </span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</form>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Product/Resources/views/attributes/edit_attribute.blade.php ENDPATH**/ ?>