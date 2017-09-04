<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InventoryTransferChangeFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_transfer', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->char('staff_name');
            $table->char('inventory_name');
            $table->char('unit_short_name');
            $table->double('inventory_price');
            $table->integer('salons_id');
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
            $table->integer('user_id');
            $table->dropColumn('staff_name');
            $table->dropColumn('inventory_name');
            $table->dropColumn('unit_short_name');
            $table->dropColumn('salons_id');
            $table->dropColumn('inventory_price');
        });
    }
}
