<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Porcentage;
use App\productPrice;

class PorcentagesController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');//para que este logueado
    }

    public function index(){
    	return view('admin.porcentages.create');//hasta que vea donde coloco estos metodos
    }

     public function create()
    {
        return view('admin.porcentages.create');
    }

  
   public function store(Request $request)
    {
       $porcentage= new Porcentage($request->all());
       $porcentage->save();
       flash("el nuevo porcentaje ha sido registrado con exito" , 'success')->important();
       
       return redirect()->route('porcentages.create');
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
