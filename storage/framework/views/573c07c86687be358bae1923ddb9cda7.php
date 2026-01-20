<?php $__env->startPush('scripts'); ?>

    <script>
        (function($){
            "use strict";

            $(document).ready(function(){
                $(document).on('submit','#formData', function(event) {
                    event.preventDefault();
                    $('#pre-loader').removeClass('d-none');
                    $("#mainSubmit").prop('disabled', true);
                    $('#mainSubmit').text('<?php echo e(__("common.updating")); ?>');
                    resetValidationErrors()
                    var formElement = $(this).serializeArray()
                    var formData = new FormData();
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });
                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    $.ajax({
                        url: "<?php echo e(route('frontendcms.contact-content.update')); ?>",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                            resetValidationErrors('#formData')
                            $('#mainSubmit').text('<?php echo e(__("common.update")); ?>');
                            $("#mainSubmit").prop('disabled', false);
                            $('#pre-loader').addClass('d-none');
                        },
                        error: function(response) {
                        if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }

                            showValidationErrors('#formData', response.responseJSON.errors);
                            $('#mainSubmit').text('<?php echo e(__("common.update")); ?>');
                            $("#mainSubmit").prop('disabled', false);
                            $('#pre-loader').addClass('d-none');
                        }
                    });
                });

                $(document).on('submit','#item_delete_form', function(event) {
                    event.preventDefault();
                    $('#pre-loader').removeClass('d-none');
                    $('#deleteItemModal').modal('hide');
                    var formData = new FormData();
                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    formData.append('id', $('#delete_item_id').val());
                    let id = $('#delete_item_id').val();
                    $.ajax({
                        url: "<?php echo e(route('frontendcms.query.delete')); ?>",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            resetAfterChange(response.TableData);
                            toastr.success("<?php echo e(__('common.deleted_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                            $('#deleteItemModal').modal('hide');
                            $('#pre-loader').addClass('d-none');
                        },
                        error: function(response) {
                        if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }
                            toastr.error("<?php echo e(__('common.error_message')); ?>","<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                        }
                    });
                });

                $(document).on('submit','#add_query_form', function(event) {
                    event.preventDefault();
                    $('#pre-loader').removeClass('d-none');
                    $("#create_btn").prop('disabled', true);
                    $('#create_btn').text('<?php echo e(__("common.submitting")); ?>');
                    var formElement = $(this).serializeArray()
                    var formData = new FormData();
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });

                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    $.ajax({
                        url: "<?php echo e(route('frontendcms.query.store')); ?>",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            resetAfterChange(response.TableData)
                            resetForm();
                            toastr.success("<?php echo e(__('common.added_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                            $("#create_btn").prop('disabled', false);
                            $('#create_btn').text('<?php echo e(__("common.save")); ?>');
                            $('#pre-loader').addClass('d-none');
                        },
                        error: function(response) {
                        if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }
                            toastr.error('<?php echo e(__("common.error_message")); ?>')
                            showValidationErrorsForQuery('#add_query_form', response.responseJSON.errors);
                            $("#create_btn").prop('disabled', false);
                            $('#create_btn').text('<?php echo e(__("common.save")); ?>');
                            $('#pre-loader').addClass('d-none');
                        }
                    });
                });

                $(document).on('submit','#query_edit_form', function(event) {
                    event.preventDefault();
                    $('#pre-loader').removeClass('d-none');
                    $("#edit_btn").prop('disabled', true);
                    $('#edit_btn').text('<?php echo e(__("common.updating")); ?>');
                    let formElement = $(this).serializeArray()
                    let formData = new FormData();
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });
                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    formData.append('id', $('#item_id').val());
                    $.ajax({
                        url: "<?php echo e(route('frontendcms.query.update')); ?>",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            resetAfterChange(response.TableData)
                            resetForm();
                            toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                            $("#edit_btn").prop('disabled', false);
                            $('#edit_btn').text('<?php echo e(__("common.update")); ?>');
                            $.ajax({
                                url: "<?php echo e(route('frontendcms.query.create')); ?>",
                                type: "GET",
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    $('#formHtml').empty();
                                    $('#formHtml').html(response.editHtml);
                                    $('#pre-loader').addClass('d-none');
                                },
                                error: function(response) {
                                    if(response.responseJSON.error){
                                        toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                        $('#pre-loader').addClass('d-none');
                                        return false;
                                    }
                                    toastr.error('<?php echo e(__("common.error_message")); ?>')
                                    $('#pre-loader').addClass('d-none');
                                }
                            });

                        },
                        error: function(response) {
                        if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }
                            showValidationErrorsForQuery('#query_edit_form', response.responseJSON.errors);
                            $("#edit_btn").prop('disabled', false);
                            $('#edit_btn').text('<?php echo e(__("common.update")); ?>');
                            $('#pre-loader').addClass('d-none');
                        }
                    });
                });
                $(document).on('change', '.statusChange', function(event){
                    let item = $(this).data('value');
                    var formData = new FormData();
                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    formData.append('id', item.id);
                    formData.append('status', item.status);
                    $.ajax({
                        url: "<?php echo e(route('frontendcms.query.status')); ?>",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            resetAfterChange(response.TableData);
                            toastr.success('<?php echo e(__("common.status_change_message")); ?>')
                        },
                        error: function(response) {
                            if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }
                        }
                    });
                });
                $(document).on('click', '.edit_query', function(event){
                    event.preventDefault();
                    let item = $(this).data('value');
                    let url = '/frontendcms/query/' + item.id + '/edit'
                    $('#pre-loader').removeClass('d-none');
                    $.ajax({
                        url: url,
                        type: "GET",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            $('#formHtml').empty();
                            $('#formHtml').html(response.editHtml);
                            $('#pre-loader').addClass('d-none');
                            $('#item_id').val(item.id);
                            <?php if(isModuleActive('FrontendMultiLang')): ?>
                            if (item.name != null) {
                                $.each(item.name, function( key, value ) {
                                    $('#name'+key).val(value).addClass('has-content');
                                });
                            }else{
                                $('#name<?php echo e(auth()->user()->lang_code); ?>').val(item.translateName).addClass('has-content');
                            }
                            <?php else: ?>
                            $('#name').val(item.name).addClass('has-content');
                            <?php endif; ?>
                            if (item.status == 1) {
                                $('#query_edit_form #status_active').prop("checked", true);
                                $('#query_edit_form #status_inactive').prop("checked", false);
                            } else {
                                $('#query_edit_form #status_active').prop("checked", false);
                                $('#query_edit_form #status_inactive').prop("checked", true);
                            }
                        },
                        error: function(response) {
                            toastr.error('<?php echo e(__("common.error_message")); ?>')
                            $('#pre-loader').addClass('d-none');
                        }
                    });
                });
                $(document).on('click', '.delete_query', function(event){
                    event.preventDefault();
                    let id = $(this).data('id');
                    $('#delete_item_id').val(id);
                    $('#deleteItemModal').modal('show');
                });
                function showValidationErrors(formType, errors) {
                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                    $(formType + ' #error_mainTitle_<?php echo e(auth()->user()->lang_code); ?>').text(errors['mainTitle.<?php echo e(auth()->user()->lang_code); ?>']);
                    $(formType + ' #error_subTitle_<?php echo e(auth()->user()->lang_code); ?>').text(errors['subTitle.<?php echo e(auth()->user()->lang_code); ?>']);
                    $(formType + ' #error_description_<?php echo e(auth()->user()->lang_code); ?>').text(errors['description.<?php echo e(auth()->user()->lang_code); ?>']);
                    <?php else: ?>
                    $(formType + ' #error_mainTitle').text(errors.mainTitle);
                    $(formType + ' #error_subTitle').text(errors.subTitle);
                    $(formType + ' #error_description').text(errors.description);
                    <?php endif; ?>
                    $(formType + ' #error_email').text(errors.email);
                }
                function resetValidationErrors(formType) {
                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                        $(formType + ' #error_mainTitle_<?php echo e(auth()->user()->lang_code); ?>').text('');
                        $(formType + ' #error_subTitle_<?php echo e(auth()->user()->lang_code); ?>').text('');
                        $(formType + ' #error_description_<?php echo e(auth()->user()->lang_code); ?>').text('');
                    <?php else: ?>
                        $(formType + ' #error_mainTitle').text('');
                        $(formType + ' #error_subTitle').text('');
                        $(formType + ' #error_description').text('');
                    <?php endif; ?>
                    $(formType + ' #error_email').text('');
                }
                function resetAfterChange(tableData) {
                    $('#item_table').empty();
                    $('#item_table').html(tableData);
                    CRMTableThreeReactive();
                }
                function resetForm() {
                    location.reload();
                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                        $('#error_name_<?php echo e(auth()->user()->lang_code); ?>').text('');
                    <?php else: ?>
                        $('#error_name').text('');
                    <?php endif; ?>
                }
                function showValidationErrorsForQuery(formType, errors){
                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                    $(formType + ' #error_name_<?php echo e(auth()->user()->lang_code); ?>').text(errors['name.<?php echo e(auth()->user()->lang_code); ?>']);
                    <?php else: ?>
                    $(formType + ' #error_name').text(errors.name);
                    <?php endif; ?>
                }
            });





        })(jQuery);

    </script>

<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/DhatriProduction/Modules/FrontendCMS/Resources/views/contact_content/components/scripts.blade.php ENDPATH**/ ?>