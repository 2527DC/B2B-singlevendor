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
        Schema::table('warehouse_product_stocks', function (Blueprint $table) {
            if (!Schema::hasColumn('warehouse_product_stocks', 'is_active')) {
                $table->boolean('is_active')->default(1)->after('stock');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('warehouse_product_stocks', function (Blueprint $table) {
            if (Schema::hasColumn('warehouse_product_stocks', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }
};
