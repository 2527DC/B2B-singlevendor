<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Update backendmenus for Salesmen and Warehouses to allow admin access
        DB::table('backendmenus')
            ->where('route', 'seller.salesmen.index')
            ->update([
                'is_admin' => 1
            ]);

        DB::table('backendmenus')
            ->where('route', 'seller.warehouses.index')
            ->update([
                'is_admin' => 1,
                'module' => 'Seller' // Change from MultiVendor to Seller so it isn't filtered out
            ]);

        // 2. Link these menus in backendmenu_users for admin and other non-seller roles
        $routes = ['seller.salesmen.index', 'seller.warehouses.index'];
        $menus = DB::table('backendmenus')->whereIn('route', $routes)->get();
        $adminUsers = DB::table('users')->where('role_id', '!=', 5)->get();

        foreach ($menus as $menu) {
            foreach ($adminUsers as $user) {
                $exists = DB::table('backendmenu_users')
                    ->where('user_id', $user->id)
                    ->where('backendmenu_id', $menu->id)
                    ->exists();

                if (!$exists) {
                    DB::table('backendmenu_users')->insert([
                        'user_id' => $user->id,
                        'parent_id' => $menu->parent_id,
                        'status' => 1,
                        'backendmenu_id' => $menu->id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert is_admin flags
        DB::table('backendmenus')
            ->where('route', 'seller.salesmen.index')
            ->update(['is_admin' => 0]);

        DB::table('backendmenus')
            ->where('route', 'seller.warehouses.index')
            ->update(['is_admin' => 0, 'module' => 'MultiVendor']);
    }
};
