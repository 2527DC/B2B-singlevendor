<div class="white_box_50px box_shadow_white mb-40 min-height-430">
    <div class="main-title d-flex justify-content-between w-100">
        <h3 class="mb-0 mr-30">{{__('common.list')}}</h3>
    </div>
    <div class="pt-20">
        @if($header->type == 'slider')
            <div id="sliderDiv">
                @foreach($header->sliderSectionItems() as $item)
                    <div class="single_item" data-id="{{$item->id}}" style="background: #f1f1f1; margin-bottom: 10px; padding: 10px; border-radius: 5px;">
                        <div class="item_summary d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="mr-10">
                                    <i class="ti-menu handle cursor-move" style="font-size: 20px;"></i>
                                </div>
                                <div class="img_square_50 mr-10" style="width: 50px; height: 50px; overflow: hidden; border-radius: 5px;">
                                    <img src="{{showImage($item->slider_image)}}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div>
                                    <h5 class="mb-0">
                                        @if(isModuleActive('FrontendMultiLang') && method_exists($item, 'getTranslation') && $item->isTranslatableAttribute('name'))
                                            {{ $item->getTranslation('name', auth()->user()->lang_code) }}
                                        @else
                                            {{ $item->name }}
                                        @endif
                                    </h5>
                                    <p class="mb-0">{{__('appearance.slider_for')}}: {{ucfirst($item->data_type)}}</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <a class="primary-btn icon-only fix-gr-bg mr-5 edit_btn" data-toggle="collapse" href="#edit_form_{{$item->id}}">
                                    <i class="ti-pencil"></i>
                                </a>
                                <a class="primary-btn icon-only fix-gr-bg slider_delete_btn" data-id="{{$item->id}}">
                                    <i class="ti-trash"></i>
                                </a>
                            </div>
                        </div>
                        <div class="collapse mt-10" id="edit_form_{{$item->id}}">
                            <form id="element_edit_form" class="mt-20">
                                <input type="hidden" name="id" class="element_id" value="{{$item->id}}">
                                <input type="hidden" name="header_id" value="{{$header->id}}">
                                <input type="hidden" name="header_type" value="{{$header->type}}">
                                
                                @if(isModuleActive('FrontendMultiLang'))
                                    @php $LanguageList = getLanguageList(); @endphp
                                    <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                        @foreach ($LanguageList as $key => $language)
                                            <li class="nav-item">
                                                <a class="nav-link anchore_color @if (auth()->user()->lang_code == $language->code) active @endif" href="#edit_element_{{$item->id}}{{$language->code}}" role="tab" data-toggle="tab">{{ $language->native }} </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content">
                                        @foreach ($LanguageList as $key => $language)
                                            <div role="tabpanel" class="tab-pane fade @if (auth()->user()->lang_code == $language->code) show active @endif" id="edit_element_{{$item->id}}{{$language->code}}">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label">{{__('common.name')}} <span class="text-danger">*</span></label>
                                                    <input class="primary_input_field" type="text" name="name[{{$language->code}}]" value="{{ (method_exists($item, 'getTranslation') && $item->isTranslatableAttribute('name')) ? $item->getTranslation('name', $language->code) : $item->name}}" placeholder="{{__('common.name')}}">
                                                    <span class="text-danger" id="edit_error_name_{{$language->code}}{{$item->id}}"></span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label">{{__('common.name')}} <span class="text-danger">*</span></label>
                                        <input class="primary_input_field" type="text" name="name" value="{{$item->name}}" placeholder="{{__('common.name')}}">
                                        <span class="text-danger" id="edit_error_name{{$item->id}}"></span>
                                    </div>
                                @endif
                                
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label">{{ __('appearance.slider_for') }}</label>
                                    <select name="data_type" class="primary_select mb-15 element_list_data_type edit_slider_drop" data-id="#edit_slider_for_data_div_{{$item->id}}">
                                        <option value="product" {{$item->data_type == 'product'?'selected':''}}>{{ __('appearance.for_product') }}</option>
                                        <option value="category" {{$item->data_type == 'category'?'selected':''}}>{{ __('appearance.for_category') }}</option>
                                        <option value="brand" {{$item->data_type == 'brand'?'selected':''}}>{{ __('appearance.for_brand') }}</option>
                                        <option value="tag" {{$item->data_type == 'tag'?'selected':''}}>{{ __('appearance.for_tag') }}</option>
                                        <option value="url" {{$item->data_type == 'url'?'selected':''}}>{{ __('appearance.for_url_not_support_in_mobile_app') }}</option>
                                    </select>
                                </div>
                                <div id="edit_slider_for_data_div_{{$item->id}}">
                                    @if($item->data_type == 'product')
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label">{{ __('product.product_list') }}</label>
                                            <select name="data_id" class="product mb-15">
                                                @if($item->product)
                                                    <option value="{{$item->product->id}}" selected>{{$item->product->product->product_name }} @if(isModuleActive('MultiVendor')) [@if($item->product->seller->role->type == 'seller') {{$item->product->seller->first_name}} @else Inhouse @endif] @endif</option>
                                                @endif
                                            </select>
                                        </div>
                                    @elseif($item->data_type == 'category')
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label">{{ __('product.category_list') }}</label>
                                            <select name="data_id" class="category mb-15">
                                                @if($item->category)
                                                    <option value="{{$item->category->id}}" selected>{{$item->category->name}}</option>
                                                @endif
                                            </select>
                                        </div>
                                    @elseif($item->data_type == 'brand')
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label">{{ __('product.brand_list') }}</label>
                                            <select name="data_id" class="slider_brand mb-15">
                                                @if($item->brand)
                                                    <option value="{{$item->brand->id}}" selected>{{$item->brand->name}}</option>
                                                @endif
                                            </select>
                                        </div>
                                    @elseif($item->data_type == 'tag')
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label">{{ __('common.tag') }} {{__('common.list')}}</label>
                                            <select name="data_id" class="slider_tag mb-15">
                                                @if($item->tag)
                                                    <option value="{{$item->tag->id}}" selected>{{$item->tag->name}}</option>
                                                @endif
                                            </select>
                                        </div>
                                    @elseif($item->data_type == 'url')
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label" for="url">{{__('setup.url')}} <span class="text-danger">*</span></label>
                                            <input class="primary_input_field" type="text" name="data_id" value="{{$item->url}}" placeholder="{{__('setup.url')}}">
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="primary_input mb-25">
                                    <div class="primary_file_uploader" data-toggle="amazuploader" data-multiple="false" data-type="image" data-name="slider_image_media">
                                        <input class="primary-input file_amount" type="text" placeholder="{{__('common.choose_images')}}" readonly="">
                                        <button class="" type="button">
                                            <label class="primary-btn small fix-gr-bg">{{__('product.Browse') }} </label>
                                            <input type="hidden" class="selected_files" value="{{@$item->slider_image_media->media_id}}">
                                        </button>
                                        <div class="product_image_all_div"></div>
                                    </div>
                                    <span class="text-danger" id="edit_error_image{{$item->id}}"></span>
                                </div>

                                <div class="primary_input mb-25">
                                    <label class="primary_input_label">{{ __('common.status') }}</label>
                                    <ul class="permission_list sms_list">
                                        <li>
                                            <label class="primary_checkbox d-flex mr-12">
                                                <input name="status" value="1" {{$item->status == 1?'checked':''}} type="radio">
                                                <span class="checkmark"></span>
                                            </label>
                                            <p>{{ __('common.active') }}</p>
                                        </li>
                                        <li>
                                            <label class="primary_checkbox d-flex mr-12">
                                                <input name="status" value="0" {{$item->status == 0?'checked':''}} type="radio">
                                                <span class="checkmark"></span>
                                            </label>
                                            <p>{{ __('common.inactive') }}</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="primary_input mb-25">
                                    <label class="primary_checkbox d-flex mr-12">
                                        <input name="is_newtab" value="1" {{$item->is_newtab == 1?'checked':''}} type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <p>{{ __('common.open_link_in_a_new_tab') }}</p>
                                </div>

                                <div class="text-center">
                                    <button class="primary_btn_2" type="submit"><i class="ti-check"></i>{{ __('common.update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif($header->type == 'category')
            <div id="categoryDiv">
                @foreach($header->categorySectionItems() as $item)
                    <div class="single_item" data-id="{{$item->id}}" style="background: #f1f1f1; margin-bottom: 10px; padding: 10px; border-radius: 5px;">
                        <div class="item_summary d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="mr-10">
                                    <i class="ti-menu handle cursor-move" style="font-size: 20px;"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">{{$item->title}}</h5>
                                    <p class="mb-0">{{__('common.category')}}: {{$item->category->name}}</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <a class="primary-btn icon-only fix-gr-bg mr-5 edit_btn" data-toggle="collapse" href="#edit_form_{{$item->id}}">
                                    <i class="ti-pencil"></i>
                                </a>
                                <a class="primary-btn icon-only fix-gr-bg category_delete_btn" data-id="{{$item->id}}">
                                    <i class="ti-trash"></i>
                                </a>
                            </div>
                        </div>
                        <div class="collapse mt-10" id="edit_form_{{$item->id}}">
                            <form id="element_edit_form" class="mt-20">
                                <input type="hidden" name="id" value="{{$item->id}}">
                                <input type="hidden" name="header_id" value="{{$header->id}}">
                                <input type="hidden" name="header_type" value="{{$header->type}}">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label">{{__('common.title')}}</label>
                                    <input class="primary_input_field" type="text" name="title" value="{{$item->title}}" placeholder="{{__('common.title')}}">
                                </div>
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label">{{__('common.category')}}</label>
                                    <select name="category" class="primary_select mb-15 slider_category">
                                        <option value="{{$item->category_id}}" selected>{{$item->category->name}}</option>
                                    </select>
                                </div>
                                <div class="primary_input mb-25">
                                    <label class="primary_checkbox d-flex mr-12">
                                        <input name="is_newtab" value="1" {{$item->is_newtab == 1?'checked':''}} type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <p>{{ __('common.open_link_in_a_new_tab') }}</p>
                                </div>
                                <div class="text-center">
                                    <button class="primary_btn_2" type="submit"><i class="ti-check"></i>{{ __('common.update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif($header->type == 'product')
             <div id="productDiv">
                @foreach($header->productSectionItems() as $item)
                    <div class="single_item" data-id="{{$item->id}}" style="background: #f1f1f1; margin-bottom: 10px; padding: 10px; border-radius: 5px;">
                        <div class="item_summary d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="mr-10">
                                    <i class="ti-menu handle cursor-move" style="font-size: 20px;"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">{{$item->title}}</h5>
                                    <p class="mb-0">{{__('common.product')}}: {{$item->product->product->product_name}}</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <a class="primary-btn icon-only fix-gr-bg mr-5 edit_btn" data-toggle="collapse" href="#edit_form_{{$item->id}}">
                                    <i class="ti-pencil"></i>
                                </a>
                                <a class="primary-btn icon-only fix-gr-bg product_delete_btn" data-id="{{$item->id}}">
                                    <i class="ti-trash"></i>
                                </a>
                            </div>
                        </div>
                        <div class="collapse mt-10" id="edit_form_{{$item->id}}">
                            <form id="element_edit_form" class="mt-20">
                                <input type="hidden" name="id" value="{{$item->id}}">
                                <input type="hidden" name="header_id" value="{{$header->id}}">
                                <input type="hidden" name="header_type" value="{{$header->type}}">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label">{{__('common.title')}}</label>
                                    <input class="primary_input_field" type="text" name="title" value="{{$item->title}}" placeholder="{{__('common.title')}}">
                                </div>
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label">{{__('common.product')}}</label>
                                    <select name="product" class="primary_select mb-15 product">
                                        <option value="{{$item->product_id}}" selected>{{$item->product->product->product_name}}</option>
                                    </select>
                                </div>
                                <div class="primary_input mb-25">
                                    <label class="primary_checkbox d-flex mr-12">
                                        <input name="is_newtab" value="1" {{$item->is_newtab == 1?'checked':''}} type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <p>{{ __('common.open_link_in_a_new_tab') }}</p>
                                </div>
                                <div class="text-center">
                                    <button class="primary_btn_2" type="submit"><i class="ti-check"></i>{{ __('common.update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
