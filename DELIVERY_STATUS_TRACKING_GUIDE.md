# Delivery Status History Tracking - Using order_delivery_states Table

## Overview
All delivery status changes are automatically tracked in the existing `order_delivery_states` table. Every time a delivery status is updated (bulk or individual), a record is created with complete details.

## Table Structure
**Table Name:** `order_delivery_states`

| Column | Type | Purpose |
|--------|------|---------|
| id | bigint | Primary key |
| order_package_id | bigint | Package ID reference |
| delivery_status | bigint | The new delivery status |
| note | text | Optional notes about the change |
| date | date | Date of status change |
| created_by | bigint | User ID who made the change |
| updated_by | bigint | User who updated the record |
| created_at | timestamp | When record was created |
| updated_at | timestamp | When record was updated |

## How It Works

### When Status Changes:
1. User updates delivery status (bulk or individual)
2. Controller calls `updateDeliveryStatus()` in repository
3. Repository creates a record in `order_delivery_states` with:
   - `order_package_id` - Which package
   - `delivery_status` - New status
   - `note` - Any notes provided
   - `created_by` - Who made the change (user ID)
   - `date` - When it was changed
   - `created_at` - Timestamp

## Query Examples

### Get all status changes for a package:
```php
$history = OrderDeliveryState::where('order_package_id', $packageId)
    ->orderByDesc('created_at')
    ->get();

foreach ($history as $change) {
    echo "Status: " . $change->delivery_status . " - Changed by: " . $change->creator->name . " - Date: " . $change->created_at;
}
```

### Count how many times status was changed:
```php
$changeCount = OrderDeliveryState::where('order_package_id', $packageId)->count();
echo "Status changed $changeCount times";
```

### Get latest status change:
```php
$latestChange = OrderDeliveryState::where('order_package_id', $packageId)
    ->orderByDesc('created_at')
    ->first();
```

### Get changes by specific user:
```php
$userChanges = OrderDeliveryState::where('created_by', $userId)
    ->orderByDesc('created_at')
    ->get();
```

## Model Relationships

The `OrderDeliveryState` model includes:

```php
public function delivery_process(){
    return $this->belongsTo(DeliveryProcess::class,'delivery_status','id');
}

public function creator(){
    return $this->belongsTo(User::class, 'created_by', 'id');
}
```

### Usage:
```php
// Get status changes with delivery process name and creator name
$history = OrderDeliveryState::with(['delivery_process', 'creator'])
    ->where('order_package_id', $packageId)
    ->get();

foreach ($history as $change) {
    echo "Status: " . $change->delivery_process->name . " - Changed by: " . $change->creator->name;
}
```

## The OrderPackageDetail Relationship

The `OrderPackageDetail` model has this relationship:

```php
public function delivery_states(){
    return $this->hasMany(OrderDeliveryState::class,'order_package_id');
}
```

### Usage:
```php
$package = OrderPackageDetail::find($packageId);
$allStatusChanges = $package->delivery_states;
echo "Total status changes: " . $allStatusChanges->count();
```

## Real-World Example

### Track an order's complete history:
```php
$order = Order::find($orderId);

foreach ($order->packages as $package) {
    echo "Package: " . $package->package_code . "\n";
    echo "Status Changes:\n";
    
    $statusHistory = $package->delivery_states()
        ->with(['delivery_process', 'creator'])
        ->orderByDesc('created_at')
        ->get();
    
    foreach ($statusHistory as $change) {
        echo "  - " . $change->delivery_process->name 
            . " by " . $change->creator->name 
            . " on " . $change->created_at->format('Y-m-d H:i:s')
            . "\n";
    }
}
```

## Key Points

✅ **Automatic Tracking** - Every status change creates a record
✅ **User Attribution** - Know who changed the status
✅ **Timestamps** - Know exactly when changes were made
✅ **Notes Support** - Optional notes can be added
✅ **Complete History** - All changes are preserved
✅ **Easy Querying** - Use eloquent relationships to access data
✅ **Indexed** - The table is optimized for queries

## Current Implementation in Code

The status change is logged in:
**File:** `Modules/OrderManage/Repositories/OrderManageRepository.php`
**Method:** `updateDeliveryStatus()`

```php
if ($order_package->delivery_status != $data['delivery_status']) {
    // ... existing code ...
    
    $createdState = OrderDeliveryState::create([
        'order_package_id' => $order_package->id,
        'delivery_status' => $data['delivery_status'],
        'note' => $data['note'],
        'created_by' => getParentSellerId(),
        'date' => Carbon::now()->format('Y-m-d')
    ]);
}
```

Every status change (individual or bulk) goes through this method and creates a record in `order_delivery_states`.
