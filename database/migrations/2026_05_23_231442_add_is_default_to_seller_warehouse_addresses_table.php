<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsDefaultToSellerWarehouseAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seller_warehouse_addresses', function (Blueprint $table) {
            $table->boolean('is_default')->default(0)->after('warehouse_postcode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seller_warehouse_addresses', function (Blueprint $table) {
            $table->dropColumn('is_default');
        });
    }
}
