<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Provider;
use App\Purchase;
use App\Brand;
use App\Http\Requests\MonthRequest;

use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{

    public function index(){
       $startDate= date('Y-m-d');
        $endDate= date('Y-m-d');
        return view('admin.pdf.reports')->with('startDate',$startDate)
                                        ->with('endDate',$endDate);
    }


    public function createPDF($datos,$datos2,$vistaurl){

    	$data =$datos;
    	$data2=$datos2;
    	$date = date('Y-m-d');
    	$view= \View::make($vistaurl,compact('data','data2','date'))->render();
    	$pdf=\App::make('dompdf.wrapper');
    	$pdf->loadHTML($view);

    	return $pdf->stream();
    }

    public function createReportStock(){
    	$vistaurl="admin.pdf.reportStock";

     $products= DB::table('providers_products as pp')
             ->join('products as p','pp.product_id','=','p.id')
             ->join('providers as pr','pp.provider_id','=','pr.id')
             ->join('brands as b','p.brand_id','=','b.id')
              ->select('provider_id','p.id as product_id','p.name as product_name','b.name as brand_name','pr.name as provider_name','p.stock')
              ->where('stock','<',10)->orderBy('pr.name','ASC')->get();

         
                
    $provider=DB::table('providers_products as pp')
             ->join('products as p','pp.product_id','=','p.id')
             ->join('providers as pr','pp.provider_id','=','pr.id')
             ->select('provider_id','pr.name as provider_name')
               ->groupBy('provider_id','provider_name')->where('p.stock', '<', 10)->get();
               
            
    	return $this->createPDF($products,$provider,$vistaurl);
    }

    public function createReportPurchases(){
       
    $months=collect([['number'=>'1','month'=>'Enero'],['number'=>'2','month'=>'Febrero'],['number'=>'3','month'=>'Marzo'],['number'=>'4','month'=>'Abril'],['number'=>'5','month'=>'Mayo'],['number'=>'6','month'=>'Junio'],['number'=>'7','month'=>'Julio'],['number'=>'8','month'=>'Agosto'],['number'=>'9','month'=>'Septiembre'],['number'=>'10','month'=>'Octubre'],['number'=>'11','month'=>'Noviembre'],['number'=>'12','month'=>'Diciembre']])->pluck('month','number')->ToArray();

        
     return view('admin.pdf.purchases')->with('months',$months);

    }

    public function viewReportPurchase(MonthRequest $request){

    $purchases= \App\Purchase::where('status','=','realizada')
                           ->whereMonth('created_at','>=',$request->from_number)
                            ->whereMonth('created_at','<=',$request->to_number)->orderBy('created_at','ASC')->get();
   if($purchases->isEmpty()){

    flash("No hay compras en los meses seleccionados" , 'warning')->important();
    return redirect()->route('admin.reportPurchase');


   }else{

     $month=collect([]);
     $m=0;
     
     foreach ($purchases as $key => $value) {
       $a=0;
       if ($m != date_format($value->created_at,'n')){
          $m=date_format($value->created_at,'n');
          $a=$a+1;
          $month->push($m);
     }
   }
    
      $vistaurl="admin.pdf.reportPurchases";
     
     
      return $this->createPDF($purchases,$month,$vistaurl);

    }

  }
   
  public function createReportSales(){
       
    $months=collect([['number'=>'1','month'=>'Enero'],['number'=>'2','month'=>'Febrero'],['number'=>'3','month'=>'Marzo'],['number'=>'4','month'=>'Abril'],['number'=>'5','month'=>'Mayo'],['number'=>'6','month'=>'Junio'],['number'=>'7','month'=>'Julio'],['number'=>'8','month'=>'Agosto'],['number'=>'9','month'=>'Septiembre'],['number'=>'10','month'=>'Octubre'],['number'=>'11','month'=>'Noviembre'],['number'=>'12','month'=>'Diciembre']])->pluck('month','number')->ToArray();

        
     return view('admin.pdf.sales')->with('months',$months);

    }

    public function viewReportSales(MonthRequest $request){

    $sales= \App\Invoice::where('status','=','activo')
                           ->whereMonth('created_at','>=',$request->from_number)
                            ->whereMonth('created_at','<=',$request->to_number)->orderBy('created_at','ASC')->get();
   if($sales->isEmpty()){

    flash("No hay compras en los meses seleccionados" , 'warning')->important();
    return redirect()->route('admin.reportSale');


   }else{

     $month=collect([]);
     $m=0;
     
     foreach ($sales as $key => $value) {
       $a=0;
       if ($m != date_format($value->created_at,'n')){
          $m=date_format($value->created_at,'n');
          $a=$a+1;
          $month->push($m);
     }
   }
    
      $vistaurl="admin.pdf.reportSales";
     
     
      return $this->createPDF($sales,$month,$vistaurl);

    }

  }

<<<<<<< HEAD

  
  public function createReportPPurchase($fStart ,$fEnd){
       
        $vistaurl="admin.pdf.reportProviderPurchases";

     $invoices= Purchase::whereDate('created_at','>=',$fStart)
                          ->whereDate('created_at','<=',$fEnd)
                          ->where('status','=','realizada')
                          ->orderBy('created_at','ASC')->get();

   
         
                
    $provider=DB::table('providers as pr')
             ->join('purchases as p','pr.id','=','p.provider_id')
             ->select('provider_id','pr.name','pr.address')
             ->groupBy('provider_id','pr.name','pr.address')
             ->whereDate('p.created_at','>=',$fStart)
             ->whereDate('p.created_at','<=',$fEnd)
             ->where('p.status','=','realizada')->distinct()->get();
            
        return $this->createPDF($invoices,$provider,$vistaurl);
    }



=======
>>>>>>> 8e8637b10511d2be6c3371fbc92fecbdaefab752
}
