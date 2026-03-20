<table class="table">
    <thead>
        <tr>
            <th>{{ __('common.product_name') }}</th>
            <th>{{ __('common.quantity') }}</th>
            <th>{{ __('refund.refund_reason') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ optional(optional($product->seller_product_sku)->product)->product_name }}</td>
                <td>{{ $product->return_qty }}</td>
                <td>{{ optional($product->refund_reason)->reason }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
