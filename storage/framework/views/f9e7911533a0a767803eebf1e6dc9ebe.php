
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/frontendcms/css/style.css'))); ?>" />

<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php echo $__env->make('backEnd.partials._deleteModalForAjax',['item_name' => __('frontendCms.dynamic_page')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="admin-visitor-area up_st_admin_visitor">

        <div class="container-fluid p-0">
            <div class="row justify-content-center">

                <div class="col-12 mb-5 mt-5">
                    <div class="box_header common_table_header">
                        <div class="main-title d-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('frontendCms.page_list')); ?></h3>
                            <?php if(permissionCheck('frontendcms.dynamic-page.store')): ?>
                                <ul class="d-flex">
                                    <li><a href="<?php echo e(route('frontendcms.dynamic-page.create')); ?>" class="primary-btn radius_30px mr-10 fix-gr-bg"><i
                                                class="ti-plus"></i><?php echo e(__('common.add_new')); ?></a></li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-3">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table">
                            <div class="" id="item_table">
                                <?php echo $__env->make('frontendcms::dynamic_page.components.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontendcms::dynamic_page.components.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/FrontendCMS/Resources/views/dynamic_page/index.blade.php ENDPATH**/ ?>