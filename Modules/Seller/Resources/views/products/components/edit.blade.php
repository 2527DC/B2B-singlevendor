@extends('backEnd.master')
@section('styles')
<link rel="stylesheet" href="{{asset(asset_path('modules/seller/css/edit.css'))}}"/>
@endsection
@section('mainContent')
@if(isModuleActive('FrontendMultiLang'))
@php
$LanguageList = getLanguageList();
@endphp
@endif
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header">
                        <div class="main-title d-flex justify-content-between w-100">
                            <h3 class="mb-0 mr-30">{{ __('common.product') }} {{ __('common.update') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">
                        <form action="{{route('seller.product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            @php
                                $selected_warehouse_ids = \DB::table('warehouse_product_stocks')
                                    ->whereIn('seller_product_sku_id', $product->skus->pluck('id')->toArray())
                                    ->where('is_active', 1)
                                    ->pluck('warehouse_id')
                                    ->unique()
                                    ->toArray();
                            @endphp
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for=""> {{__("product.i_want_to_manage_stock_for_this_product")}}</label>
                                        <label class="switch_toggle" for="checkbox1">
                                            <input type="checkbox" id="checkbox1" @if ($product->stock_manage == 1) checked @endif value="{{ $product->id }}">
                                            <div class="slider round"></div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6" id="warehouse_select_div_existing">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="warehouse_ids_existing">Select Warehouses</label>
                                        <select class="primary_select mb-25" name="warehouse_ids[]" id="warehouse_ids_existing" multiple>
                                            @foreach($warehouses as $warehouse)
                                                <option value="{{ $warehouse->id }}" {{ in_array($warehouse->id, $selected_warehouse_ids) ? 'selected' : '' }}>{{ $warehouse->warehouse_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Hidden fields for discount data -->
                            <input type="hidden" name="discount" value="{{ $product->discount ?? 0 }}">
                            <input type="hidden" name="discount_type" value="{{ $product->discount_type ?? 0 }}">
                            <input type="hidden" name="discount_start_date" value="{{ $product->discount_start_date ?? '' }}">
                            <input type="hidden" name="discount_end_date" value="{{ $product->discount_end_date ?? '' }}">
                            @if($product->product->product_type ==1)
                                <div class="row">
                                    @if ($product->stock_manage == 1)
                                        <div class="col-xl-6 d-none">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="product_stock">{{__('product.product_stock')}} <span class="text-danger">*</span></label>
                                                <input class="primary_input_field" name="product_stock" id="product_stock" placeholder="{{__("product.product_stock")}}" type="number" min="0" step="0" value="{{$product->skus->first()->product_stock??0}}">
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-xl-12 d-none" id="warehouse_stocks_container_existing">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label">Warehouse Stocks</label>
                                            <div class="row align-items-center mb-3">
                                                <div class="col-md-4">
                                                    <input type="number" class="primary_input_field" id="bulk_stock_input_existing" placeholder="Stock value for all" min="0" step="1" style="padding: 8px 10px; height: auto;">
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="button" class="primary-btn fix-gr-bg" id="apply_to_all_stocks_existing" style="height: 38px; line-height: 38px; padding: 0 15px;">Same for all</button>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Warehouse</th>
                                                            <th>Stock</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="warehouse_stocks_list_existing">
                                                        @foreach($warehouses as $warehouse)
                                                            @if(in_array($warehouse->id, $selected_warehouse_ids))
                                                                @php
                                                                    $wh_stock = \DB::table('warehouse_product_stocks')
                                                                        ->where('seller_product_sku_id', $product->skus->first()->id)
                                                                        ->where('warehouse_id', $warehouse->id)
                                                                        ->first();
                                                                    $stock_val = $wh_stock ? $wh_stock->stock : 0;
                                                                @endphp
                                                                <tr class="wh_stock_row_{{ $warehouse->id }}">
                                                                    <td>{{ $warehouse->warehouse_name }}</td>
                                                                    <td>
                                                                        <input type="number" class="primary_input_field warehouse-stock-input-existing" name="warehouse_stock[{{ $warehouse->id }}]" value="{{ $stock_val }}" min="0" required style="padding: 6px 10px; height: auto;">
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="stock_manage" name="stock_manage" value="{{ $product->stock_manage }}">
                                    <div class="col-lg-6">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label" for=""> {{__("product.selling_price")}} <span class="text-danger">*</span></label>
                                            <input class="primary_input_field" name="selling_price" id="selling_price" placeholder="{{__("product.selling_price")}}" type="number" min="1" step="{{step_decimal()}}" value="{{$product->skus->first()->selling_price?$product->skus->first()->selling_price:''}}" required>
                                            <span class="text-danger">{{$errors->first('selling_price')}}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label" for="">{{ __('product.mrp') }} <span class="text-danger">*</span></label>
                                            <input class="primary_input_field" name="mrp" id="mrp" placeholder="{{ __('product.mrp') }}" type="number" min="1" step="0.001" value="{{$product->product->mrp?$product->product->mrp:''}}" required>
                                            <span class="text-danger">{{$errors->first('mrp')}}</span>
                                        </div>
                                    </div>
                                    @if(isModuleActive('WholeSale'))
                                    <div class="col-lg-6 whole_sale_info_add" id="whole_sale_info_add">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label" for="">{{ __('wholesale.Wholesale Price') }}</label>
                                            <!-- table-responsive -->
                                            <div class="table-responsive">
                                                <table class="create_table">
                                                    <tbody id="single_product_w_p">
                                                    @if( count($totalWholesalePrice)>0 )
                                                        @foreach($totalWholesalePrice as $w_key=>$wholesale_price)
                                                            <tr class="whole_sale_price_list">
                                                                <td class="p-2 border-0">
                                                                    <input type="text" class="form-control primary_input_field" value="{{ $wholesale_price->min_qty }}" name="wholesale_min_qty_0[]">
                                                                </td>
                                                                <td class="p-2 border-0">
                                                                    <input type="text" class="form-control primary_input_field" value="{{ $wholesale_price->max_qty }}" name="wholesale_max_qty_0[]">
                                                                </td>
                                                                <td class="p-2 border-0">
                                                                    <input type="text" class="form-control primary_input_field" value="{{ $wholesale_price->selling_price }}" name="wholesale_price_0[]">
                                                                </td>
                                                                <td class="p-2 pr-0 remove_whole_sale border-0">
                                                                    <button type="button" class="btn close style_close_icon"> <span aria-hidden="true">&times;</span> </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr class="whole_sale_price_list whole_sale_price_list_child">
                                                            <td class="pl-0 pb-0 border-0">
                                                                <input type="text" class="form-control primary_input_field" placeholder="Min QTY" name="wholesale_min_qty_0[]">
                                                            </td>
                                                            <td class="pl-0 pb-0 border-0">
                                                                <input type="text" class="form-control primary_input_field" placeholder="Max QTY" name="wholesale_max_qty_0[]">
                                                            </td>
                                                            <td class="pl-0 pb-0 border-0">
                                                                <input type="text" class="form-control primary_input_field" placeholder="Price per piece" name="wholesale_price_0[]">
                                                            </td>
                                                            <td class="p-2 pr-0 remove_whole_sale border-0">
                                                                <button type="button" class="btn close style_close_icon"> <span aria-hidden="true">&times;</span> </button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="add_items_button mb-20">
                                            <button type="button" class="btn btn-light btn-sm border add_single_whole_sale_price"> {{__('common.add_more')}} </button>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            @endif
                            <div class="row">
                                @if(isModuleActive('FrontendMultiLang'))
                                    <div class="col-lg-12">
                                        <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                            @foreach ($LanguageList as $key => $language)
                                                <li class="nav-item">
                                                    <a class="nav-link anchore_color @if (auth()->user()->lang_code == $language->code) active @endif" href="#pnelement{{$language->code}}" role="tab" data-toggle="tab" aria-selected="@if (auth()->user()->lang_code == $language->code) true @else false @endif">{{ $language->native }} </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content">
                                            @foreach ($LanguageList as $key => $language)
                                                <div role="tabpanel" class="tab-pane fade @if (auth()->user()->lang_code == $language->code) show active @endif" id="pnelement{{$language->code}}">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="primary_input mb-15">
                                                                <label class="primary_input_label" for="product_name"> {{__("product.display_name")}}</label>
                                                                <input class="primary_input_field" id="product_name" name="product_name[{{$language->code}}]" placeholder="{{__("product.display_name")}}" type="text" value="{{isset($product)?$product->getTranslation('product_name',$language->code):old('product_name.'.$language->code)}}">
                                                                <span class="text-danger">{{$errors->first('product_name')}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 @if(!app('general_setting')->product_subtitle_show) d-none @endif">
                                                            <div class="primary_input mb-15">
                                                                <label class="primary_input_label" for="subtitle_1"> {{ __('product.subtitle_1') }}</label>
                                                                <input class="primary_input_field" name="subtitle_1[{{$language->code}}]" id="subtitle_1" placeholder="{{ __('product.subtitle_1') }}" type="text" value="{{isset($product)?$product->getTranslation('subtitle_1',$language->code):old('subtitle_1.'.$language->code)}}">
                                                                <span id="error_subtitle_1"class="text-danger">{{ $errors->first('subtitle_1') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 @if(!app('general_setting')->product_subtitle_show) d-none @endif">
                                                            <div class="primary_input mb-15">
                                                                <label class="primary_input_label" for="subtitle_2"> {{ __('product.subtitle_2') }}</label>
                                                                <input class="primary_input_field" name="subtitle_2[{{$language->code}}]" id="subtitle_2" placeholder="{{ __('product.subtitle_2') }}" type="text" value="{{isset($product)?$product->getTranslation('subtitle_2',$language->code):old('subtitle_2.'.$language->code)}}">
                                                                <span id="error_subtitle_2" class="text-danger">{{ $errors->first('subtitle_2') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-6">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label" for="product_name"> {{__("product.display_name")}}</label>
                                            <input class="primary_input_field" id="product_name" name="product_name" placeholder="{{__("product.display_name")}}" type="text" value="{{old('product_name')?old('product_name'):$product->product_name}}">
                                            <span class="text-danger">{{$errors->first('product_name')}}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 @if(!app('general_setting')->product_subtitle_show) d-none @endif">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label" for="subtitle_1"> {{ __('product.subtitle_1') }}</label>
                                            <input class="primary_input_field" name="subtitle_1" id="subtitle_1" placeholder="{{ __('product.subtitle_1') }}" type="text" value="{{old('subtitle_1')?old('subtitle_1'):($product->subtitle_1 ?? '')}}">
                                            <span id="error_subtitle_1"class="text-danger">{{ $errors->first('subtitle_1') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 @if(!app('general_setting')->product_subtitle_show) d-none @endif">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label" for="subtitle_2"> {{ __('product.subtitle_2') }}</label>
                                            <input class="primary_input_field" name="subtitle_2" id="subtitle_2" placeholder="{{ __('product.subtitle_2') }}" type="text" value="{{old('subtitle_2')?old('subtitle_2'):($product->subtitle_2 ?? '')}}">
                                            <span id="error_subtitle_2" class="text-danger">{{ $errors->first('subtitle_2') }}</span>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-lg-6">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for="thumbnail_image_file_seller">{{ __('product.thumbnail_image') }} ({{getNumberTranslate(165)}} x {{getNumberTranslate(165)}}) {{__('common.px')}}</label>
                                        <div class="primary_file_uploader" data-toggle="amazuploader" data-multiple="false" data-type="image" data-name="thumbnail_image">
                                            <input class="primary-input file_amount" type="text" id="thumbnail_image_file_seller" placeholder="{{ __('product.thumbnail_image') }}" readonly>
                                            <button class="" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="thumbnail_image_seller">{{ __('product.Browse') }} </label>
                                                <input type="hidden" class="selected_files" value="{{@$product->thumb_image_media->media_id}}">
                                            </button>
                                        </div>
                                        <div class="product_image_all_div">
                                            @if(@$product->thumb_image_media == null && $product->thum_img != null)
                                                <div class="thumb_img_div">
                                                    <img id="ThumbnailImg" src="{{showImage($product->thum_img != null?$product->thum_img:'backend/img/default.png')}}" alt="">
                                                </div>
                                            @else
                                                <input type="hidden" class="product_images_hidden" name="thumbnail_image" value="{{@$product->thumb_image_media->media_id}}">
                                            @endif
                                        </div>
                                        <!-- Hidden field for thumbnail image source -->
                                        <input type="hidden" name="thum_img_src" value="{{ $product->thum_img ?? '' }}">
                                    </div>

                                </div>
                                <!-- <div class="col-lg-3">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for=""> {{__("product.discount")}}</label>
                                        <input class="primary_input_field" name="discount" id="discount"
                                               placeholder="{{__("product.discount")}}" type="number" min="0"
                                               step="{{step_decimal()}}"
                                               value="{{$product->discount?$product->discount:0}}">
                                        <span class="text-danger">{{$errors->first('discount')}}</span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label"
                                               for="">{{ __('product.discount_type') }}</label>
                                        <select class="primary_select mb-25" name="discount_type" id="discount_type">
                                            <option {{$product->discount_type == 1?'selected':''}} value="1">{{ __('product.amount') }}</option>
                                            <option {{$product->discount_type == 0?'selected':''}} value="0">{{ __('product.percentage') }}</option>
                                        </select>
                                    </div>
                                </div> -->
                                <!-- <div class="col-lg-3">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label"
                                               for="startDate">{{__('product.discount_start_date')}}</label>
                                        <div class="primary_datepicker_input">
                                            <div class="no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="">
                                                        <input placeholder="{{ __('common.date') }}" class="primary_input_field primary-input date form-control" id="startDate" type="text" name="discount_start_date" value="{{$product->discount_start_date??''}}" autocomplete="off">
                                                    </div>
                                                </div>
                                                <button class="" type="button">
                                                    <i class="ti-calendar" id="start-date-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="col-lg-3">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label"
                                               for="endDate">{{__('product.discount_end_date')}}</label>
                                        <div class="primary_datepicker_input">
                                            <div class="no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="">
                                                        <input placeholder="{{ __('common.date') }}" class="primary_input_field primary-input date form-control" id="endDate" type="text" name="discount_end_date" value="{{$product->discount_end_date??''}}" autocomplete="off">
                                                    </div>
                                                </div>
                                                <button class="" type="button">
                                                    <i class="ti-calendar" id="end-date-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-lg-6">
                                    @include('seller::products.components._get_gst_list', ['product' => $product->product])
                                </div>
                            </div>
                            @if($product->product->product_type ==2)
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label"
                                                   for="product_sku">{{ __('common.select') }} {{ __('common.new') }}</label>
                                            <select class="primary_select mb-25" name="product_sku" id="product_sku">
                                                <option value="" disabled selected>{{__('seller.select_from_list')}}</option>
                                                @foreach($skus as $sku)
                                                    <option value="{{$sku->id}}">{{$sku->sku}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" id="stock_manage" name="stock_manage" value="{{ $product->stock_manage }}">
                                    <div class="col-lg-6">
                                        <ul class="mt-25" id="sku_list_div">
                                            @foreach($product->skus as $sku)
                                                <li class="badge_1 mb-10" id="badge_id_{{$sku->id}}">{{$sku->sku->sku}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div class="row mt-20">
                                    <div id="variant_table_div" class="col-xl-12 overflow-auto">
                                        <table class="table table-bordered sku_table">
                                            <thead>
                                            <tr>
                                                <th class="text-center text-nowrap">{{ __('product.variant') }}</th>

                                                <th class="text-center">{{ __('product.selling_price') }}</th>
                                                @if ($product->stock_manage == 1)
                                                    <th class="text-center">{{ __('product.product_stock') }}</th>
                                                @endif
                                                <th class="text-center">{{ __('common.status') }}</th>
                                                <th class="text-center">{{ __('common.delete') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody id="sku_tbody">
                                            @foreach($product->skus as $key => $item)
                                                <input type="hidden" class="getIncKey" value="{{$key}}">
                                                <tr>
                                                    <input type="hidden" name="product_skus[]" value="{{$item->sku->id}}">
                                                    <td class="text-center product_sku_name">{{$item->sku->sku}}</td>

                                                    <td class="text-center sku_price_td">
                                                        <input class="primary_input_field" type="number" name="selling_price_sku[]" value="{{$item->selling_price}}" min="0" step="{{step_decimal()}}" class="form-control" required>
                                                        @if (isModuleActive('WholeSale'))
                                                            <button type="button" data-toggle="modal" tabindex="-1" data-target="#variant_wholesale_price_modal_{{ $item->sku->sku.$key }}" class="btn btn-sm style_plus_icon mt-1 add_variant_whole_sale_price"> <i class="ti-plus"></i> </button>
                                                            <!-- Append WholeSale Price  -->
                                                            @php
                                                                $wholesalePriceInfo = @$item->wholeSalePrices;
                                                            @endphp
                                                            <ul id="append_w_p{{$item->sku->sku.$key}}">
                                                                @foreach($wholesalePriceInfo as $w_s_p)
                                                                    <li>{{__('wholesale.Range')}}:{{($w_s_p->min_qty.'-'.$w_s_p->max_qty).'  $'.$w_s_p->selling_price}}</li>
                                                                @endforeach
                                                            </ul>
                                                            @include('wholesale::components.seller._edit_variant_wholesale_price_modal', ['modalTargetId'=> $item->sku->sku.$key, 'incKey'=>$key, 'sellerProductSkuInfo'=>$item])
                                                        @endif
                                                    </td>

                                                    @if ($product->stock_manage == 1)
                                                         <td class="text-center sku_price_td stock_td">
                                                             <input class="primary_input_field d-none" type="number" name="stock[]" value="{{$item->product_stock}}" min="0" step="0" class="form-control">
                                                             <div class="warehouse-sku-stock-container mt-2">
                                                                 @foreach($warehouses as $warehouse)
                                                                     @if(in_array($warehouse->id, $selected_warehouse_ids))
                                                                         @php
                                                                             $wh_stock = \DB::table('warehouse_product_stocks')
                                                                                 ->where('seller_product_sku_id', $item->id)
                                                                                 ->where('warehouse_id', $warehouse->id)
                                                                                 ->first();
                                                                             $stock_val = $wh_stock ? $wh_stock->stock : 0;
                                                                         @endphp
                                                                         <div class="mb-1 d-flex align-items-center">
                                                                             <small class="mr-1" style="font-size:10px; width:70px; display:inline-block; overflow:hidden; text-overflow:ellipsis;">{{ $warehouse->warehouse_name }}:</small>
                                                                             <input type="number" class="primary_input_field warehouse-stock-input-existing-variant" name="warehouse_stock[{{ $warehouse->id }}][{{ $item->id }}]" value="{{ $stock_val }}" min="0" style="padding: 4px; height: auto; width: 60px;" required>
                                                                         </div>
                                                                     @endif
                                                                 @endforeach
                                                             </div>
                                                         </td>
                                                    @endif
                                                    <td class="text-center product_sku_name">
                                                        <label class="switch_toggle" for="checkbox_{{$item->id}}">
                                                            <input type="checkbox" name="status_{{$item->sku->id}}" id="checkbox_{{$item->id}}" {{$item->status?'checked':''}}  value="{{$item->id}}">
                                                            <div class="slider round"></div>
                                                        </label>
                                                    </td>
                                                    <td class="text-center sku_delete_td" data-id="{{$item->id}}" data-unique_id="#badge_id_{{$item->id}}"><p><i class="fa fa-trash"></i></p></td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-lg-12 text-center mt-20">
                                    <div class="d-flex justify-content-center">
                                        <button class="primary-btn semi_large2  fix-gr-bg mr-1" id="save_button_parent"
                                                type="submit"><i class="ti-check"></i>{{__('common.update')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>

        (function ($) {
            "use strict";

            $(document).ready(function () {

                $(document).on('change', '#product_sku', function () {
                    let a_id = $(this).val();
                    var stock_manage = $('#stock_manage').val();
                    let sku = $('#product_sku option:selected').html();
                    let getIncKey = $('.getIncKey:last').val();
                    $('#sku_list_div').append(`<li class="badge_1 mb-10" id="badge_id_${a_id}">${sku}</li>`)
                    $.post('{{ route('seller.product.variant-edit') }}', {
                        _token: '{{ csrf_token() }}',
                        id: a_id,
                        stock_manage: stock_manage,
                        getIncKey: getIncKey
                    }, function (data) {

                        $('#sku_tbody').append(data.variants)

                    });

                });

                $(document).on('change', '#thumbnail_image_seller', function (event) {
                    getFileName($(this).val(), '#thumbnail_image_file_seller');
                    imageChangeWithFile($(this)[0], '#sellerThumbnailImg');
                });

                $(document).on('change', '#checkbox1', function (event) {
                    update_stock_manage_status($(this)[0]);
                });

                $(document).on('click', '.sku_delete_td', function (event) {
                    let id = $(this).data('id');
                    let unique_id = $(this).data('unique_id');

                    deleteRow($(this)[0], id, unique_id);
                });

                $(document).on('click', '.sku_delete_new', function (event) {
                    let unique_id = $(this).data('unique_id');

                    deleteRowNew($(this)[0], unique_id);
                });


                function deleteRow(btn, rowId, id) {

                    var formData = new FormData();
                    formData.append('_token', "{{ csrf_token() }}");
                    formData.append('id', rowId);

                    $.ajax({
                        url: "{{ route('seller.product.variant.delete') }}",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function (response) {
                            toastr.success("{{__('common.deleted_successfully')}}", "{{__('common.success')}}");
                        },
                        error: function (response) {
                            toastr.error("{{__('common.error_message')}}", "{{__('common.error')}}");
                        }
                    });
                    var row = btn.parentNode;
                    row.parentNode.removeChild(row);

                    $(id).css('display', 'none');
                }

                function deleteRowNew(btn, id) {
                    var row = btn.parentNode;
                    row.parentNode.removeChild(row);
                    $(id).css('display', 'none');

                }

                function update_stock_manage_status(el) {
                    if (el.checked) {
                        var status = 1;
                    } else {
                        var status = 0;
                    }
                    $.post('{{ route('seller.product.update_stock_manage_status') }}', {
                        _token: '{{ csrf_token() }}',
                        id: el.value,
                        status: status
                    }, function (data) {
                        if (data == 1) {
                            toastr.success("{{__('common.updated_successfully')}}", "{{__('common.success')}}");
                            location.reload();
                        } else {
                            toastr.error("{{__('common.error_message')}}", "{{__('common.error')}}");
                        }
                    });
                }


                //Add more Whole-Sale price for Single Product
                $(document).on('click', '.add_single_whole_sale_price', function () {
                    $('#single_product_w_p').append(`<tr class="whole_sale_price_list whole_sale_price_list_child">
                                <td class="p-2 border-0">
                                    <input type="text" class="form-control primary_input_field" placeholder="Min QTY" name="wholesale_min_qty_0[]">
                                </td>
                                <td class="p-2 border-0">
                                    <input type="text" class="form-control primary_input_field" placeholder="Max QTY" name="wholesale_max_qty_0[]">
                                </td>
                                <td class="p-2 border-0">
                                    <input type="text" class="form-control primary_input_field" placeholder="Price per piece" name="wholesale_price_0[]">
                                </td>
                                <td class="p-2 pr-0 remove_whole_sale border-0">
                                    <button type="button" class="btn close style_close_icon">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </td>
                        </tr>`);
                });

                $(document).on('click', '.remove_whole_sale', function () {
                    $(this).parents('.whole_sale_price_list').remove();
                });


                //Add more Whole-Sale price for Variant Product
                $(document).on('click', '.add_variant__whole_sale_price', function () {
                    var targetModalId = $(this).data('id');
                    var incKey = $(this).attr('incKey');

                    $(targetModalId).append(`<div class="col-lg-12 variant_whole_sale_price_list">
                            <div class="row mt-2">
                                <div class="col">
                                    <input type="text" class="form-control primary_input_field" placeholder="Min QTY" name="wholesale_min_qty_v_${incKey}[]">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control primary_input_field" placeholder="Max QTY" name="wholesale_max_qty_v_${incKey}[]">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control primary_input_field" placeholder="Price per piece" name="wholesale_price_v_${incKey}[]">
                                </div>
                                <div class="col">
                                    <button type="button" class="float-left mt-2 style_plus_icon remove_variant_whole_sale border-0">
                                        <i class="ti-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>`);
                });

                $(document).on('click', '.remove_variant_whole_sale', function () {
                    $(this).parents('.variant_whole_sale_price_list').remove();
                });

                //Append wholesale price in sku table
                $(document).on('click', '.wholesale_p_save_btn', function (){
                    var append_w_priceId = $(this).attr('append_w_priceId');
                    var w_incKey = $(this).attr('w_incKey');
                    $('#append_w_p'+append_w_priceId).empty();

                    var wholesale_min_qty_v = $('input[name="wholesale_min_qty_v_'+w_incKey+'[]"]').map(function(){return $(this).val();}).get();
                    var wholesale_max_qty_v = $('input[name="wholesale_max_qty_v_'+w_incKey+'[]"]').map(function(){return $(this).val();}).get();
                    var wholesale_price_v = $('input[name="wholesale_price_v_'+w_incKey+'[]"]').map(function(){return $(this).val();}).get();

                    var w_s_p_list=[];
                    for (var w=0; w<wholesale_min_qty_v.length; w++){
                        w_s_p_list[w] = "<li>{{__('wholesale.Range')}}:("+wholesale_min_qty_v[w]+"-"+wholesale_max_qty_v[w]+")     $"+wholesale_price_v[w]+"</li>";
                    }

                    $('#append_w_p'+append_w_priceId).append(w_s_p_list);
                    $('#variant_wholesale_price_modal_'+append_w_priceId).modal('toggle');
                });


            });
        // Multi-warehouse Stock management script
        function getSelectedWarehouses(selectId) {
            var selected = [];
            $(selectId + ' option:selected').each(function() {
                selected.push({
                    id: $(this).val(),
                    name: $(this).text().replace(' (Default)', '')
                });
            });
            return selected;
        }

        // Sync single product warehouse stock inputs (Existing product form)
        function syncExistingSingleWarehouseStocks() {
            var stock_manage = $('#stock_manage').val();
            var warehouses = getSelectedWarehouses('#warehouse_ids_existing');
            var isVariant = $('#product_sku').length > 0; // Check if it has variant dropdown

            if (stock_manage == 1 && !isVariant && warehouses.length > 0) {
                $('#warehouse_stocks_container_existing').removeClass('d-none');
                $('#single_product_stock_div').addClass('d-none');
                $('#product_stock').removeAttr('required');

                // Read existing stock values from list to preserve them
                var currentStocks = {};
                $('.warehouse-stock-input-existing').each(function() {
                    currentStocks[$(this).attr('name').match(/\d+/)[0]] = $(this).val();
                });

                var html = '';
                warehouses.forEach(function(wh) {
                    var val = currentStocks[wh.id] || '0';
                    html += `<tr class="wh_stock_row_${wh.id}">
                        <td>${wh.name}</td>
                        <td>
                            <input type="number" class="primary_input_field warehouse-stock-input-existing" name="warehouse_stock[${wh.id}]" value="${val}" min="0" required style="padding: 6px 10px; height: auto;">
                        </td>
                    </tr>`;
                });
                $('#warehouse_stocks_list_existing').html(html);
            } else {
                $('#warehouse_stocks_container_existing').addClass('d-none');
                if (stock_manage == 1 && !isVariant) {
                    $('#single_product_stock_div').removeClass('d-none');
                    $('#product_stock').attr('required', 'required');
                }
            }
        }

        // Sync variant product warehouse stock inputs (Existing product form)
        function syncExistingVariantWarehouseStocks() {
            var stock_manage = $('#stock_manage').val();
            var warehouses = getSelectedWarehouses('#warehouse_ids_existing');
            var isVariant = $('#product_sku').length > 0;

            if (stock_manage == 1 && isVariant && warehouses.length > 0) {
                $('#warehouse_stocks_container_existing').addClass('d-none');
                
                $('#sku_tbody tr').each(function(rowIndex) {
                    var sku_id = $(this).find('input[name="product_skus[]"]').val();
                    var stockTd = $(this).find('.stock_td');
                    
                    stockTd.find('input[name="stock[]"]').addClass('d-none').removeAttr('required');
                    
                    var container = stockTd.find('.warehouse-sku-stock-container');
                    if (container.length === 0) {
                        container = $('<div class="warehouse-sku-stock-container mt-2"></div>');
                        stockTd.append(container);
                    }
                    
                    // Preserve existing input values
                    var currentStocks = {};
                    container.find('.warehouse-stock-input-existing-variant').each(function() {
                        var matches = $(this).attr('name').match(/warehouse_stock\[(\d+)\]/);
                        if (matches) {
                            currentStocks[matches[1]] = $(this).val();
                        }
                    });

                    container.empty();
                    
                    warehouses.forEach(function(wh) {
                        var val = currentStocks[wh.id] || '0';
                        container.append(`
                            <div class="mb-1 d-flex align-items-center">
                                <small class="mr-1" style="font-size:10px; width:70px; display:inline-block; overflow:hidden; text-overflow:ellipsis;">${wh.name}:</small>
                                <input type="number" class="primary_input_field warehouse-stock-input-existing-variant" name="warehouse_stock[${wh.id}][${sku_id}]" value="${val}" min="0" style="padding: 4px; height: auto; width: 60px;" required>
                            </div>
                        `);
                    });
                });
            }
        }

        // "Same for all" buttons logic
        $(document).on('click', '#apply_to_all_stocks_existing', function() {
            var val = $('#bulk_stock_input_existing').val();
            if (val !== '') {
                $('.warehouse-stock-input-existing').val(val);
                $('.warehouse-stock-input-existing-variant').val(val);
            }
        });

        // Bind event handlers for Existing Product Form
        $(document).on('change', '#warehouse_ids_existing, #stock_manage, #product_sku', function() {
            syncExistingSingleWarehouseStocks();
            syncExistingVariantWarehouseStocks();
        });

        // Re-trigger sync when ajax combinations render
        $(document).ajaxComplete(function(event, xhr, settings) {
            if (settings.url && settings.url.indexOf('variant-edit') !== -1) {
                syncExistingVariantWarehouseStocks();
            }
        });

        // Initial trigger
        syncExistingSingleWarehouseStocks();
        syncExistingVariantWarehouseStocks();

        })(jQuery);


    </script>
@endpush
