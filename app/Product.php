<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ["title","slug","description","price","old_price","inStock","image","category_id"];

    public function getRouteKeyName()
    {
    	return "slug";
    }

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
}
