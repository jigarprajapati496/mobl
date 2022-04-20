<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForigenKeyMerchantId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_requests', function (Blueprint $table) {
            $table->foreignId('merchant_id')->after('id')->nullable();
            $table->foreign('merchant_id')->references('id')->on('merchants');
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
            $table->dropForeign('delivery_requests_merchant_id_foreign');
            $table->dropColumn('merchant_id');
        });
    }
}
