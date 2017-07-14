<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Category;
use App\User;
use App\Product;

class ProductsTest extends DuskTestCase
{
   //use DatabaseMigrations;

   protected $code= 12345;
   protected $name='oso';
  // protected $category='souvenirs';
   protected $description='osito color morado';
   protected $price=12;
   protected $stock=123;
  

    public function test_create_a_product()
    {
        $user=factory(User::class)->create(['email'=>'fairam66@gmail.com',]);
        $category= factory(\App\Category::class)->create(['name'=>'Tarjetas',]);

        $this->browse(function (Browser $browser) use ($user,$category){

                     //When
            $browser->visit('comercio/public/admin/products/create')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Entrar')
                    ->assertPathIs('/comercio/public/admin/products/create')
                     ->type('name',$this->name)
                    ->type('code',$this->code)
                    
                    ->select('category_id',(string)$category->id)
                    ->type('description',$this->description)
                    ->type('price',$this->price)
                    ->type('stock',$this->stock)
                    ->select('status','active')
                    ->attach('image','D:\tar\001.png')

                    ->press('Registrar')
                    ->assertPathIs('/comercio/public/admin/products')
                    ;
           });

                    

                $this->assertDatabaseHas('products',[
                   
                   'code'=>$this->code,
                   'name'=>$this->name,
                   'category_id'=>$category->id,
                   'description'=>$this->description,
                   'price'=>$this->price,
                   'stock'=>$this->stock,
                   'status'=>'active',
                   'extension'=>'001.png',
                    
                ]);

               

             
       
    }


    public function test_create_product_form_validation(){
      $user=factory(\App\User::class)->create(['email'=>'fairam66@gmail.com',]);
      //$category= factory(\App\Category::class)->create(['name'=>'Tarjetas',]);

       $this->browse(function (Browser $browser) use ($user){
            $browser->visit('comercio/public/admin/products/create')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Entrar')
                    ->assertPathIs('/comercio/public/admin/products/create')
                    ->press('Registrar')
                    ->assertSeeErrors([
                      'name'=>'El campo nombre es obligatorio',
                      'code'=>'El campo codigo debe contener al menos 3 caracteres',
                      //'price'=> 'El campo precio es obligatorio',
                      'stock'=>'El campo stock es obligatorio'
                        
                      ]);
    });
   }

   public function test_update_stock_craft_products(){
    $user=User::find(1);

    $products=Product::where('brand_id','=',2);
    $productsToSearch=Product::find(2);
    $this->browse(function (Browser $browser) use ($user,$products){
            
            $browser->visit('comercio/public/admin/craftProducts')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Entrar')
                    ->assertPathIs('/comercio/public/admin/craftProducts')
                    ->press('#iconSearch')
                    ->whenAvailable('.modal',function($modal){
                           $modal->pause(1000)
                                ->assertSee('BUSCAR PRODUCTOS');
                                
                                /*->with('#tabla',function($table){
                                       $table->assertSee('Hola');
                                });*/
                                                                
                                 
                    })
                    ->clickLink('TODOS')
                    ->pause(80000)
                    ->with('.table',function($tbody){
                      $tbody->assertSee('Silicona');
                    });
                                       
                    
     
                    
    });

   }

   public function test_update_stock_craft_products_validate(){
     $user=User::find(1);
    
     $this->browse(function (Browser $browser) use ($user){
            $browser->visit('comercio/public/admin/craftProducts')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Entrar')
                    ->assertPathIs('/comercio/public/admin/craftProducts')
                    ->press('Confirmar')
                    ->assertSeeErrors([
                      'code'=>'El campo codigo es obligatorio',
                      'amount'=>'El campo Cantidad es obligatorio'
                                              
                      ]);

   });

   }

}

