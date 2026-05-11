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
        \DB::table('otp_configurations')->insert([
            'key' => 'login_with_otp_only',
            'value' => 0
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \DB::table('otp_configurations')->where('key', 'login_with_otp_only')->delete();
    }
};
