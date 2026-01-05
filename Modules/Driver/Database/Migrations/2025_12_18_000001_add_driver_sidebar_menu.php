<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Modules\SidebarManager\Entities\Backendmenu;
use Modules\SidebarManager\Entities\BackendmenuUser;

class AddDriverSidebarMenu extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('backendmenus')) {
            return;
        }

        // Prevent duplicate menu
        if (Backendmenu::where('module', 'Driver')->exists()) {
            return;
        }

        Backendmenu::create([
            'is_admin'  => 1,
            'is_seller' => 0,
            'icon'      => 'ti-user',
            'parent_id' => null,   // ✅ Single top-level menu
            'position'  => 8,
            'module'    => 'Driver',
            'name'      => 'driver.driver',
            'route'     => 'driver.index',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (!Schema::hasTable('backendmenus')) {
            return;
        }

        $menuIds = Backendmenu::where('module', 'Driver')
            ->pluck('id')
            ->toArray();

        BackendmenuUser::whereIn('backendmenu_id', $menuIds)->delete();
        Backendmenu::whereIn('id', $menuIds)->delete();
    }
}
