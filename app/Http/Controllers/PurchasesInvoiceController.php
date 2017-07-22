<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Purchase;
use Illuminate\Support\Facades\DB;

class PurchasesInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('admin.purchasesInvoice.create');
    }

    public function loadOrder($id){
       
        $purchase=Purchase::find($id);
        $details= DB::table('purchases_products as pp')
              ->join('products as p','pp.product_id','=','p.id')
              ->join('brands as b','p.brand_id','=','b.id')
              ->select('p.id as product_id','p.name as product_name','pp.price','b.name as brand_name','pp.amount','pp.subTotal')
              ->where('pp.purchase_id','=',$id)->get();
        return view('admin.purchasesInvoice.create')->with('purchase',$purchase)
                                                    ->with('details',$details);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function completeOrder(Request $request){
       $cont=0;
    $TotalCompra=0;
    $Subtotal=[];
       
       
        if($request->ajax()){  
          
            $purchase = Purchase::find($request->searchP);
            $products= DB::table('purchases_products as pp')
                          ->join('products as p','pp.product_id','=','p.id')
                          ->join('brands as b','p.brand_id','=','b.id')
                          ->select('p.id as product_id','p.name as product_name','pp.price','b.name as brand_name','pp.amount','pp.subTotal')
                          ->where('pp.purchase_id','=',$purchase->id)->get();
         
        
            $comilla="'";
            if ($purchase){
               
                $output='<tr>

                        <td width="20%"><b>CUIT</b><input type="text" id="provider_cuit" name="cuit" value="'.$purchase->provider->cuit.'" class="form-control" disabled></td>
                        <td><br><button type="button" class="btn btn-primary " data                       
                        -toggle="modal" id="second" data-title="Buscar" data-target="#favoritesModalClient" disabled><i class="fa fa-search"></i></button></td>
                        
                        <td><b>Nombre</b><input type="text" id="provider_name" name="name" value="'.$purchase->provider->name.'" class="form-control" disabled>
                              <input id="provider_id" name="provider_id" class="form-control" type="hidden" ></td>
                        </tr>';
                
                            
            return Response($output);

               
               
            }
            else{
                 $output= '
                          

                        <tr>

                        <td width="20%"><b>CUIT</b><input type="text" id="provider_cuit" name="cuit" class="form-control"</td>
                        <td><br><button type="button" class="btn btn-primary " data                       
                        -toggle="modal" id="second" data-title="Buscar" data-target="#favoritesModalClient"><i class="fa fa-search"></i></button></td>
                        
                        <td><b>Nombre</b><input type="text" id="provider_name" name="name"  class="form-control" disabled>
                              <input id="provider_id" name="provider_id" class="form-control" type="hidden" ></td>
                        </tr>';
                
               
                return Response($output);
            }
        }

        
    }


     public function detailPurchase(Request $request){



    $cont=0;
    $TotalCompra=0;
    $Subtotal=[];

    if($request->ajax()){
        $output="";
        $comilla="'";
        $purchase = Purchase::find($request->searchP);
        $products= DB::table('purchases_products as pp')
                          ->join('products as p','pp.product_id','=','p.id')
                          ->join('brands as b','p.brand_id','=','b.id')
                          ->select('p.id as product_id','p.name as product_name','pp.price','b.name as brand_name','pp.amount','pp.subTotal')
                          ->where('pp.purchase_id','=',$purchase->id)->get();
         
        
       if ($products) {
        foreach ($products as $key => $product) {
       
                 $Subtotal[$cont]=0;
                  $output.='
                       <tr class="selected" id="'.$cont.'">
                        <td><button type="button" class="btn btn-danger" onclick="deletefila('.$cont.',$('.$comilla.'#dsubTotal'.$cont.''.$comilla.').val())">X</button></td>
                        <input readonly type="hidden" name="dproduct_id[]" value="'.$product->product_id.'">'.
                        '<td>'.$product->product_name.'</td>'.
                        '<td>'.$product->brand_name.'</td>'.
                        '<td><input type="number" name="dprice[]" value="'.$product->price.'"</td>
                        <td><input id="damount" name="damount[]" type="number" value="'.$product->amount.'" onkeyup="$('.$comilla.'#dsubTotal'.$cont.''.$comilla.').val(this.value*'.$product->price.')" onchange="$('.$comilla.'#TotalCompra'.$comilla.').val(parseFloat($('.$comilla.'#TotalCompra'.$comilla.').val())+ parseFloat($('.$comilla.'#dsubTotal'.$cont.''.$comilla.').val()))"> </td>'.
                        '<td><input readonly id="dsubTotal'.$cont.'" name="dsubtTotal" class="mi_factura" type="number" value="'.$product->subTotal.'"  ></td>'

                    .'</tr>';
                   
                    $cont++;
                    
        }


   
        return Response($output);
          
       } 

   
    }
    }


}
