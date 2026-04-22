<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Rider;
use App\Models\Product;
use App\Models\UserProfile;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class OrderController extends Controller
{

  public  function  index()
  {
  $orders = Order::with(['user','vendor','rider','profile','items'])->get();
    // dd($orders);
    return view('orders.index',compact('orders'));
  }

  public function create()
  {
    $users = User::all();
    $vendors = Vendor::all();
    $riders = Rider::all();
    $profiles = UserProfile::all();
    $orders = Order::all();
    $products = Product::all();
    return view('orders.create',compact('users','vendors','riders','profiles','orders','products'));
    
  }

   public function store(Request $request)
   {
           $validate = Validator::make($request->all(),[
             'user_id'=>'required',
             'vendor_id'=>'required',
             'rider_id'=>'required',
             'profile_id'=>'required',
             'order_number'=>'required',
             'subtotal'=>'required',
             'delivery_fee'=>'required',
             'discount'=>'required',
             'tax'=>'required',
             'total'=>'required',
             'payment_status'=>'required',
             'order_status'=>'required',
             'notes'=>'required',
             'placed_at'=>'required',
             'delivered_at'=>'required',

//order items
              'order_id'=>'required',
             'product_id'=>'required',
             'product_name'=>'required',
             'product_price'=>'required',
             'quantity'=>'required',
             'total'=>'required',

           ]);

     if($validate->fails())
        {
            return back()->withErrors($validate)->withInput();
        }
// dd($validate);

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


        $order->items()->create([
            'order_id'=>$request->order_id,
             'product_id'=>$request->product_id,
             'product_name'=>$request->product_name,
             'product_price'=>$request->product_price,
             'quantity'=>$request->quantity,
             'total'=>$request->total,
        ]);
  
         return redirect()->route('orderIndex');
   }

   public function edit($edit_id)
   {
    $orderRecord = Order::where('id',$edit_id)->first();
    $users = User::all();
    $vendors = Vendor::all();
    $riders = Rider::all();
    $profiles = UserProfile::all();
    $orders = Order::all();
    $products = Product::all();


    return view('orders.edit',compact('orderRecord','users','vendors','riders','profiles','orders','products'));

   }

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

      //  $orderRecord->items->first()->update([
      //    'order_id'=>$request->order_id,
      //        'product_id'=>$request->product_id,
      //        'product_name'=>$request->product_name,
      //        'product_price'=>$request->product_price,
      //        'quantity'=>$request->quantity,
      //        'total'=>$request->total,
      //  ]);
            

                  $item = $orderRecord->items()->first();
            
            if ($item) {
                $item->update([
                    'product_id' => $request->product_id,
                    'product_name' => $request->product_name,
                    'product_price' => $request->product_price,
                    'quantity' => $request->quantity,
                     'total'=>$request->total,

                ]);
            } else {
                $orderRecord->items()->create([
                    'product_id' => $request->product_id,
                    'product_name' => $request->product_name,
                    'product_price' => $request->product_price,
                    'quantity' => $request->quantity,
                    'total'=>$request->total,
                
                    ]);
            }
                      return \redirect()->route('orderIndex');  
     } 


     public function destroy($delete_id)
     {
        Order::where('id',$delete_id)->first()->delete();
          return \redirect()->route('orderIndex');  

     }
}
