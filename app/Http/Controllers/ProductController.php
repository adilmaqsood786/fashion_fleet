<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
    
  public  function index()
  {
    $product = Product::all();
    return view('products.index',compact('product'));
  }

  public function create()
  { 
     $vendors = Vendor::all();
     $categories = Category::whereNull('parent_id')->get();
// dd($vendors); 
     return view('products.create',compact('vendors','categories'));
  }

  public function store(Request $request)
  {
    $validate = Validator::make($request->all(),[
        'vendor_id'=>'required',
        'category_id'=>'required',
        'name'=>'required',
        'slug'=>'required|nullable',
        'short_description'=>'required',
        'description'=>'required',
        'sku'=>'required',
        'price'=>'required',
        'sale_price'=>'required',
        'stock'=>'required',
        'main_image'=>'required|image|mimes:png,jpg,jpeg|max:2048',
        'is_active'=>'required',
        'is_featured'=>'required',

    ]);
    // dd($validate);
    if($validate->fails())
        {
               return back()->withErrors($validate)->withInput();
        }

//image
     $main = null;
     if($request->hasfile('main_image'))
        {
             $path = $request->file('main_image')->store('/product','public');
             $main = $path;
        }


   Product::create([
                   
        'vendor_id'=>$request->vendor_id,
        'category_id'=>$request->category_id,
        'name'=>$request->name,
        'slug'=>$request->slug,
        'short_description'=>$request->short_description,
        'description'=>$request->description,
        'sku'=>$request->sku,
        'price'=>$request->price,
        'sale_price'=>$request->sale_price,
        'stock'=>$request->stock,
        'main_image'=>$main,
        'is_active'=>$request->is_active,
        'is_featured'=>$request->is_featured,
 ]);


     return \redirect()->route('productIndex');
  }

     
  public function edit($edit_id)
  {
     $productRecord = Product::where('id',$edit_id)->first();
     return \view('products.edit',compact('productRecord'));
  }

  public function update(Request $request)
  {
     
      $productRecord = Product::where('id',$request->update_id)->first();

      //image
     $main = $productRecord->image;
     if($request->hasfile('main_image'))
        {
             $path = $request->file('main_image')->store('/product','public');
             $main = $path;
        }

      $porductUpdate = $productRecord->update([
               
  'vendor_id'=>$request->vendor_id,
        'category_id'=>$request->category_id,
        'name'=>$request->name,
        'slug'=>$request->slug,
        'short_description'=>$request->short_description,
        'description'=>$request->description,
        'sku'=>$request->sku,
        'price'=>$request->price,
        'sale_price'=>$request->sale_price,
        'stock'=>$request->stock,
        'main_image'=>$main,
        'is_active'=>$request->is_active,
        'is_featured'=>$request->is_featured,

      ]);  

      return \redirect()->route('productIndex');
  }


  public function destroy($delete_id)
  {
    Product::where('id',$delete_id)->first()->delete();

    return \redirect()->route('productIndex');
  }



}
