<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCotillonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotillones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description_AboutUs');         
            $table->text('address');
            $table->string('phones');
            $table->string('email');
            $table->string('facebook');
            $table->string('business_hours');

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
        Schema::dropIfExists('cotillones');
    }
}
