<div class="white_box_50px box_shadow_white mb-40 min-height-430">
    <form action="POST" id="add_element_form">
        <div class="row">
            <input type="hidden" name="id" value="<?php echo e($header->id); ?>">
            <input type="hidden" id="create_header_type" value="<?php echo e($header->type); ?>">
            <?php if($type == 'category'): ?>
            <div class="col-lg-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for=""><?php echo e(__('common.category_list')); ?></label>
                    <select name="category[]" id="category" class="category mb-15" multiple>

                    </select>
                    <span class="text-danger"></span>
                </div>
            </div>
            <?php elseif($type == 'slider'): ?>
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
                                <div class="col-lg-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="name"><?php echo e(__('common.name')); ?> <span class="text-danger">*</span></label>
                                        <input class="primary_input_field" type="text" id="name<?php echo e($language->code); ?>" name="name[<?php echo e($language->code); ?>]" autocomplete="off" value="<?php echo e(old('name.'.$language->code)); ?>" placeholder="<?php echo e(__('common.name')); ?>">
                                    </div>
                                    <span class="text-danger" id="error_name_<?php echo e($language->code); ?>"></span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-lg-12">
                    <div class="primary_input mb-25">
                        <label class="primary_input_label" for="name"><?php echo e(__('common.name')); ?> <span class="text-danger">*</span></label>
                        <input class="primary_input_field" type="text" id="name" name="name" autocomplete="off" value="" placeholder="<?php echo e(__('common.name')); ?>">
                    </div>
                    <span class="text-danger" id="error_name"></span>
                </div>
            <?php endif; ?>
            <div class="col-lg-12" id="slider_data_type_div">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for=""><?php echo e(__('appearance.slider_for')); ?></label>
                    <select name="data_type" id="slider_for" class="primary_select mb-15">
                        <option value="" selected disabled><?php echo e(__('common.select_one')); ?></option>
                        <option value="product"><?php echo e(__('appearance.for_product')); ?></option>
                        <option value="category"><?php echo e(__('appearance.for_category')); ?></option>
                        <option value="brand"><?php echo e(__('appearance.for_brand')); ?></option>
                        <option value="tag"><?php echo e(__('appearance.for_tag')); ?></option>
                        <option value="url"><?php echo e(__('appearance.for_url_not_support_in_mobile_app')); ?></option>
                    </select>
                    <span class="text-danger" id="error_slider_data_type"></span>
                </div>
            </div>
            <div class="col-lg-12" id="slider_for_data_div">
            </div>
            <div class="col-xl-12 upload_photo_div">
                <div class="primary_input">
                    <label class="primary_input_label"><?php echo e(__('common.upload_photo')); ?> (<?php if(app('theme')->folder_path == 'default'): ?> <?php echo e(getNumberTranslate(660)); ?> X <?php echo e(getNumberTranslate(365)); ?> <?php else: ?> <?php echo e(getNumberTranslate(1920)); ?> X <?php echo e(getNumberTranslate(600)); ?> <?php endif; ?>) <?php echo e(__('common.px')); ?> <span class="text-danger">*</span></label>
                </div>
            </div>
            <div class="single_p col-xl-12 upload_photo_div">
                <div id="sliderImgFileDiv">
                    <div class="primary_input mb-25">
                        <div class="primary_file_uploader" data-toggle="amazuploader" data-multiple="false" data-type="image" data-name="slider_image_media">
                            <input class="primary-input file_amount" type="text" id="image" placeholder="<?php echo e(__('common.choose_images')); ?>" readonly="">
                            <button class="" type="button">
                                <label class="primary-btn small fix-gr-bg" for="thumbnail_image"><?php echo e(__('product.Browse')); ?> </label>
                                <input type="hidden" class="selected_files image_selected_files" value="">
                            </button>

                            <span class="text-danger"></span>

                        </div>
                        <div class="product_image_all_div">
                        </div>
                    </div>

                    

                </div>
                </div>
            <div class="col-lg-12">
                <div class="primary_input">
                    <label class="primary_input_label" for=""><?php echo e(__('common.status')); ?></label>
                    <ul id="theme_nav" class="permission_list sms_list ">
                        <li>
                            <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                <input name="status" id="status_active" value="1" checked="true" class="active"
                                    type="radio">
                                <span class="checkmark"></span>
                            </label>
                            <p><?php echo e(__('common.active')); ?></p>
                        </li>
                        <li>
                            <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                <input name="status" value="0" id="status_inactive" class="de_active" type="radio">
                                <span class="checkmark"></span>
                            </label>
                            <p><?php echo e(__('common.inactive')); ?></p>
                        </li>
                    </ul>
                    <span class="text-danger" id="status_error"></span>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="primary_input">
                    <ul id="theme_nav" class="permission_list sms_list ">
                        <li>
                            <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                <input name="is_newtab" id="is_newtab" value="1" checked type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <p><?php echo e(__('common.open_link_in_a_new_tab')); ?></p>
                        </li>
                    </ul>
                </div>
            </div>
            <?php elseif($type == 'product'): ?>
            <div class="col-lg-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for=""><?php echo e(__('appearance.product_list')); ?></label>
                    <select name="product[]" id="product" class=" product mb-15" multiple>
                    </select>
                    <span class="text-danger"></span>
                </div>
            </div>
            <?php endif; ?>
            <div class="col-xl-12 text-center">
                <button class="primary_btn_2 mt-5" id="widget_form_btn"><i
                        class="ti-check"></i><?php echo e(__('common.save')); ?>

                </button>
            </div>
        </div>
    </form>
</div>
<?php /**PATH /var/www/html/Production_dev/Modules/Appearance/Resources/views/header/components/create_element.blade.php ENDPATH**/ ?>