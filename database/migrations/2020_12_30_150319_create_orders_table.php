<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->string('session_id')->nullable();
            $table->boolean('registered')->default('0');
            $table->integer('delivery_add_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->dateTime('date');
            $table->string('status')->default('test')->nullable();
            $table->integer('total')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
