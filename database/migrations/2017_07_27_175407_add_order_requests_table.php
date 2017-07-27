<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('advance');
            $table->dateTime('delivery_date');
            $table->decimal('total',9,2);
            $table->enum('status', ['pendiente','proceso','preparado','entregado','cancelado'])->default('pendiente');
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->timestamps();
        });


        Schema::create('order_requests_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('request_id')->unsigned();
            $table->integer('amount');
            $table->decimal('price',9,2);
            $table->decimal('subTotal',9,2);

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('request_id')->references('id')->on('order_requests')->onDelete('cascade');

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
        Schema::dropIfExists('order_requests');
    }
}
