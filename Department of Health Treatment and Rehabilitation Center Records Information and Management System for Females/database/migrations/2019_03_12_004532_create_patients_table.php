<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('patient_id');
            $table->string('admission_no');
            $table->string('fname');
            $table->string('lname');
            $table->string('mname')->nullable();
            $table->integer('age')->nullable();
            $table->date('birthdate');
            $table->integer('birthorder')->nullable();
            $table->integer('address_id')->unsigned();
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->string('contact')->nullable();
            $table->integer('gender')->nullable()->unsigned();
            $table->foreign('gender')->references('id')->on('genders');
            $table->integer('civil_status')->unsigned();
            $table->foreign('civil_status')->references('id')->on('civil__statuses');
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->integer('patient_type')->unsigned()->nullable();
            $table->foreign('patient_type')->references('id')->on('case__types');
            $table->integer('jail')->unsigned()->nullable();
            $table->foreign('jail')->references('id')->on('city__jails');
            $table->string('caseno')->nullable();
            $table->string('status')->nullable();
            $table->integer('inactive')->nullable();
            $table->text('remarks')->nullable();
            $table->date('date_admitted');
            $table->integer('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->string('flag')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
