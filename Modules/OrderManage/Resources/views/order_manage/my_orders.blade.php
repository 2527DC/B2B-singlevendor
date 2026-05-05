@extends('backEnd.master')
@section('styles')

<link rel="stylesheet" href="{{asset(asset_path('modules/ordermanage/css/style.css'))}}" />

<style>
    /* SELECT ALL Checkbox Column */
    
    
    
    /* Individual Select Checkbox Column */
    .checkbox-column-item {
        width: 60px !important;
        text-align: center;
        padding: 12px 8px !important;
        background-color: #f0f4f8;
        border-right: 2px solid #9E9E9E;
        font-weight: 600;
        color: #666;
    }
    
    #orderConfimedTable tbody td.checkbox-column-item {
        text-align: center;
        padding: 12px 8px !important;
        background-color: #fafafa;
        border-right: 2px solid #9E9E9E;
        vertical-align: middle;
    }
    
    
    .checkbox-column-item input[type="checkbox"] {
        cursor: pointer;
        width: 18px;
        height: 18px;
        margin: 0;
        vertical-align: middle;
    }
    
    /* Hover effects */
    
    #orderConfimedTable tbody tr:hover td.checkbox-column-item {
        background-color: #f5f5f5;
    }
    .dtr-control {
        width: 40px !important;
        text-align: center !important;
        cursor: pointer;
    }
    
    .checkbox-column-item {
        width: 60px !important;
        text-align: center !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    .checkbox-column-item input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }
</style>

@endsection

@section('mainContent')
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-md-12 mb-20">
                <div class="box_header_right">
                    <div class="float-lg-right float-none pos_tab_btn justify-content-end">
                        <ul class="nav nav_list" role="tablist">
                            <!-- @if (permissionCheck('pending_orders')) -->
                                <li class="nav-item">
                                    <a class="nav-link active show" href="#order_pending_data" role="tab" data-toggle="tab" id="1" aria-selected="true">{{__('order.pending_orders')}}</a>
                                </li>
                            <!-- @endif -->

                            @if (permissionCheck('confirmed_orders'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#order_confirmed_data" role="tab" data-toggle="tab" id="2" aria-selected="true">{{__('order.confirmed_orders')}}</a>
                                </li>
                            @endif

                            @if (permissionCheck('complete_orders'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#order_complete_data" role="tab" data-toggle="tab" id="1" aria-selected="true">{{__('order.completed_orders')}}</a>
                                </li>
                            @endif

                            @if (permissionCheck('pending_orders'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#pending_payment_data" role="tab" data-toggle="tab" id="1" aria-selected="true">{{__('order.pending_payment_orders')}}</a>
                                </li>
                            @endif

                            @if (permissionCheck('cancelled_orders'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#cancelled_data" role="tab" data-toggle="tab" id="1" aria-selected="true">{{__('order.cancelled_orders')}}</a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="white_box_30px mb_30">

                    <div class="tab-content">
                        @if (permissionCheck('pending_orders'))
                            <div role="tabpanel" class="tab-pane fade active show" id="order_pending_data">
                                <div class="box_header common_table_header ">
                                    <div class="main-title d-md-flex">
                                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('order.pending_orders')}}</h3>
                                    </div>
                                </div>

                                <div class="d-flex mb-3 align-items-center">
                                    <div class="mr-2">
                                        <button type="button" class="btn btn-primary" id="apply_bulk_confirm_pending" disabled>{{__('common.confirm') ?? 'Confirm Selected'}}</button>
                                    </div>
{{-- 
                                    @if (permissionCheck('shipping.invoice_generate'))
                                        <div class="mr-2">
                                            <button type="button" class="btn btn-info bulk_download_invoices_btn" data-table-type="pending" title="Download Selected Invoices" disabled><i class="fa fa-download"></i></button>
                                        </div>
                                    @endif
--}}
                                </div>

                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table">

                                        <div class="" id="latest_order_div">
                                            <table class="table shadow_none" id="orderPendingTable">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th class="checkbox-column-item"><input type="checkbox" id="select_all_pending" title="{{__('order.select_all_orders')}}"></th>
                                                        <th>{{__('common.sl')}}</th>
                                                        <th width="10%">{{__('common.date')}}</th>
                                                        <th>{{__('common.order_id')}}</th>
                                                        <th>Shop Name</th>
                                                        <th>{{__('common.email')}}</th>
                                                        <th>{{__('order.order_state')}}</th>
                                                        <th>{{__('common.total_amount')}}</th>
                                                        <th>{{__('order.order_status')}}</th>
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


                                <div class="d-flex mb-3 align-items-center">
                                    <div class="mr-2">
                                        <select class="form-control" id="bulk_driver_confirmed">
                                            <option value="">Select Driver</option>
                                            @foreach($drivers as $driver)
                                                <option value="{{ $driver->id }}">{{ $driver->name }}@if($driver->vehicle_number) - {{$driver->vehicle_number}}@endif</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mr-2">
                                        <button type="button" class="btn btn-success" id="apply_bulk_driver_confirmed">Assign Driver</button>
                                    </div>
                                    @if (permissionCheck('shipping.invoice_generate'))
                                        <div class="mr-2">
                                            <button type="button" class="btn btn-info bulk_download_invoices_btn" data-table-type="confirmed" title="Download Selected Invoices" disabled><i class="fa fa-download"></i></button>
                                        </div>
                                    @endif
                                </div>

                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table">

                                        <div class="" id="latest_order_div">
                                            <table class="table shadow_none" id="orderConfimedTable">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th class="checkbox-column-item"><input type="checkbox" id="select_all_confirmed" title="{{__('order.select_all_orders')}}"></th>
                                                        <th>{{__('common.sl')}}</th>
                                                        <th width="10%">{{__('common.date')}}</th>
                                                        <th>{{__('common.order_id')}}</th>
                                                        <th>Shop Name</th>
                                                        <th>{{__('common.email')}}</th>
                                                        <th>{{__('order.delivery_status')}}</th>
                                                        <th>{{__('common.total_amount')}}</th>
                                                        <th>{{__('order.order_status')}}</th>
                                                        <th>Vehicle No</th>
                                                        <th>{{__('common.action')}}</th>
                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (permissionCheck('complete_orders'))
                            <div role="tabpanel" class="tab-pane fade" id="order_complete_data">
                                <div class="box_header common_table_header ">
                                    <div class="main-title d-md-flex">
                                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('order.completed_orders')}}</h3>
                                    </div>
                                </div>
                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table">

                                        <div class="" id="latest_order_div">
                                            <table class="table shadow_none" id="orderCompletedTable">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>{{__('common.sl')}}</th>
                                                        <th width="10%">{{__('common.date')}}</th>
                                                        <th>{{__('common.order_id')}}</th>
                                                        <th>Shop Name</th>
                                                        <th>{{__('common.email')}}</th>
                                                        <th>{{__('order.order_state')}}</th>
                                                        <th>{{__('common.total_amount')}}</th>
                                                        <th>{{__('order.order_status')}}</th>
                                                        <th>Vehicle No</th>
                                                        <th>{{__('common.action')}}</th>
                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (permissionCheck('pending_orders'))
                            <div role="tabpanel" class="tab-pane fade" id="pending_payment_data">
                                <div class="box_header common_table_header ">
                                    <div class="main-title d-md-flex">
                                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('order.pending_payment_orders')}}</h3>
                                    </div>
                                </div>

                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table">

                                        <div class="" id="latest_order_div">
                                            <table class="table shadow_none" id="orderPendingPaymentTable">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>{{__('common.sl')}}</th>
                                                        <th width="10%">{{__('common.date')}}</th>
                                                        <th>{{__('common.order_id')}}</th>
                                                        <th>Shop Name</th>
                                                        <th>{{__('common.email')}}</th>
                                                        <th>{{__('order.order_state')}}</th>
                                                        <th>{{__('common.total_amount')}}</th>
                                                        <th>{{__('order.order_status')}}</th>
                                                        <th>Vehicle No</th>
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
                                            <table class="table shadow_none" id="orderCanceledTable">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>{{__('common.sl')}}</th>
                                                        <th width="10%">{{__('common.date')}}</th>
                                                        <th>{{__('common.order_id')}}</th>
                                                        <th>Shop Name</th>
                                                        <th>{{__('common.email')}}</th>
                                                        <th>{{__('order.order_state')}}</th>
                                                        <th>{{__('common.total_amount')}}</th>
                                                        <th>{{__('order.order_status')}}</th>
                                                        <th>Vehicle No</th>
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
                $('#orderConfimedTable').DataTable({
                    processing: true,
                    serverSide: true,
                    "stateSave": true,
                    "ajax": ( {
                        url: "{{ route('order_manage.my_sales_get_data') }}" + '?table=confirmed'
                    }),
                    "initComplete":function(json){

                    },
                    columns: [
                        { data: null, orderable: false, searchable: false, render: function(data,type,row){
                                return '';
                            }, className: 'dtr-control'},
                        { data: null, orderable: false, searchable: false, render: function(data,type,row){
                                return '<input type="checkbox" class="bulk-select-confirmed" data-package-id="'+row.id+'" data-order-id="'+row.order_id+'" />';
                            }, className: 'checkbox-column-item'},
                        { data: 'DT_RowIndex', name: 'id',render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'date', name: 'date' },
                        { data: 'order_number', name: 'order.order_number' },
                        { data: 'shop_name', name: 'shop_name' },
                        { data: 'email', name: 'email' },
                        { data: 'order_state', name: 'order_state' },
                        { data: 'total_amount', name: 'order.grand_total' },
                        { data: 'order_status', name: 'order_status' },
                        { data: 'vehicle_no', name: 'vehicle_no' },
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
                    columnDefs: [
                        { responsivePriority: 1, targets: [0, 1] },
                        { responsivePriority: 2, targets: -1 }
                    ],
                    responsive: true,
                });

                $('#orderCompletedTable').DataTable({
                    processing: true,
                    serverSide: true,
                    "stateSave": true,
                    "ajax": ( {
                        url: "{{ route('order_manage.my_sales_get_data') }}" + '?table=completed'
                    }),
                    "initComplete":function(json){

                    },
                    columns: [
                        { data: null, orderable: false, searchable: false, render: function(data,type,row){ return ""; }, className: "dtr-control"},                        { data: 'DT_RowIndex', name: 'id',render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'date', name: 'date' },
                        { data: 'order_number', name: 'order.order_number' },
                        { data: 'shop_name', name: 'shop_name' },
                        { data: 'email', name: 'email' },
                        { data: 'order_state', name: 'order_state' },
                        { data: 'total_amount', name: 'order.grand_total' },
                        { data: 'order_status', name: 'order_status' },
                        { data: 'vehicle_no', name: 'vehicle_no' },
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
                    columnDefs: [
                        { responsivePriority: 1, targets: [0, 1] },
                        { responsivePriority: 2, targets: -1 }
                    ],
                    responsive: true,
                });

                $('#orderPendingTable').DataTable({
                    processing: true,
                    serverSide: true,
                    "stateSave": true,
                    "ajax": ( {
                        url: "{{ route('order_manage.my_sales_get_data') }}" + '?table=pending'
                    }),
                    "initComplete":function(json){

                    },
                    columns: [
                        { data: null, orderable: false, searchable: false, render: function(data,type,row){
                                return '';
                            }, className: 'dtr-control'},
                        { data: null, orderable: false, searchable: false, render: function(data,type,row){
                                return '<input type="checkbox" class="bulk-select-pending" data-package-id="'+row.id+'" data-order-id="'+row.order_id+'" />';
                            }, className: 'checkbox-column-item'},
                        { data: 'DT_RowIndex', name: 'id',render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'date', name: 'date' },
                        { data: 'order_number', name: 'order.order_number' },
                        { data: 'shop_name', name: 'shop_name' },
                        { data: 'email', name: 'email' },
                        { data: 'order_state', name: 'order_state' },
                        { data: 'total_amount', name: 'order.grand_total' },
                        { data: 'order_status', name: 'order_status' },
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
                    columnDefs: [
                        { responsivePriority: 1, targets: [0, 1] },
                        { responsivePriority: 2, targets: -1 }
                    ],
                    responsive: true,
                });

                $('#orderPendingPaymentTable').DataTable({
                    processing: true,
                    serverSide: true,
                    "stateSave": true,
                    "ajax": ( {
                        url: "{{ route('order_manage.my_sales_get_data') }}" + '?table=pending_payment'
                    }),
                    "initComplete":function(json){

                    },
                    columns: [
                        { data: null, orderable: false, searchable: false, render: function(data,type,row){ return ""; }, className: "dtr-control"},                        { data: 'DT_RowIndex', name: 'id',render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'date', name: 'date' },
                        { data: 'order_number', name: 'order.order_number' },
                        { data: 'shop_name', name: 'shop_name' },
                        { data: 'email', name: 'email' },
                        { data: 'order_state', name: 'order_state' },
                        { data: 'total_amount', name: 'order.grand_total' },
                        { data: 'order_status', name: 'order_status' },
                        { data: 'vehicle_no', name: 'vehicle_no' },
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
                    columnDefs: [
                        { responsivePriority: 1, targets: [0, 1] },
                        { responsivePriority: 2, targets: -1 }
                    ],
                    responsive: true,
                });

                $('#orderCanceledTable').DataTable({
                    processing: true,
                    serverSide: true,
                    "stateSave": true,
                    "ajax": ( {
                        url: "{{ route('order_manage.my_sales_get_data') }}" + '?table=canceled'
                    }),
                    "initComplete":function(json){

                    },
                    columns: [
                        { data: null, orderable: false, searchable: false, render: function(data,type,row){ return ""; }, className: "dtr-control"},                        { data: 'DT_RowIndex', name: 'id',render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'date', name: 'date' },
                        { data: 'order_number', name: 'order.order_number' },
                        { data: 'shop_name', name: 'shop_name' },
                        { data: 'email', name: 'email' },
                        { data: 'order_state', name: 'order_state' },
                        { data: 'total_amount', name: 'order.grand_total' },
                        { data: 'order_status', name: 'order_status' },
                        { data: 'vehicle_no', name: 'vehicle_no' },
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
                    columnDefs: [
                        { responsivePriority: 1, targets: [0, 1] },
                        { responsivePriority: 2, targets: -1 }
                    ],
                    responsive: true,
                });
            });
        })(jQuery);

        $(document).on('change', '#select_all_confirmed', function(){
            var checked = $(this).is(':checked');
            $('#orderConfimedTable').find('.bulk-select-confirmed').prop('checked', checked);
        });


        // Bulk driver assignment
        $('#apply_bulk_driver_confirmed').on('click', function(){
            var driverId = $('#bulk_driver_confirmed').val();
            if(driverId == '') driverId = null;
            var selected = [];
            $('.bulk-select-confirmed:checked').each(function(){
                selected.push($(this).data('order-id'));
            });
            if(selected.length == 0){
                alert('{{__('order.select_at_least_one')}}');
                return;
            }

            var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('meta[name="_token"]').attr('content');
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': csrfToken } });
            $.ajax({
                url: "{{ route('order_manage.bulk_assign_driver') }}",
                method: 'POST',
                data: { order_ids: selected, driver_id: driverId },
                beforeSend: function(){
                    $('#apply_bulk_driver_confirmed').prop('disabled', true);
                },
                success: function(res){
                    alert(res.message || 'Driver assigned successfully');
                    $('#apply_bulk_driver_confirmed').prop('disabled', false);
                    $('#orderConfimedTable').DataTable().ajax.reload();
                },
                error: function(err){
                    var msg = 'Operation failed';
                    if(err.responseJSON && err.responseJSON.message) {
                        msg = err.responseJSON.message;
                    }
                    alert(msg);
                    $('#apply_bulk_driver_confirmed').prop('disabled', false);
                }
            });
        });

        // Bulk confirm pending orders
        $(document).on('change', '#select_all_pending', function(){
            var checked = $(this).is(':checked');
            $('#orderPendingTable').find('.bulk-select-pending').prop('checked', checked);
            toggleBulkConfirmButton();
        });

        $(document).on('change', '.bulk-select-pending', function(){
            toggleBulkConfirmButton();
        });

        function toggleBulkConfirmButton() {
            if ($('.bulk-select-pending:checked').length > 0) {
                $('#apply_bulk_confirm_pending').prop('disabled', false);
            } else {
                $('#apply_bulk_confirm_pending').prop('disabled', true);
            }
        }

        $('#apply_bulk_confirm_pending').on('click', function(){
            var selected = [];
            $('.bulk-select-pending:checked').each(function(){
                var orderId = $(this).data('order-id');
                if(orderId && selected.indexOf(orderId) === -1) {
                    selected.push(orderId);
                }
            });
            if(selected.length == 0){
                alert('{{ __('order.select_at_least_one') }}');
                return;
            }

            var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('meta[name="_token"]').attr('content');
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': csrfToken } });
            $.ajax({
                url: "{{ route('order_manage.bulk_confirm_pending') }}",
                method: 'POST',
                data: { order_ids: selected },
                beforeSend: function(){
                    $('#apply_bulk_confirm_pending').prop('disabled', true);
                },
                success: function(res){
                    alert(res.message || '{{ __('common.updated_successfully') }}');
                    $('#apply_bulk_confirm_pending').prop('disabled', true);
                    $('#select_all_pending').prop('checked', false);
                    $('#orderPendingTable').DataTable().ajax.reload();
                    if ($.fn.DataTable.isDataTable('#orderConfimedTable')) {
                        $('#orderConfimedTable').DataTable().ajax.reload();
                    }
                },
                error: function(err){
                    var msg = '{{ __('common.operation_failed') }}';
                    if(err.responseJSON && err.responseJSON.message) {
                        msg = err.responseJSON.message;
                    }
                    alert(msg);
                    $('#apply_bulk_confirm_pending').prop('disabled', false);
                }
            });
        });

        // Toggle bulk download invoice buttons
        $(document).on('change', '.bulk-select-pending, #select_all_pending', function() {
            let checkedCount = $('.bulk-select-pending:checked').length;
            $('.bulk_download_invoices_btn[data-table-type="pending"]').prop('disabled', checkedCount === 0);
        });

        $(document).on('change', '.bulk-select-confirmed, #select_all_confirmed', function() {
            let checkedCount = $('.bulk-select-confirmed:checked').length;
            $('.bulk_download_invoices_btn[data-table-type="confirmed"]').prop('disabled', checkedCount === 0);
        });

        // Handle bulk invoice download click
        $(document).on('click', '.bulk_download_invoices_btn', function(e) {
            e.preventDefault();
            let type = $(this).data('table-type');
            let selector = type === 'pending' ? '.bulk-select-pending:checked' : '.bulk-select-confirmed:checked';
            
            let invoiceIds = [];
            $(selector).each(function() {
                if($(this).data('package-id')) {
                    invoiceIds.push($(this).data('package-id'));
                }
            });

            if (invoiceIds.length === 0) {
                if (typeof toastr !== 'undefined') {
                    toastr.warning('Please select at least one order to download the invoice');
                } else {
                    alert('Please select at least one order to download the invoice');
                }
                return false;
            }

            $('#bulk_invoice_inputs').empty();
            invoiceIds.forEach(function(id) {
                $('#bulk_invoice_inputs').append('<input type="hidden" name="invoice_ids[]" value="'+id+'">');
            });

            $('#bulk_invoice_download_form').submit();
        });
    </script>
    <form id="bulk_invoice_download_form" method="POST" action="{{ route('shipping.bulk_invoice_download') }}" target="_blank" style="display:none;">
        @csrf
        <div id="bulk_invoice_inputs"></div>
    </form>
@endpush
