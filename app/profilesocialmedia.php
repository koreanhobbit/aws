<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profilesocialmedia extends Model
{
    protected $fillable = [
    	'name', 'link','icon',
    ];

    protected $table = 'profilesocialmedias';

    public function images() {
    	return $this->morphToMany('App\image', 'imageable');
    }

}
