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
        if (!Schema::hasTable('seller_warehouse_addresses')) {
            Schema::create('seller_warehouse_addresses', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('warehouse_name');
                $table->string('warehouse_address');
                $table->string('warehouse_phone');
                $table->integer('warehouse_country');
                $table->integer('warehouse_state');
                $table->integer('warehouse_city');
                $table->string('warehouse_postcode');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_warehouse_addresses');
    }
};
