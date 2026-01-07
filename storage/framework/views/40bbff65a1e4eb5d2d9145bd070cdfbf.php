
<?php $__env->startPush('scripts'); ?>

<script>

    (function($){

        "use strict";

        var baseUrl = $('#app_base_url').val();

        $(document).ready(function() {
            $(document).on('submit', '#formData',function(event){
                event.preventDefault();
                $('#pre-loader').removeClass('d-none');
                var formElement = $(this).serializeArray()
                var formData = new FormData();
                formElement.forEach(element => {
                    formData.append(element.name,element.value);
                });
                formData.append('_token',"<?php echo e(csrf_token()); ?>");
                $.ajax({
                    url: "<?php echo e(route('frontendcms.return-exchange.update')); ?>",
                    type:"POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success:function(response){
                        toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                        resetValidationError('#formData');
                        $('#pre-loader').addClass('d-none');
                    },
                    error: function(response) {
                        if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }
                        
                        showValidationErrors('#formData',response.responseJSON.errors);
                        $('#pre-loader').addClass('d-none');
                    }
                });
            });
            function showValidationErrors(formType, errors){
                <?php if(isModuleActive('FrontendMultiLang')): ?>
                $(formType +' #error_mainTitle_<?php echo e(auth()->user()->lang_code); ?>').text(errors['mainTitle.<?php echo e(auth()->user()->lang_code); ?>']);
                $(formType +' #error_returnTitle_<?php echo e(auth()->user()->lang_code); ?>').text(errors['returnTitle.<?php echo e(auth()->user()->lang_code); ?>']);
                $(formType +' #error_exchangeTitle_<?php echo e(auth()->user()->lang_code); ?>').text(errors['exchangeTitle.<?php echo e(auth()->user()->lang_code); ?>']);
                $(formType +' #error_returnDescription_<?php echo e(auth()->user()->lang_code); ?>').text(errors['returnDescription.<?php echo e(auth()->user()->lang_code); ?>']);
                $(formType +' #error_exchangeDescription_<?php echo e(auth()->user()->lang_code); ?>').text(errors['exchangeDescription.<?php echo e(auth()->user()->lang_code); ?>']);
                <?php else: ?>
                $(formType +' #error_mainTitle').text(errors.mainTitle);
                $(formType +' #error_returnTitle').text(errors.returnTitle);
                $(formType +' #error_exchangeTitle').text(errors.exchangeTitle);
                $(formType +' #error_returnDescription').text(errors.returnDescription);
                $(formType +' #error_exchangeDescription').text(errors.exchangeDescription);
                <?php endif; ?>
            }
            function resetValidationError(formType){
                <?php if(isModuleActive('FrontendMultiLang')): ?>
                $(formType +' #error_mainTitle_<?php echo e(auth()->user()->lang_code); ?>').text('');
                $(formType +' #error_returnTitle_<?php echo e(auth()->user()->lang_code); ?>').text('');
                $(formType +' #error_exchangeTitle_<?php echo e(auth()->user()->lang_code); ?>').text('');
                $(formType +' #error_returnDescription_<?php echo e(auth()->user()->lang_code); ?>').text('');
                $(formType +' #error_exchangeDescription_<?php echo e(auth()->user()->lang_code); ?>').text('');
                <?php else: ?>
                $(formType +' #error_mainTitle').text('');
                $(formType +' #error_returnTitle').text('');
                $(formType +' #error_exchangeTitle').text('');
                $(formType +' #error_returnDescription').text('');
                $(formType +' #error_exchangeDescription').text('');
                <?php endif; ?>
            }
            <?php if(isModuleActive('FrontendMultiLang')): ?>
            $(document).on('click', '.anchore_color', function(event){
                var lang = $(this).data('id');
                if (lang == "<?php echo e(auth()->user()->lang_code); ?>") {
                    $('#default_lang_<?php echo e(auth()->user()->lang_code); ?>').removeClass('d-none');
                }
            });
            if ("<?php echo e(auth()->user()->lang_code); ?>") {  
                    $('#default_lang_<?php echo e(auth()->user()->lang_code); ?>').removeClass('d-none');
            }
        <?php endif; ?>

        });
    })(jQuery);


</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/mytestdhatri/Modules/FrontendCMS/Resources/views/return_exchange/components/scripts.blade.php ENDPATH**/ ?>