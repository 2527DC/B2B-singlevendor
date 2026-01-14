<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id(); // Primary key 'id'
            $table->string('name'); // Driver name
            $table->string('phone')->unique(); // Unique phone
            $table->string('email')->unique()->nullable(); // Email optional
            $table->string('password'); // Hashed password
            $table->boolean('is_active')->default(true); // Active flag
            $table->text('address')->nullable(); // Optional address
            $table->string('login_otp', 6)->nullable(); // OTP
            $table->timestamp('otp_expires_at')->nullable(); // OTP expiry datetime
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
