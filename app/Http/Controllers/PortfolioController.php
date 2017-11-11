<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use App\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\PortfolioCategory;

class PortfolioController extends Controller
{
	protected $rules = [
		'title' => ['required', 'min:2', 'max:30'],
		'slug' => ['required', 'alpha_dash', 'unique:portfolios,slug'],
		'description' => ['required'],
        'link' => ['nullable', 'url'],
        'client' => ['nullable'],
	];

    public function index(Request $request) {
    	$portfolios = Portfolio::orderBy('id','desc')->simplePaginate(5,['*'],'portfoliopage');
        $images = Image::where('id', '<>', 1)->orderBy('id','desc')->get();
        if($request->ajax()) {
            return view('admin.portfolio.partials._list', compact('portfolios', 'images'))->render();
        }

    	return view('admin.portfolio.index', compact('portfolios', 'images'));
    }

    public function create() {
    	
        $this->authorize('access-portfolio');

        $categories = PortfolioCategory::get();
    	return view('admin.portfolio.partials._create', compact('categories'))->render();
    }

    public function store(Request $request) {
    	$portfolio = new Portfolio;
    	$this->validate($request, $this->rules);
    	$portfolio->title = $request->title;
    	$portfolio->slug = $request->slug;
    	$portfolio->description = $request->description;
        $portfolio->portfolio_category_id = $request->category;
    	$portfolio->author = Auth::id();
        $portfolio->link = $request->link;
        if(!empty($request->client)) {
            $portfolio->client = $request->client;
        }
        else {
            $portfolio->client = "TopWeb Studio Collection";
        }
    	$portfolio->save();

        if(!empty($request->featuredImage)) {
            $image = Image::find($request->featuredImage);
        }
        else {
            $image = Image::find(1);
        }

        $image = $portfolio->images()->attach($image, ['is_maskot' => 1]);

        if(!empty($request->galleryimg)) {
            foreach($request->galleryimg as $item) {
                $gallery = Image::find($item);
                $gallery = $portfolio->images()->attach($gallery, ['is_maskot' => 0]);
            }
        }

        session()->flash('message','Portfolio Added Successfully');
        $portfolios = Portfolio::orderBy('id','desc')->simplePaginate(5,['*'],'portfoliopage');

        if($request->ajax()) {
            return view('admin.portfolio.partials._list', compact('portfolios'))->render();
        }

        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function edit(Portfolio $pf) {
        $images = Image::where('id', '<>', 1)->get();
        $categories = PortfolioCategory::get();
        return view('admin.portfolio.partials._edit', compact('pf', 'images', 'categories'))->render();
    }

    public function update(Request $request, Portfolio $pf) {
        $this->validate($request, [
                'title' => ['required', 'min:2','max:30'],
                'slug' => ['required', Rule::unique('portfolios')->ignore($pf->id)],
                'description' => ['required'],
                'link' => ['nullable', 'url'],
            ]);
        $pf->title = $request->title;
        $pf->slug = $request->slug;
        $pf->description = $request->description;
        $pf->portfolio_category_id = $request->category;
        $pf->link = $request->link;
        if(!empty($request->client)) {
            $pf->client = $request->client;
        }
        else {
            $pf->client = "TopWeb Studio Collection";
        }
        $pf->save();
        $pf->images()->detach();


        if(!empty($request->featuredImage)) {
            $image = Image::find($request->featuredImage);
        }
        else {
            $image = Image::find(1);
        }

        $pf->images()->attach($image, ['is_maskot' => 1]);

        if(!empty($request->galleryimg)) {
            foreach($request->galleryimg as $item) {
                $gallery = Image::find($item);
                $gallery = $pf->images()->attach($gallery, ['is_maskot' => 0]);
            }
        }

        session()->flash('message', 'Portfolio Edited Successfully');
        $portfolios = Portfolio::orderBy('id','desc')->simplePaginate(5,['*'],'portfoliopage');

        if($request->ajax()) {
            return view('admin.portfolio.partials._list', compact('portfolios'))->render();
        }

        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function destroy(Request $request, Portfolio $pf) {
        $pf->images()->detach();
        $pf->delete();
        session()->flash('message', 'The portfolio deleted successfully');
        $portfolios = Portfolio::orderBy('id','desc')->simplePaginate(5,['*'],'portfoliopage');

        if($request->ajax()) {
            return view('admin.portfolio.partials._list', compact('portfolios'))->render();
        }

        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function reload(Request $request) {
        $images = Image::where('id', '<>', 1)->orderBy('id','desc')->get();
        if($request->ajax()) {
            return view('admin.portfolio.partials._featuredImage', compact('images'))->render();
        }
    }

    public function reloadGallery(Request $request) {
        $images = Image::where('id', '<>', 1)->orderBy('id','desc')->get();
        if($request->ajax()) {
            return view('admin.portfolio.partials._galleryImage', compact('images'))->render();
        }
    }

    
}
