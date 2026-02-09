<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="main-title">
            <h3 class="mb-30"> <?php echo e(__('marketing.create_coupon')); ?> </h3>
        </div>
    </div>
</div>
<div class="row">
    <div id="formHtml" class="col-lg-12">
        <div class="white-box">
            <form id="add_form">
                <div class="add-visitor">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="coupon_type"><?php echo e(__('marketing.coupon_type')); ?> <span
                                    class="text-danger">*</span></label>
                                <select name="coupon_type" id="coupon_type" class="primary_select mb-15">
                                    <option disabled selected><?php echo e(__('common.select')); ?></option>
                                    <option value="1"><?php echo e(__('marketing.product_base')); ?></option>
                                    <option value="2"><?php echo e(__('marketing.order_base')); ?></option>
                                    <option value="3"><?php echo e(__('marketing.free_shipping')); ?></option>
                                    <option value="4"><?php echo e(__('marketing.merchant_coupon')); ?></option>
                                </select>
                            </div>
                            <span class="text-danger" id="error_coupon_type"></span>
                        </div>
                        <?php if(isModuleActive('FrontendMultiLang')): ?>
                            <div class="col-lg-12">
                                <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                    <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="nav-item lang_code" data-id="<?php echo e($language->code); ?>">
                                            <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#element<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <div class="tab-content">
                                    <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="element<?php echo e($language->code); ?>">
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="coupon_title"><?php echo e(__('common.title')); ?> <span class="text-danger">*</span></label>
                                                    <input class="primary_input_field" type="text" id="coupon_title" name="coupon_title[<?php echo e($language->code); ?>]" autocomplete="off" value="<?php echo e(old('coupon_title.'.$language->code)); ?>" placeholder="<?php echo e(__('common.title')); ?>">
                                                    <span class="text-danger" id="error_coupon_title_<?php echo e($language->code); ?>"></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="col-lg-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="coupon_title"><?php echo e(__('common.title')); ?> <span class="text-danger">*</span></label>
                                    <input class="primary_input_field" type="text" id="coupon_title" name="coupon_title" autocomplete="off" value="<?php echo e(old('coupon_title')); ?>" placeholder="<?php echo e(__('common.title')); ?>">
                                    <span class="text-danger" id="error_coupon_title"></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div id="formDataDiv">
                    </div>
                    <div class="row mt-40">
                        <div class="col-lg-12 text-center">
                            <button id="submit_btn" type="submit" class="primary-btn fix-gr-bg" data-toggle="tooltip" title="" data-original-title=""> <span class="ti-check"></span> <?php echo e(__('common.save')); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php /**PATH /var/www/DhatriProduction/Modules/Marketing/Resources/views/coupon/components/create.blade.php ENDPATH**/ ?>