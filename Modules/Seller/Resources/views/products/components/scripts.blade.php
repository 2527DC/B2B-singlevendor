@push('scripts')
<script type="text/javascript">
    (function($){
        "use strict";
        $(document).ready(function(){
            if ($('#warehouse_filter').val() != '') {
                productDatatable();
                mainProductList();
                alertProductDatatable();
                stockOutProductDatatable();
                disableProductDatatable();
            }
        $(document).on('submit', '#item_delete_form', function(event) {
            event.preventDefault();
            $('#pre-loader').removeClass('d-none');
            $('#deleteItemModal').modal('hide');
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', $('#delete_item_id').val());
            let id = $('#delete_item_id').val();
            $.ajax({
                url: "{{ route('seller.product.delete') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    if(response.msg){
                        toastr.warning(response.msg);
                        $("#pre-loader").addClass('d-none');
                    }else{
                        resetAfterChange(response);
                        toastr.success("{{__('common.deleted_successfully')}}","{{__('common.success')}}")
                        $('#pre-loader').addClass('d-none');
                    }
                },
                error: function(response) {
                if(response.responseJSON.error){
                    toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                    $('#pre-loader').addClass('d-none');
                    return false;
                }
                    toastr.error("{{__('common.error_message')}}","{{__('common.error')}}");
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
                    mainProductList();
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

        $(document).on('click', '.product_detail', function(event){
            event.preventDefault();
            let id = $(this).data('id');
            $('#pre-loader').removeClass('d-none');
            $.post('{{ route('product.show') }}', {_token:'{{ csrf_token() }}', id:id}, function(data){
                $('#product_detail_view_div').html(data);
                $('#productDetails').modal('show');
                $('#pre-loader').addClass('d-none');
            });
        });
        $(document).on('change', '.sku_status_change', function(event){
            let id = $(this).val();
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
                url: "{{ route('seller.product.sku.status') }}",
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
            $(document).on('click', '.seller_product_delete', function(event){
                event.preventDefault();
                let id = $(this).data('id');
                $('#delete_item_id').val(id);
                $('#deleteItemModal').modal('show');
            });
            $(document).on('click', '.seller_product_view', function(event){
                event.preventDefault();
                let id = $(this).data('id');
                seller_product_show(id);
            });
            $(document).on('change', '.product_status_change', function(){
                update_active_status($(this)[0]);
            });
            function seller_product_show(el){
                $.post('{{ route('seller.admin_product.show') }}', {_token:'{{ csrf_token() }}', id:el}, function(data){
                    $('#product_detail_view_div').empty();
                    $('#product_detail_view_div').html(data);
                    $('#productDetails').modal('show');
                });
            }
            function productDatatable(){
                $('#sellerProductTable').DataTable({
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    "ajax": ( {
                        url: "{{route('seller.product.get-data')}}" + '?warehouse_id=' + $('#warehouse_filter').val()
                    }),
                    "initComplete":function(json){
                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'id',render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'product_name', name: 'product_name' },
                        { data: 'brand', name: 'brand',searchable:false,orderable:false},
                        { data: 'logo', name: 'logo' },
                        { data: 'stock', name: 'stock' },
                        { data: 'status', name: 'status' },
                        { data: 'action', name: 'action',searchable:false,orderable:false}
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
                            pageSize: 'A4',
                            margin: [0, 0, 0, 0],
                            alignment: 'center',
                            header: true,
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
            function alertProductDatatable(){
                var base_url = $('#url').val();
                var url = "{{route('seller.product.get-data')}}" + '?table=alert';
                $('#alertProductTable').DataTable({
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    "ajax": ( {
                        url: url + '&warehouse_id=' + $('#warehouse_filter').val()
                    }),
                    "initComplete":function(json){
                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'id',render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'product_name', name: 'product_name' },
                        { data: 'brand', name: 'brand',searchable:false,orderable:false},
                        { data: 'logo', name: 'logo' },
                        { data: 'stock', name: 'stock' },
                        { data: 'status', name: 'status' },
                        { data: 'action', name: 'action',searchable:false,orderable:false}
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
                            pageSize: 'A4',
                            margin: [0, 0, 0, 0],
                            alignment: 'center',
                            header: true,

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
            function stockOutProductDatatable(){
                var base_url = $('#url').val();
                var url = "{{route('seller.product.get-data')}}" + '?table=stockout';
                $('#stockoutProductTable').DataTable({
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    "ajax": ( {
                        url: url + '&warehouse_id=' + $('#warehouse_filter').val()
                    }),
                    "initComplete":function(json){
                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'id',render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'product_name', name: 'product_name' },
                        { data: 'brand', name: 'brand',searchable:false,orderable:false },
                        { data: 'logo', name: 'logo' },
                        { data: 'stock', name: 'stock' },
                        { data: 'status', name: 'status' },
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
                            pageSize: 'A4',
                            margin: [0, 0, 0, 0],
                            alignment: 'center',
                            header: true,
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
            function disableProductDatatable(){
                var base_url = $('#url').val();
                var url = "{{route('seller.product.get-data')}}" + '?table=disable';
                $('#disableProductTable').DataTable({
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    "ajax": ( {
                        url: url + '&warehouse_id=' + $('#warehouse_filter').val()
                    }),
                    "initComplete":function(json){
                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'id',render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'product_name', name: 'product_name' },
                        { data: 'brand', name: 'brand',searchable:false,orderable:false },
                        { data: 'logo', name: 'logo' },
                        { data: 'stock', name: 'stock' },
                        { data: 'status', name: 'status' },
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
                            pageSize: 'A4',
                            margin: [0, 0, 0, 0],
                            alignment: 'center',
                            header: true,
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
            function mainProductList(){
                $('#mainProductTable').DataTable({
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    "ajax": ( {
                        url: "{{route('product.get-data')}}" + '?warehouse_id=' + $('#warehouse_filter').val()
                    }),
                    "initComplete":function(json){
                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'id',render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'product_name', name: 'product_name' },
                        { data: 'product_type', name: 'product_type' },
                        { data: 'brand', name: 'brand',searchable:false,orderable:false },
                        { data: 'logo', name: 'logo' },
                        { data: 'status', name: 'status' },
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
                            pageSize: 'A4',
                            margin: [0, 0, 0, 0],
                            alignment: 'center',
                            header: true,
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
                $('#product_list_div').html(response.ProductList);
                $('#alert_div').html(response.AlertList);
                $('#stock_div').html(response.StockList);
                $('#disabled_div').html(response.DisabledList);
                productDatatable();
                mainProductList();
                alertProductDatatable();
                stockOutProductDatatable();
                disableProductDatatable();
            }

            function checkWarehouseSelection() {
                var val = $('#warehouse_filter').val();
                if (val == '' || val == null) {
                    $('#product_tab_content').hide();
                    $('#no_warehouse_msg').show();
                } else {
                    $('#product_tab_content').show();
                    $('#no_warehouse_msg').hide();
                }
            }

            // Check on load
            checkWarehouseSelection();

            $(document).on('change', '#warehouse_filter', function() {
                checkWarehouseSelection();
                var val = $('#warehouse_filter').val();
                if (val != '' && val != null) {
                    productDatatable();
                    mainProductList();
                    alertProductDatatable();
                    stockOutProductDatatable();
                    disableProductDatatable();
                }
            });

            function update_active_status(el){
                if(el.checked){
                    var status = 1;
                }
                else{
                    var status = 0;
                }
                var formData = new FormData();
                formData.append('_token', "{{ csrf_token() }}");
                formData.append('id', el.value);
                formData.append('status', status);
                $.ajax({
                    url: "{{ route('seller.product.update-status') }}",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                        resetAfterChange(response);
                        toastr.success("{{__('common.updated_successfully')}}","{{__('common.success')}}")
                    },
                    error: function(response) {
                    if(response.responseJSON.error){
                        toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                        $('#pre-loader').addClass('d-none');
                        return false;
                    }
                        toastr.error("{{__('common.error_message')}}","{{__('common.error')}}");
                    }
                });
            }
            $(document).on('click', '.delete_product', function(event){
                event.preventDefault();
                let id = $(this).data('id');
                $('#product_delete_id').val(id);
                $('#product_delete_modal').modal('show');
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
                        product_id: productId,
                        warehouse_id: $('#warehouse_filter').val()
                    },
                    success: function(response) {
                        $('#pre-loader').addClass('d-none');
                        if (response.success) {
                            if (response.product_type == 1) {
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
                    error: function() {
                        $('#pre-loader').addClass('d-none');
                        toastr.error("{{ __('common.error_message') }}");
                    }
                });
            }

            function updateNewStock() {
                let currentStock = parseInt($('#current_stock').val()) || 0;
                let quantity = parseInt($('#quantity').val()) || 0;
                let stockType = $('#stock_type').val();
                let newStock = stockType === 'add' ? currentStock + quantity
                             : stockType === 'subtract' ? Math.max(0, currentStock - quantity)
                             : quantity;
                $('#new_stock').val(newStock);
            }

            $(document).on('change input', '#stock_type, #quantity', updateNewStock);

            $(document).on('click', '#updateStockBtn', function() {
                if (!currentSkuId) { toastr.error("{{ __('common.error_message') }}"); return; }
                updateSkuStock(currentSkuId, $('#stock_type').val(), $('#quantity').val(), $('#note').val());
            });

            $(document).on('click', '.edit-sku-stock', function() {
                let skuId = $(this).data('id');
                $('#sku_id').val(skuId);
                $('#sku_product_id').val(currentProductId);
                $('#sku_name').val($(this).data('sku'));
                $('#sku_current_stock').val($(this).data('stock'));
                $('#sku_stock_type').val('add');
                $('#sku_quantity').val(1);
                $('#sku_note').val('');
                updateSkuNewStock();
                $('#skuStockModal').modal('show');
            });

            function updateSkuNewStock() {
                let currentStock = parseInt($('#sku_current_stock').val()) || 0;
                let quantity = parseInt($('#sku_quantity').val()) || 0;
                let stockType = $('#sku_stock_type').val();
                let newStock = stockType === 'add' ? currentStock + quantity
                             : stockType === 'subtract' ? Math.max(0, currentStock - quantity)
                             : quantity;
                $('#sku_new_stock').val(newStock);
            }

            $(document).on('change input', '#sku_stock_type, #sku_quantity', updateSkuNewStock);

            $(document).on('click', '#updateSkuStockBtn', function() {
                let skuId = $('#sku_id').val();
                updateSkuStock(skuId, $('#sku_stock_type').val(), $('#sku_quantity').val(), $('#sku_note').val(), true);
            });

            function updateSkuStock(skuId, stockType, quantity, note, isSkuModal) {
                $('#pre-loader').removeClass('d-none');
                $.ajax({
                    url: "{{ route('product.stock.update') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        sku_id: skuId,
                        stock_type: stockType,
                        quantity: quantity,
                        note: note,
                        warehouse_id: $('#warehouse_filter').val()
                    },
                    success: function(response) {
                        $('#pre-loader').addClass('d-none');
                        if (response.success) {
                            toastr.success(response.message || "{{ __('common.updated_successfully') }}");
                            if (isSkuModal) {
                                $('.sku-stock-' + skuId).text(response.new_stock);
                                $('.edit-sku-stock[data-id="' + skuId + '"]').data('stock', response.new_stock);
                                $('#skuStockModal').modal('hide');
                            } else {
                                $('#current_stock').val(response.new_stock);
                                updateNewStock();
                            }
                            $('#sellerProductTable').DataTable().ajax.reload(null, false);
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

            // ===== MANAGE HISTORY FUNCTIONALITY =====
            var currentHistoryProductId = null;

            $(document).on('click', '.manage_history', function(e) {
                e.preventDefault();
                currentHistoryProductId = $(this).data('id');
                $('#history_from_date').val('');
                $('#history_to_date').val('');
                $('#manageHistoryModal').modal('show');
                loadProductHistory(currentHistoryProductId);
            });

            function loadProductHistory(productId, fromDate, toDate) {
                let url = "{{ route('product.history.get') }}?product_id=" + productId + "&warehouse_id=" + $('#warehouse_filter').val();
                if (fromDate) url += '&from_date=' + fromDate;
                if (toDate) url += '&to_date=' + toDate;
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        if (response.status) {
                            if (response.data.length === 0) {
                                $('#history_tbody').html('<tr><td colspan="7" class="text-center">{{ __("common.no_data_found") }}</td></tr>');
                                return;
                            }
                            let html = '';
                            $.each(response.data, function(i, item) {
                                let actionBadgeClass = 'badge-primary';
                                if (item.action.toLowerCase() === 'in') {
                                    actionBadgeClass = 'badge-success';
                                } else if (item.action.toLowerCase() === 'out') {
                                    actionBadgeClass = 'badge-danger';
                                }

                                let date = new Date(item.created_at);
                                let formattedDate = date.toLocaleDateString() + ' ' + date.toLocaleTimeString();

                                html += '<tr>';
                                html += '<td>' + formattedDate + '</td>';
                                html += '<td>' + item.user_name + '</td>';
                                html += '<td><span class="badge ' + actionBadgeClass + '">' + item.action + '</span></td>';
                                html += '<td>' + item.field_name + '</td>';
                                html += '<td style="font-weight:bold; color: #666;">' + item.old_value + '</td>';
                                html += '<td style="font-weight:bold; color: #000;">' + item.new_value + '</td>';
                                html += '<td><small>' + item.note + '</small></td>';
                                html += '</tr>';
                            });
                            $('#history_tbody').html(html);
                        } else {
                            $('#history_tbody').html('<tr><td colspan="7" class="text-center text-danger">' + response.message + '</td></tr>');
                        }
                    },
                    error: function() {
                        $('#history_tbody').html('<tr><td colspan="7" class="text-center text-danger">{{ __("common.error_message") }}</td></tr>');
                    }
                });
            }

            $('#filter_history_btn').on('click', function() {
                let from = $('#history_from_date').val();
                let to = $('#history_to_date').val();
                if (from && to && from > to) {
                    alert('{{ __("common.from_date_must_be_before_to_date") }}');
                    return;
                }
                loadProductHistory(currentHistoryProductId, from, to);
            });

            $('#reset_history_btn').on('click', function() {
                $('#history_from_date').val('');
                $('#history_to_date').val('');
                loadProductHistory(currentHistoryProductId);
            });
            // ===== END MANAGE HISTORY FUNCTIONALITY =====
            // ===== MANAGE WAREHOUSES FUNCTIONALITY =====
            $(document).on('click', '.assign_warehouses', function(e) {
                e.preventDefault();
                let product_id = $(this).data('id');
                let product_name = $(this).data('name');
                $('#mw_product_name').text(product_name);
                $('#mw_table_body').html('<tr><td colspan="2" class="text-center"><i class="fa fa-spinner fa-spin"></i> Loading...</td></tr>');
                $('#manage_warehouses_modal').modal('show');

                $.ajax({
                    url: '{{ route("seller.product.warehouses.status") }}',
                    type: 'GET',
                    data: { product_id: product_id },
                    success: function(response) {
                        let html = '';
                        if (response.length > 0) {
                            response.forEach(function(item) {
                                let checked = item.is_active == 1 ? 'checked' : '';
                                html += '<tr>';
                                html += '<td>' + item.name + '</td>';
                                html += '<td>';
                                html += '<label class="switch_toggle">';
                                html += '<input type="checkbox" class="mw_status_toggle" data-product="' + product_id + '" data-warehouse="' + item.id + '" ' + checked + '>';
                                html += '<span class="slider round"></span>';
                                html += '</label>';
                                html += '</td>';
                                html += '</tr>';
                            });
                        } else {
                            html = '<tr><td colspan="2" class="text-center text-danger">{{ __("common.no_warehouse_found") }}</td></tr>';
                        }
                        $('#mw_table_body').html(html);
                    },
                    error: function() {
                        $('#mw_table_body').html('<tr><td colspan="2" class="text-center text-danger">Error loading warehouses</td></tr>');
                    }
                });
            });

            $(document).on('change', '.mw_status_toggle', function() {
                let is_active = $(this).is(':checked') ? 1 : 0;
                let product_id = $(this).data('product');
                let warehouse_id = $(this).data('warehouse');
                
                $.ajax({
                    url: '{{ route("seller.product.warehouses.update_status") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: product_id,
                        warehouse_id: warehouse_id,
                        is_active: is_active
                    },
                    success: function(response) {
                        toastr.success('{{ __("common.updated_successfully") }}', '{{ __("common.success") }}');
                    },
                    error: function() {
                        toastr.error('{{ __("common.error_message") }}', '{{ __("common.error") }}');
                        // revert toggle
                        $(this).prop('checked', !is_active);
                    }
                });
            });
            // ===== END MANAGE WAREHOUSES FUNCTIONALITY =====

        });
    })(jQuery);
</script>
@endpush
