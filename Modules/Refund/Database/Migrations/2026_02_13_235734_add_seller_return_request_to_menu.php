<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Modules\RolePermission\Entities\Permission;
use Modules\SidebarManager\Entities\Backendmenu;
use Modules\SidebarManager\Entities\BackendmenuUser;

class AddSellerReturnRequestToMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Permission
        $parent_permission = Permission::where('route', 'refund_manage')->first();
        if($parent_permission){
            $permission = Permission::updateOrCreate(
                ['route' => 'refund.seller_return_request_list'],
                [
                    'module_id' => $parent_permission->module_id,
                    'parent_id' => $parent_permission->id,
                    'name' => 'Return Request',
                    'status' => 1,
                    'type' => 2,
                    'module' => 'MultiVendor'
                ]
            );
            
            // 2. Role Permission (Seller role id 5)
            $role_id = 5; // Seller role ID confirmed as 5
            DB::table('role_permission')->updateOrInsert(
                ['role_id' => $role_id, 'permission_id' => $permission->id],
                ['role_id' => $role_id, 'permission_id' => $permission->id]
            );
            
            // also for superadmin/admin if they exist
            $admin_roles = DB::table('roles')->whereIn('type', ['superadmin', 'admin'])->pluck('id');
            foreach($admin_roles as $r_id){
                DB::table('role_permission')->updateOrInsert(
                    ['role_id' => $r_id, 'permission_id' => $permission->id],
                    ['role_id' => $r_id, 'permission_id' => $permission->id]
                );
            }
        }

        // 3. Backend Menu
        $parent_menu = Backendmenu::where('route', 'refund_manage')->first();
        if($parent_menu){
            $menu = Backendmenu::updateOrCreate(
                ['route' => 'refund.seller_return_request_list'],
                [
                    'name' => 'refund.return_request',
                    'icon' => 'fas fa-shopping-cart',
                    'parent_id' => $parent_menu->id,
                    'is_admin' => 1,
                    'is_seller' => 1,
                    'position' => 3,
                    'module' => 'MultiVendor'
                ]
            );

            // 4. Backend Menu User
            $users = User::whereHas('role', function($q){
                $q->whereIn('type', ['superadmin', 'admin', 'seller']);
            })->get();

            foreach($users as $user){
                // Find user's parent menu entry in backendmenu_users
                $parent_user_menu = BackendmenuUser::where('user_id', $user->id)->where('backendmenu_id', $parent_menu->id)->first();
                if($parent_user_menu){
                    BackendmenuUser::updateOrCreate(
                        ['user_id' => $user->id, 'backendmenu_id' => $menu->id],
                        [
                            'parent_id' => $parent_user_menu->id,
                            'position' => 3,
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
        $permission = Permission::where('route', 'refund.seller_return_request_list')->first();
        if($permission){
            DB::table('role_permission')->where('permission_id', $permission->id)->delete();
            $permission->delete();
        }

        $menu = Backendmenu::where('route', 'refund.seller_return_request_list')->first();
        if($menu){
            BackendmenuUser::where('backendmenu_id', $menu->id)->delete();
            $menu->delete();
        }
    }
}
