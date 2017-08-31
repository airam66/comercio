<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Order;
use App\OrderProduct;

class ChangeStatusTest extends TestCase
{
    use DatabaseTransactions;

    public function test_change_status_of_order()
    {
      $user=factory(User::class)->create(['email'=>'maria@gmail.com',]);
      $order=factory(Order::class)->create();

      $detail=factory(OrderProduct::class)->create(['order_id'=>$order->id]);

      $this->actingAs($user);

      $this->visit(route('orders.index'))
           ->seeInElement('select',$order->status)
           ->select('preparado','status')
           ->press('changeStatus')
           ->seePageIs('admin/orders')
           ->seeInElement('.label-primary','Preparado')
           ->seeInElement('.alert','El pedido N°'.$order->id.' de '.$order->client->name.' cambió de pendiente a preparado')
           ->select('entregado','status')
           ->press('changeStatus')
           ->seePageIs('admin/orders')
           ->seeInElement('.label-success','Entregado')
           ->seeInElement('.alert','El pedido N°'.$order->id.' de '.$order->client->name.' cambió de preparado a entregado')
           ->dontSeeElement('changeStatus')
           ;
      
        $this->seeInDatabase('orders', [
          'status'=>'entregado',
          ]);
    }


}