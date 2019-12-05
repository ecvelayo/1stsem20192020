<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('appointment_id');
            $table->date('appointment_date');
            $table->bigInteger('doctor_schedule_id')->unsigned()->index();
            $table->bigInteger('staff_id')->unsigned()->index()->nullable();
            $table->bigInteger('patient_id')->unsigned()->index();
            $table->string('remarks')->nullable();
            $table->enum('status', ['DONE', 'ONGOING', 'PENDING', 'CANCELLED', 'APPROVED'])->default('PENDING');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
