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
        if (!Schema::hasColumn('refund_requests', 'request_type')) {
            Schema::table('refund_requests', function (Blueprint $table) {
                $table->tinyInteger('request_type')->default(1)->comment('1: Customer Refund, 2: Driver Return')->after('id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('refund_requests', function (Blueprint $table) {
            //
        });
    }
};
