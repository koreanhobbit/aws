<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'name', 'slug', 'price', 'is_sale', 'sale_price', 'description', 'is_published', 
    ];

    protected $table = 'products';

    public function category()
    {
    	return $this->belongsTo('App\CategoryProduct', 'product_category_id');
    }

    public function images()
    {
    	return $this->morphToMany('App\Image', 'imageable')->withPivot('is_maskot');
    }

    public function parameters() 
    {
        return $this->belongsToMany('App\ParameterProduct', 'parameters_products', 'product_id', 'parameter_id')->withPivot('value');
    }
}
