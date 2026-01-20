
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset(asset_path('backend/vendors/css/icon-picker.css'))); ?>" />
<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/multivendor/css/setting.css'))); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php echo $__env->make('frontendcms::social_link.components.social_link', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontendcms::social_link.components._scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/FrontendCMS/Resources/views/social_link/index.blade.php ENDPATH**/ ?>