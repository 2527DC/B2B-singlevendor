@extends('backEnd.master')
@section('styles')
    <link rel="stylesheet" href="{{asset(asset_path('modules/product/css/product_index.css'))}}">
@endsection
@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-12 mb-20">
                    <div class="box_header_right">
                        <div class="float-lg-right float-none pos_tab_btn justify-content-end">
                            <ul class="nav nav_list" role="tablist">
                                @if (permissionCheck('product.get-data'))
                                    <li class="nav-item">
                                        <a class="nav-link active show" href="#order_processing_data" role="tab"
                                            data-toggle="tab" id="product_list_id" aria-selected="true">{{__('product.product_list')}}</a>
                                    </li>
                                @endif
                                @if (isModuleActive('MultiVendor'))
                                    @if(permissionCheck('product.request-get-data'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="#order_complete_data" role="tab" data-toggle="tab" id="product_request_id"
                                            aria-selected="true">{{__('product.seller_request_product')}}</a>
                                    </li>
                                    @endif
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="#alert_list" role="tab" data-toggle="tab" id="product_alert_id"
                                            aria-selected="true">{{__('product.alert_list')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#stock_out_list" role="tab" data-toggle="tab" id="product_stock_out_id"
                                            aria-selected="true">{{__('product.out_of_stock_list')}}</a>
                                    </li>
                                @endif
                                    <li class="nav-item">
                                        <a class="nav-link" href="#product_disabled_data" role="tab" data-toggle="tab" id="product_disabled_id"
                                            aria-selected="true">{{__('product.disabled_product_list')}}</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#drafted_products_data" role="tab" data-toggle="tab" id="drafted_products"
                                            aria-selected="true">{{__('product.drafted_list')}}</a>
                                    </li>

                                @if (permissionCheck('product.get-data-sku'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="#product_sku_data" role="tab" data-toggle="tab" id="product_sku_id"
                                            aria-selected="true">{{__('product.product_by_sku')}}</a>
                                    </li>
                                @endif

                                    <li class="nav-item">
                                        <a class="nav-link" href="#reported_product_data" role="tab" data-toggle="tab" id="reported_products"
                                            aria-selected="true">{{__('product.reported_products')}}</a>
                                    </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="white_box_30px mb_30">
                        <div class="tab-content">
                            @if (permissionCheck('product.get-data'))
                                <div role="tabpanel" class="tab-pane fade active show" id="order_processing_data">
                                    <div class="box_header common_table_header ">
                                        <div class="main-title d-md-flex">
                                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('product.product_list') }}</h3>
                                            @if (permissionCheck('product.create'))
                                                <ul class="d-flex">
                                                    <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="{{route("product.create")}}"><i class="ti-plus"></i>{{__('product.add_new_product')}}</a></li>
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="QA_section QA_section_heading_custom check_box_table">
                                        <div class="QA_table">
                                            <!-- table-responsive -->
                                            <div class="" id="product_list_div">
                                                @include('product::products.product_list')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (isModuleActive('MultiVendor'))
                                @if(permissionCheck('product.request-get-data'))
                                    <div role="tabpanel" class="tab-pane fade" id="order_complete_data">
                                        <div class="box_header common_table_header ">
                                            <div class="main-title d-md-flex">
                                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('product.seller_request_product')}}</h3>
                                            </div>
                                        </div>
                                        <div class="QA_section QA_section_heading_custom check_box_table">
                                            <div class="QA_table">
                                                <!-- table-responsive -->
                                                <div class="" id="request_product_div">
                                                    @include('product::products.request_product_list')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div role="tabpanel" class="tab-pane fade" id="alert_list">
                                    <div class="box_header common_table_header ">
                                        <div class="main-title d-md-flex">
                                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('product.alert_list')}}</h3>
                                        </div>
                                    </div>
                                    <div class="QA_section QA_section_heading_custom check_box_table">
                                        <div class="QA_table">
                                            <!-- table-responsive -->
                                            <div class="" id="alert_product_div">
                                                @include('product::products.alert_product_list')
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="stock_out_list">
                                    <div class="box_header common_table_header ">
                                        <div class="main-title d-md-flex">
                                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('product.out_of_stock_list')}}</h3>
                                        </div>
                                    </div>
                                    <div class="QA_section QA_section_heading_custom check_box_table">
                                        <div class="QA_table">
                                            <!-- table-responsive -->
                                            <div class="" id="stockout_product_div">
                                                @include('product::products.stockout_product_list')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                                <div role="tabpanel" class="tab-pane fade" id="product_disabled_data">
                                    <div class="box_header common_table_header ">
                                        <div class="main-title d-md-flex">
                                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('product.disabled_product_list')}}</h3>
                                        </div>
                                    </div>
                                    <div class="QA_section QA_section_heading_custom check_box_table">
                                        <div class="QA_table">
                                            <!-- table-responsive -->
                                            <div class="" id="product_disabled_div">
                                                @include('product::products.disabled_product_list')
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="drafted_products_data">
                                    <div class="box_header common_table_header ">
                                        <div class="main-title d-md-flex">
                                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('product.drafted_list')}}</h3>
                                        </div>
                                    </div>
                                    <div class="QA_section QA_section_heading_custom check_box_table">
                                        <div class="QA_table">
                                            <!-- table-responsive -->
                                            <div class="" id="product_disabled_div">
                                                @include('product::products.drafted_products_list')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @if (permissionCheck('product.get-data-sku'))
                                <div role="tabpanel" class="tab-pane fade" id="product_sku_data">
                                    <div class="box_header common_table_header ">
                                        <div class="main-title d-md-flex">
                                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('product.product_by_sku')}}</h3>
                                        </div>
                                    </div>
                                    <div class="QA_section QA_section_heading_custom check_box_table">
                                        <div class="QA_table">
                                            <!-- table-responsive -->
                                            <div class="" id="product_sku_div">
                                                @include('product::products.sku_list')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div role="tabpanel" class="tab-pane fade" id="reported_product_data">
                                <div class="box_header common_table_header ">
                                    <div class="main-title d-md-flex">
                                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('product.reported_products')}}</h3>
                                    </div>
                                </div>
                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table">
                                        <!-- table-responsive -->
                                        <div class="" id="reported_product">
                                            @include('product::products.reported_product_table')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <input type="hidden" id="module_check" value="{{isModuleActive('MultiVendor')?'true':'false'}}">
    </section>
    <div class="product_detail_view_div">
    </div>
    <div id="sku_modal">
        <div class="modal fade" id="sku_edit">
            <div class="modal-dialog modal_800px modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            {{__('product.sku_update')}}
                        </h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="ti-close "></i>
                        </button>
                    </div>

                    <div class="modal-body sku_edit_form">

                        <form enctype="multipart/form-data" id="sku_edit_form">
                            <div class="row">
                                <input type="hidden" id="sku_id" name="id" value="">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="selling_price">{{ __('product.selling_price') }} <span class="text-danger">*</span></label>
                                        <input name="selling_price" class="primary_input_field name" id="selling_price"
                                            placeholder="{{ __('product.selling_price') }}" type="text">
                                        <span class="text-danger" id="error_selling_price"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12 product_sku_img_div">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="">{{ __('product.variant_image') }} <span class="text-danger">*</span></label>
                                        <div class="primary_file_uploader" data-toggle="amazuploader" data-multiple="false" data-type="image" data-name="variant_image">
                                            <input class="primary-input file_amount" type="text" id="variant_img_file" placeholder="{{ __('product.variant_image') }}" readonly="">
                                            <button class="" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="thumbnail_image">{{__('product.Browse') }} </label>
                                                <input type="hidden" name="variant_image" class="selected_files" value="">
                                            </button>
                                        </div>
                                        <div class="product_image_all_div variant_image">
                                           <img class="variant_img_div">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <div class="d-flex justify-content-center pt_20">
                                        <button type="submit" id="editSKUBtn" class="primary-btn semi_large2 fix-gr-bg"><i
                                                class="ti-check"></i>
                                            {{__('common.update')}}
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@include('backEnd.partials._deleteModalForAjax',['item_name' => __('common.product'),'form_id' =>
'product_delete_form','modal_id' => 'product_delete_modal', 'delete_item_id' => 'product_delete_id'])
@include('product::products.stock.manage_stock')
@include('product::products.stock.stock_history')
@endsection
@push('scripts')
<script type="text/javascript">
    (function($){
        "use strict";
        let module_check = $('#module_check').val();
        $(document).ready(function(){
            if(module_check == 'false'){
            var columnData = [
                { data: 'DT_RowIndex', name: 'id',render:function(data){
                    return numbertrans(data)
                }},
                { data: 'product_name', name: 'product_name' },
                { data: 'product_type', name: 'product_type' },
                { data: 'brand', name: 'brand.name',searchable:false,orderable:false },
                { data: 'logo', name: 'logo' },
                { data: 'stock', name: 'stock' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action',searchable:false,orderable:false }
            ]
        }else{
            var columnData = [
                { data: 'DT_RowIndex', name: 'id',render:function(data){
                    return numbertrans(data)
                }},
                { data: 'product_name', name: 'product_name' },
                { data: 'product_type', name: 'product_type' },
                { data: 'brand', name: 'brand.name',searchable:false,orderable:false },
                { data: 'logo', name: 'logo' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action',searchable:false,orderable:false }
            ]
        }
        mainProductDataTable();
        requestProductDataTable();
        SKUDataTable();
        disabledProductDataTable();
        alertProductDataTable();
        stockoutProductDataTable();
        draftedProductTable();
        reportedProducts();
        $(document).on('submit', '#sku_delete_form', function(event) {
            event.preventDefault();
            $('#sku_delete_modal').modal('hide');
            $('#pre-loader').removeClass('d-none');
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', $('#delete_item_id').val());
            let id = $('#delete_item_id').val();
            $.ajax({
                url: "{{ route('product.sku.delete') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    resetAfterChange(response);
                    toastr.success("{{__('common.deleted_successfully')}}", "{{__('common.success')}}");
                    $('#pre-loader').addClass('d-none');
                },
                error: function(response) {
                    if(response.responseJSON.error){
                        toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                        $('#pre-loader').addClass('d-none');
                        return false;
                    }
                    toastr.error("{{__('common.error_message')}}", "{{__('common.error')}}");
                }
            });
        });
        $(document).on('submit', '#product_delete_form', function(event) {
            event.preventDefault();
            $('#product_delete_modal').modal('hide');
            $('#pre-loader').removeClass('d-none');
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', $('#product_delete_id').val());
            $.ajax({
                url: "{{ route('product.destroy') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    if(response.msg){
                        toastr.info(response.msg);
                    }else {
                        resetAfterChange(response);
                        toastr.success("{{__('common.deleted_successfully')}}", "{{__('common.success')}}");
                    }
                    $('#pre-loader').addClass('d-none');
                },
                error: function(response) {
                    if(response.responseJSON.error){
                        toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                        $('#pre-loader').addClass('d-none');
                        return false;
                    }
                    toastr.error("{{__('common.error_message')}}", "{{__('common.error')}}");
                }
            });
        });
        $(document).on('submit','#sku_edit_form', function(event){
            event.preventDefault();
            $("#editSKUBtn").prop('disabled', true);
            $('#editSKUBtn').text('{{ __("common.updating") }}');
            $('#pre-loader').removeClass('d-none');
            $('#error_selling_price').text('');
            let formElement = $(this).serializeArray()
            let formData = new FormData();
            formElement.forEach(element => {
                formData.append(element.name, element.value);
            });
            formData.append('_token', "{{ csrf_token() }}");
            $.ajax({
                url: "{{ route('product.sku.update') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    $(".selected_files").val('');
                    $(".file_amount").attr('placeholder','Choose File');
                    $('.product_image_all_div').remove();
                    resetAfterChange(response)
                    toastr.success("{{__('common.updated_successfully')}}", "{{__('common.success')}}");
                    $("#editSKUBtn").prop('disabled', false);
                    $('#editSKUBtn').text('{{ __("common.update") }}');
                    $('#sku_edit').modal('hide');
                    $('#pre-loader').addClass('d-none');
                },
                error: function(response) {
                    $("#editSKUBtn").prop('disabled', false);
                    $('#editSKUBtn').text('{{ __("common.update") }}');
                    if(response.responseJSON.error){
                        toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                        $('#pre-loader').addClass('d-none');
                        return false;
                    }
                    $('#pre-loader').addClass('d-none');
                    $('#error_selling_price').text(response.responseJSON.errors.selling_price);
                }
            });
        });
        $(document).on('click', '.product_detail', function(event){
            event.preventDefault();
            let id = $(this).data('id');
            $('#pre-loader').removeClass('d-none');
            $.post('{{ route('product.show') }}', {_token:'{{ csrf_token() }}', id:id}, function(data){
                $('.product_detail_view_div').html(data);
                $('#productDetails').modal('show');
                $('#pre-loader').addClass('d-none');
            });
        });
        $(document).on('click', '.delete_product', function(event){
            event.preventDefault();
            let type = $(this).data('type');
            let id = $(this).data('id');
            if(type == 'admin'){
                $('#product_delete_id').val(id);
                $('#product_delete_modal').modal('show');
            }else{
                $('#product_delete_id').val(id);
                $('#product_delete_modal').modal('show');
            }
        });
        $(document).on('change', '.sku_status_change', function(event){
            let id = $(this).data('id');
            let status = 0;
            if($(this).prop('checked')){
                status = 1;
            }
            else{
                status = 0;
            }
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', id);
            formData.append('status', status);
            $.ajax({
                url: "{{ route('product.sku.status') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    resetAfterChange(response);
                    toastr.success("{{__('common.updated_successfully')}}", "{{__('common.success')}}");
                },
                error: function(response) {
                    if(response.responseJSON.error){
                        toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                        $('#pre-loader').addClass('d-none');
                        return false;
                    }
                    toastr.error("{{__('common.error_message')}}", "{{__('common.error')}}");
                }
            });
        });
        $(document).on('change', '.product_status_change', function(event){
            let id = $(this).data('id');
            let status = 0;

            if($(this).is(":checked")){
                status = 1;
            }
            else{
                status = 0;
            }
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', id);
            formData.append('status', status);
            $.ajax({
                url: "{{ route('product.update_active_status') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    resetAfterChange(response);
                    toastr.success("{{__('common.updated_successfully')}}", "{{__('common.success')}}");
                },
                error: function(response) {
                    if(response.status == '422'){
                        toastr.error("{{__('common.restricted_in_demo_mode')}}", "{{__('common.error')}}");
                    }else{
                        toastr.error("{{__('common.error_message')}}", "{{__('common.error')}}");
                    }
                }
            });
        });
        $(document).on('change', '.product_approve', function(event){
            let id = $(this).data('id');
            if(this.checked){
                var is_approved = 1;
            }
            else{
                var is_approved = 0;
            }
            $('#pre-loader').removeClass('d-none');
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', id);
            formData.append('is_approved', is_approved);
            $.ajax({
                url: "{{ route('product.request.approved') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    resetAfterChange(response);
                    toastr.success("{{__('common.approved_successfully')}}", "{{__('common.success')}}");
                    $('#pre-loader').addClass('d-none');
                },
                error: function(response) {
                    if(response.responseJSON.error){
                        toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                        $('#pre-loader').addClass('d-none');
                        return false;
                    }
                    toastr.error("{{__('common.error_message')}}", "{{__('common.error')}}");
                    $('#pre-loader').addClass('d-none');
                }
            });
        });
        $(document).on('click', '.edit_sku', function(event){
            event.preventDefault();
            let sku = $(this).data('value');
            if(sku.product.product_type == 1){
                $('.product_sku_img_div').addClass('d-none');
            }else{
                $('.product_sku_img_div').removeClass('d-none');
                if(sku.variant_image != null){
                    if(sku.variant_image.includes('amazonaws.com')){
                        var variantImage = sku.variant_image;
                    }else if(sku.variant_image.includes('digitaloceanspaces.com')){
                        var variantImage = sku.variant_image;
                    }else if(sku.variant_image.includes('drive.google.com')){
                        var variantImage = sku.variant_image;
                    }else if(sku.variant_image.includes('wasabisys.com')){
                        var variantImage = sku.variant_image;
                    }else if(sku.variant_image.includes('backblazeb2.com')){
                        var variantImage = sku.variant_image;
                    }else if(sku.variant_image.includes('dropboxusercontent.com')){
                        var variantImage = sku.variant_image;
                    }else if(sku.variant_image.includes('storage.googleapis.com')){
                        var variantImage = sku.variant_image;
                    }else if(sku.variant_image.includes('contabostorage.com')){
                        var variantImage = sku.variant_image;
                    }else if(sku.variant_image.includes('b-cdn.net')){
                        var variantImage = sku.variant_image;
                    }else{
                        var variantImage="{{asset(asset_path(''))}}" + "/"+sku.variant_image;
                    }
                    $('.variant_img_div').prop("src", variantImage);
                }
            }
            $('#sku_edit').modal('show');
            $('#sku_edit_form #sku_id').val(sku.id);
            $('#sku_edit_form #selling_price').val(sku.selling_price);
            $('#error_selling_price').text('');
        });
        $(document).on('click', '.delete_sku', function(event){
            event.preventDefault();
            let id = $(this).data('id');
            $('#delete_item_id').val(id);
            $('#sku_delete_modal').modal('show');
        });
        function mainProductDataTable(){
            $('#mainProductTable').DataTable({
                processing: true,
                serverSide: true,
                "stateSave": true,
                "ajax": ( {
                    url: "{{route('product.get-data')}}"
                }),
                "initComplete":function(json){
                },
                columns: columnData,
                bLengthChange: false,
                "bDestroy": true,
                language: {
                    search: "<i class='ti-search'></i>",
                    searchPlaceholder: trans('common.quick_search'),
                    paginate: {
                        next: "<i class='ti-arrow-right'></i>",
                        previous: "<i class='ti-arrow-left'></i>"
                    }
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-files-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'Copy',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        title: $("#header_title").text(),
                        margin: [10, 10, 10, 0],
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'PDF',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },
                        orientation: 'landscape',
                        pageSize: 'A4',
                        margin: [0, 0, 0, 0],
                        alignment: 'center',
                        header: true,
                        customize : function(doc){
                            var colCount = new Array();
                            var tbl = $('#mainProductTable');
                            $(tbl).find('tbody tr:first-child td').each(function(){
                                if($(this).attr('colspan')){
                                    for(var i=1;i<=$(this).attr('colspan');$i++){
                                        colCount.push('*');
                                    }
                                }else{ colCount.push('*'); }
                            });
                            doc.content[1].table.widths = colCount;
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: 'Print',
                        title: $("#header_title").text(),
                        exportOptions: {
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-columns"></i>',
                        postfixButtons: ['colvisRestore']
                    }
                ],
                columnDefs: [{
                        visible: false
                }],
                    responsive: true,
            });
        }
        function draftedProductTable(){
            $('#drafted_product_table').DataTable({
                processing: true,
                serverSide: true,
                "stateSave": true,
                "ajax": ( {
                    url: "{{route('product.get-data')}}"+'?table=drafted'
                }),
                "initComplete":function(json){
                },
                columns: columnData,
                bLengthChange: false,
                "bDestroy": true,
                language: {
                    search: "<i class='ti-search'></i>",
                    searchPlaceholder: trans('common.quick_search'),
                    paginate: {
                        next: "<i class='ti-arrow-right'></i>",
                        previous: "<i class='ti-arrow-left'></i>"
                    }
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-files-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'Copy',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        title: $("#header_title").text(),
                        margin: [10, 10, 10, 0],
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'PDF',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },
                        orientation: 'landscape',
                        pageSize: 'A4',
                        margin: [0, 0, 0, 0],
                        alignment: 'center',
                        header: true,
                        customize : function(doc){
                            var colCount = new Array();
                            var tbl = $('#disabledProductTable');
                            $(tbl).find('tbody tr:first-child td').each(function(){
                                if($(this).attr('colspan')){
                                    for(var i=1;i<=$(this).attr('colspan');$i++){
                                        colCount.push('*');
                                    }
                                }else{ colCount.push('*'); }
                            });
                            doc.content[1].table.widths = colCount;
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: 'Print',
                        title: $("#header_title").text(),
                        exportOptions: {
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-columns"></i>',
                        postfixButtons: ['colvisRestore']
                    }
                ],
                columnDefs: [{
                        visible: false
                }],
                    responsive: true,
            });
        }
        function disabledProductDataTable(){
            $('#disabledProductTable').DataTable({
                processing: true,
                serverSide: true,
                "stateSave": true,
                "ajax": ( {
                    url: "{{route('product.get-data')}}"+'?table=disable'
                }),
                "initComplete":function(json){
                },
                columns: columnData,
                bLengthChange: false,
                "bDestroy": true,
                language: {
                    search: "<i class='ti-search'></i>",
                    searchPlaceholder: trans('common.quick_search'),
                    paginate: {
                        next: "<i class='ti-arrow-right'></i>",
                        previous: "<i class='ti-arrow-left'></i>"
                    }
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-files-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'Copy',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        title: $("#header_title").text(),
                        margin: [10, 10, 10, 0],
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'PDF',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },
                        orientation: 'landscape',
                        pageSize: 'A4',
                        margin: [0, 0, 0, 0],
                        alignment: 'center',
                        header: true,
                        customize : function(doc){
                            var colCount = new Array();
                            var tbl = $('#disabledProductTable');
                            $(tbl).find('tbody tr:first-child td').each(function(){
                                if($(this).attr('colspan')){
                                    for(var i=1;i<=$(this).attr('colspan');$i++){
                                        colCount.push('*');
                                    }
                                }else{ colCount.push('*'); }
                            });
                            doc.content[1].table.widths = colCount;
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: 'Print',
                        title: $("#header_title").text(),
                        exportOptions: {
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-columns"></i>',
                        postfixButtons: ['colvisRestore']
                    }
                ],
                columnDefs: [{
                        visible: false
                }],
                    responsive: true,
            });
        }
        function alertProductDataTable(){
            $('#alertProductTable').DataTable({
                processing: true,
                serverSide: true,
                "stateSave": true,
                "ajax": ( {
                    url: "{{route('product.get-data')}}"+'?table=alert'
                }),
                "initComplete":function(json){
                },
                columns: columnData,
                bLengthChange: false,
                "bDestroy": true,
                language: {
                    search: "<i class='ti-search'></i>",
                    searchPlaceholder: trans('common.quick_search'),
                    paginate: {
                        next: "<i class='ti-arrow-right'></i>",
                        previous: "<i class='ti-arrow-left'></i>"
                    }
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-files-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'Copy',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        title: $("#header_title").text(),
                        margin: [10, 10, 10, 0],
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'PDF',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },
                        orientation: 'landscape',
                        pageSize: 'A4',
                        margin: [0, 0, 0, 0],
                        alignment: 'center',
                        header: true,
                        customize : function(doc){
                            var colCount = new Array();
                            var tbl = $('#alertProductTable');
                            $(tbl).find('tbody tr:first-child td').each(function(){
                                if($(this).attr('colspan')){
                                    for(var i=1;i<=$(this).attr('colspan');$i++){
                                        colCount.push('*');
                                    }
                                }else{ colCount.push('*'); }
                            });
                            doc.content[1].table.widths = colCount;
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: 'Print',
                        title: $("#header_title").text(),
                        exportOptions: {
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-columns"></i>',
                        postfixButtons: ['colvisRestore']
                    }
                ],
                columnDefs: [{
                        visible: false
                }],
                    responsive: true,
            });
        }
        function stockoutProductDataTable(){

            $('#stockoutProductTable').DataTable({
                processing: true,
                serverSide: true,
                "stateSave": true,
                "ajax": ( {
                    url: "{{route('product.get-data')}}"+'?table=stockout'
                }),
                "initComplete":function(json){
                },
                columns: columnData,
                bLengthChange: false,
                "bDestroy": true,
                language: {
                    search: "<i class='ti-search'></i>",
                    searchPlaceholder: trans('common.quick_search'),
                    paginate: {
                        next: "<i class='ti-arrow-right'></i>",
                        previous: "<i class='ti-arrow-left'></i>"
                    }
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-files-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'Copy',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        title: $("#header_title").text(),
                        margin: [10, 10, 10, 0],
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'PDF',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },
                        orientation: 'landscape',
                        pageSize: 'A4',
                        margin: [0, 0, 0, 0],
                        alignment: 'center',
                        header: true,
                        customize : function(doc){
                            var colCount = new Array();
                            var tbl = $('#stockoutProductTable');
                            $(tbl).find('tbody tr:first-child td').each(function(){
                                if($(this).attr('colspan')){
                                    for(var i=1;i<=$(this).attr('colspan');$i++){
                                        colCount.push('*');
                                    }
                                }else{ colCount.push('*'); }
                            });
                            doc.content[1].table.widths = colCount;
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: 'Print',
                        title: $("#header_title").text(),
                        exportOptions: {
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-columns"></i>',
                        postfixButtons: ['colvisRestore']
                    }
                ],
                columnDefs: [{
                        visible: false
                }],
                    responsive: true,
            });
        }

        function requestProductDataTable(){
            $('#requestProductTable').DataTable({
                processing: true,
                serverSide: true,
                "stateSave": true,
                "ajax": ( {
                    url: "{{route('product.request-get-data')}}"
                }),
                "initComplete":function(json){
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'id' ,render:function(data){
                        return numbertrans(data)
                    }},
                    { data: 'product_name', name: 'product_name' },
                    { data: 'product_type', name: 'product_type' },
                    { data: 'brand', name: 'brand.name',searchable:false,orderable:false },
                    { data: 'logo', name: 'logo' },
                    { data: 'seller', name: 'seller' },
                    { data: 'approval', name: 'approval' },
                    { data: 'action', name: 'action',searchable:false,orderable:false }
                ],
                bLengthChange: false,
                "bDestroy": true,
                language: {
                    search: "<i class='ti-search'></i>",
                    searchPlaceholder: trans('common.quick_search'),
                    paginate: {
                        next: "<i class='ti-arrow-right'></i>",
                        previous: "<i class='ti-arrow-left'></i>"
                    }
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-files-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'Copy',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        title: $("#header_title").text(),
                        margin: [10, 10, 10, 0],
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },

                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'PDF',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },
                        orientation: 'landscape',
                        pageSize: 'A4',
                        margin: [0, 0, 0, 0],
                        alignment: 'center',
                        header: true,
                        customize : function(doc){
                            var colCount = new Array();
                            var tbl = $('#requestProductTable');
                            $(tbl).find('tbody tr:first-child td').each(function(){
                                if($(this).attr('colspan')){
                                    for(var i=1;i<=$(this).attr('colspan');$i++){
                                        colCount.push('*');
                                    }
                                }else{ colCount.push('*'); }
                            });
                            doc.content[1].table.widths = colCount;
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: 'Print',
                        title: $("#header_title").text(),
                        exportOptions: {
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-columns"></i>',
                        postfixButtons: ['colvisRestore']
                    }
                    ],
                columnDefs: [{
                        visible: false
                }],
                    responsive: true,
            });
        }
        function SKUDataTable(){
            $('#SKUTable').DataTable({
            processing: true,
            serverSide: true,
            "stateSave": true,
            "ajax": ( {
                url: "{{route('product.get-data-sku')}}"
            }),
            "initComplete":function(json){
            },
            columns: [
                { data: 'DT_RowIndex', name: 'id',render:function(data){
                    return numbertrans(data)
                }},
                { data: 'product', name: 'product.product_name' },
                { data: 'brand', name: 'product.brand.name',searchable:false,orderable:false },
                { data: 'purchase_price', name: 'purchase_price' },
                { data: 'selling_price', name: 'selling_price' },
                { data: 'logo', name: 'logo' },
                { data: 'action', name: 'action',searchable:false,orderable:false }
            ],
            bLengthChange: false,
            "bDestroy": true,
            language: {
                search: "<i class='ti-search'></i>",
                searchPlaceholder: trans('common.quick_search'),
                paginate: {
                    next: "<i class='ti-arrow-right'></i>",
                    previous: "<i class='ti-arrow-left'></i>"
                }
            },
            dom: 'Bfrtip',
            buttons: [{
                extend: 'copyHtml5',
                text: '<i class="fa fa-files-o"></i>',
                title: $("#header_title").text(),
                titleAttr: 'Copy',
                exportOptions: {
                    columns: ':visible',
                    columns: ':not(:last-child)',
                }
            },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    titleAttr: 'Excel',
                    title: $("#header_title").text(),
                    margin: [10, 10, 10, 0],
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    },
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fa fa-file-text-o"></i>',
                    titleAttr: 'CSV',
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    title: $("#header_title").text(),
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    },
                    orientation: 'landscape',
                    pageSize: 'A4',
                    margin: [0, 0, 0, 0],
                    alignment: 'center',
                    header: true,
                    customize : function(doc){
                        var colCount = new Array();
                        var tbl = $('#SKUTable');
                        $(tbl).find('tbody tr:first-child td').each(function(){
                            if($(this).attr('colspan')){
                                for(var i=1;i<=$(this).attr('colspan');$i++){
                                    colCount.push('*');
                                }
                            }else{ colCount.push('*'); }
                        });
                        doc.content[1].table.widths = colCount;
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    titleAttr: 'Print',
                    title: $("#header_title").text(),
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="fa fa-columns"></i>',
                    postfixButtons: ['colvisRestore']
                }
            ],
                columnDefs: [{
                    visible: false
                }],
                responsive: true,
            });
        }

        function reportedProducts(){
            $('#reported_product_datatable').DataTable({
            processing: true,
            serverSide: true,
            "stateSave": true,
            "ajax": ( {
                url: "{{route('product.reportedProducts')}}"
            }),
            "initComplete":function(json){
            },
            columns: [
                { data: 'DT_RowIndex', name: 'id',render:function(data){
                    return numbertrans(data)
                }},
                { data: 'product_name', name: 'product_name' },
                { data: 'logo', name: 'logo' },
                { data: 'reason', name: 'reason' },
                { data: 'email', name: 'email' },
                { data: 'user', name: 'user' },
                { data: 'action', name: 'action',searchable:false,orderable:false }
            ],
            bLengthChange: false,
            "bDestroy": true,
            language: {
                search: "<i class='ti-search'></i>",
                searchPlaceholder: trans('common.quick_search'),
                paginate: {
                    next: "<i class='ti-arrow-right'></i>",
                    previous: "<i class='ti-arrow-left'></i>"
                }
            },
            dom: 'Bfrtip',
            buttons: [{
                extend: 'copyHtml5',
                text: '<i class="fa fa-files-o"></i>',
                title: $("#header_title").text(),
                titleAttr: 'Copy',
                exportOptions: {
                    columns: ':visible',
                    columns: ':not(:last-child)',
                }
            },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    titleAttr: 'Excel',
                    title: $("#header_title").text(),
                    margin: [10, 10, 10, 0],
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    },
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fa fa-file-text-o"></i>',
                    titleAttr: 'CSV',
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    title: $("#header_title").text(),
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    },
                    orientation: 'landscape',
                    pageSize: 'A4',
                    margin: [0, 0, 0, 0],
                    alignment: 'center',
                    header: true,
                    customize : function(doc){
                        var colCount = new Array();
                        var tbl = $('#SKUTable');
                        $(tbl).find('tbody tr:first-child td').each(function(){
                            if($(this).attr('colspan')){
                                for(var i=1;i<=$(this).attr('colspan');$i++){
                                    colCount.push('*');
                                }
                            }else{ colCount.push('*'); }
                        });
                        doc.content[1].table.widths = colCount;
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    titleAttr: 'Print',
                    title: $("#header_title").text(),
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="fa fa-columns"></i>',
                    postfixButtons: ['colvisRestore']
                }
            ],
                columnDefs: [{
                    visible: false
                }],
                responsive: true,
            });
        }

        function resetAfterChange(response) {
            $('#product_list_div').empty();
            $('#product_list_div').html(response.ProductList);
            $('#request_product_div').empty();
            $('#request_product_div').html(response.RequestProductList);
            $('#product_sku_div').empty();
            $('#product_sku_div').html(response.ProductSKUList);
            $('#product_disabled_div').empty();
            $('#product_disabled_div').html(response.ProductDisabledList);
            $('#product_alert_div').empty();
            $('#product_alert_div').html(response.ProductAlertList);
            mainProductDataTable();
            requestProductDataTable();
            SKUDataTable();
            disabledProductDataTable();
            alertProductDataTable();
            stockoutProductDataTable();
        }
        function productDeleteModal(id){
            $('#product_delete_id').val(id);
            $('#product_delete_modal').modal('show');
        }

        $(document).on('click','.report-show',function(event){
            event.preventDefault();
            let url = $(this).attr('href');

        });

        // ===== MANAGE STOCK FUNCTIONALITY =====
        var currentProductId = null;
        var currentProductType = null;
        var currentSkuId = null;

        // Open manage stock modal
        $(document).on('click', '.manage_stock', function(event) {
            event.preventDefault();
            currentProductId = $(this).data('id');
            currentProductType = $(this).data('type');
            let productName = $(this).data('name');
            
            $('#product_id').val(currentProductId);
            $('#product_type').val(currentProductType);
            $('#product_name').val(productName);
            
            // Reset form
            $('#stock_type').val('add');
            $('#quantity').val(1);
            $('#note').val('');
            
            // Load SKU data
            loadProductSkus(currentProductId);
            
            $('#manageStockModal').modal('show');
        });

        function loadProductSkus(productId) {
            $('#pre-loader').removeClass('d-none');
            $.ajax({
                url: "{{ route('product.stock.get-skus') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId
                },
                success: function(response) {
                    $('#pre-loader').addClass('d-none');
                    if (response.success) {
                        if (response.product_type == 1) {
                            // Simple product - show simple stock section
                            $('#simple_stock_section').show();
                            $('#variable_stock_section').hide();
                            
                            if (response.skus.length > 0) {
                                let sku = response.skus[0];
                                currentSkuId = sku.id;
                                $('#sku').val(sku.sku);
                                $('#current_stock').val(sku.current_stock);
                                updateNewStock();
                            }
                        } else {
                            // Variable product - show SKU table
                            $('#simple_stock_section').hide();
                            $('#variable_stock_section').show();
                            
                            let tableBody = '';
                            response.skus.forEach(function(sku) {
                                tableBody += '<tr>';
                                tableBody += '<td>' + sku.sku + '</td>';
                                tableBody += '<td>' + (sku.variation || '-') + '</td>';
                                tableBody += '<td><span class="badge badge-primary sku-stock-' + sku.id + '">' + sku.current_stock + '</span></td>';
                                tableBody += '<td><button type="button" class="btn btn-sm btn-primary edit-sku-stock" data-id="' + sku.id + '" data-sku="' + sku.sku + '" data-stock="' + sku.current_stock + '"><i class="fa fa-edit"></i></button></td>';
                                tableBody += '</tr>';
                            });
                            $('#skuStockTable tbody').html(tableBody);
                        }
                    } else {
                        toastr.error(response.error || "{{ __('common.error_message') }}");
                    }
                },
                error: function(response) {
                    $('#pre-loader').addClass('d-none');
                    toastr.error("{{ __('common.error_message') }}");
                }
            });
        }

        // Calculate new stock on type/quantity change
        function updateNewStock() {
            let currentStock = parseInt($('#current_stock').val()) || 0;
            let quantity = parseInt($('#quantity').val()) || 0;
            let stockType = $('#stock_type').val();
            let newStock = 0;
            
            switch (stockType) {
                case 'add':
                    newStock = currentStock + quantity;
                    break;
                case 'subtract':
                    newStock = Math.max(0, currentStock - quantity);
                    break;
                case 'set':
                    newStock = quantity;
                    break;
            }
            
            $('#new_stock').val(newStock);
        }

        $(document).on('change', '#stock_type, #quantity', updateNewStock);
        $(document).on('input', '#quantity', updateNewStock);

        // Update stock for simple product
        $(document).on('click', '#updateStockBtn', function() {
            if (!currentSkuId) {
                toastr.error("{{ __('common.error_message') }}");
                return;
            }
            
            updateSkuStock(currentSkuId, $('#stock_type').val(), $('#quantity').val(), $('#note').val());
        });

        // Open SKU stock modal for variable products
        $(document).on('click', '.edit-sku-stock', function() {
            let skuId = $(this).data('id');
            let skuName = $(this).data('sku');
            let currentStock = $(this).data('stock');
            
            $('#sku_id').val(skuId);
            $('#sku_product_id').val(currentProductId);
            $('#sku_name').val(skuName);
            $('#sku_current_stock').val(currentStock);
            $('#sku_stock_type').val('add');
            $('#sku_quantity').val(1);
            $('#sku_note').val('');
            updateSkuNewStock();
            
            $('#skuStockModal').modal('show');
        });

        // Calculate new stock for SKU modal
        function updateSkuNewStock() {
            let currentStock = parseInt($('#sku_current_stock').val()) || 0;
            let quantity = parseInt($('#sku_quantity').val()) || 0;
            let stockType = $('#sku_stock_type').val();
            let newStock = 0;
            
            switch (stockType) {
                case 'add':
                    newStock = currentStock + quantity;
                    break;
                case 'subtract':
                    newStock = Math.max(0, currentStock - quantity);
                    break;
                case 'set':
                    newStock = quantity;
                    break;
            }
            
            $('#sku_new_stock').val(newStock);
        }

        $(document).on('change', '#sku_stock_type, #sku_quantity', updateSkuNewStock);
        $(document).on('input', '#sku_quantity', updateSkuNewStock);

        // Update stock for specific SKU
        $(document).on('click', '#updateSkuStockBtn', function() {
            let skuId = $('#sku_id').val();
            updateSkuStock(skuId, $('#sku_stock_type').val(), $('#sku_quantity').val(), $('#sku_note').val(), true);
        });

        function updateSkuStock(skuId, stockType, quantity, note, isSkuModal = false) {
            $('#pre-loader').removeClass('d-none');
            $.ajax({
                url: "{{ route('product.stock.update') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    sku_id: skuId,
                    stock_type: stockType,
                    quantity: quantity,
                    note: note
                },
                success: function(response) {
                    $('#pre-loader').addClass('d-none');
                    if (response.success) {
                        toastr.success(response.message || "{{ __('common.updated_successfully') }}");
                        
                        if (isSkuModal) {
                            // Update the stock in the table
                            $('.sku-stock-' + skuId).text(response.new_stock);
                            $('.edit-sku-stock[data-id="' + skuId + '"]').data('stock', response.new_stock);
                            $('#skuStockModal').modal('hide');
                        } else {
                            // Update current stock display
                            $('#current_stock').val(response.new_stock);
                            updateNewStock();
                        }
                        
                        // Refresh DataTable
                        $('#mainProductTable').DataTable().ajax.reload(null, false);
                    } else {
                        toastr.error(response.error || "{{ __('common.error_message') }}");
                    }
                },
                error: function(response) {
                    $('#pre-loader').addClass('d-none');
                    toastr.error(response.responseJSON?.error || "{{ __('common.error_message') }}");
                }
            });
        }
        // ===== END MANAGE STOCK FUNCTIONALITY =====
    });
    })(jQuery);
</script>
@endpush

