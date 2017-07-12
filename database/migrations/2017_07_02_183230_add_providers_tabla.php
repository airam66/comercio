<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProvidersTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('cuit');
            $table->string('address');
            $table->string('province');
            $table->string('location');
            $table->double('phone');
            $table->string('email')->unique();
            $table->decimal('bill',9,2);
            $table->enum('status', ['activo','inactivo'])->default('activo');
            $table->timestamps();
        });

        Schema::create('providers_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('provider_id')->unsigned();


            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('cascade');

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
        Schema::dropIfExists('providers_products');
        Schema::dropIfExists('providers');
    }

}
