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
                    let photo = $('#document_file_1')[0].files[0];
                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    if (photo) {
                        formData.append('file', photo)
                    }
                    $.ajax({
                        url: "<?php echo e(route('frontendcms.promotionbar.update')); ?>",
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
                    $(formType + ' #title_error').text(errors.title);
                    $(formType + ' #slug_error').text(errors.slug);
                    $(formType + ' #description_error').text(errors.description);
                    $(formType + ' #subtitle_error').text(errors.subtitle);
                    $(formType + ' #file_error').text(errors.file);
                }
                function resetValidationErrors(){
                    $('#formData' + ' #title_error').text('');
                    $('#formData' + ' #slug_error').text('');
                    $('#formData' + ' #description_error').text('');
                    $('#formData' + ' #subtitle_error').text('');
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
<?php /**PATH /var/www/DhatriProduction/Modules/FrontendCMS/Resources/views/ads_bar/components/scripts.blade.php ENDPATH**/ ?>