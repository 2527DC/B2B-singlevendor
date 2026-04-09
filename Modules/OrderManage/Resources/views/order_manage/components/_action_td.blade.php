@if (permissionCheck('order_manage.show_details'))
<div class="d-flex align-items-center">
    @if (permissionCheck('shipping.invoice_generate') && $order->packages->count() > 0)
        <a target="_blank" href="{{route('shipping.invoice_generate',$order->packages->first()->id)}}" class="primary-btn small fix-gr-bg mr-2" title="{{__('shipping.invoice')}}"><i class="fa fa-download"></i></a>
    @endif
    <div class="dropdown CRM_dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false"> {{__('common.select')}}
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
            <a href="{{route('order_manage.show_details',$order->id)}}" class="dropdown-item" type="button">{{__('common.details')}}</a>
            @if($table == 'pending')
            <a href="{{route('admin.order.confirm', $order->id)}}" class="dropdown-item" type="button">{{__('common.confirm')}}</a>
            @endif
        </div>
    </div>
</div>
@else
    <button class="primary_btn_2" type="button">{{ __('common.you_don_t_have_this_permission') }}</button>
@endif
