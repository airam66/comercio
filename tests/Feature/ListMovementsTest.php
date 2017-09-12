<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Order;
use App\Movement;
use App\Purchase;
use App\Invoice;
use App\Payment;

class ListMovementsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_see_movements_list()
    {
        $user=factory(User::class)->create(['email'=>'maria@gmail.com',]);
        
        $sale=factory(Invoice::class)->create(['total'=>300.0]);

        $order=factory(Order::class)->create(['total'=>100]);

        $payment=factory(Payment::class)->create(['order_id'=>$order->id,'amount_paid'=>50.0]);

        $outcome=factory(Movement::class)->create(['rode'=>300,]);
     
        $this->actingAs($user);

        $this->visit(route('movements.index'))
             ->seeInElement('h2','Movimientos del día.')
             ->within('#movements',function() use($sale,$payment,$outcome){
                $this->see('Venta N° '.$sale->id)
                     ->see('Pago Pedido N° '.$payment->order_id)
                     ->see($outcome->concept);
           })
           
            ->seeInElement('#incomes',350.0)
            ->seeInElement('#outcomes',300)
            ->seeInElement('#box',50.0);

    }

     public function test_see_movements_range_date()
    {
        $user=factory(User::class)->create(['email'=>'maria@gmail.com',]);
       
        $date1=\Carbon\Carbon::now()->subMonths(3);
       
        $sale=factory(Invoice::class)->create(['total'=>300.5]);  
        $sale->created_at=$date1;
        $movement=Movement::all()->last();
        $movement->created_at=$date1;
        $movement->save(); 

        $date2=\Carbon\Carbon::now()->subMonths(2);

        $order=factory(Order::class)->create(['total'=>400]);

        $payment=factory(Payment::class)->create(['order_id'=>$order->id,'amount_paid'=>250.0]);

        $outcome=factory(Movement::class)->create(['rode'=>100,'created_at'=>$date2]);
   
        $this->actingAs($user);

        $this->visit(route('movements.index'))
             ->seeInElement('h2','Movimientos del día.')
             ->type('2017-05-02','fecha1')
             ->type('2017-08-15','fecha2')
             ->press('searchDate')
             ->seeInElement('h2','Movimientos desde 02-05-2017 hasta 15-08-2017.')
             ->within('#movements',function() use($sale,$payment,$outcome){
                $this->see('Venta N° '.$sale->id)
                     ->dontSee('Pago Pedido N° '.$payment->order_id)
                     ->see($outcome->concept);
           })
           
            ->seeInElement('#incomes',300.5)
            ->seeInElement('#outcomes',100)
            ->seeInElement('#box',200.5)
            ->type('2017-01-02','fecha1')
            ->type('2017-04-15','fecha2')
            ->see('.alert','No hay Movimientos');

    }

  
}
