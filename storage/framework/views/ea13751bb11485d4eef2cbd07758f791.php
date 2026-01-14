<form id="formData" method="POST" enctype="multipart/form-data">
<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
    <div class="row">
        <input type="hidden" name="id" value="<?php echo e($subscribeContent->id); ?>">
        <input type="hidden" name="status" value="1">
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
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for=""><?php echo e(__('common.title')); ?></label>
                                        <input name="title[<?php echo e($language->code); ?>]" class="primary_input_field" placeholder="-" type="text" value="<?php echo e(isset($subscribeContent)?$subscribeContent->getTranslation('title',$language->code):old('title.'.$language->code)); ?>">
                                        <span class="text-danger"  id="title_error_<?php echo e($language->code); ?>"></span>
                                    </div>
                    
                                </div>
                                <div class="col-xl-6">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for=""><?php echo e(__('common.sub_title')); ?></label>
                                        <input name="subtitle[<?php echo e($language->code); ?>]" class="primary_input_field" placeholder="-" type="text" value=" <?php echo e(isset($subscribeContent)?$subscribeContent->getTranslation('subtitle',$language->code):old('subtitle.'.$language->code)); ?>">
                                        <span class="text-danger"  id="subtitle_error_<?php echo e($language->code); ?>"></span>
                                    </div>
                    
                                </div>
                    
                                <div class="col-xl-12">
                                    <div class="primary_input mb-35">
                                        <label class="primary_input_label" for="description"><?php echo e(__('common.details')); ?></label>
                                        <textarea name="description[<?php echo e($language->code); ?>]" id="description" class="lms_summernote summernote"><?php echo e(isset($subscribeContent)?$subscribeContent->getTranslation('description',$language->code):old('description.'.$language->code)); ?></textarea>
                                        <span class="text-danger"  id="description_error_<?php echo e($language->code); ?>"></span>
                                    </div>
                    
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php else: ?>
            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for=""><?php echo e(__('common.title')); ?></label>
                    <input name="title" class="primary_input_field" placeholder="-" type="text" value="<?php echo e(old('title') ? old('title') : $subscribeContent->title); ?>">
                    <span class="text-danger"  id="title_error"></span>
                </div>

            </div>
            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for=""><?php echo e(__('common.sub_title')); ?></label>
                    <input name="subtitle" class="primary_input_field" placeholder="-" type="text" value="<?php echo e(old('subtitle') ? old('subtitle') : $subscribeContent->subtitle); ?>">
                    <span class="text-danger"  id="subtitle_error"></span>
                </div>

            </div>

            <div class="col-xl-12">
                <div class="primary_input mb-35">
                    <label class="primary_input_label"
                        for=""><?php echo e(__('common.details')); ?></label>
                    <textarea name="description" id="description" class="lms_summernote summernote"><?php echo e($subscribeContent->description); ?></textarea>
                    <span class="text-danger"  id="description_error"></span>
                </div>

            </div>
        <?php endif; ?>
        <div class="col-xl-6 d-none">
            <div class="primary_input mb-25">
                <label class="mb-2 mr-30"><?php echo e(__('common.image')); ?><small>(327x446)px</small></label>
                <div class="primary_file_uploader">
                    <input class="primary-input" type="text" id="placeholderFileOneName" placeholder="<?php echo e(__('common.browse')); ?>" readonly="">
                    <button class="" type="button">
                        <label class="primary-btn small fix-gr-bg" for="document_file_1"><?php echo e(__("common.image")); ?> </label>
                        <input type="file" class="d-none" name="file" id="document_file_1">
                    </button>
                </div>
                <span class="text-danger"  id="file_error"></span>
                <?php if($subscribeContent->image): ?>
                <div class="img_div mt-20">
                    <img id="blogImgShow" src="<?php echo e(showImage($subscribeContent->image)); ?>" alt="">
                </div>
                <?php else: ?>
                <div class="img_div mt-20">
                   <img id="blogImgShow" src="<?php echo e(showImage('backend/img/default.png')); ?>" alt="">
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if(permissionCheck('frontendcms.subscribe-content.update')): ?>
            <div class="col-lg-12 text-center">
                <div class="d-flex justify-content-center">
                    <button class="primary-btn semi_large2  fix-gr-bg mr-1" id="save_button_parent" type="submit" dusk="update"><i class="ti-check"></i><?php echo e(__('common.update')); ?></button>
                </div>
            </div>
        <?php endif; ?>
    </div>
</form>
<?php /**PATH /var/www/html/mytestdhatri/Modules/FrontendCMS/Resources/views/subscribe_content/componant/form.blade.php ENDPATH**/ ?>