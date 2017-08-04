<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrdersTable extends Migration
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
            $table->dateTime('delivery_date');
            $table->decimal('total',9,2);
            $table->enum('status', ['pendiente','proceso','preparado','entregado','cancelado'])->default('pendiente');
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->timestamps();
        });


        Schema::create('order_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->integer('amount');
            $table->decimal('price',9,2);
            $table->decimal('subTotal',9,2);

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

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
        Schema::dropIfExists('payments');
        Schema::dropIfExists('orders');
    }
}
