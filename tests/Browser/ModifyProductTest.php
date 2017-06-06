<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Category;
use App\Event;
use App\Brand;
use App\Line;
use App\Porcentage;
use App\User;
use App\Product;
class ModifyProductTest extends DuskTestCase
{
   use DatabaseMigrations;

   protected $code= 12345;
   protected $name='oso';
  // protected $category='souvenirs';
   protected $description='osito color morado';
   protected $purchase_price=12;
   protected $stock=123;
   protected $ws=10;
  

    public function test_modify_a_product()
    {
        $user=factory(User::class)->create(['email'=>'gaby73@gmail.com',]);
        $category= factory(\App\Category::class)->create(['name'=>'Tarjetas',]); 
        $brand= factory(\App\Brand::class)->create(['name'=>'Sprit',]);
        $line= factory(\App\Line::class)->create(['name'=>'Princesas',]);
        $event= factory(\App\Event::class)->create(['name'=>'Cumpleaños',]);
        $product=factory(Product::class)->create(['name'=>'Bolsittas Frozen',]);
        $porcentage= factory(\App\Porcentage::class)->create();

        $this->browse(function (Browser $browser) use ($user,$category,$event,$brand,$line){

                     //When
            $browser->visit('http://localhost:8080/comercio/public/admin/products')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Entrar')
                   // ->assertPathIs('http://localhost:8080/comercio/public/admin/products')
                    ->press('Editar')
                  //  ->assertPathIs('http://localhost:8080/comercio/public/admin/products')
                    ->select('category_id',(string)$category->id)
                    ->type('code',$this->code)
                    ->attach('image','C:\Users\Gabriel\Desktop\cotillon\001.jpeg')
                    ->select('event_id',(string)$event->id)
                    ->select('line_id',(string)$line->id)
                    ->select('brand_id',(string)$brand->id)
                    ->type('description',$this->description)
                    ->type('stock',$this->stock)
                    ->type('wholesale_cant',$this->ws)
                    ->press('Guardar Cambios')
                    ->assertPathIs('http://localhost:8080/comercio/public/admin/products')
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
                      'code'=>'El campo codigo debe contener al menos 8 caracteres',
                      //'price'=> 'El campo precio es obligatorio',
                      'stock'=>'El campo stock es obligatorio'
                        
                      ]);
    });
}
}

