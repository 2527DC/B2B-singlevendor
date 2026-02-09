# DataTables Ajax Error Fix - Cancelled Orders Table

## Problem
When opening the "Cancelled Orders" tab on the My Orders page, users were getting the following error:
```
DataTables warning: table id=orderCanceledTable - Ajax error. For more information about this error, please see http://datatables.net/tn/7
```

## Root Cause
The error was caused by a missing method in the `OrderManageRepository` class. The controller was calling:
```php
$this->ordermanageService->myCancelledPaymentSalesList()
```

Which in turn called:
```php
$this->ordermanageRepository->myCancelledPaymentSalesList()
```

However, this method (along with three other similar methods) was not implemented in the repository:
- `myConfirmedSalesList()`
- `myCompletedSalesList()`
- `myPendingPaymentSalesList()`
- `myCancelledPaymentSalesList()`

This caused a PHP error that returned invalid JSON to the DataTable, resulting in the Ajax error.

## Solution
Added all four missing methods to `/var/www/html/multivendor/Modules/OrderManage/Repositories/OrderManageRepository.php`:

### Methods Added:

1. **myConfirmedSalesList()** - Returns confirmed orders for the current seller
   - Filters for non-cancelled orders with `is_confirmed = 1` and `is_completed = 0`

2. **myCompletedSalesList()** - Returns completed orders for the current seller
   - Filters for non-cancelled orders with `is_completed = 1`

3. **myPendingPaymentSalesList()** - Returns orders awaiting payment
   - Filters for non-cancelled orders with `is_paid = 0`

4. **myCancelledPaymentSalesList()** - Returns cancelled orders
   - Filters for orders with `is_cancelled = 1`

All methods:
- Use `getParentSellerId()` to get the current seller
- Return `OrderPackageDetail` query results with eager loaded relationships
- Include order, seller, and customer information
- Are ordered by latest first

## Files Modified
- `/var/www/html/multivendor/Modules/OrderManage/Repositories/OrderManageRepository.php`

## Testing
After this fix:
1. All tabs on the My Orders page should load without errors
2. The cancelled orders table should display correctly with AJAX data
3. Other order tables (confirmed, completed, pending) should also work correctly

## Related Controllers
- `Modules\OrderManage\Http\Controllers\OrderManageController::my_sales_get_data()`

## Related Views
- `Modules/OrderManage/Resources/views/order_manage/my_orders.blade.php`
