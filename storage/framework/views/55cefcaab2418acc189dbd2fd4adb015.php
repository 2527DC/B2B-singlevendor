<?php $__env->startPush('scripts'); ?>
    <script>

        (function($){
            "use strict";
            <?php if($errors->any()): ?>
                $('#CreateModal').modal('show');
            <?php endif; ?>

            $(document).ready(function(){

                $(document).on('submit','#copyright_form', function(event) {
                    event.preventDefault();
                    $('#pre-loader').removeClass('d-none');
                    $("#copyrightBtn").prop('disabled', true);
                    $('#copyrightBtn').text('<?php echo e(__('common.updating')); ?>');
                    var formElement = $(this).serializeArray()
                    var formData = new FormData();
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });
                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    $.ajax({
                        url: "<?php echo e(route('footerSetting.footer.content-update')); ?>",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                            $('#copyrightBtn').text('<?php echo e(__('common.update')); ?>');
                            $("#copyrightBtn").prop('disabled', false);
                            $('#pre-loader').addClass('d-none');
                        },
                        error: function(response) {

                            if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                $('#pre-loader').addClass('d-none');
                                return false;
                            }
                            $('#copyrightBtn').text('<?php echo e(__('common.update')); ?>');
                            $("#copyrightBtn").prop('disabled', false);
                            $('#pre-loader').addClass('d-none');
                        }
                    });
                });

                $(document).on('submit', '#aboutForm', function(event) {
                    event.preventDefault();
                    $('#error_about_title').text('');
                    var about_title = $('#about_title').val();
                    if(about_title != ''){
                        $("#aboutSectionBtn").prop('disabled', true);
                        $('#aboutSectionBtn').text('<?php echo e(__('common.updating')); ?>');
                        $('#pre-loader').removeClass('d-none');
                        var formElement = $(this).serializeArray()
                        var formData = new FormData();
                        formElement.forEach(element => {
                            formData.append(element.name, element.value);
                        });
                        formData.append('_token', "<?php echo e(csrf_token()); ?>");
                        $.ajax({
                            url: "<?php echo e(route('footerSetting.footer.content-update')); ?>",
                            type: "POST",
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: formData,
                            success: function(response) {
                                toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                                $('#aboutSectionBtn').text('<?php echo e(__('common.update')); ?>');
                                $("#aboutSectionBtn").prop('disabled', false);
                                $('#pre-loader').addClass('d-none');
                            },
                            error: function(response) {
                                $('#aboutSectionBtn').text('<?php echo e(__('common.update')); ?>');
                                $("#aboutSectionBtn").prop('disabled', false);
                                $('#pre-loader').addClass('d-none');

                                if(response.responseJSON.error){
                                    toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                    $('#pre-loader').addClass('d-none');
                                    return false;
                                }

                            }
                        });
                    }else{
                        $('#error_about_title').text("<?php echo e(__('validation.this_field_is_required')); ?>");
                    }
                });

                $(document).on('submit', '#aboutDescriptionForm', function(event) {
                    event.preventDefault();
                    $("#aboutDescriptionBtn").prop('disabled', true);
                    $('#aboutDescriptionBtn').text('<?php echo e(__('common.updating')); ?>');
                    $('#pre-loader').removeClass('d-none');
                    $('#error_about_description').text('');
                    if($('#about_description').val() == ''){
                        $('#aboutDescriptionBtn').text('<?php echo e(__('common.update')); ?>');
                        $("#aboutDescriptionBtn").prop('disabled', false);
                        $('#pre-loader').addClass('d-none');
                        $('#error_about_description').text("<?php echo e(__('validation.this_field_is_required')); ?>");
                        return false;
                    }

                    var formElement = $(this).serializeArray()
                    var formData = new FormData();
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });
                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    $.ajax({
                        url: "<?php echo e(route('footerSetting.footer.content-update')); ?>",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                            $('#aboutDescriptionBtn').text('<?php echo e(__('common.update')); ?>');
                            $("#aboutDescriptionBtn").prop('disabled', false);
                            $('#pre-loader').addClass('d-none');
                        },
                        error: function(response) {
                            $('#aboutDescriptionBtn').text('<?php echo e(__('common.update')); ?>');
                            $("#aboutDescriptionBtn").prop('disabled', false);
                            $('#pre-loader').addClass('d-none');

                            if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                $('#pre-loader').addClass('d-none');
                                return false;
                            }

                        }
                    });
                });

                $(document).on('submit', '#companyForm', function(event) {
                    event.preventDefault();
                    $("#companyBtn").prop('disabled', true);
                    $('#companyBtn').text('<?php echo e(__('common.updating')); ?>');
                    $('#pre-loader').removeClass('d-none');
                    $('#error_company_title').text('');
                    if($('#company_title').val() == ''){
                        $('#companyBtn').text('<?php echo e(__('common.update')); ?>');
                        $("#companyBtn").prop('disabled', false);
                        $('#pre-loader').addClass('d-none');
                        $('#error_company_title').text("<?php echo e(__('validation.this_field_is_required')); ?>");
                        return false;
                    }
                    var formElement = $(this).serializeArray()
                    var formData = new FormData();
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });
                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    $.ajax({
                        url: "<?php echo e(route('footerSetting.footer.content-update')); ?>",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                            $('#companyBtn').text('<?php echo e(__('common.update')); ?>');
                            $("#companyBtn").prop('disabled', false);
                            $('#pre-loader').addClass('d-none');
                        },
                        error: function(response) {
                            $('#companyBtn').text('<?php echo e(__('common.update')); ?>');
                            $("#companyBtn").prop('disabled', false);
                            $('#pre-loader').addClass('d-none');
                            if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                $('#pre-loader').addClass('d-none');
                                return false;
                            }

                        }
                    });
                });

                $(document).on('submit','#accountForm', function(event) {
                    event.preventDefault();
                    $("#accountBtn").prop('disabled', true);
                    $('#accountBtn').text('<?php echo e(__('common.updating')); ?>');
                    $('#pre-loader').removeClass('d-none');
                    var formElement = $(this).serializeArray()
                    var formData = new FormData();
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });
                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    $.ajax({
                        url: "<?php echo e(route('footerSetting.footer.content-update')); ?>",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                            $('#accountBtn').text('<?php echo e(__('common.update')); ?>');
                            $("#accountBtn").prop('disabled', false);
                            $('#pre-loader').addClass('d-none');
                        },
                        error: function(response) {
                            toastr.error("<?php echo e(__('common.error_message')); ?>","<?php echo e(__('common.error')); ?>");
                            $('#accountBtn').text('<?php echo e(__('common.update')); ?>');
                            $("#accountBtn").prop('disabled', false);
                            $('#pre-loader').addClass('d-none');
                            if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                $('#pre-loader').addClass('d-none');
                                return false;
                            }

                        }
                    });
                });

                $(document).on('submit', '#serviceForm', function(event) {
                    event.preventDefault();
                    $("#serviceBtn").prop('disabled', true);
                    $('#serviceBtn').text('<?php echo e(__('common.updating')); ?>');
                    $('#pre-loader').removeClass('d-none');
                    var formElement = $(this).serializeArray()
                    var formData = new FormData();
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });
                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    $.ajax({
                        url: "<?php echo e(route('footerSetting.footer.content-update')); ?>",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                            $('#serviceBtn').text('<?php echo e(__('common.update')); ?>');
                            $("#serviceBtn").prop('disabled', false);
                            $('#pre-loader').addClass('d-none');
                        },
                        error: function(response) {
                            toastr.error("<?php echo e(__('common.error_message')); ?>","<?php echo e(__('common.error')); ?>");
                            $('#serviceBtn').text('<?php echo e(__('common.update')); ?>');
                            $("#serviceBtn").prop('disabled', false);
                            $('#pre-loader').addClass('d-none');
                            if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                $('#pre-loader').addClass('d-none');
                                return false;
                            }

                        }
                    });
                });

                $(document).on('click', '.active_section_class', function(event){
                    let id = $(this).data('id');
                    let url = "/footer/footer-setting/tab/" + id;
                    $.ajax({
                            url: url,
                            type: "GET",
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(response) {

                            },
                            error: function(response) {

                        }
                    });
                });

                $(document).on('click', '.create_page_btn', function(event){
                    event.preventDefault();
                    let section_id = $(this).data('id');
                    $('#CreateModal').modal('show');
                    $('#section_id').val(section_id);
                });

                $(document).on('change', '.statusChange', function(event){
                    let item = $(this).data('value');
                    var formData = new FormData();
                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    formData.append('id', item.id);
                    formData.append('status', item.status);
                    $.ajax({
                        url: "<?php echo e(route('footerSetting.footer.widget-status')); ?>",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                        },
                        error: function(response) {
                            if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                $('#pre-loader').addClass('d-none');
                                return false;
                            }
                            toastr.error("<?php echo e(__('common.error_message')); ?>","<?php echo e(__('common.error')); ?>");

                        }
                    });
                });

                $(document).on('click', '.edit_page', function(event){
                    event.preventDefault();
                    let page = $(this).data('value');
                    $('#editModal').modal('show');
                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                    if (page.name != null) {
                        $.each(page.name, function( key, value ) {
                            $('#widget_name_'+key).val(value).addClass('has-content');
                        });
                    }else{
                        $('#widget_name_<?php echo e(auth()->user()->lang_code); ?>').val(page.translateName).addClass('has-content');
                    }
                    <?php else: ?>
                    $('#widget_name').val(page.name).addClass('has-content');
                    <?php endif; ?>
                    $('#widgetEditId').val(page.id);
                    $("#editCategory").val(page.category);
                    $('#editCategory').niceSelect('update');
                    $("#editPage").val(page.page);
                    $('#editPage').niceSelect('update');
                    if(page.is_static == 1){
                        $('#editPageFieldDiv').css("display","none");
                        $('#editCategoryFieldDiv').removeClass("col-lg-6").addClass("col-lg-12");
                    }else{
                        $('#editPageFieldDiv').css("display","inherit");
                        $('#editCategoryFieldDiv').removeClass("col-lg-12").addClass("col-lg-6");
                    }
                });

                $(document).on('click', '.delete_page', function(event){
                    event.preventDefault();
                    let id = $(this).data('id');
                    $('#deleteItemModal').modal('show');
                    let base_url = "<?php echo e(url('/')); ?>";
                    let route = base_url + '/footer/footer-widget-delete/' +id;
                    $('#deleteBtn').attr('href',route);
                });

                $(document).on('change', '#document_file_1', function(){
                    getFileName($(this).val(),'#placeholderFileOneName');
                    imageChangeWithFile($(this)[0],'#blogImgShow');
                });

                $(document).on('submit', '#app_link_form', function(event) {
                    event.preventDefault();
                    var play_store = $('#play_store').val();
                    var app_store = $('#app_store').val();
                    if (play_store == "" && app_store == "") {
                        $('#error_play_store').text('Play Store Link field is Required');
                        $('#error_app_store').text('App Store Link field is Required');
                        return false;
                    }else{
                        if(play_store == ""){
                            $('#error_play_store').text('Play Store Link field is Required');
                            $('#error_app_store').text('');
                            return false;
                        }
                        if (app_store == "") {
                            $('#error_play_store').text('');
                            $('#error_app_store').text('App Store Link field is Required');
                            return false;
                        }
                    }
                    $("#appLinkBtn").prop('disabled', true);
                    $('#appLinkBtn').text('<?php echo e(__('common.updating')); ?>');
                    $('#pre-loader').removeClass('d-none');
                    var formElement = $(this).serializeArray()
                    var formData = new FormData();
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });
                    let photo = $('#document_file_1')[0].files[0];
                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    if (photo) {
                        formData.append('payment_image', photo)
                    }
                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    $.ajax({
                        url: "<?php echo e(route('footerSetting.footer.app_link_other-update')); ?>",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                            $('#error_play_store').text('');
                            $('#error_app_store').text('');
                            $('#appLinkBtn').text('<?php echo e(__('common.update')); ?>');
                            $("#appLinkBtn").prop('disabled', false);
                            $('#pre-loader').addClass('d-none');
                        },
                        error: function(response) {
                            toastr.error("<?php echo e(__('common.error_message')); ?>","<?php echo e(__('common.error')); ?>");
                            $('#appLinkBtn').text('<?php echo e(__('common.update')); ?>');
                            $("#appLinkBtn").prop('disabled', false);
                            $('#pre-loader').addClass('d-none');
                            $("#file_error").text(response.responseJSON.errors.payment_image);
                            if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                $('#pre-loader').addClass('d-none');
                                return false;
                            }
                        }
                    });
                });
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php /**PATH /var/www/html/mytestdhatri/Modules/FooterSetting/Resources/views/footer/components/scripts.blade.php ENDPATH**/ ?>