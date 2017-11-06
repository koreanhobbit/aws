<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PortfolioCategory extends Model
{

	protected $fillable = [
		'category', 'slug',
	];

    protected $table = 'portfolio_categories';
}
