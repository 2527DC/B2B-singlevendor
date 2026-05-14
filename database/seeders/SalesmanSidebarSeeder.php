<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\SidebarManager\Entities\Backendmenu;

class SalesmanSidebarSeeder extends Seeder
{
    public function run()
    {
        // Add to Sidebar for Seller (is_seller = 1, is_admin = 0)
        Backendmenu::updateOrCreate(
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
        DB::table('permissions')->updateOrInsert(
            ['route' => 'seller.salesmen.index'],
            [
                'name' => 'Salesmen',
                'module' => 'Seller',
                'type' => 2,
                'status' => 1,
            ]
        );
    }
}
