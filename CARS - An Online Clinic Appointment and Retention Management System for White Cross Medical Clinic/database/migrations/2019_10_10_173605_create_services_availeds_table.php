<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesAvailedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_availed', function (Blueprint $table) {
            $table->bigIncrements('services_availed_id');
            // $table->bigInteger('medical_service_id')->unsigned()->index();
            $table->bigInteger('patient_id')->unsigned()->index();
            $table->bigInteger('staff_id')->unsigned()->index();
            $table->decimal('discount', 2, 2)->nullable();
            $table->decimal('amount_paid', 8, 2);
            $table->decimal('total_amount', 8, 2);
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
        Schema::dropIfExists('services_availed');
    }
}
