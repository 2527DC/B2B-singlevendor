<div class="main-title d-md-flex form_div_header">
    <h3 class="mb-3 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('product.add_report_reason')); ?> </h3>
    
</div>
<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
<form method="POST" action="<?php echo e(route('product.report.store')); ?>" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="add_category_form">
    <div class="white-box">
        <div class="add-visitor">
            <div class="row">
                <?php echo csrf_field(); ?>
                <?php if(isModuleActive('FrontendMultiLang')): ?>
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                    <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#element<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <div class="tab-content">
                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="element<?php echo e($language->code); ?>">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="name">
                                            <?php echo e(__('common.name')); ?>

                                            <span class="text-danger">*</span>
                                        </label>
                                        <input class="primary_input_field name" type="text" id="name<?php echo e(auth()->user()->lang_code == $language->code?$language->code:''); ?>" name="name[<?php echo e($language->code); ?>]" autocomplete="off" placeholder="<?php echo e(__('common.name')); ?>">
                                        <span class="text-danger" id="error_name_<?php echo e($language->code); ?>"></span>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php else: ?>
                <div class="col-lg-12">
                    <div class="primary_input mb-25">
                        <label class="primary_input_label" for="name">
                            <?php echo e(__('common.name')); ?>

                            <span class="text-danger">*</span>
                        </label>
                        <input class="primary_input_field name" type="text" id="name" name="name" autocomplete="off"  placeholder="<?php echo e(__('common.name')); ?>">
                        <span class="text-danger" id="error_name"></span>
                    </div>
                </div>
                <?php endif; ?>
                <div class="col-xl-12">
                    <div class="primary_input">
                        <label class="primary_input_label" for="">Status</label>
                        <ul id="theme_nav" class="permission_list sms_list ">
                            <li>
                                <label data-id="bg_option" class="primary_checkbox d-flex mr-12 extra_width">
                                    <input name="status" id="status_active" value="1" checked="true" class="active" type="radio">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Active</p>
                            </li>
                            <li>
                                <label data-id="color_option" class="primary_checkbox d-flex mr-12 extra_width">
                                    <input name="status" value="0" id="status_inactive" class="de_active" type="radio">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Inactive</p>
                            </li>
                        </ul>
                        <span class="text-danger" id="error_status"></span>
                    </div>
                </div>
            </div>
            <div class="row mt-40">
                <div class="col-lg-12 text-center">
                    <button id="create_btn" type="submit" class="primary-btn fix-gr-bg submit_btn" data-toggle="tooltip" data-original-title=""><span class="ti-check"></span><?php echo e(__('common.save')); ?> </button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php /**PATH /var/www/DhatriProduction/Modules/Product/Resources/views/report_reasons/components/_create.blade.php ENDPATH**/ ?>