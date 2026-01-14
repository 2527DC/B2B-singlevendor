<table class="table Crm_table_active3">
    <thead>
        <tr>
            <th scope="col"><?php echo e(__('common.sl')); ?></th>
            <th scope="col"><?php echo e(__('common.type')); ?></th>
            <th scope="col"><?php echo e(__('general_settings.subject')); ?></th>
            <th scope="col"><?php echo e(__('general_settings.reciepent')); ?></th>
            <th scope="col"><?php echo e(__('general_settings.activate')); ?></th>
            <th scope="col"><?php echo e(__('common.action')); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $sms_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sms_template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!$sms_template->module or isModuleActive($sms_template->module)): ?>
            <tr>
                <td><?php echo e(getNumberTranslate($key+1)); ?></td>
                <td>
                    <?php
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
                                ?>
                </td>
                <td><?php echo e($sms_template->subject); ?></td>
                <td>
                    <?php if($sms_template->reciepnt_type): ?>
                        <?php $__currentLoopData = json_decode($sms_template->reciepnt_type); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $reciepnt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($reciepnt == "customer"): ?> <?php echo e(__('general_settings.customer')); ?> <?php elseif($reciepnt == "admin"): ?> <?php echo e(__('common.admin')); ?> <?php elseif($reciepnt == "seller"): ?> <?php echo e(__('general_settings.seller')); ?>  <?php endif; ?> <?php if(!$loop->last): ?> , <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </td>
                <td>
                    <label class="switch_toggle" for="checkbox<?php echo e($sms_template->id); ?>">
                        <input type="checkbox" id="checkbox<?php echo e($sms_template->id); ?>" <?php if($sms_template->is_active == 1): ?> checked <?php endif; ?> <?php if(permissionCheck('')): ?> value="<?php echo e($sms_template->id); ?>" class="checkbox" <?php endif; ?>>
                        <div class="slider round"></div>
                    </label>
                </td>
                <td>
                    <a class="primary-btn radius_30px mr-10 fix-gr-bg a_btn" href="<?php echo e(route('sms_templates.manage', $sms_template->id)); ?>"><?php echo e(__('general_settings.manage')); ?></a>
                </td>
            </tr>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table><?php /**PATH /var/www/html/mytestdhatri/Modules/GeneralSetting/Resources/views/sms_templates/components/list.blade.php ENDPATH**/ ?>