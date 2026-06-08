<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateSellerReturnRequestMenuModule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('backendmenus')
            ->where('route', 'refund.seller_return_request_list')
            ->update(['module' => 'Refund']);

        DB::table('permissions')
            ->where('route', 'refund.seller_return_request_list')
            ->update(['module' => 'Refund']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('backendmenus')
            ->where('route', 'refund.seller_return_request_list')
            ->update(['module' => 'MultiVendor']);

        DB::table('permissions')
            ->where('route', 'refund.seller_return_request_list')
            ->update(['module' => 'MultiVendor']);
    }
}
