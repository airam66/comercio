<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;

class CalendarsController extends Controller
{
   public function calendar(){

   	$orders= DB::table('orders as o')
      ->join('clients as c','o.client_id','=','c.id')
      ->select('o.id as id','o.delivery_date as end','c.name as title','o.status as status','o.created_at as start')->get();
   	//dd($orders);
   	return view('admin.orders.calendar')->with('orders',$orders);
   }

   public function searchStatus($status){
   
   $orders= DB::table('orders as o')
      ->join('clients as c','o.client_id','=','c.id')
      ->select('o.id as id','o.delivery_date as end','c.name as title','o.status as status','o.created_at as start')
      ->where('o.status','=',$status)->get();
   	//dd($orders);
   	return view('admin.orders.calendar')->with('orders',$orders);

   }

}
