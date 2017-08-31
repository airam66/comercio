<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Category;
use App\Event;
use App\Brand;
use App\Line;
use App\Porcentage;
use App\User;
use App\Product;
use App\Provider;
use App\Purchase;
use App\PurchaseProduct;
class PurchaseTest extends DuskTestCase
{   //use DatabaseTransactions;
   
    public function test_delete_purchaseOrder()
    {

        $user=factory(User::class)->create(['email'=>'fairam66@gmail.com',]);
       
        $purchaseDetail=factory(PurchaseProduct::class)->create();
        $purchaseRemove=Purchase::find(1);


        $this->browse(function (Browser $browser) use ($user,$purchaseRemove){
            $browser->visit('comercio/public/admin/purchases')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Entrar')
                    ->assertPathIs('/comercio/public/admin/purchases')
                    ->with('.table', function ($table) use($purchaseRemove)
                    {
                      $table->press('delete')
                            ->acceptDialog()
                            ->assertDontSee($purchaseRemove->id);                       
                    });
                                            
    });
}

}
