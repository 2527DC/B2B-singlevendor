<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Product\Database\Seeders\BrandTableSeeder;
use Modules\Product\Database\Seeders\CategorySeedTableSeeder;
use Modules\Product\Database\Seeders\ProductDatabaseSeeder;
//dhanush
use Modules\Driver\Database\Seeders\DriverSidebarSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(CategorySeedTableSeeder::class);
        $this->call(BrandTableSeeder::class);
        $this->call(ProductDatabaseSeeder::class);
        $this->call(DriverSidebarSeeder::class);//dhanush
    }
}
