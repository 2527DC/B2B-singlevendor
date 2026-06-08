<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Modules\RolePermission\Entities\Permission;
use Modules\SidebarManager\Entities\Backendmenu;
use Modules\SidebarManager\Entities\BackendmenuUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AddGoogleWorkspaceToSidebar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Create Permissions
        $parent_perm = Permission::create([
            'name' => 'Google Workspace',
            'route' => 'google-workspace.settings',
            'type' => 1,
            'module' => 'GoogleWorkspace',
            'status' => 1
        ]);

        $sub_perms = [
            [
                'name' => 'Settings',
                'route' => 'google-workspace.settings',
                'type' => 2,
                'parent_id' => $parent_perm->id,
                'module' => 'GoogleWorkspace',
                'status' => 1
            ],
            [
                'name' => 'Google Drive',
                'route' => 'google-workspace.drive',
                'type' => 2,
                'parent_id' => $parent_perm->id,
                'module' => 'GoogleWorkspace',
                'status' => 1
            ],
            [
                'name' => 'Google Sheets',
                'route' => 'google-workspace.sheets',
                'type' => 2,
                'parent_id' => $parent_perm->id,
                'module' => 'GoogleWorkspace',
                'status' => 1
            ]
        ];

        foreach ($sub_perms as $perm) {
            Permission::create($perm);
        }

        // 2. Assign Permissions to Roles (Superadmin/Admin/Seller)
        $roles = DB::table('roles')->whereIn('type', ['superadmin', 'admin', 'seller'])->pluck('id');
        $all_perm_ids = Permission::where('module', 'GoogleWorkspace')->pluck('id');
        foreach ($roles as $role_id) {
            foreach ($all_perm_ids as $perm_id) {
                DB::table('role_permission')->updateOrInsert(
                    ['role_id' => $role_id, 'permission_id' => $perm_id],
                    ['role_id' => $role_id, 'permission_id' => $perm_id]
                );
            }
        }

        // 3. Create Backend Menus
        if (Schema::hasTable('backendmenus')) {
            $parent_menu = Backendmenu::create([
                'parent_id' => 132, // System menu parent
                'is_admin' => 1,
                'is_seller' => 1,
                'icon' => 'fab fa-google',
                'module' => 'GoogleWorkspace',
                'name' => 'google_workspace.google_workspace',
                'route' => 'google-workspace.settings',
                'position' => 15
            ]);

            $sub_menus = [
                [
                    'parent_id' => $parent_menu->id,
                    'is_admin' => 1,
                    'is_seller' => 1,
                    'icon' => 'fas fa-cog',
                    'module' => 'GoogleWorkspace',
                    'name' => 'google_workspace.settings',
                    'route' => 'google-workspace.settings',
                    'position' => 1
                ],
                [
                    'parent_id' => $parent_menu->id,
                    'is_admin' => 1,
                    'is_seller' => 1,
                    'icon' => 'fas fa-hdd',
                    'module' => 'GoogleWorkspace',
                    'name' => 'google_workspace.drive',
                    'route' => 'google-workspace.drive',
                    'position' => 2
                ],
                [
                    'parent_id' => $parent_menu->id,
                    'is_admin' => 1,
                    'is_seller' => 1,
                    'icon' => 'fas fa-table',
                    'module' => 'GoogleWorkspace',
                    'name' => 'google_workspace.sheets',
                    'route' => 'google-workspace.sheets',
                    'position' => 3
                ]
            ];

            $created_submenus = [];
            foreach ($sub_menus as $menu) {
                $created_submenus[] = Backendmenu::create($menu);
            }

            // 4. Create Backend Menu Users
            $users = User::whereHas('role', function($q){
                $q->whereIn('type', ['superadmin', 'admin', 'seller']);
            })->get();

            foreach ($users as $user) {
                // Find system menu in backendmenu_users
                $system_user_menu = BackendmenuUser::where('user_id', $user->id)->where('backendmenu_id', 132)->first();
                if ($system_user_menu) {
                    $parent_user_menu = BackendmenuUser::create([
                        'parent_id' => $system_user_menu->id,
                        'user_id' => $user->id,
                        'backendmenu_id' => $parent_menu->id,
                        'position' => 15,
                        'status' => 1
                    ]);

                    foreach ($created_submenus as $index => $submenu) {
                        BackendmenuUser::create([
                            'parent_id' => $parent_user_menu->id,
                            'user_id' => $user->id,
                            'backendmenu_id' => $submenu->id,
                            'position' => $index + 1,
                            'status' => 1
                        ]);
                    }
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
        $perm_ids = Permission::where('module', 'GoogleWorkspace')->pluck('id');
        DB::table('role_permission')->whereIn('permission_id', $perm_ids)->delete();
        Permission::whereIn('id', $perm_ids)->delete();

        $menu_ids = Backendmenu::where('module', 'GoogleWorkspace')->pluck('id');
        BackendmenuUser::whereIn('backendmenu_id', $menu_ids)->delete();
        Backendmenu::whereIn('id', $menu_ids)->delete();
    }
}
