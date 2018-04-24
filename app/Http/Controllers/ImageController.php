<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Image;
use App\Thumbnail;
use App\ImageMid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as ImageIv;

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
        $files = $request->file('file');
        foreach($files as $file) {
            $filename = uniqid() . '_' . time() . '_' . 'original' . '_' . $file->getClientOriginalName();

            //write the image to disc
            $file->storeAs('public/images/original/', $filename);

            //make and write thumbnail to disc
            $thumbDestinationPath = 'storage/images/thumbnail/';
            $thumbName = uniqid() . '_' . time() . '_' . 'thumb' . '_' . $file->getClientOriginalName();
            $thumb = ImageIv::make('storage/images/original/' . $filename)->resize(100,100)->save($thumbDestinationPath . $thumbName);

            //make and write image mid size to disc
            $midDestinationPath = 'storage/images/imageMid/';
            $midName = uniqid() . '_' . time() . '_' . 'mid' . '_' . $file->getClientOriginalName();
            $mid = ImageIv::make('storage/images/original/' . $filename)->resize(300,300)->save($midDestinationPath . $midName);

            $image = new Image;
            $image->name = $filename;
            $image->size = $file->getClientSize();
            $image->type = $file->getClientMimeType();
            $image->user_id = Auth::id();
            $path = 'storage/images/original/' . $filename;
            $image->path = $path;
            $image->save();

            //save thumbnail to database
            $newThumb =  new Thumbnail;
            $newThumb->name = $thumbName;
            $newThumb->location = $thumbDestinationPath . $thumbName;
            $newThumb->size = Storage::size('public/images/thumbnail/' . $thumbName);
            $newThumb->type = Storage::mimeType('public/images/thumbnail/' . $thumbName);
            $newThumb->image_id = $image->id;
            $newThumb->save();

            //save image mid to database
            $newMid =  new ImageMid;
            $newMid->name = $midName;
            $newMid->location = $midDestinationPath . $midName;
            $newMid->size = Storage::size('public/images/imageMid/' . $midName);
            $newMid->type = Storage::mimeType('public/images/imageMid/' . $midName);
            $newMid->image_id = $image->id;
            $newMid->save();
            
        }
        session()->flash('message', 'Image Added Successfully');
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

        if($image->has('thumbnail')) {
            $thumbId = $image->thumbnail->id;
            $thumb = Thumbnail::find($thumbId);
            $thumbName = $thumb->name;
            Storage::delete('public/images/thumbnail/' . $thumbName);
            $thumb->delete();
        }

        if($image->has('imageMid')) {
            $midId = $image->imageMid->id;
            $mid = ImageMid::find($midId);
            $midName = $mid->name;
            Storage::delete('public/images/imageMid/' . $midName);
            $mid->delete();
        }

        Storage::delete('public/images/original/' . $image->name);
        $image->delete();

       session()->flash('message', 'Image Deleted Successfully');
       return redirect()->route('image.index');
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
            'name' => $image->thumbnail->name,
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
