<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    protected $table="categories";

    protected $fillable= ['name','description','extension','status'];


    public function productos()
    {
        return $this->hasMany('App\Product');
    }

    public function scopeSearchCategory($query,$id)
    {
		return $query->where('id','=',$id);
    }
  
    public function scopeSearchCategoryName($query,$name)
    {
		return $query->where('name','LIKE',"%".$name."%");
	  }

}
