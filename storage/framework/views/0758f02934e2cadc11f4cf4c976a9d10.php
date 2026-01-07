<?php $__env->startPush('scripts'); ?>
<script>
    (function($){
        "use strict";
        $(document).ready(function() {

            $(document).on('submit','#formData', function(event){
                event.preventDefault();
                $('#pre-loader').removeClass('d-none');
                $("#save_button_parent").prop('disabled', true);
                $('#save_button_parent').text('<?php echo e(__("common.updating")); ?>');
                resetValidationErrors()
                var formElement = $(this).serializeArray()
                var formData = new FormData();
                formElement.forEach(element => {
                    formData.append(element.name, element.value);
                });
                formData.append('_token', "<?php echo e(csrf_token()); ?>");
                $.ajax({
                    url: "<?php echo e(route('frontendcms.subscribe-content.update')); ?>",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                        toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                        $('#save_button_parent').text('<?php echo e(__("common.update")); ?>');
                        $("#save_button_parent").prop('disabled', false);
                        $('#pre-loader').addClass('d-none');
                    },
                    error: function(response) {
                        if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }
                        toastr.error("<?php echo e(__('common.error_message')); ?>","<?php echo e(__('common.error')); ?>");
                        showValidationErrors('#formData', response.responseJSON.errors);
                        $('#save_button_parent').text('<?php echo e(__("common.update")); ?>');
                        $("#save_button_parent").prop('disabled', false);
                        $('#pre-loader').addClass('d-none');
                    }
                });
            });


            function showValidationErrors(formType, errors) {
                <?php if(isModuleActive('FrontendMultiLang')): ?>
                $(formType + ' #title_error_<?php echo e(auth()->user()->lang_code); ?>').text(errors['title.<?php echo e(auth()->user()->lang_code); ?>']);
                $(formType + ' #subtitle_error_<?php echo e(auth()->user()->lang_code); ?>').text(errors['subtitle.<?php echo e(auth()->user()->lang_code); ?>']);
                <?php else: ?>
                $(formType + ' #title_error').text(errors.title);
                $(formType + ' #subtitle_error').text(errors.subtitle);
                <?php endif; ?>
                $(formType + ' #slug_error').text(errors.slug);
                $(formType + ' #description_error').text(errors.description);
                $(formType + ' #file_error').text(errors.file);
            }


            function resetValidationErrors(){
                <?php if(isModuleActive('FrontendMultiLang')): ?>
                $('#formData' + ' #title_error_<?php echo e(auth()->user()->lang_code); ?>').text('');
                $('#formData' + ' #subtitle_error_<?php echo e(auth()->user()->lang_code); ?>').text('');
                <?php else: ?>
                $('#formData' + ' #title_error').text('');
                $('#formData' + ' #subtitle_error').text('');
                <?php endif; ?>
                $('#formData' + ' #slug_error').text('');
                $('#formData' + ' #description_error').text('');
                $('#formData' + ' #file_error').text('');
            }

            $(document).on('change', '#document_file_1', function(){
                getFileName($(this).val(),'#placeholderFileOneName');
                imageChangeWithFile($(this)[0],'#blogImgShow');
            });
        });
    })(jQuery);
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/mytestdhatri/Modules/FrontendCMS/Resources/views/popup_content/componant/scripts.blade.php ENDPATH**/ ?>