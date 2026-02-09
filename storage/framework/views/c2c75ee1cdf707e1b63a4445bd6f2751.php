<div class="white_box_30px">
    <!-- SMTP form  -->
    <div class="main-title mb-25">
        <h3 class="mb-0"><?php echo e(__('general_settings.email_settings')); ?></h3>
    </div>

    <form action="<?php echo e(route('smtp_gateway_credentials_update')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="primary_input">
                    <label class="primary_input_label" for=""><?php echo e(__('common.active_gateway')); ?> <span class="text-danger">*</span></label>
                    <ul id="theme_nav" class="permission_list sms_list ">
                        <li>
                            <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                <input name="mail_gateway" id="status_active" value="smtp" <?php if(app('general_setting')->mail_protocol == 'smtp'): ?> checked <?php endif; ?> class="active mail_gateway"
                                    type="radio">
                                <span class="checkmark"></span>
                            </label>
                            <p><?php echo e(__('general_settings.smtp')); ?></p>
                        </li>
                        <li>
                            <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                <input name="mail_gateway" value="sendmail" id="status_inactive" <?php if(app('general_setting')->mail_protocol == 'sendmail'): ?> checked <?php endif; ?> class="de_active mail_gateway" type="radio">
                                <span class="checkmark"></span>
                            </label>
                            <p><?php echo e(__('general_settings.php_mail')); ?></p>
                        </li>
                    </ul>
                    <span class="text-danger" id="status_error"></span>
                </div>
            </div>
        </div>
        <div class="row" id="smtp">
            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="MAIL_FROM_NAME">
                    <label class="primary_input_label" for=""><?php echo e(__('general_settings.from_name')); ?>*</label>
                    <input class="primary_input_field" placeholder="-" type="text" name="MAIL_FROM_NAME"
                        value="<?php echo e(env('MAIL_FROM_NAME')); ?>">
                </div>
            </div>
            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
                    <label class="primary_input_label" for=""><?php echo e(__('general_settings.from_mail')); ?>*</label>
                    <input class="primary_input_field" placeholder="-" type="email" name="MAIL_FROM_ADDRESS" value="<?php echo e(env('MAIL_FROM_ADDRESS')); ?>">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="MAIL_HOST">
                    <label class="primary_input_label" for=""><?php echo e(__('general_settings.mail_host')); ?></label>
                    <input class="primary_input_field" placeholder="-" type="text" name="MAIL_HOST"
                        value="<?php echo e(env('MAIL_HOST')); ?>">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="MAIL_PORT">
                    <label class="primary_input_label" for=""><?php echo e(__('general_settings.mail_port')); ?></label>
                    <input class="primary_input_field" placeholder="-" type="text" name="MAIL_PORT"
                        value="<?php echo e(env('MAIL_PORT')); ?>">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="MAIL_USERNAME">
                    <label class="primary_input_label" for=""><?php echo e(__('general_settings.mail_username')); ?></label>
                    <input class="primary_input_field" placeholder="-" type="text" name="MAIL_USERNAME"
                        value="<?php echo e(env('MAIL_USERNAME')); ?>">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                    <label class="primary_input_label" for=""><?php echo e(__('general_settings.mail_password')); ?></label>
                    <input class="primary_input_field" placeholder="-" type="password" name="MAIL_PASSWORD"
                        value="<?php echo e(env('MAIL_PASSWORD')); ?>">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input">
                    <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">
                    <label class="primary_input_label" for=""><?php echo e(__('general_settings.mail_encryption')); ?></label>
                    <select name="MAIL_ENCRYPTION" class="primary_select mb-25">
                        <option value="ssl" <?php if(env('MAIL_ENCRYPTION')=="ssl" ): ?> selected <?php endif; ?>><?php echo e(__('common.ssl')); ?></option>
                        <option value="tls" <?php if(env('MAIL_ENCRYPTION')=="tls" ): ?> selected <?php endif; ?>><?php echo e(__('common.tls')); ?></option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="MAIL_CHARSET">
                    <label class="primary_input_label" for=""><?php echo e(__('general_settings.email_charset')); ?></label>
                    <input class="primary_input_field" placeholder="Utf-8" type="text" name="MAIL_CHARSET"
                        value="<?php echo e(env('MAIL_CHARSET')); ?>">
                </div>
            </div>
        </div>
        <div class="row" id="sendmail">

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="SENDER_NAME">
                    <label class="primary_input_label" for=""><?php echo e(__('general_settings.sender_name')); ?></label>
                    <input class="primary_input_field" placeholder="-" type="text" name="SENDER_NAME"
                        value="<?php echo e(env('SENDER_NAME')); ?>">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="SENDER_MAIL">
                    <label class="primary_input_label" for=""><?php echo e(__('general_settings.sender_email')); ?></label>
                    <input class="primary_input_field" placeholder="-" type="text" name="SENDER_MAIL"
                        value="<?php echo e(env('SENDER_MAIL')); ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="primary_input">
                    <label class="primary_input_label" for=""><?php echo e(__('Mail Send Type')); ?> <span class="text-danger">*</span></label>
                    <ul id="theme_nav" class="permission_list sms_list ">
                        <li>
                            <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                <input name="QUEUE_CONNECTION" id="instant_send" value="sync" <?php if(config('queue.default') == 'sync'): ?> checked <?php endif; ?> class="active send_type"
                                    type="radio">
                                <span class="checkmark"></span>
                            </label>
                            <p><?php echo e(__('common.instant_send')); ?></p>
                        </li>
                        <li>
                            <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                <input name="QUEUE_CONNECTION" value="database" id="via_queue" <?php if(config('queue.default') != 'sync'): ?> checked <?php endif; ?> class="de_active send_type" type="radio">
                                <span class="checkmark"></span>
                            </label>
                            <p><?php echo e(__('common.via_queue')); ?></p>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="send_type_cron" class="col-xl-6 <?php if(config('queue.default') == 'sync'): ?> d-none <?php endif; ?>">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for=""><?php echo e(__('Mail Send Cron URL')); ?></label>
                    <input class="primary_input_field" readonly type="text" name=""
                        value="<?php echo e(route('mail-send-via-queue')); ?>">
                </div>
            </div>
        </div>

        <div class="row">


            <?php if(permissionCheck('smtp_gateway_credentials_update')): ?>
            <div class="col-12 mb-45 pt_15">
                <div class="submit_btn text-center">
                    <button class="primary_btn_large" type="submit"> <i class="ti-check"></i>
                        <?php echo e(__('common.save')); ?></button>
                </div>
            </div>
            <?php else: ?>
            <div class="col-lg-12 text-center mt-2">
                <span class="alert alert-warning" role="alert">
                    <strong><?php echo e(__('common.you_don_t_have_this_permission')); ?></strong>
                </span>
            </div>
            <?php endif; ?>
        </div>
    </form>
    <hr>
    <form action="<?php echo e(route('test_mail.send')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for=""><?php echo e(__('general_settings.send_a_test_email_to')); ?> <span
                            class="text-danger">*</span></label>
                    <input class="primary_input_field" type="email" name="email" value="<?php echo e(old('email')); ?>"
                        placeholder="">
                    <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for=""><?php echo e(__('general_settings.mail_text')); ?> <span
                            class="text-danger">*</span></label>
                    <input class="primary_input_field" placeholder="-" type="text" value="<?php echo e(old('content')); ?>"
                        name="content">
                    <span class="text-danger"><?php echo e($errors->first('content')); ?></span>
                </div>
            </div>
        </div>
        <div class="submit_btn text-center mb-100 pt_15">
            <button class="primary_btn_2" type="submit"><?php echo e(__('general_settings.send_test_mail')); ?></button>
        </div>
    </form>

    <!--/ SMTP_form  -->
</div>
<?php /**PATH /var/www/DhatriProduction/Modules/GeneralSetting/Resources/views/page_components/smtp_setting.blade.php ENDPATH**/ ?>