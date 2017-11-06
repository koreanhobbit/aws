<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = [
    	'site_title', 'tagline',
    ];


    public function images() {
    	return $this->morphToMany('App\Image', 'imageable')->withPivot('is_maskot');
    }

    public function websitesocialmedias() {
    	return $this->hasMany('App\Websitesocmed', 'setting_id');
    }
}
