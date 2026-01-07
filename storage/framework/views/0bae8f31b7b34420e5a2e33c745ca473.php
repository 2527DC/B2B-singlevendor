

<?php $__env->startSection('mainContent'); ?>

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-6">
                <div class="white_box_30px">
                    <form action="<?php echo e(route('track_order_configuration.update')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="box_header">
                                    <div class="main-title d-flex">
                                        <h3 class="mb-0 mr-30"><?php echo e(__('order.track_order')); ?> <?php echo e(__('common.configuration')); ?>

                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="primary_input">
                                    <label class="primary_input_label" for=""><?php echo e(__('order.track_order')); ?> <?php echo e(__('common.by')); ?> <?php echo e(__('common.secret_id')); ?>

                                        &nbsp; &nbsp;</label>
                                    <ul id="theme_nav" class="permission_list sms_list ">
                                        <li>
                                            
                                            <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                <input name="track_order_by_secret_id" id="status_active" value="1"
                                                    <?php echo e($trackOrderConfiguration->track_order_by_secret_id == 1?'checked':''); ?>

                                                    class="active" type="radio">
                                                <span class="checkmark"></span>
                                            </label>
                                            <p><?php echo e(__('common.active')); ?></p>
                                        </li>
                                        <li>
        
                                            <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                                <input name="track_order_by_secret_id" value="0" id="status_inactive"
                                                    <?php echo e($trackOrderConfiguration->track_order_by_secret_id == 0?'checked':''); ?>

                                                    class="de_active" type="radio">
                                                <span class="checkmark"></span>
                                            </label>
                                            <p><?php echo e(__('common.inactive')); ?></p>
                                        </li>
                                    </ul>
                                    <span class="text-danger" id="status_error"></span>
                                </div>
                            </div>
                            
                            <div class="col-xl-12">
                                <div class="submit_btn text-center">
                                    <button class="primary_btn_2" type="submit"> <i class="ti-check"
                                            dusk="save"></i><?php echo e(__('common.update')); ?></button>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/OrderManage/Resources/views/track_order_configuration.blade.php ENDPATH**/ ?>