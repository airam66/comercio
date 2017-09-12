<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Role;

class LoginPageWebTest extends TestCase
{
    use DatabaseTransactions;

    public function test_login_in_page_web_user_Stan()
    {
      $role=factory(Role::class)->create(['name'=>'Estandar',]);
      $user=factory(User::class)->create(['email'=>'fairam66@gmail.com','role_id'=>$role->id,]);

      $this->visit(route('login'))
           ->type($user->email,'email')
           ->type('secret','password')
           ->press('Entrar')
           ->seePageIs(route('index'))
           ->see($user->name);

    }

     public function test_login_in_page_web_user_Admin()
    {
      $role=factory(Role::class)->create(['name'=>'Administrador',]);
      $user=factory(User::class)->create(['email'=>'fairam66@gmail.com','role_id'=>$role->id,]);

      $this->visit(route('login'))
           ->type($user->email,'email')
           ->type('secret','password')
           ->press('Entrar')
           ->seePageIs(route('admin'))
           ->see($user->name);

    }
}