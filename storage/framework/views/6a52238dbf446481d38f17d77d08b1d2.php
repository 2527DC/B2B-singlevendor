
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/generalsetting/css/style.css'))); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header common_table_header">
                    <div class="main-title d-md-flex">
                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('common.system')); ?> <?php echo e(__('common.notification')); ?> <?php echo e(__('common.setting')); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="QA_section QA_section_heading_custom check_box_table">
                    <div class="QA_table ">
                        <!-- table-responsive -->
                        <div class="">
                            <table class="table Crm_table_active3">
                                <thead>
                                    <tr>
                                        <th scope="col"><?php echo e(__('common.sl')); ?></th>
                                        <th scope="col"><?php echo e(__('hr.event')); ?></th>
                                        <th scope="col"><?php echo e(__('common.type')); ?></th>
                                        <th scope="col"><?php echo e(__('common.message')); ?></th>
                                        <th scope="col"><?php echo e(__('common.action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- shortby  -->
                                    </td>
                                    </tr>
                                    <?php $__currentLoopData = $notificationSettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notificationSetting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!$notificationSetting->module or isModuleActive($notificationSetting->module)): ?>
                                        <tr>
                                            <th><?php echo e(getNumberTranslate($loop->index +1)); ?></th>
                                            <td><?php echo e($notificationSetting->event); ?></td>
                                            <td>
                                                <label data-id="bg_option" class="margin-type primary_checkbox d-flex mr-12">
                                                    <input disabled  name="status" id="status" value="1"
                                                    <?php if(Str::contains($notificationSetting->type,'email')): ?> checked <?php endif; ?>
                                                    type="checkbox">
                                                    <span class="checkmark"></span> &nbsp;<?php echo e(__('common.email')); ?>

                                                </label>
                                                <label data-id="bg_option" class="margin-type primary_checkbox d-flex mr-12">
                                                    <input disabled  name="status" id="status" value="1"
                                                    <?php if(Str::contains($notificationSetting->type,'mobile')): ?> checked <?php endif; ?>
                                                    type="checkbox">
                                                    <span class="checkmark"></span> &nbsp;<?php echo e(__('common.mobile')); ?>

                                                </label>
                                                <label data-id="bg_option" class="margin-type primary_checkbox d-flex mr-12">
                                                    <input disabled  name="status" id="status" value="1"
                                                    <?php if(Str::contains($notificationSetting->type,'sms')): ?> checked <?php endif; ?>
                                                    type="checkbox">
                                                    <span class="checkmark"></span> &nbsp;<?php echo e(__('common.sms')); ?>

                                                </label>
                                                <label data-id="bg_option" class="margin-type primary_checkbox d-flex mr-12">
                                                    <input disabled  name="status" id="status" value="1"
                                                    <?php if(Str::contains($notificationSetting->type,'system')): ?> checked <?php endif; ?>
                                                    type="checkbox">
                                                    <span class="checkmark"></span> &nbsp;<?php echo e(__('common.system')); ?>

                                                </label>
                                            </td>
                                            <td><?php echo e($notificationSetting->message); ?></td>
                                            <td>
                                                <?php if(permissionCheck('notificationsetting.edit')): ?>
                                                    <button data-value="<?php echo e($notificationSetting); ?>" class="primary-btn radius_30px mr-10 fix-gr-bg edit_notification" ><?php echo e(__('common.edit')); ?></button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('generalsetting::notifications.edit_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                $(document).on('click', '.edit_notification', function(event){
                    let notification = $(this).data('value');
                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                    if (notification.event != null) {
                        $.each(notification.event, function( key, value ) {
                            $("#event_"+key).val(value);
                        });
                    }else{
                        $("#event_<?php echo e(auth()->user()->lang_code); ?>").val(notification.translateevent);
                    }
                    if (notification.message != null) {
                        $.each(notification.message, function( key, value ) {
                            $("#message_"+key).val(value);
                        });
                    }else{
                        $("#message_<?php echo e(auth()->user()->lang_code); ?>").val(notification.Translatemessage);
                    }
                    if (notification.admin_msg != null) {
                        $.each(notification.admin_msg, function( key, value ) {
                            $("#admin_msg_"+key).val(value);
                        });
                    }else{
                        $("#admin_msg_<?php echo e(auth()->user()->lang_code); ?>").val(notification.Translateadminmessage);
                    }
                    <?php else: ?>
                    $('#event').val(notification.event);
                    $('#message').text(notification.message);
                    $('#admin_msg').text(notification.admin_msg);
                    <?php endif; ?>
                    $('#notificaion_id').val(notification.id);
                    if(notification.type.includes('email')){
                        $('#notification_email').attr('checked',true);
                    }else{
                        $('#notification_email').removeAttr('checked');
                    }
                    if(notification.type.includes('mobile')){
                        $('#notification_mobile').attr('checked',true);
                    }else{
                        $('#notification_mobile').removeAttr('checked');
                    }
                    if(notification.type.includes('system')){
                        $('#notification_system').attr('checked',true);
                    }else{
                        $('#notification_system').removeAttr('checked');
                    }
                    if(notification.type.includes('sms')){
                        $('#notification_sms').attr('checked',true);
                    }else{
                        $('#notification_sms').removeAttr('checked');
                    }
                    $('#edit_modal').modal('show');
                });
            $(document).on('submit', '#edit_form', function(event) {
                event.preventDefault();
                $("#pre-loader").removeClass('d-none');
                let id = $('#notificaion_id').val()
                let formElement = $(this).serializeArray()
                let formData = new FormData();
                formElement.forEach(element => {
                    formData.append(element.name, element.value);
                });
                formData.append('_token', "<?php echo e(csrf_token()); ?>");
                resetValidationErrors();
                $.ajax({
                    url: "<?php echo e(route('notificationsetting.update')); ?>",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                        window.location.reload();
                        toastr.success("<?php echo e(__('common.updated_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                        $("#pre-loader").addClass('d-none');
                    },
                    error: function(response) {
                        toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                        showValidationErrors(response.responseJSON.errors);
                        $("#pre-loader").addClass('d-none');
                    }
                });
            });
            function showValidationErrors(errors) {
            <?php if(isModuleActive('FrontendMultiLang')): ?>
                $('#error_event_<?php echo e(auth()->user()->lang_code); ?>').text(errors['event.<?php echo e(auth()->user()->lang_code); ?>']);
                $('#error_message_<?php echo e(auth()->user()->lang_code); ?>').text(errors['message.<?php echo e(auth()->user()->lang_code); ?>']);
                $('#error_admin_msg_<?php echo e(auth()->user()->lang_code); ?>').text(errors['admin_msg.<?php echo e(auth()->user()->lang_code); ?>']);
            <?php else: ?>
                $('#error_event').text(errors.event);
                $('#error_message').text(errors.message);
                $('#error_admin_msg').text(errors.admin_msg);
            <?php endif; ?>
                $('#error_type').text(errors.type);
            }
            function resetValidationErrors(){
                <?php if(isModuleActive('FrontendMultiLang')): ?>
                $('#error_event_<?php echo e(auth()->user()->lang_code); ?>').text('');
                $('#error_message_<?php echo e(auth()->user()->lang_code); ?>').text('');
                $('#error_admin_msg_<?php echo e(auth()->user()->lang_code); ?>').text('');
                <?php else: ?>
                $('#error_event').text('');
                $('#error_message').text('');
                $('#error_admin_msg').text('');
                <?php endif; ?>
                $('#error_type').text('');
            }
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/GeneralSetting/Resources/views/notifications/index.blade.php ENDPATH**/ ?>