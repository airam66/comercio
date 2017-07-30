<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Client;
use App\Product;
use App\Order;
use App\OrderProduct;

class EditRequestTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_edit_a_request()
    {
        $user=User::find(1);

        $prod1=factory(Product::class)->create([
            'name'=>'Porta retrato',
            'code'=>'001781',
            'wholesale_price'=>0.1*12+12, 
            'retail_price'=>0.3*12+12
            ]);

        $prod2=factory(Product::class)->create([
            'name'=>'Bolsitas Ana',
            'code'=>'001782',
            'wholesale_price'=>0.1*20+20, 
            'retail_price'=>0.3*20+20
            ]);

        $client=factory(Client::class)->create([
            'bill'=>0.0,
            'name'=>'Maria Tolaba'
            ]);

        $order=factory(Order::class)->create([
            'client_id'=>$client->id,
            'delivery_date'=>\Carbon\Carbon::now()->addDay(7),
            'total'=>206.8,
            'advance'=>100

            ]);

        $detail1=factory(OrderProduct::class)->create([
            'order_id'=>$order->id,
            'product_id'=>$prod1,
            'price'=>13.2,
            'amount'=>4,
            'subTotal'=>52.8
            ]);

        $detail2=factory(OrderProduct::class)->create([
            'order_id'=>$order->id,
            'product_id'=>$prod2,
            'price'=>22,
            'amount'=>2,
            'subTotal'=>154
            ]);

        $balance=$order->total-$order->advance;
        $client->bill=$balance;
        $client->save();

        $this->actingAs($user);

        $this->visit(route('orders.edit',$order))
             ->seeInElement('h3','Editar pedido')
             ->see($order->id)
             ->see($order->created_at->format('d/m/Y'))
             ->see($order->delivery_date->format('d/m/Y'))
             ->see($client->cuil)
             ->see($client->name)
             ->seeInElement("table",$prod1->code)
             ->seeInElement("table",$prod1->name)
             ->seeInElement("table",$detail1->price)
             ->seeInElement("table",$detail1->amount)
             ->seeInElement("table",$detail1->subTotal)
             ->seeInElement("table",$prod2->code)
             ->seeInElement("table",$prod2->name)
             ->seeInElement("table",$detail2->price)
             ->seeInElement("table",$detail2->amount)
             ->seeInElement("table",$detail2->subTotal)
             ->see($order->total)
             ->see($order->advance)
             ->see($order->client->bill)
             ->press('X')
             ->dontSeeInElement("table",$prod1->code);


    }

    
}