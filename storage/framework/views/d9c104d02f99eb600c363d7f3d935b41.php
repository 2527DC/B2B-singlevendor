

<?php $__env->startSection('mainContent'); ?>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">

                <?php echo csrf_field(); ?>
                <?php if(permissionCheck('marketing.referral-code.update-setup')): ?>
                    <div id="form_div" class="col-lg-3">
                        <?php echo $__env->make('marketing::referral_code.components.setup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php endif; ?>

                <div class="col-lg-9">

                    <div class="row ">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4 no-gutters">
                                    <div class="main-title">
                                        <h3 class="mb-30"><?php echo e(__('marketing.referral_code_list')); ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div id="item_table">
                                <?php echo $__env->make('marketing::referral_code.components.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('marketing::referral_code.components._scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/Marketing/Resources/views/referral_code/index.blade.php ENDPATH**/ ?>