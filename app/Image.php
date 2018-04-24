<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	protected $fillable = [
		'name','size', 'path','type', 'imageable_id', 'imageable_type','user_id',
	]; 

    public function blogposts() {
    	return $this->morphedByMany('App\blogpost', 'imageable');
    }

    public function portfolios() {
    	return $this->morphedByMany('App\Portfolio', 'imageable');
    }

    public function settings() {
        return $this->morphedByMany('App\Setting', 'imageable');
    }

    public function users() {
        return $this->morphedByMany('App\User', 'imageable');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function thumbnail()
    {
        return $this->hasOne('App\Thumbnail');
    }

    public function imageMid()
    {
        return $this->hasOne('App\ImageMid');
    }

}
