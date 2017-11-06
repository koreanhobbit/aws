<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
    	'title', 'slug', 'description', 'author','link', 'portfolio_category_id', 'client',
    ];

    public function images() {
    	return $this->morphToMany('App\Image', 'imageable')->withPivot('is_maskot');
    }

    public function category() {
    	return $this->belongsTo('App\PortfolioCategory', 'portfolio_category_id');
    }
}
