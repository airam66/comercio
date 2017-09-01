<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movement;
use App\Http\Requests\MovementRequest;

class MovementsController extends Controller
{
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
}
