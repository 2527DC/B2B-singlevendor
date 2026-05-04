
@extends('backEnd.master')

@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-xl-12">
                    <div class="white_box_30px mb_30">
                        <div class="tab-content">

                                <div role="tabpanel" class="tab-pane fade active show" id="order_processing_data">
                                    <div class="box_header common_table_header ">
                                        <div class="main-title d-md-flex">
                                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('checkpincode.pincode_list') }}</h3>
                                                <ul class="d-flex">
                                                    @if(permissionCheck('checkpincode.create'))
                                                        <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="{{route("checkpincode.create")}}"><i class="ti-plus"></i>{{__('checkpincode.add_new_pincode')}}</a></li>
                                                    @endif
                                                </ul>
                                        </div>
                                    </div>
                                    <div class="QA_section QA_section_heading_custom check_box_table">
                                        <div class="QA_table">
                                            <!-- table-responsive -->
                                            <div class="" id="product_list_div">
                                                @include('checkpincode::pincode_list')
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
@include('backEnd.partials._deleteModalForAjax',['item_name' => __('checkpincode.pincode '),'form_id' =>
'pincode_delete_form','modal_id' => 'pincode_delete_modal', 'delete_item_id' => 'pincode_delete_id'])
@endsection
@push('scripts')
@php
$url = route('checkpincode.checkpincode-get-pincodes');
@endphp
<script type="text/javascript">
(function($){
        "use strict";
        let Table = '';
    $(document).ready(function(){
            let columnData = [
                { data: 'DT_RowIndex', name: 'id' },
                { data: 'pincode', name: 'pincode'},
                { data: 'city', name: 'city'},
                { data: 'state', name: 'state' },
                { data: 'delivery_days', name: 'delivery_days'},
                { data: 'created_at', name: 'created_at'},
                { data: 'action', name: 'action'}
            ]
            checkPincodeDataTable();

            function checkPincodeDataTable(){
            Table = $('#checkpincodeTable').DataTable({
                processing: true,
                serverSide: true,
                "stateSave": true,
                "ajax": $.fn.dataTable.pipeline({
                    url: '{{route('checkpincode.checkpincode-get-pincodes')}}',
                data: function () {
                    //pass variable
                },
                pages: 5 // number of pages to cache
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
                            let colCount = new Array();
                            let tbl = $('#mainProductTable');
                            $(tbl).find('tbody tr:first-child td').each(function(){
                                if($(this).attr('colspan')){
                                    for(let i=1;i<=$(this).attr('colspan');$i++){
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
    });

    $(document).on('click', '.delete_pincode', function(event){
            event.preventDefault();
            // let type = $(this).data('type');
            let id = $(this).data('id');

            $('#pincode_delete_id').val(id);
            $('#pincode_delete_modal').modal('show');

    });

    $(document).on('submit', '#pincode_delete_form', function(event) {
            event.preventDefault();
            $('#pincode_delete_modal').modal('hide');
            $('#pre-loader').removeClass('d-none');
            let formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', $('#pincode_delete_id').val());
            $.ajax({
                url: "{{ route('checkpincode.destroy') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    if(response.msg){
                        window.location.reload();
                        toastr.info(response.msg);
                    }else {
                        window.location.reload();
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


})(jQuery);
</script>
@endpush

