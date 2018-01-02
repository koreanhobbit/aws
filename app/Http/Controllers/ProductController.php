<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\CategoryProduct;
use App\Product;
use Illuminate\Validation\Rule;
use App\ParameterProduct;

class ProductController extends Controller
{
    protected $rules = [
        'name_product' => ['required', 'min:2'],
        'price_product' => ['required_with:sale_price_product','integer'],
        'sale_price_product' => ['integer'],
        'description_product' => ['required'],
        'category_product' => ['required'],
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category','images')->orderBy('id', 'desc')->paginate(5);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parameters = ParameterProduct::orderBy('id', 'asc')->get();
        $categories = CategoryProduct::orderBy('id', 'asc')->get();
        $images = Image::where('id', '<>', 1)->orderBy('id', 'desc')->get();
        return view('admin.product.create', compact('images', 'categories', 'parameters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $product = new Product;
        $this->validate($request, $this->rules);
        $this->validate($request, [
             'slug_product' => ['required', 'alpha_dash', 'unique:products,slug'],
        ]);
        foreach(ParameterProduct::get() as $item)
        {
            $this->validate($request, [
                $item->id_name => ['nullable'],
            ]);
        }
        $product->name = $request->name_product;
        $product->slug = $request->slug_product;
        $product->price = $request->price_product;
        if(!empty($request->sale_price_product) && $request->sale_price_product > 0) 
        {
            $product->is_sale = true;
        }
        else
        {
            $product->is_sale = false;
        }
        $product->sale_price = $request->sale_price_product;
        $product->description = $request->description_product;
        $product->is_published = $request->is_published;
        $product->product_category_id = $request->category_product;
        $product->save();

        foreach(ParameterProduct::get() as $item)
        {
            $value = $item->id_name;
            if(!empty($request->$value))
            {
                $item = $product->parameters()->attach($item, ['value' => $request->$value]);
            }
        }
       

        if(!empty($request->featuredimage))
        {
            $fi = Image::find($request->featuredimage);
        }
        else
        {
            $fi = Image::find(1);
        }
        $fi = $product->images()->attach($fi, ['is_maskot' => 1]);

        if(!empty($request->galleryimg))
        {
            foreach($request->galleryimg as $item)
            {   
                $gi = Image::find($item);
                $gi = $product->images()->attach($gi, ['is_maskot' => 0]);
            }
        }
        
        return redirect()->route('product.index')->with('message', 'New Product Succesfully Added..');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $parameters = ParameterProduct::orderBy('id', 'asc')->get();
        $categories = CategoryProduct::orderBy('id', 'asc')->get();
        $images = Image::where('id', '<>', 1)->orderBy('id', 'desc')->get();
        return view('admin.product.edit', compact('images', 'categories', 'product', 'parameters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, $this->rules);
        $this->validate($request,[
             'slug_product' => ['required', 'alpha_dash', Rule::unique('products','slug')->ignore($product->id)],
        ]);
        foreach(ParameterProduct::get() as $item)
        {
            $this->validate($request, [
                $item->id_name => ['nullable'],
            ]);
        }
        $product->name = $request->name_product;
        $product->slug = $request->slug_product;
        $product->price = $request->price_product;
        if(!empty($request->sale_price_product) && $request->sale_price_product > 0) 
        {
            $product->is_sale = true;
        }
        else
        {
            $product->is_sale = false;
        }
        $product->sale_price = $request->sale_price_product;
        $product->description = $request->description_product;
        $product->is_published = $request->is_published;
        $product->product_category_id = $request->category_product;
        $product->save();
        $product->images()->detach();
        $product->parameters()->detach();

        foreach(ParameterProduct::get() as $item)
        {
            $value = $item->id_name;
            if(!empty($request->$value))
            {
                $item = $product->parameters()->attach($item, ['value' => $request->$value]);
            }
        }

        if(!empty($request->featuredimage))
        {
            $fi = Image::find($request->featuredimage);
        }
        else
        {
            $fi = Image::find(1);
        }
        $fi = $product->images()->attach($fi, ['is_maskot' => 1]);

        if(!empty($request->galleryimg))
        {
            foreach($request->galleryimg as $item)
            {   
                $gi = Image::find($item);
                $gi = $product->images()->attach($gi, ['is_maskot' => 0]);
            }
        }
        
        return redirect()->route('product.index')->with('message', 'Product successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request, Product $product)
    {
        $product->parameters()->detach();
        $product->images()->detach();
        $product->delete();
        return redirect()->route('product.index')->with('message', 'The product has been deleted successfully');
    }

    public function reloadFeaturedImageList(Request $request) 
    {
        $images = Image::where('id', '<>', 1)->orderBy('id', 'desc')->get();
        if ($request->ajax())
        {
            return view('admin.product.partials._featuredimage', compact('images'))->render();
        }
    }
    public function reloadGalleryImageList(Request $request) 
    {
        $images = Image::where('id', '<>', 1)->orderBy('id', 'desc')->get();
        if($request->ajax())
        {
            return view('admin.product.partials._galleryimages', compact('images'))->render();
        }
    }
}
