<?php $__env->startSection('mainContent'); ?>
<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header common_table_header">
                    <div class="main-title d-md-flex">
                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('general_settings.sms_template')); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="white_box_50px box_shadow_white">
                    <form action="<?php echo e(route('sms_templates.update', $sms_template->id)); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <!-- content  -->
                        <div class="row">
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
                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label" for=""><?php echo e(__('general_settings.subject')); ?> <span class="text-danger">*</span> (<?php echo e($language->code); ?>)</label>
                                                        <input type="text" name="subject[<?php echo e($language->code); ?>]" class="primary_input_field" placeholder="<?php echo e(__('general_settings.subject')); ?>" value="<?php echo e(isset($sms_template)?$sms_template->getTranslation('subject',$language->code):old('subject.'.$language->code)); ?>">
                                                        <span class="text-danger"><?php echo e($errors->first('subject')); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label" for=""><?php echo e(__('general_settings.short_code')); ?> <small>(<?php echo e(__('general_settings.use_these_to_get_your_neccessary_info')); ?>)</small> </label>
                                                        <label class="primary_input_label red_text" for="">{GIFT_CARD_NAME}, {SECRET_CODE}, {USER_FIRST_NAME}, {USER_EMAIL}, {ORDER_TRACKING_NUMBER}, {WEBSITE_NAME}</label>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label" for=""><?php echo e(__('general_settings.template')); ?> (<?php echo e($language->code); ?>)</label>
                                                        <textarea name="template[<?php echo e($language->code); ?>]" class="form-control primary_input_field" rows="10" placeholder="" ><?php echo e(isset($sms_template)?$sms_template->getTranslation('value',$language->code):old('template.'.$language->code)); ?></textarea>
                                                        <span class="text-danger"><?php echo e($errors->first('template')); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for=""><?php echo e(__('general_settings.subject')); ?></label>
                                        <input type="text" name="subject[en]" class="primary_input_field" placeholder="<?php echo e(__('general_settings.subject')); ?>" value="<?php echo e(isset($sms_template)?$sms_template->getTranslation('subject','en'):old('subject.en')); ?>">
                                        <span class="text-danger"><?php echo e($errors->first('subject')); ?></span>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for=""><?php echo e(__('general_settings.short_code')); ?> <small>(<?php echo e(__('general_settings.use_these_to_get_your_neccessary_info')); ?>)</small> </label>
                                        <label class="primary_input_label red_text" for="">{GIFT_CARD_NAME}, {SECRET_CODE}, {USER_FIRST_NAME}, {USER_EMAIL}, {ORDER_TRACKING_NUMBER}, {WEBSITE_NAME}</label>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for=""><?php echo e(__('general_settings.template')); ?></label>
                                        <textarea name="template[en]" class="form-control primary_input_field" rows="10" placeholder="" ><?php echo e(isset($sms_template)?$sms_template->getTranslation('subject','en'):old('subject.en')); ?></textarea>
                                        <span class="text-danger"><?php echo e($errors->first('template')); ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('general_settings.type')); ?></label>
                                    <input type="text" name="type_id" class="primary_input_field" placeholder="<?php echo e(__('general_settings.subject')); ?>" value="<?php
                                    switch ($sms_template->templateType->type) {
                                        case 'order_invoice_template':
                                        echo __("template.order_invoice_template");
                                        break;
                                        case 'order_pending_template':
                                        echo __("template.order_pending_template");
                                        break;
                                        case 'order_confirmed_template':
                                        echo __("template.order_confirmed_template");
                                        break;
                                        case 'order_declined_template':
                                        echo __("template.order_declined_template");
                                        break;
                                        case 'paid_payment_template':
                                        echo __("template.paid_payment_template");
                                        break;
                                        case 'order_completed_template':
                                        echo __("template.order_completed_template");
                                        break;
                                        case 'delivery_process_template':
                                        echo __("template.delivery_process_template");
                                        break;
                                        case 'refund_pending_template':
                                        echo __("template.refund_pending_template");
                                        break;
                                        case 'refund_confirmed_template':
                                        echo __("template.refund_confirmed_template");
                                        break;
                                        case 'refund_declined_template':
                                        echo __("template.refund_declined_template");
                                        break;
                                        case 'refund_money_paid_template':
                                        echo __("template.refund_money_paid_template");
                                        break;
                                        case 'refund_money_pending_template':
                                        echo __("template.refund_money_pending_template");
                                        break;
                                        case 'refund_completed_template':
                                        echo __("template.refund_completed_template");
                                        break;
                                        case 'refund_process_template':
                                        echo __("template.refund_process_template");
                                        break;
                                        case 'gift_card_template':
                                        echo __("template.gift_card_template");
                                        break;
                                        case 'review_sms_template':
                                        echo __("template.review_sms_template");
                                        break;
                                        case 'bulk_sms_template':
                                        echo __("template.bulk_sms_template");
                                        break;
                                        case 'order_sms_template':
                                        echo __("template.order_sms_template");
                                        break;
                                        case 'register_sms_template':
                                        echo __("template.register_sms_template");
                                        break;
                                        case 'notification_sms_template':
                                        echo __("template.notification_sms_template");
                                        break;
                                        case 'support_ticket_sms_template':
                                        echo __("template.support_ticket_sms_template");
                                        break;
                                        case 'wallet_offline_recharge':
                                        echo __("template.wallet_offline_recharge");
                                        break;
                                        case 'wallet_online_recharge':
                                        echo __("template.wallet_online_recharge");
                                        break;
                                        case 'withdraw_request_approve':
                                        echo __("template.withdraw_request_approve");
                                        break;
                                        case 'withdraw_request_declined':
                                        echo __("template.withdraw_request_declined");
                                        break;
                                        case 'Product disable':
                                        echo __("template.Product disable");
                                        break;
                                        case 'Seller product approval':
                                        echo __("template.Seller product approval");
                                        break;
                                        case 'Seller product update':
                                        echo __("template.Seller product update");
                                        break;
                                        case 'Seller payout':
                                        echo __("template.Seller payout");
                                        break;
                                        case 'Seller payout request':
                                        echo __("template.Seller payout request");
                                        break;
                                        case 'Seller approved':
                                        echo __("template.Seller approved");
                                        break;
                                        case 'Seller suspended':
                                        echo __("template.Seller suspended");
                                        break;
                                        case 'registration_templete':
                                        echo __("template.registration_templete");
                                        break;
                                        case 'order_confirmation_templete':
                                        echo __("template.order_confirmation_templete");
                                        break;
                                        case 'login_otp_templete':
                                        echo __("template.login_otp_templete");
                                        break;
                                        case 'Password_reset_otp_templete':
                                        echo __("template.Password_reset_otp_templete");
                                        break;
                                        case 'order_processing_templete':
                                        echo __("template.order_processing_templete");
                                        break;
                                        case 'order_shipped_templete':
                                        echo __("template.order_shipped_templete");
                                        break;
                                        case 'order_recieved_templete':
                                        echo __("template.order_recieved_templete");
                                        break;
                                    }
                                ?> <?php echo e(($sms_template->relatable_type != null) ? '( '.$sms_template->relatable->name.' )' : ''); ?>" disabled>
                                    <span class="text-danger"><?php echo e($errors->first('type_id')); ?></span>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('general_settings.reciepent')); ?></label>
                                    <select class="primary_select mb-25" name="reciepnt_type[]" id="reciepnt_type" multiple>
                                        <option value="customer" <?php if(in_array("customer", json_decode($sms_template->reciepnt_type))): ?> selected <?php endif; ?>><?php echo e(__('general_settings.customer')); ?></option>
                                        <?php if(isModuleActive('MultiVendor')): ?>
                                            <option value="seller" <?php if(in_array("seller", json_decode($sms_template->reciepnt_type))): ?> selected <?php endif; ?>><?php echo e(__('general_settings.seller')); ?></option>
                                        <?php endif; ?>
                                    </select>
                                    <span class="text-danger"><?php echo e($errors->first('reciepnt_type')); ?></span>
                                </div>
                            </div>



                        </div>
                        <div class="submit_btn text-center mb-100 pt_15">
                            <button class="primary_btn_large" type="submit"> <i class="ti-check"></i> <?php echo e(__('common.save')); ?></button>
                        </div>
                        <!-- content  -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/GeneralSetting/Resources/views/sms_templates/edit.blade.php ENDPATH**/ ?>