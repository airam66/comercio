<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code');
            $table->string('name');
            $table->integer('category_id')->unsigned();
            $table->integer('line_id')->unsigned();
            $table->integer('brand_id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->string('description');
            $table->integer('stock');
            $table->string('extension')->nullable();
            $table->enum('status', ['active','inactive'])->default('active');

            //claves foraneas
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('line_id')->references('id')->on('lines')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');

            $table->timestamps();
        });

        //lista de precios de un producto
        Schema::create('products_list_price', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('products_id')->unsigned();//cambiar a singular
            $table->decimal('purchase_price',9,2);//recio de compra
            $table->decimal('wholesale_price',9,2);//precio de venta por mayor
            $table->decimal('retail_price',9,2);//recio de venta por menor

            $table->foreign('products_id')->references('id')->on('products');

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
        Schema::dropIfExists('products');
    }
}
