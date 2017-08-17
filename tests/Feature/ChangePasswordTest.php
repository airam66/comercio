<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class ChangePasswordTest extends TestCase
{
    use DatabaseTransactions;

    public function test_change_my_password()
    {
      $user=factory(User::class)->create(['email'=>'fairam66@gmail.com',]);

      $this->actingAs($user);

      $this->visit(route('users.editPassword'))
           ->type('secret',"password")
           ->type('1234567',"newpassword")
           ->type('1234567',"newpassword_confirmation")
           ->press('Guardar cambios')
           ->seeInElement('.alert','Su contraseña se ha cambiado correctamente');

    }


    public function test_change_my_password_validations(){
    
    $user=factory(User::class)->create(['email'=>'fairam66@gmail.com',]);

      $this->actingAs($user);

      $this->visit(route('users.editPassword'))
           ->type('12345678',"password")
           ->type('1234567',"newpassword")
           ->type('12345679',"newpassword_confirmation")
           ->press('Guardar cambios')
           ->seeErrors([
              'password'=>'La contraseña no coincide',
              'newpassword'=>'El campo confirmación de nueva contraseña no coincide.'
            ]);
      

    }
}