
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/product/css/style.css'))); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="create_div">
                        <?php echo $__env->make('product::units.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="edit_div d-none">
                        <?php echo $__env->make('product::units.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('product.units')); ?></h3>
                            <?php if(permissionCheck('product.csv_unit_download')): ?>
                                <ul class="d-flex">
                                    <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="<?php echo e(route('product.csv_unit_download')); ?>"><i class="ti-download"></i><?php echo e(__('product.units_csv')); ?></a></li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                                <div id="unit_list">
                                    <?php echo $__env->make('product::units.units_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <input type="hidden" name="app_base_url" id="app_base_url" value="<?php echo e(URL::to('/')); ?>">

<?php if(permissionCheck('product.units.destroy')): ?>
    <?php echo $__env->make('backEnd.partials.delete_modal',['item_name' => __('product.unit')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('product::units.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/Product/Resources/views/units/index.blade.php ENDPATH**/ ?>