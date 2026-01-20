
<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset(asset_path('backend/vendors/css/icon-picker.css'))); ?>" />
<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/product/css/style.css'))); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="admin-visitor-area up_st_admin_visitor">
        <?php echo $__env->make('product::category.components.show', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php if(permissionCheck('product.category.delete')): ?>
        <?php echo $__env->make('backEnd.partials._deleteModalForAjax',['item_name' => __("common.category")], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <?php if(permissionCheck('product.category.store')): ?>
                    <div class="col-lg-4">
                        <div class="row">
                            <div id="formHtml" class="col-lg-12">
                                <?php echo $__env->make('product::category.components.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-lg-8 list_div">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('product.category_list')); ?></h3>
                            <?php if(permissionCheck('product.csv_category_download')): ?>
                                <ul class="d-flex">
                                    <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="<?php echo e(route('product.csv_category_download')); ?>"><i class="ti-download"></i><?php echo e(__('product.category_csv')); ?></a></li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                                <div id="item_table">
                                    <?php echo $__env->make('product::category.components.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
        <input type="hidden" id="module_check" value="<?php echo e(isModuleActive('MultiVendor')?'true':'false'); ?>">
        <input type="hidden" id="data_id" value="">
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('product::category.components.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/Product/Resources/views/category/index.blade.php ENDPATH**/ ?>