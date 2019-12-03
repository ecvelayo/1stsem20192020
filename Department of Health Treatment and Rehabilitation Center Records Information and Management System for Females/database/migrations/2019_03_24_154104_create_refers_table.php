<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refers', function (Blueprint $table) {
            $table->increments('id');
            $table->date('ref_date');
            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->string('ref_at');
            $table->string('ref_reason');
            $table->integer('ref_by')->unsigned();
            $table->foreign('ref_by')->references('id')->on('users');
            $table->string('contact_person');
            $table->string('recommen');
            $table->date('ref_back_date')->nullable();
            $table->string('ref_back_by')->nullable();
            $table->integer('accepted_by')->unsigned()->nullable();
            $table->foreign('accepted_by')->references('id')->on('users');           
             $table->string('ref_slip_return')->nullable();
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
        Schema::dropIfExists('refers');
    }
}
