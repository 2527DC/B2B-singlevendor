
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/frontendcms/css/style.css'))); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <?php echo $__env->make('backEnd.partials._deleteModalForAjax',['item_name' => __('frontendCms.Inquery')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php $__env->startSection('mainContent'); ?>
<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="box_header">
                        <div class="main-title d-flex justify-content-between w-100">
                            <h3 class="mb-0 mr-30"><?php echo e(__('frontendCms.contact_us_contant')); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="white_box_50px box_shadow_white">
                        <?php if(permissionCheck('frontendcms.contact-content.update')): ?>
                            <?php echo $__env->make('frontendcms::contact_content.components.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>

                        <div class="row">
                            <?php if(permissionCheck('frontendcms.query.store')): ?>
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div id="formHtml" class="col-lg-12">
                                            <?php echo $__env->make('frontendcms::contact_content.components.create_query', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-lg-8">

                                <div class="row ">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-lg-4 no-gutters">
                                                <div class="main-title">
                                                    <h3 class="mb-30"><?php echo e(__('frontendCms.inquery_list')); ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="QA_section QA_section_heading_custom check_box_table">
                                            <div class="QA_table">
                                                <div id="item_table">
                                                    <?php echo $__env->make('frontendcms::contact_content.components.query_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontendcms::contact_content.components.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/FrontendCMS/Resources/views/contact_content/index.blade.php ENDPATH**/ ?>