<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Event;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{

    public function index(Request $request)
    {

      $events=Event::SearchEventP($request->name)->orderBy('name','ASC')->paginate(10);
       
      return view('admin.events.index')->with('events',$events);
    }

     public function create(){
        return view('admin.events.create');
    }
  

    public function store(EventRequest $request)
    {

       $event= new Event($request->all());
       $event->save();
       flash("El evento  ". $event->name . " ha sido creado con éxito" , 'success')->important();
     
       return redirect()->route('events.index');
    }


    public function desable($id)
    {
        $event= Event::find($id);
        $event->status='inactivo';
       //s dd($event);
        $event->save();
        return redirect()->route('events.index');
    }

    public function enable($id)
    {
        $event= Event::find($id);
        $event->status='activo';
        $event->save();
        return redirect()->route('events.index');
    }

    public function edit($id){

     $event=Event::find($id);
     return view('admin.events.edit')->with('event',$event);
    }

    public function update(Request $request,$id){
      $event=Event::find($id);
      $event->fill($request->all());
      $event->save();
      
      flash("El evento  ". $event->name . " ha sido modificado con éxito" , 'success')->important();

      return redirect()->route('events.index');
    }
}