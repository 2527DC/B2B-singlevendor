@extends('backEnd.master')
@section('styles')

<link rel="stylesheet" href="{{asset(asset_path('modules/ordermanage/css/style.css'))}}" />

@endsection
@section('mainContent')

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-md-12 mb-20">
                <div class="box_header_right">
                    <div class="float-lg-right float-none pos_tab_btn justify-content-end">
                        <ul class="nav nav_list" role="tablist">
                            @if (permissionCheck('pending_orders'))
                                <li class="nav-item">
                                    <a class="nav-link active show" href="#order_pending_data" role="tab" data-toggle="tab" id="1" aria-selected="true">{{__('order.pending_orders')}}</a>
                                </li>
                            @endif

                            @if (permissionCheck('confirmed_orders'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#order_confirmed_data" role="tab" data-toggle="tab" id="2" aria-selected="true">{{__('order.confirmed_orders')}}</a>
                                </li>
                            @endif

                            @if (permissionCheck('completed_orders'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#order_complete_data" role="tab" data-toggle="tab" id="3" aria-selected="true">{{__('order.completed_orders')}}</a>
                                </li>
                            @endif

                            @if (permissionCheck('pending_payment_orders'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#pending_payment_data" role="tab" data-toggle="tab" id="4" aria-selected="true">{{__('order.pending_payment_orders')}}</a>
                                </li>
                            @endif

                            @if (permissionCheck('cancelled_orders'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#cancelled_data" role="tab" data-toggle="tab" id="5" aria-selected="true">{{__('order.cancelled_orders')}}</a>
                                </li>
                            @endif

                            @if (permissionCheck('inhouse_orders'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#inhouse_order_data" role="tab" data-toggle="tab" id="6" aria-selected="true">{{__('order.inhouse_orders')}}</a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="white_box_30px mb_30">

                    <div class="d-flex mb-3 align-items-center">
                        <div class="mr-2">
                            <select class="form-control" id="bulk_delivery_status">
                                <option value="">{{__('order.select_status')}}</option>
                                @foreach($processes as $process)
                                    <option value="{{ $process->id }}">{{ $process->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mr-2">
                            <button type="button" class="btn btn-primary" id="apply_bulk_delivery">{{__('common.apply')}}</button>
                        </div>
                        <div class="mr-2 text-muted">{{__('order.bulk_update_note')}}</div>
                    </div>

                    <div class="tab-content">
                        @if (permissionCheck('pending_orders'))
                            <div role="tabpanel" class="tab-pane fade active show" id="order_pending_data">
                                <div class="box_header common_table_header ">
                                    <div class="main-title d-md-flex">
                                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('order.pending_orders')}}</h3>
                                    </div>
                                </div>
                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table">

                                        <div class="" id="latest_order_div">
                                            <table class="table" id="orderPendingTable">
                                                <thead>
                                                    <tr>
                                                        <th><input type="checkbox" id="select_all_pending"></th>
                                                        <th>{{__('common.sl')}}</th>
                                                        <th width="10%">{{__('common.date')}}</th>
                                                        <th>{{__('common.order_id')}}</th>
                                                        <th>{{__('name')}}</th>
                                                        <th>{{__('phone')}}</th>
                                                        <th>{{__('common.email')}}</th>
                                                        <th>{{__('order.total_product_qty')}}</th>
                                                        <th>{{__('common.total_amount')}}</th>
                                                        <th>{{__('order.order_status')}}</th>
                                                        <th>{{__('order.is_paid')}}</th>
                                                        <th>{{__('common.action')}}</th>
                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (permissionCheck('confirmed_orders'))
                            <div role="tabpanel" class="tab-pane fade" id="order_confirmed_data">
                                <div class="box_header common_table_header ">
                                    <div class="main-title d-md-flex">
                                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('order.confirmed_orders')}}</h3>
                                    </div>
                                </div>
                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table">

                                        <div class="" id="latest_order_div">
                                            <table class="table" id="confirmedTable">
                                                <thead>
                                                    <tr>
                                                        <th><input type="checkbox" id="select_all_confirmed"></th>
                                                        <th>{{__('common.sl')}}</th>
                                                        <th width="10%">{{__('common.date')}}</th>
                                                        <th>{{__('common.order_id')}}</th>
                                                        <th>{{__('name')}}</th>
                                                        <th>{{__('phone')}}</th>
                                                        <th>{{__('common.email')}}</th>
                                                        <th>{{__('order.total_product_qty')}}</th>
                                                        <th>{{__('common.total_amount')}}</th>
                                                        <th>{{__('order.order_status')}}</th>
                                                        <th>{{__('order.is_paid')}}</th>
                                                        <th>{{__('common.action')}}</th>
                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (permissionCheck('completed_orders'))
                            <div role="tabpanel" class="tab-pane fade" id="order_complete_data">
                                <div class="box_header common_table_header ">
                                    <div class="main-title d-md-flex">
                                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('order.completed_orders')}}</h3>
                                    </div>
                                </div>
                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table">

                                        <div class="" id="latest_order_div">
                                            <table class="table" id="completedTable">
                                                <thead>
                                                    <tr>
                                                        <th><input type="checkbox" id="select_all_completed"></th>
                                                        <th>{{__('common.sl')}}</th>
                                                        <th width="10%">{{__('common.date')}}</th>
                                                        <th>{{__('common.order_id')}}</th>
                                                        <th>{{__('name')}}</th>
                                                        <th>{{__('phone')}}</th>
                                                        <th>{{__('common.email')}}</th>
                                                        <th>{{__('order.total_product_qty')}}</th>
                                                        <th>{{__('common.total_amount')}}</th>
                                                        <th>{{__('order.order_status')}}</th>
                                                        <th>{{__('order.is_paid')}}</th>
                                                        <th>{{__('common.action')}}</th>
                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (permissionCheck('pending_payment_orders'))
                            <div role="tabpanel" class="tab-pane fade" id="pending_payment_data">
                                <div class="box_header common_table_header ">
                                    <div class="main-title d-md-flex">
                                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('order.pending_payment_orders')}}</h3>
                                    </div>
                                </div>

                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table">

                                        <div class="" id="latest_order_div">
                                            <table class="table" id="pendingPaymentTable">
                                                <thead>
                                                    <tr>
                                                        <th><input type="checkbox" id="select_all_pending_payment"></th>
                                                        <th>{{__('common.sl')}}</th>
                                                        <th width="10%">{{__('common.date')}}</th>
                                                        <th>{{__('common.order_id')}}</th>
                                                        <th>{{__('name')}}</th>
                                                        <th>{{__('phone')}}</th>
                                                        <th>{{__('common.email')}}</th>
                                                        <th>{{__('order.total_product_qty')}}</th>
                                                        <th>{{__('common.total_amount')}}</th>
                                                        <th>{{__('order.order_status')}}</th>
                                                        <th>{{__('order.is_paid')}}</th>
                                                        <th>{{__('common.action')}}</th>
                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (permissionCheck('cancelled_orders'))
                            <div role="tabpanel" class="tab-pane fade" id="cancelled_data">
                                <div class="box_header common_table_header ">
                                    <div class="main-title d-md-flex">
                                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('order.cancelled_orders')}}</h3>
                                    </div>
                                </div>

                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table">

                                        <div class="" id="latest_order_div">
                                            <table class="table" id="canceledTable">
                                                <thead>
                                                    <tr>
                                                        <th><input type="checkbox" id="select_all_canceled"></th>
                                                        <th>{{__('common.sl')}}</th>
                                                        <th width="10%">{{__('common.date')}}</th>
                                                        <th>{{__('common.order_id')}}</th>
                                                        <th>{{__('name')}}</th>
                                                        <th>{{__('phone')}}</th>
                                                        <th>{{__('common.email')}}</th>
                                                        <th>{{__('order.total_product_qty')}}</th>
                                                        <th>{{__('common.total_amount')}}</th>
                                                        <th>{{__('order.order_status')}}</th>
                                                        <th>{{__('order.is_paid')}}</th>
                                                        <th>{{__('common.action')}}</th>
                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (permissionCheck('inhouse_orders'))
                            <div role="tabpanel" class="tab-pane fade" id="inhouse_order_data">
                                <div class="box_header common_table_header ">
                                    <div class="main-title d-md-flex">
                                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('order.inhouse_orders')}}</h3>
                                    </div>
                                </div>

                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table">

                                        <div class="" id="latest_order_div">
                                            <table class="table" id="inhouseOrderTable">
                                                <thead>
                                                    <tr>
                                                        <th><input type="checkbox" id="select_all_inhouse"></th>
                                                        <th>{{__('common.sl')}}</th>
                                                        <th width="10%">{{__('common.date')}}</th>
                                                        <th>{{__('common.order_id')}}</th>
                                                        <th>{{__('name')}}</th>
                                                        <th>{{__('phone')}}</th>
                                                        <th>{{__('common.email')}}</th>
                                                        <th>{{__('order.total_product_qty')}}</th>
                                                        <th>{{__('common.total_amount')}}</th>
                                                        <th>{{__('order.order_status')}}</th>
                                                        <th>{{__('order.is_paid')}}</th>
                                                        <th>{{__('common.action')}}</th>
                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>

                </div>
            </div>

        </div>
    </div>

</section>
@endsection

@push('scripts')
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){

                $('#orderPendingTable').DataTable({
                    processing: true,
                    serverSide: true,
                    "stateSave": true,
                    "ajax": ( {
                        url: "{{ route('order_manage.total_sales_get_data') }}" + '?table=pending'
                    }),
                    "initComplete":function(json){

                    },
                    columns: [
                        { data: null, orderable: false, searchable: false, render: function(data,type,row){
                                var html = '';
                                if(row.packages && row.packages.length){
                                    row.packages.forEach(function(p){
                                        if(row.is_confirmed == 1){
                                            html += '<label style="display:block;margin-bottom:2px;">'<
                                                + ' + '<input type="checkbox" class="bulk-select" data-package-id="'+p.id+'"> '+(p.package_number || ('#'+p.id)) + '</label>';
                                        } else {
                                            html += '<label style="display:block;margin-bottom:2px;color:#888;">'<
                                                + ' + '<input type="checkbox" disabled> '+(p.package_number || ('#'+p.id))+' (Unconfirmed)</label>';
                                        }
                                    });
                                }
                                return html;
                            }},
                        { data: 'DT_RowIndex', name: 'id',render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'date', name: 'date' },
                        { data: 'order_number', name: 'order_number' },
                        { data: 'customer_name', name: 'customer_name' },
                        { data: 'customer_phone', name: 'customer_phone' },
                        { data: 'email', name: 'customer.email' },
                        { data: 'total_qty', name: 'total_qty' },
                        { data: 'total_amount', name: 'grand_total' },
                        { data: 'order_status', name: 'order_status' },
                        { data: 'is_paid', name: 'is_paid' },
                        { data: 'action', name: 'action' }

                    ],

                    bLengthChange: false,
                    "bDestroy": true,
                    language: {
                        search: "<i class='ti-search'></i>",
                        searchPlaceholder: trans('common.quick_search'),
                        paginate: {
                            next: "<i class='ti-arrow-right'></i>",
                            previous: "<i class='ti-arrow-left'></i>"
                        },
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

                $('#pendingPaymentTable').DataTable({
                    processing: true,
                    serverSide: true,
                    "stateSave": true,
                    "ajax": ( {
                        url: "{{ route('order_manage.total_sales_get_data') }}" + '?table=pending_payment'
                    }),
                    "initComplete":function(json){

                    },
                    columns: [
                        { data: null, orderable: false, searchable: false, render: function(data,type,row){
                                var html = '';
                                if(row.packages && row.packages.length){
                                    row.packages.forEach(function(p){
                                        html += '<label style="display:block;margin-bottom:2px;"><input type="checkbox" class="bulk-select" data-package-id="'+p.id+'"> '+(p.package_number || ('#'+p.id))+'</label>';
                                    });
                                }
                                return html;
                            }},
                        { data: 'DT_RowIndex', name: 'id' ,render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'date', name: 'date' },
                        { data: 'order_number', name: 'order_number' },
                        { data: 'customer_name', name: 'customer_name' },
                        { data: 'customer_phone', name: 'customer_phone' },
                        { data: 'email', name: 'customer.email' },
                        { data: 'total_qty', name: 'total_qty' },
                        { data: 'total_amount', name: 'grand_total' },
                        { data: 'order_status', name: 'order_status' },
                        { data: 'is_paid', name: 'is_paid' },
                        { data: 'action', name: 'action' }

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

                $('#confirmedTable').DataTable({
    processing: true,
    serverSide: true,
    stateSave: true,

    ajax: {
        url: "{{ route('order_manage.total_sales_get_data') }}?table=confirmed",
        dataSrc: function (json) {
            console.log('FULL RESPONSE:', json);     // 🔥 logs everything
            console.log('ROWS DATA:', json.data);    // 🔥 actual table rows
            return json.data;
        }
    },

    columns: [
        { data: null, orderable: false, searchable: false, render: function(data,type,row){
                var html = '';
                if(row.packages && row.packages.length){
                    row.packages.forEach(function(p){
                        html += '<label style="display:block;margin-bottom:2px;"><input type="checkbox" class="bulk-select" data-package-id="'+p.id+'"> '+(p.package_number || ('#'+p.id))+'</label>';
                    });
                }
                return html;
            }},
        { data: 'DT_RowIndex', name: 'id', render: function (data) {
            return numbertrans(data);
        }},
        { data: 'date', name: 'date' },
        { data: 'order_number', name: 'order_number' },
        { data: 'customer_name', name: 'customer_name' },
        { data: 'customer_phone', name: 'customer_phone' },
        { data: 'email', name: 'customer.email' },
        { data: 'total_qty', name: 'total_qty' },
        { data: 'total_amount', name: 'grand_total' },
        { data: 'order_status', name: 'order_status' },
        { data: 'is_paid', name: 'is_paid' },
        { data: 'action', name: 'action' }
    ],

    bLengthChange: false,
    bDestroy: true,
    responsive: true
});


                $('#completedTable').DataTable({
                    processing: true,
                    serverSide: true,
                    "stateSave": true,
                    "ajax": ( {
                        url: "{{ route('order_manage.total_sales_get_data') }}" + '?table=completed'
                    }),
                    "initComplete":function(json){

                    },
                    columns: [
                        { data: null, orderable: false, searchable: false, render: function(data,type,row){
                                var html = '';
                                if(row.packages && row.packages.length){
                                    row.packages.forEach(function(p){
                                        html += '<label style="display:block;margin-bottom:2px;"><input type="checkbox" class="bulk-select" data-package-id="'+p.id+'"> '+(p.package_number || ('#'+p.id))+'</label>';
                                    });
                                }
                                return html;
                            }},
                        { data: 'DT_RowIndex', name: 'id' ,render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'date', name: 'date' },
                        { data: 'order_number', name: 'order_number' },
                        { data: 'customer_name', name: 'customer_name' },
                        { data: 'customer_phone', name: 'customer_phone' },
                        { data: 'email', name: 'customer.email' },
                        { data: 'total_qty', name: 'total_qty' },
                        { data: 'total_amount', name: 'grand_total' },
                        { data: 'order_status', name: 'order_status' },
                        { data: 'is_paid', name: 'is_paid' },
                        { data: 'action', name: 'action' }

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

                $('#canceledTable').DataTable({
                    processing: true,
                    serverSide: true,
                    "stateSave": true,
                    "ajax": ( {
                        url: "{{ route('order_manage.total_sales_get_data') }}" + '?table=canceled'
                    }),
                    "initComplete":function(json){

                    },
                    columns: [
                        { data: null, orderable: false, searchable: false, render: function(data,type,row){
                                var html = '';
                                if(row.packages && row.packages.length){
                                    row.packages.forEach(function(p){
                                        html += '<label style="display:block;margin-bottom:2px;"><input type="checkbox" class="bulk-select" data-package-id="'+p.id+'"> '+(p.package_number || ('#'+p.id))+'</label>';
                                    });
                                }
                                return html;
                            }},
                        { data: 'DT_RowIndex', name: 'id' ,render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'date', name: 'date' },
                        { data: 'order_number', name: 'order_number' },
                        { data: 'customer_name', name: 'customer_name' },
                        { data: 'customer_phone', name: 'customer_phone' },
                        { data: 'email', name: 'customer.email' },
                        { data: 'total_qty', name: 'total_qty' },
                        { data: 'total_amount', name: 'grand_total' },
                        { data: 'order_status', name: 'order_status' },
                        { data: 'is_paid', name: 'is_paid' },
                        { data: 'action', name: 'action' }

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

                $('#inhouseOrderTable').DataTable({
                    processing: true,
                    serverSide: true,
                    "stateSave": true,
                    "ajax": ( {
                        url: "{{ route('order_manage.total_sales_get_data') }}" + '?table=inhouse'
                    }),
                    "initComplete":function(json){

                    },
                    columns: [
                        { data: null, orderable: false, searchable: false, render: function(data,type,row){ return '<input type="checkbox" class="bulk-select" data-order-id="'+row.id+'" />'; }},
                        { data: 'DT_RowIndex', name: 'id' ,render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'date', name: 'date' },
                        { data: 'order_number', name: 'order_number' },
                        { data: 'customer_name', name: 'customer_name' },
                        { data: 'customer_phone', name: 'customer_phone' }, 
                        { data: 'email', name: 'customer.email' },
                        { data: 'total_qty', name: 'total_qty' },
                        { data: 'total_amount', name: 'grand_total' },
                        { data: 'order_status', name: 'order_status' },
                        { data: 'is_paid', name: 'is_paid' },
                        { data: 'action', name: 'action' }

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

            });
        })(jQuery);
                $(document).on('change', '#select_all_pending', function(){
                    var checked = $(this).is(':checked');
                    $('#orderPendingTable').find('.bulk-select').prop('checked', checked);
                });
                $(document).on('change', '#select_all_confirmed', function(){
                    var checked = $(this).is(':checked');
                    $('#confirmedTable').find('.bulk-select').prop('checked', checked);
                });
                $(document).on('change', '#select_all_completed', function(){
                    var checked = $(this).is(':checked');
                    $('#completedTable').find('.bulk-select').prop('checked', checked);
                });
                $(document).on('change', '#select_all_pending_payment', function(){
                    var checked = $(this).is(':checked');
                    $('#pendingPaymentTable').find('.bulk-select').prop('checked', checked);
                });
                $(document).on('change', '#select_all_canceled', function(){
                    var checked = $(this).is(':checked');
                    $('#canceledTable').find('.bulk-select').prop('checked', checked);
                });
                $(document).on('change', '#select_all_inhouse', function(){
                    var checked = $(this).is(':checked');
                    $('#inhouseOrderTable').find('.bulk-select').prop('checked', checked);
                });

                $('#apply_bulk_delivery').on('click', function(){
                    var status = $('#bulk_delivery_status').val();
                    if(!status){
                        alert('{{ __('order.select_status') }}');
                        return;
                    }
                    var selectedPackages = [];
                    $('.bulk-select:checked').each(function(){
                        selectedPackages.push($(this).data('package-id'));
                    });
                    if(selectedPackages.length == 0){
                        alert('{{ __('order.select_at_least_one') }}');
                        return;
                    }

                    var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('meta[name="_token"]').attr('content');
                    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': csrfToken } });
                    $.ajax({
                        url: "{{ route('order_manage.bulk_update_delivery') }}",
                        method: 'POST',
                        data: { package_ids: selectedPackages, delivery_status: status },
                        beforeSend: function(){
                            $('#apply_bulk_delivery').prop('disabled', true);
                        },
                        success: function(res){
                            alert(res.message || '{{ __('common.updated_successfully') }}');
                            $('#apply_bulk_delivery').prop('disabled', false);
                            // reload all tables
                            $('#orderPendingTable').DataTable().ajax.reload();
                            $('#pendingPaymentTable').DataTable().ajax.reload();
                            $('#confirmedTable').DataTable().ajax.reload();
                            $('#completedTable').DataTable().ajax.reload();
                            $('#canceledTable').DataTable().ajax.reload();
                            $('#inhouseOrderTable').DataTable().ajax.reload();
                        },
                        error: function(err){
                            var msg = '{{ __('common.operation_failed') }}';
                            try{
                                if(err.responseJSON && err.responseJSON.message){
                                    msg = err.responseJSON.message;
                                } else if(err.responseText){
                                    msg = err.responseText;
                                }
                            }catch(e){}
                            alert(msg);
                            $('#apply_bulk_delivery').prop('disabled', false);
                        }
                    });
                });
    </script>
@endpush
