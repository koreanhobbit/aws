<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blogpost extends Model
{

	protected $fillable = [
		'title', 'post', 'user_id', 'blogcategory_id','slug', 'image_id', 'published_at', 'source',
	];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function blogcategory() {
    	return $this->belongsTo('App\blogcategory', 'blogcategory_id');
    }

    public function images() {
        return $this->morphToMany('App\Image', 'imageable')->withPivot('is_maskot');
    }
}
