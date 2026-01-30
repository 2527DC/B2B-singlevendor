@extends('backEnd.master')
@section('styles')
<style>
    .fieldtable td{
        padding-left: 0px;
    }
</style>
@endsection
@section('mainContent')
@if(isModuleActive('FrontendMultiLang'))
@php
$LanguageList = getLanguageList();
@endphp
@endif
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">{{__('checkpincode.checkpincode_config')}}</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div id="formHtml" class="col-lg-12">
                        <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <form class="w-100" action="{{ route('checkpincode.update.checkpincode.system.config') }}" method="post">
                                                @csrf
                                                <table class="table fieldtable">
                                                    <thead>
                                                        <tr>
                                                            <td>{{__('setup.Field Name')}}</td>
                                                            <td>{{__('setup.Status')}}</td>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td>{{__('checkpincode.pincode_check_system_status')}}</td>
                                                            <td>
                                                                <div class="primary_input">
                                                                    <label class="switch_toggle" for="pincode_check_system_status">
                                                                        <input type="checkbox" name="pincode_check_system_status" id="pincode_check_system_status" value="1" class="pincode_check_system_status_change_checkbox" @if($checkPincodeConfig->pincode_check_system_status==1) {{'checked'}} @endif>
                                                                        <div class="slider round"></div>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{__('checkpincode.delivery_days_status')}}</td>
                                                            <td>
                                                                <div class="primary_input">
                                                                    <label class="switch_toggle" for="delivery_days_status">
                                                                        <input type="checkbox" name="delivery_days_status" id="delivery_days_status" value="1" class="delivery_days_status_change_checkbox" @if($checkPincodeConfig->delivery_days_status==1) {{'checked'}} @endif>
                                                                        <div class="slider round"></div>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <button class="primary-btn fix-gr-bg submit">Save</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection

