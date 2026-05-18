@php
    $statusColors = [
        'Pending' => 'badge_4',       // Blue for pending
        'Processing' => 'badge_2',    // Orange/yellow for processing  
        'Shipped' => 'badge_3',       // Purple/red for shipped
        'Delivered' => 'badge_1',     // Green for delivered
        'Cancelled' => 'badge_3',     // Red for cancelled
        'Returned' => 'badge_3',      // Red for returned
        'RTO' => 'badge_3',           // Red for RTO
    ];
    $colorClass = $statusColors[$order_package->DeliveryStateName] ?? 'badge_2';
@endphp
<span class="{{ $colorClass }}">{{ $order_package->DeliveryStateName }}</span>