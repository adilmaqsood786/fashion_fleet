<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignRiderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rider;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $deliveryStatus = $request->string('delivery_status')->toString();

<<<<<<< HEAD
  public function index()
  {
  $orders = Order::with(['user','vendor','rider.user','profile','items'])->latest('id')->get();
    // dd($orders);
      $riders = Rider::with('user')->whereHas('user', fn ($q) => $q->where('role', 'rider'))->get();
    return view('orders.index',compact('orders','riders'));
  }

  public function create()
  {
    $users = User::all();
    $vendors = Vendor::all();
    $riders = Rider::with('user')->whereHas('user', fn ($q) => $q->where('role', 'rider'))->get();
    $profiles = UserProfile::all();
    $products = Product::all();
    return view('orders.create',compact('users','vendors','riders','profiles','products'));
  }
=======
        $orders = Order::with(['user', 'vendor', 'rider.user', 'profile', 'items'])
            ->when(
                in_array($deliveryStatus, ['Unassigned', 'Assigned', 'Out for Delivery', 'Delivered'], true),
                fn ($query) => $query->withDeliveryStatus($deliveryStatus),
            )
            ->latest('placed_at')
            ->get();

        return view('orders.index', [
            'orders' => $orders,
            'riders' => $this->availableRiders(),
            'deliveryStatus' => $deliveryStatus,
        ]);
    }
>>>>>>> 3eae94efffc3be2c83a561ef922120c105aefa09

    public function create(): View
    {
        return view('orders.create', [
            'users' => User::all(),
            'vendors' => Vendor::all(),
            'riders' => $this->availableRiders(),
            'profiles' => UserProfile::all(),
            'products' => Product::all(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'vendor_id' => ['required', 'exists:vendors,id'],
            'rider_id' => ['nullable', 'exists:riders,id'],
            'profile_id' => ['required', 'exists:user_profiles,id'],
            'order_number' => ['required', 'unique:orders,order_number'],
            'delivery_fee' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
            'tax' => ['required', 'numeric'],
            'payment_status' => ['required'],
            'order_status' => ['required'],
            'notes' => ['required'],
            'placed_at' => ['required'],
            'delivered_at' => ['nullable'],
            'product_id' => ['required', 'array', 'min:1'],
            'product_id.*' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'array', 'min:1'],
            'quantity.*' => ['required', 'integer', 'min:1'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $productIds = $request->input('product_id', []);
        $quantities = $request->input('quantity', []);
        $deliveryFee = $request->input('delivery_fee', 0);
        $discount = $request->input('discount', 0);
        $tax = $request->input('tax', 0);
        $subtotal = 0;

        $order = Order::create([
            'user_id' => auth()->id(),
            'vendor_id' => $request->vendor_id,
            'rider_id' => $request->rider_id,
            'profile_id' => $request->profile_id,
            'order_number' => $request->order_number,
            'subtotal' => 0,
            'delivery_fee' => $deliveryFee,
            'discount' => $discount,
            'tax' => $tax,
            'total' => 0,
            'payment_status' => $request->payment_status,
            'order_status' => $request->order_status,
            'delivery_status' => $request->rider_id ? 'Assigned' : 'Unassigned',
            'notes' => $request->notes,
            'placed_at' => $request->placed_at,
            'delivered_at' => $request->delivered_at,
        ]);

        foreach ($productIds as $index => $productId) {
            $product = Product::find($productId);
            $quantity = $quantities[$index] ?? 0;

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

        $order->update([
            'subtotal' => $subtotal,
            'total' => $subtotal + $deliveryFee - $discount + $tax,
        ]);

        return redirect()->route('orderIndex');
    }

<<<<<<< HEAD
   public function edit($edit_id)
   {
    $orderRecord = Order::where('id',$edit_id)->first();
    $users = User::all();
    $vendors = Vendor::all();
    $riders = Rider::with('user')->whereHas('user', fn ($q) => $q->where('role', 'rider'))->get();
    $profiles = UserProfile::all();
    $products = Product::all();
=======
    public function edit(int $editId): View
    {
        return view('orders.edit', [
            'orderRecord' => Order::with('items')->findOrFail($editId),
            'users' => User::all(),
            'vendors' => Vendor::all(),
            'riders' => $this->availableRiders(),
            'profiles' => UserProfile::all(),
            'products' => Product::all(),
        ]);
    }
>>>>>>> 3eae94efffc3be2c83a561ef922120c105aefa09

    public function update(Request $request): RedirectResponse
    {
        $order = Order::findOrFail($request->update_id);

        $order->update([
            'vendor_id' => $request->vendor_id,
            'rider_id' => $request->rider_id,
            'profile_id' => $request->profile_id,
            'order_number' => $request->order_number,
            'delivery_fee' => $request->delivery_fee,
            'discount' => $request->discount,
            'tax' => $request->tax,
            'payment_status' => $request->payment_status,
            'order_status' => $request->order_status,
            'delivery_status' => $request->rider_id ? ($order->delivery_status === 'Unassigned' ? 'Assigned' : $order->delivery_status) : 'Unassigned',
            'notes' => $request->notes,
            'placed_at' => $request->placed_at,
            'delivered_at' => $request->delivered_at,
        ]);

        return redirect()->route('orderIndex');
    }

    public function assignRider(AssignRiderRequest $request, Order $order): RedirectResponse
    {
        $riderId = $request->validated('rider_id');

        $order->update([
            'rider_id' => $riderId,
            'delivery_status' => $riderId ? 'Assigned' : 'Unassigned',
        ]);

        return back()->with('success', $riderId ? 'Rider assigned successfully.' : 'Rider assignment removed.');
    }

    public function destroy(int $deleteId): RedirectResponse
    {
        Order::findOrFail($deleteId)->delete();

        return redirect()->route('orderIndex');
    }

<<<<<<< HEAD
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
             'user_id'=>auth()->user()->id,
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

        return \redirect()->route('orderIndex');
     }


     public function destroy($delete_id)
     {
        Order::where('id',$delete_id)->first()->delete();
          return \redirect()->route('orderIndex');

     }

     public function assignRider(Request $request, $order_id)
     {
        $validate = Validator::make($request->all(),[
            'rider_id' => 'required|exists:riders,id',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate);
        }

        $order = Order::findOrFail($order_id);

        $order->update([
            'rider_id' => $request->rider_id,
            'order_status' => $order->order_status === 'pending' ? 'assigned' : $order->order_status,
        ]);

        return back()->with('success', 'Rider assigned successfully.');
     }
=======
    private function availableRiders()
    {
        return Rider::with('user')
            ->where('is_available', 1)
            ->where('is_verified', 1)
            ->whereHas('user', fn ($query) => $query->where('role', 'rider'))
            ->get();
    }
>>>>>>> 3eae94efffc3be2c83a561ef922120c105aefa09
}
