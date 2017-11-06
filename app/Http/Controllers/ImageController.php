<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::where('id', '<>', 1)->orderBy('id','desc')->get();
        return view('admin.image.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = new Image;

        $file = $request->file('file');
        $filename = uniqid() . '_' . $file->getClientOriginalName();
        $image->path = 'storage/images/';
        $image->name = $filename;
        $image->user_id = Auth::id();
        $image->size = $file->getClientSize();
        $image->type = $file->getClientMimeType();
        // $image->is_maskot = 1;
        $image->save();
        $file->move($image->path, $filename);
        session()->flash('message', 'Image Added Successfully');
        return $image;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        if(count($image->blogposts)) {
            session()->flash('message', 'You cannot delete the image. It is used as Post image');
            return redirect('admin/image');

        }

        if(count($image->portfolios)) {
            session()->flash('message', 'You cannot delete the image. It is used as Portfolio image');
            return redirect('admin/image');
        }

        if(count($image->users)) {
            session()->flash('message', 'You cannot delete the image. It is used as Team Profile image');
            return redirect('admin/image');
        }

        if(count($image->settings)) {
            session()->flash('message', 'You cannot delete the image. It is used as Setting image');
            return redirect('admin/image');
        }

        Storage::delete($image->path.$image->name);
        $image->delete();

       session()->flash('message', 'Image Deleted Successfully');
       return redirect('admin/image');
    }

    public function ajaxForModal (Request $request) {
        $id = $request->input('id');
        $image = Image::find($id);
        if(!empty($image->blogposts->all())) {
            $imageable_type = 'Blog Post_'.$image->blogposts->first()->title; 
        }
        else {
            $imageable_type = 'Media';
        }
        return response()->json([
            'id' => $image->id,
            'name' => $image->name,
            'size' => $image->size,
            'type' => $image->type,
            'imageable_type' => $imageable_type,
            'created_at' => $image->created_at,
            'updated_at' => $image->updated_at,
            'author' => $image->user->name,
            'action' => route('image.destroy', ['image' => $image->id]),
        ]);
    }   
}
