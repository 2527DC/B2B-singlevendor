
@if ($products->stock_manage == 1)
    @php
        $warehouse_id = request()->get('warehouse_id');
        $stock = 0;
        foreach ($products->skus as $sku) {
            $query = \DB::table('warehouse_product_stocks')->where('seller_product_sku_id', $sku->id);
            if ($warehouse_id) {
                $query->where('warehouse_id', $warehouse_id);
            }
            $stock += $query->sum('stock');
        }
    @endphp
@else
    @php
        $stock = __("common.not_manage");
    @endphp
@endif

{{ $stock }}
@if ($products->unit_type_id != null)
    ({{ @$products->unit_type->name }})
@endif
