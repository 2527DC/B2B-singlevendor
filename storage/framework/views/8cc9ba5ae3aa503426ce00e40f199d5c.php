

<?php $__env->startSection('mainContent'); ?>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('appearance.Custom asset')); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <form action="<?php echo e(route("appearance.custom-asset-store")); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="white_box_50px box_shadow_white mb-20">
                            <div class="row">
                                
                                
                                <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for=""><?php echo e(__('appearance.Custom CSS')); ?> (<?php echo e(__('appearance.Without style tag')); ?>)</label>
                                        <textarea class="primary_textarea" placeholder="<?php echo e(__('appearance.Custom CSS')); ?> (<?php echo e(__('appearance.Without style tag')); ?>)" id="custom_css" cols="30" rows="10"
                                            name="custom_css"><?php echo e(@$custom_css); ?></textarea>
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for=""><?php echo e(__('appearance.Custom JS')); ?> (<?php echo e(__('appearance.Without script tag')); ?>)</label>
                                        <textarea class="primary_textarea" placeholder="<?php echo e(__('appearance.Custom JS')); ?> (<?php echo e(__('appearance.Without script tag')); ?>)" id="custom_js" cols="30" rows="10"
                                            name="custom_js"><?php echo e(@$custom_js); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="primary_btn_2"><i class="ti-check"></i><?php echo e(__("common.save")); ?> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/Appearance/Resources/views/custom_asset/index.blade.php ENDPATH**/ ?>