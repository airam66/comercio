<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    protected $table="invoices_products";
    protected $fillable= ['invoices_id','product_id','amount','subTotal','price'];
    
}
