<div class="modal fade admin-query" id="create_brand_modal">
    <div class="modal-dialog modal_1000px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo e(__('product.create_brand')); ?></h4>
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
                <form action="" method="POST" enctype="multipart/form-data" id="create_brand_form">
                    <div class="row">
                        <input type="hidden" name="form_type" value="modal_form">
                        <div class="col-lg-8">
                            <div class="white_box_50px box_shadow_white mb-20">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="main-title d-flex">
                                            <h3 class="mb-2 mr-30"><?php echo e(__('product.brand_info')); ?></h3>
                                        </div>
                                    </div>
                                <?php if(isModuleActive('FrontendMultiLang')): ?>
                                    <div class="col-lg-12">
                                        <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="nav-item">
                                                    <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#belement<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                        <div class="tab-content">
                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="belement<?php echo e($language->code); ?>">
                                                    <div class="col-lg-12">
                                                        <div class="primary_input mb-15">
                                                            <label class="primary_input_label" for=""> <?php echo e(__("common.name")); ?> <span class="text-danger">*</span></label>
                                                            <input class="primary_input_field" name="name[<?php echo e($language->code); ?>]" placeholder="<?php echo e(__("common.name")); ?>" type="text" value="<?php echo e(old('name')); ?>">
                                                            <span class="text-danger" id="error_brand_name"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12" id="brand_des_div">
                                                        <div class="primary_input mb-15">
                                                            <label class="primary_input_label" for=""> <?php echo e(__("common.description")); ?> </label>
                                                            <textarea class="summernote" name="description[<?php echo e($language->code); ?>]"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="col-lg-12">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label" for=""> <?php echo e(__("common.name")); ?> <span class="text-danger">*</span></label>
                                            <input class="primary_input_field" name="name" placeholder="<?php echo e(__("common.name")); ?>" type="text" value="<?php echo e(old('name')); ?>">
                                            <span class="text-danger" id="error_brand_name"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12" id="brand_des_div">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label" for=""> <?php echo e(__("common.description")); ?> </label>
                                            <textarea class="summernote" name="description"></textarea>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                    <div class="col-lg-12">
                                        <div class="primary_input mb-30">
                                            <label class="primary_input_label" for=""> <?php echo e(__("product.website_link")); ?></label>
                                            <input class="primary_input_field" name="link" placeholder="<?php echo e(__("product.website_link")); ?>" type="text" value="<?php echo e(old('link')); ?>">
                                            <span class="text-danger" id="error_brand_link"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="main-title d-flex">
                                            <h3 class="mb-2 mr-30"><?php echo e(__('common.seo_info')); ?></h3>
                                        </div>
                                    </div>
                                <?php if(isModuleActive('FrontendMultiLang')): ?>
                                    <div class="col-lg-12">
                                        <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="nav-item">
                                                    <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#bmelement<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                        <div class="tab-content">
                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="bmelement<?php echo e($language->code); ?>">
                                                    <div class="col-lg-12">
                                                        <div class="primary_input mb-15">
                                                            <label class="primary_input_label" for=""> <?php echo e(__("common.meta_title")); ?></label>
                                                            <input class="primary_input_field" name="meta_title[<?php echo e($language->code); ?>]" placeholder="<?php echo e(__("common.meta_title")); ?>" type="text" value="<?php echo e(old('meta_title.'.$language->code)); ?>">
                                                            <span class="text-danger" id="error_brand_meta_title"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="primary_input mb-15">
                                                            <label class="primary_input_label" for=""> <?php echo e(__("common.meta_description")); ?></label>
                                                            <textarea class="primary_textarea height_112 meta_description" placeholder="<?php echo e(__('common.meta_description')); ?>" name="meta_description[<?php echo e($language->code); ?>]" spellcheck="false"> <?php echo e(old('meta_description.'.$language->code)); ?></textarea>
                                                            <span class="text-danger" id="error_brand_meta_description"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="col-lg-12">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label" for=""> <?php echo e(__("common.meta_title")); ?></label>
                                            <input class="primary_input_field" name="meta_title" placeholder="<?php echo e(__("common.meta_title")); ?>" type="text" value="<?php echo e(old('meta_title')); ?>">
                                            <span class="text-danger" id="error_brand_meta_title"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label" for=""> <?php echo e(__("common.meta_description")); ?></label>
                                            <textarea class="primary_textarea height_112 meta_description" placeholder="<?php echo e(__('common.meta_description')); ?>" name="meta_description" spellcheck="false"></textarea>
                                            <span class="text-danger" id="error_brand_meta_description"></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="white_box_50px box_shadow_white p-15">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="main-title d-flex">
                                            <h3 class="mb-2 mr-30"><?php echo e(__('common.status_info')); ?></h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label" for=""><?php echo e(__('common.status')); ?> <span class="text-danger">*</span></label>
                                            <select class="primary_select mb-25" name="status" id="brand_status">
                                                <option value="1"><?php echo e(__('common.publish')); ?></option>
                                                <option value="0"><?php echo e(__('common.pending')); ?></option>
                                            </select>

                                            <span class="text-danger" id="error_brand_status"></span>

                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="main-title d-flex">
                                            <h3 class="mb-2 mr-30"><?php echo e(__('common.logo')); ?> (150x150)PX</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-4" id="brand_logo_preview_div">
                                        <div class="brand_img_div">
                                            <img id="logoImg" src="<?php echo e(showImage('backend/img/default.png')); ?>" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12" id="brand_logo_img_div">
                                        <div class="primary_input mb-25">
                                            <div class="primary_file_uploader">
                                              <input class="primary-input" type="text" id="logo_file" placeholder="<?php echo e(__('common.browse_image_file')); ?>" readonly="">
                                              <button class="" type="button">
                                                  <label class="primary-btn small fix-gr-bg" for="Brand_logo"><?php echo e(__("common.logo")); ?> </label>
                                                  <input type="file" class="d-none" name="logo" id="Brand_logo">
                                              </button>
                                           </div>


                                            <span class="text-danger" id="error_brand_logo"></span>

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="main-title d-flex">
                                            <h3 class="mb-2 mr-30"><?php echo e(__('common.is_featured')); ?></h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="primary_input mb-25">
                                            <label class="switch_toggle" for="active_checkbox1">
                                                <input type="checkbox" id="active_checkbox1" name="featured" checked>
                                                <div class="slider round"></div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="primary_btn_2 mt-5"><i class="ti-check"></i><?php echo e(__("common.save")); ?> </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/Production_dev/Modules/Product/Resources/views/products/components/_create_brand_modal.blade.php ENDPATH**/ ?>