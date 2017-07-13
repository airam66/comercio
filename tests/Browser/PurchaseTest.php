<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Category;
use App\Event;
use App\Brand;
use App\Line;
use App\Porcentage;
use App\User;
use App\Product;
use App\Provider;

class PurchaseTest extends DuskTestCase
{
   protected $cuit= 12345678901;
   protected $name='Frutillita';
 
    public function test_delete_purchaseOrder()
    {

     $user=factory(User::class)->create(['email'=>'gaby333@gmail.com',]);
        $category= factory(\App\Category::class)->create(['name'=>'Tarjetas',]); 
        $brand= factory(\App\Brand::class)->create(['name'=>'Sprit',]);
        $line= factory(\App\Line::class)->create(['name'=>'Princesas',]);
        $event= factory(\App\Event::class)->create(['name'=>'Cumpleaños',]);
        $porcentage= factory(\App\Porcentage::class)->create();
        $product=factory(Product::class)->create(['name'=>'Bolsittas Frozen',]);
      
        $provider=factory(Provider::class)->create('cuit'=>12341234567,]);
        $purchase=factory(Purchase::class)->create('provider_id'=>1);
        $purchaseDetail=factory(PurchaseProduct::class)->create();



        $this->browse(function (Browser $browser) use ($user){
            $browser->visit('http://localhost:8080/comercio/public/admin/products')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Entrar')
                    ->assertPathIs('/comercio/public/admin/purchases')
                    ->press('Eliminar')
                 //   ->assertSee('¿Seguro dara de baja el producto?')
                    ->acceptDialog()
                   // ->assertSee('active')
                    ->assertPathIs('/comercio/public/admin/products')
                    ;
        });
    }
}
