<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/adminreport/css/style.css'))); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title', app('general_setting')->site_title); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="container-fluid p-0 mb-5">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('report.filter_selection_criteria')); ?>

                                <?php echo e(__('common.for')); ?> <?php echo e(__('common.order')); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="white_box_50px box_shadow_white pb-3">
                        <form class="" action="<?php echo e(route('report.order')); ?>" method="GET">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for=""><?php echo e(__('common.type')); ?></label>
                                        <select required class="primary_select mb-15" name="type" id="type">
                                            <option value=""><?php echo e(__('common.select_one')); ?></option>

                                            <option <?php if(!isset($type)): ?> selected <?php endif; ?> <?php if(isset($type) && $type=="all"
                                                ): ?> selected <?php endif; ?> value="all"><?php echo e(__('common.all')); ?>

                                                <?php echo e(__('common.order')); ?></option>

                                            <option <?php if(isset($type) && $type=="pending" ): ?> selected <?php endif; ?>
                                                value="pending"><?php echo e(__('order.pending_orders')); ?></option>
                                            <option <?php if(isset($type) && $type=="confirmed" ): ?> selected <?php endif; ?>
                                                value="confirmed"><?php echo e(__('order.confirmed_orders')); ?></option>
                                            <option <?php if(isset($type) && $type=="completed" ): ?> selected <?php endif; ?>
                                                value="completed"><?php echo e(__('order.completed_orders')); ?></option>
                                            <option <?php if(isset($type) && $type=="inhouse" ): ?> selected <?php endif; ?>
                                                value="inhouse"><?php echo e(__('order.inhouse_orders')); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo e($errors->first('seller_id')); ?></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for=""><?php echo e(__('common.date')); ?></label>
                                        <div class="primary_datepicker_input">
                                            <div class="no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="">

                                                        <input id="reportrange" placeholder="<?php echo e(__('common.date')); ?>"
                                                            class="primary_input_field primary-input form-control"
                                                            type="text" name="reportrange" autocomplete="off" readonly
                                                            required>
                                                        <input type="hidden" name="start_date" id="start_date"
                                                            value="01-01-2020">
                                                        <input type="hidden" name="end_date" id="end_date"

                                                            value="<?php echo e(date('d-m-Y',strtotime(today()))); ?>">
                                                    </div>
                                                </div>
                                                <button class="btn-date" data-id="#reportrange" type="button">
                                                    <i class="ti-calendar" id="start-date-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="primary_input">
                                    <button type="submit" class="primary-btn fix-gr-bg" id="save_button_parent"><i
                                            class="ti-search"></i><?php echo e(__('report.search')); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <?php if(isset($type) && $type == "all"): ?>
                <div role="tabpanel" class="tab-pane fade active show" id="order_all_data">
                    <div class="box_header common_table_header ">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('common.all')); ?>

                                <?php echo e(__('common.order')); ?></h3>
                        </div>
                    </div>
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table">

                            <div class="" id="latest_order_div">
                                <table class="table" id="allOrderTable">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('common.sl')); ?></th>
                                            <th width="10%"><?php echo e(__('common.date')); ?></th>
                                            <th><?php echo e(__('common.order_id')); ?></th>
                                            <th><?php echo e(__('common.email')); ?></th>
                                            <th><?php echo e(__('order.product_qty')); ?></th>
                                            <th><?php echo e(__('common.total_amount')); ?></th>
                                            <th><?php echo e(__('order.order_status')); ?></th>
                                            <th><?php echo e(__('order.is_paid')); ?></th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(isset($type) && $type == "pending"): ?>
                <div role="tabpanel" class="tab-pane fade active show" id="order_pending_data">
                    <div class="box_header common_table_header ">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('order.pending_orders')); ?></h3>
                        </div>
                    </div>
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table">

                            <div class="" id="latest_order_div">
                                <table class="table" id="orderPendingTable">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('common.sl')); ?></th>
                                            <th width="10%"><?php echo e(__('common.date')); ?></th>
                                            <th><?php echo e(__('common.order_id')); ?></th>
                                            <th><?php echo e(__('common.email')); ?></th>
                                            <th><?php echo e(__('order.product_qty')); ?></th>
                                            <th><?php echo e(__('common.total_amount')); ?></th>
                                            <th><?php echo e(__('order.order_status')); ?></th>
                                            <th><?php echo e(__('order.is_paid')); ?></th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(isset($type) && $type == "confirmed"): ?>
                <div role="tabpanel" class="tab-pane fade active show" id="order_confirmed_data">
                    <div class="box_header common_table_header ">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('order.confirmed_orders')); ?> </h3>
                        </div>
                    </div>
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table">

                            <div class="" id="latest_order_div">
                                <table class="table" id="confirmedTable">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('common.sl')); ?></th>
                                            <th width="10%"><?php echo e(__('common.date')); ?></th>
                                            <th><?php echo e(__('common.order_id')); ?></th>
                                            <th><?php echo e(__('common.email')); ?></th>
                                            <th><?php echo e(__('order.product_qty')); ?></th>
                                            <th><?php echo e(__('common.total_amount')); ?></th>
                                            <th><?php echo e(__('order.order_status')); ?></th>
                                            <th><?php echo e(__('order.is_paid')); ?></th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(isset($type) && $type == "completed"): ?>
                <div role="tabpanel" class="tab-pane fade active show" id="order_complete_data">
                    <div class="box_header common_table_header ">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('order.completed_orders')); ?></h3>
                        </div>
                    </div>
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table">

                            <div class="" id="latest_order_div">
                                <table class="table" id="completedTable">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('common.sl')); ?></th>
                                            <th width="10%"><?php echo e(__('common.date')); ?></th>
                                            <th><?php echo e(__('common.order_id')); ?></th>
                                            <th><?php echo e(__('common.email')); ?></th>
                                            <th><?php echo e(__('order.product_qty')); ?></th>
                                            <th><?php echo e(__('common.total_amount')); ?></th>
                                            <th><?php echo e(__('order.order_status')); ?></th>
                                            <th><?php echo e(__('order.is_paid')); ?></th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(isset($type) && $type == "inhouse"): ?>
                <div role="tabpanel" class="tab-pane fade active show" id="inhouse_order_data">
                    <div class="box_header common_table_header ">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('order.inhouse_orders')); ?></h3>
                        </div>
                    </div>

                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table">

                            <div class="" id="latest_order_div">
                                <table class="table" id="inhouseOrderTable">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('common.sl')); ?></th>
                                            <th width="10%"><?php echo e(__('common.date')); ?></th>
                                            <th><?php echo e(__('common.order_id')); ?></th>
                                            <th><?php echo e(__('common.email')); ?></th>
                                            <th><?php echo e(__('order.product_qty')); ?></th>
                                            <th><?php echo e(__('common.total_amount')); ?></th>
                                            <th><?php echo e(__('order.order_status')); ?></th>
                                            <th><?php echo e(__('order.is_paid')); ?></th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
$(function() {
    <?php if(isset($start_date) && isset($end_date)): ?>
        var start = moment("<?php echo e(date('m/d/Y',strtotime($start_date))); ?>");
        var end = moment("<?php echo e(date('m/d/Y',strtotime($end_date))); ?>");
    <?php else: ?>
        var start = moment();
        var end = moment();
    <?php endif; ?>
    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        $('#start_date').val(start.format('DD-MM-YYYY'));
        $('#end_date').val(end.format('DD-MM-YYYY'));
    }
    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        "buttonClasses": "primary-btn fix-gr-bg",
        "applyButtonClasses": "primary-btn fix-gr-bg",
        "cancelClass": "primary-btn fix-gr-bg",
        "timePicker": false,
        "linkedCalendars": false,
        ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        'This Year': [moment().startOf('year'), moment().endOf('year')],
        'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
        }
    }, cb);

    cb(start, end);
});
(function($){
    "use strict";
    $('#allOrderTable').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            "ajax": ( {
                url: "<?php echo e(route('report.order_data')); ?>" + '?table=all&start_date=<?php echo e($start_date); ?>&end_date=<?php echo e($end_date); ?>'
            }),
            "initComplete":function(json){

            },
            columns: [
                { data: 'DT_RowIndex', name: 'id' ,render:function(data){
                    return numbertrans(data)
                }},
                { data: 'date', name: 'date' },
                { data: 'order_number', name: 'order_number' },
                { data: 'email', name: 'email' },
                { data: 'total_qty', name: 'total_qty' },
                { data: 'total_amount', name: 'total_amount' },
                { data: 'order_status', name: 'order_status' },
                { data: 'is_paid', name: 'is_paid' },

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
    $('#orderPendingTable').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            "ajax": ( {
                url: "<?php echo e(route('report.order_data')); ?>" + '?table=pending&start_date=<?php echo e($start_date); ?>&end_date=<?php echo e($end_date); ?>'
            }),
            "initComplete":function(json){

            },
            columns: [
                { data: 'DT_RowIndex', name: 'id' ,render:function(data){
                    return numbertrans(data)
                }},
                { data: 'date', name: 'date' },
                { data: 'order_number', name: 'order_number' },
                { data: 'email', name: 'email' },
                { data: 'total_qty', name: 'total_qty' },
                { data: 'total_amount', name: 'total_amount' },
                { data: 'order_status', name: 'order_status' },
                { data: 'is_paid', name: 'is_paid' },

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
        "ajax": ( {
            url: "<?php echo e(route('report.order_data')); ?>" + '?table=confirmed&start_date=<?php echo e($start_date); ?>&end_date=<?php echo e($end_date); ?>'
        }),
        "initComplete":function(json){

        },
        columns: [
            { data: 'DT_RowIndex', name: 'id' ,render:function(data){
                    return numbertrans(data)
                }},
            { data: 'date', name: 'date' },
            { data: 'order_number', name: 'order_number' },
            { data: 'email', name: 'email' },
            { data: 'total_qty', name: 'total_qty' },
            { data: 'total_amount', name: 'total_amount' },
            { data: 'order_status', name: 'order_status' },
            { data: 'is_paid', name: 'is_paid' },

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
    $('#completedTable').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        "ajax": ( {
            url: "<?php echo e(route('report.order_data')); ?>" + '?table=completed&start_date=<?php echo e($start_date); ?>&end_date=<?php echo e($end_date); ?>'
        }),
        "initComplete":function(json){

        },
        columns: [
            { data: 'DT_RowIndex', name: 'id' ,render:function(data){
                    return numbertrans(data)
                }},
            { data: 'date', name: 'date' },
            { data: 'order_number', name: 'order_number' },
            { data: 'email', name: 'email' },
            { data: 'total_qty', name: 'total_qty' },
            { data: 'total_amount', name: 'total_amount' },
            { data: 'order_status', name: 'order_status' },
            { data: 'is_paid', name: 'is_paid' },

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
        stateSave: true,
        "ajax": ( {
            url: "<?php echo e(route('report.order_data')); ?>" + '?table=inhouse&start_date=<?php echo e($start_date); ?>&end_date=<?php echo e($end_date); ?>'
        }),
        "initComplete":function(json){

        },
        columns: [
            { data: 'DT_RowIndex', name: 'id' ,render:function(data){
                    return numbertrans(data)
                }},
            { data: 'date', name: 'date' },
            { data: 'order_number', name: 'order_number' },
            { data: 'email', name: 'email' },
            { data: 'total_qty', name: 'total_qty' },
            { data: 'total_amount', name: 'total_amount' },
            { data: 'order_status', name: 'order_status' },
            { data: 'is_paid', name: 'is_paid' },

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
})(jQuery);
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/AdminReport/Resources/views/order/index.blade.php ENDPATH**/ ?>