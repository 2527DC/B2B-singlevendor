<div class="main-title d-md-flex form_div_header">
    <h3 class="mb-3 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('product.add_category')); ?> </h3>
    <?php if(permissionCheck('product.bulk_category_upload_page')): ?>
        <ul class="d-flex">
            <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="<?php echo e(route('product.bulk_category_upload_page')); ?>"><i class="ti-plus"></i><?php echo e(__('product.bulk_category_upload')); ?></a></li>
        </ul>
    <?php endif; ?>
</div>
<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
<form method="POST" action="" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="add_category_form">
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
                                        <label class="primary_input_label" for="name">
                                            <?php echo e(__('common.name')); ?>

                                            <span class="text-danger">*</span>
                                        </label>
                                        <input class="primary_input_field name" type="text" id="name<?php echo e(auth()->user()->lang_code == $language->code?$language->code:''); ?>" name="name[<?php echo e($language->code); ?>]" autocomplete="off" placeholder="<?php echo e(__('common.name')); ?>">
                                        <span class="text-danger" id="error_name_<?php echo e($language->code); ?>"></span>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-lg-12">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="name">
                                <?php echo e(__('common.name')); ?>

                                <span class="text-danger">*</span>
                            </label>
                            <input class="primary_input_field name" type="text" id="name" name="name" autocomplete="off"  placeholder="<?php echo e(__('common.name')); ?>">
                            <span class="text-danger" id="error_name"></span>
                        </div>
                    </div>
                <?php endif; ?>
                    <div class="col-lg-12">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="slug">
                               <?php echo e(__('common.slug')); ?>

                                <span class="text-danger">*</span>
                            </label>
                            <input class="primary_input_field slug" type="text" id="slug" name="slug" autocomplete="off" placeholder="<?php echo e(__('common.slug')); ?>">
                            <span class="text-danger"  id="error_slug"></span>
                        </div>
                    </div>

                <?php if(isModuleActive('GoogleMerchantCenter')): ?>
                <div class="col-lg-12">
                    <div class="primary_input mb-25">
                        <label class="primary_input_label" for="name">
                            <?php echo e(__('product.google_product_category_id')); ?>

                        </label>
                        <input class="primary_input_field google_product_category_id" type="number" min="0" step="<?php echo e(step_decimal()); ?>" value="0" id="google_product_category_id" name="google_product_category_id" autocomplete="off"  placeholder="<?php echo e(__('product.google_product_category_id')); ?>">
                        <span class="text-danger" id="error_google_product_category_id"></span>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(isModuleActive('MultiVendor')): ?>
                <div class="col-lg-12">
                    <div class="primary_input mb-25">
                        <label class="primary_input_label" for="name">
                            <?php echo e(__('common.commission_rate')); ?>

                        </label>
                        <input class="primary_input_field commission_rate" type="number" min="0" step="<?php echo e(step_decimal()); ?>" value="0" id="commission_rate" name="commission_rate" autocomplete="off"  placeholder="<?php echo e(__('common.commission_rate')); ?>">
                        <span class="text-danger" id="error_commission_rate"></span>
                    </div>
                </div>
                <?php endif; ?>

                <div class="col-xl-12 mt-20">
                    <div class="primary_input">
                        <label class="primary_input_label" for=""><?php echo e(__('product.searchable')); ?></label>
                        <ul id="theme_nav" class="permission_list sms_list ">
                            <li>
                                <label data-id="bg_option" class="primary_checkbox d-flex mr-12 extra_width">
                                    <input name="searchable" id="searchable_active" value="1" checked="true"
                                        class="active" type="radio">
                                    <span class="checkmark"></span>
                                </label>
                                <p><?php echo e(__('common.active')); ?></p>
                            </li>
                            <li>
                                <label data-id="color_option" class="primary_checkbox d-flex mr-12 extra_width">
                                    <input name="searchable" id="searchable_inactive" value="0"
                                        class="de_active" type="radio">
                                    <span class="checkmark"></span>
                                </label>
                                <p><?php echo e(__('common.inactive')); ?></p>
                            </li>
                        </ul>
                        <span class="text-danger" id="error_searchable"></span>
                    </div>
                </div>
                 <div class="col-xl-12">
                    <div class="primary_input">
                        <label class="primary_input_label" for=""><?php echo e(__('common.status')); ?></label>
                        <ul id="theme_nav" class="permission_list sms_list ">
                            <li>
                                <label data-id="bg_option" class="primary_checkbox d-flex mr-12 extra_width">
                                    <input name="status" id="status_active" value="1" checked="true" class="active"
                                        type="radio">
                                    <span class="checkmark"></span>
                                </label>
                                <p><?php echo e(__('common.active')); ?></p>
                            </li>
                            <li>
                                <label data-id="color_option" class="primary_checkbox d-flex mr-12 extra_width">
                                    <input name="status" value="0" id="status_inactive" class="de_active" type="radio">
                                    <span class="checkmark"></span>
                                </label>
                                <p><?php echo e(__('common.inactive')); ?></p>
                            </li>
                        </ul>
                        <span class="text-danger" id="error_status"></span>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="primary_input">
                        <ul id="theme_nav" class="permission_list sms_list ">
                            <li>
                                <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                    <input class="in_sub_cat" name="category_type" id="sub_cat" value="subCategory" type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <p><?php echo e(__('product.add_as_sub_category')); ?></p>
                            </li>
                        </ul>
                        <span class="text-danger" id=""></span>
                    </div>
                </div>
                <div class="col-xl-12 d-none in_parent_div" id="sub_cat_div">
                    <div class="primary_input mb-25">
                        <label class="primary_input_label" for=""><?php echo e(__('product.parent_category')); ?> <span class="text-danger">*</span></label>
                        <select class="mb-25" name="parent_id" id="parent_id">
                            <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                        </select>
                        <span class="text-danger" id="error_parent_id"></span>
                    </div>
                </div>
                <div class="col-xl-12 upload_photo_div">
                    <div class="primary_input">
                        <label class="primary_input_label"><?php echo e(__('common.upload_photo')); ?> (<?php echo e(getNumberTranslate(225)); ?> X <?php echo e(getNumberTranslate(225)); ?>)<?php echo e(__('common.px')); ?></label>
                    </div>
                </div>

                <div class="single_p col-xl-12 upload_photo_div">


                    <div class="primary_input mb-25">
                        <div class="primary_file_uploader" data-toggle="amazuploader" data-multiple="false" data-type="image" data-name="category_image">
                            <input class="primary-input file_amount" type="text" id="image" placeholder="<?php echo e(__('common.choose_images')); ?>" readonly="">
                            <button class="" type="button">
                                <label class="primary-btn small fix-gr-bg" for="thumbnail_image"><?php echo e(__('product.Browse')); ?> </label>
                                <input type="hidden" class="selected_files image_selected_files" value="">
                            </button>
                            <?php if($errors->has('category_image')): ?>
                                <span class="text-danger"> <?php echo e($errors->first('category_image')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="product_image_all_div">
                        </div>
                    </div>
                </div>

                <div class="col-lg-12" id="icon_selector">
                    <div class="primary_input mb-25">
                        <label class="primary_input_label" for="icon">
                           <?php echo e(__('common.icon')); ?> (<?php echo e(__('product.to_use_themefy_icon_please_type_here_or_select_fontawesome_from_list')); ?>)
                        </label>
                        <input class="primary_input_field" type="text" id="icon" name="icon"
                        autocomplete="off" placeholder="<?php echo e(__('common.icon')); ?>">
                        <span class="text-danger"  id="error_icon"></span>
                    </div>
                </div>

            </div>
            <div class="row mt-40">
                <div class="col-lg-12 text-center">
                    <button id="create_btn" type="submit" class="primary-btn fix-gr-bg submit_btn" data-toggle="tooltip" data-original-title=""><span class="ti-check"></span><?php echo e(__('common.save')); ?> </button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php /**PATH /var/www/html/Production_dev/Modules/Product/Resources/views/category/components/create.blade.php ENDPATH**/ ?>