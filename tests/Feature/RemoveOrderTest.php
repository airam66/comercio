<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\OrderProduct;
use App\Order;

class RemoveOrderTest extends TestCase
{
    use DatabaseTransactions;

    public function test_remove_a_order_from_list()
    {
      $user=factory(User::class)->create(['email'=>'fairam66@gmail.com',]);

      $detail=factory(OrderProduct::class)->create();

      $order=Order::find($detail->order_id);

      $this->actingAs($user);

      $this->visit(route('orders.index'))
           ->seeInElement('h2','Listado de pedidos')
           ->press('delete')
           ->within('#orders',function() use($order){
                $this->dontSee($order->id)
                     ->dontSee($order->created_at->format('d/m/Y'))
                     ->dontSee(date('d/m/Y', strtotime($order->delivery_date)))
                     ->dontSee($order->client->name)
                     ->dontSee($order->client->bill);
           })
           ->seePageIs('admin/orders')
           ->seeInElement('.alert','El pedido ha sido dado de baja exitosamente');                 
    }
}