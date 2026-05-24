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
        // 1. Drop the Multi-Vendor specific tables safely
        Schema::disableForeignKeyConstraints();
        
        $tables = [
            'follow_seller',
            'package_wise_seller_commisions',
            'seller_subcriptions',
            'sub_seller_accesses',
            'sub_sellers',
            'seller_commissions',
            'seller_return_addresses',
            'seller_bank_accounts',
            'seller_business_information',
            'seller_accounts'
        ];

        foreach ($tables as $table) {
            Schema::dropIfExists($table);
        }

        Schema::enableForeignKeyConstraints();

        // 2. Define restricted B2B menus
        $restrictedMenus = [
            'common.customer',
            'order.order_manages',
            'order.order_manage',
            'refund.refund_manage',
            'product.product_manage',
            'product.products',
            'review.review',
            'shipping.shipping',
            'Drivers',
            'checkpincode.check_pincode',
            'checkpincode.pincode_list',
            'checkpincode.add_new_pincode',
            'checkpincode.bulk_upload',
            'checkpincode.pincode_config'
        ];

        // 3. Restore flags in backendmenus table to allow admin access
        DB::table('backendmenus')
            ->whereIn('name', $restrictedMenus)
            ->update([
                'is_admin' => 1
            ]);

        // 4. Re-populate these menus in backendmenu_users for admin and non-seller users
        $menus = DB::table('backendmenus')->whereIn('name', $restrictedMenus)->get();
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
        // No rollback required as this is a cleanup/restoration migration.
    }
};
