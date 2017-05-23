<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');//para que este logueado
    }

     public function create()
    {
        return view('admin.events.create');
    }

  
   public function store(Request $request)
    {
       $event= new Event($request->all());
       $event->save();
       flash("El evento  ". $event->name . " ha sido creada con exito" , 'success')->important();
     

       return redirect()->route('events.create');//redirecciona la categoria
    }
}
