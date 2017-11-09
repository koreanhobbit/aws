<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailResponse;
use App\blogpost;
use App\Portfolio;
use App\teamprofile;
use App\Setting;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request) {
        $setting = Setting::find(1);
    	$messagesCount = Contact::orderBy('id', 'desc')->get();
        $blogCount = blogpost::count();
        $portfolioCount = Portfolio::count();
        $memberCount = teamprofile::count();
        $messages = Contact::where('status', '=', 0)->orderBy('id', 'desc')->simplePaginate(5, ['*'], 'messages');

    	if ($request->ajax()) {
    		return view('admin.home.partials._timeline', compact('messagesCount', 'messages', 'blogCount', 'portfolioCount', 'memberCount', 'setting'))->render();
    	}

    	return view('admin.home.index', compact('messagesCount', 'messages', 'blogCount', 'portfolioCount', 'memberCount', 'setting')); 
    }

    public function allMessages(Request $request) {
        $messagesCount = Contact::orderBy('id', 'desc')->get();
        $messages = Contact::orderBy('id', 'desc')->simplePaginate(5, ['*'], 'messages');

        if ($request->ajax()) {
            return view('admin.home.partials._timeline', compact('messages'))->render();
        }

        return view('admin.home.index', compact('messagesCount', 'messages'));
    }

    public function reply(Request $request, Contact $rp) {
        if ($request->ajax()) {
            return view('admin.home.partials._reply', compact('rp'))->render();
        }
    }

    public function updateContact(Request $request, Contact $rp) {
        $rp->response = $request->response;
        $rp->status = 1;
        $rp->save();
        
        Mail::to($rp)->queue(new EmailResponse($rp));

        return view('admin.home.partials._reply', compact('rp'))->render();
    }
}
