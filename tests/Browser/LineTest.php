<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class LineTest extends DuskTestCase
{
    protected $name='Chicas Suoer Poderosas';

    public function test_create_a_line()
    {
        $user=factory(User::class)->create(['email'=>'example@gmail.com',]);

        $this->browse(function (Browser $browser) use ($user){
            $browser->visit('http://localhost:8080/comercio/public/admin/lines/create')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Entrar')
                    ->assertPathIs('http://localhost:8080/comercio/public/admin/lines/create')
                    ->this('name',$this->name)
                    ->select('status','Actibo')
                    ->press('Registrara')
                //    ->assertSee()
                    ;
        });

        $this->assertDatabaseHas('lines',[
                   'name'=>$this->name,
                   'status'=>'active',
                ]);


    }
}
