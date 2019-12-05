<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkUserVitalSigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_vital_signs', function (Blueprint $table) {
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('staff_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('vital_sign_id')->references('vital_sign_id')->on('vital_signs')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_vital_signs', function (Blueprint $table) {
            $table->dropForeign(['patient_id']);
            $table->dropForeign(['staff_id']);
            $table->dropForeign(['vital_sign_id']);
        });
    }
}
