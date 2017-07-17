q<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class updateStockTest extends DuskTestCase
{
 
    public function testExample()
    {
        $user=factory(User::class)->create(['email'=>'gaby333@gmail.com',]);
        $this->browse(function (Browser $browser) {
            $browser->visit('http://localhost:8080/comercio/public/admin/updateStockCreate')
                    ->type('email',$user->email)
                    ->press('Entrar')
                    ->assertPathIs('http://localhost:8080/comercio/public/admin/updateStockCreate')
                    ->click('#search')
                    ->assertVisible('#modalProduct')
                    ->type('email',$product->name)
                    ->press('Agregar')
                    ->assertValue('#name', $value)



        });
    }
}
