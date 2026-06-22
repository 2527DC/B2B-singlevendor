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
        Schema::table('product_sku', function (Blueprint $table) {
            if (Schema::hasColumn('product_sku', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('product_sku', 'product_stock')) {
                $table->dropColumn('product_stock');
            }
        });

        Schema::table('seller_product_s_k_us', function (Blueprint $table) {
            if (Schema::hasColumn('seller_product_s_k_us', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('seller_product_s_k_us', 'product_stock')) {
                $table->dropColumn('product_stock');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_sku', function (Blueprint $table) {
            if (!Schema::hasColumn('product_sku', 'status')) {
                $table->integer('status')->default(1);
            }
            if (!Schema::hasColumn('product_sku', 'product_stock')) {
                $table->integer('product_stock')->default(0);
            }
        });

        Schema::table('seller_product_s_k_us', function (Blueprint $table) {
            if (!Schema::hasColumn('seller_product_s_k_us', 'status')) {
                $table->integer('status')->default(1);
            }
            if (!Schema::hasColumn('seller_product_s_k_us', 'product_stock')) {
                $table->integer('product_stock')->default(0);
            }
        });
    }
};
