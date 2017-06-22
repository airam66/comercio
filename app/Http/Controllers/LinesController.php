<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LineRequest;

use App\line;

class LinesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

      $lines=Line::SearchLine($request->name)->orderBy('name','ASC')->paginate(10);
       
      return view('admin.lines.index')->with('lines',$lines);
    }


     public function create()
    {
        return view('admin.lines.create');
    }

  
    public function store(LineRequest $request)
    {
    	
       $line= new Line($request->all());
       $line->save();
       flash("La linea ". $line->name . " ha sido creada con exito" , 'success')->important();
     

       return redirect()->route('lines.index'); //cambiar cuando cree la lista
    }

   
    public function show($id)
    {
        //
    }

     
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
