@php
    $statusColors = [
        'Pending' => 'badge_4',       // Red/Orange for pending
        'Processing' => 'badge_2',    // Blue for processing  
        'Shipped' => 'badge_3',       // Purple for shipped
        'Delivered' => 'badge_1',     // Green for delivered
        'Cancelled' => 'badge_4',     // Red for cancelled
        'Returned' => 'badge_4',      // Red for returned
    ];
    $colorClass = $statusColors[$order_package->DeliveryStateName] ?? 'badge_2';
@endphp
<span class="{{ $colorClass }}">{{ $order_package->DeliveryStateName }}</span>