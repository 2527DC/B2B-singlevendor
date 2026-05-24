@extends('backEnd.master')
@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('common.warehouses')}}</h3>
                            <ul class="d-flex">
                                <li>
                                    <a class="primary-btn radius_30px mr-10 fix-gr-bg" 
                                       href="{{ $is_admin ? route('admin.warehouses.create') : route('seller.warehouses.create') }}">
                                        <i class="ti-plus"></i>{{ __('common.add_new') }} {{ __('common.warehouse') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <div class="">
                                <table class="table Crm_table_active3">
                                    <thead>
                                        <tr>
                                            <th>{{ __('common.sl') }}</th>
                                            <th>{{ __('common.name') }}</th>
                                            <th>{{ __('common.address') }}</th>
                                            <th>{{ __('common.phone') }}</th>
                                            <th>{{ __('common.country') }}</th>
                                            <th>{{ __('common.state') }}</th>
                                            <th>{{ __('common.city') }}</th>
                                            <th>{{ __('common.postcode') }}</th>
                                            <th>{{ __('common.default') }}</th>
                                            @if($is_admin)
                                                <th>{{ __('common.owner') }}</th>
                                            @endif
                                            <th>{{ __('common.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($warehouses as $key => $warehouse)
                                            <tr>
                                                <td>{{ getNumberTranslate($key+1) }}</td>
                                                <td>{{ $warehouse->warehouse_name }}</td>
                                                <td>{{ $warehouse->warehouse_address }}</td>
                                                <td>{{ getNumberTranslate($warehouse->warehouse_phone) }}</td>
                                                <td>{{ @$warehouse->country->name }}</td>
                                                <td>{{ @$warehouse->state->name }}</td>
                                                <td>{{ @$warehouse->city->name }}</td>
                                                <td>{{ getNumberTranslate($warehouse->warehouse_postcode) }}</td>
                                                <td>
                                                    @if($warehouse->is_default)
                                                        <span class="badge_1">{{ __('common.yes') }}</span>
                                                    @else
                                                        <span class="badge_4">{{ __('common.no') }}</span>
                                                    @endif
                                                </td>
                                                @if($is_admin)
                                                    <td>{{ @$warehouse->user->first_name }} ({{ @$warehouse->user->role->name }})</td>
                                                @endif
                                                <td>
                                                    <div class="dropdown CRM_dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu_{{$warehouse->id}}" data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"> {{__('common.select')}}
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu_{{$warehouse->id}}">
                                                            <a href="{{ $is_admin ? route('admin.warehouses.edit', $warehouse->id) : route('seller.warehouses.edit', $warehouse->id) }}" 
                                                               class="dropdown-item" type="button">{{ __('common.edit') }}</a>
                                                            @if(!$warehouse->is_default)
                                                                <a class="dropdown-item set_default_warehouse" 
                                                                   data-value="{{ $is_admin ? route('admin.warehouses.set_default', $warehouse->id) : route('seller.warehouses.set_default', $warehouse->id) }}">{{__('common.make_default')}}</a>
                                                            @endif
                                                            <a class="dropdown-item delete_warehouse" 
                                                               data-value="{{ $is_admin ? route('admin.warehouses.destroy', $warehouse->id) : route('seller.warehouses.destroy', $warehouse->id) }}">{{__('common.delete')}}</a>
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
@include('backEnd.partials.delete_modal')
@endsection
@push('scripts')
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                $(document).on('click', '.delete_warehouse', function(event){
                    event.preventDefault();
                    let url = $(this).data('value');
                    confirm_modal(url);
                });
                $(document).on('click', '.set_default_warehouse', function(event){
                    event.preventDefault();
                    let url = $(this).data('value');
                    var form = $('<form action="' + url + '" method="post">' +
                        '<input type="hidden" name="_token" value="{{ csrf_token() }}" />' +
                        '</form>');
                    $('body').append(form);
                    form.submit();
                });
            });
        })(jQuery);
    </script>
@endpush
