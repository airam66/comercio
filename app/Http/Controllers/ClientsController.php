<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;

use App\Client;

class ClientsController extends Controller
{
 	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
      $clients=Client::SearchClient($request->name)->orderBy('name','status','ASC')->paginate(10);
       return view('admin.clients.index')->with('clients',$clients);

    }

    public function create()
    {
        return view('admin.clients.create');

    }

    
    public function store(ClientRequest $request)
    {
        $clients= new Client($request->all());
    	
        $clients->save();
       
        return redirect()->route('clients.create');

    }

     
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {   
    	$client= Client::find($id);

        return view('admin.clients.edit')->with('client',$client);


    }

   
    public function update(Request $request, $id)
    {

         $client=Client::find($id);
         $client->fill($request->all());
         $client->save();
        flash("El cliente ". $client->name . " ha sido modificado con éxito" , 'success')->important();
     

       return redirect()->route('clients.index');
    }

    public function desable($id)
    {
        $client= Client::find($id);
        $client->status='inactivo';
        $client->save();
        return redirect()->route('clients.index');
    }

    public function enable($id)
    {
        $client= Client::find($id);
        $client->status='activo';
        $client->save();
        return redirect()->route('clients.index');
    }

    public function destroy($id)
    {

    }

   
}

