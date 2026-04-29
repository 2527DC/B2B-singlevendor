<!-- shortby  -->
<div class="dropdown CRM_dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ __('common.select') }}
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
        <a href="{{ route('checkpincode.edit', $checkPincodes->id) }}" class="dropdown-item product_detail" data-id="{{$checkPincodes->id}}">{{__('common.edit')}}</a>
        <button class="dropdown-item product_detail delete_pincode" data-id="{{$checkPincodes->id}}">{{__('common.delete')}}</button> 
    </div>
</div>
<!-- shortby  -->
