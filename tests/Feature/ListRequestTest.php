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

class ListRequestTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_see_requests_list()
    {
        $user=User::find(1);

        $client=factory(Client::class)->create(['bill'=>0.0]);

        $request=factory(OrderRequest::class)->create([
            'client_id'=>$client->id,
            'delivery_date'=>\Carbon\Carbon::now()->addDay(7)]);

        $orderRequest=factory(OrderRequestProduct::class)->create(['request_id'=>$request->id]);

        $balance=$request->total-$request->advance;
        $client->bill=$balance;
        $client->save();

        $this->actingAs($user);

        $this->visit(route('requests.index'))
             ->seeInElement('h2','Listado de Pedidos')
             ->see($request->id)
             ->see($request->created_at->format('d/m/Y'))
             ->see($request->delivery_date->format('d/m/Y'))
             ->see($client->name)
             ->see($balance);


    }

    public function test_search_client_in_requests_list()
    {
        $user=User::find(1);

        $clientSearch=Client::find(1);

        $this->actingAs($user);

        $this->visit(route('requests.index'))
             ->type($clientSearch->name,"searchClient")
             ->press('search')
             ->seeInElement("table",$clientSearch->name)
             ->type("Yanina","searchClient")
             ->press('search')
             ->dontSeeInElement("table","Yanina");

    }
}
