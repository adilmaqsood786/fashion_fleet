<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductImage;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Validator;    

class ProductImageController extends Controller
{

public function index(){
    // $image = ProductImage::select('product_id','image_path')->get();
    $image = ProductImage::with(['product'])->get();

    return view('productImages.index',compact('image')); 
}
    
    public function create()
    {
        $product = Product::all();

        return view('productImages.create',compact('product'));
    }


    public function store(Request $request)
    {
    $validate = Validator::make($request->all(),
             [
                'product_id'=>'required',
                'image_path'=>'required| image|mimes:jpeg,png,jpg|max:2048',
                'sort_order'=>'required|int',
             ]);

    // dd($validate);      

           if($validate->fails())
    {
        return back()->withErrors($validate)->withInput();
    }

              //image store
              $imgPath = null;
              if($request->hasFile('image_path'))
                {
                    $path = $request->file('image_path')->store('productImage/','public');
                     $imgPath = $path;
                }
          
            ProductImage::create([
                 'product_id'=>$request->product_id,
                'image_path'=>$imgPath,
                'sort_order'=>$request->sort_order,
            ]);
   


           return \redirect()->route('imageIndex');


    }
    

    public function edit($edit_id)
    {
        $imageRecord = ProductImage::where('id',$edit_id)->first();
          $product = Product::all();
        return view('productImages.edit',compact('imageRecord','product'));
        
        }

    public function update(Request $request)
    {
        $imageRecord = ProductImage::where('id',$request->update_id)->first();
         
        //image store
              $imgPath = $imageRecord->image_path;
              if($request->hasFile('image_path'))
                {
                    $path = $request->file('image_path')->store('productImage/','public');
                     $imgPath = $path;
                }

          
                $imageUpdate = $imageRecord->update([
                 'product_id'=>$request->product_id,
                'image_path'=>$imgPath,
                'sort_order'=>$request->sort_order,
                ]);

           return \redirect()->route('imageIndex');


    } 
   
    public function destroy($delete_id)
    {
        ProductImage::where('id',$delete_id)->first()->delete();
           return \redirect()->route('imageIndex');

    }

}
