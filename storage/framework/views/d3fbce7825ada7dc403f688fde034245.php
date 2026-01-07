<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        (function($){
            "use strict";
            $(document).ready(function () {
                var baseUrl = $('#app_base_url').val();
                $(document).on("submit", "#processForm", function (event) {
                    event.preventDefault();
                <?php if(isModuleActive('FrontendMultiLang')): ?>
                    $('#name_create_error_<?php echo e(auth()->user()->lang_code); ?>').text('');
                    $('#description_create_error_<?php echo e(auth()->user()->lang_code); ?>').text('');
                <?php else: ?>
                    $('#name_create_error').text('');
                    $('#description_create_error').text('');
                <?php endif; ?>
                    $('#pre-loader').removeClass('d-none');
                    let formData = $(this).serializeArray();
                    $.ajax({
                        url: "<?php echo e(route('order_manage.cancel_reason_store')); ?>",
                        data: formData,
                        headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                        type: "POST",
                        dataType: "JSON",
                        success: function (response) {
                            toastr.success("<?php echo e(__('common.added_successfully')); ?>","<?php echo e(__('common.success')); ?>")
                            $("#processForm").trigger("reset");
                            refund_process_list();
                            $('#pre-loader').addClass('d-none');
                        },
                        error: function (response) {

                        if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }
                            if (response) {
                                <?php if(isModuleActive('FrontendMultiLang')): ?>
                                    $('#name_create_error_<?php echo e(auth()->user()->lang_code); ?>').text(response.responseJSON.errors['name.<?php echo e(auth()->user()->lang_code); ?>']);
                                    $('#description_create_error_<?php echo e(auth()->user()->lang_code); ?>').text(response.responseJSON.errors['description.<?php echo e(auth()->user()->lang_code); ?>']);
                                <?php else: ?>
                                    $('#name_create_error').text(response.responseJSON.errors.name);
                                    $('#description_create_error').text(response.responseJSON.errors.description);
                                <?php endif; ?>
                            }
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                        }
                    });
                });
                //
                $(document).on("submit", "#processEditForm", function (event) {
                    event.preventDefault();
                    $('#pre-loader').removeClass('d-none');
                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                        $('#edit_name_error_<?php echo e(auth()->user()->lang_code); ?>').text('');
                        $('#edit_description_error_<?php echo e(auth()->user()->lang_code); ?>').text('');
                    <?php else: ?>
                        $('#edit_name_error').text('');
                        $('#edit_description_error').text('');
                    <?php endif; ?>
                    let id = $(".edit_id").val();
                    let formData = $(this).serializeArray();
                    $.ajax({
                        url: baseUrl + "/ordermanage/cancel-reason-update/" + id,
                        data: formData,
                        headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                        type: "POST",
                        dataType: "JSON",
                        success: function (response) {
                            $("#processEditForm").trigger("reset");
                            $('.edit_div').hide();
                            toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>")
                            $('.create_div').show();
                            $('#name_create_error').html('');
                            $('#description_create_error').html('');
                            refund_process_list();
                            $('#pre-loader').addClass('d-none');
                        },
                        error: function (response) {

                        if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }
                            if (response) {
                            <?php if(isModuleActive('FrontendMultiLang')): ?>
                                $('#edit_name_error_<?php echo e(auth()->user()->lang_code); ?>').text(response.responseJSON.errors['name.<?php echo e(auth()->user()->lang_code); ?>']);
                                $('#edit_description_error_<?php echo e(auth()->user()->lang_code); ?>').text(response.responseJSON.errors['description.<?php echo e(auth()->user()->lang_code); ?>']);
                            <?php else: ?>
                                $('#edit_name_error').text(response.responseJSON.errors.name);
                                $('#edit_description_error').text(response.responseJSON.errors.description);
                            <?php endif; ?>
                            }
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                        }
                    });
                });

                $("#refund_process_list").on("click", ".edit_reason", function () {
                    let item = $(this).data("value");
                    $('.edit_div').show();
                    $('.edit_div').removeClass("d-none");
                    $('.create_div').hide();
                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                    if (item.name != null) {
                        $.each(item.name, function( key, value ) {
                            $("#name"+key).val(value);
                        });
                    }else{
                        $("#name<?php echo e(auth()->user()->lang_code); ?>").val(item.translateName);
                    }
                    if (item.description != null) {
                        $.each(item.description, function( key, value ) {
                            $("#description"+key).val(value);
                        });
                    }else{
                        $("#description<?php echo e(auth()->user()->lang_code); ?>").val(item.TranslateDescription);
                    }
                    <?php else: ?>
                    $(".name").val(item.name);
                    $(".description").val(item.description);
                    <?php endif; ?>
                    $(".edit_id").val(item.id);
                });
                $(document).on('click', '.delete_item', function(event){
                    event.preventDefault();
                    let url = $(this).data('value');
                    confirm_modal(url);
                });
                function refund_process_list() {
                    $('#pre-loader').removeClass('d-none');
                    $.ajax({
                        url: "<?php echo e(route("order_manage.cancel_reason_list")); ?>",
                        type: "GET",
                        dataType: "HTML",
                        success: function (response) {
                            $("#refund_process_list").html(response);
                            CRMTableThreeReactive();
                            $('#pre-loader').addClass('d-none');
                        },
                        error: function (error) {
                        }
                    });
                }
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/mytestdhatri/Modules/OrderManage/Resources/views/cancel_reasons/scripts.blade.php ENDPATH**/ ?>