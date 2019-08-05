<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('order_item_id');
            $table->string('order_product_name');
            $table->unsignedBigInteger('order_product_id');
            $table->foreign('order_product_id')->references("product_id")->on("product");
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references("order_id")->on("orders");
            $table->double('order_price');
            $table->double('quantity');
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
        Schema::dropIfExists('order_items');
    }
}
