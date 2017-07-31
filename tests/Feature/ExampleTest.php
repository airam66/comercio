<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Client;
use App\OrderRequest;
use App\OrderRequestProduct;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
   
    public function testRequestPaymenttest()
    {   //encontrar el primer usuario
        $user=User::find(1);
        //creo un cliente con saldo =0
        $client=factory(Client::class)->create(['bill'=>0.0]);
        //creo una cabezera orden de compra
        $request=factory(OrderRequest::class)->create([
            'client_id'=>$client->id,
            'delivery_date'=>\Carbon\Carbon::now()->addDay(7)]);

        //creo detalle orden de compra
        $orderRequest=factory(OrderRequestProduct::class)->create(['request_id'=>$request->id]);
        //modifica saldo de cliente 
        $balance=$request->total-$request->advance;
        $client->bill=$balance;
        $client->save();

        //crea usuario
        $this->actingAs($user);
        //visito listado de pedidos
        $this->visit(route('requests.index'))
             ->press('Pago');
        //pago saldo
         $this->see('Pago de Pedidos')
              ->see($request->id )
              ->see($request->created_at->format('d/m/Y'))
              ->see($request->delivery_date->format('d/m/Y'))
              ->see($cliente->cuil)
              ->see($cliente->name)
              ->see($request->total);
              
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



    public function testRequestPaymentCheckTest()
    {   //encontrar el primer usuario
       
    }
}
