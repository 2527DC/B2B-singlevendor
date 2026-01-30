<div class="modal fade admin-query" id="create_category_modal">
    <div class="modal-dialog modal_1000px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo e(__('common.create_category')); ?></h4>
                <button type="button" class="close " data-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>
            <?php if(isModuleActive('FrontendMultiLang')): ?>
            <?php
            $LanguageList = getLanguageList();
            ?>
            <?php endif; ?>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data" id="add_category_form">
                    <div class="row">
                        <input type="hidden" name="form_type" value="modal_form">

                        <?php if(isModuleActive('FrontendMultiLang')): ?>
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#element<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <div class="tab-content">
                                <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="element<?php echo e($language->code); ?>">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label" for="name">
                                                <?php echo e(__('common.name')); ?>

                                                <span class="text-danger">*</span>
                                            </label>
                                            <input class="primary_input_field name" type="text" id="category_name<?php echo e(auth()->user()->lang_code == $language->code?$language->code:''); ?>" name="name[<?php echo e($language->code); ?>]"
                                                autocomplete="off" placeholder="<?php echo e(__('common.name')); ?>">
                                            <span class="text-danger" id="error_category_name"></span>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php else: ?>
  
                    <div class="col-lg-6">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="name">
                                <?php echo e(__('common.name')); ?>

                                <span class="text-danger">*</span>
                            </label>
                            <input class="primary_input_field name" type="text" id="category_name" name="name"
                                autocomplete="off" placeholder="<?php echo e(__('common.name')); ?>">
                            <span class="text-danger" id="error_category_name"></span>
                        </div>
                    </div>
                    <?php endif; ?>

                        <div class="col-lg-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="slug">
                                    <?php echo e(__('common.slug')); ?>

                                    <span class="text-danger">*</span>
                                </label>
                                <input class="primary_input_field slug" type="text" id="category_slug" name="slug"
                                    autocomplete="off" placeholder="<?php echo e(__('common.slug')); ?>">
                                <span class="text-danger" id="error_category_slug"></span>
                            </div>

                        </div>

                        <?php if(isModuleActive('MultiVendor')): ?>
                        <div class="col-lg-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="commission_rate">
                                    <?php echo e(__('common.commission_rate')); ?>

                                </label>
                                <input class="primary_input_field commission_rate" type="number" min="0" step="<?php echo e(step_decimal()); ?>"
                                    value="0" id="category_commission_rate" name="commission_rate" autocomplete="off"
                                    placeholder="<?php echo e(__('common.commission_rate')); ?>">
                                <span class="text-danger" id="error_category_commission_rate"></span>
                            </div>

                        </div>
                        <?php endif; ?>

                        <div class="col-lg-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="icon">
                                    <?php echo e(__('common.icon')); ?>

                                </label>
                                <input class="primary_input_field" type="text" id="icon" name="icon" autocomplete="off"
                                    placeholder="<?php echo e(__('common.icon')); ?>">
                                <span class="text-danger" id="error_category_icon"></span>
                            </div>

                        </div>

                        <div class="col-xl-6 mt-20">
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
                                <span class="text-danger" id="error_category_searchable"></span>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="primary_input">
                                <label class="primary_input_label" for=""><?php echo e(__('common.status')); ?></label>
                                <ul id="theme_nav" class="permission_list sms_list ">
                                    <li>
                                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12 extra_width">
                                            <input name="status" id="category_status_active" value="1" checked="true"
                                                class="active" type="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p><?php echo e(__('common.active')); ?></p>
                                    </li>
                                    <li>
                                        <label data-id="color_option" class="primary_checkbox d-flex mr-12 extra_width">
                                            <input name="status" value="0" id="category_status_inactive"
                                                class="de_active" type="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p><?php echo e(__('common.inactive')); ?></p>
                                    </li>
                                </ul>
                                <span class="text-danger" id="error_category_status"></span>
                            </div>
                        </div>


                        <div class="col-xl-12">
                            <div class="primary_input">
                                <ul id="theme_nav" class="permission_list sms_list ">
                                    <li>
                                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                            <input class="in_sub_cat" name="category_type" id="sub_cat"
                                                value="subCategory" type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p><?php echo e(__('product.add_as_sub_category')); ?></p>
                                    </li>
                                </ul>
                                <span class="text-danger" id=""></span>
                            </div>
                        </div>


                        <div class="single_p col-xl-6 upload_photo_div" id="category_image_div">
                            <label class="primary_input_label" for=""><?php echo e(__('common.upload_photo')); ?>

                                (<?php echo e(__('common.file_less_than_1MB')); ?>)</label>

                            <div class="primary_input mb-25">
                                <div class="primary_file_uploader">
                                    <input class="primary-input" type="text" id="image_file"
                                        placeholder="<?php echo e(__('common.browse_image_file')); ?>" readonly="">
                                    <button class="" type="button">
                                        <label class="primary-btn small fix-gr-bg" for="image"><?php echo e(__("common.browse")); ?>

                                        </label>
                                        <input type="file" class="d-none" name="image" id="image">
                                    </button>
                                </div>


                                <span class="text-danger" id="error_category_image"></span>

                            </div>

                        </div>

                        <div class="col-lg-6 upload_photo_div">
                            <div id="category_image_preview_div">
                                <img id="catImgShow" src="<?php echo e(showImage('backend/img/default.png')); ?>" alt="">
                            </div>
                        </div>

                        <div class="col-xl-6 d-none in_parent_div" id="sub_cat_div">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for=""><?php echo e(__('product.parent_category')); ?> <span
                                        class="text-danger">*</span></label>
                                <select class="mb-25" name="parent_id" id="parent_id">
                                    <?php if(isset($first_category) && $first_category != null): ?>
                                        <option value="<?php echo e($first_category->id); ?>" selected><?php echo e($first_category->name); ?></option>
                                    <?php endif; ?>
                                </select>

                                <span class="text-danger"></span>

                            </div>
                        </div>

                    </div>
                    <div class="row mt-40 justify-content-center">
                        <div class="col-lg-12 text-center">
                            <button id="create_btn" type="submit" class="primary-btn fix-gr-bg submit_btn"
                                data-toggle="tooltip" title="" data-original-title="">
                                <span class="ti-check"></span>
                                <?php echo e(__('common.save')); ?> </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/Production_dev/Modules/Product/Resources/views/products/components/_create_category_modal.blade.php ENDPATH**/ ?>