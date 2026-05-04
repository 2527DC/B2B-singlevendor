@extends('backEnd.master')

@section('mainContent')
@if(isModuleActive('FrontendMultiLang'))
@php
$LanguageList = getLanguageList();
@endphp
@endif
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <form action="{{route('checkpincode.update')}}" enctype="multipart/form-data" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{$checkPincode->id}}">
        <div class="row">
                @csrf
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"> {{__('checkpincode.edit_pincode')}} </h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="formHtml" class="col-lg-12">
                        <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="pincode">{{__('checkpincode.pincode')}} <span class="text-danger">*</span></label>
                                                <input class="primary_input_field" type="number" id="pincode" name="pincode" autocomplete="off" value="@if(isset($checkPincode) && !empty($checkPincode->pincode)){{$checkPincode->pincode}}@else{{ old('pincode') }}@endif" placeholder="{{__('checkpincode.pincode')}}">
                                                @error('pincode')
                                                    <span class="text-danger" id="error_pincode">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="city">{{__('checkpincode.city')}} <span class="text-danger">*</span></label>
                                                <input class="primary_input_field" type="text" id="city" name="city" autocomplete="off" value="@if(isset($checkPincode) && !empty($checkPincode->city)){{$checkPincode->city}}@else{{ old('city') }}@endif" placeholder="{{__('checkpincode.city')}}">
                                                @error('city')
                                                    <span class="text-danger" id="error_city">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="state">{{__('checkpincode.state')}} <span class="text-danger">*</span></label>
                                                <input class="primary_input_field" type="text" id="state" name="state" autocomplete="off" value="@if(isset($checkPincode) && !empty($checkPincode->state)){{$checkPincode->state}}@else{{ old('state') }}@endif" placeholder="{{__('checkpincode.state')}}">
                                                @error('state')
                                                    <span class="text-danger" id="error_state">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="delivery_days">{{__('checkpincode.delivery_days')}} <span class="text-danger">*</span></label>
                                                <input class="primary_input_field" type="number" id="delivery_days" name="delivery_days" autocomplete="off" value="@if(isset($checkPincode) && !empty($checkPincode->delivery_days)){{$checkPincode->delivery_days}}@else{{ old('delivery_days') }}@endif" placeholder="{{__('checkpincode.delivery_days')}}">
                                                @error('delivery_days')
                                                    <span class="text-danger" id="error_delivery_days">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                        <button id="submit_btn" type="submit" class="primary-btn fix-gr-bg" data-toggle="tooltip" title="" data-original-title=""> <span class="ti-check"></span> {{__('common.save')}} </button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
</section>
@endsection
