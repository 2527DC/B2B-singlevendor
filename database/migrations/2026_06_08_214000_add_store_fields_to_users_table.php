<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStoreFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'store_name')) {
                $table->string('store_name')->nullable()->after('last_name');
            }
            if (!Schema::hasColumn('users', 'store_image')) {
                $table->string('store_image')->nullable()->after('avatar');
            }
            if (!Schema::hasColumn('users', 'document')) {
                $table->string('document')->nullable()->after('store_image');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'store_name')) {
                $table->dropColumn('store_name');
            }
            if (Schema::hasColumn('users', 'store_image')) {
                $table->dropColumn('store_image');
            }
            if (Schema::hasColumn('users', 'document')) {
                $table->dropColumn('document');
            }
        });
    }
}
