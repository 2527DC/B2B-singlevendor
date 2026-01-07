
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/marketing/css/style.css'))); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="admin-visitor-area up_st_admin_visitor">
        <?php echo $__env->make('backEnd.partials._deleteModalForAjax',['item_name' => __('marketing.bulk_sms')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="container-fluid p-0">
            <div class="row">
                <?php echo csrf_field(); ?>
                <?php if(permissionCheck('marketing.bulk-sms.store')): ?>
                    <div id="form_div" class="col-lg-3">
                        <?php echo $__env->make('marketing::bulk_sms.components.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php endif; ?>
                <div class="col-lg-9">
                    <div class="row ">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4 no-gutters">
                                    <div class="main-title">
                                        <h3 class="mb-30"><?php echo e(__('marketing.sms_list')); ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div id="item_table">
                                <?php echo $__env->make('marketing::bulk_sms.components.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('marketing::bulk_sms.components._scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/Marketing/Resources/views/bulk_sms/index.blade.php ENDPATH**/ ?>