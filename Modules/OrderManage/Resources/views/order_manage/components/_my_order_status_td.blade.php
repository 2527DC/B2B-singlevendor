@if ($order_package->order->is_cancelled == 1)
    @php
        $rto = \Modules\Refund\Entities\ReturnRequest::where('package_id', $order_package->id)
            ->where('return_type', 'delivery_failure')
            ->first();
    @endphp
    @if ($rto)
        <h6><span class="badge_3">Returned</span></h6>
    @else
        <h6><span class="badge_3">Cancelled</span></h6>
    @endif
@elseif ($order_package->order->is_confirmed == 1 && $order_package->order->is_completed == 1)
    <h6><span class="badge_1">{{__('common.completed')}}</span></h6>
@elseif ($order_package->order->is_confirmed == 1)
    <h6><span class="badge_1">{{__('common.confirmed')}}</span></h6>
@elseif ($order_package->order->is_confirmed == 2)
    <h6><span class="badge_4">{{__('common.declined')}}</span></h6>
@else
    <h6><span class="badge_4">{{__('common.pending')}}</span></h6>
@endif
