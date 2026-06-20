@if($customer->is_deleted)
    <h6><span class="badge_4">Deleted</span></h6>
@elseif(permissionCheck('customer.update_active_status'))
<label class="switch_toggle" for="active_checkbox{{ $customer->id }}">
    <input type="checkbox" id="active_checkbox{{ $customer->id }}" @if ($customer->is_active == 1) checked @endif value="{{ $customer->id }}" @if (!permissionCheck('customer.update_active_status')) disabled @endif class="update_active_status" data-id="{{ $customer->id }}">
    <div class="slider round"></div>
</label>
@endif
