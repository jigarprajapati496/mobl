<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldWeightInDeliveryRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_requests', function (Blueprint $table) {
            $table->decimal("weight",15,2)->nullable()->after("item_description");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delivery_requests', function (Blueprint $table) {
            $table->dropColumn('weight');
        });
    }
}
