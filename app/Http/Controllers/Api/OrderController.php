<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
     public  function  index()
  {
  $orders = Order::with(['user','vendor','rider','profile','items'])->get();
    // dd($orders);
     return response()->json([
        "message"=>"success",
        "data"=>$orders
     ]);
     
    }



//store method
     public function store(Request $request)
   {


       $order = Order::create([
            'user_id'=>$request->user_id,
             'vendor_id'=>$request->vendor_id,
             'rider_id'=>$request->rider_id,
             'profile_id'=>$request->profile_id,
             'order_number'=>$request->order_number,
             'subtotal'=>$request->subtotal,
             'delivery_fee'=>$request->delivery_fee,
             'discount'=>$request->discount,
             'tax'=>$request->tax,
             'total'=>$request->total,
             'payment_status'=>$request->payment_status,
             'order_status'=>$request->order_status,
             'notes'=>$request->notes,
             'placed_at'=>$request->placed_at,
             'delivered_at'=>$request->delivered_at,
        ]);

return response()->json([
    "message"=>"success"
    ,"data"=>$order
]);      

        }



   //edit  method
    public function edit($edit_id)
   {
    $orderRecord = Order::where('id',$edit_id)->first();
    // $users = User::all();
    // $vendors = Vendor::all();
    // $riders = Rider::all();
    // $profiles = UserProfile::all();
    // // $orders = Order::all();
    // // $products = Product::all();


    return \response()->json([
         "message"=>"success"
    ,"data"=>$orderRecord
    ]);

   }    
 
   //update method

     public function update(Request $request)
     {
        $orderRecord = Order::where('id',$request->update_id)->first();

        $orderUpdate = $orderRecord->update(
            [
                 'user_id'=>$request->user_id,
             'vendor_id'=>$request->vendor_id,
             'rider_id'=>$request->rider_id,
             'profile_id'=>$request->profile_id,
             'order_number'=>$request->order_number,
             'subtotal'=>$request->subtotal,
             'delivery_fee'=>$request->delivery_fee,
             'discount'=>$request->discount,
             'tax'=>$request->tax,
             'total'=>$request->total,
             'payment_status'=>$request->payment_status,
             'order_status'=>$request->order_status,
             'notes'=>$request->notes,
             'placed_at'=>$request->placed_at,
             'delivered_at'=>$request->delivered_at,
            ]);
 
       return \response()->json([

        "message"=>"success"
    ,"data"=>$orderUpdate
       ]);


     }
       //delete method
         public function destroy($delete_id)
     {
       $delete = Order::where('id',$delete_id)->first()->delete();
    
       return \response()->json([
         "message"=>"success"
    ,"data"=>$delete
       ]);
     } 




}
