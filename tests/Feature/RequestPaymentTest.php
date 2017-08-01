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

class RequestPaymentTest extends TestCase
{
    use DatabaseTransactions;//borra la BD

   
    public function test_request_payment()
    {   
        //encontrar el primer usuario
        $user=factory(User::class)->create();
        //creo un cliente con saldo =0
        $client=factory(Client::class)->create(['bill'=>0.0]);
        //creo una cabezera orden de compra
        $order=factory(Order::class)->create([
            'client_id'=>$client->id,
            'total'=>200,
            'advance'=>100,
            'delivery_date'=>\Carbon\Carbon::now()->addDay(7)]);

        //creo detalle orden de compra
        $detail=factory(OrderProduct::class)->create(['order_id'=>$order->id]);
        //modifica saldo de cliente 
        $balance=$order->total-$order->advance;
        $client->bill=$balance;
        $client->save();
//se loguea con el usuario
        $this->actingAs($user);
        //visito listado de pedidos
        $this->visit(route('OrderPayment.register',$order->id));
             
        //pago saldo
         $this->see('Pago de Pedidos')
              ->see($order->id )
              ->see($order->created_at->format('d/m/Y'))
              ->see($order->delivery_date->format('d/m/Y'))
              ->see($client->cuil)
              ->see($client->name)
              ->see($order->total);
              
         //typear saldo
         $balance=$balance-50;
         $this->type("50","Rode")->see($balance)
              ->press('Registar Pago');
        //ver cambios en la base de datos
        $this->seeInDatabase('clients', [
        	'bill'=>$balance,
        	]);

        //redireccionar

    }



    public function testorderPaymentCheckTest()
    {   
        

        //crea usuario
        $this->actingAs($user);
        //visito listado de pedidos
        $this->visit(route('orders.index'))
             ->press('Pago');
        //pago saldo
         $this->see('Pago de Pedidos')
              ->see($order->id )
              ->see($request->created_at->format('d/m/Y'))
              ->see($request->delivery_date->format('d/m/Y'))
              ->see($cliente->cuil)
              ->see($cliente->name)
              ->see($request->total);
              
         //typear saldo
         
         
         $this->check('totalPayment');
        //ver cambios en la base de datos
        $this->seeInDatabase('clients', [
        	'bill'=>0		,
        	]);
    }
}
