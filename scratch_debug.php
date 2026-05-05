<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Modules\Driver\Entities\Driver;

try {
    $drivers = Driver::all();
    foreach ($drivers as $driver) {
        $attrs = ['name', 'phone', 'vehicle_number', 'seller_id'];
        foreach ($attrs as $attr) {
            if (is_array($driver->$attr)) {
                echo "Driver ID {$driver->id} attribute {$attr} is array: " . json_encode($driver->$attr) . "\n";
            }
        }
        if ($driver->seller_id) {
            $seller = $driver->seller;
            if ($seller) {
                if (is_array($seller->first_name)) echo "Driver ID {$driver->id} seller first_name is array\n";
                if (is_array($seller->last_name)) echo "Driver ID {$driver->id} seller last_name is array\n";
                if (is_array($seller->email)) echo "Driver ID {$driver->id} seller email is array\n";
            }
        }
    }
    
    $sellers = \App\Models\User::activeSeller()->get();
    foreach ($sellers as $seller) {
        if (is_array($seller->first_name)) echo "Seller ID {$seller->id} first_name is array\n";
    }
    
    echo "Check completed.\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
