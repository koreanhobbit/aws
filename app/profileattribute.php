<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profileattribute extends Model
{
    protected $fillable = [
    	'name'
    ];

    protected $table = 'profileattributes';
    
}
