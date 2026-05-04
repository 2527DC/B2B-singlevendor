<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\RolePermission\Entities\Permission;
use Illuminate\Support\Facades\DB;

class AddInhouseOrderPermissionsToSeller extends Migration
{
    public function up()
    {
        // 1. Add Permissions
        $seller_order_manage = Permission::where('id', 153)->first();
        if ($seller_order_manage) {
            DB::table('permissions')->updateOrInsert([
                'route' => 'seller.inhouse-order.index',
            ], [
                'id' => 770,
                'module_id' => 11,
                'parent_id' => 153,
                'name' => 'InHouse Order',
                'type' => 2,
                'status' => 1,
                'module' => 'MultiVendor'
            ]);

            $permissions = [
                ['id' => 771, 'name' => 'Confirmed', 'route' => 'inhouse_order_confirmed', 'type' => 3],
                ['id' => 772, 'name' => 'Completed', 'route' => 'inhouse_order_completed', 'type' => 3],
                ['id' => 773, 'name' => 'Pending', 'route' => 'inhouse_order_pending', 'type' => 3],
                ['id' => 774, 'name' => 'Cancelled', 'route' => 'inhouse_order_cancelled', 'type' => 3],
                ['id' => 775, 'name' => 'Create', 'route' => 'seller.inhouse-order.create', 'type' => 3],
                ['id' => 776, 'name' => 'Delete', 'route' => 'seller.inhouse-order.delete', 'type' => 3],
            ];

            foreach ($permissions as $permission) {
                DB::table('permissions')->updateOrInsert([
                    'route' => $permission['route'],
                    'parent_id' => 770,
                ], [
                    'id' => $permission['id'],
                    'module_id' => 11,
                    'name' => $permission['name'],
                    'type' => $permission['type'],
                    'status' => 1,
                    'module' => 'MultiVendor'
                ]);
            }

            // 2. Assign to Seller Role (ID 5)
            $all_new_ids = [770, 771, 772, 773, 774, 775, 776];

            foreach ($all_new_ids as $id) {
                DB::table('role_permission')->updateOrInsert([
                    'role_id' => 5,
                    'permission_id' => $id
                ], [
                    'status' => 1
                ]);
            }
        }

        // 3. Add to Backend Menu
        $seller_menu_parent = DB::table('backendmenus')->where('name', 'seller.Seller Order Manage')->first();
        if ($seller_menu_parent) {
            DB::table('backendmenus')->updateOrInsert([
                'route' => 'seller.inhouse-order.index',
            ], [
                'name' => 'order.inhouse_orders',
                'icon' => 'fas fa-shopping-cart',
                'parent_id' => $seller_menu_parent->id,
                'is_admin' => 0,
                'is_seller' => 1,
                'position' => 2,
                'module' => 'MultiVendor'
            ]);
        }
    }

    public function down()
    {
        $inhouse_parent = Permission::where('route', 'seller.inhouse-order.index')->first();
        if ($inhouse_parent) {
            $ids = Permission::where('parent_id', $inhouse_parent->id)->pluck('id')->toArray();
            $ids[] = $inhouse_parent->id;

            DB::table('role_permission')->whereIn('permission_id', $ids)->delete();
            Permission::whereIn('id', $ids)->delete();
        }

        $menu = DB::table('backendmenus')->where('route', 'seller.inhouse-order.index')->first();
        if ($menu) {
            DB::table('backendmenu_users')->where('backendmenu_id', $menu->id)->delete();
            DB::table('backendmenus')->where('id', $menu->id)->delete();
        }
    }
}
