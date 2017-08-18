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
        $user=factory(User::class)->create(['email'=>'gaby73@gmail.com',]);
        $category= factory(\App\Category::class)->create(['name'=>'Tarjetas',]); 
        $brand= factory(\App\Brand::class)->create(['name'=>'Sprit',]);
        $line= factory(\App\Line::class)->create(['name'=>'Princesas',]);
        $event= factory(\App\Event::class)->create(['name'=>'Cumpleaños',]);
        $product=factory(Product::class)->create(['name'=>'Bolsittas Frozen','code'=>'001001',]);
        $porcentage= factory(\App\Porcentage::class)->create();

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
                    ->select('event_id',(string)$event->id)
                    ->select('line_id',(string)$line->id)
                    ->select('brand_id',(string)$brand->id)
                    ->type('description',$this->description)
                    ->type('price',$this->price)
                    ->value('retail_price',($this->price*30/100)+$this->price)
                    ->value('wholesale_price',($this->price*10/100)+$this->price)
                    ->type('stock',$this->stock)
                    ->type('wholesale_cant',$this->ws)
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

   public function test_see_detail_product(){

    $user=User::find(1);

     $this->browse(function (Browser $browser) use ($user){
            $browser->visit('comercio/public/admin/products')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Entrar')
                    ->assertPathIs('/comercio/public/admin/products')
                    ->click('#first')
                    ->whenAvailable('.modal',function($modal){
                           $modal->pause(1000)
                                ->assertSee('BOLSITTAS FROZEN45')
                                ->assertSee('0010811');                             
                                 
                    });

   });

   }

}

