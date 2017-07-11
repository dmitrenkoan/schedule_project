<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StaffSalary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_salary', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('staff_id');
            $table->integer('salons_id');
            $table->integer('service_id');
            $table->integer('payment');
            $table->dateTime('service_date_begin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff_salary');
    }
}
