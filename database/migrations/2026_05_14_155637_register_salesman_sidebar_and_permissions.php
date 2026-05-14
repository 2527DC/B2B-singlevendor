<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add to Sidebar for Seller (is_seller = 1, is_admin = 0)
        \Modules\SidebarManager\Entities\Backendmenu::updateOrCreate(
            ['route' => 'seller.salesmen.index'],
            [
                'parent_id' => 2, // Dashboard/General section
                'is_admin'  => 0,
                'is_seller' => 1,
                'icon'      => 'fas fa-users',
                'name'      => 'Salesmen',
                'position'  => 11, // Below Drivers
                'module'    => 'Seller',
            ]
        );

        // Add Permission for Role Management
        \Illuminate\Support\Facades\DB::table('permissions')->updateOrInsert(
            ['route' => 'seller.salesmen.index'],
            [
                'name' => 'Salesmen',
                'module' => 'Seller',
                'type' => 2,
                'status' => 1,
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \Modules\SidebarManager\Entities\Backendmenu::where('route', 'seller.salesmen.index')->delete();
        \Illuminate\Support\Facades\DB::table('permissions')->where('route', 'seller.salesmen.index')->delete();
    }
};
