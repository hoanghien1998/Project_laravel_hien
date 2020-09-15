<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyBetweenCarsTableAndUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->foreign('created_by', 'fk_cars_created_by')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign('fk_cars_created_by');
        });
    }
}
