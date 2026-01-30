<form id="formData" action="" method="POST" enctype="multipart/form-data">
    <div class="row">
        <input type="hidden" name="id" id="id" value="<?php echo e($return->id); ?>">
        <?php if(isModuleActive('FrontendMultiLang')): ?>
            <div class="col-lg-12">
                <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                    <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item lang_code" data-id="<?php echo e($language->code); ?>">
                            <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" data-id="<?php echo e($language->code); ?>" href="#element<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <div class="tab-content">
                    <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="element<?php echo e($language->code); ?>">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-7">
                                            <div class="col-xl-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="mainTitle"><?php echo e(__('frontendCms.main_title')); ?> <span class="text-danger">*</span></label>
                                                    <input id="mainTitle<?php echo e($language->code); ?>" name="mainTitle[<?php echo e($language->code); ?>]" class="primary_input_field" placeholder="-" type="text" value="<?php echo e(isset($return)?$return->getTranslation('mainTitle',$language->code):old('mainTitle.'.$language->code)); ?>">
                                                </div>
                                                <span class="text-danger" id="error_mainTitle_<?php echo e($language->code); ?>"></span>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="returnTitle"><?php echo e(__('frontendCms.return_title')); ?> <span class="text-danger">*</span></label>
                                                    <input id="returnTitle" name="returnTitle[<?php echo e($language->code); ?>]" class="primary_input_field" placeholder="-" type="text" value="<?php echo e(isset($return)?$return->getTranslation('returnTitle',$language->code):old('returnTitle.'.$language->code)); ?>">
                                                </div>
                                                <span class="text-danger" id="error_returnTitle_<?php echo e($language->code); ?>"></span>
                                            </div>
                                        </div>
                                        <div class="col-xl-5">
                                            <div class="col-xl-12">
                                                <div class="primary_input mb-35">
                                                    <label class="primary_input_label" for="returnDescription"><?php echo e(__('frontendCms.return_details')); ?> <span class="text-danger">*</span></label>
                                                    <textarea id="returnDescription" name="returnDescription[<?php echo e($language->code); ?>]" class="lms_summernote summernote"><?php echo e(isset($return)?$return->getTranslation('returnDescription',$language->code):old('returnDescription.'.$language->code)); ?></textarea>
                                                </div>
                                                <span class="text-danger" id="error_returnDescription_<?php echo e($language->code); ?>"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-7">
                                            <div class="col-xl-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="exchangeTitle"><?php echo e(__('frontendCms.exchange_title')); ?> <span class="text-danger">*</span></label>
                                                    <input id="exchangeTitle" name="exchangeTitle[<?php echo e($language->code); ?>]" class="primary_input_field" placeholder="-" type="text" value="<?php echo e(isset($return)?$return->getTranslation('exchangeTitle',$language->code):old('exchangeTitle.'.$language->code)); ?>">
                                                </div>
                                                <span class="text-danger" id="error_exchangeTitle_<?php echo e($language->code); ?>"></span>
                                            </div>
                                        </div>
                                        <div class="col-xl-5">
                                            <div class="col-xl-12">
                                                <div class="primary_input mb-35">
                                                    <label class="primary_input_label" for=""><?php echo e(__('frontendCms.exchange_details')); ?> <span class="text-danger">*</span></label>
                                                    <textarea id="exchangeDescription" name="exchangeDescription[<?php echo e($language->code); ?>]" class="lms_summernote summernote2"><?php echo e(isset($return)?$return->getTranslation('exchangeDescription',$language->code):old('exchangeDescription.'.$language->code)); ?></textarea>
                                                </div>
                                                <span class="text-danger" id="error_exchangeDescription_<?php echo e($language->code); ?>"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php else: ?>
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-7">
                        <div class="col-xl-12">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="mainTitle"><?php echo e(__('frontendCms.main_title')); ?> <span class="text-danger">*</span></label>
                                <input id="mainTitle" name="mainTitle" class="primary_input_field" placeholder="-" type="text" value="<?php echo e($return->mainTitle); ?>">
                            </div>
                            <span class="text-danger" id="error_mainTitle"></span>
                        </div>
                        <div class="col-xl-12">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="returnTitle"><?php echo e(__('frontendCms.return_title')); ?> <span class="text-danger">*</span></label>
                                <input id="returnTitle" name="returnTitle" class="primary_input_field" placeholder="-" type="text" value="<?php echo e($return->returnTitle); ?>">
                            </div>
                            <span class="text-danger" id="error_returnTitle"></span>
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <div class="col-xl-12">
                            <div class="primary_input mb-35">
                                <label class="primary_input_label" for="returnDescription"><?php echo e(__('frontendCms.return_details')); ?> <span class="text-danger">*</span></label>
                                <textarea id="returnDescription" name="returnDescription" class="lms_summernote summernote"><?php echo e($return->returnDescription); ?></textarea>
                            </div>
                            <span class="text-danger" id="error_returnDescription"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-7">
                        <div class="col-xl-12">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="exchangeTitle"><?php echo e(__('frontendCms.exchange_title')); ?> <span class="text-danger">*</span></label>
                                <input id="exchangeTitle" name="exchangeTitle" class="primary_input_field" placeholder="-" type="text" value="<?php echo e($return->exchangeTitle); ?>">
                            </div>
                            <span class="text-danger" id="error_exchangeTitle"></span>
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <div class="col-xl-12">
                            <div class="primary_input mb-35">
                                <label class="primary_input_label" for=""><?php echo e(__('frontendCms.exchange_details')); ?> <span class="text-danger">*</span></label>
                                <textarea id="exchangeDescription" name="exchangeDescription" class="lms_summernote summernote2"><?php echo e($return->exchangeDescription); ?></textarea>
                            </div>
                            <span class="text-danger" id="error_exchangeDescription"></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if(permissionCheck('frontendcms.return-exchange.update')): ?>
            <div class="col-lg-12 text-center">
                <div class="d-flex justify-content-center">
                    <button id="mainSubmit" class="primary-btn semi_large2  fix-gr-bg mr-1" id="save_button_parent" type="submit" dusk="update"><i class="ti-check"></i><?php echo e(__('common.update')); ?></button>
                </div>
            </div>
        <?php endif; ?>
    </div>
</form>
<?php /**PATH /var/www/html/Production_dev/Modules/FrontendCMS/Resources/views/return_exchange/components/form.blade.php ENDPATH**/ ?>