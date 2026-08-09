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
      $users = User::where('role','rider')->get();
    return view('orders.index',compact('orders','users'));
  }

  public function create()
  {
    $users = User::all();
    $vendors = Vendor::all();
    $riders = User::where('role','rider')->get();
    $profiles = UserProfile::all();
    $products = Product::all();
    return view('orders.create',compact('users','vendors','riders','profiles','products'));
  }

  public function store(Request $request)
  {
           $validate = Validator::make($request->all(),[
             'vendor_id'=>'required',
             'rider_id'=>'required',
             'profile_id'=>'required',
             'order_number'=>'required',
             'delivery_fee'=>'required|numeric',
             'discount'=>'required|numeric',
             'tax'=>'required|numeric',
             'payment_status'=>'required',
             'order_status'=>'required',
             'notes'=>'required',
             'placed_at'=>'required',
             'delivered_at'=>'required',
             'product_id'=>'required|array|min:1',
             'product_id.*'=>'required|exists:products,id',
             'quantity'=>'required|array|min:1',
             'quantity.*'=>'required|integer|min:1',
             'product_price'=>'required|array|min:1',
             'product_price.*'=>'required|numeric|min:0',
             'item_total'=>'required|array|min:1',
             'item_total.*'=>'required|numeric|min:0',
           ]);

     if($validate->fails())
        {
            return back()->withErrors($validate)->withInput();
        }

        $productIds = $request->input('product_id', []);
        $quantities = $request->input('quantity', []);
        $deliveryFee = $request->input('delivery_fee', 0);
        $discount = $request->input('discount', 0);
        $tax = $request->input('tax', 0);

        $subtotal = 0;

        $order = Order::create([
            'user_id'=>auth()->user()->id,
             'vendor_id'=>$request->vendor_id,
             'rider_id'=>$request->rider_id,
             'profile_id'=>$request->profile_id,
             'order_number'=>$request->order_number,
             'subtotal'=>0,
             'delivery_fee'=>$deliveryFee,
             'discount'=>$discount,
             'tax'=>$tax,
             'total'=>0,
             'payment_status'=>$request->payment_status,
             'order_status'=>$request->order_status,
             'notes'=>$request->notes,
             'placed_at'=>$request->placed_at,
             'delivered_at'=>$request->delivered_at,
        ]);

        foreach ($productIds as $index => $productId) {
            $quantity = $quantities[$index] ?? 0;
            $product = Product::find($productId);

            if (! $product || $quantity < 1) {
                continue;
            }

            $itemTotal = $product->price * $quantity;
            $subtotal += $itemTotal;

            $order->items()->create([
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_price' => $product->price,
                'quantity' => $quantity,
                'total' => $itemTotal,
            ]);
        }

        $orderTotal = $subtotal + $deliveryFee - $discount + $tax;

        $order->update([
            'subtotal' => $subtotal,
            'total' => $orderTotal,
        ]);

         return redirect()->route('orderIndex');
   }

   public function edit($edit_id)
   {
    $orderRecord = Order::where('id',$edit_id)->first();
    $users = User::all();
    $vendors = Vendor::all();
    $riders =  User::where('role','rider')->get();
    $profiles = UserProfile::all();
    // $orders = Order::all();
    // $products = Product::all();


    return view('orders.edit',compact('orderRecord','users','vendors','riders','profiles'));

   }

     public function update(Request $request)
     {
        $orderRecord = Order::where('id',$request->update_id)->first();

        $orderUpdate = $orderRecord->update(
            [
                 'user_id'=>auth()->user()->id,
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


            //       $item = $orderRecord->items()->first();

            // if ($item) {
            //     $item->update([
            //         'product_id' => $request->product_id,
            //         'product_name' => $request->product_name,
            //         'product_price' => $request->product_price,
            //         'quantity' => $request->quantity,
            //          'total'=>$request->total,

            //     ]);
            // } else {
            //     $orderRecord->items()->create([
            //         'product_id' => $request->product_id,
            //         'product_name' => $request->product_name,
            //         'product_price' => $request->product_price,
            //         'quantity' => $request->quantity,
            //         'total'=>$request->total,

            //         ]);
            // }
                      return \redirect()->route('orderIndex');
     }


     public function destroy($delete_id)
     {
        Order::where('id',$delete_id)->first()->delete();
          return \redirect()->route('orderIndex');

     }
}
