<?php

namespace App\Http\Controllers;

use App\blogpost;
use App\blogcategory;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class BlogpostController extends Controller
{

    protected $rules = [
        'title' => ['required','min:2'],
        'post' => ['required'],
        'category' => ['required'],
        'slug' => ['required', 'alpha_dash', 'unique:blogposts'],
        'source' => ['nullable', 'url'],
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() 
    {
        
    }

    public function index()
    {

        // $post = new blogpost;

        $posts = blogpost::get();

        $posts_perpage = blogpost::with(['user', 'blogcategory'])->orderBy('id','desc')->paginate(5);
        
        $cats = blogcategory::all();

        return view('admin.blog.index', compact('posts','posts_perpage', 'cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $cats = blogcategory::all();
        $images = Image::where('id', '<>', 1)->orderBy('id','desc')->get();
        return view('admin.blog.create', compact('cats', 'images'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new blogpost;
        $this->validate($request,$this->rules);
        $post->title = $request->title;
        $post->post = $request->post;
        $post->slug = $request->slug;
        $post->blogcategory_id = $request->category;
        $post->user_id = Auth::id();
        $post->source = $request->source;
        $post->save();

        if (!empty($request->featuredimage)) {
            $image = Image::find($request->featuredimage);
        } else {
            $image = Image::find(1);
        }
        $image = $post->images()->attach($image, ['is_maskot' => 1]);

        if(!empty($request->galleryimg)) {
            foreach($request->galleryimg as $item) {
                $gallery = Image::find($item);
                // $gallery->save();
                $gallery = $post->images()->attach($gallery, ['is_maskot' => 0]);
            }
        }

        return redirect('/admin/blog')->with('message', 'New Post Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\blogpost  $blogpost
     * @return \Illuminate\Http\Response
     */
    public function show(blogpost $blogpost)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\blogpost  $blogpost
     * @return \Illuminate\Http\Response
     */
    public function edit(blogpost $blog)
    {
        $cats = blogcategory::all();
        $images =Image::where("id", "<>", 1)->orderBy("id", "desc")->get();
        return view('admin.blog.edit', compact('blog','cats','images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\blogpost  $blogpost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, blogpost $blog)
    {
        $this->validate($request,[
                    'title' => ['required','min:2'],
                    'post' => ['required'],
                    'category' => ['required'],
                    'slug' => ['required', 'alpha_dash', Rule::unique('blogposts')->ignore($blog->id)],
                ]
        );
        $defaultimg = 1;
        $blog->title = $request->title;
        $blog->post = $request->post;
        $blog->slug = $request->slug;
        $blog->blogcategory_id = $request->category;
        $blog->user_id = Auth::id();
        $blog->source = $request->source;
        $blog->save();
        $blog->images()->detach();

        if (!empty($request->featuredimage)) {
            $image = Image::find($request->featuredimage);
        } else {
            $image = Image::find(1);
        }

        if(!empty($request->galleryimg)) {
            foreach($request->galleryimg as $item) {
                $gallery = Image::find($item);
                $gallery = $blog->images()->attach($gallery, ['is_maskot' => 0]);
            }
        }

        $image = $blog->images()->attach($image, ['is_maskot' => 1]);
        
        return redirect('/admin/blog')->with('message', 'Post Successfully Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\blogpost  $blogpost
     * @return \Illuminate\Http\Response
     */
    public function destroy(blogpost $blog)
    {
        $blog->images()->detach();
        $blog->delete();
        return redirect('/admin/blog')->with('message', 'Post Deleted Successfully');
    }

    public function reloadFeaturedImage(Request $request) {
        if($request->ajax()) {
            $images =Image::where("id", "<>", 1)->orderBy("id", "desc")->get();
            return view('admin.blog.partials._featuredImage', compact('images'))->render();       
        }
    }

    public function reloadGalleryImage(Request $request) {
        if($request->ajax()){
            $images =Image::where("id", "<>", 1)->orderBy("id", "desc")->get();
            return view('admin.blog.partials._galleryImage', compact('images'))->render();
        }
    }
}
