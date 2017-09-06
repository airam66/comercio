<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class mainTest extends DuskTestCase
{


    public function test_main_direct_access()
    {
        $user=factory(User::class)->create(['email'=>'example@gmail.com',]);

        $this->browse(function (Browser $browser) use ($user){
            $browser->visit('http://localhost:8080/comercio/public/admin')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Entrar')
                    ->assertPathIs('/comercio/public/admin')
                    ->press('Lista de productos')
                    ->assertPathIs('/comercio/public/admin/products')
                    ->visit('http://localhost:8080/comercio/public/admin')
                    ->press('Nueva venta')
                    ->assertPathIs('/comercio/public/admin/invoices/create')
                    ->visit('http://localhost:8080/comercio/public/admin')
                    ->press('Nuevo pedido')
                    ->assertPathIs('/comercio/public/admin/orders/create')
                    ->visit('http://localhost:8080/comercio/public/admin')
                    ->press('Calendario')
                    ->assertPathIs('/comercio/public/admin')
                    ;
        });

    }
}
