# Delivery Status Change History Implementation

## Overview
A complete delivery status change tracking system has been implemented. Every time a delivery status is changed for an order or package, the change is automatically saved to a history table with full details.

## Components Created

### 1. **Database Migration**
**File:** `Modules/OrderManage/Database/Migrations/2026_01_31_000000_create_order_delivery_status_history_table.php`

Creates the `order_delivery_status_history` table with columns:
- `id` - Primary key
- `order_id` - Reference to the order
- `package_id` - Reference to the package
- `previous_delivery_status` - The status before the change
- `new_delivery_status` - The status after the change
- `note` - Optional notes about the change
- `changed_by` - User ID who made the change
- `created_at` - Timestamp of when change was made
- `updated_at` - When record was updated

### 2. **Model - OrderDeliveryStatusHistory**
**File:** `Modules/OrderManage/Entities/OrderDeliveryStatusHistory.php`

Features:
- Relationships with Order, Package, User, and DeliveryProcess models
- Query scopes: `forOrder()`, `forPackage()`, `byUser()`, `recentFirst()`
- Accessors: `previous_status_name`, `new_status_name`, `changed_by_name`

### 3. **Repository Enhancement**
**File:** `Modules/OrderManage/Repositories/OrderManageRepository.php`

**Added Method:** `logDeliveryStatusHistory()`
- Automatically logs every delivery status change
- Captures previous status, new status, user, and timestamp
- Error handling with logging

**Updated Method:** `updateDeliveryStatus()`
- Now calls `logDeliveryStatusHistory()` on every status change
- Maintains all existing functionality

### 4. **Controller Enhancement**
**File:** `Modules/OrderManage/Http/Controllers/OrderManageController.php`

**Added Method:** `getDeliveryStatusHistory()`
- Retrieves delivery status history for orders or packages
- Accepts `order_id` or `package_id` parameters
- Returns JSON response with full history details including user names and status names

### 5. **Route**
**File:** `Modules/OrderManage/Routes/web.php`

Added route:
```
GET /ordermanage/admin/delivery-status-history
```
Name: `order_manage.delivery_status_history`

## How It Works

### When a Delivery Status Changes:

1. **User updates delivery status** (via bulk update or individual update)
2. **Controller calls** `updateDeliveryStatus()` in the repository
3. **Repository** automatically calls `logDeliveryStatusHistory()`
4. **History record is created** with:
   - Order ID
   - Package ID
   - Previous status
   - New status
   - User who made the change
   - Timestamp
   - Optional notes

### Retrieving History:

Make a GET request to:
```
/ordermanage/admin/delivery-status-history?order_id=1
```

Or for a specific package:
```
/ordermanage/admin/delivery-status-history?package_id=5
```

**Response Example:**
```json
{
  "message": "Success",
  "data": [
    {
      "id": 1,
      "order_id": 25,
      "package_id": 10,
      "previous_delivery_status": 1,
      "new_delivery_status": 5,
      "note": "Shipped today",
      "changed_by": 1,
      "created_at": "2026-01-31 15:43:20",
      "previous_status_name": "Processing",
      "new_status_name": "Delivered",
      "changed_by_name": "Admin User"
    }
  ],
  "count": 1
}
```

## Database Setup

Run the migration:
```bash
php artisan migrate
```

## Features

✅ **Automatic Tracking** - Every status change is automatically logged
✅ **User Attribution** - Know who changed the status and when
✅ **Complete History** - See all status changes for an order
✅ **Notes Support** - Optional notes can be added with each change
✅ **Query Scopes** - Easy querying by order, package, or user
✅ **Error Handling** - Failures in logging don't break the main process
✅ **Performance** - Indexed columns for fast queries

## Usage Examples

### Get history for an order:
```php
$history = OrderDeliveryStatusHistory::forOrder($orderId)->get();
```

### Get history for a package:
```php
$history = OrderDeliveryStatusHistory::forPackage($packageId)->get();
```

### Get changes by a specific user:
```php
$history = OrderDeliveryStatusHistory::byUser($userId)->recentFirst()->get();
```

### Via API endpoint:
```javascript
// JavaScript/jQuery
$.get('/ordermanage/admin/delivery-status-history?order_id=25', function(response) {
    console.log('Status changes:', response.data);
    console.log('Total changes:', response.count);
});
```

## Answer to Your Question

**"How many times have I changed the Delivery Status?"**

Query the history table:
```php
$changeCount = OrderDeliveryStatusHistory::where('order_id', $orderId)->count();
echo "Order #$orderId status changed $changeCount times";
```

**"All status should be saved in the table"**

✅ This is now implemented - every single status change is automatically saved with:
- What changed (previous → new status)
- Who changed it (user)
- When it changed (timestamp)
- Any notes about the change
