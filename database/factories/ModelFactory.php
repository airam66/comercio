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
use App\Product;

$factory->define(App\Role::class, function (Faker\Generator $faker) {


    return [
        'name' => $faker->name,

    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => 'Administrador',
        'email' => $faker->unique()->safeEmail,
        'cuit'=>'27357817310',
        'address'=> 'Ragone N°3',
        'location'=>'Salta',
        'phone'=>0,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10), 
        'role_id'=>function(){
            return factory(\App\Role::class)->create()->id;
        }, 
    ];
});


$factory->define(App\Category::class, function (Faker\Generator $faker) {
   

    return [
        'name' => $faker->unique()->name,
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
        'category_id'=>function(){
            return factory(\App\Category::class)->create()->id;
        }, 
        'line_id'=>function(){
            return factory(\App\Line::class)->create()->id;
        }, 
        
       'brand_id'=>function(){
            return factory(\App\Brand::class)->create()->id;
        }, 
        'wholesale_cant'=>10,
        'description'=>$faker->unique()->sentence,
        'stock'=>100,
        'purchase_price'=>$faker->randomNumber(2),
        'status' => 'activo',
        'wholesale_price'=>$faker->randomNumber(2),
        'retail_price'=>$faker->randomNumber(2),
        'extension'=>"IMG-20170521-WA0045.jpg",
        /**'user_id'=>function(){
            return factory(\App\User::class)->create()->id;
        }*/
       
        
    ];
});

$factory->define(App\Provider::class, function (Faker\Generator $faker) {
   

    return [ 

        'cuit' => $faker->unique()->creditCardNumber,
        'name' => $faker->unique()->name,
        'address'=>$faker->address,
        'location'=>$faker->city,
        'province'=>$faker->country,
        'phone'=>3874921675,
        'bill'=>$faker->randomNumber(2),
        'status' => 'activo',
        'email'=>$faker->safeEmail,
       
    ];
});


$factory->define(App\Purchase::class, function (Faker\Generator $faker) {
   

    return [ 

        'total' => $faker->randomNumber(2),
        'status'=>'pendiente',
       'provider_id'=>function(){
            return factory(\App\Provider::class)->create()->id;
        } 
        
    ];
});

$factory->define(App\PurchaseProduct::class, function (Faker\Generator $faker) {
   

    return [ 
        'purchase_id'=>function(){
            return factory(\App\Purchase::class)->create()->id;
        }, 
       'product_id'=>function(){
            return factory(\App\Product::class)->create()->id;
        }, 
        'price' =>function (array $purchaseProduct) {
           return App\Product::find($purchaseProduct['product_id'])->purchase_price;
        },
        'amount'=>1,
        'subTotal'=>$faker->randomNumber(2),
      
    ];
});

$factory->define(App\Client::class, function (Faker\Generator $faker) {
   

    return [ 

        'cuil' => $faker->unique()->creditCardNumber,
        'name' => $faker->unique()->name,
        'address'=>$faker->address,
        'location'=>$faker->city,
        'phone'=>3874921675,
        'bill'=>$faker->randomNumber(2),
        'status' => 'activo',
        'email'=>$faker->safeEmail,
       
    ];
});


$factory->define(App\Order::class, function (Faker\Generator $faker) {
   

    return [ 

        'total' => $faker->randomNumber(2),
        'status'=>'pendiente',
        'delivery_date'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'client_id'=>function(){
            return factory(\App\Client::class)->create()->id;
        } 
        
    ];
});


$factory->define(App\Payment::class, function (Faker\Generator $faker) {
   

    return [ 

        'order_id'=>function(){
            return factory(\App\Order::class)->create()->id;
        },
        'amount_paid'=>$faker->randomNumber(2),
        'balance_paid'=>$faker->randomNumber(2),
        
    ];
});


$factory->define(App\OrderProduct::class, function (Faker\Generator $faker) {
   

    return [ 
        'order_id'=>function(){
            return factory(\App\Order::class)->create()->id;
        }, 
       'product_id'=>function(){
            return factory(\App\Product::class)->create()->id;
        }, 
        'price' =>function (array $orderProduct) {
            return App\Product::find($orderProduct['product_id'])->retail_price;
        },
        'amount'=>$faker->randomNumber(1),
        'subTotal'=>$faker->randomNumber(1),
      
    ];
});

$factory->define(App\Invoice::class, function (Faker\Generator $faker) {
   

    return [ 

        'total' => $faker->randomNumber(2),
        'status'=>'activo',
        'discount'=>10,
        'client_id'=>function(){
            return factory(\App\Client::class)->create()->id;
        } 
        
    ];
});

$factory->define(App\InvoiceProduct::class, function (Faker\Generator $faker) {
   

    return [ 
        'invoice_id'=>function(){
            return factory(\App\Purchase::class)->create()->id;
        }, 
       'product_id'=>function(){
            return factory(\App\Product::class)->create()->id;
        }, 
        'price' =>function (array $invoiceProduct) {
           return App\Product::find($invoiceProduct['product_id'])->retail_price;
        },
        'amount'=>1,
        'subTotal'=>$faker->randomNumber(2),
      
    ];
});

$factory->define(App\Movement::class, function (Faker\Generator $faker) {
   
    return [ 
        'concept'=>'Pago de prestamo',
        'type'=>'salida',
        'rode'=>$faker->randomNumber(2),
        
    ];
});

