<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('customer_id')->nullable();
            $table->integer('table_id')->nullable();
            $table->enum('type',['Delivery','PickUp','Table']);
            $table->decimal('sub_total',15,2)->default(0.00);
            $table->decimal('discount',15,2)->default(0.00);    
            $table->decimal('vat',15,2)->default(0.00);
            $table->decimal('rounding_discount',15,2)->default(0.00);
            $table->decimal('net_total',15,2)->default(0.00);
            $table->tinyInteger('status');
            $table->integer('user_id');
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
        Schema::drop('orders');
    }
}
