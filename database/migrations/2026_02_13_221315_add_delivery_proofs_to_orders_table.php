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
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'otp')) {
                $table->string('otp', 6)->nullable()->after('tax_amount');
            }
            if (!Schema::hasColumn('orders', 'photo_proof')) {
                $table->string('photo_proof')->nullable()->after('otp');
            }
            if (!Schema::hasColumn('orders', 'signature_proof')) {
                $table->string('signature_proof')->nullable()->after('photo_proof');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
