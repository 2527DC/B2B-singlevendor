<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/product/css/style.css'))); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('product.add_new_brand')); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        <?php if(isModuleActive('FrontendMultiLang')): ?>
        <?php
        $LanguageList = getLanguageList();
        ?>
        <?php endif; ?>
            <form action="<?php echo e(route("product.brand.store")); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
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
                                                    <a class="nav-link default_lang anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" data-id="<?php echo e($language->code); ?>" href="#element<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                        <div class="tab-content">
                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="element<?php echo e($language->code); ?>">
                                                    <div class="col-lg-12">
                                                        <div class="primary_input mb-15">
                                                            <label class="primary_input_label" for=""> <?php echo e(__("common.name")); ?> <span class="text-danger">*</span></label>
                                                            <input class="primary_input_field" name="name[<?php echo e($language->code); ?>]" placeholder="<?php echo e(__("common.name")); ?>" type="text" value="<?php echo e(old('name.'.$language->code)); ?>">
                                                            <?php $__errorArgs = ['name.'.auth()->user()->lang_code];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="text-danger"><?php echo e($message); ?></span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="primary_input mb-15">
                                                            <label class="primary_input_label" for=""> <?php echo e(__("common.description")); ?> </label>
                                                            <textarea class="summernote" name="description[<?php echo e($language->code); ?>]"><?php echo e(old('description.'.$language->code)); ?></textarea>
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
                                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
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
                                        <span class="text-danger"><?php echo e($errors->first('link')); ?></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="main-title d-flex">
                                        <h3 class="mb-2 mr-30"><?php echo e(__('common.seo_info')); ?></h3>
                                    </div>
                                </div>
                                <?php if(isModuleActive('FrontendMultiLang')): ?>
                                    <div class="col-lg-12">
                                        <div class="tab-content">
                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div role="tabpanel" class="tab-pane fade pelement <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="pelement<?php echo e($language->code); ?>">
                                                    <div class="col-lg-12">
                                                        <div class="primary_input mb-15">
                                                            <label class="primary_input_label" for=""> <?php echo e(__("common.meta_title")); ?></label>
                                                            <input class="primary_input_field" name="meta_title[<?php echo e($language->code); ?>]" placeholder="<?php echo e(__("common.meta_title")); ?>" type="text" value="<?php echo e(old('meta_title.'.$language->code)); ?>">
                                                            <span class="text-danger"><?php echo e($errors->first('meta_title')); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="primary_input mb-15">
                                                            <label class="primary_input_label" for=""> <?php echo e(__("common.meta_description")); ?></label>
                                                            <textarea class="primary_textarea height_112 meta_description" placeholder="<?php echo e(__('common.meta_description')); ?>" name="meta_description[<?php echo e($language->code); ?>]" spellcheck="false"><?php echo e(old('meta_description.'.$language->code)); ?></textarea>
                                                            <span class="text-danger"><?php echo e($errors->first('meta_description')); ?></span>
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
                                        <span class="text-danger"><?php echo e($errors->first('meta_title')); ?></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for=""> <?php echo e(__("common.meta_description")); ?></label>
                                        <textarea class="primary_textarea height_112 meta_description" placeholder="<?php echo e(__('common.meta_description')); ?>" name="meta_description" spellcheck="false"></textarea>
                                        <span class="text-danger"><?php echo e($errors->first('meta_description')); ?></span>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="white_box_50px box_shadow_white">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="main-title d-flex">
                                        <h3 class="mb-2 mr-30"><?php echo e(__('common.status_info')); ?></h3>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for=""><?php echo e(__('common.status')); ?> <span class="text-danger">*</span></label>
                                        <select class="primary_select mb-25" name="status" id="status">
                                            <option value="1"><?php echo e(__('common.publish')); ?></option>
                                            <option value="0"><?php echo e(__('common.pending')); ?></option>
                                        </select>
                                        <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="main-title d-flex">
                                        <h3 class="mb-2 mr-30"><?php echo e(__('common.logo')); ?> (<?php echo e(getNumberTranslate(150)); ?> X <?php echo e(getNumberTranslate(150)); ?>)<?php echo e(__('common.px')); ?></h3>
                                    </div>
                                </div>
                                <div class="col-lg-12">

                                    <div class="primary_input mb-25">
                                        <div class="primary_file_uploader" data-toggle="amazuploader" data-multiple="false" data-type="image" data-name="brand_image">
                                            <input class="primary-input file_amount" type="text" id="image" placeholder="<?php echo e(__('common.choose_images')); ?>" readonly="">
                                            <button class="" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="thumbnail_image"><?php echo e(__('product.Browse')); ?> </label>
                                                <input type="hidden" class="selected_files image_selected_files" value="">
                                            </button>
                                            <?php if($errors->has('brand_image')): ?>
                                                <span class="text-danger"> <?php echo e($errors->first('brand_image')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="product_image_all_div">
                                        </div>
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
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        (function($){
            "use strict";
            $(document).ready(function () {
                $('.summernote').summernote({
                    height: 200,
                    codeviewFilter: true,
			        codeviewIframeFilter: true
                });
                $(document).on('change', '#brand_image', function(event){
                    getFileName($('#brand_image').val(),'#image');
                    imageChangeWithFile($(this)[0],'#MetaImgDiv');
                });
                <?php if(isModuleActive('FrontendMultiLang')): ?>
                    $(document).on('click', '.default_lang', function(event){
                        var lang = $(this).data('id');
                        $('.pelement').removeClass('active show');
                        $('#pelement'+lang).addClass('active show');
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/Product/Resources/views/brand/create.blade.php ENDPATH**/ ?>