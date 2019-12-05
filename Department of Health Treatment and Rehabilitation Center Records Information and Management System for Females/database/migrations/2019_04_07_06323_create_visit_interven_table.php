<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitIntervenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visit_intervens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_event')->unsigned()->nullable();
            $table->foreign('patient_event')->references('id')->on('patient_event_lists');
            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->integer('interven_id')->unsigned();
            $table->foreign('interven_id')->references('id')->on('interventions');
            $table->integer('child_interven_id')->unsigned()->nullable();
            $table->foreign('child_interven_id')->references('id')->on('child_interventions');
            $table->integer('event_id')->unsigned()->nullable();
            $table->foreign('event_id')->references('id')->on('events');
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('visit_interven');
    }
}
