<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Modules\Driver\Entities\Driver;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class DriverUpdateTest extends TestCase
{
    // Use WithoutMiddleware to bypass Auth for quick check, or better: actingAs
    // Assuming we have a user factory or existing user.
    // I'll try to use existing user if possible, or create one.
    // Actually, bypassing middleware might be easier if Route::resource is protected.
    // But let's try actingAs first.

    public function test_driver_update_works()
    {
        // 1. Create a dummy driver
        // We can't use factory if not defined, so manual create
        $driver = Driver::create([
            'name' => 'Test Driver',
            'phone' => '1112223334',
            'password' => bcrypt('password'),
            'is_active' => 1,
            'vehicle_number' => 'OLD-123',
            'seller_id' => null
        ]);

        // 2. Create a dummy admin user
        $admin = User::first(); // Assuming seed data exists
        if (!$admin) {
            $admin = new User();
            $admin->id = 1;
            $admin->name = 'Admin';
            $admin->email = 'admin@example.com';
            // Mock other fields if needed, or stick to bare minimum
        }

        // 3. Send PUT request
        $response = $this->actingAs($admin)
            ->put(route('drivers.update', $driver->id), [
                'name' => 'Updated Driver',
                'phone' => '1112223334', // Same phone
                'vehicle_number' => 'NEW-999',
                'seller_id' => 4, // Assuming seller 4 exists
                'is_active' => 1
            ]);

        // 4. Assertions
        $response->assertStatus(302); // Redirect
        // $response->assertSessionHas('success');

        $this->assertDatabaseHas('drivers', [
            'id' => $driver->id,
            'vehicle_number' => 'NEW-999',
            'seller_id' => 4
        ]);
        
        // Clean up
        $driver->delete();
    }
}
