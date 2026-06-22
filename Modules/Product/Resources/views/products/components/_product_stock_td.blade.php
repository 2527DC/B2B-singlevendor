
@php
    $warehouse_id = request()->get('warehouse_id') ?: session('active_warehouse_id');
    $stock = 0;
    $sku_ids = $products->skus->pluck('id')->toArray();
    
    if (!isModuleActive('MultiVendor')) {
        $frontProduct = $products->sellerProducts->where('user_id', 1)->first();
        if ($frontProduct) {
            $sku_ids = array_merge($sku_ids, $frontProduct->skus->pluck('id')->toArray());
        }
    }
    $sku_ids = array_unique($sku_ids);

    $query = \DB::table('warehouse_product_stocks')->whereIn('seller_product_sku_id', $sku_ids);
    if ($warehouse_id && $warehouse_id !== 'all' && $warehouse_id !== 'select') {
        $query->where('warehouse_id', $warehouse_id);
    }
    $stock = $query->sum('stock');
@endphp

{{ $stock }}
@if ($products->unit_type_id != null)
    ({{ @$products->unit_type->name }})
@endif
