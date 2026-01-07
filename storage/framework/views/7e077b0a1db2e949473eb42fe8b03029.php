<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        (function($){
            "use strict";
            var baseUrl = $('#app_base_url').val();
            $(document).ready(function () {
                $(document).on("submit", "#reasonForm", function (event) {
                    event.preventDefault();
                    $('#pre-loader').removeClass('d-none');
                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                        $('#reason_create_error_<?php echo e(auth()->user()->lang_code); ?>').text('');
                    <?php else: ?>
                        $('#reason_create_error').text('');
                    <?php endif; ?>
                    let formData = $(this).serializeArray();
                    $.ajax({
                        url: "<?php echo e(route('refund.reasons_store')); ?>",
                        data: formData,
                        headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                        type: "POST",
                        dataType: "JSON",
                        success: function (response) {
                            toastr.success("<?php echo e(__('common.added_successfully')); ?>","<?php echo e(__('common.success')); ?>")
                            $("#reasonForm").trigger("reset");
                            refund_list();
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
                                    $('#reason_create_error_<?php echo e(auth()->user()->lang_code); ?>').text(response.responseJSON.errors['reason.<?php echo e(auth()->user()->lang_code); ?>']);
                                <?php else: ?>
                                    $('#reason_create_error').text(response.responseJSON.errors.reason);
                                <?php endif; ?>
                            }
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                        }
                    });
                });
                $(document).on("submit", "#reasonEditForm", function (event) {
                    event.preventDefault();
                    $('#pre-loader').removeClass('d-none');
                    let id = $(".edit_id").val();
                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                        $('#edit_reason_error_<?php echo e(auth()->user()->lang_code); ?>').text('');
                    <?php else: ?>
                        $('#edit_reason_error').text('');
                    <?php endif; ?>
                    let formData = $(this).serializeArray();
                    $.ajax({
                        url: baseUrl + "/refund/refund-reason-update/" + id,
                        data: formData,
                        headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                        type: "POST",
                        dataType: "JSON",
                        success: function (response) {
                            $("#reasonEditForm").trigger("reset");
                            $('.edit_div').hide();
                            toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>")
                            $('.create_div').show();
                            $('#reason_create_error').html('');
                            refund_list();
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
                                $('#edit_reason_error_<?php echo e(auth()->user()->lang_code); ?>').text(response.responseJSON.errors['reason.<?php echo e(auth()->user()->lang_code); ?>']);
                            <?php else: ?>
                                $('#edit_reason_error').text(response.responseJSON.errors.reason);
                            <?php endif; ?>
                            }
                            toastr.error(response.responseJSON.errors,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                        }
                    });
                });
                $(document).on('click', '.delete-item', function(event){
                    event.preventDefault();
                    let url = $(this).data('value');
                    confirm_modal(url);
                })
                $("#refund_list").on("click", ".edit_reason", function () {
                    let item = $(this).data("value");
                    $('.edit_div').show();
                    $('.edit_div').removeClass("d-none");
                    $('.create_div').hide();
                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                    if (item.reason != null) {
                        $.each(item.reason, function( key, value ) {
                            $("#reason"+key).val(value);
                        });
                    }else{
                        $("#reason<?php echo e(auth()->user()->lang_code); ?>").val(item.translateReason);
                    }
                    <?php else: ?>
                    $(".reason").val(item.reason);
                    <?php endif; ?>
                    $(".edit_id").val(item.id);
                });
                function refund_list() {
                    $('#pre-loader').removeClass('d-none');
                    $.ajax({
                        url: "<?php echo e(route("refund.index")); ?>",
                        type: "GET",
                        dataType: "HTML",
                        success: function (response) {
                            $("#refund_list").html(response);
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
<?php /**PATH /var/www/html/mytestdhatri/Modules/Refund/Resources/views/admin/refund_reasons/scripts.blade.php ENDPATH**/ ?>