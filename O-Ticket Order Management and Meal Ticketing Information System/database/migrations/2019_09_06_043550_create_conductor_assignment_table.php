<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConductorAssignmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conductor_assignment', function (Blueprint $table) {
            $table->increments('con_ass_id');
            $table->integer('driver_id')->unsigned();
            $table->foreign('driver_id')->references('driver_id')->on('driver');
            $table->integer('conductor_id')->unsigned();
            $table->foreign('conductor_id')->references('conductor_id')->on('conductor');
            $table->boolean('status');
            $table->date('date_assigned');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conductor_assignment');
    }
}
