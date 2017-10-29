<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id');
            $table->integer('order_id');
            $table->decimal('quantity',15,2);
            $table->decimal('price',15,2);
            $table->decimal('discount',15,2);
            $table->decimal('total',15,2);
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
        Schema::drop('menu_order');
    }
}
