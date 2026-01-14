<?php $__env->startSection('mainContent'); ?>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <?php if(isModuleActive('FrontendMultiLang')): ?>
                <div class="row">
                    <div class="col-lg-12">
                        <a class="primary-btn radius_30px mr-10 fix-gr-bg" href="<?php echo e(route('form_builder.builder.translation')); ?>">
                            <?php echo e(__("formBuilder.translation")); ?>

                        </a>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('formBuilder.forms')); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <div class="" id="lms_data_table">
                                <table id="lms_table" class="table Crm_table_active3">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('common.sl')); ?></th>
                                            <th><?php echo e(__('formBuilder.form')); ?></th>
                                            <th><?php echo e(__('common.view')); ?></th>
                                            <th><?php echo e(__('common.action')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(!isModuleActive('Affiliate') && $row->id == 1): ?>
                                                <?php continue; ?>
                                            <?php endif; ?>
                                            <?php if(!isModuleActive('MultiVendor') && $row->id == 3): ?>
                                                <?php continue; ?>
                                            <?php endif; ?>
                                            <?php if($row->id == 5): ?>
                                                <?php continue; ?>
                                            <?php endif; ?>
                                            <tr>
                                                <td><?php echo e(getNumberTranslate($loop->iteration)); ?></td>
                                                <td><?php echo e($row->name); ?></td>
                                                <td> <a target="_blank" href="<?php echo e(route('form_builder.forms.show',$row->id)); ?>" class="primary-btn fix-gr-bg btn text-white"><?php echo e(__('common.view')); ?></a></td>
                                                <td>
                                                    <div class="dropdown CRM_dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <?php echo e(__('common.select')); ?>

                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                            <?php if(permissionCheck('form_builder.builder')): ?>
                                                                <a href="<?php echo e(route('form_builder.builder',$row->id)); ?>" class="dropdown-item"><?php echo e(__('formBuilder.form_builder')); ?></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/FormBuilder/Resources/views/form/index.blade.php ENDPATH**/ ?>