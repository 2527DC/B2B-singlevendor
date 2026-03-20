<div class="row" id="manage_rvp_section" style="display: none;">
    <div class="col-lg-12">
        <div class="main-title">
            <h3 class="mb-30">{{ __('refund.manage_rvp') }}</h3>
        </div>

        <div class="row mb-20">
            <div class="col-lg-12">
                <ul class="nav nav-tabs no-gutters" id="rvp_tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active rvp_filter_tab" data-type="unassigned" style="cursor: pointer;">{{ __('common.unassigned') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rvp_filter_tab" data-type="assigned" style="cursor: pointer;">{{ __('common.assigned') }}</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="white-box mt-2">
            <div class="row" id="driver_selection_row">
                <div class="col-lg-2">
                    <div class="primary_input mb-25">
                        <label class="primary_input_label" for="">{{ __('common.select_driver') }}</label>
                        <select class="primary_select mb-25" name="driver_id" id="bulk_driver_id">
                            <option value="">{{ __('common.select') }}</option>
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->name }} ({{ $driver->vehicle_number }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 mt-30">
                    <button type="button" id="bulk_assign_rvp_btn" class="primary-btn fix-gr-bg">
                        <span class="ti-check"></span>
                        {{ __('common.assign_driver') }}
                    </button>
                    <button type="button" id="bulk_complete_rvp_btn" class="primary-btn fix-gr-bg" style="display: none;">
                        <span class="ti-check"></span>
                        {{ __('common.completed') }}
                    </button>
                </div>
            </div>
            <div class="QA_section QA_section_heading_custom check_box_table mt-4">
                <div class="QA_table ">
                    <table id="rvpTable" class="table Crm_table_active3">
                        <thead>
                            <tr>
                                <th>
                                    <label class="cp_check_box">
                                        <input type="checkbox" id="rvp_select_all">
                                        <span class="checkmark"></span>
                                    </label>
                                </th>
                                <th>{{ __('common.sl') }}</th>
                                <th>{{ __('common.order_id') }}</th>
                                <th>{{ __('common.total_amount') }}</th>
                                <th>{{ __('common.date') }}</th>
                                <th>{{ __('common.vehicle_no') }}</th>
                                <th>{{ __('common.delivery_status') }}</th>
                                <th>{{ __('common.refund_status') }}</th>
                                <th>{{ __('common.action') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    (function($){
        "use strict";
        
        $(document).ready(function(){
            var active_type = 'unassigned';

            var rvpTable = $('#rvpTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax": ( {
                    url: "{{ route('refund.seller_rvp_data') }}",
                    data: function (d) {
                        d.type = active_type;
                    }
                }),
                columns: [
                    { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
                    { data: 'DT_RowIndex', name: 'id' },
                    { data: 'order_id', name: 'order_id' },
                    { data: 'total_amount', name: 'total_amount' },
                    { data: 'date', name: 'date' },
                    { data: 'vehicle_number', name: 'vehicle_number' },
                    { data: 'delivery_status', name: 'delivery_status' },
                    { data: 'refund_status', name: 'refund_status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                bLengthChange: false,
                language: {
                    search: "<i class='ti-search'></i>",
                    searchPlaceholder: trans('common.quick_search'),
                    paginate: {
                        next: "<i class='ti-arrow-right'></i>",
                        previous: "<i class='ti-arrow-left'></i>"
                    }
                },
                dom: 'Bfrtip',
                buttons: [],
                responsive: true,
                bDestroy: true,
            });

            // Expandable rows logic
            $('#rvpTable tbody').on('click', 'button.expand_request', function () {
                var tr = $(this).closest('tr');
                var row = rvpTable.row(tr);
                var request_id = $(this).data('id');

                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    $.get("{{ route('refund.rvp_request_products') }}", { request_id: request_id }, function(data){
                        row.child(data).show();
                        tr.addClass('shown');
                    });
                }
            });

            $(document).on('click', '.rvp_filter_tab', function(){
                $('.rvp_filter_tab').removeClass('active');
                $(this).addClass('active');
                active_type = $(this).data('type');
                
                if(active_type == 'assigned'){
                    $('#bulk_driver_id').closest('.col-lg-2').hide();
                    $('#bulk_assign_rvp_btn').hide();
                    $('#bulk_complete_rvp_btn').show();
                }else{
                    $('#bulk_driver_id').closest('.col-lg-2').show();
                    $('#bulk_assign_rvp_btn').show();
                    $('#bulk_complete_rvp_btn').hide();
                }
                
                rvpTable.ajax.reload();
            });

            $(document).on('click', '#manage_rvp_btn', function(){
                if($('#manage_rvp_section').is(':visible')){
                    $('#manage_rvp_section').hide();
                    $('#main_refund_section').show();
                }else{
                    $('#manage_rvp_section').show();
                    $('#main_refund_section').hide();
                    rvpTable.ajax.reload();
                }
            });

            $(document).on('change', '#rvp_select_all', function(){
                $('.rvp_checkbox').prop('checked', $(this).prop('checked'));
            });

            $(document).on('click', '#bulk_assign_rvp_btn', function(){
                var ids = [];
                $('.rvp_checkbox:checked').each(function(){
                    ids.push($(this).val());
                });
                var driver_id = $('#bulk_driver_id').val();

                if(ids.length > 0 && driver_id != ""){
                    $.post("{{ route('refund.rvp_bulk_assign_driver') }}", {
                        _token: "{{ csrf_token() }}",
                        ids: ids,
                        driver_id: driver_id
                    }, function(data){
                        toastr.success(data.message);
                        rvpTable.ajax.reload();
                    }).fail(function(data){
                        toastr.error(data.responseJSON.message);
                    });
                }else{
                    toastr.error("Please select requests and a driver.");
                }
            });

            $(document).on('click', '#bulk_complete_rvp_btn', function(){
                var ids = [];
                $('.rvp_checkbox:checked').each(function(){
                    ids.push($(this).val());
                });

                if(ids.length > 0){
                    $.post("{{ route('refund.rvp_bulk_complete') }}", {
                        _token: "{{ csrf_token() }}",
                        ids: ids
                    }, function(data){
                        toastr.success(data.message);
                        rvpTable.ajax.reload();
                    }).fail(function(data){
                        toastr.error(data.responseJSON.message);
                    });
                }else{
                    toastr.error("Please select requests.");
                }
            });
        });

    })(jQuery);
</script>
@endpush
