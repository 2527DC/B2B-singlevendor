<?php

namespace Modules\Driver\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SidebarManager\Entities\Backendmenu;

class DriverSidebarSeeder extends Seeder
{
    public function run()
    {
        Backendmenu::updateOrCreate(
            ['route' => 'drivers.index'],
            [
                'parent_id' => 2,
                'is_admin'  => 1,
                'is_seller' => 0,
                'icon'      => 'fas fa-car',
                'name'      => 'Drivers',
                'position'  => 10,
                'module'    => 'Driver',
            ]
        );
    }
}
