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
        'extension'=>"IMG-20170521-WA0045.jpg",
        'status' => 'activo',
        /**'user_id'=>function(){
        	return factory(\App\User::class)->create()->id;
        }*/
        
    ];
});

$factory->define(App\Event::class, function (Faker\Generator $faker) {
   

    return [
        'name' => $faker ->unique()->sentence,
        'status' => $faker->randomElement($array = array ('active','inactive')),
        /**'user_id'=>function(){
            return factory(\App\User::class)->create()->id;
        }*/
        
    ];
});

$factory->define(App\Brand::class, function (Faker\Generator $faker) {
   

    return [
        'name' => $faker ->unique()->sentence,
        'status' => $faker->randomElement($array = array ('active','inactive')),
        /**'user_id'=>function(){
            return factory(\App\User::class)->create()->id;
        }*/
        
    ];
});

$factory->define(App\Line::class, function (Faker\Generator $faker) {
   

    return [
        'name' => $faker ->unique()->sentence,
        'status' => $faker->randomElement($array = array ('active','inactive')),
        /**'user_id'=>function(){
            return factory(\App\User::class)->create()->id;
        }*/
        
    ];
});

$factory->define(App\Porcentage::class, function (Faker\Generator $faker) {
   

    return [ 

        'wholesale_porcentage' => 10,
        'retail_porcentage' => 10,
        /**'user_id'=>function(){
            return factory(\App\User::class)->create()->id;
        }*/
        
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
   

    return [ 

        'code' => 00000001,
        'name' => $faker ->unique()->sentence,
        'category_id'=>1,
        'line_id'=>1,
        'event_id'=>1,
        'brand_id'=>1,
        'wholesale_cant'=>20,
        'description'=>"descri´pcion bolsitas",
        'stock'=>0,
        'purchase_price'=>20,
        'status' => $faker->randomElement($array = array ('active','inactive')),
        'wholesale_price'=>56,
        'retail_price'=>58,
        'extension'=>"IMG-20170521-WA0045.jpg"
        /**'user_id'=>function(){
            return factory(\App\User::class)->create()->id;
        }*/
       
        
    ];
});


