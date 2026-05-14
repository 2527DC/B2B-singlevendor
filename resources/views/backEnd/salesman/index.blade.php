@extends('backEnd.master')
@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('Manage Salesmen') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-20">
                    <ul class="d-flex flex-wrap gap-10">
                        <li><a data-toggle="modal" data-target="#createSalesmanModal" class="primary-btn radius_30px mr-10 fix-gr-bg"><i class="ti-plus"></i>{{ __('Add New Salesman') }}</a></li>
                        <li><a href="{{ route('seller.salesmen.download_excel') }}" class="primary-btn radius_30px mr-10 fix-gr-bg"><i class="ti-download"></i>{{ __('Download Customer Excel') }}</a></li>
                        <li><a data-toggle="modal" data-target="#uploadExcelModal" class="primary-btn radius_30px mr-10 fix-gr-bg"><i class="ti-upload"></i>{{ __('Upload Customer Mapping') }}</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <div class="">
                                <table class="table Crm_table_active3">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ __('ID') }}</th>
                                            <th scope="col">{{ __('Salesman ID') }}</th>
                                            <th scope="col">{{ __('Name') }}</th>
                                            <th scope="col">{{ __('Phone') }}</th>
                                            <th scope="col">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($salesmen as $salesman)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <td><strong>{{ $salesman->salesman_id }}</strong></td>
                                            <td>{{ $salesman->name }}</td>
                                            <td>{{ $salesman->phone_number }}</td>
                                            <td>
                                                <div class="dropdown CRM_dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu{{ $salesman->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{ __('Select') }}
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu{{ $salesman->id }}">
                                                        <a class="dropdown-item edit_salesman" 
                                                           data-id="{{ $salesman->id }}"
                                                           data-name="{{ $salesman->name }}"
                                                           data-phone="{{ $salesman->phone_number }}"
                                                           >{{__('Edit')}}</a>
                                                        <a class="dropdown-item delete_salesman" 
                                                           data-id="{{ $salesman->id }}"
                                                           >{{__('Delete')}}</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Create Salesman Modal -->
    <div class="modal fade admin-query" id="createSalesmanModal">
        <div class="modal-dialog modal_800px modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Add New Salesman') }}</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="ti-close "></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('seller.salesmen.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="name">{{ __('Name') }} <span class="text-danger">*</span></label>
                                    <input name="name" class="primary_input_field" placeholder="{{ __('Name') }}" type="text" required>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="phone_number">{{ __('Phone Number') }} <span class="text-danger">*</span></label>
                                    <input name="phone_number" class="primary_input_field" placeholder="{{ __('Phone Number') }}" type="text" required>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="primary-btn semi_large2 fix-gr-bg"><i class="ti-check"></i>{{ __('Create Salesman') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Salesman Modal -->
    <div class="modal fade admin-query" id="editSalesmanModal">
        <div class="modal-dialog modal_800px modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Edit Salesman') }}</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="ti-close "></i></button>
                </div>
                <div class="modal-body">
                    <form id="editSalesmanForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="edit_name">{{ __('Name') }} <span class="text-danger">*</span></label>
                                    <input name="name" id="edit_name" class="primary_input_field" type="text" required>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="edit_phone">{{ __('Phone Number') }} <span class="text-danger">*</span></label>
                                    <input name="phone_number" id="edit_phone" class="primary_input_field" type="text" required>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="primary-btn semi_large2 fix-gr-bg"><i class="ti-check"></i>{{ __('Update Salesman') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Excel Modal -->
    <div class="modal fade admin-query" id="uploadExcelModal">
        <div class="modal-dialog modal_800px modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Upload Customer Mapping') }}</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="ti-close "></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('seller.salesmen.upload_excel') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="file">{{ __('Excel File') }} <span class="text-danger">*</span></label>
                                    <input name="file" class="primary_input_field" type="file" accept=".xlsx,.xls,.csv" required>
                                    <small class="text-muted">{{ __('Please use the downloaded template to ensure correct column names.') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="primary-btn semi_large2 fix-gr-bg"><i class="ti-upload"></i>{{ __('Upload & Process') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('backEnd.partials.delete_modal')

@endsection

@push('scripts')
<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            $(document).on('click', '.edit_salesman', function() {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let phone = $(this).data('phone');

                $('#edit_name').val(name);
                $('#edit_phone').val(phone);
                $('#editSalesmanForm').attr('action', "{{ url('seller/salesmen') }}/" + id);
                $('#editSalesmanModal').modal('show');
            });

            $(document).on('click', '.delete_salesman', function(event){
                event.preventDefault();
                let id = $(this).data('id');
                let url = "{{ url('seller/salesmen') }}/" + id;
                confirm_modal(url);
            });
        });
    })(jQuery);
</script>
@endpush
