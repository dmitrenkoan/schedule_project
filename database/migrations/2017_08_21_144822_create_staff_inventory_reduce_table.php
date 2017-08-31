<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffInventoryReduceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_inventory_transfer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inventory_id');
            $table->integer('staff_id');
            $table->integer('service_id');
            $table->double('quantity', 15, 8);
            $table->double('quantity_left' , 15 ,8);
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
        Schema::dropIfExists('staff_inventory_transfer');
    }
}
