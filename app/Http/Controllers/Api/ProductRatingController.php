<?php

namespace App\Http\Controllers\Api;
use App\Models\ProductRating;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductRatingController extends Controller
{
    //index method
     public function index()
    {
        $rating = ProductRating::with(['product','user','order'])->get();
        return response()->json([
            "message"=>"success",
            "data"=>$rating 
        ]);
    }


    //store method
    
    public function store(Request $request)
    {
        
         $rating   =    ProductRating::create([
                 'product_id'=>$request->product_id,
                  'user_id'=>$request->user_id,
                  'order_id'=>$request->order_id,
                  'rating'=>$request->rating ,
                  'title'=>$request->title,
                  'review'=>$request->review,
                  'is_approved'=>$request->is_approved,
            ]);
return response()->json([
     "message"=>"success",
     "data"=>$rating 
]);
        
    }


//edit method 
 public function edit($edit_id)
      {
        $ratingRecord = ProductRating::where('id',$edit_id)->first();
        // $users =  User::all();
        // $products =  Product::all();
        // $orders =  Order::all();

return response()->json([
     "message"=>"success",
     "data"=>$ratingRecord
]);
        }


        //update method
         public function update(Request $request)
       {
         $ratingRecord = ProductRating::where('id',$request->update_id)->first();
         $ratingUpdate  = $ratingRecord->update([
             'product_id'=>$request->product_id,
                  'user_id'=>$request->user_id,
                  'order_id'=>$request->order_id,
                  'rating'=>$request->rating ,
                  'title'=>$request->title,
                  'review'=>$request->review,
                  'is_approved'=>$request->is_approved,
         ]);
 
          return response()->json([
     "message"=>"success",
     "data"=>$ratingUpdate
]);
         }

         //Delete method
          public function destroy($delete_id)
        {
            $delete = ProductRating::where('id',$delete_id)->first()->delete();
           return response()->json([
                    "message"=>"success",
                    "data"=>$delete
              ]);

            }






}
