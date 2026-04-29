<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreatePinCodeConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pin_code_configurations', function (Blueprint $table) {
            $table->id();
            $table->integer('pincode_check_system_status')->default(0);
            $table->integer('delivery_days_status')->default(0);
            $table->timestamps();
        });

        DB::statement("INSERT INTO `pin_code_configurations` (`id`, `pincode_check_system_status`,`delivery_days_status`, `created_at`, `updated_at`) VALUES
        (1, 0, 0, '2023-04-20 12:40:47', '2023-04-20 12:40:47')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pin_code_configurations');
    }
}
