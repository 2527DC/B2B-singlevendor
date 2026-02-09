@extends('backEnd.master')
@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('Manage Drivers') }}</h3>
                            <ul class="d-flex">
                                <li><a data-toggle="modal" data-target="#createDriverModal" class="primary-btn radius_30px mr-10 fix-gr-bg"><i class="ti-plus"></i>{{ __('Add New Driver') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                                <table class="table Crm_table_active3">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ __('ID') }}</th>
                                            <th scope="col">{{ __('Name') }}</th>
                                            <th scope="col">{{ __('Phone') }}</th>
                                            <th scope="col">{{ __('Status') }}</th>
                                            <th scope="col">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($drivers as $driver)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <td>{{ $driver->name }}</td>
                                            <td>{{ $driver->phone }}</td>
                                            <td>
                                                @php
                                                    $isActive = isset($driver->is_active) && (int)$driver->is_active === 1;
                                                @endphp
                                                <span class="badge_1 {{ $isActive ? 'active' : 'inactive' }}">
                                                    {{ $isActive ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <!-- shortby  -->
                                                <div class="dropdown CRM_dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{ __('Select') }}
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                        aria-labelledby="dropdownMenu2">
                                                        <a class="dropdown-item edit_driver"
                                                            data-driver-id="{{ $driver->id }}"
                                                            data-driver-name="{{ $driver->name }}"
                                                            data-driver-phone="{{ $driver->phone }}"
                                                            data-driver-is-active="{{ isset($driver->is_active) ? (int)$driver->is_active : 1 }}"
                                                            >{{__('Edit')}}</a>
                                                        
                                                        <a class="dropdown-item reset_password"
                                                            data-driver-id="{{ $driver->id }}"
                                                            data-driver-name="{{ $driver->name }}"
                                                            >{{__('Reset Password')}}</a>

                                                        <a class="dropdown-item delete_driver" 
                                                           data-id="{{ $driver->id }}"
                                                           >{{__('Delete')}}</a>
                                                    </div>
                                                </div>
                                                <!-- shortby  -->
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

    <!-- Create Driver Modal -->
    <div class="modal fade admin-query" id="createDriverModal">
        <div class="modal-dialog modal_800px modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Add New Driver') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ti-close "></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('drivers.store') }}" method="POST" id="createDriverForm">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="name">{{ __('Name') }} <span class="text-danger">*</span></label>
                                    <input name="name" class="primary_input_field name" id="name" placeholder="{{ __('Name') }}" type="text" required>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="phone">{{ __('Phone') }} <span class="text-danger">*</span></label>
                                    <input name="phone" class="primary_input_field name" id="phone" placeholder="{{ __('Phone') }}" type="tel" required>
                                </div>
                            </div>
                             <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="password">{{ __('Password') }} <span class="text-danger">*</span></label>
                                    <input name="password" class="primary_input_field name" id="password" placeholder="{{ __('Password') }}" type="password" required>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                   <label class="primary_checkbox d-flex mr-12">
                                        <input type="checkbox" name="is_active" value="1" checked>
                                        <span class="checkmark"></span>
                                        <span class="ml-2">{{ __('Active Driver') }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <div class="d-flex justify-content-center pt_20">
                                    <button type="submit" class="primary-btn semi_large2 fix-gr-bg">
                                        <i class="ti-check"></i>{{ __('Create Driver') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Driver Modal -->
    <div class="modal fade admin-query" id="editDriverModal">
        <div class="modal-dialog modal_800px modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Edit Driver') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ti-close "></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editDriverForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_driver_id" name="driver_id">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="edit_name">{{ __('Name') }} <span class="text-danger">*</span></label>
                                    <input name="name" class="primary_input_field name" id="edit_name" placeholder="{{ __('Name') }}" type="text" required>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="edit_phone">{{ __('Phone') }} <span class="text-danger">*</span></label>
                                    <input name="phone" class="primary_input_field name" id="edit_phone" placeholder="{{ __('Phone') }}" type="tel" required>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                   <label class="primary_checkbox d-flex mr-12">
                                        <input type="checkbox" id="edit_is_active" name="is_active" value="1">
                                        <span class="checkmark"></span>
                                        <span class="ml-2">{{ __('Active Driver') }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <div class="d-flex justify-content-center pt_20">
                                    <button type="submit" class="primary-btn semi_large2 fix-gr-bg">
                                        <i class="ti-check"></i>{{ __('Update Driver') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Reset Password Modal -->
    <div class="modal fade admin-query" id="resetPasswordModal">
        <div class="modal-dialog modal_800px modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Reset Password') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ti-close "></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="resetPasswordForm" method="POST">
                        @csrf
                        <input type="hidden" id="reset_driver_id" name="driver_id">
                        <p>{{ __('Reset password for driver:') }} <strong id="driverName"></strong></p>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="new_password">{{ __('New Password') }} <span class="text-danger">*</span></label>
                                    <input name="new_password" class="primary_input_field name" id="new_password" placeholder="{{ __('New Password') }}" type="password" required>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="confirm_password">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                                    <input name="new_password_confirmation" class="primary_input_field name" id="confirm_password" placeholder="{{ __('Confirm Password') }}" type="password" required>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <div class="d-flex justify-content-center pt_20">
                                    <button type="submit" class="primary-btn semi_large2 fix-gr-bg">
                                        <i class="ti-check"></i>{{ __('Reset Password') }}
                                    </button>
                                </div>
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
            // Edit Driver Modal
            $(document).on('click', '.edit_driver', function() {
                let driverId = $(this).data('driver-id');
                let driverName = $(this).data('driver-name');
                let driverPhone = $(this).data('driver-phone');
                let isActive = $(this).data('driver-is-active');

                $('#editDriverModal').modal('show');
                $('#edit_driver_id').val(driverId);
                $('#edit_name').val(driverName);
                $('#edit_phone').val(driverPhone);
                
                if (isActive == 1) {
                    $('#edit_is_active').prop('checked', true);
                } else {
                    $('#edit_is_active').prop('checked', false);
                }

                
                let form = $('#editDriverForm');
                // The route in web.php is drivers.update (PUT /drivers/{id})
                // We construct the URL manually or use a JS variable for base URL if available
                let url = "{{ url('drivers') }}" + "/" + driverId;
                form.attr('action', url);
            });

            // Reset Password Modal
            $(document).on('click', '.reset_password', function() {
                let driverId = $(this).data('driver-id');
                let driverName = $(this).data('driver-name');

                $('#resetPasswordModal').modal('show');
                $('#reset_driver_id').val(driverId);
                $('#driverName').text(driverName);

                let form = $('#resetPasswordForm');
                let url = "{{ url('drivers') }}" + "/" + driverId + "/reset-password";
                form.attr('action', url);
            });

             // Delete Driver needs special handling for delete_modal
             // The delete_modal partial likely expects a function `confirm_modal(url)`
            $(document).on('click', '.delete_driver', function(event){
                event.preventDefault();
                let id = $(this).data('id');
                let url = "{{ url('drivers') }}" + "/" + id;
                confirm_modal(url);
            });
        });
    })(jQuery);
</script>
@endpush