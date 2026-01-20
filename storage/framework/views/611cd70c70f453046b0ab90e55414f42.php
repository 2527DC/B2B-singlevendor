<style>
    input[type="number"] {
    -moz-appearance: auto;
}
</style>
<form id="formData" method="POST" enctype="multipart/form-data">
<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
    $LanguageList = getLanguageList();
    ?>
<?php endif; ?>
    <div class="row">
        <input type="hidden" name="id" value="<?php echo e($subscribeContent->id); ?>">
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
                                    <label class="primary_input_label" for=""><?php echo e(__('common.sub_title')); ?> </label>
                                    <input name="subtitle[<?php echo e($language->code); ?>]" class="primary_input_field" placeholder="-" type="text" value="<?php echo e(isset($subscribeContent)?$subscribeContent->getTranslation('subtitle',$language->code):old('subtitle.'.$language->code)); ?>">
                                    <span class="text-danger"  id="subtitle_error_<?php echo e($language->code); ?>"></span>
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
                <label class="primary_input_label" for=""><?php echo e(__('common.sub_title')); ?> </label>
                <input name="subtitle" class="primary_input_field" placeholder="-" type="text" value="<?php echo e(old('subtitle') ? old('subtitle') : $subscribeContent->subtitle); ?>">
                <span class="text-danger"  id="subtitle_error"></span>
            </div>
        </div>

    <?php endif; ?>

        <div class="col-xl-6">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for=""><?php echo e(__('frontendCms.popup_show_after_second')); ?></label>
                <input name="second" class="primary_input_field" required min="1" placeholder="-" type="number" value="<?php echo e(old('second') ? old('second') : $subscribeContent->second); ?>">
                <span class="text-danger"  id="second_error"></span>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="primary_input">
                <label class="primary_input_label" for=""><?php echo e(__('common.status')); ?> </label>
                <ul id="theme_nav" class="permission_list sms_list ">
                    <li>
                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                            <input name="status" id="status_active" value="1" <?php if($subscribeContent->status == 1): ?> checked <?php endif; ?> class="active"
                                type="radio">
                            <span class="checkmark"></span>
                        </label>
                        <p><?php echo e(__('common.active')); ?></p>
                    </li>
                    <li>
                        <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                            <input name="status" value="0" id="status_inactive" <?php if($subscribeContent->status == 0): ?> checked <?php endif; ?> class="de_active" type="radio">
                            <span class="checkmark"></span>
                        </label>
                        <p><?php echo e(__('common.inactive')); ?></p>
                    </li>
                </ul>
                <span class="text-danger" id="status_error"></span>
            </div>
        </div>

        <div class="single_p col-xl-6 upload_photo_div">
            <label class="mb-2 mr-30"><?php echo e(__('common.image')); ?> (<?php echo e(getNumberTranslate(327)); ?>x<?php echo e(getNumberTranslate(446)); ?>) <?php echo e(__('common.px')); ?></label>
            <div class="primary_input mb-25">
                <div class="primary_file_uploader" data-toggle="amazuploader" data-multiple="false" data-type="image" data-name="popup_image">
                    <input class="primary-input file_amount" type="text" id="image" placeholder="<?php echo e(__('common.browse_image_file')); ?>" readonly="">
                    <button class="" type="button">
                        <label class="primary-btn small fix-gr-bg" for="image"><?php echo e(__("common.image")); ?> </label>
                        <input type="hidden" class="selected_files" value="<?php echo e(@$subscribeContent->popup_image_media->media_id); ?>">
                    </button>
                </div>
                <div class="product_image_all_div">
                    <?php if(@$subscribeContent->popup_image_media->media_id): ?>
                        <input type="hidden" name="popup_image" class="product_images_hidden" value="<?php echo e(@$subscribeContent->popup_image_media->media_id); ?>">
                    <?php endif; ?>
                </div>
            </div>
                    <?php if($errors->has('popup_image')): ?>
                        <span class="text-danger"> <?php echo e($errors->first('popup_image')); ?></span>
                    <?php endif; ?>
        </div>

        <?php if(permissionCheck('frontendcms.subscribe-content.update')): ?>
            <div class="col-lg-12 text-center">
                <div class="d-flex justify-content-center">
                    <button class="primary-btn semi_large2  fix-gr-bg mr-1" id="save_button_parent"
                        type="submit" dusk="update"><i
                            class="ti-check"></i><?php echo e(__('common.update')); ?></button>
                </div>
            </div>
        <?php endif; ?>

    </div>
</form>
<?php /**PATH /var/www/DhatriProduction/Modules/FrontendCMS/Resources/views/popup_content/componant/form.blade.php ENDPATH**/ ?>