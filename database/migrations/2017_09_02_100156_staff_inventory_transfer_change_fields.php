<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StaffInventoryTransferChangeFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('staff_inventory_transfer', function (Blueprint $table) {
            $table->char('inventory_name');
            $table->char('staff_name');
            $table->char('service_name');
            $table->integer('salons_id');
            $table->integer('service_id');
            $table->char('unit_short_name');
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
            $table->dropColumn('inventory_name');
            $table->dropColumn('staff_name');
            $table->dropColumn('service_name');
            $table->dropColumn('service_id');
            $table->dropColumn('salons_id');
            $table->dropColumn('unit_short_name');
        });
    }
}
