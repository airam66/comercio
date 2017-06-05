<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Event;
use App\Http\Requests\EventRequest;

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
  

    public function store(EventRequest $request)
    {

       $event= new Event($request->all());
       $event->save();
       flash("El evento  ". $event->name . " ha sido creado con exito" , 'success')->important();
     
       return redirect()->route('events.create');//redirecciona la categoria
    }
}