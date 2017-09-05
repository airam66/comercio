<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movement;
use App\Http\Requests\MovementRequest;
use Illuminate\Support\Collection as Collection;

class MovementsController extends Controller
{
    public function index(Request $request){

      $fecha1=$request->fecha1;
      $fecha2=$request->fecha2;
      $movements=Movement::orderBy('created_at','DESC')->paginate(15);
      $totalIncomes=Movement::totalIncomes();
      $totalOutcomes=Movement::totalOutcomes();
      $total=$totalIncomes-$totalOutcomes;
      
      if($request->fecha1!='' and $request->fecha2!=''){

         $fecha1=$request->fecha1;
         $fecha2=$request->fecha2;
        $movements=Movement::searchMovement($request->fecha1,$request->fecha2)->orderBy('id','DESC')->paginate(15);
        $totalOutcomes=Movement::totalOutcomesByDate($request->fecha1,$request->fecha2);
        $totalOutcomes=Movement::totalIncomesByDate($request->fecha1,$request->fecha2);
        $total=$totalIncomes-$totalOutcomes;
      
       }
      if($request->today!=''){
         $movements=Movement::movementToday()->orderBy('id','DESC')->paginate(15);;
         $totalIncomes=Movement::totalIncomesToday();
         $totalOutcomes=Movement::totalOutcomesToday();
         $total=$totalIncomes-$totalOutcomes;   
      
       }
        return view('admin.movements.index')->with('movements',$movements)->with('fecha1',$fecha1)
                                            ->with('fecha2',$fecha2)
                                            ->with('totalIncomes',$totalIncomes)
                                            ->with('totalOutcomes',$totalOutcomes)
                                            ->with('total',$total);

    }

    public function create(){

     return view('admin.movements.create');

    }

    public function store(MovementRequest $request){

      $movement=new Movement($request->all());
      $movement->type=$request->type;
      $movement->save();
       flash("Movimiento registrado con exito" , 'success')->important();
     

       return redirect()->route('movements.create');
    }


    public function movementsOfToday(){

         $movements=Movement::movementToday()->orderBy('id','DESC')->paginate(15);;
         $totalIncomes=Movement::totalIncomesToday();
         $totalOutcomes=Movement::totalOutcomesToday();
         $total=$totalIncomes-$totalOutcomes;
         $fecha1='';
         $fecha2='';
         if ($movements==null){
           $movements = Collection::make();
         }

        return view('admin.movements.index')->with('movements',$movements)
                                            ->with('fecha1',$fecha1)
                                            ->with('fecha2',$fecha2)
                                            ->with('totalIncomes',$totalIncomes)
                                            ->with('totalOutcomes',$totalOutcomes)
                                            ->with('total',$total);
    }
}
