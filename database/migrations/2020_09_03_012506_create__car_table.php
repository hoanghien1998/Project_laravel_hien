<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->default('Active');
            $table->integer('seat');
            $table->float('startingPrice');
            $table->date('dueDate');
            $table->year('carYear');
            $table->string('carModel');
            $table->string('carBody');
            $table->dateTime('startBidTime');
            $table->integer('bidDuration');
            $table->string('description');
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
        Schema::dropIfExists('cars');
    }
}
