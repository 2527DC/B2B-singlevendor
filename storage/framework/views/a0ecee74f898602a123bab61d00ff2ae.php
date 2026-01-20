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
                            location.reload();
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
                    $(formType + ' #file_error').text(errors.file);
                }
                function resetValidationErrors(){
                    $('#formData' + ' #file_error').text('');
                }
                $(document).on('change', '#document_file_1', function(){
                    getFileName($(this).val(),'#placeholderFileOneName');
                    imageChangeWithFile($(this)[0],'#blogImgShow');
                });

                $(document).on('click','.remove-image',function(event){
                    event.preventDefault();
                    let url = $(this).attr('href');
                    let default_image = $(this).attr('data-default-img');
                    let data = {
                         "id" : $(this).attr('data-id'),
                    };
                    $.ajax({
                        url:url,
                        method:"get",
                        data: data,

                    }).done(function(response){
                        if(response.status == 1){
                            $('.remove-image').hide();
                            $("#blogImgShow").attr('src',default_image);
                            toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                            location.reload();
                        }else{
                            toastr.error("<?php echo e(__('common.error_message')); ?>","<?php echo e(__('common.error')); ?>");
                        }
                    });
                })
            });
        })(jQuery);

    </script>

<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/DhatriProduction/Modules/FrontendCMS/Resources/views/promotion_bar/components/scripts.blade.php ENDPATH**/ ?>