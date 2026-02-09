

<?php $__env->startSection('mainContent'); ?>
    <section class="admin-visitor-area up_st_admin_visitor">
        <?php echo $__env->make('backEnd.partials._deleteModalForAjax',['item_name' => __('marketing.news_letter')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="container-fluid p-0">
            <div class="row justify-content-center">

                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('marketing.news_letter')); ?> <?php echo e(__('common.list')); ?></h3>
                            <?php if(permissionCheck('marketing.news-letter.create')): ?>
                                <ul class="d-flex">
                                    <li><a href="<?php echo e(route('marketing.news-letter.create')); ?>" class="primary-btn radius_30px mr-10 fix-gr-bg"><i class="ti-plus"></i><?php echo e(__('common.add_new')); ?></a></li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table">
                            <div id="item_table">
                                <?php echo $__env->make('marketing::newsletter.components.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('marketing::newsletter.components._scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/Marketing/Resources/views/newsletter/index.blade.php ENDPATH**/ ?>