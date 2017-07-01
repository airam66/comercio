<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table="invoices";
    protected $fillable= ['discount','total','client_id','status'];

    public function scopeSearchInvoice($query,$fecha1,$fecha2){

        return $query->whereBetween('created_at', [$fecha1,$fecha2 ]);
}

