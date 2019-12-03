<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgressNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return voidAAAAAAA
     */
    public function up()
    {
        Schema::create('progress_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('date_time');
            $table->integer('service_id')->unsigned()->nullable();
            $table->foreign('service_id')->references('id')->on('services');
            $table->integer('note_by')->unsigned();
            $table->foreign('note_by')->references('id')->on('users');
            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->integer('tooth_no')->nullable();
            $table->text('diagnose')->nullable();
            $table->text('service_rendered')->nullable();
            $table->text('notes');
            $table->string('role_type');
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
        Schema::dropIfExists('progress_notes');
    }
}
