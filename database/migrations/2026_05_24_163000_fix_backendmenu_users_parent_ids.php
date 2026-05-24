<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Seed the Drivers menu so it exists in backendmenus
        try {
            Artisan::call('db:seed', [
                '--class' => 'Modules\\Driver\\Database\\Seeders\\DriverSidebarSeeder'
            ]);
        } catch (\Throwable $e) {
            // Fallback if class does not exist or fails, preventing migration crash
        }

        // 2. Retrieve all active admin menus (is_admin = 1 and not part of MultiVendor module)
        $activeAdminMenus = DB::table('backendmenus')
            ->where('is_admin', 1)
            ->where(function($query) {
                $query->whereNull('module')
                      ->orWhere('module', '!=', 'MultiVendor');
            })->get();

        $superAdminUser = DB::table('users')->where('id', 1)->first();

        if ($superAdminUser) {
            foreach ($activeAdminMenus as $menu) {
                // Ensure the menu exists in backendmenu_users for user 1
                $exists = DB::table('backendmenu_users')
                    ->where('user_id', 1)
                    ->where('backendmenu_id', $menu->id)
                    ->exists();

                if (!$exists) {
                    DB::table('backendmenu_users')->insert([
                        'user_id' => 1,
                        'parent_id' => null, // Will be fixed below
                        'status' => 1,
                        'backendmenu_id' => $menu->id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                } else {
                    // Make sure it is active (status = 1)
                    DB::table('backendmenu_users')
                        ->where('user_id', 1)
                        ->where('backendmenu_id', $menu->id)
                        ->update(['status' => 1]);
                }
            }
        }

        // 3. Fix the parent_id mappings in backendmenu_users for all entries of all users
        $users = DB::table('backendmenu_users')
            ->distinct()
            ->pluck('user_id');

        foreach ($users as $userId) {
            $userMenus = DB::table('backendmenu_users')
                ->where('user_id', $userId)
                ->get();

            foreach ($userMenus as $userMenu) {
                // Find matching backendmenu
                $backendMenu = DB::table('backendmenus')
                    ->where('id', $userMenu->backendmenu_id)
                    ->first();

                if ($backendMenu) {
                    if (is_null($backendMenu->parent_id)) {
                        DB::table('backendmenu_users')
                            ->where('id', $userMenu->id)
                            ->update(['parent_id' => null]);
                    } else {
                        // Find the parent row in backendmenu_users for the SAME user
                        $parentUserMenu = DB::table('backendmenu_users')
                            ->where('user_id', $userId)
                            ->where('backendmenu_id', $backendMenu->parent_id)
                            ->first();

                        if ($parentUserMenu) {
                            DB::table('backendmenu_users')
                                ->where('id', $userMenu->id)
                                ->update(['parent_id' => $parentUserMenu->id]);
                        } else {
                            DB::table('backendmenu_users')
                                ->where('id', $userMenu->id)
                                ->update(['parent_id' => null]);
                        }
                    }
                }
            }
        }

        // 4. Clear all caches to make sure it loads instantly
        try {
            Artisan::call('cache:clear');
        } catch (\Throwable $e) {
            // Ignore if cache clear fails
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No rollback needed
    }
};
