<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset(asset_path('backend/vendors/js/icon-picker.js'))); ?>"></script>
    <script src="<?php echo e(asset(asset_path('backend/vendors/js/nestable2.js'))); ?>"></script>
    <script>
        (function($){
            $(document).ready(function(){
                $(document).on('mouseover', 'body', function(){
                    $('.icon').iconpicker({
                        animation:true,
                        hideOnSelect: true
                    });
                });
                $(document).on('submit', '#columnEditForm', function(event){
                    event.preventDefault();
                    let column_id = $(this).data('column_id');
                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                    var column = $('#edit_column<?php echo e(auth()->user()->lang_code); ?>'+column_id).val();
                    if (column == '') {
                        $('#error_edit_column<?php echo e(auth()->user()->lang_code); ?>'+column_id).text('The column field is required');
                        return false;
                    }else{
                        $('#error_edit_column<?php echo e(auth()->user()->lang_code); ?>'+column_id).text('');
                    }
                    <?php else: ?>
                    var column =  $('#edit_column'+column_id).val();
                    if (column == '') {
                        $('#error_edit_column'+column_id).text('The column field is required');
                        return false;
                    }else{
                        $('#error_edit_column'+column_id).text('');
                    }
                    <?php endif; ?>
                    let size = $('#edit_size'+column_id).val();
                    if(size == ''){
                        $('#error_edit_size'+column_id).text('Column size required.');
                        return false;
                    }else{
                        $('#error_edit_size'+column_id).text('');
                    }
                    $('#pre-loader').removeClass('d-none');
                    var formElement = $(this).serializeArray()
                    var formData = new FormData();
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });
                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    formData.append('menu_id','<?php echo e($menu->id); ?>');
                    $('#edit_column_modal').modal('hide');
                    $.ajax({
                        url: "<?php echo e(route('menu.setup.column-update')); ?>",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            $('#pre-loader').addClass('d-none');
                            reloadWithData(response);
                            toastr.success("<?php echo e(__('common.updated_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                            location.reload();
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
                $(document).on('submit', '#elementEditForm', function(event){
                    event.preventDefault();
                    let element_type = $(this).data('element_type');
                    let element_id = $(this).data('element_id');
                    if(element_type == 'category' && !$(this).find('.edit_category').val()){
                        toastr.error('Please Sellect Category');
                        return false;
                    }
                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                    var title = $('#edit_title<?php echo e(auth()->user()->lang_code); ?>'+element_id).val();
                    if (title == '') {
                        $('#edit_error_title_<?php echo e(auth()->user()->lang_code); ?>'+element_id).text('The title field is required');
                        return false;
                    }else{
                        $('#edit_error_title_<?php echo e(auth()->user()->lang_code); ?>'+element_id).text('');
                    }
                    <?php else: ?>
                    var title =  $('#edit_title'+element_id).val();
                    if (title == '') {
                        $('#edit_error_title'+element_id).text('The title field is required');
                        return false;
                    }else{
                        $('#edit_error_title'+element_id).text('');
                    }
                    <?php endif; ?>
                    $('#pre-loader').removeClass('d-none');
                    var formElement = $(this).serializeArray()
                    var formData = new FormData();
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });
                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    formData.append('menu_id','<?php echo e($menu->id); ?>');
                    $('#edit_element_modal').modal('hide');

                    $.ajax({
                        url: "<?php echo e(route('menu.setup.element-update')); ?>",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            reloadWithData(response);
                            $('#pre-loader').addClass('d-none');
                            toastr.success("<?php echo e(__('common.updated_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                            location.reload();
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
                $(document).on('submit', '#menuEditForm', function(event){
                    event.preventDefault();
                    let element_id = $(this).data('element_id');
                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                    var title = $('#edit_title<?php echo e(auth()->user()->lang_code); ?>'+element_id).val();
                    if (title == '') {
                        $('#edit_error_title_<?php echo e(auth()->user()->lang_code); ?>'+element_id).text('The title field is required');
                        return false;
                    }else{
                        $('#edit_error_title_<?php echo e(auth()->user()->lang_code); ?>'+element_id).text('');
                    }
                    <?php else: ?>
                    var title =  $('#edit_title'+element_id).val();
                    if (title == '') {
                        $('#edit_error_title'+element_id).text('The title field is required');
                        return false;
                    }else{
                        $('#edit_error_title'+element_id).text('');
                    }
                    <?php endif; ?>
                    $('#pre-loader').removeClass('d-none');
                    var formElement = $(this).serializeArray()
                    var formData = new FormData();
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });
                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    formData.append('menu_id','<?php echo e($menu->id); ?>');
                    $('#edit_element_modal').modal('hide');
                    $.ajax({
                        url: "<?php echo e(route('menu.setup.menu-update')); ?>",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            reloadWithData(response);
                            $('#pre-loader').addClass('d-none');
                            toastr.success("<?php echo e(__('common.updated_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                            location.reload();
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
                $(document).on('submit', '#rightPanelDataEditForm', function(event){
                    event.preventDefault();
                    $('#pre-loader').removeClass('d-none');
                    var formElement = $(this).serializeArray()
                    var formData = new FormData();
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });
                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    formData.append('menu_id','<?php echo e($menu->id); ?>');
                    $.ajax({
                        url: "<?php echo e(route('menu.setup.rightpanel-data-update')); ?>",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            $('#rightpanelListDiv').empty();
                            $('#rightpanelListDiv').html(response);
                            dynamicSelect2WithAjax(".right_category", "<?php echo e(url('/products/get-category-data')); ?>", "GET");
                            $('#pre-loader').addClass('d-none');
                            toastr.success("<?php echo e(__('common.updated_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                            location.reload();

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

                $(document).on('submit', '#bottomPanelDataEditForm', function(event){
                    event.preventDefault();
                    $('#pre-loader').removeClass('d-none');
                    var formElement = $(this).serializeArray()
                    var formData = new FormData();
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });

                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    formData.append('menu_id','<?php echo e($menu->id); ?>');

                    $.ajax({
                        url: "<?php echo e(route('menu.setup.bottompanel-data-update')); ?>",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {

                            $('#bottompanelListDiv').empty();
                            $('#bottompanelListDiv').html(response);
                            dynamicSelect2WithAjax(".bottom_brand", "<?php echo e(route('product.brands.get-by-ajax')); ?>", "GET");
                            $('#pre-loader').addClass('d-none');
                            toastr.success("<?php echo e(__('common.updated_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                            location.reload();

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



                //for delete functionality
                $(document).on('submit', '#column_delete_form', function(event){
                    event.preventDefault();
                    $('#pre-loader').removeClass('d-none');
                    $('#deleteColumnModal').modal('hide');
                    let id = $('#delete_column_id').val();
                    let data = {
                        'id' : id,
                        '_token' : '<?php echo e(csrf_token()); ?>',
                        'menu_id':'<?php echo e($menu->id); ?>'
                    }
                    $.post("<?php echo e(route('menu.setup.column-delete')); ?>",data, function(data){
                        $('#pre-loader').addClass('d-none');
                        toastr.success("<?php echo e(__('common.deleted_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                        reloadWithData(data);
                        location.reload();

                    })
                    .fail(function(response) {
                    if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }

                    });
                });
                $(document).on('submit', '#element_delete_form', function(event){
                    event.preventDefault();
                    $('#pre-loader').removeClass('d-none');
                    $('#deleteElementModal').modal('hide');
                    let id = $('#delete_element_id').val();
                    let data = {
                        'id' : id,
                        '_token' : '<?php echo e(csrf_token()); ?>',
                        'menu_id':'<?php echo e($menu->id); ?>'
                    }
                    $.post("<?php echo e(route('menu.setup.element-delete')); ?>",data, function(data){
                        $('#pre-loader').addClass('d-none');
                        toastr.success("<?php echo e(__('common.deleted_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                        reloadWithData(data);
                        location.reload();

                    })
                    .fail(function(response) {
                    if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }

                    });
                });

                $(document).on('submit', '#menu_delete_form', function(event){
                    event.preventDefault();
                    $('#pre-loader').removeClass('d-none');
                    $('#deleteMenuModal').modal('hide');
                    let id = $('#delete_menu_id').val();
                    let data = {
                        'id' : id,
                        '_token' : '<?php echo e(csrf_token()); ?>',
                        'menu_id':'<?php echo e($menu->id); ?>'
                    }
                    $.post("<?php echo e(route('menu.setup.menu-delete')); ?>",data, function(data){
                        $('#pre-loader').addClass('d-none');
                        toastr.success("<?php echo e(__('common.deleted_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                        reloadWithData(data);
                        location.reload();

                    })
                    .fail(function(response) {
                    if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }

                    });
                });

                $(document).on('submit', '#category_delete_form', function(event){
                    event.preventDefault();
                    $('#pre-loader').removeClass('d-none');
                    $('#deleteCategoryModal').modal('hide');
                    let id = $('#delete_category_id').val();
                    let data = {
                        'id' : id,
                        '_token' : '<?php echo e(csrf_token()); ?>',
                        'menu_id':'<?php echo e($menu->id); ?>'
                    }
                    $.post("<?php echo e(route('menu.setup.category-delete')); ?>",data, function(data){

                        $('#rightpanelListDiv').empty();
                        $('#rightpanelListDiv').html(data);
                        dynamicSelect2WithAjax(".right_category", "<?php echo e(url('/products/get-category-data')); ?>", "GET");
                        $('#pre-loader').addClass('d-none');
                        toastr.success("<?php echo e(__('common.deleted_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                        location.reload();
                    })
                    .fail(function(response) {
                    if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }

                    });
                });

                $(document).on('submit', '#brand_delete_form', function(event){
                    event.preventDefault();
                    $('#pre-loader').removeClass('d-none');
                    $('#deleteBrandModal').modal('hide');
                    let id = $('#delete_brand_id').val();
                    let data = {
                        'id' : id,
                        '_token' : '<?php echo e(csrf_token()); ?>',
                        'menu_id':'<?php echo e($menu->id); ?>'
                    }
                    $.post("<?php echo e(route('menu.setup.brand-delete')); ?>",data, function(data){

                        $('#bottompanelListDiv').empty();
                        $('#bottompanelListDiv').html(data);
                        dynamicSelect2WithAjax(".bottom_brand", "<?php echo e(route('product.brands.get-by-ajax')); ?>", "GET");
                        $('#pre-loader').addClass('d-none');
                        toastr.success("<?php echo e(__('common.deleted_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                        location.reload();
                    })
                    .fail(function(response) {
                    if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }
                    });
                });
                initSortable();
                function initSortable(){

                    $('.dd').nestable({
                        maxDepth:5,
                        callback:function(l,e){
                            let order = JSON.stringify($('.dd').nestable('serialize'));
                            let data = {
                                'order' : order,
                                '_token' : '<?php echo e(csrf_token()); ?>',
                                'menu_id' : '<?php echo e($menu->id); ?>'
                            }
                            $.post('<?php echo e(route('menu.setup.normal-menu.order')); ?>',data, function(data){
                                if(data != 1){
                                    toastr.error("<?php echo e(__('common.error_message')); ?>","<?php echo e(__('common.error')); ?>");
                                    location.reload();
                                }
                            })
                            .fail(function(response) {
                            if(response.responseJSON.error){
                                    toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                    $('#pre-loader').addClass('d-none');
                                    return false;
                                }
                            });
                        }
                    });

                    $('#itemDiv').sortable({
                        cursor: "move",
                        containment: "parent",
                        update:function(event, ui){
                            let ids = $(this).sortable('toArray',{ attribute: 'data-id'});
                            if(ids.length > 0){
                                $.post("<?php echo e(route('menu.setup.sort-column')); ?>",{'_token':'<?php echo e(csrf_token()); ?>','ids' : ids}, function(data){

                                })
                                .fail(function(response) {
                                if(response.responseJSON.error){
                                        toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                        $('#pre-loader').addClass('d-none');
                                        return false;
                                    }
                                });
                            }
                        }
                    }).disableSelection();
                    $(".item_list").sortable({
                        cursor: "move",
                        connectWith: ["#elementDiv",".item_list"],
                        update:function(event, ui){
                            let ids = $(this).sortable('toArray',{ attribute: 'data-id'});
                            if(ids.length > 0){
                                $.post("<?php echo e(route('menu.setup.sort-element')); ?>",{'_token':'<?php echo e(csrf_token()); ?>','ids' : ids}, function(data){
                                })
                                .fail(function(response) {
                                if(response.responseJSON.error){
                                        toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                        $('#pre-loader').addClass('d-none');
                                        return false;
                                    }

                                });
                            }
                        },
                        receive: function(event, ui){
                            let column_id = event.target.attributes[1].value;
                            let element = ui.item[0].attributes[1].value;
                            let data ={
                                'column_id' : column_id,
                                'element' : element,
                                '_token' : '<?php echo e(csrf_token()); ?>'
                            }

                            $.post("<?php echo e(route('menu.setup.add-to-column')); ?>",data, function(data){
                            })
                            .fail(function(response) {
                            if(response.responseJSON.error){
                                    toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                    $('#pre-loader').addClass('d-none');
                                    return false;
                                }

                            });
                        }
                    }).disableSelection();

                    $('#elementDiv').sortable({
                        connectWith: ".item_list",
                        cursor: "move",
                        update:function(event, ui){
                            let ids = $(this).sortable('toArray',{ attribute: 'data-id'});
                            if(ids.length > 0){
                                $.post("<?php echo e(route('menu.setup.sort-element')); ?>",{'_token':'<?php echo e(csrf_token()); ?>','ids' : ids}, function(data){
                                })
                                .fail(function(response) {
                                if(response.responseJSON.error){
                                        toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                        $('#pre-loader').addClass('d-none');
                                        return false;
                                    }
                                });
                            }
                        },
                        receive: function(event, ui){
                            let element = ui.item[0].attributes[1].value;
                            let data ={
                                'element' : element,
                                '_token' : '<?php echo e(csrf_token()); ?>'
                            }
                            $.post("<?php echo e(route('menu.setup.remove-from-column')); ?>",data, function(data){

                            })
                            .fail(function(response) {
                            if(response.responseJSON.error){
                                    toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                    $('#pre-loader').addClass('d-none');
                                    return false;
                                }
                            });
                        }
                    }).disableSelection();

                    $('#menuDiv').sortable({
                        cursor:"move",
                        update: function(event, ui){
                            let ids = $(this).sortable('toArray',{ attribute: 'data-id'});
                            if(ids.length > 0){
                                let data = {
                                    '_token' :'<?php echo e(csrf_token()); ?>',
                                    'ids' : ids,
                                    'menu_id' : '<?php echo e($menu->id); ?>'
                                }
                                $.post("<?php echo e(route('menu.setup.sort-menu')); ?>", data, function(data){

                                })
                                .fail(function(response) {
                                if(response.responseJSON.error){
                                        toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                        $('#pre-loader').addClass('d-none');
                                        return false;
                                    }

                                });
                            }
                        }
                    }).disableSelection();

                    $('#rightpanelListDiv').sortable({
                        cursor:"move",
                        update: function(event, ui){
                            let ids = $(this).sortable('toArray',{ attribute: 'data-id'});
                            if(ids.length > 0){
                                let data = {
                                    '_token' :'<?php echo e(csrf_token()); ?>',
                                    'ids' : ids,
                                    'menu_id' : '<?php echo e($menu->id); ?>'
                                }
                                $.post("<?php echo e(route('menu.setup.category-sort')); ?>", data, function(data){

                                })

                                .fail(function(response) {
                                if(response.responseJSON.error){
                                        toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                        $('#pre-loader').addClass('d-none');
                                        return false;
                                    }

                                });
                            }
                        }
                    }).disableSelection();

                    $('#bottompanelListDiv').sortable({
                        cursor:"move",
                        update: function(event, ui){
                            let ids = $(this).sortable('toArray',{ attribute: 'data-id'});
                            if(ids.length > 0){
                                let data = {
                                    '_token' :'<?php echo e(csrf_token()); ?>',
                                    'ids' : ids,
                                    'menu_id' : '<?php echo e($menu->id); ?>'
                                }
                                $.post("<?php echo e(route('menu.setup.brand-sort')); ?>", data, function(data){

                                })
                                .fail(function(response) {
                                if(response.responseJSON.error){
                                        toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                        $('#pre-loader').addClass('d-none');
                                        return false;
                                    }

                                });
                            }
                        }
                    }).disableSelection();
                }
                $(document).on('submit','#add_row_btn', function(event){
                    event.preventDefault();
                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                    var row = $('#row<?php echo e(auth()->user()->lang_code); ?>').val();
                    if (row == '') {
                        $('#error_row_<?php echo e(auth()->user()->lang_code); ?>').text('The column field is required');
                        return false;
                    }else{
                        $('#error_row_<?php echo e(auth()->user()->lang_code); ?>').text('');
                    }
                    <?php else: ?>
                    var row =  $('#row').val();
                    if (row == '') {
                        $('#error_row').text('The column field is required');
                        return false;
                    }else{
                        $('#error_row').text('');
                    }
                    <?php endif; ?>
                    let size = $('#size').val();
                    if (size == '') {
                        $('#error_size').text('The column size field is required');
                        return false;
                    }else{
                        $('#error_size').text('');
                    }
                    $('#pre-loader').removeClass('d-none');
                    var formElement = $(this).serializeArray()
                    var formData = new FormData();
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });
                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    formData.append('menu_id','<?php echo e($menu->id); ?>');
                    $.ajax({
                        url: "<?php echo e(route('menu.setup.add-column')); ?>",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            if(response.limit_cross){
                                toastr.warning(response.limit_cross,'Warning');
                            }else{
                                toastr.success("<?php echo e(__('common.created_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                                reloadWithData(response);
                            }
                            $('#pre-loader').addClass('d-none');
                            $('#size').val('');
                            $('.name').val('');
                            $('#size').niceSelect('update');
                            location.reload();
                        },
                        error: function(response) {
                            if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                $('#pre-loader').addClass('d-none');
                                return false;
                            }
                            $('#pre-loader').addClass('d-none');
                        }
                    });
                });

                $(document).on('click', '#add_category_btn', function(event){
                    let category = $('#category').val();
                    let catText = $('#category option:selected').text();
                    if(category.length > 0){

                        $('#category').val('');
                        dynamicSelect2WithAjax("#category", "<?php echo e(url('/products/get-category-data')); ?>", "GET");
                        let data = {
                            'menu_id' : '<?php echo e($menu->id); ?>',
                            'type' : 'category',
                            'element_id' : category,
                            '_token' : '<?php echo e(csrf_token()); ?>'
                        }
                        $('#pre-loader').removeClass('d-none');
                        $.post("<?php echo e(route('menu.setup.add-element')); ?>",data, function(data){
                            if(data){
                                toastr.success("<?php echo e(__('common.added_successfully')); ?>", "<?php echo e(__('common.success')); ?>");

                                reloadWithData(data);
                                location.reload();

                            }else{
                                toastr.error("<?php echo e(__('common.error_message')); ?>","<?php echo e(__('common.error')); ?>");
                            }
                            $('#pre-loader').addClass('d-none');
                        })
                        .fail(function(response) {
                        if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                $('#pre-loader').addClass('d-none');
                                return false;
                            }

                        });

                    }else{
                        toastr.error("<?php echo e(__('menu.category_required')); ?>","<?php echo e(__('common.error')); ?>");
                    }
                });
                $(document).on('submit','#add_link_btn', function(event) {
                    event.preventDefault();
                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                    var title = $('#title<?php echo e(auth()->user()->lang_code); ?>').val();
                    if (title == '') {
                        $('#error_title_<?php echo e(auth()->user()->lang_code); ?>').text('The title field is required');
                        return false;
                    }else{
                        $('#error_title_<?php echo e(auth()->user()->lang_code); ?>').text('');
                    }
                    <?php else: ?>
                    var title =  $('#title').val();
                    if (title == '') {
                        $('#error_title').text('The title field is required');
                        return false;
                    }else{
                        $('#error_title').text('');
                    }
                    <?php endif; ?>
                    $('#pre-loader').removeClass('d-none');
                    var formElement = $(this).serializeArray()
                    var formData = new FormData();
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });
                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    formData.append('menu_id', "<?php echo e($menu->id); ?>");
                    formData.append('type', "link");
                    $.ajax({
                        url: "<?php echo e(route('menu.setup.add-element')); ?>",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            toastr.success("<?php echo e(__('common.added_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                            reloadWithData(response);
                            $('#pre-loader').addClass('d-none');
                            $('.title').val('');
                            location.reload();
                        },
                        error: function(response) {
                            if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                $('#pre-loader').addClass('d-none');
                                return false;
                            }
                            $('#pre-loader').addClass('d-none');
                        }
                    });
                });

                $(document).on('click', '#add_page_btn', function(event){
                    let page = $('#page').val();
                    let pageText = $('#page option:selected').text();
                    if(page.length > 0){
                        $('#page').val('');
                        $('#page').niceSelect('update');
                        let data = {
                            'menu_id' : '<?php echo e($menu->id); ?>',
                            'type' : 'page',
                            'element_id' : page,
                            '_token' : '<?php echo e(csrf_token()); ?>'
                        }
                        $('#pre-loader').removeClass('d-none');
                        $.post("<?php echo e(route('menu.setup.add-element')); ?>",data, function(data){
                            if(data){
                                toastr.success("<?php echo e(__('common.added_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                                reloadWithData(data);
                                location.reload();

                            }else{
                                toastr.error("<?php echo e(__('common.error_message')); ?>","<?php echo e(__('common.error')); ?>");
                            }
                            $('#pre-loader').addClass('d-none');
                        })

                        .fail(function(response) {
                            if(response.responseJSON.error){
                                    toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                    $('#pre-loader').addClass('d-none');
                                    return false;
                                }

                            });
                    }else{
                        toastr.error("<?php echo e(__('menu.link_required')); ?>","<?php echo e(__('common.error')); ?>");
                    }
                });

                $(document).on('click', '#add_product_btn', function(event){
                    let product = $('#product').val();
                    let productText = $('#product option:selected').text();
                    if(product.length > 0){

                        $('#product').val('');
                        dynamicSelect2WithAjax("#product", "<?php echo e(url('/products/seller-products/get-by-ajax')); ?>", "GET");
                        let data = {
                            'menu_id' : '<?php echo e($menu->id); ?>',
                            'type' : 'product',
                            'element_id' : product,
                            '_token' : '<?php echo e(csrf_token()); ?>'
                        }
                        $('#pre-loader').removeClass('d-none');
                        $.post("<?php echo e(route('menu.setup.add-element')); ?>",data, function(data){
                            if(data){
                                toastr.success("<?php echo e(__('common.added_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                                reloadWithData(data);
                                location.reload();

                            }else{
                                toastr.error("<?php echo e(__('common.error_message')); ?>", "<?php echo e(__('common.error')); ?>");
                            }
                            $('#pre-loader').addClass('d-none');
                        })

                        .fail(function(response) {
                            if(response.responseJSON.error){
                                    toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                    $('#pre-loader').addClass('d-none');
                                    return false;
                                }

                            });
                    }else{
                        toastr.error("<?php echo e(__('menu.link_required')); ?>","<?php echo e(__('common.error')); ?>");
                    }
                });

                $(document).on('click', '#add_brand_btn', function(event){
                    let brand = $('#brand').val();

                    if(brand.length > 0){

                        $('#brand').val('');
                        dynamicSelect2WithAjax("#brand", "<?php echo e(route('product.brands.get-by-ajax')); ?>", "GET");
                        let data = {
                            'menu_id' : '<?php echo e($menu->id); ?>',
                            'type' : 'brand',
                            'element_id' : brand,
                            '_token' : '<?php echo e(csrf_token()); ?>'
                        }
                        $('#pre-loader').removeClass('d-none');
                        $.post("<?php echo e(route('menu.setup.add-element')); ?>",data, function(data){
                            if(data){
                                toastr.success("<?php echo e(__('common.added_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                                reloadWithData(data);
                                location.reload();

                            }else{
                                toastr.error("<?php echo e(__('common.error_message')); ?>", "<?php echo e(__('common.error')); ?>");
                            }
                            $('#pre-loader').addClass('d-none');
                        })
                        .fail(function(response) {
                        if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                $('#pre-loader').addClass('d-none');
                                return false;
                            }

                        });
                    }else{
                        toastr.error("<?php echo e(__('menu.brand_required')); ?>","<?php echo e(__('common.error')); ?>");
                    }
                });

                $(document).on('click', '#add_tag_btn', function(event){
                    let tag = $('#tag').val();
                    if(tag.length >0){
                        $('#tag').val('');
                        dynamicSelect2WithAjax("#tag", "<?php echo e(url('/setup/tags/get-by-ajax')); ?>", "GET");
                        let data = {
                            'menu_id' : '<?php echo e($menu->id); ?>',
                            'type' : 'tag',
                            'element_id' : tag,
                            '_token' : '<?php echo e(csrf_token()); ?>'
                        }
                        $('#pre-loader').removeClass('d-none');
                        $.post("<?php echo e(route('menu.setup.add-element')); ?>",data, function(data){
                            if(data){
                                toastr.success("<?php echo e(__('common.added_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                                reloadWithData(data);
                                location.reload();

                            }else{
                                toastr.error("<?php echo e(__('common.error_message')); ?>", "<?php echo e(__('common.error')); ?>");
                            }
                            $('#pre-loader').addClass('d-none');
                        })
                        .fail(function(response) {
                        if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                $('#pre-loader').addClass('d-none');
                                return false;
                            }

                        });
                    }else{
                        toastr.error("<?php echo e(__('menu.tags_required')); ?>","<?php echo e(__('common.error')); ?>");
                    }
                });

                $(document).on('click', '#add_func_btn', function(event){
                    let func = $('#function').val();
                    if(func){
                        $('#function').val('');
                        $('#function').niceSelect('update');
                        let data = {
                            'menu_id' : '<?php echo e($menu->id); ?>',
                            'type' : 'function',
                            'element_id' : func,
                            '_token' : '<?php echo e(csrf_token()); ?>'
                        }
                        $('#pre-loader').removeClass('d-none');
                        $.post("<?php echo e(route('menu.setup.add-element')); ?>",data, function(data){
                            if(data){
                                toastr.success("<?php echo e(__('common.added_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                                reloadWithData(data);
                                location.reload();

                            }else{
                                toastr.error("<?php echo e(__('common.error_message')); ?>", "<?php echo e(__('common.error')); ?>");
                            }
                            $('#pre-loader').addClass('d-none');
                        })
                        .fail(function(response) {
                        if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                $('#pre-loader').addClass('d-none');
                                return false;
                            }

                        });
                    }else{
                        toastr.error("<?php echo e(__('Please select first.')); ?>","<?php echo e(__('common.error')); ?>");
                    }
                });

                $(document).on('click','#add_menu_btn', function(event){
                    let menus = $('#menu').val();
                    if(menus.length >0){
                        $('#menu').val('');
                        $('#menu').niceSelect('update');
                        let data = {
                            'menu_id' : '<?php echo e($menu->id); ?>',
                            'type' : 'tag',
                            'menus' : menus,
                            '_token' : '<?php echo e(csrf_token()); ?>'
                        }
                        $('#pre-loader').removeClass('d-none');
                        $.post("<?php echo e(route('menu.setup.add-menu')); ?>",data, function(data){
                            if(data){
                                toastr.success("<?php echo e(__('common.added_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                                reloadWithData(data);
                                location.reload();

                            }else{
                                toastr.error("<?php echo e(__('common.error_message')); ?>", "<?php echo e(__('common.error')); ?>");
                            }
                            $('#pre-loader').addClass('d-none');
                        })

                        .fail(function(response) {
                            if(response.responseJSON.error){
                                    toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                    $('#pre-loader').addClass('d-none');
                                    return false;
                                }

                            });
                    }else{
                        toastr.error("<?php echo e(__('menu.menu_required')); ?>","<?php echo e(__('common.error')); ?>");
                    }
                });

                $(document).on('click','#add_category_rightpanel_btn', function(event){
                    let categories = $('#category_rightpanel').val();
                    if(categories.length >0){
                        $('#category_rightpanel').val('');
                        dynamicSelect2WithAjax("#category_rightpanel", "<?php echo e(url('/products/get-category-data')); ?>", "GET");
                        let data = {
                            'menu_id' : '<?php echo e($menu->id); ?>',
                            'categories' : categories,
                            '_token' : '<?php echo e(csrf_token()); ?>'
                        }
                        $('#pre-loader').removeClass('d-none');
                        $.post("<?php echo e(route('menu.setup.add-rightpanel-data')); ?>",data, function(data){
                            if(data){
                                $('#rightpanelListDiv').empty();
                                $('#rightpanelListDiv').html(data);
                                dynamicSelect2WithAjax(".right_category", "<?php echo e(url('/products/get-category-data')); ?>", "GET");
                                toastr.success("<?php echo e(__('common.added_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                                location.reload();

                            }else{
                                toastr.error("<?php echo e(__('common.error_message')); ?>", "<?php echo e(__('common.error')); ?>");
                            }
                            $('#pre-loader').addClass('d-none');
                        })

                        .fail(function(response) {
                            if(response.responseJSON.error){
                                    toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                    $('#pre-loader').addClass('d-none');
                                    return false;
                                }

                            });
                    }else{
                        toastr.error("<?php echo e(__('menu.category_required')); ?>","<?php echo e(__('common.error')); ?>");
                    }
                });

                $(document).on('click','#add_brand_bottompanel_create_btn', function(event){
                    let brands = $('#brand_bottompanel').val();
                    if(brands.length >0){
                        $('#brand_bottompanel').val('');
                        dynamicSelect2WithAjax("#brand_bottompanel", "<?php echo e(route('product.brands.get-by-ajax')); ?>", "GET");
                        let data = {
                            'menu_id' : '<?php echo e($menu->id); ?>',
                            'brands' : brands,
                            '_token' : '<?php echo e(csrf_token()); ?>'
                        }
                        $('#pre-loader').removeClass('d-none');
                        $.post("<?php echo e(route('menu.setup.add-bottompanel-data')); ?>",data, function(data){
                            if(data){
                                $('#bottompanelListDiv').empty();
                                $('#bottompanelListDiv').html(data);
                                dynamicSelect2WithAjax(".bottom_brand", "<?php echo e(route('product.brands.get-by-ajax')); ?>", "GET");
                                toastr.success("<?php echo e(__('common.added_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                                location.reload();

                            }else{
                                toastr.error("<?php echo e(__('common.error_message')); ?>", "<?php echo e(__('common.error')); ?>");
                            }
                            $('#pre-loader').addClass('d-none');
                        })
                        .fail(function(response) {
                        if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                $('#pre-loader').addClass('d-none');
                                return false;
                            }

                        });
                    }else{
                        toastr.error("<?php echo e(__('menu.brand_required')); ?>","<?php echo e(__('common.error')); ?>");
                    }
                });

                $(document).on('click', '.column_delete_btn', function(event) {
                    event.preventDefault();
                    let id = $(this).data('id');
                    if(id != null){
                        $('#delete_column_id').val(id);
                        $('#deleteColumnModal').modal('show');

                    }else{
                        toastr.error("<?php echo e(__('common.error_message')); ?>","<?php echo e(__('common.error')); ?>")
                    }

                });

                $(document).on('click', '.element_delete_btn', function(event) {
                    event.preventDefault();
                    let id = $(this).data('id');
                    if(id != null){
                        $('#delete_element_id').val(id);
                        $('#deleteElementModal').modal('show');

                    }else{
                        toastr.error("<?php echo e(__('common.error_message')); ?>","<?php echo e(__('common.error')); ?>");
                    }

                });
                $(document).on('click', '.menu_delete_btn', function(event) {
                    event.preventDefault();
                    let id = $(this).data('id');
                    if(id != null){
                        $('#delete_menu_id').val(id);
                        $('#deleteMenuModal').modal('show');

                    }else{
                        toastr.error("<?php echo e(__('common.error_message')); ?>", "<?php echo e(__('common.error')); ?>");
                    }

                });

                $(document).on('click', '.right_panel_category_delete_btn', function(event) {
                    event.preventDefault();
                    let id = $(this).data('id');

                    if(id != null){
                        $('#delete_category_id').val(id);
                        $('#deleteCategoryModal').modal('show');

                    }else{
                        toastr.error("<?php echo e(__('common.error_message')); ?>","<?php echo e(__('common.error')); ?>");
                    }

                });

                $(document).on('click', '.bottom_panel_brand_delete_btn', function(event) {
                    event.preventDefault();
                    let id = $(this).data('id');

                    if(id != null){
                        $('#delete_brand_id').val(id);
                        $('#deleteBrandModal').modal('show');

                    }else{
                        toastr.error("<?php echo e(__('common.error_message')); ?>","<?php echo e(__('common.error')); ?>");
                    }

                });

                $(document).on('submit', '#ads_form', function(event){
                    event.preventDefault();
                    $('#widget_form_btn').prop('disabled',true);
                    $('#widget_form_btn').text('<?php echo e(__("common.updating")); ?>');
                    $('#pre-loader').removeClass('d-none');
                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                        $('#ads_error_title_<?php echo e(auth()->user()->lang_code); ?>').text('');
                        $('#ads_error_subtitle_<?php echo e(auth()->user()->lang_code); ?>').text('');
                    <?php else: ?>
                        $('#ads_error_title').text('');
                        $('#ads_error_subtitle').text('');
                    <?php endif; ?>
                    $('#ads_error_link').text('');
                    $('#error_image').text('');

                    let formElement = $(this).serializeArray()
                    let formData = new FormData();
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });
                    let status = 0;
                    if ($('#status').is(":checked")){
                        status =1;
                    }else{
                        status = 0;
                    }
                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    formData.append('status', status);
                    $.ajax({
                        url: "<?php echo e(route('menu.setup.ads-update')); ?>",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            $('#pre-loader').addClass('d-none');
                            $('#ads_form_btn').prop('disabled',false);
                            $('#ads_form_btn').text('<?php echo e(__("common.update")); ?>');
                            toastr.success("<?php echo e(__('common.updated_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                            location.reload();
                        },
                        error: function(response) {
                            $('#pre-loader').addClass('d-none');
                            $('#ads_form_btn').prop('disabled',false);
                            $('#ads_form_btn').text('<?php echo e(__("common.update")); ?>');

                            if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                $('#pre-loader').addClass('d-none');
                            }else{
                                <?php if(isModuleActive('FrontendMultiLang')): ?>
                                    $('#ads_error_title_<?php echo e(auth()->user()->lang_code); ?>').text(response.responseJSON.errors['title.<?php echo e(auth()->user()->lang_code); ?>']);
                                    $('#ads_error_subtitle_<?php echo e(auth()->user()->lang_code); ?>').text(response.responseJSON.errors['subtitle.<?php echo e(auth()->user()->lang_code); ?>']);
                                <?php else: ?>
                                    $('#ads_error_title').text(response.responseJSON.errors.title);
                                    $('#ads_error_subtitle').text(response.responseJSON.errors.subtitle);
                                <?php endif; ?>
                                $('#ads_error_link').text(response.responseJSON.errors.link);
                                $('#error_image').text(response.responseJSON.errors.menu_ads_image);
                            }

                        }
                    });
                });

                function reloadWithData(response){
                    $('#div333').empty();
                    $('#div333').append(response);
                    $('.edit_page').niceSelect();
                    dynamicSelect2WithAjax(".edit_category", "<?php echo e(url('/products/get-category-data')); ?>", "GET");
                    dynamicSelect2WithAjax(".edit_product", "<?php echo e(url('/products/seller-products/get-by-ajax')); ?>", "GET");
                    dynamicSelect2WithAjax(".edit_brand", "<?php echo e(route('product.brands.get-by-ajax')); ?>", "GET");
                    dynamicSelect2WithAjax(".edit_tag", "<?php echo e(url('/setup/tags/get-by-ajax')); ?>", "GET");
                    $('.edit_function').niceSelect();
                    $('.edit_size').niceSelect();
                    $('.edit_menu').niceSelect();
                    initSortable();
                }
                dynamicSelect2WithAjax("#category", "<?php echo e(url('/products/get-category-data')); ?>", "GET");
                dynamicSelect2WithAjax(".edit_category", "<?php echo e(url('/products/get-category-data')); ?>", "GET");
                dynamicSelect2WithAjax("#category_rightpanel", "<?php echo e(url('/products/get-category-data')); ?>", "GET");
                dynamicSelect2WithAjax(".right_category", "<?php echo e(url('/products/get-category-data')); ?>", "GET");
                dynamicSelect2WithAjax("#product", "<?php echo e(url('/products/seller-products/get-by-ajax')); ?>", "GET");
                dynamicSelect2WithAjax(".edit_product", "<?php echo e(url('/products/seller-products/get-by-ajax')); ?>", "GET");
                dynamicSelect2WithAjax("#brand", "<?php echo e(route('product.brands.get-by-ajax')); ?>", "GET");
                dynamicSelect2WithAjax(".edit_brand", "<?php echo e(route('product.brands.get-by-ajax')); ?>", "GET");
                dynamicSelect2WithAjax("#brand_bottompanel", "<?php echo e(route('product.brands.get-by-ajax')); ?>", "GET");
                dynamicSelect2WithAjax(".bottom_brand", "<?php echo e(route('product.brands.get-by-ajax')); ?>", "GET");
                dynamicSelect2WithAjax("#tag", "<?php echo e(url('/setup/tags/get-by-ajax')); ?>", "GET");
                dynamicSelect2WithAjax(".edit_tag", "<?php echo e(url('/setup/tags/get-by-ajax')); ?>", "GET");

            });
        })(jQuery);

    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/DhatriProduction/Modules/Menu/Resources/views/menu/components/_setup_script.blade.php ENDPATH**/ ?>