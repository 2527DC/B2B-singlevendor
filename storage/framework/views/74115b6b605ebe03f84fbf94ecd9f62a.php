<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/appearance/css/header_setup.css'))); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="col-md-12 mb-20">
            <div class="">
                <div class="float-none pos_tab_btn">
                    <ul class="nav" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" href="#GeneralSeting" role="tab" data-toggle="tab" id="1" aria-selected="true"><?php echo e(__('marketing.general_setting')); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link show" href="#Setup" role="tab" data-toggle="tab" id="2" aria-selected="false"><?php echo e(__('common.setup')); ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade active show" id="GeneralSeting">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="box_header">
                            <div class="main-title d-flex justify-content-between w-100">
                                <h3 class="mb-0 mr-30">
                                    <?php if($header->type == 'slider'): ?>
                                    <?php echo e(__('appearance.slider')); ?>

                                    <?php elseif($header->type == 'category'): ?>
                                    <?php echo e(__('common.category')); ?>

                                    <?php elseif($header->type == 'product'): ?>
                                    <?php echo e(__('common.product')); ?>

                                    <?php elseif($header->type == 'new_user_zone'): ?>
                                    <?php echo e(__('marketing.new_user_zone')); ?>

                                    <?php endif; ?>
                                    <?php echo e(__('appearance.section_general_setting')); ?></h3>
                            </div>
                        </div>
                        <div class="white_box_50px box_shadow_white mb-40 min-height-400">
                            <form method="POST" id="category_genaral_form">
                                <div class="row">
                                    <input type="hidden" name="id" value="<?php echo e($header->id); ?>">
                                    <input type="hidden" name="section_for" id="section_for" value="<?php echo e($header->type); ?>">
                                    <div class="col-lg-12 <?php echo e(app('theme')->name == 'Amazy' ? 'd-none':''); ?>">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label" for=""><?php echo e(__('appearance.column_size')); ?> </label>
                                            <select name="column_size" id="column_size" class="primary_select mb-15 "
                                                required="1" data-value="<?php echo e($header->column_size); ?>">
                                                <option disabled selected><?php echo e(__('common.select_one')); ?></option>
                                                <option <?php echo e($header->column_size == '1 column'?'selected':''); ?> value="1 column"><?php echo e(__('appearance.1_column')); ?></option>
                                                <option <?php echo e($header->column_size == '2 column'?'selected':''); ?> value="2 column"><?php echo e(__('appearance.2_column')); ?></option>
                                                <option <?php echo e($header->column_size == '3 column'?'selected':''); ?> value="3 column"><?php echo e(__('appearance.3_column')); ?></option>
                                                <option <?php echo e($header->column_size == '4 column'?'selected':''); ?> value="4 column"><?php echo e(__('appearance.4_column')); ?></option>
                                                <option <?php echo e($header->column_size == '5 column'?'selected':''); ?> value="5 column"><?php echo e(__('appearance.5_column')); ?></option>
                                                <option <?php echo e($header->column_size == '6 column'?'selected':''); ?> value="6 column"><?php echo e(__('appearance.6_column')); ?></option>
                                                <option <?php echo e($header->column_size == '7 column'?'selected':''); ?> value="7 column"><?php echo e(__('appearance.7_column')); ?></option>
                                                <option <?php echo e($header->column_size == '8 column'?'selected':''); ?> value="8 column"><?php echo e(__('appearance.8_column')); ?></option>
                                                <option <?php echo e($header->column_size == '9 column'?'selected':''); ?> value="9 column"><?php echo e(__('appearance.9_column')); ?></option>
                                                <option <?php echo e($header->column_size == '10 column'?'selected':''); ?> value="10 column"><?php echo e(__('appearance.10_column')); ?></option>
                                                <option <?php echo e($header->column_size == '11 column'?'selected':''); ?> value="11 column"><?php echo e(__('appearance.11_column')); ?></option>
                                                <option <?php echo e($header->column_size == '12 column'?'selected':''); ?> value="12 column"><?php echo e(__('appearance.12_column')); ?></option>
                                            </select>
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="primary_input">
                                            <ul id="theme_nav" class="permission_list sms_list ">
                                                <li>
                                                    <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                        <input name="is_enable" id="is_enable" value="1"
                                                            <?php echo e($header->is_enable ==1?'checked':''); ?>

                                                        type="checkbox">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <p><?php echo e(__('appearance.enable_this_section')); ?></p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <div class="d-flex pt_20">
                                            <button type="submit" class="primary-btn fix-gr-bg"><i class="ti-check"></i>
                                                <?php echo e(__('common.update')); ?>

                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="iframe_div">
                            <iframe id="myFrame" src="<?php echo e(url('/')); ?>" frameborder="0" scrolling="no"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="Setup">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="box_header">
                            <div class="main-title d-flex justify-content-between w-100">
                                <h3 class="mb-0 mr-30">
                                    <?php if($header->type == 'slider'): ?>
                                    <?php echo e(__('appearance.slider_section_setup')); ?>

                                    <?php elseif($header->type == 'category'): ?>
                                    <?php echo e(__('appearance.category_section_setup')); ?>

                                    <?php elseif($header->type == 'product'): ?>
                                    <?php echo e(__('appearance.product_section_setup')); ?>

                                    <?php endif; ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <?php if($header->type == 'new_user_zone'): ?>
                    <div class="col-lg-8">
                        <div class="box_header">
                            <div class="main-title d-flex justify-content-between w-100">
                                <h3 class="mb-0 mr-30">
                                    <?php echo e(__('appearance.new_user_zone_section_setup')); ?>

                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="white_box_50px box_shadow_white mb-40 min-height-430">
                            <form action="POST" id="element_edit_form">
                                <div class="row">
                                    <input type="hidden" name="header_id" value="<?php echo e($header->id); ?>">
                                    <input type="hidden" id="header_type" value="<?php echo e($header->type); ?>">
                                    <div class="col-lg-12">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label" for="navigation_label"> <?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                            <input class="primary_input_field navigation_label" type="text" name="navigation_label" id="navigation_label_id" autocomplete="off" value="<?php echo e(@$header->newUserZonePanel()->navigation_label); ?>" placeholder="<?php echo e(__('marketing.navigation_label')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label" for="title"> <?php echo e(__('common.title')); ?> <span class="text-danger">*</span></label>
                                            <input class="primary_input_field title" type="text" name="title" autocomplete="off" id="title_id" value="<?php echo e(@$header->newUserZonePanel()->title); ?>" placeholder="<?php echo e(__('common.title')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label" for="pricing">
                                                <?php echo e(__('frontendCms.pricing')); ?> <span class="text-danger">*</span></label>
                                            <input class="primary_input_field pricing" type="text" name="pricing"
                                                id="pricing_id" autocomplete="off"
                                                value="<?php echo e(@$header->newUserZonePanel()->pricing); ?>"
                                                placeholder="<?php echo e(__('frontendCms.pricing')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label" for=""><?php echo e(__('marketing.new_user_zone')); ?> <?php echo e(__('common.list')); ?> <span class="text-danger">*</span></label>
                                            <select name="new_user_zone_id" id="new_user_zone_id"
                                                class="primary_select mb-15">
                                                <?php $__currentLoopData = $ZoneLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e($header->newUserZonePanel()->new_user_zone_id ==
                                                    $zone->id?'selected':''); ?> value="<?php echo e($zone->id); ?>"><?php echo e($zone->title); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 text-center">
                                        <button class="primary_btn_2 mt-5" id="widget_form_btn"><i
                                                class="ti-check"></i><?php echo e(__('common.update')); ?>

                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="col-lg-5">
                        <?php echo $__env->make('appearance::header.components.create_element',['type' => $header->type], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="col-md-7">
                        <div id="item_div">
                            <?php echo $__env->make('appearance::header.components.element_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</section>
<?php if($header->type == 'slider'): ?>
<?php echo $__env->make('backEnd.partials._deleteModalForAjax',['item_name' => __('appearance.slider'),'modal_id' =>
'deleteSliderModal','form_id' => 'slider_delete_form','delete_item_id' => 'delete_slider_id','dataDeleteBtn'
=>'sliderDeleteBtn'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif($header->type == 'category'): ?>
<?php echo $__env->make('backEnd.partials._deleteModalForAjax',['item_name' => __('common.category'),'modal_id' =>
'deleteCategoryModal','form_id' => 'category_delete_form','delete_item_id' => 'delete_category_id','dataDeleteBtn'
=>'categoryDeleteBtn'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif($header->type == 'product'): ?>
<?php echo $__env->make('backEnd.partials._deleteModalForAjax',['item_name' => __('common.products'),'modal_id' =>
'deleteProductModal','form_id' => 'product_delete_form','delete_item_id' => 'delete_product_id','dataDeleteBtn'
=>'productDeleteBtn'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    (function($){
        "use strict";
        $(document).ready(function() {
            $(document).on('change', '#column_size', function(){
                let form = $('#section_for').val();
                let column_size = $(this).data('value');
                let value = $('#column_size').val();
                let column = '';
                if(value == '1 column'){
                    column = 'col-xl-1 col-lg-12 col-md-12';
                }
                if(value == '2 column'){
                    column = 'col-xl-2 col-lg-12 col-md-12';
                }
                if(value == '3 column'){
                    column = 'col-xl-3 col-lg-12 col-md-12';
                }
                if(value == '4 column'){
                    column = 'col-xl-4 col-lg-12 col-md-12';
                }
                if(value == '5 column'){
                    column = 'col-xl-5 col-lg-12 col-md-12';
                }
                if(value == '6 column'){
                    column = 'col-xl-6 col-lg-12 col-md-12';
                }
                if(value == '7 column'){
                    column = 'col-xl-7 col-lg-12 col-md-12';
                }
                if(value == '8 column'){
                    column = 'col-xl-8 col-lg-12 col-md-12';
                }
                if(value == '9 column'){
                    column = 'col-xl-9 col-lg-12 col-md-12';
                }
                if(value == '10 column'){
                    column = 'col-xl-10 col-lg-12 col-md-12';
                }
                if(value == '11 column'){
                    column = 'col-xl-11 col-lg-12 col-md-12';
                }
                if(value == '12 column'){
                    column = 'col-xl-12 col-lg-12 col-md-12';
                }
                if ($('#is_enable').is(":checked")){
                    column += '';
                }else{
                    column += ' d-none';
                }
                $("#myFrame").contents().find('#'+form).removeAttr('class');
                $("#myFrame").contents().find('#'+form).attr('class',column);
            });
            $(document).on('change','#is_enable',function(event){
                    let val = 0;
                    let form = $('#section_for').val();

                    if ($('#is_enable').is(":checked")){
                        val = 1;
                        $("#myFrame").contents().find('#'+form).removeClass('d-none');
                    }else{
                        val = 0;
                        $("#myFrame").contents().find('#'+form).addClass('d-none');
                    }
            });
            $(document).on('mouseover','body',function(){
                $('#categoryDiv').sortable({
                    cursor:"move",
                    update: function(event, ui){
                        let ids = $(this).sortable('toArray',{ attribute: 'data-id'});
                        if(ids.length > 0){
                            let data = {
                                '_token' :'<?php echo e(csrf_token()); ?>',
                                'ids' : ids,
                                'header_id' : '<?php echo e($header->id); ?>'
                            }
                            $.post("<?php echo e(route('appearance.slider.setup.sort-element')); ?>", data, function(data){
                            });
                        }
                    }
                }).disableSelection();
                $('#productDiv').sortable({
                    cursor:"move",
                    update: function(event, ui){
                        let ids = $(this).sortable('toArray',{ attribute: 'data-id'});
                        if(ids.length > 0){
                            let data = {
                                '_token' :'<?php echo e(csrf_token()); ?>',
                                'ids' : ids,
                                'header_id' : '<?php echo e($header->id); ?>'
                            }
                            $.post("<?php echo e(route('appearance.slider.setup.sort-element')); ?>", data, function(data){
                            });
                        }
                    }
                }).disableSelection();
                $('#sliderDiv').sortable({
                    cursor:"move",
                    update: function(event, ui){
                        let ids = $(this).sortable('toArray',{ attribute: 'data-id'});
                        if(ids.length > 0){
                            let data = {
                                '_token' :'<?php echo e(csrf_token()); ?>',
                                'ids' : ids,
                                'header_id' : '<?php echo e($header->id); ?>'
                            }
                            $.post("<?php echo e(route('appearance.slider.setup.sort-element')); ?>", data, function(data){

                            });
                        }
                    }
                }).disableSelection();
            });
            $(document).on('submit', '#category_genaral_form', function(event) {
                event.preventDefault();
                $('#pre-loader').removeClass('d-none');
                var formElement = $(this).serializeArray()
                var formData = new FormData();
                formElement.forEach(element => {
                    formData.append(element.name, element.value);
                });
                formData.append('_token', "<?php echo e(csrf_token()); ?>");
                $.ajax({
                    url: "<?php echo e(route('appearance.slider.update')); ?>",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                        toastr.success("<?php echo e(__('common.updated_successfully')); ?>")
                        $('#pre-loader').addClass('d-none');
                        document.getElementById('myFrame').contentWindow.location.reload();
                    },
                    error: function(response) {
                        if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }
                        $('#pre-loader').addClass('d-none');
                        toastr.error('<?php echo e(__("common.error_message")); ?>');
                    }
                });
            });
            $(document).on('submit', '#add_element_form', function(event) {
                event.preventDefault();
                $('#pre-loader').removeClass('d-none');
                var formElement = $(this).serializeArray()
                var formData = new FormData();
                formElement.forEach(element => {
                    formData.append(element.name, element.value);
                });
                let form = $(this)[0];
                let header_type = form.create_header_type.value;
                formData.append('_token', "<?php echo e(csrf_token()); ?>");
                if(header_type =='slider'){
                    resetValidationErrors();
                    $.ajax({
                        url: "<?php echo e(route('appearance.slider.setup.add-element')); ?>",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            toastr.success("<?php echo e(__('common.added_successfully')); ?>")
                            $('#pre-loader').addClass('d-none');
                            resetValidationErrors();
                            reloadWithData(response);
                            slider_form_reset();
                            form.reset();
                            Amaz.uploader.previewGenerate();
                        },
                        error: function(response) {
                            if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                $('#pre-loader').addClass('d-none');
                                return false;
                            }else{
                                showValidationErrors(response.responseJSON.errors);
                                $('#pre-loader').addClass('d-none');
                                toastr.error('<?php echo e(__("common.error_message")); ?>');
                            }
                        }
                    });
                }
                if(header_type == 'category'){
                    let category = $('#category').val();
                    if(category.length > 0){
                        $.ajax({
                            url: "<?php echo e(route('appearance.slider.setup.add-element')); ?>",
                            type: "POST",
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: formData,
                            success: function(response) {
                                toastr.success("<?php echo e(__('common.added_successfully')); ?>")
                                $('#pre-loader').addClass('d-none');
                                reloadWithData(response);
                                $('#category').val('');
                                dynamicSelect2WithAjax(".slider_category", "<?php echo e(url('/products/get-category-data')); ?>", "GET");
                            },
                            error: function(response) {
                                if(response.responseJSON.error){
                                    toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                    $('#pre-loader').addClass('d-none');
                                    return false;
                                }
                                $('#pre-loader').addClass('d-none');
                                toastr.error('<?php echo e(__("common.error_message")); ?>');
                            }
                        });
                    }else{
                        toastr.error("<?php echo e(__('appearance.category_required')); ?>", "<?php echo e(__('common.error')); ?>");
                        $('#pre-loader').addClass('d-none');
                    }
                }
                if(header_type == 'product'){
                    let product = $('#product').val();
                    if(product.length > 0){
                        $.ajax({
                            url: "<?php echo e(route('appearance.slider.setup.add-element')); ?>",
                            type: "POST",
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: formData,
                            success: function(response) {
                                toastr.success("<?php echo e(__('common.added_successfully')); ?>")
                                $('#pre-loader').addClass('d-none');
                                reloadWithData(response);
                                $('#product').val('');
                                dynamicSelect2WithAjax(".product", "<?php echo e(url('/products/seller-products/get-by-ajax')); ?>", "GET");
                            },
                            error: function(response) {
                                if(response.responseJSON.error){
                                    toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                    $('#pre-loader').addClass('d-none');
                                    return false;
                                }
                                $('#pre-loader').addClass('d-none');
                                toastr.error('<?php echo e(__("common.error_message")); ?>');
                            }
                        });
                    }else{
                        toastr.error("<?php echo e(__('appearance.product_required')); ?>", "<?php echo e(__('common.error')); ?>");
                        $('#pre-loader').addClass('d-none');
                    }
                }
            });
            $(document).on('change', '.element_list_data_type', function(event){
                let element_list_data_type = $(this).val();
                let data_div = $(this).data('id');
                if(element_list_data_type != null){
                    $('#pre-loader').removeClass('d-none');
                    let data = {
                        '_token' : '<?php echo e(csrf_token()); ?>',
                        'data_type' : element_list_data_type
                    }
                    $.post("<?php echo e(route('appearance.slider.get-slider-type-data')); ?>", data, function(response){
                        $('#pre-loader').addClass('d-none');
                        $(data_div).html(response);
                        dynamicSelect2WithAjax(".product", "<?php echo e(url('/products/seller-products/get-by-ajax')); ?>", "GET");
                        dynamicSelect2WithAjax(".category", "<?php echo e(url('/products/get-category-data')); ?>", "GET");
                        dynamicSelect2WithAjax(".slider_brand", "<?php echo e(route('product.brands.get-by-ajax')); ?>", "GET");
                        dynamicSelect2WithAjax(".slider_tag", "<?php echo e(url('/setup/tags/get-by-ajax')); ?>", "GET");
                    });
                }
            });
            $(document).on('submit', '#element_edit_form', function(event) {
                event.preventDefault();
                $('#pre-loader').removeClass('d-none');
                var formElement = $(this).serializeArray()
                var formData = new FormData();
                formElement.forEach(element => {
                    formData.append(element.name, element.value);
                });
                let header_type = $(this)[0].header_type.value;
                if(header_type == 'new_user_zone'){
                    let new_user_zone_id = $('#new_user_zone_id').val();
                    let navigation_label_id = $('#navigation_label_id').val();
                    let title_id = $('#title_id').val();
                    let pricing_id = $('#pricing_id').val();
                    if(navigation_label_id == ''){
                        $('#pre-loader').addClass('d-none');
                        toastr.error("<?php echo e(__('appearance.navigation_label_is_required')); ?>");
                        return false;
                    }
                    if(title_id == ''){
                        $('#pre-loader').addClass('d-none');
                        toastr.error("<?php echo e(__('appearance.title_is_required')); ?>");
                        return false;
                    }
                    if(pricing_id == ''){
                        $('#pre-loader').addClass('d-none');
                        toastr.error("<?php echo e(__('appearance.pricing_is_required')); ?>");
                        return false;
                    }
                    if(new_user_zone_id == null){
                        $('#pre-loader').addClass('d-none');
                        toastr.error("<?php echo e(__('appearance.new_user_zone_is_required')); ?>");
                        return false;
                    }
                }
                if(header_type == 'category'){
                    if(formElement.title == ''){
                        toastr.error("<?php echo e(__('appearance.navigation_field_is_required')); ?>");
                        return false;
                    }
                }
                formData.append('_token', "<?php echo e(csrf_token()); ?>");
                editresetValidationErrors();
                $.ajax({
                    url: "<?php echo e(route('appearance.slider.setup.update-element')); ?>",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                        toastr.success("<?php echo e(__('common.updated_successfully')); ?>")
                        $('#pre-loader').addClass('d-none');
                        reloadWithData(response);
                        editresetValidationErrors();
                        slider_form_reset();
                        Amaz.uploader.previewGenerate();
                    },
                    error: function(response) {
                        if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }else{
                            editshowValidationErrors(response.responseJSON.errors);
                            $('#pre-loader').addClass('d-none');
                            toastr.error('<?php echo e(__("common.error_message")); ?>');
                        }
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
                    'header_id':'<?php echo e($header->id); ?>'
                }
                $.post("<?php echo e(route('appearance.slider.setup.delete-element')); ?>",data, function(data){
                    toastr.success("<?php echo e(__('common.deleted_successfully')); ?>")
                    $('#pre-loader').addClass('d-none');
                    reloadWithData(data);
                })
                .fail(function(response) {
                    if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }
                    });
            });
            $(document).on('submit', '#product_delete_form', function(event){
                event.preventDefault();
                $('#pre-loader').removeClass('d-none');
                $('#deleteProductModal').modal('hide');
                let id = $('#delete_product_id').val();
                let data = {
                    'id' : id,
                    '_token' : '<?php echo e(csrf_token()); ?>',
                    'header_id':'<?php echo e($header->id); ?>'
                }
                $.post("<?php echo e(route('appearance.slider.setup.delete-element')); ?>",data, function(data){
                    toastr.success("<?php echo e(__('common.deleted_successfully')); ?>")
                    $('#pre-loader').addClass('d-none');
                    reloadWithData(data);
                })
                .fail(function(response) {
                    if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }
                });
            });
            $(document).on('submit', '#slider_delete_form', function(event){
                event.preventDefault();
                $('#pre-loader').removeClass('d-none');
                $('#deleteSliderModal').modal('hide');
                let id = $('#delete_slider_id').val();
                let data = {
                    'id' : id,
                    '_token' : '<?php echo e(csrf_token()); ?>',
                    'header_id':'<?php echo e($header->id); ?>'
                }
                $.post("<?php echo e(route('appearance.slider.setup.delete-element')); ?>",data, function(data){
                    toastr.success("<?php echo e(__('common.deleted_successfully')); ?>")
                    $('#pre-loader').addClass('d-none');
                    reloadWithData(data);
                })
                .fail(function(response) {
                if(response.responseJSON.error){
                        toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                        $('#pre-loader').addClass('d-none');
                        return false;
                    }
                });
            });
            $(document).on('click', '.category_delete_btn', function(event){
                event.preventDefault();
                let id = $(this).data('id');
                if(id != null){
                    $('#delete_category_id').val(id);
                    $('#deleteCategoryModal').modal('show');

                }else{
                    toastr.error('<?php echo e(__("common.error_message")); ?>')
                }
            });
            $(document).on('click', '.product_delete_btn', function(event){
                event.preventDefault();
                let id = $(this).data('id');
                if(id != null){
                    $('#delete_product_id').val(id);
                    $('#deleteProductModal').modal('show');
                }else{
                    toastr.error('<?php echo e(__("common.error_message")); ?>')
                }
            });
            $(document).on('click', '.slider_delete_btn', function(event){
                event.preventDefault();
                let id = $(this).data('id');
                if(id != null){
                    $('#delete_slider_id').val(id);
                    $('#deleteSliderModal').modal('show');

                }else{
                    toastr.error('<?php echo e(__("common.error_message")); ?>')
                }
            });
            function showValidationErrors(errors) {
            <?php if(isModuleActive('FrontendMultiLang')): ?>
                $('#error_name_<?php echo e(auth()->user()->lang_code); ?>').text(errors['name.<?php echo e(auth()->user()->lang_code); ?>']);
            <?php else: ?>
                $('#error_name').text(errors.name);
            <?php endif; ?>
                $('#error_image').text(errors.slider_image_media);
            }
            function editshowValidationErrors(errors) {
                let id = $('.element_id').val();
            <?php if(isModuleActive('FrontendMultiLang')): ?>
                $('#edit_error_name_<?php echo e(auth()->user()->lang_code); ?>'+id).text(errors['name.<?php echo e(auth()->user()->lang_code); ?>']);
            <?php else: ?>
                $('#edit_error_name'+id).text(errors.name);
            <?php endif; ?>
                $('#edit_error_image'+id).text(errors.slider_image_media);
            }
            function resetValidationErrors(){
                <?php if(isModuleActive('FrontendMultiLang')): ?>
                $('#error_name_<?php echo e(auth()->user()->lang_code); ?>').text('');
                <?php else: ?>
                $('#error_name').text('');
                <?php endif; ?>
                $('#error_image').text('');
            }
            function editresetValidationErrors(){
                let id = $('.element_id').val();
                <?php if(isModuleActive('FrontendMultiLang')): ?>
                $('#edit_error_name_<?php echo e(auth()->user()->lang_code); ?>'+id).text('');
                <?php else: ?>
                $('#edit_error_name'+id).text('');
                <?php endif; ?>
                $('#edit_error_image'+id).text('');
            }
            $(document).on('change', '#slider_for', function(event){
                let data_type = $('#slider_for').val();
                if(data_type != null){
                    $('#pre-loader').removeClass('d-none');
                    let data = {
                        '_token' : '<?php echo e(csrf_token()); ?>',
                        'data_type' : data_type
                    }
                    $.post("<?php echo e(route('appearance.slider.get-slider-type-data')); ?>", data, function(response){
                        $('#pre-loader').addClass('d-none');
                        $('#slider_for_data_div').html(response);
                        $('.slider_drop').niceSelect();
                        dynamicSelect2WithAjax(".product", "<?php echo e(url('/products/seller-products/get-by-ajax')); ?>", "GET");
                        dynamicSelect2WithAjax(".category", "<?php echo e(url('/products/get-category-data')); ?>", "GET");
                        dynamicSelect2WithAjax(".slider_brand", "<?php echo e(route('product.brands.get-by-ajax')); ?>", "GET");
                        dynamicSelect2WithAjax(".slider_tag", "<?php echo e(url('/setup/tags/get-by-ajax')); ?>", "GET");
                    });
                }
            });
            function slider_form_reset(){

                $('#sliderImgFileDiv').html(
                    `<div class="primary_input mb-25">
                        <div class="primary_file_uploader" data-toggle="amazuploader" data-multiple="false" data-type="image" data-name="slider_image_media">
                            <input class="primary-input file_amount" type="text" id="image" placeholder="<?php echo e(__('common.browse_image_file')); ?>" readonly="">
                            <button class="" type="button">
                                <label class="primary-btn small fix-gr-bg" for="image"><?php echo e(__("common.image")); ?> </label>
                                <input type="hidden" class="selected_files" value="">
                            </button>
                        </div>
                        <div class="product_image_all_div">
                        </div>
                    </div>
                    <span class="text-danger" id="error_image"> </span>`
                );
                $('#slider_for_data_div').empty();
                $('#slider_data_type_div').html(
                    `<div class="primary_input mb-25">
                        <label class="primary_input_label" for=""><?php echo e(__('appearance.slider_for')); ?></label>
                        <select name="data_type" id="slider_for" class="primary_select mb-15">
                            <option value="" selected disabled><?php echo e(__('common.select_one')); ?></option>
                            <option value="product"><?php echo e(__('appearance.for_product')); ?></option>
                            <option value="category"><?php echo e(__('appearance.for_category')); ?></option>
                            <option value="brand"><?php echo e(__('appearance.for_brand')); ?></option>
                            <option value="tag"><?php echo e(__('appearance.for_tag')); ?></option>
                            <option value="url"><?php echo e(__('appearance.for_url_not_support_in_mobile_app')); ?></option>
                        </select>
                        <span class="text-danger" id="error_slider_data_type"></span>
                    </div>
                    `
                );
                $('#slider_for').niceSelect();
            }
            function reloadWithData(response){
                Amaz.uploader.previewGenerate();
                $('#item_div').empty();
                $('.product_image_all_div').empty();
                $('.file_amount').attr('placeholder', '');
                $('#item_div').html(response);
                $('.edit_slider_drop').niceSelect();
                dynamicSelect2WithAjax(".product", "<?php echo e(url('/products/seller-products/get-by-ajax')); ?>", "GET");
                dynamicSelect2WithAjax(".category", "<?php echo e(url('/products/get-category-data')); ?>", "GET");
                dynamicSelect2WithAjax(".slider_brand", "<?php echo e(route('product.brands.get-by-ajax')); ?>", "GET");
                dynamicSelect2WithAjax(".slider_tag", "<?php echo e(url('/setup/tags/get-by-ajax')); ?>", "GET");
            }
            dynamicSelect2WithAjax(".product", "<?php echo e(url('/products/seller-products/get-by-ajax')); ?>", "GET");
            dynamicSelect2WithAjax(".category", "<?php echo e(url('/products/get-category-data')); ?>", "GET");
            dynamicSelect2WithAjax(".slider_brand", "<?php echo e(route('product.brands.get-by-ajax')); ?>", "GET");
            dynamicSelect2WithAjax(".slider_tag", "<?php echo e(url('/setup/tags/get-by-ajax')); ?>", "GET");
        });
    })(jQuery);
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Production_dev/Modules/Appearance/Resources/views/header/components/setup.blade.php ENDPATH**/ ?>