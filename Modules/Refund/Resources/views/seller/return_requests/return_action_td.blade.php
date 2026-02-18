<div class="dropdown CRM_dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false"> {{__('common.select')}}
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
        <a href="{{ route('refund.seller_return_request_show', $data->id) }}" class="dropdown-item"
            type="button">{{ __('common.details') }}</a>
        @if($data->status != 'completed')
        <a href="{{ route('refund.seller_return_request_complete', $data->id) }}" class="dropdown-item"
            type="button">{{ __('common.complete') }}</a>
        @endif
    </div>
</div>
