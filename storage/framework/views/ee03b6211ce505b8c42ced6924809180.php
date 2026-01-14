<?php $__env->startPush('scripts'); ?>
<script>
    (function($){
        "use strict";
        $(document).ready(function() {
            $(document).on('submit', '#add_form', function(event) {
                event.preventDefault();
                $("#submit_btn").prop('disabled', true);
                resetValidateError();
                $('#pre-loader').removeClass('d-none');
                var formElement = $(this).serializeArray()
                var formData = new FormData();
                formElement.forEach(element => {
                    formData.append(element.name, element.value);
                });
                formData.append('_token', "<?php echo e(csrf_token()); ?>");
                $.ajax({
                    url: "<?php echo e(route('ticket.category.store')); ?>",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                        resetForm();
                        reloadWithData(response.TableData);
                        toastr.success("<?php echo e(__('common.created_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                        $("#submit_btn").prop('disabled', false);
                        $('#pre-loader').addClass('d-none');
                    },
                    error: function(response) {
                            if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }
                        $("#submit_btn").prop('disabled', false);
                        $('#pre-loader').addClass('d-none');
                        toastr.error('<?php echo e(__("common.error_message")); ?>',"<?php echo e(__('common.error')); ?>");
                        showValidationErrors('#add_form', response.responseJSON.errors);
                    }
                });
            });
            $(document).on('submit', '#edit_form', function(event) {
                event.preventDefault();
                $("#submit_btn").prop('disabled', true);
                $('#submit_btn').text('<?php echo e(__("common.updating")); ?>');
                resetValidateError();
                $('#pre-loader').removeClass('d-none');
                var formElement = $(this).serializeArray()
                var formData = new FormData();
                formElement.forEach(element => {
                    formData.append(element.name, element.value);
                });
                formData.append('_token', "<?php echo e(csrf_token()); ?>");
                $.ajax({
                    url: "<?php echo e(route('ticket.category.update')); ?>",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                        $('#form_div').html(response.createForm);
                        reloadWithData(response.TableData);
                        toastr.success("<?php echo e(__('common.updated_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                        $("#submit_btn").prop('disabled', false);
                        $('#submit_btn').text('<?php echo e(__("common.update")); ?>');
                        $('#pre-loader').addClass('d-none');
                    },
                    error: function(response) {
                        $("#submit_btn").prop('disabled', false);
                        $('#submit_btn').text('<?php echo e(__("common.update")); ?>');
                        if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }
                        $('#pre-loader').addClass('d-none');
                        toastr.error('<?php echo e(__("common.error_message")); ?>', "<?php echo e(__('common.error')); ?>");
                        showValidationErrors('#edit_form', response.responseJSON.errors);
                    }
                });
            });
            $(document).on('submit', '#item_delete_form', function(event) {
                event.preventDefault();
                $('#pre-loader').removeClass('d-none');
                $('#deleteItemModal').modal('hide');
                let formData = new FormData();
                formData.append('_token', "<?php echo e(csrf_token()); ?>");
                formData.append('id', $('#delete_item_id').val());
                let id = $('#delete_item_id').val();
                $.ajax({
                    url: "<?php echo e(route('ticket.category.delete')); ?>",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                        reloadWithData(response.TableData);
                        $('#form_div').html(response.createForm);
                        toastr.success("<?php echo e(__('common.deleted_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                        $('#pre-loader').addClass('d-none');
                    },
                    error: function(response) {
                        if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }
                        toastr.error("<?php echo e(__('common.error_message')); ?>", "<?php echo e(__('common.error')); ?>");
                        $('#pre-loader').addClass('d-none');
                    }
                });
            });
            $(document).on('click', '.edit_category', function(event){
                event.preventDefault();
                $('#pre-loader').removeClass('d-none');
                let id = $(this).data('value');
                let base_url = $('#url').val();
                let url = base_url + '/admin/ticket/categories/edit?id=' + id;
                $.get(url, function(data) {
                    $('#form_div').html(data);
                    $('#pre-loader').addClass('d-none');
                });
            });
            $(document).on('click', '.delete_category', function(event){
                event.preventDefault();
                let id = $(this).data('value');
                $('#delete_item_id').val(id);
                $('#deleteItemModal').modal('show');
            });
            $(document).on('change', '.status_change', function(event){
                event.preventDefault();
                let status = 0;
                if($(this).prop('checked')){
                    status = 1;
                }
                else{
                    status = 0;
                }
                let id = $(this).data('value');
                $('#pre-loader').removeClass('d-none');
                let formData = new FormData();
                formData.append('_token', "<?php echo e(csrf_token()); ?>");
                formData.append('id', id);
                formData.append('status', status);
                $.ajax({
                    url: "<?php echo e(route('ticket.category.status')); ?>",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                        toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                        $('#pre-loader').addClass('d-none');
                    },
                    error: function(response) {
                        if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }
                        toastr.error("<?php echo e(__('common.error_message')); ?>");
                        $('#pre-loader').addClass('d-none');
                    }
                });
            });
            function reloadWithData(response){
                $('#item_table').html(response);
                CRMTableThreeReactive();
            }
            function showValidationErrors(formType, errors) {
                <?php if(isModuleActive('FrontendMultiLang')): ?>
                $(formType + ' #error_name_<?php echo e(auth()->user()->lang_code); ?>').text(errors['name.<?php echo e(auth()->user()->lang_code); ?>']);
                <?php else: ?>
                    $(formType + ' #error_name').text(errors.name);
                <?php endif; ?>
            }
            function resetValidateError(){
                <?php if(isModuleActive('FrontendMultiLang')): ?>
                $(' #error_name_<?php echo e(auth()->user()->lang_code); ?>').text('');
                <?php else: ?>
                $(' #error_name').text('');
                <?php endif; ?>
            }
            function resetForm(){
                $('#add_form')[0].reset();
            }
        });
    })(jQuery);
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/mytestdhatri/Modules/SupportTicket/Resources/views/category/components/scripts.blade.php ENDPATH**/ ?>