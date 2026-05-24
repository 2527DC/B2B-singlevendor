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

        // 1. Update the flags in backendmenus table
        DB::table('backendmenus')
            ->whereIn('name', $restrictedMenus)
            ->update([
                'is_admin' => 0,
                'is_seller' => 1
            ]);

        // 2. Remove these menus from backendmenu_users for non-seller roles
        $menuIds = DB::table('backendmenus')->whereIn('name', $restrictedMenus)->pluck('id');
        
        if ($menuIds->count() > 0) {
            DB::table('backendmenu_users')
                ->whereIn('backendmenu_id', $menuIds)
                ->whereIn('user_id', function ($query) {
                    $query->select('id')->from('users')->where('role_id', '!=', 5);
                })
                ->delete();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seller_only', function (Blueprint $table) {
            //
        });
    }
};
