<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class ProfileTest extends TestCase
{
    use DatabaseTransactions;

    public function test_see_my_profile()
    {
      $user=factory(User::class)->create(['email'=>'fairam66@gmail.com',]);

      $this->actingAs($user);

      $this->visit(route('profile'))
           ->seeInElement('h3',$user->name)
           ->seeInElement('h4',$user->role->name)
           ->seeInElement('h4',$user->email)
           ->click('Cambiar Contraseña')
           ->seePageIs(route('users.modifyMyPassword'));

    }
}