<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_requests', function (Blueprint $table) {
            $table->id();
            $table->string('full_name',150);
            $table->string('phone_number',15);
            $table->string('percletype',50);
            $table->date('pickup_date');
            $table->time('pickup_time');
            $table->string('pickup_address');
            $table->string('drop_address');
            $table->text('item_description')->nullable();
            $table->string("payment_mode",20);
            $table->integer('estimate_time'); //in minute
            $table->decimal("cost",15,2);
            $table->tinyInteger('is_approve');
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
        Schema::dropIfExists('delivery_requests');
    }
}
