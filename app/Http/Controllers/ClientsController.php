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
    	/*$product= Product::find($id);


        return view('admin.products.edit')->with('product',$product)*/


    }

   
    public function update(Request $request, $id)
    {
    }

    public function desable($id)
    {
    }

    public function enable($id)
    {
      /*  $product= Product::find($id);
        $product->status='activo';
        $product->save();
        return redirect()->route('products.index');*/
    }

    public function destroy($id)
    {

    }

   
}

