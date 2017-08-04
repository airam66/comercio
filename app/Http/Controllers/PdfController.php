<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Provider;
use App\Brand;

use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{

    public function index(){
        return view('admin.pdf.reports');
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
              ->where('stock','<',100)->orderBy('pr.name','ASC')->get();

         
                
    $provider=DB::table('providers_products as pp')
             ->join('products as p','pp.product_id','=','p.id')
             ->join('providers as pr','pp.provider_id','=','pr.id')
             ->select('provider_id','pr.name as provider_name')
               ->groupBy('provider_id','provider_name')->where('p.stock', '<', 10)->get();
               
            
    	return $this->createPDF($products,$provider,$vistaurl);
    }

    
}
