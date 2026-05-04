<div class="dropdown CRM_dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false"> {{__('common.select')}}
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
        @if(auth()->user()->role->type == 'admin' || auth()->user()->role->type == 'staff')
            <a href="{{route('order_manage.show_details',$order->id)}}" target="_blank" class="dropdown-item" type="button">{{__('common.details')}}</a>
        @else
            <a href="{{route('order_manage.show_details_mine',$order->id)}}" target="_blank" class="dropdown-item" type="button">{{__('common.details')}}</a>
        @endif
    </div>
</div>
