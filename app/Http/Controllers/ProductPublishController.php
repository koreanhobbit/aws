<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductPublishController extends Controller
{
    public function toggleProduct(Request $request, Product $product)
    {
    	if($request->checkbox_product == 'on')
    	{
    		$product->is_published = 1;
    		$product->save();
    		$message = 'The product is published!';
    	}
    	else
    	{
    		$product->is_published = 0;
    		$product->save();
    		$message = 'The product is unpublished!';
    	}

    	return back()->with('message', $message);
    }
}
