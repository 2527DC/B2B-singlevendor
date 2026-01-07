<?php $__env->startSection('mainContent'); ?>
    <?php echo $__env->make('backEnd.partials._deleteModalForAjax',['item_name' => __('common.coupon')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <?php echo csrf_field(); ?>
                <?php if(permissionCheck('marketing.coupon.store')): ?>
                    <div id="form_div" class="col-lg-5 col-xl-4">
                        <?php echo $__env->make('marketing::coupon.components.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php endif; ?>
                <div class="col-lg-7 col-xl-8">
                    <div class="row ">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4 no-gutters">
                                    <div class="main-title">
                                        <h3 class="mb-30"><?php echo e(__('marketing.coupon_list')); ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="QA_section QA_section_heading_custom check_box_table">
                                <div class="QA_table">
                                    <div id="item_table">
                                        <?php echo $__env->make('marketing::coupon.components.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php echo $__env->make('marketing::coupon.components._scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/Marketing/Resources/views/coupon/index.blade.php ENDPATH**/ ?>