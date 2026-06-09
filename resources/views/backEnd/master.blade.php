<!DOCTYPE html>
<html dir="{{isRtl()?'rtl':''}}" class="{{isRtl()?'rtl':''}}">
@php
$adminColor = Modules\Appearance\Entities\AdminColor::where('is_active',1)->first();
if(Auth::user()->role->type == "superadmin"){
    $notifications = Modules\OrderManage\Entities\CustomerNotification::where('read_status',0)->where(function($query){
        $query->whereNotNull('seller_id')
                ->orWhere('customer_id',Auth::id());
    })->latest()->get();
}else{
    $notifications= Modules\OrderManage\Entities\CustomerNotification::where('read_status',0)
    ->where(function($query){
        $query->where('seller_id',Auth::id())
                ->orWhere('customer_id',Auth::id());
    })->latest()->get();
}
if($adminColor->background_type == "image"){
    $background = "url(".showImage($adminColor->background_image).") no-repeat center";
}else{
    $background = $adminColor->background_color;
}
if($adminColor->color_mode == "solid"){
    $gradient1 = $adminColor->solid_color;
    $gradient2 = $adminColor->solid_color;
    $gradient3 = $adminColor->solid_color;
}else{
    $gradient1 = $adminColor->gradient_color_one;
    $gradient2 = $adminColor->gradient_color_two;
    $gradient3 = $adminColor->gradient_color_three;
}
@endphp
<style>
    :root {
    --background: {{ $background }};
    --base_color: {{ $adminColor->base_color }};
    --base_color_60: {{ $adminColor->base_color }}99;
    --gradient_1: {{ $gradient1 }};
    --gradient_2: {{ $gradient2 }};
    --gradient_3: {{ $gradient3 }};
    --text-color: {{ $adminColor->text_color }};
    --border_color: {{ $adminColor->border_color }};
    --scroll_color: {{ $adminColor->scroll_color }};
    --bg_white: {{ $adminColor->background_white }};
    --bg_black: {{ $adminColor->background_black }};
    --input__bg: {{  $adminColor->input_background  }};
    --text_white: {{ $adminColor->text_white }};
    --text_black: {{ $adminColor->text_black }};
    --success: {{ $adminColor->success_color }};
    --danger: {{ $adminColor->danger_color }};
    --warning: {{ $adminColor->warning_color }};
    }
    .anchore_color{
        color: #415094;
    }


</style>
<style>
    /* Warehouse Switcher */
    .warehouse-switcher-wrap {
        padding: 8px 15px 6px;
        border-bottom: 1px solid var(--border_color, #eaecf0);
        background: linear-gradient(135deg, rgba(var(--base_color), 0.04), transparent);
    }
    .warehouse-switcher-inner {
        display: flex;
        align-items: center;
        gap: 8px;
        background: var(--bg_white, #fff);
        border: 1px solid var(--border_color, #e2e8f0);
        border-radius: 8px;
        padding: 6px 10px;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }
    .warehouse-switcher-inner:hover {
        border-color: var(--base_color, #7c3aed);
        box-shadow: 0 2px 8px rgba(124,58,237,0.10);
    }
    .warehouse-switcher-icon {
        flex-shrink: 0;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        background: linear-gradient(135deg, var(--gradient_1, #7c3aed), var(--gradient_2, #6d28d9));
        color: #fff;
        font-size: 12px;
    }
    .warehouse-switcher-select {
        flex: 1;
        border: none;
        outline: none;
        background: transparent;
        font-size: 12px;
        font-weight: 500;
        color: var(--text_black, #1e293b);
        cursor: pointer;
        padding: 2px 0;
        appearance: auto;
        -webkit-appearance: auto;
        min-width: 0;
    }
    .warehouse-switcher-select:focus {
        outline: none;
    }
    .warehouse-switcher-select option {
        font-size: 12px;
        padding: 6px 10px;
    }
    /* Mini sidebar */
    #sidebar.mini_sidebar .warehouse-switcher-wrap {
        padding: 8px 6px 6px;
    }
    #sidebar.mini_sidebar .warehouse-switcher-inner {
        justify-content: center;
        padding: 6px;
    }
    #sidebar.mini_sidebar .warehouse-switcher-select {
        display: none;
    }
</style>
@include('backEnd.partials._header')
<body class="admin">
    <div id="pre-loader" class="">
        @include('backEnd.partials.preloader')
    </div>
    <input type="hidden" id="url" value="{{url('/')}}">
    <div class="main-wrapper min_height_600">
        <!-- Sidebar  -->
        @if(isModuleActive('Affiliate') && auth()->user()->role->type == 'affiliate' || isModuleActive('Affiliate') && auth()->user()->role->type == 'customer')
            @include('affiliate::_sidebar')
        @else
            @include('backEnd.partials._sidebar')
        @endif
        <!-- Page Content  -->
        <div id="main-content">
            @include('backEnd.partials._menu')
            @section('mainContent')
            @show
            @include('backEnd.partials._invoice_modal')
        </div>
    </div>
    @include('backEnd.partials._footer')
    @include('backEnd.partials._modal')
    <div id="mediaManagerDiv">
    </div>
    @include('backEnd.partials._scripts')
</body>
</html>
