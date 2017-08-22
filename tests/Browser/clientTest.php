<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;
use App\Client;
class clientTest extends DuskTestCase
{
   // use DatabaseMigrations;
   protected $name='Gabriel Lamas'; 
   protected $cuil='20369129652';
   protected $address='ragones 3';
   protected $location='Salta';
   protected $phone='3875784434';
   protected $email='Gabrielcja3@gmail.com';

    public function test_create_client()
    {
        $user=factory(User::class)->create(['email'=>'fairam666@gmail.com',]);

        $this->browse(function (Browser $browser) use ($user){

            $browser->visit('http://localhost:8080/comercio/public/admin/clients/create')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Entrar')
                    ->assertPathIs('/comercio/public/admin/clients/create')
                    ->type('name',$this->name)
                    ->type('cuil',$this->cuil)
                    ->type('address',$this->address)
                    ->type('location',$this->location)
                    ->type('phone',$this->phone)
                    ->type('email',$this->email)
                    ->press('Registrar')
                    ->assertPathIs('/comercio/public/admin/clients/create')
                    ;
           });

        /*$this->assertDatabaseHas('clients',[
                   
                   'name'=>$this->name,
                   'cuil'=>$this->cuil,
                   'address'=>$this->address,
                   'location'=>$this->location,
                   'phone'=>$this->phone,
                   'email'=>$this->email,
                    
                ]);*/
    }
}
