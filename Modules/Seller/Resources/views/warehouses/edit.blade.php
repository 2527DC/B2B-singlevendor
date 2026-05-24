@extends('backEnd.master')
@section('mainContent')
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center mb-40">
            <div class="col-12">
                <div class="box_header">
                    <div class="main-title d-flex justify-content-between w-100">
                        <h3 class="mb-0 mr-30">{{__('common.edit')}} {{__('common.warehouse')}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="white_box_50px box_shadow_white">
                    <form action="{{ $is_admin ? route('admin.warehouses.update', $warehouse->id) : route('seller.warehouses.update', $warehouse->id) }}" method="POST" id="warehouse_editForm">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="main-title d-flex">
                                    <h3 class="mb-0 mr-30">{{ __('seller.basic_info') }}</h3>
                                </div>
                            </div>
                            <hr class="w-100 mb-25">
                            
                            @if($is_admin)
                                <div class="col-md-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="user_id">{{ __('common.owner') }} / {{ __('common.seller') }} <span class="text-danger">*</span></label>
                                        <select name="user_id" id="user_id" class="primary_select mb-15" required>
                                            <option value="" disabled>{{__('common.select')}} {{__('common.owner')}}</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ old('user_id', $warehouse->user_id) == $user->id ? 'selected' : '' }}>{{ $user->first_name }} ({{ $user->role->name }}) - {{ $user->email }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{$errors->first('user_id')}}</span>
                                    </div>
                                </div>
                            @endif

                            <div class="col-md-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="warehouse_name">{{ __('common.name') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="primary_input_field" placeholder="{{ __('common.name') }}" name="warehouse_name" value="{{ old('warehouse_name', $warehouse->warehouse_name) }}" required>
                                    <span class="text-danger">{{$errors->first('warehouse_name')}}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="warehouse_phone">{{ __('common.phone') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="primary_input_field" placeholder="{{ __('common.phone') }}" name="warehouse_phone" value="{{ old('warehouse_phone', $warehouse->warehouse_phone) }}" required>
                                    <span class="text-danger">{{$errors->first('warehouse_phone')}}</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="warehouse_address">{{ __('common.address') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="primary_input_field" placeholder="{{ __('common.address') }}" name="warehouse_address" value="{{ old('warehouse_address', $warehouse->warehouse_address) }}" required>
                                    <span class="text-danger">{{$errors->first('warehouse_address')}}</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="warehouse_country">{{ __('common.country') }} <span class="text-danger">*</span></label>
                                    <select name="warehouse_country" id="warehouse_country" class="primary_select mb-15" required>
                                        <option value="" disabled>Select Country</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ old('warehouse_country', $warehouse->warehouse_country) == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{$errors->first('warehouse_country')}}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="warehouse_state">{{ __('common.state') }} <span class="text-danger">*</span></label>
                                    <select name="warehouse_state" id="warehouse_state" class="primary_select mb-15" required>
                                        <option value="" disabled>Select State</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}" {{ old('warehouse_state', $warehouse->warehouse_state) == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{$errors->first('warehouse_state')}}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="warehouse_city">{{ __('common.city') }} <span class="text-danger">*</span></label>
                                    <select name="warehouse_city" id="warehouse_city" class="primary_select mb-15" required>
                                        <option value="" disabled>Select City</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}" {{ old('warehouse_city', $warehouse->warehouse_city) == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{$errors->first('warehouse_city')}}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="warehouse_postcode">{{ __('common.postcode') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="primary_input_field" placeholder="{{ __('common.postcode') }}" name="warehouse_postcode" value="{{ old('warehouse_postcode', $warehouse->warehouse_postcode) }}" required>
                                    <span class="text-danger">{{$errors->first('warehouse_postcode')}}</span>
                                </div>
                            </div>

                            <div class="col-md-12 text-center">
                                <div class="d-flex justify-content-center pt_20">
                                    <button type="submit" class="primary-btn semi_large2 fix-gr-bg" id="save_button"><i class="ti-check"></i>{{ __('common.update') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
            
            // Dynamic State loading
            $(document).on('change', '#warehouse_country', function(){
                let country = $(this).val();
                let url = '{{ url('/') }}' + '/get-state?country_id=' + country;
                
                $('#warehouse_state').empty().append('<option value="" disabled selected>Loading...</option>').niceSelect('update');
                $('#warehouse_city').empty().append('<option value="" disabled selected>Select City</option>').niceSelect('update');

                $.get(url, function(data){
                    $('#warehouse_state').empty().append('<option value="" disabled selected>Select State</option>');
                    $.each(data, function(index, stateObj){
                        $('#warehouse_state').append('<option value="'+ stateObj.id +'">'+ stateObj.name +'</option>');
                    });
                    $('#warehouse_state').niceSelect('update');
                });
            });

            // Dynamic City loading
            $(document).on('change', '#warehouse_state', function(){
                let state = $(this).val();
                let url = '{{ url('/') }}' + '/get-city?state_id=' + state;

                $('#warehouse_city').empty().append('<option value="" disabled selected>Loading...</option>').niceSelect('update');

                $.get(url, function(data){
                    $('#warehouse_city').empty().append('<option value="" disabled selected>Select City</option>');
                    $.each(data, function(index, cityObj){
                        $('#warehouse_city').append('<option value="'+ cityObj.id +'">'+ cityObj.name +'</option>');
                    });
                    $('#warehouse_city').niceSelect('update');
                });
            });
        });
    })(jQuery);
</script>
@endpush
