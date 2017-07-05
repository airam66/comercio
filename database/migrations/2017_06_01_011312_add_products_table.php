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
            $table->string('code')->unique();
            $table->string('name');
            $table->integer('category_id')->unsigned();
            $table->integer('line_id')->unsigned();
            $table->integer('brand_id')->unsigned();
            $table->integer('wholesale_cant');
            $table->string('description');
            $table->integer('stock');
            $table->string('extension');
            $table->enum('status', ['activo','inactivo'])->default('activo');
            $table->decimal('purchase_price',9,2);
            $table->decimal('wholesale_price',9,2);
            $table->decimal('retail_price',9,2);
            
            //claves foraneas
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('line_id')->references('id')->on('lines')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

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
