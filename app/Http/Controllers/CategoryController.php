<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\blogcategory;

class CategoryController extends Controller
{

	protected $rules = [
		'categoryName' => ['required', 'min:2'],
		'categorySlug' => ['required', 'alpha_dash'],
	];


    public function __construct() 
    {
        
    }

    public function index(Request $request) {
    	$cats = blogcategory::orderBy('id', 'asc')->simplePaginate(10,['*'],'categorypage');

        if($request->ajax()) {
            return view('admin.category.partials._list', compact('cats'))->render();
        }

    	return view('admin.category.index', compact('cats'));
    }

    public function store(Request $request) {
    	$category = new blogcategory;
    	$this->validate($request, $this->rules);
    	$category->category = $request->categoryName;
        $category->slug = $request->categorySlug;
    	$category->save();
    	
        $cats = blogcategory::orderBy('id', 'asc')->simplePaginate(10,['*'],'categorypage');

        if($request->ajax()) {
            return view('admin.category.partials._list', compact('cats'))->render();
        }

        return view('admin.category.index', compact('cats'));
    }

    public function edit(blogcategory $cat) {
    	return response()->json([
                'categoryName' => $cat->category,
                'categorySlug' => $cat->slug,
                'id' => $cat->id,
                'dataUrl' => route('category.update', $cat->id),
            ]);
    }

    public function update(Request $request, blogcategory $cat) {
        $this->validate($request, $this->rules);
        $cat->category = $request->categoryName;
        $cat->slug = $request->categorySlug;
        $cat->save();

        $cats = blogcategory::orderBy('id', 'asc')->simplePaginate(10,['*'],'categorypage');

        if($request->ajax()) {
            return view('admin.category.partials._list', compact('cats'))->render();
        }

        return view('admin.category.index', compact('cats'));
    }

    public function destroy(Request $request, blogcategory $cat) {
    	$cat->delete();
        $cats = blogcategory::orderBy('id', 'asc')->simplePaginate(10,['*'],'categorypage');

        if($request->ajax()) {
            return view('admin.category.partials._list', compact('cats'))->render();
        }

        return view('admin.category.index', compact('cats'));
    }
}
