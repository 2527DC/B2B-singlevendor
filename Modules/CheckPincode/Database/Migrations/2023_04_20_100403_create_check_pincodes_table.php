<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckPincodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_pincodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('pincode');
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->integer('delivery_days')->default(1);
            $table->integer('cash_on_delivery')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_pincodes');
    }
}
