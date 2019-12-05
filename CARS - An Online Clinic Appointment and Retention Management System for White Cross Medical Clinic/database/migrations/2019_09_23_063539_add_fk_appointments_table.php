<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreign('doctor_schedule_id')->references('doctor_schedule_id')->on('doctor_schedules')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('staff_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['doctor_schedule_id']);
            $table->dropForeign(['staff_id']);
            $table->dropForeign(['patient_id']);
        });
    }
}
