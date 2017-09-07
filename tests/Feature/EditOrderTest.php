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
use App\Payment;

class EditOrderTest extends TestCase
{
    use DatabaseTransactions;

    public function test_edit_a_order()
    {
       $user=factory(User::class)->create(['email'=>'fairam66@gmail.com',]);

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

            ]);

        $payment=factory(Payment::class)->create([
            'order_id'=>$order->id,
            'amount_paid'=>100.8,
            'balance_paid'=>106.0,

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

        $client->bill=$payment->balance_paid;
        $client->save();

        $this->actingAs($user);

        $this->visit(route('orders.edit',$order))
             ->seeInElement('h3','Editar pedido')
             ->see($order->id)
             ->see($order->created_at->format('d/m/Y'))
             ->see($order->delivery_date->format('Y/m/d'))
             ->see($client->cuil)
             ->see($client->name)
             ->within('#details',function() use($prod1,$prod2,$detail1,$detail2){
                $this->see($prod1->code)
                     ->see($prod1->name)
                     ->see($detail1->price)
                     ->see($detail1->amount)
                     ->see($detail1->subTotal)
                     ->see($prod2->code)
                     ->see($prod2->name)
                     ->see($detail2->price)
                     ->see($detail2->amount)
                     ->see($detail2->subTotal);
            })
            ->within('#table-total',function() use($order){
             $this->see($order->total)
                  ->see($order->totalPayments())
                  ->see($order->client->bill);
                     })
             ->press('X')
             ->dontSeeInElement(".table-striped",$prod1->code)
             ->within('#table-total',function() use($order){
                
            });
             
    }

    
}