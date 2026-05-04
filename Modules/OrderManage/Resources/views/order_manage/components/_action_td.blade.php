@php
    $show_details_permission = (auth()->user()->role->type == 'seller') ? 'order_manage.show_details_mine' : 'order_manage.show_details';
    $details_id = $order->id;
    if(auth()->user()->role->type == 'seller'){
        $package = $order->packages->where('seller_id', getParentSellerId())->first();
        $details_id = $package ? $package->id : $order->id;
    }
@endphp
@if (permissionCheck($show_details_permission))
<div class="d-flex align-items-center">
    <div class="dropdown CRM_dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false"> {{__('common.select')}}
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
            <a href="{{route($show_details_permission,$details_id)}}" class="dropdown-item" type="button">{{__('common.details')}}</a>
            @if($table == 'pending')
            <a href="{{route('admin.order.confirm', $order->id)}}" class="dropdown-item" type="button">{{__('common.confirm')}}</a>
            @endif
        </div>
    </div>
</div>
@else
    <button class="primary_btn_2" type="button">{{ __('common.you_don_t_have_this_permission') }}</button>
@endif
