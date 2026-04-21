<div class="d-flex align-items-center">
    @if (permissionCheck('shipping.invoice_generate'))
        <a target="_blank" href="{{route('shipping.invoice_generate',$order_package->id)}}" class="primary-btn small fix-gr-bg mr-2" title="{{__('shipping.invoice')}}"><i class="fa fa-download"></i></a>
    @endif
    <div class="dropdown CRM_dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false"> {{__('common.select')}}
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
            @if(permissionCheck('order_manage.my_sales_index'))
                <a href="{{route('order_manage.show_details_mine',$order_package->id)}}" class="dropdown-item" type="button">{{__('common.details')}}</a>
            @endif
        </div>
    </div>
</div>
