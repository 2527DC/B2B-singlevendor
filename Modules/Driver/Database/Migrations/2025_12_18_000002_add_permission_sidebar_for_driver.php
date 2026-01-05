<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Modules\RolePermission\Entities\Permission;

class AddPermissionSidebarForDriver extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $permissionSql = [
            [
                'id'        => 227,              // 👈 Use the ID you showed
                'module_id' => 22,               // 👈 Driver module_id (from your table)
                'parent_id' => null,             // ✅ Single permission
                'name'      => 'Driver',
                'module'    => 'Driver',
                'route'     => 'driver.index',
                'type'      => 1,                // 1 = sidebar / module
            ],
        ];

        try {
            DB::table('permissions')->insert($permissionSql);
        } catch (\Exception $e) {
            // Ignore duplicate entry errors
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Permission::destroy([227]);
    }
}
