<?php

namespace App\Http\Controllers\Api;
use App\Models\ProductImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    //index method
    
public function index(){
    $image = ProductImage::with(['product'])->get();
     return \response()->json([
        "message"=>"success",
        "data"=>$image
        
     ]);
}

//store method
  public function store(Request $request)
    {

              //image store
              $imgPath = null;
              if($request->hasFile('image_path'))
                {
                    $path = $request->file('image_path')->store('productImage/','public');
                     $imgPath = $path;
                }
          
        $store =    ProductImage::create([
                 'product_id'=>$request->product_id,
                'image_path'=>$imgPath,
                'sort_order'=>$request->sort_order,
            ]);
   
 return \response()->json([
        "message"=>"success",
        "data"=>$store
     ]);
    }
  


    //edit method
    
    public function edit($edit_id)
    {
        $imageRecord = ProductImage::where('id',$edit_id)->first();
           return \response()->json([
        "message"=>"success",
        "data"=>$imageRecord
        
     ]);
        
        }


//update method

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

 return \response()->json([
        "message"=>"success",
        "data"=>$imageUpdate
        
     ]);

    } 


//delete method

    public function destroy($delete_id)
    {
      $delete =  ProductImage::where('id',$delete_id)->first()->delete();
         return \response()->json([
        "message"=>"success",
        "data"=>$delete
        
     ]);
    }























}
