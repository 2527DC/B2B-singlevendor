
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/shipping/css/style.css'))); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <?php if(permissionCheck('shipping_methods.store')): ?>
                    <div class="col-lg-3">
                        <div class="create_div">
                            <?php echo $__env->make('shipping::shipping_methods.components._create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-lg-9">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('shipping.shipping_method')); ?></h3>
                        </div>
                    </div>
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table">
                            <div id="method_list">
                                <?php echo $__env->make('shipping::shipping_methods.components._method_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php echo $__env->make('backEnd.partials._deleteModalForAjax',['item_name' => __('shipping.shipping_method'),'form_id' =>
'shipping_delete_form','modal_id' => 'shipping_delete_modal', 'delete_item_id' => 'shipping_delete_id'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('shipping::shipping_methods.components._scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/Shipping/Resources/views/shipping_methods/index.blade.php ENDPATH**/ ?>