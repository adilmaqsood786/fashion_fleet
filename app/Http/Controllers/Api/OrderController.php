<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'success',
            'data' => Order::with(['vendor', 'rider', 'profile', 'items.product'])->get(),
        ]);
    }

    public function show(Order $order): JsonResponse
    {
        return response()->json([
            'message' => 'success',
            'data' => $order->load(['vendor', 'rider', 'profile', 'items.product']),
        ]);
    }

    public function store(StoreOrderRequest $request): JsonResponse
    {
//        return response()->json([
//            'data'=>$request->user_id,
//            'message' => 'validation_error',
//            'errors' => ['user_id' => ['The user_id or authenticated customer is required.']],
//        ], 422);
        $validated = $request->validated();

        if (! isset($validated['user_id'])) {
            return response()->json([
                'message' => 'validation_error',
                'errors' => ['user_id' => ['The user_id or authenticated customer is required.']],
            ], 422);
        }

        $order = DB::transaction(function () use ($validated): Order {
            $order = Order::create($this->orderAttributes($validated));
            $this->replaceItems($order, $validated['product_id'], $validated['quantity']);

            return $order;
        });

        return response()->json([
            'message' => 'success',
            'data' => $order->load(['vendor', 'rider', 'profile', 'items.product']),
        ], 201);
    }

    public function update(UpdateOrderRequest $request, Order $order): JsonResponse
    {
        $validated = $request->validated();

        DB::transaction(function () use ($order, $validated): void {
            $order->update($this->orderAttributes($validated));
            $this->replaceItems($order, $validated['product_id'], $validated['quantity']);
        });

        return response()->json([
            'message' => 'success',
            'data' => $order->fresh()->load(['vendor', 'rider', 'profile', 'items.product']),
        ]);
    }

    public function destroy(Order $order): JsonResponse
    {
        $order->delete();

        return response()->json([
            'message' => 'success',
            'data' => null,
        ]);
    }

    public function customerOrders(Request $request): JsonResponse
    {
        $authenticatedUser = $request->user();

        // If a user_id is provided in the request, ensure it matches the authenticated user's ID
        if ($request->has('user_id')) {
            $requestedUserId = $request->input('user_id');

            if ((int) $requestedUserId !== $authenticatedUser->id) {
                return response()->json([
                    'message' => 'Unauthorized',
                    'errors' => ['user_id' => ['You are not authorized to view orders for this user ID.']],
                ], 403);
            }
        }

        $orders = Order::with(['vendor', 'rider', 'profile', 'items.product'])
            ->whereBelongsTo($authenticatedUser)
            ->get();

        return response()->json([
            'message' => 'success',
            'data' => $orders,
        ]);
    }

    /**
     * @param  array<string, mixed>  $validated
     * @return array<string, mixed>
     */
    private function orderAttributes(array $validated): array
    {
        $subtotal = $this->subtotal($validated['product_id'], $validated['quantity']);
        $deliveryFee = $validated['delivery_fee'] ?? 0;
        $discount = $validated['discount'] ?? 0;
        $tax = $validated['tax'] ?? 0;

        return [
            'user_id' => $validated['user_id'],
            'vendor_id' => $validated['vendor_id'],
            'rider_id' => $validated['rider_id'] ?? null,
            'profile_id' => $validated['profile_id'],
            'order_number' => $this->newOrderNumber(),
            'subtotal' => $subtotal,
            'delivery_fee' => $deliveryFee,
            'discount' => $discount,
            'tax' => $tax,
            'total' => $subtotal + $deliveryFee - $discount + $tax,
            'payment_status' => $validated['payment_status'],
            'order_status' => $validated['order_status'],
            'notes' => $validated['notes'] ?? null,
            'placed_at' => $validated['placed_at'] ?? null,
            'delivered_at' => $validated['delivered_at'] ?? null,
        ];
    }

    /**
     * @param  array<int, int|string>  $productIds
     * @param  array<int, int|string>  $quantities
     */
    private function replaceItems(Order $order, array $productIds, array $quantities): void
    {
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $order->items()->delete();

        foreach ($productIds as $index => $productId) {
            $product = $products->get($productId);
            $quantity = (int) $quantities[$index];
            $itemTotal = $product->price * $quantity;

            $order->items()->create([
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_price' => $product->price,
                'quantity' => $quantity,
                'total' => $itemTotal,
            ]);
        }
    }

    /**
     * @param  array<int, int|string>  $productIds
     * @param  array<int, int|string>  $quantities
     */
    private function subtotal(array $productIds, array $quantities): float
    {
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        return collect($productIds)->reduce(
            fn (float $subtotal, int|string $productId, int $index): float => $subtotal + ($products->get($productId)->price * (int) $quantities[$index]),
            0.0,
        );
    }

    private function newOrderNumber(): string
    {
        do {
            $orderNumber = 'ORD-'.now()->format('YmdHis').'-'.Str::upper(Str::random(6));
        } while (Order::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }
}
