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
    public function index(): View
    {
        $orders = Order::with(['user', 'vendor', 'rider.user', 'profile', 'items'])
            ->latest('id')
            ->get();

        return view('orders.index', [
            'orders' => $orders,
            'riders' => $this->availableRiders(),
        ]);
    }

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

    public function edit(int $edit_id): View
    {
        return view('orders.edit', [
            'orderRecord' => Order::with('items')->findOrFail($edit_id),
            'users' => User::all(),
            'vendors' => Vendor::all(),
            'riders' => $this->availableRiders(),
            'profiles' => UserProfile::all(),
            'products' => Product::all(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $orderRecord = Order::findOrFail($request->update_id);

        $productIds = $request->input('product_id', []);
        $quantities = $request->input('quantity', []);
        $deliveryFee = $request->input('delivery_fee', 0);
        $discount = $request->input('discount', 0);
        $tax = $request->input('tax', 0);
        $subtotal = 0;

        if (count($productIds)) {
            $orderRecord->items()->delete();

            foreach ($productIds as $index => $productId) {
                $product = Product::find($productId);
                $quantity = $quantities[$index] ?? 0;

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
            'vendor_id' => $request->vendor_id,
            'rider_id' => $request->rider_id,
            'profile_id' => $request->profile_id,
            'order_number' => $request->order_number,
            'subtotal' => $subtotal ?: $request->subtotal,
            'delivery_fee' => $deliveryFee,
            'discount' => $discount,
            'tax' => $tax,
            'total' => $subtotal ? $orderTotal : $request->total,
            'payment_status' => $request->payment_status,
            'order_status' => $request->order_status,
            'delivery_status' => $request->rider_id
                ? ($orderRecord->delivery_status === 'Unassigned' ? 'Assigned' : $orderRecord->delivery_status)
                : 'Unassigned',
            'notes' => $request->notes,
            'placed_at' => $request->placed_at,
            'delivered_at' => $request->delivered_at,
        ]);

        return redirect()->route('orderIndex');
    }

    public function destroy(int $delete_id): RedirectResponse
    {
        Order::findOrFail($delete_id)->delete();

        return redirect()->route('orderIndex');
    }

    public function assignRider(AssignRiderRequest $request, $order_id): RedirectResponse
    {
        $order = Order::findOrFail($order_id);
        $riderId = $request->validated('rider_id');

        $order->update([
            'rider_id' => $riderId,
            'order_status' => $riderId && $order->order_status === 'pending' ? 'confirmed' : $order->order_status,
            'delivery_status' => $riderId ? 'Assigned' : 'Unassigned',
        ]);

        return back()->with('success', $riderId ? 'Rider assigned successfully.' : 'Rider assignment removed.');
    }

    private function availableRiders()
    {
        return Rider::with('user')
            ->whereHas('user', fn ($query) => $query->where('role', 'rider'))
            ->get();
    }
}
