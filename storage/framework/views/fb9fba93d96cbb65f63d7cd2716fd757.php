
<?php $__env->startSection('mainContent'); ?>

    <section class="admin-visitor-area up_st_admin_visitor">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">
                        <div class="col-12">
                            <?php echo $__env->make('generalsetting::page_components.smtp_setting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        (function($){
            "use strict";

            $(document).ready(function() {
                smtp_form();
                $('.summernote').summernote({
                    placeholder: '',
                    tabsize: 2,
                    height: 500,
                    codeviewFilter: true,
			        codeviewIframeFilter: true
                });

                $(document).on('change','.mail_gateway', function(){
                    smtp_form();
                });
                function smtp_form(){
                    var mail_mailer = $('.mail_gateway:checked').val();
                    if (mail_mailer == 'smtp') {
                        $('#sendmail').hide();
                        $('#smtp').show();
                    }
                    else if (mail_mailer == 'sendmail') {
                        $('#smtp').hide();
                        $('#sendmail').show();
                    }
                }

                $(document).on('change', '.send_type', function (event) {
                    event.preventDefault();
                    var value = $(this).val();
                    if(value == 'sync'){
                        $('#send_type_cron').addClass('d-none');
                    }else{
                        $('#send_type_cron').removeClass('d-none');
                    }
                });
            });
        })(jQuery);

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/GeneralSetting/Resources/views/smtp_index.blade.php ENDPATH**/ ?>