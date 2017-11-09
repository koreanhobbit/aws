<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Websitesocmed extends Model
{
    protected $table = 'websitesocmeds';

    protected $fillable = [
    	'name', 'link', 'slug', 'icon', 'setting_id',
    ];

}
