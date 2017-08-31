<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Role;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;
 public function test_edit_a_user()
    {
      

        $rol1=factory(Role::class)->create([
            'name'=>'Admin'
           
            ]);

        $rol2=factory(Role::class)->create([
            'name'=>'Almacen'
            
            ]);

       $user=factory(User::class)->create(['role_id'=>'1','email'=>'fairam66@gmail.com',]);


        

        $this->actingAs($user);

        $this->visit(route('users.edit',$user))
             ->seeInElement('h3','Editar usuario')
             ->see($user->name)
             ->type("Yanina","name")
             ->press('guardar')
             ->see('Listado de usuarios')
             ->see('Yanina');
    }
      

   }

