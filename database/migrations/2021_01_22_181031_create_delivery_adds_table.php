<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryAddsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_adds', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('add1');
            $table->string('add2')->nullable();
            $table->string('country');
            $table->string('city');
            $table->string('zipCode');
            $table->string('phone_number');
            $table->string('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_adds');
    }
}
