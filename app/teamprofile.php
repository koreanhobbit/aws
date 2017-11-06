<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class teamprofile extends Model
{
	protected $fillable = [
		'month', 'date', 'year', 'birthday', 'location', 'description',
	];

}
