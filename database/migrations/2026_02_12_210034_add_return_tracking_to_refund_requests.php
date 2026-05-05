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
        Schema::table('refund_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('refund_requests', 'driver_id')) {
                $table->bigInteger('driver_id')->nullable()->after('customer_id');
            }
            if (!Schema::hasColumn('refund_requests', 'return_status')) {
                $table->tinyInteger('return_status')->default(0)->after('driver_id');
            }
            if (!Schema::hasColumn('refund_requests', 'assigned_at')) {
                $table->timestamp('assigned_at')->nullable()->after('return_status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('refund_requests', function (Blueprint $table) {
            $table->dropColumn(['driver_id', 'return_status', 'assigned_at']);
        });
    }
};
