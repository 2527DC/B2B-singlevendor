<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
<form method="POST" action="" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="<?php echo e($form_id); ?>">
    <div class="white-box">
        <div class="add-visitor">
            <div class="row">
                <?php if(isModuleActive('FrontendMultiLang')): ?>
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item lang_code" data-id="<?php echo e($language->code); ?>">
                                    <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" data-id="<?php echo e($language->code); ?>" href="#<?php echo e($form_tab); ?><?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <div class="tab-content">
                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="<?php echo e($form_tab); ?><?php echo e($language->code); ?>">
                                        <input type="hidden" id="item_id" name="id" value="" />
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label" for="name"><?php echo e(__('common.name')); ?> <span class="text-danger">*</span></label>
                                            <input class="primary_input_field"type="text" id="name<?php echo e($language->code); ?>" name="name[<?php echo e($language->code); ?>]" autocomplete="off" value="" placeholder="<?php echo e(__('common.name')); ?>">
                                        </div>
                                        <span class="text-danger" id="error_name_<?php echo e($language->code); ?>"></span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-lg-12">
                        <input type="hidden" id="item_id" name="id" value="" />
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="name"><?php echo e(__('common.name')); ?> <span class="text-danger">*</span></label>
                            <input class="primary_input_field"type="text" id="name" name="name" autocomplete="off" value="" placeholder="<?php echo e(__('common.name')); ?>">
                        </div>
                        <span class="text-danger" id="error_name"></span>
                    </div>
                <?php endif; ?>
                <div class="col-xl-12 mt-10">
                    <div class="primary_input">
                        <label class="primary_input_label" for=""><?php echo e(__('common.status')); ?></label>
                        <ul id="theme_nav" class="permission_list sms_list ">
                            <li>
                                <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                    <input name="status" id="status_active" value="1" checked="true" class="active"
                                        type="radio">
                                    <span class="checkmark"></span>
                                </label>
                                <p><?php echo e(__('common.active')); ?></p>
                            </li>
                            <li>
                                <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                    <input name="status" value="0" id="status_inactive" class="de_active" type="radio">
                                    <span class="checkmark"></span>
                                </label>
                                <p><?php echo e(__('common.inactive')); ?></p>
                            </li>
                        </ul>
                        <span class="text-danger" id="error_status"></span>
                    </div>
                </div>


            </div>
            <div class="row mt-40">
                <div class="col-lg-12 text-center">
                <button id="<?php echo e($btn_id); ?>" type="submit" class="primary-btn fix-gr-bg" data-toggle="tooltip" title=""
                        data-original-title="" dusk="queryCreate">
                        <span class="ti-check"></span>
                        <?php echo e($button_name); ?> </button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php /**PATH /var/www/html/mytestdhatri/Modules/FrontendCMS/Resources/views/contact_content/components/query_form.blade.php ENDPATH**/ ?>