<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Purchase;

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
        $title="BUSCAR PROVEEDORES";
        return view('admin.purchasesInvoice.create')->with('title',$title);
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
       dd('hola');
       if($request->ajax()){

         $purchase= Purchase::find($request->searchP);
         
        
          $output="".$purchase->cuit."";
        }
        return Response($output);

        
    }


     public function detailPurchase(Request $request){

    $cont=0;
    $TotalCompra=0;
    $Subtotal=[];

    if($request->ajax()){
        $output="";
        $comilla="'";
        $products= DB::table('providers_products as pp')
              ->join('products as p','pp.product_id','=','p.id')
              ->join('brands as b','p.brand_id','=','b.id')
              ->select('code','p.id as product_id','p.name as product_name','purchase_price','b.name as brand_name','stock')
              ->where('p.stock','<',10)
              ->where('b.name',"<>","CREATU")
              ->where('pp.provider_id','=',$request->provider_id)->get();

     
       if ($products) {
        foreach ($products as $key => $product) {
       
                 $Subtotal[$cont]=0;
                  $output.='
                       <tr class="selected" id="'.$cont.'">
                        <td><button type="button" class="btn btn-danger" onclick="deletefila('.$cont.',$('.$comilla.'#dsubTotal'.$cont.''.$comilla.').val())">X</button></td>
                        <input readonly type="hidden" name="dproduct_id[]" value="'.$product->product_id.'">'.
                        '<td>'.$product->product_name.'</td>'.
                        '<td>'.$product->brand_name.'</td>'.
                        '<td><input readonly type="number" name="dprice[]" value="'.$product->purchase_price.'" class="mi_factura"</td>
                        <td><input id="damount" name="damount[]" type="number" onkeyup="$('.$comilla.'#dsubTotal'.$cont.''.$comilla.').val(this.value*'.$product->purchase_price.')" onchange="$('.$comilla.'#TotalCompra'.$comilla.').val(parseFloat($('.$comilla.'#TotalCompra'.$comilla.').val())+ parseFloat($('.$comilla.'#dsubTotal'.$cont.''.$comilla.').val()))"></td>'.
                        '<td><input readonly id="dsubTotal'.$cont.'" name="dsubtTotal" class="mi_factura" type="number" value='.$Subtotal[$cont].'></td>'

                    .'</tr>';
                    $cont++;
                    
        }


   
        return Response($output);
          
       } 

   
    }
    }


}
