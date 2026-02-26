<!-- shortby  -->
<div class="dropdown CRM_dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ __('common.select') }}
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
        <a class="dropdown-item seller_product_view" data-id="{{ $products->id }}">{{__('common.view')}}</a>
        @if(permissionCheck('seller.product.edit'))
            @if (auth()->user()->role->type == 'seller')
                <a class="dropdown-item edit_brand" href="{{ route('seller.product.edit', $products->id) }}">{{__('common.edit')}}</a>
            @else
                <a class="dropdown-item edit_brand" href="{{ route('admin.my-product.edit', $products->id) }}">{{__('common.edit')}}</a>
            @endif
        @endif
        <a class="dropdown-item manage_stock" href="javascript:void(0);" data-id="{{$products->id}}" data-type="{{$products->product_type}}" data-name="{{$products->product_name}}">{{__('product.manage_stock')}}</a>
        <a class="dropdown-item manage_history" href="javascript:void(0);" data-id="{{$products->id}}">{{__('product.manage_history')}}</a>
        @if(permissionCheck('product_destroy'))
          <a href="" class="dropdown-item seller_product_delete" data-id="{{$products->id}}">{{__('common.delete')}}</a>
        @endif
    </div>
</div>
<!-- shortby  -->
