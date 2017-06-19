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

class InvoiceTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_create_new_invoice()
    {   
        $porcentage= factory(\App\Porcentage::class)->create();
        $user=factory(User::class)->create(['email'=>'gaby777@gmail.com',]);
        $category= factory(\App\Category::class)->create(['name'=>'Tarjetas',]); 
        $brand= factory(\App\Brand::class)->create(['name'=>'Sprit',]);
        $line= factory(\App\Line::class)->create(['name'=>'Princesas',]);
        $event= factory(\App\Event::class)->create(['name'=>'Cumpleaños',]);
        $product1=factory(Product::class)->create(['name'=>'Bolsittas Frozen','code' =>'001011',]);
        $product2=factory(Product::class)->create(['name'=>'Bolsittas Pricesas','code' =>'001012',]);
       

        $this->browse(function (Browser $browser) use ($user,$category,$event,$brand,$line,$product1,$product2){
            $browser->visit('http://localhost:8080/comercio/public/admin/invoices/create')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Entrar')
                    ->assertPathIs('/comercio/public/admin/invoices/create')
                    //producto 1 minorista
                    ->type('code',$product1->code)
                    ->assertInputValue('name',$product1->name)
                    ->assertInputValue('stock',$product1->stock)
                    ->assertInputValue('price',$product1->retail_price)
                    ->type('cant',10)
                    ->press('Agregar')
                    //producto 2 mayorista
                    ->type('code',$product2->code)
                    ->assertInputValue('name',$product2->name)
                    ->assertInputValue('stock',$product1->stock)
                    ->assertInputValue('price',$product2->wholesale_price)
                    ->type('cant',25)
                    ->press('Agregar')
                    //mirar demas campos
                    ;
        });
    }
}
