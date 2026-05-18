@extends('backEnd.master')
@section('styles')
<style>
    /* Ensure the table header is consistent */
    .QA_section .QA_table .table thead th {
        vertical-align: middle;
    }
    /* Standard checkbox styling */
    th.checkbox-column, td.checkbox-column {
        width: 80px !important;
        text-align: center;
        vertical-align: top !important;
    }
    #selectAll {
        cursor: pointer;
        width: 18px;
        height: 18px;
        margin-bottom: 5px;
    }
    .all_label {
        font-size: 11px;
        display: block;
        font-weight: 700;
        color: #828bb2;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    /* Search overlap fix */
    .QA_section .QA_table .dataTables_wrapper .dataTables_filter {
        margin-bottom: 25px !important;
    }
    .action_stack {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-bottom: 30px;
    }
    /* Standard badge formatting for all statuses */
    .QA_section .QA_table .table .badge,
    .QA_section .QA_table .table [class^="badge_"] {
        padding: 6px 15px !important;
        border-radius: 30px !important;
        font-size: 10px !important;
        font-weight: 600 !important;
        display: inline-block !important;
        white-space: nowrap !important;
        text-align: center !important;
        min-width: 80px !important;
    }

    .badge_violet {
        background: #F3E8FF !important;
        color: #7C3AED !important;
        border: 1px solid #DDD6FE !important;
    }
</style>
@endsection
@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">Return Request List</h3>
                        </div>
                    </div>
                    
                    <div class="white_box_30px mb_30">
                        <div class="action_stack">
                            <div class="d-flex align-items-center flex-wrap">
                                <div class="primary_input mr-10" style="min-width: 250px;">
                                    <select class="primary_select" id="bulk_status">
                                        <option value="">Select Status</option>
                                        <option value="at_warehouse">At Warehouse</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </div>
                                <button type="button" id="apply_bulk_status" class="primary-btn fix-gr-bg">Apply Status</button>
                            </div>
                        </div>

                        <div class="QA_section QA_section_heading_custom check_box_table">
                            <div class="QA_table ">
                                <table id="returnTable" class="table Crm_table_active3">
                                    <thead>
                                        <tr>
                                            <th class="checkbox-column">
                                                <input type="checkbox" id="selectAll">
                                                <span class="all_label">Select All</span>
                                            </th>
                                            <th>{{ __('common.sl') }}</th>
                                            <th width="10%">{{ __('common.date') }}</th>
                                            <th>{{ __('common.order_id') }}</th>
                                            <th>{{ __('common.shop_name') }}</th>
                                            <th>{{ __('common.total_amount') }}</th>
                                            <th>{{ __('refund.driver') }}</th>
                                            <th>{{ __('common.status') }}</th>
                                            <th>{{ __('common.action') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        (function($){
            "use strict";

            $('#returnTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax": ( {
                    url: "{{ route('refund.seller_return_request_data') }}"
                }),
                columns: [
                    { data: null, orderable: false, searchable: false, render: function(data,type,row){
                            return '<input type="checkbox" class="bulk-select" value="'+row.id+'" />';
                        }, className: 'checkbox-column'},
                    { data: 'DT_RowIndex', name: 'id',render:function(data){
                        return numbertrans(data)
                    }},
                    { data: 'date', name: 'date' },
                    { data: 'order_id', name: 'order_id' },
                    { data: 'shop_name', name: 'shop_name' },
                    { data: 'total_amount', name: 'total_amount' },
                    { data: 'driver_name', name: 'driver_name' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action' },
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
                buttons: [
                    { extend: 'copyHtml5', text: '<i class="fa fa-files-o"></i>', titleAttr: 'Copy' },
                    { extend: 'excelHtml5', text: '<i class="fa fa-file-excel-o"></i>', titleAttr: 'Excel' },
                    { extend: 'csvHtml5', text: '<i class="fa fa-file-text-o"></i>', titleAttr: 'CSV' },
                    { extend: 'pdfHtml5', text: '<i class="fa fa-file-pdf-o"></i>', titleAttr: 'PDF' },
                    { extend: 'print', text: '<i class="fa fa-print"></i>', titleAttr: 'Print' },
                    { extend: 'colvis', text: '<i class="fa fa-columns"></i>' }
                ],
                responsive: true,
            });

            $(document).on('click', '#selectAll', function(){
                var checked = $(this).is(':checked');
                $('.bulk-select').prop('checked', checked);
            });

            $(document).on('click', '#apply_bulk_status', function(){
                var status = $('#bulk_status').val();
                if(status == ''){
                    alert('Please select a status');
                    return;
                }
                var selected = [];
                $('.bulk-select:checked').each(function(){
                    selected.push($(this).val());
                });
                if(selected.length == 0){
                    alert('{{__('order.select_at_least_one')}}');
                    return;
                }

                var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('meta[name="_token"]').attr('content');
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': csrfToken } });
                $.ajax({
                    url: "{{ route('refund.seller_return_request_bulk_update_status') }}",
                    method: 'POST',
                    data: { ids: selected, status: status },
                    beforeSend: function(){
                        $('#apply_bulk_status').prop('disabled', true);
                    },
                    success: function(res){
                        toastr.success(res.message || 'Status updated successfully', 'Success');
                        $('#apply_bulk_status').prop('disabled', false);
                        $('#returnTable').DataTable().ajax.reload();
                    },
                    error: function(err){
                        var msg = 'Operation failed';
                        if(err.responseJSON && err.responseJSON.message) {
                            msg = err.responseJSON.message;
                        }
                        toastr.error(msg, 'Error');
                        $('#apply_bulk_status').prop('disabled', false);
                    }
                });
            });

        })(jQuery);
    </script>
@endpush