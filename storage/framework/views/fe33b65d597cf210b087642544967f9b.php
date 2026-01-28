<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/frontendcms/css/style.css'))); ?>" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
    <div class="col-12">
        <div class="box_header">
            <div class="main-title d-flex justify-content-between w-100">
                <h3 class="mb-0 mr-30"><?php echo e(__('frontendCms.update_dynamic_page')); ?></h3>
            </div>
        </div>
    </div>

<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>

    <div class="col-12">
        <div class="white_box_50px box_shadow_white">
            <form id="formData" action="<?php echo e(route('frontendcms.dynamic-page.update',$pageInfo->id)); ?>" method="POST"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <input type="hidden" name="id" value="<?php echo e($pageInfo->id); ?>">
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
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="title"><?php echo e(__('common.title')); ?> <span class="text-danger">*</span></label>
                                                    <input name="title[<?php echo e($language->code); ?>]" id="title<?php echo e($language->code); ?>" class="primary_input_field" placeholder="-" type="text" value="<?php echo e(isset($pageInfo)?$pageInfo->getTranslation('title',$language->code):old('title.'.$language->code)); ?>">
                                                </div>
                        
                                                <?php $__errorArgs = ['title.'.auth()->user()->lang_code];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger" id="error_title"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="col-xl-6 d-none" id="default_lang_<?php echo e($language->code); ?>">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="slug"><?php echo e(__('common.slug')); ?> <span class="text-danger">*</span></label>
                                                    <input id="slug<?php echo e($language->code); ?>" name="slug[<?php echo e($language->code); ?>]" class="primary_input_field" placeholder="-" type="text" value="<?php echo e(isset($pageInfo)?$pageInfo->slug:old('slug.'.$language->code)); ?>">
                                                </div>
                                                <?php $__errorArgs = ['slug.'.auth()->user()->lang_code];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger" id="error_title"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="primary_input mb-35">
                                                    <label class="primary_input_label" for=""><?php echo e(__('common.details')); ?> <span class="text-danger">*</span></label>
                                                    <textarea name="description[<?php echo e($language->code); ?>]" class="summernote" id="description<?php echo e($language->code); ?>"> <?php echo e(isset($pageInfo)?$pageInfo->getTranslation('description',$language->code):old('description.'.$language->code)); ?></textarea>
                                                </div>
                                                <?php $__errorArgs = ['description.'.auth()->user()->lang_code];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger" id="error_title"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php else: ?>
                    <div class="col-xl-6">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="title"><?php echo e(__('common.title')); ?> <span class="text-danger">*</span></label>
                            <input name="title" id="title" class="primary_input_field" placeholder="-" type="text" value="<?php echo e(old('title')? old('title') : $pageInfo->title); ?>">
                        </div>

                        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger" id="error_title"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="col-xl-6">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="slug"><?php echo e(__('common.slug')); ?> <span class="text-danger">*</span></label>
                            <input id="slug" name="slug" class="primary_input_field" placeholder="-" type="text" value="<?php echo e(old('slug')?old('slug') : $pageInfo->slug); ?>">
                        </div>
                        <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger" id="error_title"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-xl-12">
                        <div class="primary_input mb-35">
                            <label class="primary_input_label" for=""><?php echo e(__('common.details')); ?> <span class="text-danger">*</span></label>
                            <textarea name="description" class="summernote" id="description" class=""><?php echo e(old('description')?old('description'):$pageInfo->description); ?></textarea>
                        </div>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger" id="error_title"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                <?php endif; ?>
                    <div class="col-xl-6">
                        <div class="primary_input mb-35">
                            <label class="primary_input_label" for=""><?php echo e(__('common.status')); ?> <span class="text-danger">*</span></label></label>
                            <ul id="theme_nav" class="permission_list sms_list ">
                                <li>
                                    <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                    <input name="status" id="status_active" value="1" <?php if($pageInfo->status == 1 ): ?>checked="true"  <?php endif; ?> class="active"
                                            type="radio">
                                        <span class="checkmark"></span>
                                    </label>
                                    <p><?php echo e(__('common.active')); ?></p>
                                </li>
                                <li>
                                    <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                        <input name="status" value="0" id="status_inactive" <?php if($pageInfo->status == 0 ): ?>checked="true"  <?php endif; ?> class="de_active" type="radio">
                                        <span class="checkmark"></span>
                                    </label>
                                    <p><?php echo e(__('common.inactive')); ?></p>
                                </li>
                            </ul>
                        </div>
                        <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger" id="error_title"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-xl-6">
                        <a href="<?php echo e(url('/'.$pageInfo->slug)); ?>" target="_blank" class="primary-btn preview_btn fix-gr-bg pull-right"><?php echo e(__('common.preview')); ?></a>
                    </div>
                    <div class="col-lg-12 text-center">
                        <div class="d-flex justify-content-center">
                            <button class="primary-btn semi_large2  fix-gr-bg mr-1" id="save_button_parent" type="submit" dusk="update"><i
                                    class="ti-check"></i><?php echo e(__('common.update')); ?></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script>
    (function($){
        "use strict";
        $(document).ready(function(){

            <?php if(isModuleActive('FrontendMultiLang')): ?>
                $(document).on('keyup', '#title<?php echo e(auth()->user()->lang_code); ?>', function(event){
                    processSlug($('#title<?php echo e(auth()->user()->lang_code); ?>').val(), '#slug<?php echo e(auth()->user()->lang_code); ?>');
                });
            <?php else: ?>
                $(document).on('keyup', '#title', function(event){
                    processSlug($(this).val(), '#slug');
                });
            <?php endif; ?>

            $('.summernote').summernote({
                placeholder: 'Description',
                tabsize: 2,
                height: 400,
                codeviewFilter: true,
			    codeviewIframeFilter: true
            });
            <?php if(isModuleActive('FrontendMultiLang')): ?>
                $(document).on('click', '.default_lang', function(event){
                    var lang = $(this).data('id');
                    if (lang == "<?php echo e(auth()->user()->lang_code); ?>") {  
                        $('#default_lang_<?php echo e(auth()->user()->lang_code); ?>').removeClass('d-none');
                    }
                });
                if ("<?php echo e(auth()->user()->lang_code); ?>") {  
                        $('#default_lang_<?php echo e(auth()->user()->lang_code); ?>').removeClass('d-none');
                }
            <?php endif; ?>

        });
    })(jQuery);
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/FrontendCMS/Resources/views/dynamic_page/components/edit.blade.php ENDPATH**/ ?>