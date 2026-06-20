<div class="QA_section QA_section_heading_custom check_box_table mt-10">
    <div class="QA_table">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">{{ __('Order ID') }}</th>
                        <th scope="col" class="text-center">{{ __('Total Items') }}</th>
                        <th scope="col" class="text-right">{{ __('Amount') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>
                            <strong class="text-dark">{{ $order->order_number }}</strong>
                        </td>
                        <td class="text-center">{{ $order->number_of_item }}</td>
                        <td class="text-right font-weight-bold text-primary">{{ single_price($order->grand_total) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-20">{{ __('No orders found in this status.') }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
