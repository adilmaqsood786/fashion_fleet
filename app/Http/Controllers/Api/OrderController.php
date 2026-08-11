<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrderController extends Controller
{
     public function index()
  {
  $orders = Order::with(['user','vendor','rider','profile','items'])->get();
    return response()->json([
        "message"=>"success",
        "data"=>$orders
     ]);
    }

    public function customerOrders(Request $request)
    {
        $user = $request->user();

        if (! $user) {
            return response()->json([
                'message' => 'Unauthenticated',
                'data' => []
            ], 401);
        }

        $orders = Order::with(['vendor','rider','profile','items'])
            ->where('user_id', $user->id)
            ->get();

        return response()->json([
            'message' => 'success',
            'data' => $orders,
        ]);
    }

//store method
     public function store(Request $request)
   {
        $user = $request->user();

        if ($user && $user->role === 'customer' && ! $request->filled('profile_id') && $user->profile) {
            $request->merge(['profile_id' => $user->profile->id]);
        }

        $validate = Validator::make($request->all(), [
            'user_id' => 'nullable|exists:users,id',
            'vendor_id' => 'required|exists:vendors,id',
            'rider_id' => 'nullable|exists:riders,id',
            'profile_id' => 'nullable|exists:user_profiles,id',
            'order_number' => 'nullable|string|unique:orders,order_number',
            'delivery_fee' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'tax' => 'nullable|numeric',
            'payment_status' => 'required|string',
            'order_status' => 'required|string',
            'notes' => 'nullable|string',
            'placed_at' => 'nullable|date',
            'delivered_at' => 'nullable|date',
            'product_id' => 'required|array|min:1',
            'product_id.*' => 'required|exists:products,id',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|integer|min:1',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => 'validation_error',
                'errors' => $validate->errors(),
            ], 422);
        }

        $userId = $user ? $user->id : $request->input('user_id');

        if (! $userId) {
            return response()->json([
                'message' => 'user_id_required',
                'errors' => ['user_id' => ['The user_id or authenticated customer is required.']],
            ], 422);
        }

        $orderNumber = $request->input('order_number') ?: 'ORD-'.now()->format('YmdHis').'-'.Str::upper(Str::random(4));
        $productIds = $request->input('product_id', []);
        $quantities = $request->input('quantity', []);
        $deliveryFee = $request->input('delivery_fee', 0);
        $discount = $request->input('discount', 0);
        $tax = $request->input('tax', 0);
        $subtotal = 0;

        $order = Order::create([
            'user_id' => $userId,
            'vendor_id' => $request->vendor_id,
            'rider_id' => $request->rider_id,
            'profile_id' => $request->profile_id,
            'order_number' => $orderNumber,
            'subtotal' => 0,
            'delivery_fee' => $deliveryFee,
            'discount' => $discount,
            'tax' => $tax,
            'total' => 0,
            'payment_status' => $request->payment_status,
            'order_status' => $request->order_status,
            'notes' => $request->notes,
            'placed_at' => $request->placed_at,
            'delivered_at' => $request->delivered_at,
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
        $order->update(['subtotal' => $subtotal, 'total' => $orderTotal]);

return response()->json([
    "message"=>"success",
    "data"=>$order->load('items')
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

        $productIds = $request->input('product_id', []);
        $quantities = $request->input('quantity', []);
        $deliveryFee = $request->input('delivery_fee', 0);
        $discount = $request->input('discount', 0);
        $tax = $request->input('tax', 0);

        $subtotal = 0;

        if (count($productIds)) {
            $orderRecord->items()->delete();

            foreach ($productIds as $index => $productId) {
                $quantity = $quantities[$index] ?? 0;
                $product = Product::find($productId);

                if (! $product || $quantity < 1) {
                    continue;
                }

                $itemTotal = $product->price * $quantity;
                $subtotal += $itemTotal;

                $orderRecord->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_price' => $product->price,
                    'quantity' => $quantity,
                    'total' => $itemTotal,
                ]);
            }
        }

        $orderTotal = $subtotal + $deliveryFee - $discount + $tax;

        $orderRecord->update([
             'user_id'=>$request->user_id,
             'vendor_id'=>$request->vendor_id,
             'rider_id'=>$request->rider_id,
             'profile_id'=>$request->profile_id,
             'order_number'=>$request->order_number,
             'subtotal'=>$subtotal ?: $request->subtotal,
             'delivery_fee'=>$deliveryFee,
             'discount'=>$discount,
             'tax'=>$tax,
             'total'=>$subtotal ? $orderTotal : $request->total,
             'payment_status'=>$request->payment_status,
             'order_status'=>$request->order_status,
             'notes'=>$request->notes,
             'placed_at'=>$request->placed_at,
             'delivered_at'=>$request->delivered_at,
            ]);
 
       return \response()->json([

        "message"=>"success",
        "data"=>$orderRecord
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
