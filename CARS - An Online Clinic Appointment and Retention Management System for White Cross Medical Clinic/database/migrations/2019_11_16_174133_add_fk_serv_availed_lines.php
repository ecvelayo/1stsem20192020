<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkServAvailedLines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services_availed_lines', function (Blueprint $table) {
            $table->foreign('services_availed_id')->references('services_availed_id')->on('services_availed');
            $table->foreign('medical_service_id')->references('medical_service_id')->on('medical_services');
            $table->foreign('appointment_id')->references('appointment_id')->on('appointments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services_availed_lines', function (Blueprint $table) {
            $table->dropForeign(['services_availed_id']);
            $table->dropForeign(['medical_service_id']);
            $table->dropForeign(['appointment_id']);
        });
    }
}
