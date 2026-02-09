

<?php $__env->startSection('mainContent'); ?>

    <section class="admin-visitor-area up_st_admin_visitor">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="white_box_30px">
                            <?php echo $__env->make('generalsetting::page_components.sms_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                gatewayData();

                $(document).on('change','.sms_gateway', function(){
                    gatewayData();
                });
                function gatewayData(){
                    let gateway_type = $('.sms_gateway:checked').data("type");
                    let twilioData = $('#Twilio_Settings');
                    let textLocalData = $('#TexttoLocal_Settings');
                    let otherData = $('#other_Settings');
                    let msegatData = $('#msegat_Settings');
                    twilioData.hide();
                    textLocalData.hide();
                    otherData.hide();
                    msegatData.hide();
                    if (gateway_type === 'Twillo') {
                        twilioData.show();
                    }else if(gateway_type === 'TextLocal'){
                        textLocalData.show();
                    }else if(gateway_type === 'MsegatSMS'){
                        msegatData.show();
                    }
                    else{
                        otherData.show();
                    }
                }
            });
        })(jQuery);

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/GeneralSetting/Resources/views/sms_index.blade.php ENDPATH**/ ?>