<form id="formData" action="<?php echo e(route('frontendcms.contact-content.update')); ?>" method="POST">
    <div class="row">
        <input type="hidden" name="id" value="<?php echo e($contactContent->id); ?>">
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
                                <div class="col-xl-6">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="mainTitle"><?php echo e(__('common.main_title')); ?> <span class="text-danger">*</span></label>
                                        <input name="mainTitle[<?php echo e($language->code); ?>]" id="mainTitle<?php echo e($language->code); ?>" class="primary_input_field" placeholder="-" type="text" value="<?php echo e(isset($contactContent)?$contactContent->getTranslation('mainTitle',$language->code):old('mainTitle.'.$language->code)); ?>">
                                    </div>
                                    <span class="text-danger"  id="error_mainTitle_<?php echo e($language->code); ?>"></span>
                                </div>
                                <div class="col-xl-6">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="subTitle"><?php echo e(__('common.sub_title')); ?> <span class="text-danger">*</span></label>
                                        <input name="subTitle[<?php echo e($language->code); ?>]" class="primary_input_field" placeholder="-" type="text" value="<?php echo e(isset($contactContent)?$contactContent->getTranslation('subTitle',$language->code):old('subTitle.'.$language->code)); ?>">
                                    </div>
                                    <span class="text-danger"  id="error_subTitle_<?php echo e($language->code); ?>"></span>
                                </div>
                                <div class="col-xl-12">
                                    <div class="primary_input mb-35">
                                        <label class="primary_input_label" for=""><?php echo e(__('common.details')); ?> <span class="text-danger">*</span></label>
                                        <textarea name="description[<?php echo e($language->code); ?>]" class="lms_summernote"><?php echo e(isset($contactContent)?$contactContent->getTranslation('description',$language->code):old('description.'.$language->code)); ?></textarea>
                                    </div>
                                    <span class="text-danger"  id="error_description_<?php echo e($language->code); ?>"></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php else: ?>
            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for=""><?php echo e(__('common.main_title')); ?> <span class="text-danger">*</span></label>
                    <input name="mainTitle" id="mainTitle" class="primary_input_field" placeholder="-" type="text" value="<?php echo e(old('mainTitle') ? old('mainTitle') : $contactContent->mainTitle); ?>">
                </div>
                <span class="text-danger"  id="error_mainTitle"></span>
            </div>
            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="subTitle"><?php echo e(__('common.sub_title')); ?> <span class="text-danger">*</span></label>
                    <input name="subTitle" class="primary_input_field" placeholder="-" type="text" value="<?php echo e(old('subTitle') ? old('subTitle') : $contactContent->subTitle); ?>">
                </div>
                <span class="text-danger"  id="error_subTitle"></span>
            </div>
            <div class="col-xl-12">
                <div class="primary_input mb-35">
                    <label class="primary_input_label" for=""><?php echo e(__('common.details')); ?> <span class="text-danger">*</span></label>
                    <textarea name="description" class="lms_summernote"><?php echo e($contactContent->description); ?></textarea>
                </div>
                <span class="text-danger"  id="error_description"></span>
            </div>
        <?php endif; ?>
        <div class="col-xl-6">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for=""><?php echo e(__('common.email')); ?> <span class="text-danger">*</span></label>
                <input name="email" class="primary_input_field" placeholder="-" type="email" value="<?php echo e(old('email') ? old('email') : $contactContent->email); ?>">
            </div>
            <span class="text-danger"  id="email_error"></span>
        </div>
        <div class="col-lg-12 text-center mb-90">
            <div class="d-flex justify-content-center">
                <button id="mainSubmit" class="primary-btn semi_large2  fix-gr-bg mr-1" id="save_button_parent" type="submit" dusk="update"><i class="ti-check"></i><?php echo e(__('common.update')); ?></button>
            </div>
        </div>
    </div>
</form><?php /**PATH /var/www/DhatriProduction/Modules/FrontendCMS/Resources/views/contact_content/components/form.blade.php ENDPATH**/ ?>