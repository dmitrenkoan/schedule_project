<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StaffInventoryTransferAddFieldServicePriceInventoryPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('staff_inventory_transfer', function (Blueprint $table) {
            $table->double('inventory_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('staff_inventory_transfer', function (Blueprint $table) {
            $table->dropColumn('inventory_price');
        });
    }
}
