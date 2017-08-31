<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class CreateShoppingCartTest extends TestCase
{
    use DatabaseTransactions;

    public function test_add_product_to_shopping_cart()
    {
      $user=factory(User::class)->create(['email'=>'maria@gmail.com',]);

      $this->actingAs($user);

      $this->visit(route('catalogue'))
           ->seeInElement('add_cart','Añadir a carrito')
           ->press('add_cart')
           ->dontSeeElement('add_cart')
           ->seeElement('tilde')
           ->seeInElement('shopping_cart',1)
           ->press('Mi carrito')
           ->seePageIs('shopping_cart.products');
    }

}