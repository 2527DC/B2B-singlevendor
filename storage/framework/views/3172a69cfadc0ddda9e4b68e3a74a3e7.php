<?php $__env->startSection('mainContent'); ?>
<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="white_box_30px">
            <form action="<?php echo e(route('frontendcms.title_settings.update')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="box_header">
                            <div class="main-title d-flex">
                                <h3 class="mb-0 mr-30" ><?php echo e(__('frontendCms.related_sale_setting')); ?></h3>
                            </div>
                        </div>
                    </div>
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
                                                    <label class="primary_input_label" for="up_sale_product_display_title"><?php echo e(__('common.up_sale_product_display_title')); ?></label>
                                                    <input class="primary_input_field" placeholder="<?php echo e(__('common.up_sale_product_display_title')); ?>" type="text" id="up_sale_product_display_title" name="up_sale_product_display_title[<?php echo e($language->code); ?>]" value="<?php echo e(isset($FooterContent)?$FooterContent->getTranslation('up_sale_product_display_title',$language->code):old('up_sale_product_display_title.'.$language->code)); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="cross_sale_product_display_title"><?php echo e(__('common.cross_sale_product_display_title')); ?></label>
                                                    <input class="primary_input_field" placeholder="<?php echo e(__('common.cross_sale_product_display_title')); ?>" type="text" id="cross_sale_product_display_title" name="cross_sale_product_display_title[<?php echo e($language->code); ?>]" value="<?php echo e(isset($FooterContent)?$FooterContent->getTranslation('cross_sale_product_display_title',$language->code):old('cross_sale_product_display_title.'.$language->code)); ?>">
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
                                <label class="primary_input_label" for="up_sale_product_display_title"><?php echo e(__('common.up_sale_product_display_title')); ?></label>
                                <input class="primary_input_field" placeholder="<?php echo e(__('common.up_sale_product_display_title')); ?>" type="text" id="up_sale_product_display_title" name="up_sale_product_display_title" value="<?php echo e($FooterContent->up_sale_product_display_title); ?>">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="cross_sale_product_display_title"><?php echo e(__('common.cross_sale_product_display_title')); ?></label>
                                <input class="primary_input_field" placeholder="<?php echo e(__('common.cross_sale_product_display_title')); ?>" type="text" id="cross_sale_product_display_title" name="cross_sale_product_display_title" value="<?php echo e($FooterContent->cross_sale_product_display_title); ?>">
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if(permissionCheck('frontendcms.title_settings.update')): ?>
                    <div class="submit_btn text-center">
                        <button class="primary_btn_2" type="submit"> <i class="ti-check" dusk="save"></i><?php echo e(__('common.save')); ?></button>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/FrontendCMS/Resources/views/title_settings/index.blade.php ENDPATH**/ ?>