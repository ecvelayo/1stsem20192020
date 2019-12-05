<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_vehicle', function (Blueprint $table) {
            $table->increments('assign_id');
            $table->integer('driver_id')->unsigned();
            $table->foreign('driver_id')->references('driver_id')->on('driver');
            $table->integer('vehicle_id')->unsigned();
            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicle_info');
            $table->dateTime('datetime_assigned');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assign_vehicle');
    }
}
