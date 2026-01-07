<div class="box_header common_table_header">
    <div class="main-title d-md-flex">
        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('refund.add_new_reason')); ?></h3>
    </div>
</div>
<form action="#" method="POST" enctype="multipart/form-data" id="reasonForm">
    <div class="white_box_50px box_shadow_white mb-20">
        <div class="row">
            <?php if(isModuleActive('FrontendMultiLang')): ?>
                <div class="col-lg-12">
                    <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                        <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item">
                                <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#rrcelement<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <div class="tab-content">
                        <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="rrcelement<?php echo e($language->code); ?>">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for=""> <?php echo e(__("refund.reason")); ?> <span class="text-danger">*</span></label>
                                    <input class="primary_input_field" name="reason[<?php echo e($language->code); ?>]" placeholder="<?php echo e(__("refund.reason")); ?>" type="text">
                                    <span class="text-danger" id="reason_create_error_<?php echo e($language->code); ?>"></span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-lg-12">
                    <div class="primary_input mb-15">
                        <label class="primary_input_label" for=""> <?php echo e(__("refund.reason")); ?> <span class="text-danger">*</span></label>
                        <input class="primary_input_field" name="reason" id="reason" placeholder="<?php echo e(__("refund.reason")); ?>" type="text" value="<?php echo e(old('reason')); ?>">
                        <span class="text-danger" id="reason_create_error"></span>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(permissionCheck('refund.reasons_store')): ?>
                <div class="col-lg-12 text-center">
                    <button class="primary_btn_2 mt-2"><i class="ti-check"></i><?php echo e(__("common.save")); ?> </button>
                </div>
            <?php else: ?>
                <div class="col-lg-12 text-center mt-2">
                    <span class="alert alert-warning" role="alert">
                        <strong><?php echo e(__('common.you_don_t_have_this_permission')); ?></strong>
                    </span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</form>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Refund/Resources/views/admin/refund_reasons/create.blade.php ENDPATH**/ ?>