<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Category::class, function (Faker\Generator $faker) {
   

    return [
        'name' => $faker->unique()->sentence,
        'description' => $faker->sentence,

        'status' => 'activo',
        'extension'=>"IMG-20170521-WA0045.jpg",

        /**'user_id'=>function(){
        	return factory(\App\User::class)->create()->id;
        }*/
        
    ];
});

$factory->define(App\Event::class, function (Faker\Generator $faker) {
   

    return [
        'name' => $faker ->unique()->sentence,
        'status' => 'activo',
        /**'user_id'=>function(){
            return factory(\App\User::class)->create()->id;
        }*/
        
    ];
});

$factory->define(App\Brand::class, function (Faker\Generator $faker) {
   

    return [
        'name' => $faker ->unique()->sentence,
        'status' => 'activo',
        /**'user_id'=>function(){
            return factory(\App\User::class)->create()->id;
        }*/
        
    ];
});

$factory->define(App\Line::class, function (Faker\Generator $faker) {
   

    return [
        'name' => $faker ->unique()->sentence,
        'status' => 'activo',
        /**'user_id'=>function(){
            return factory(\App\User::class)->create()->id;
        }*/
        
    ];
});

$factory->define(App\Porcentage::class, function (Faker\Generator $faker) {
   

    return [ 

        'wholesale_porcentage' => 10,
        'retail_porcentage' => 30,
        /**'user_id'=>function(){
            return factory(\App\User::class)->create()->id;
        }*/
        
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
   

    return [ 

        'code' => $faker->unique()->sentence,
        'name' => $faker->unique()->sentence,
        'category_id'=>1,
        'line_id'=>1,
        
        'brand_id'=>1,
        'wholesale_cant'=>20,
        'description'=>"descri´pcion bolsitas",
        'stock'=>6,
        'purchase_price'=>20,
        'status' => 'activo',
        'wholesale_price'=>40,
        'retail_price'=>50,
        'extension'=>"IMG-20170521-WA0045.jpg",
        /**'user_id'=>function(){
            return factory(\App\User::class)->create()->id;
        }*/
       
        
    ];
});

$factory->define(App\Provider::class, function (Faker\Generator $faker) {
   

    return [ 

        'cuit' => $faker->unique(),
        'name' => $faker->unique()->sentence,
        'address'=>$faker->sentence,
        'phone'=>"387154789124",
        'location'=>'salta',
        'provincia'=>'salta',   
        
    ];
});


$factory->define(App\Purchase::class, function (Faker\Generator $faker) {
   

    return [ 

        'total' => 120,
        'status'=>'pendiente'
       'provider_id'=>function(){
            return factory(\App\Provider::class)->create()->id;
        } 
        
    ];
});

$factory->define(App\PurchaseProduct::class, function (Faker\Generator $faker) {
   

    return [ 

        'price' => 12,
        'amount'=>1
        'subTotal'=>12
       'purchase_id'=>function(){
            return factory(\App\Purchase::class)->create()->id;
        } 
       'product_id'=>function(){
            return factory(\App\Product::class)->create()->id;
        } 
    ];
});