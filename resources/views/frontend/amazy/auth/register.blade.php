@extends('frontend.amazy.auth.layouts.app')
@push('styles')
    <style>
        .primary_bulet_checkbox .checkmark {
            top: 2px;
        }

        .term_link_set,
        .policy_link_set {
            color: var(--base_color);
        }

        /* ─── Searchable Warehouse Dropdown ─── */
        .warehouse-select-wrapper {
            position: relative;
        }
        .warehouse-trigger {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 16px;
            border: 1px solid #e5e5e5;
            border-radius: 5px;
            background: #fff;
            cursor: pointer;
            font-size: 14px;
            color: #555;
            transition: border-color .2s;
            min-height: 48px;
        }
        .warehouse-trigger:hover,
        .warehouse-trigger.open {
            border-color: var(--base_color);
        }
        .warehouse-trigger .wh-arrow {
            font-size: 12px;
            color: #aaa;
            transition: transform .25s;
        }
        .warehouse-trigger.open .wh-arrow {
            transform: rotate(180deg);
        }
        .warehouse-dropdown-panel {
            display: none;
            position: absolute;
            top: calc(100% + 4px);
            left: 0;
            right: 0;
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            box-shadow: 0 8px 24px rgba(0,0,0,.10);
            z-index: 999;
            overflow: hidden;
            animation: whFadeIn .18s ease;
        }
        @keyframes whFadeIn {
            from { opacity: 0; transform: translateY(-6px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .warehouse-dropdown-panel.show { display: block; }
        .wh-search-box {
            padding: 10px 12px;
            border-bottom: 1px solid #f0f0f0;
            background: #fafafa;
        }
        .wh-search-box input {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 7px 12px;
            font-size: 13px;
            outline: none;
            background: #fff;
            color: #444;
        }
        .wh-search-box input:focus { border-color: var(--base_color); }
        .wh-option-list {
            list-style: none;
            margin: 0;
            padding: 6px 0;
            max-height: 220px;
            overflow-y: auto;
        }
        .wh-option-list::-webkit-scrollbar { width: 5px; }
        .wh-option-list::-webkit-scrollbar-thumb { background: #ddd; border-radius: 4px; }
        .wh-option {
            padding: 10px 16px;
            cursor: pointer;
            transition: background .15s;
        }
        .wh-option:hover,
        .wh-option.selected { background: rgba(var(--base_color_rgb, 99,91,255),.08); }
        .wh-option .wh-opt-name {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #333;
        }
        .wh-option .wh-opt-addr {
            display: block;
            font-size: 12px;
            color: #888;
            margin-top: 2px;
        }
        .wh-no-result {
            padding: 14px 16px;
            font-size: 13px;
            color: #aaa;
            text-align: center;
        }
    </style>
@endpush
@section('content')
    <div class="amazy_login_area">
        <div class="amazy_login_area_left d-flex align-items-center justify-content-center">
            <div class="amazy_login_form">
                <a href="{{url('/')}}" class="logo mb_50 d-block">
                    <img src="{{showImage(app('general_setting')->logo)}}" alt="{{app('general_setting')->company_name}}"
                        title="{{app('general_setting')->company_name}}">
                </a>
                <h3 class="m-0">{{__('auth.Sign Up')}}</h3>
                <p class="support_text">{{__('auth.See your growth and get consulting support!')}}</p>

                @if (app('general_setting')->google_status)
                    <a href="{{url('/login/google')}}" class="google_logIn d-flex align-items-center justify-content-center">
                        <img src="{{url('/')}}/public/frontend/amazy/img/svg/google_icon.svg"
                            alt="{{__('auth.Sign up with Google')}}" title="{{__('auth.Sign up with Google')}}">
                        <h5 class="m-0 font_16 f_w_500">{{__('auth.Sign up with Google')}}</h5>
                    </a>
                @endif
                @if (app('general_setting')->facebook_status)
                    <a href="{{url('/login/facebook')}}" class="google_logIn d-flex align-items-center justify-content-center">
                        <img src="{{url('/')}}/public/frontend/amazy/img/svg/facebook_icon.svg"
                            alt="{{__('auth.Sign up with Facebook')}}" title="{{__('auth.Sign up with Facebook')}}">
                        <h5 class="m-0 font_16 f_w_500">{{__('auth.Sign up with Facebook')}}</h5>
                    </a>
                @endif
                @if (app('general_setting')->twitter_status)
                    <a href="{{url('/login/twitter')}}" class="google_logIn d-flex align-items-center justify-content-center">
                        <img src="{{url('/')}}/public/frontend/amazy/img/svg/twitter_icon.svg"
                            alt="{{__('auth.Sign up with Twitter')}}" title="{{__('auth.Sign up with Twitter')}}">
                        <h5 class="m-0 font_16 f_w_500">{{__('auth.Sign up with Twitter')}}</h5>
                    </a>
                @endif
                @if (app('general_setting')->linkedin_status)
                    <a href="{{url('/login/linkedin')}}" class="google_logIn d-flex align-items-center justify-content-center">
                        <img src="{{url('/')}}/public/frontend/amazy/img/svg/linkedin_icon.svg"
                            alt="{{__('auth.Sign up with LinkedIn')}}" title="{{__('auth.Sign up with LinkedIn')}}">
                        <h5 class="m-0 font_16 f_w_500">{{__('auth.Sign up with LinkedIn')}}</h5>
                    </a>
                @endif

                <div class="form_sep2 d-flex align-items-center">
                    <span class="sep_line flex-fill"></span>
                    <span class="form_sep_text font_14 f_w_500 ">{{__('auth.Sign up with Email or Phone')}}</span>
                    <span class="sep_line flex-fill"></span>
                </div>
                <form action="{{ route('register') }}" method="POST" name="register" id="register_form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        @if(!empty($row) && !empty($form_data))
                            @php
                                $default_field = [];
                                $custom_field = [];
                            @endphp

                            @foreach($form_data as $row)
                                @php
                                    if ($row->type != 'header' && $row->type != 'paragraph') {
                                        if (property_exists($row, 'className') && strpos($row->className, 'default-field') !== false) {
                                            $default_field[] = $row->name;
                                        } else {
                                            $custom_field[] = $row->name;
                                        }
                                        $required = property_exists($row, 'required');
                                        $type = property_exists($row, 'subtype') ? $row->subtype : $row->type;
                                        $placeholder = property_exists($row, 'placeholder') ? $row->placeholder : trans('formBuilder.' . $row->label);
                                    }
                                @endphp

                                @if($row->type == 'header' || $row->type == 'paragraph')
                                    <div class="col-lg-12">
                                        <{{ $row->subtype }}>{{trans('formBuilder.' . $row->label)}}</{{ $row->subtype }}>
                                    </div>
                                @elseif($row->type == 'text' || $row->type == 'number' || $row->type == 'email' || $row->type == 'date')
                                    <div class="col-12 mb_20">
                                        <label for="{{$row->name}}" class="primary_label2"> {{trans('formBuilder.' . $row->label)}}
                                            @if($required) <span class="text-danger">*</span> @endif</label>
                                        <input {{$required ? 'required' : ''}} type="{{$type}}" id="{{$row->name}}"
                                            class="primary_input3 radius_5px @error($row->name) is-invalid @enderror"
                                            name="{{$row->name}}" value="{{ old($row->name) }}"
                                            placeholder="{{trans('formBuilder.' . $row->label)}}">
                                        @error($row->name)
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @elseif($row->type == 'select')
                                    <div class="col-xl-12 mb_25">
                                        <div class="form-group input_div_mb">
                                            <label class="primary_label2 style4"
                                                for={{$row->name}}>{{trans('formBuilder.' . $row->label)}}@if($required) <span
                                                class="text-danger">*</span> @endif</label>
                                            <select {{$required ? 'required' : ''}} name="{{$row->name}}" id="{{$row->name}}"
                                                class=" theme_select style2 wide">
                                                @foreach($row->values as $value)
                                                    <option value="{{$value->value}}" {{old($row->name) == $value->value ? 'selected' : ''}}>
                                                        {{$value->label}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{$errors->first($row->name)}}</span>
                                        </div>
                                    </div>

                                @elseif($row->type == 'date')
                                    <div class="col-12 mb_30">
                                        <label for="start_datepicker" class="primary_label2 style2 ">
                                            {{trans('formBuilder.' . $row->label)}} @if($required) <span class="text-danger">*</span>
                                            @endif</label>
                                        <input {{$required ? 'required' : ''}} type="{{$type}}" id="start_datepicker"
                                            class="primary_input3 style4 mb-0 @error($row->name) is-invalid @enderror"
                                            name="{{$row->name}}" value="{{ old($row->name) }}"
                                            placeholder="{{trans('formBuilder.' . $row->label)}}">
                                        @error($row->name)
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                @elseif($row->type == 'textarea')
                                    <div class="col-md-12 mb-10">
                                        <label for={{$row->name}}>{{trans('formBuilder.' . $row->label)}}@if($required) <span
                                        class="text-danger">*</span> @endif</label>
                                        <textarea class="form-control" {{$required ? 'required' : ''}} name="{{$row->name}}"
                                            id="{{$row->name}}"
                                            placeholder="{{trans('formBuilder.' . $row->label)}}">{{old($row->name)}}</textarea>
                                        <span class="text-danger">{{$errors->first($row->name)}}</span>
                                    </div>

                                @elseif($row->type == "radio-group")
                                    <div class="col-lg-12 mb_20">
                                        <label for="">{{trans('formBuilder.' . $row->label)}}</label>
                                        <div class="d-flex radio-btn-flex">
                                            @foreach($row->values as $value)
                                                <label class="primary_bulet_checkbox">
                                                    <input type="radio" name="{{ $row->name }}" class="payment_method"
                                                        value="{{ $value->value }}">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <a class="ml_10 mr_10 text_color">{{ $value->label }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                @elseif($row->type == "checkbox-group")
                                    <div class="col-12 mb_25">
                                        <label>{{trans('formBuilder.' . $row->label)}}</label>
                                        @foreach($row->values as $value)
                                            <label class="primary_checkbox d-flex">
                                                <input value="{{ $value->value }}" id="term_check" name="{{ $row->name }}[]" checked
                                                    type="checkbox">
                                                <span class="checkmark mr_15"></span>
                                                <span class="label_name f_w_400 ">{{$value->label}}</span>
                                                <span id="error_term_check" class="text-danger"></span>
                                            </label>
                                        @endforeach
                                    </div>

                                @elseif($row->type == 'file')
                                    <div class="col-lg-12 mb_20">
                                        <label for="{{$row->name}}"
                                            class="primary_label2 style3">{{trans('formBuilder.' . $row->label)}}@if($required) <span
                                            class="text-danger">*</span> @endif</label>
                                        <input type="{{$type}}" accept="image/*" class="primary_input3 style4 radius_3px pd_12"
                                            name="{{$row->name}}" id="{{$row->name}}">
                                    </div>
                                @elseif($row->type == 'checkbox')
                                    <div class="col-md-12 mb_20 mt_10">
                                        <label class="primary_checkbox d-flex">
                                            <input id="policyCheck" type="checkbox" checked>
                                            <span class="checkmark mr_15"></span>
                                            <span class="label_name f_w_400 ">{!! $row->label !!}</span>
                                        </label>
                                    </div>
                                @endif

                            @endforeach

                        @else
                                            <div class="col-12 mb_20">
                                                <label class="primary_label2">{{__('formBuilder.first_name')}} <span>*</span> </label>
                                                <input name="first_name" id="first_name" value="{{ old('first_name') }}"
                                                    placeholder="{{ __('formBuilder.first_name') }}" onfocus="this.placeholder = ''"
                                                    onblur="this.placeholder = '{{ __('common.first_name') }}'"
                                                    class="primary_input3 radius_5px" type="text">
                                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                            </div>
                                            <div class="col-12 mb_20">
                                                <label class="primary_label2">{{__('formBuilder.last_name')}}</label>
                                                <input name="last_name" id="last_name" value="{{ old('last_name') }}"
                                                    placeholder="{{ __('formBuilder.last_name') }}" onfocus="this.placeholder = ''"
                                                    onblur="this.placeholder = '{{ __('common.last_name') }}'" class="primary_input3 radius_5px"
                                                    type="text">
                                                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                            </div>

                                            <div class="col-12 mb_20">
                                                <label class="primary_label2">Store Name <span>*</span></label>
                                                <input name="store_name" value="{{ old('store_name') }}" class="primary_input3 radius_5px"
                                                    type="text" required>
                                                <span class="text-danger">{{ $errors->first('store_name') }}</span>
                                            </div>

                                            <!-- Store Image Upload -->
                                            <div class="col-12 mb_20">
                                                <label class="primary_label2">
                                                    Shop Image <span>*</span>
                                                    <small class="text-muted">(PNG, JPG, JPEG)</small>
                                                </label>

                                                <input type="file" name="store_image" class="primary_input3 radius_5px" accept=".jpg,.jpeg,.png"
                                                    required>

                                                <span class="text-danger">{{ $errors->first('store_image') }}</span>
                                            </div>

                                            <!-- <div class="col-12 mb_20">
                                <label class="primary_label2">Document Type <span>*</span></label>
                                <select name="document_type" class="primary_input3 radius_5px" required>
                                    <option value="">Select Document</option>
                                    <option value="GST" {{ old('document_type') == 'GST' ? 'selected' : '' }}>GST</option>
                                    <option value="MSME" {{ old('document_type') == 'MSME' ? 'selected' : '' }}>MSME</option>
                                </select>
                                <span class="text-danger">{{ $errors->first('document_type') }}</span>
                            </div> -->
                                            <!-- 
                            <div class="col-12 mb_20">
                                <label class="primary_label2">Upload Document <span>*</span></label>
                                <input type="file" name="document" class="primary_input3 radius_5px" accept=".jpg,.jpeg,.png,.pdf" required>
                                <span class="text-danger">{{ $errors->first('document') }}</span>
                            </div> -->
                                            <div class="col-12 mb_20">
                                                <label class="primary_label2">
                                                    Upload Document <span>*</span>
                                                    <small class="text-muted">
                                                        (GST, MSME, Store Documents, Company PAN)
                                                    </small>
                                                </label>

                                                <input type="file" name="document" class="primary_input3 radius_5px"
                                                    accept=".jpg,.jpeg,.png,.pdf" required>

                                                <span class="text-danger">{{ $errors->first('document') }}</span>
                                            </div>


                                            @if(isModuleActive('Otp') && otp_configuration('otp_activation_for_customer') || app('business_settings')->where('type', 'email_verification')->first()->status == 0)
                                                <div class="col-12 mb_20">
                                                    <label class="primary_label2">{{__('formBuilder.phone')}} <span>*</span></label>
                                                    <input name="email" id="email" value="{{ old('email') }}"
                                                        placeholder="{{ __('formBuilder.phone') }}" onfocus="this.placeholder = ''"
                                                        onblur="this.placeholder = '{{ __('common.email_or_phone') }}'"
                                                        class="primary_input3 radius_5px" type="text">
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                </div>
                                            @else
                                                <div class="col-12 mb_20">
                                                    <!-- <label class="primary_label2">{{__('formBuilder.email')}} <span>*</span></label> -->
                                                    <label class="primary_label2">{{ __('Email') }} <span>*</span></label>

                                                    <input name="email" id="email" value="{{ old('email') }}"
                                                        placeholder="{{ __('formBuilder.email') }}" onfocus="this.placeholder = ''"
                                                        onblur="this.placeholder = '{{ __('common.email') }}'" class="primary_input3 radius_5px"
                                                        type="text">
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                </div>
                                            @endif
                                            <div class="col-12 mb_20">
                                                <label for="referral_code"
                                                    class="primary_label2">{{__('formBuilder.referral_code_(optional)')}}</label>
                                                <input name="referral_code" id="referral_code" value="{{ old('referral_code') }}"
                                                    placeholder="{{ __('formBuilder.referral_code') }}" onfocus="this.placeholder = ''"
                                                    onblur="this.placeholder = '{{ __('common.referral_code') }}'"
                                                    class="primary_input3 radius_5px" type="text">
                                                <span class="text-danger">{{ $errors->first('referral_code') }}</span>
                                            </div>
                                            <div class="col-12 mb_20">
                                                <label class="primary_label2">{{ __('formBuilder.password') }} <span>*</span></label>
                                                <input name="password" id="password" placeholder="{{__('amazy.Min. 8 Character')}}"
                                                    onfocus="this.placeholder = ''"
                                                    onblur="this.placeholder = '{{__('amazy.Min. 8 Character')}}'"
                                                    class="primary_input3 radius_5px" type="password">
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            </div>
                                            <div class="col-12 mb_20">
                                                <label class="primary_label2" for="password-confirm">{{ __('formBuilder.confirm_password') }}
                                                    <span>*</span></label>
                                                <input name="password_confirmation" id="password-confirm"
                                                    placeholder="{{__('amazy.Min. 8 Character')}}" onfocus="this.placeholder = ''"
                                                    onblur="this.placeholder = '{{__('amazy.Min. 8 Character')}}'"
                                                    class="primary_input3 radius_5px" type="password">
                                            </div>
                                            <div class="col-12 mb_20">
                                                <label class="primary_label2">GST Number (Optional)</label>
                                                <input name="gst_number" id="gst_number" value="{{ old('gst_number') }}"
                                                    placeholder="Enter GST Number" onfocus="this.placeholder = ''"
                                                    onblur="this.placeholder = 'Enter GST Number'"
                                                    class="primary_input3 radius_5px" type="text">
                                                <span class="text-danger">{{ $errors->first('gst_number') }}</span>
                                            </div>

                                            <!-- ── Warehouse Selection ── -->
                                            <div class="col-12 mb_20">
                                                <label class="primary_label2" for="warehouseTrigger">Select Warehouse <span>*</span></label>
                                                <div class="warehouse-select-wrapper" id="warehouseSelectWrapper">
                                                    <div class="warehouse-trigger" id="warehouseTrigger" tabindex="0">
                                                        <span id="warehouseSelectedText" style="color:#aaa">-- Search &amp; Select Warehouse --</span>
                                                        <span class="wh-arrow">&#9660;</span>
                                                    </div>
                                                    <input type="hidden" name="warehouse_id" id="warehouse_id" value="{{ old('warehouse_id') }}">
                                            <div class="warehouse-dropdown-panel" id="warehouseDropdownPanel">
                                                        <div class="wh-search-box">
                                                            <input type="text" id="warehouseSearch" placeholder="Search by name or address..." autocomplete="off">
                                                        </div>
                                                        <ul class="wh-option-list" id="warehouseOptionList">
                                                            @forelse($warehouses as $wh)
                                                                <li class="wh-option {{ old('warehouse_id') == $wh->id ? 'selected' : '' }}"
                                                                    data-id="{{ $wh->id }}"
                                                                    data-name="{{ $wh->warehouse_name }}"
                                                                    data-addr="{{ $wh->warehouse_address }}">
                                                                    <span class="wh-opt-name">{{ $wh->warehouse_name }}</span>
                                                                    <span class="wh-opt-addr">{{ $wh->warehouse_address }}</span>
                                                                </li>
                                                            @empty
                                                                <li class="wh-no-result">No warehouses available.</li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>
                                                <span class="text-danger">{{ $errors->first('warehouse_id') }}</span>
                                            </div>

                        @endif

                        @if(env('NOCAPTCHA_FOR_REG') == "true")
                            <div class="col-12 mb_20">
                                @if(env('NOCAPTCHA_INVISIBLE') != "true")
                                    <div class="g-recaptcha" data-callback="callback" data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}">
                                    </div>
                                @endif
                                <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                            </div>
                        @endif
                        <div class="col-12">
                            @if(env('NOCAPTCHA_INVISIBLE') == "true")
                                <button type="button"
                                    class="g-recaptcha amaz_primary_btn style2 radius_5px  w-100 text-uppercase  text-center mb_25"
                                    data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}" data-size="invisible"
                                    data-callback="onSubmit">{{__('auth.Sign Up')}}</button>
                            @else
                                <button class="amaz_primary_btn style2 radius_5px  w-100 text-uppercase  text-center mb_25"
                                    id="sign_in_btn">{{__('auth.Sign Up')}}</button>
                            @endif
                        </div>
                        <div class="col-lg-12 mb_20 mt_10">
                            <label class="primary_checkbox d-flex">
                                <input id="policyCheck" type="checkbox">
                                <span class="checkmark mr_15"></span>
                                <p class="label_name f_w_400"> {{__('formBuilder.By signing up, you agree to ')}} <a
                                        href="/privacy-policy-terms-and-conditions">{{__('formBuilder.Terms of Service ')}}</a>
                                    {{ __('formBuilder.and') }} <a
                                        href="/privacy-policy-terms-and-conditions">{{__('formBuilder.Privacy Policy')}}</a>
                                </p>
                            </label>
                        </div>
                        <div class="col-12">
                            <p class="sign_up_text">{{__('auth.Already have an Account?')}} <a
                                    href="{{url('/login')}}">{{__('auth.Sign In')}}</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="amazy_login_area_right d-flex align-items-center justify-content-center">
            <div class="amazy_login_area_right_inner d-flex align-items-center justify-content-center flex-column">
                <div class="thumb">
                    <img class="img-fluid" src="{{ showImage($loginPageInfo->cover_img) }}"
                        alt="{{ isset($loginPageInfo->title) ? $loginPageInfo->title : '' }}"
                        title="{{ isset($loginPageInfo->title) ? $loginPageInfo->title : '' }}">
                </div>
                <div class="login_text d-flex align-items-center justify-content-center flex-column text-center">
                    <h4>{{ isset($loginPageInfo->title) ? $loginPageInfo->title : '' }}</h4>
                    <p class="m-0">{{ isset($loginPageInfo->sub_title) ? $loginPageInfo->sub_title : '' }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function onSubmit(token) {
            document.getElementById("register_form").submit();
        }
    </script>
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                $(document).on('submit', '#register_form', function (event) {
                    if ($("#policyCheck").prop('checked') != true) {
                        event.preventDefault();
                        toastr.error("{{__('common.please_agree_with_our_policy_privacy')}}", "{{__('common.error')}}");
                        return false;
                    }
                });
            });
        })(jQuery);
    </script>

    {{-- ─── Warehouse Searchable Dropdown JS ─── --}}
    <script>
        (function () {
            const trigger      = document.getElementById('warehouseTrigger');
            const panel        = document.getElementById('warehouseDropdownPanel');
            const searchInput  = document.getElementById('warehouseSearch');
            const optionList   = document.getElementById('warehouseOptionList');
            const hiddenInput  = document.getElementById('warehouse_id');
            const selectedText = document.getElementById('warehouseSelectedText');

            if (!trigger) return;

            // Restore previously selected label on page load (validation fail)
            const oldId = hiddenInput.value;
            if (oldId) {
                const preSelected = optionList.querySelector(`.wh-option[data-id="${oldId}"]`);
                if (preSelected) {
                    selectedText.textContent = preSelected.dataset.name;
                    selectedText.style.color = '#333';
                }
            }

            // Toggle panel
            trigger.addEventListener('click', function (e) {
                e.stopPropagation();
                const isOpen = panel.classList.toggle('show');
                trigger.classList.toggle('open', isOpen);
                if (isOpen) {
                    searchInput.value = '';
                    filterOptions('');
                    setTimeout(() => searchInput.focus(), 50);
                }
            });

            // Close on outside click
            document.addEventListener('click', function (e) {
                if (!trigger.closest('#warehouseSelectWrapper').contains(e.target)) {
                    panel.classList.remove('show');
                    trigger.classList.remove('open');
                }
            });

            // Search filter
            searchInput.addEventListener('input', function () {
                filterOptions(this.value.toLowerCase().trim());
            });

            function filterOptions(query) {
                const items   = optionList.querySelectorAll('.wh-option');
                let   visible = 0;
                items.forEach(function (item) {
                    const name = (item.dataset.name || '').toLowerCase();
                    const addr = (item.dataset.addr || '').toLowerCase();
                    const match = !query || name.includes(query) || addr.includes(query);
                    item.style.display = match ? '' : 'none';
                    if (match) visible++;
                });
                // Show/hide no-result message
                let noResult = optionList.querySelector('.wh-no-result-dynamic');
                if (!visible) {
                    if (!noResult) {
                        noResult = document.createElement('li');
                        noResult.className = 'wh-no-result wh-no-result-dynamic';
                        noResult.textContent = 'No results found.';
                        optionList.appendChild(noResult);
                    }
                    noResult.style.display = '';
                } else if (noResult) {
                    noResult.style.display = 'none';
                }
            }

            // Select option
            optionList.addEventListener('click', function (e) {
                const item = e.target.closest('.wh-option');
                if (!item) return;
                // Deselect others
                optionList.querySelectorAll('.wh-option').forEach(o => o.classList.remove('selected'));
                item.classList.add('selected');
                hiddenInput.value     = item.dataset.id;
                selectedText.textContent = item.dataset.name;
                selectedText.style.color = '#333';
                panel.classList.remove('show');
                trigger.classList.remove('open');
            });

            // Keyboard support
            trigger.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    trigger.click();
                }
            });
        })();
    </script>
@endpush