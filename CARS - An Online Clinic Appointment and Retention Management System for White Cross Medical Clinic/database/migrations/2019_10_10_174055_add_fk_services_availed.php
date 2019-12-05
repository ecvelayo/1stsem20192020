<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkServicesAvailed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services_availed', function (Blueprint $table) {
            // $table->foreign('medical_service_id')->references('medical_service_id')->on('medical_services')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('staff_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services_availed', function (Blueprint $table) {
            // $table->dropForeign(['medical_service_id']);
            $table->dropForeign(['patient_id']);
            $table->dropForeign(['staff_id']);
        });
    }
}
