<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Provider;
use App\Purchase;
use App\InvoiceProduct;
use App\Invoice;
use App\Order;
use App\Client;
use App\Brand;
use App\Movement;
use App\Http\Requests\MonthRequest;
use App\Http\Requests\DateRequest;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{

    public function index(){
        $startDate= date('Y-m-d');
        $endDate= date('Y-m-d');
        $months=collect([['number'=>'1','month'=>'Enero'],['number'=>'2','month'=>'Febrero'],['number'=>'3','month'=>'Marzo'],['number'=>'4','month'=>'Abril'],['number'=>'5','month'=>'Mayo'],['number'=>'6','month'=>'Junio'],['number'=>'7','month'=>'Julio'],['number'=>'8','month'=>'Agosto'],['number'=>'9','month'=>'Septiembre'],['number'=>'10','month'=>'Octubre'],['number'=>'11','month'=>'Noviembre'],['number'=>'12','month'=>'Diciembre']])->pluck('month','number')->ToArray();
        return view('admin.pdf.reports')->with('startDate',$startDate)
                                        ->with('endDate',$endDate)
                                        ->with('months',$months);
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
                            ->whereMonth('created_at','<=',$request->to_number)
                            ->whereYear('created_at','=',DB::raw('year(now())'))->orderBy('created_at','ASC')->get();
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
                            ->whereMonth('created_at','<=',$request->to_number)
                            ->whereYear('created_at','=',DB::raw('year(now())'))->orderBy('created_at','ASC')->get();
   if($sales->isEmpty()){

    flash("No hay compras en los meses seleccionados" , 'warning')->important();
    return redirect()->route('admin.reportSales');

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
  
  public function createReportPPurchase(DateRequest $request){
       
        $vistaurl="admin.pdf.reportProviderPurchases";

     $invoices= Purchase::whereDate('created_at','>=',$request->fecha1)
                          ->whereDate('created_at','<=',$request->fecha2)
                          ->where('status','=','realizada')
                          ->orderBy('id','ASC')->get();
         
                
    $provider=DB::table('providers as pr')
             ->join('purchases as p','pr.id','=','p.provider_id')
             ->select('provider_id','pr.name','pr.address')
             ->groupBy('provider_id','pr.name','pr.address')
             ->whereDate('p.created_at','>=',$request->fecha1)
             ->whereDate('p.created_at','<=',$request->fecha2)
             ->where('p.status','=','realizada')->distinct()->get();
    
     if ($invoices->isEmpty()){
          
      flash("No hay compras en el período de fechas ingresado" , 'warning')->important();
     

       return redirect()->route('admin.reportPurchase');
      }

        return $this->createPDF($invoices,$provider,$vistaurl);
    }

    public function createReportCOrder(DateRequest $request){

       
      $vistaurl="admin.pdf.reportClientOrder";

     $invoices= Order::whereDate('created_at','>=',$request->fecha1)
                          ->whereDate('created_at','<=',$request->fecha2)
                          ->orderBy('created_at','ASC')->get();
                
     $clients=DB::table('clients as c')
             ->join('orders as o','c.id','=','o.client_id')
             ->select('client_id','c.name','c.address','c.phone','c.bill')
             ->groupBy('client_id','c.name','c.address','c.phone','c.bill')
             ->whereDate('o.created_at','>=',$request->fecha1)
             ->whereDate('o.created_at','<=',$request->fecha2)
             ->where('c.bill','>','0')->distinct()->get();
     if ($invoices->isEmpty()){
          
      flash("No hay ventas en el período de fechas ingresado" , 'warning')->important();
     

       return redirect()->route('admin.reportSales');
      }

            
        return $this->createPDF($invoices,$clients,$vistaurl);
    }
  

  //********************Para reporte de productos vendidos*****************************************

    public function createReportSalesProducts(MonthRequest $request){
      
    $vistaurl="admin.pdf.reportSalesProducts";
    

    $products=DB::table('invoices_products as ip')
             ->join('products as p','product_id','=','p.id')     
                 ->select('code',DB::raw('sum(ip.subTotal) as total,sum(amount)as amount'),'p.name', DB::raw('month(ip.created_at) as month'))
                 ->groupBy('code','p.name',DB::raw('month(ip.created_at)'))
                 ->where('p.status','=','activo')
                 ->whereMonth('ip.created_at','>=',$request->from_number)
                 ->whereMonth('ip.created_at','<=',$request->to_number)
                 ->whereYear('ip.created_at','=',DB::raw('year(now())'))
                 ->orderBy('ip.id','ASC')
                 ->orderBy('p.name','ASC')->get();

    if($products->isEmpty()){

    flash("No hay productos vendidos en los meses seleccionados" , 'warning')->important();
    return redirect()->route('pdfReport');

   }else{

     $month=collect([]);
     $m=0;
     
     foreach ($products as $key => $value) {
       $a=0;
       if ($m != $value->month){
          $m=$value->month;
          $a=$a+1;
          $month->push($m);
          
     }
   }
 }

    return $this->createPDF($products,$month,$vistaurl);

    }

    //**********************Reporte de Articulos mas vendidos**************************
    public function createReportRanKing(){
      $vistaurl="admin.pdf.reportRanKing";
      $invoices=DB::table('invoices_products as ip')
                    ->join('products as p','p.id','=','ip.product_id')
                    ->select(DB::raw('sum(ip.subTotal) as price, sum(ip.amount) as cant'),'p.name','p.code')
                    ->groupBy('p.name','p.code')
                    ->orderBy('cant','DES')
                    ->limit(20)->get();
      
      $products=Product::all();

      return $this->createPDF($invoices,$products,$vistaurl);

    }


    public function createReportMovements($startDate,$endDate){
        
        $movements=Movement::searchMovement($startDate,$endDate)->orderBy('id','DESC')->paginate(15);
        $totalOutcomes=Movement::totalOutcomesByDate($startDate,$endDate);
        $totalIncomes=Movement::totalIncomesByDate($startDate,$endDate);

        $vistaurl="admin.movements.pdfMovements";
 
      $date = date('Y-m-d');
      $view= \View::make($vistaurl,compact('movements','totalOutcomes','totalIncomes','startDate','endDate','date'))->render();
      $pdf=\App::make('dompdf.wrapper');
      $pdf->loadHTML($view);

      return $pdf->stream();
    }

    //**********************Reporte de ventas semanales********************************

    public function reportWeeklySales(Request $request){

     $date=$request->weekDay;
     $d=date("d",strtotime($date));
     $m=date("m",strtotime($date));
     $y=date("Y",strtotime($date));
     $weekEnd = \Carbon\Carbon::create($y, $m, $d,0);
     $weekEnd->addDays(6);
     
     $vistaurl="admin.pdf.reportWeeklySales";

     $products=DB::table('invoices_products as ip')
                 ->join('invoices as i','invoice_id','=','i.id')
                 ->join('products as p','product_id','=','p.id')     
                 ->select('code',DB::raw('sum(ip.subTotal) as total,sum(amount)as amount'),'p.name')
                 ->groupBy('code','p.name')
                 ->where('i.status','=','activo')
                 ->whereDate('ip.created_at','>=',$date)
                 ->whereDate('ip.created_at','<=',$weekEnd)
                 ->where('brand_id','=',1)
                 ->orderBy('ip.id','ASC')
                 ->orderBy('p.name','ASC')->get();
                
  
     if ($products->isEmpty()){
          
      flash("No hay ventas en la semana ".$date , 'warning')->important();
     

       return redirect()->route('admin.reportSales');
      }

   
      $view= \View::make($vistaurl,compact('products','','d','m','y'))->render();
      $pdf=\App::make('dompdf.wrapper');
      $pdf->loadHTML($view);

      return $pdf->stream();

    }

}
