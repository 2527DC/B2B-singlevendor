@php
    $activeWarehouseId = session('active_warehouse_id');
    $isChecked = false;
    if ($activeWarehouseId && $activeWarehouseId !== 'all' && $activeWarehouseId !== 'select') {
        $sku_ids = $products->skus->pluck('id')->toArray();
        if (!isModuleActive('MultiVendor')) {
            $frontProduct = $products->sellerProducts->where('user_id', 1)->first();
            if ($frontProduct) {
                $sku_ids = array_merge($sku_ids, $frontProduct->skus->pluck('id')->toArray());
            }
        }
        $isChecked = \DB::table('warehouse_product_stocks')
            ->whereIn('seller_product_sku_id', array_unique($sku_ids))
            ->where('warehouse_id', $activeWarehouseId)
            ->where('is_active', 1)
            ->exists();
    } else {
        $isChecked = ($products->status == 1);
    }
@endphp

@if($type == "superadmin" || $type == "admin" || $type == "staff")
<label class="switch_toggle" for="checkbox{{$status_slider}}{{ $products->id }}">
    <input type="checkbox" id="checkbox{{$status_slider}}{{ $products->id }}" @if ($isChecked) checked @endif @if (permissionCheck('product.update_active_status')) value="{{ $products->id }}" data-id="{{ $products->id }}" class="product_status_change" @else disabled @endif>
    <div class="slider round"></div>
</label>
@else

    @if($products->is_approved == 1)<span class="badge_1">{{__('common.approved')}}</span>@else<span class="badge_2">{{__('common.pending')}}</span>@endif

@endif
