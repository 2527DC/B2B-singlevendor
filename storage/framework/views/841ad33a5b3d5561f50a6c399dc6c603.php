<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
    (function($){
        "use strict";
        var baseUrl = $('#app_base_url').val();
        $(document).ready(function () {
            $(document).on("submit", "#unitForm", function (event) {
                event.preventDefault();
                $('#pre-loader').removeClass('d-none');
                $('#name_error').text('');
                let formData = $(this).serializeArray();
                $.ajax({
                    url: "<?php echo e(route('product.units.store')); ?>",
                    data: formData,
                    headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                    type: "POST",
                    dataType: "JSON",
                    success: function (response) {
                        toastr.success("<?php echo e(__('common.added_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                        $("#unitForm").trigger("reset");
                        unitList();
                        $('#pre-loader').addClass('d-none');
                    },
                    error: function (response) {
                    if(response.responseJSON.error){
                        toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                        $('#pre-loader').addClass('d-none');
                        return false;
                    }
                        if (response) {
                            $.each(response.responseJSON.errors, function (key, message) {
                                <?php if(isModuleActive('FrontendMultiLang')): ?>
                                $("#name_<?php echo e(auth()->user()->lang_code); ?>_error").html(message[0]);
                                <?php else: ?>
                                    $("#" + key + "_error").html(message[0]);
                                <?php endif; ?>
                            });
                        }
                        $('#pre-loader').addClass('d-none');
                    }
                });
            });
            //
            $(document).on("submit", "#unitEditForm", function (event) {
                event.preventDefault();
                $('#pre-loader').removeClass('d-none');
                $('#edit_name_error').text('');
                let id = $(".edit_id").val();
                let formData = $(this).serializeArray();
                $.ajax({
                    url: baseUrl + "/products/unit-update/" + id,
                    data: formData,
                    headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                    type: "POST",
                    dataType: "JSON",
                    success: function (response) {
                        $("#unitEditForm").trigger("reset");
                        $('.edit_div').addClass('d-none');
                        toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                        $('.create_div').removeClass('d-none');
                        unitList();
                        $('#pre-loader').addClass('d-none');
                    },
                    error: function (response) {

                    if(response.responseJSON.error){
                        toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                        $('#pre-loader').addClass('d-none');
                        return false;
                    }
                        if (response) {
                            $.each(response.responseJSON.errors, function (key, message) {
                                <?php if(isModuleActive('FrontendMultiLang')): ?>
                                $("#edit_name_<?php echo e(auth()->user()->lang_code); ?>_error").html(message[0]);
                                <?php else: ?>
                                $("#edit_" + key + "_error").html(message[0]);
                                <?php endif; ?>
                            });
                        }
                        $('#pre-loader').addClass('d-none');
                    }
                });
            });
            $(document).on('click', '.delete_unit', function(event){
                event.preventDefault();
                let route = $(this).data('value');
                confirm_modal(route);
            });

            $(document).on("click", ".edit_unit", function () {
                let unit = $(this).data("value");
                $('.edit_div').removeClass("d-none");
                $('.create_div').addClass("d-none");
                <?php if(isModuleActive('FrontendMultiLang')): ?>
                    if (unit.name != null) {
                        $.each( unit.name, function( key, value ) {
                            $("#name_"+key).val(value);
                        });
                    }else{
                        $(".name").val(unit.translateName);
                    }
                <?php else: ?>

                    if(isJson(unit.name))
                    {
                        $(".name").val(unit.name.en);
                    }else{
                        $(".name").val(unit.name);
                    }

                <?php endif; ?>
                $(".edit_id").val(unit.id);
                if(unit.status == 1){
                    $('#status_active').prop("checked", true);
                    $('#status_inactive').prop("checked", false);
                }else{
                    $('#status_active').prop("checked", false);
                    $('#status_inactive').prop("checked", true);
                }
            });
            function isJson(item) {
                let value = typeof item !== "string" ? JSON.stringify(item) : item;
                try {
                    value = JSON.parse(value);
                } catch (e) {
                    return false;
                }

                return typeof value === "object" && value !== null;
            }
            function unitList() {
                $.ajax({
                    url: "<?php echo e(route("product.units.get_list")); ?>",
                    type: "GET",
                    dataType: "HTML",
                    success: function (response) {
                        $("#unit_list").html(response);
                        CRMTableThreeReactive();
                    },
                    error: function (error) {
                        toastr.error("<?php echo e(__('common.error_message')); ?>", "<?php echo e(__('common.error')); ?>");
                    }
                });
            }
        });
    })(jQuery);
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/DhatriProduction/Modules/Product/Resources/views/units/scripts.blade.php ENDPATH**/ ?>