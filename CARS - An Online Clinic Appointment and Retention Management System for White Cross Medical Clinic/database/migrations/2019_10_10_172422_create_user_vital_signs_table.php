<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserVitalSignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_vital_signs', function (Blueprint $table) {
            $table->bigInteger('patient_id')->unsigned()->index();
            $table->bigInteger('staff_id')->unsigned()->index();
            $table->bigInteger('vital_sign_id')->unsigned()->index();
            $table->string('value');
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
        Schema::dropIfExists('user_vital_signs');
    }
}
