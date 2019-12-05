<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesAvailedLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_availed_lines', function (Blueprint $table) {
            $table->bigInteger('services_availed_id')->unsigned()->index();
            $table->bigInteger('medical_service_id')->unsigned()->index();
            $table->bigInteger('appointment_id')->unsigned()->index()->nullable();
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
        Schema::dropIfExists('services_availed_lines');
    }
}
