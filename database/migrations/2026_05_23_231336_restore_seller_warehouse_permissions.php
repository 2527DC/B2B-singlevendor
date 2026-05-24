<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Modules\RolePermission\Entities\Permission;
use Modules\SidebarManager\Entities\Backendmenu;
use Modules\SidebarManager\Entities\BackendmenuUser;

class RestoreSellerWarehousePermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Seller Permissions
        $seller_parent_perm = Permission::where('route', 'seller.product.index')->first();
        if ($seller_parent_perm) {
            $seller_perm = Permission::updateOrCreate(
                ['route' => 'seller.warehouses.index'],
                [
                    'module_id' => $seller_parent_perm->module_id,
                    'parent_id' => $seller_parent_perm->id,
                    'name' => 'Warehouse Management',
                    'status' => 1,
                    'type' => 2,
                    'module' => 'MultiVendor'
                ]
            );

            // Give permission to Seller role (ID 5)
            $seller_role_id = 5;
            DB::table('role_permission')->updateOrInsert(
                ['role_id' => $seller_role_id, 'permission_id' => $seller_perm->id],
                ['role_id' => $seller_role_id, 'permission_id' => $seller_perm->id]
            );
        }

        // Seller Sidebar Menu
        $seller_parent_menu = Backendmenu::find(2); // Products menu
        if ($seller_parent_menu) {
            $seller_menu = Backendmenu::updateOrCreate(
                ['route' => 'seller.warehouses.index'],
                [
                    'name' => 'common.warehouses',
                    'icon' => 'fa fa-building',
                    'parent_id' => $seller_parent_menu->id,
                    'is_admin' => 0,
                    'is_seller' => 1,
                    'position' => 12,
                    'module' => 'MultiVendor'
                ]
            );

            // Sync menu for active sellers
            $seller_users = User::whereHas('role', function($q) {
                $q->where('type', 'seller');
            })->get();

            foreach ($seller_users as $user) {
                $parent_user_menu = BackendmenuUser::where('user_id', $user->id)->where('backendmenu_id', $seller_parent_menu->id)->first();
                if ($parent_user_menu) {
                    BackendmenuUser::updateOrCreate(
                        ['user_id' => $user->id, 'backendmenu_id' => $seller_menu->id],
                        [
                            'parent_id' => $parent_user_menu->id,
                            'position' => 12,
                            'status' => 1
                        ]
                    );
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $permissions = Permission::whereIn('route', ['seller.warehouses.index'])->get();
        foreach ($permissions as $permission) {
            DB::table('role_permission')->where('permission_id', $permission->id)->delete();
            $permission->delete();
        }

        $menus = Backendmenu::whereIn('route', ['seller.warehouses.index'])->get();
        foreach ($menus as $menu) {
            BackendmenuUser::where('backendmenu_id', $menu->id)->delete();
            $menu->delete();
        }
    }
}
