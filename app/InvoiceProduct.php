<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class InvoiceProduct extends Model
{
    protected $table="invoices_products";
    protected $fillable= ['invoices_id','product_id','amount','subTotal','price'];

     public static function scopeSearchProduct($month1,$month2){

        return $query->join('products as p','product_id','=','p.id')     
                 ->select('p.id','sum(amount)')
                 ->groupBy('p.id')
                 ->whereMonth('invoices_products.created_at','>=',$month1)
                 ->whereMonth('invoices_products.created_at','<=',$month2);
    }
    
}
