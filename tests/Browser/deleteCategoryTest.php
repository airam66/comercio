<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Category;
use App\User;
 
class deleteCategoryTest extends DuskTestCase

{
   use DatabaseMigrations;
  
    public function testDeleteCategory()
    {

         $user=factory(User::class)->create(['email'=>'a6f5t@gmail.com',]);
         $category= factory(\App\Category::class)->create(['name'=>'Cumpleaños','description'=>'rgsrrtgcyth',]);
         $this->browse(function (Browser $browser) use($user) {

            $browser->visit('http://localhost:8080/comercio/public/admin/categories')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Entrar')
                    ->assertPathIs('/comercio/public/admin/categories')
                    ->press('.Eliminar')
                    ->acceptDialog()
                    ->assertPathIs('/comercio/public/admin/categories')
                    ->assertVisible('.btn-success')
                    ->assertMissing('.btn-danger');
                   
                    


        });

        
    }
}
