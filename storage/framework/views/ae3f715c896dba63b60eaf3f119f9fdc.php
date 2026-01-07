<div class="row">
    <div class="col-lg-12">
        <div class="main-title">
            <h3 class="mb-30">
                <?php echo e(__('common.update')); ?> </h3>
        </div>
    </div>
</div>
<div class="row">
    <div id="formHtml" class="col-lg-12">
        <div class="white-box">
            <form action="" id="edit_form">
                <div class="add-visitor">
                    <div class="row">
                        <input type="hidden" name="id" value="<?php echo e($setup->id); ?>">
                        <div class="col-lg-12">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="amount"><?php echo e(__('common.amount')); ?> <span
                                        class="text-danger">*</span></label>
                                <input class="primary_input_field" name="amount" id="amount" placeholder="" type="number" min="0" step="<?php echo e(step_decimal()); ?>" value="<?php echo e($setup->amount); ?>" >
                                <span class="text-danger" id="error_amount"></span>
                            </div>
                            
                            
                        </div>
                        <div class="col-lg-12">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="maximum_limit"><?php echo e(__('marketing.maximum_limit')); ?> <span
                                        class="text-danger">*</span></label>
                                <input class="primary_input_field" name="maximum_limit" id="maximum_limit" placeholder="" type="number" min="0" step="<?php echo e(step_decimal()); ?>" value="<?php echo e($setup->maximum_limit); ?>" >
                                <span class="text-danger" id="error_maximum_limit"></span>
                            </div>
                            
                            
                        </div>
                        <div class="col-xl-12">
                            <div class="primary_input">
                                <label class="primary_input_label" for=""><?php echo e(__('common.status')); ?></label>
                                <ul id="theme_nav" class="permission_list sms_list ">
                                    <li>
                                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                            <input name="status" id="status_active" value="1" <?php echo e($setup->status == 1?'checked':''); ?> class="active"
                                                type="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p><?php echo e(__('common.active')); ?></p>
                                    </li>
                                    <li>
                                        <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                            <input name="status" value="0" id="status_inactive" <?php echo e($setup->status == 0?'checked':''); ?> class="de_active" type="radio">
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
                            <button id="submit_btn" type="submit" class="primary-btn fix-gr-bg"
                                data-toggle="tooltip" title="" data-original-title="">
                                <span class="ti-check"></span>
                                <?php echo e(__('common.update')); ?> </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


<?php /**PATH /var/www/html/mytestdhatri/Modules/Marketing/Resources/views/referral_code/components/setup.blade.php ENDPATH**/ ?>