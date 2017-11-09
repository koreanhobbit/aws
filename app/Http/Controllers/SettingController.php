<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Image;
use App\Websitesocmed;

class SettingController extends Controller
{
	protected $rules = [
		'site_title' => ['required'],
		'tagline' => ['required'],
	];

    public function index(Request $request) {
    	$setting = Setting::get();
    	$images = Image::orderBy('id', 'desc')->get();

    	if ($request->ajax()) {
    		return view('admin.setting.partials._general', compact('setting', 'images'))->render();
    	}
    	return view('admin.setting.index', compact('setting', 'images'));
    }

    public function update(Request $request, Setting $set) {
    	$this->validate($request, $this->rules);
    	foreach(Websitesocmed::get() as $item) {
    		$this->validate($request, [
    			$item->slug => ['required'],
    		]);
    	}

    	$set->site_title = $request->site_title;
    	$set->tagline = $request->tagline;
    	$set->save();

    	foreach($set->websitesocialmedias as $item) {
    		$socmed = $item->slug;
    		if(!empty($request->$socmed)) {
    			$item->link = $request->$socmed;
    			$item->save();
    		}
    	}

    	$set->images()->detach();

    	$logo_id = $request->site_logo;
    	$logo = Image::where('id', '=', $logo_id)->get();
    	$logo = $set->images()->attach($logo, ['is_maskot' => 1]);

    	$icon_id = $request->site_icon;
    	$icon = Image::where('id', '=', $icon_id)->get();
    	$icon = $set->images()->attach($icon, ['is_maskot' => 0]); 

    	$setting = Setting::get();
    	$images = Image::orderBy('id', 'desc')->get();
        $request->session()->flash('message', 'Setting was save successfully!');

    	if ($request->ajax()) {
    		return view('admin.setting.partials._general', compact('setting', 'images'))->render();
    	}
    	return view('admin.setting.index', compact('setting', 'images'));

    }

    public function reloadLogoList(Request $request) {
    	$images = Image::orderBy('id', 'desc')->get();
    	if($request->ajax()) {
    		return view('admin.setting.partials._logoList', compact('images'))->render();
    	}
    }

    public function reloadIconList(Request $request) {
    	$images = Image::orderBy('id', 'desc')->get();
    	if($request->ajax()) {
    		return view('admin.setting.partials._iconList', compact('images'))->render();
    	}
    }
}
