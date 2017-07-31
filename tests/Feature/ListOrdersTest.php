<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Client;
use App\Order;
use App\OrderProduct;

class ListOrdersTest extends TestCase
{
    use DatabaseTransactions;

    public function test_see_orders_list()
    {
        $user=factory(User::class)->create(['email'=>'fairam66@gmail.com',]);

        $client=factory(Client::class)->create(['bill'=>0.0]);

        $order=factory(Order::class)->create([
            'client_id'=>$client->id,
            'delivery_date'=>\Carbon\Carbon::now()->addDay(7)]);

        $detail=factory(OrderProduct::class)->create(['order_id'=>$order->id]);

        $balance=$order->total-$order->advance;
        $client->bill=$balance;
        $client->save();
      
        $this->actingAs($user);

        $this->visit(route('orders.index'))
             ->seeInElement('h2','Listado de Pedidos')
             ->see($order->id)
             ->see($order->created_at->format('d/m/Y'))
             ->see($order->delivery_date->format('d/m/Y'))
             ->see($order->client->name)
             ->see($balance);


    }

    public function test_search_client_in_orders_list()
    {
        $user=factory(User::class)->create(['email'=>'fairam66@gmail.com',]);

        $order=factory(Order::class)->create();

        $detail=factory(OrderProduct::class)->create(['order_id'=>$order->id]);

        $this->actingAs($user);

        $this->visit(route('orders.index'))
             ->type($order->client->name,"searchClient")
             ->press('search')
             ->seeInElement("table",$order->client->name)
             ->type("Yanina","searchClient")
             ->press('search')
             ->dontSeeInElement("table","Yanina");

    }
}
