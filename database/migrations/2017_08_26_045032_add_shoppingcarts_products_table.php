<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShoppingCartsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoppingcart_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('shopping_cart_id')->unsigned();
            $table->integer('amount');
            $table->decimal('price',9,2);
            $table->decimal('subTotal',9,2);

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('shopping_cart_id')->references('id')->on('shoppingcarts')->onDelete('cascade');

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
        Schema::dropIfExists('shoppingcart_product');
    }
}
