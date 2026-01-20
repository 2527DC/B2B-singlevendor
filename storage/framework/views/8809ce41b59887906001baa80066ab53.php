<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/frontendcms/css/popup.css'))); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header">
                        <div class="main-title d-flex justify-content-between w-100">
                            <h3 class="mb-0 mr-30"><?php echo e(__('frontendCms.popup_content')); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">
                        <?php echo $__env->make('frontendcms::popup_content.componant.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontendcms::popup_content.componant.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/FrontendCMS/Resources/views/popup_content/index.blade.php ENDPATH**/ ?>