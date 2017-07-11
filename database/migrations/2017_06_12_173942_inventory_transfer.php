<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InventoryTransfer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_transfer', function (Blueprint $table) {
            $table->Increments('id');
            $table->double('quantity');
            $table->integer('user_id');
            $table->integer('staff_id');
            $table->integer('inventory_id');
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
        Schema::table('inventory_transfer', function (Blueprint $table) {
            //
        });
    }
}
