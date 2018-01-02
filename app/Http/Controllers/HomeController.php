<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\blogpost;
use App\Contact;
use App\Portfolio;
use App\Mail\EmailContact;
use Illuminate\Support\Facades\Mail;
use App\Setting;
use App\Websitesocmed;
use App\User;
use App\Product;

class HomeController extends Controller
{
    public function index(Request $request) {

        $settings = Setting::get();
        $members = User::where('user_status', '=', 1)->get();
    	$posts = blogpost::orderBy('updated_at', 'desc')->simplePaginate(3, ['*'], 'blog');
        $portfolios = Portfolio::orderBy('created_at', 'desc')->simplePaginate(9,['*'], 'portfolio');
        $products = Product::where('is_published', '=', 1)->orderBy('id', 'asc')->simplePaginate(3,['*'], 'product');

    	if($request->ajax()) {
            // if($request->title == "portfolio") {
            //     return view('partials._portfolio', compact('portfolios'))->render();
            // }

            if($request->title == "blog") {
    		  return view('partials._blog', ['posts' => $posts])->render();
            }
    	}

    	//show the published post
    	return view('home', compact('posts', 'portfolios', 'settings', 'members', 'products'));
    }

    //function for contact 
    public function contact(Request $request) {
    	$cm = new Contact;
    	$cm->name = $request->name;
    	$cm->email = $request->email;
    	$cm->phone = $request->phone;
    	$cm->message = $request->message;
    	$cm->save();
        Mail::to($cm)->queue(new EmailContact($cm));
    }
}
