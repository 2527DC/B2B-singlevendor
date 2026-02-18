#!/bin/bash
# Test script to verify bulk delivery status update is working

echo "=== Bulk Delivery Status Update - Verification Script ==="
echo ""

# Navigate to project
cd /var/www/html/Production_dev

# Test 1: Check if order with packages exists
echo "Test 1: Checking for confirmed orders with packages..."
php artisan tinker << 'EOF'
$orders = \App\Models\Order::with('packages')
    ->where('is_confirmed', 1)
    ->whereHas('packages')
    ->limit(5)
    ->get();

if ($orders->count() > 0) {
    echo "✅ Found " . $orders->count() . " confirmed order(s) with packages:\n";
    foreach ($orders as $order) {
        echo "   Order ID: " . $order->id . " - Packages: " . $order->packages->count() . "\n";
    }
} else {
    echo "⚠️  No confirmed orders with packages found\n";
}
exit;
EOF

echo ""
echo "Test 2: Checking recent delivery status history..."
php artisan tinker << 'EOF'
$history = \Modules\OrderManage\Entities\OrderDeliveryState::with(['creator', 'delivery_process'])
    ->orderByDesc('created_at')
    ->limit(5)
    ->get();

if ($history->count() > 0) {
    echo "✅ Recent status changes:\n";
    foreach ($history as $change) {
        $user = $change->creator ? $change->creator->name : 'System';
        $status = $change->delivery_process ? $change->delivery_process->name : 'Unknown';
        echo "   Package ID: " . $change->order_package_id . " → Status: " . $status . " by " . $user . " at " . $change->created_at . "\n";
    }
} else {
    echo "⚠️  No status changes found\n";
}
exit;
EOF

echo ""
echo "Test 3: Checking logs for recent bulk updates..."
tail -20 /var/www/html/Production_dev/storage/logs/laravel.log | grep -i "bulk_update_delivery" | head -10

echo ""
echo "=== Verification Complete ==="
echo ""
echo "To manually trigger a bulk update:"
echo "1. Go to Confirmed Orders tab"
echo "2. Select one or more orders"
echo "3. Choose delivery status and click Apply"
echo "4. Check logs: tail -f storage/logs/laravel.log"
echo "5. Query database:"
echo "   SELECT * FROM order_delivery_states ORDER BY created_at DESC LIMIT 10;"
