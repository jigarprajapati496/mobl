<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSessionIdFieldDeliveryRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_requests', function (Blueprint $table) {
            $table->string("session_id")->nullable()->after("merchant_id");
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
            $table->dropColumn('session_id');
        });
    }
}
