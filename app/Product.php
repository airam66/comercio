<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table="products";

   protected $fillable= ['code','name','category_id','line_id','brand_id','wholesale_cant','description','stock','extension','status','purchase_price','wholesale_price','retail_price'];

    public function category(){

        return $this->belongsTo('App\Category');
    }

    public function line(){

        return $this->belongsTo('App\Line');
    }

    public function brand(){

        return $this->belongsTo('App\Brand');
    }

    public function event(){
        return $this->belongsToMany('App\Event') ;
    }

    public function newCode($category_id,$product_code){
        //concatena id o code con id de categoria
        //(string)$var o strval($var)
        if ($category_id<10){
            $category='00'.strval($category_id);
        }elseif ($category_id<100) {
            $category='0'.strval($category_id);
        }else {
            $category=strval($category_id);
        }

        $code=strval($product_code);
        

        return $category.$code;
    }

    public function singleCode($product_code){
        // retorna el codigo del id de categoria
        // intval($string) y substr($var,int ,[int])
        $code=substr($product_code,3);
        return intval($code);


    }

    public function scopeSearchProduct($query,$name){

        return $query->where('name','LIKE',"%" . $name . "%");
    }

    public function scopeSearchProductL($query,$letra){

        return $query->where('name','LIKE', $letra . "%");
    }

    public function scopeSearchProductC($query,$category){

        return $query->where('category_id','=',$category);
        ;
    }


    
 
     
}