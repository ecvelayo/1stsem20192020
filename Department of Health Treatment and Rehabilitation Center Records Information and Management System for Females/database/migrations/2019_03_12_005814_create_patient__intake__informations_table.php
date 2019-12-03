<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientIntakeInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient__intake__informations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->integer('emergency_id')->unsigned();
            $table->foreign('emergency_id')->references('id')->on('emergency__persons');
            $table->integer('educational_attainment')->unsigned();
            $table->foreign('educational_attainment')->references('id')->on('educational__attainments');
            $table->integer('employment_status')->unsigned();
            $table->foreign('employment_status')->references('id')->on('employment__statuses');
            $table->string('spouse')->nullable();
            $table->string('father')->nullable();
            $table->string('mother')->nullable();
            $table->text('presenting_problems');
            $table->text('impression');
            $table->string('date');
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
        Schema::dropIfExists('patient__intake__informations');
    }
}
