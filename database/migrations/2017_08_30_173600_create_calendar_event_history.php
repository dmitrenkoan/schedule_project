<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarEventHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_event_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('calendar_id');
            // without discount
            $table->double('service_price');
            $table->double('expenses')->nullable();
            $table->double('worker_payment')->nullable();
            $table->char('service_name', 150);
            $table->char('staff_name', 150);
            $table->char('client_name', 150);
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
        Schema::dropIfExists('calendar_event_log');
    }
}
