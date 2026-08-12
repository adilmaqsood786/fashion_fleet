<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VendorDashboardController extends Controller
{
    /**
     * Dashboard summary for a vendor: sales, orders, products, stock value,
     * store info and the most recent orders.
     */
    public function dashboard(Request $request, $userId): JsonResponse
    {
        $vendor = $this->resolveVendor($userId);

        if (! $vendor) {
            return response()->json(['message' => 'vendor_not_found'], 404);
        }

        $recentLimit = (int) $request->query('recent_limit', 5);
        $recentLimit = $recentLimit > 0 ? min($recentLimit, 20) : 5;

        $totalSales = (float) Order::where('vendor_id', $vendor->id)
            ->whereNotIn('order_status', ['cancelled'])
            ->sum('total');

        $ordersCount = Order::where('vendor_id', $vendor->id)->count();

        $products = Product::where('vendor_id', $vendor->id)->get(['id', 'price', 'sale_price', 'stock']);
        $stockValue = $products->sum(function (Product $product): float {
            $price = (float) ($product->sale_price > 0 ? $product->sale_price : $product->price);

            return $price * (int) $product->stock;
        });

        $recentOrders = Order::where('vendor_id', $vendor->id)
            ->with(['items.product:id,name,main_image', 'profile'])
            ->latest('id')
            ->limit($recentLimit)
            ->get()
            ->map(fn (Order $order) => $this->transformOrder($order));

        return response()->json([
            'message' => 'success',
            'data' => [
                'vendor' => [
                    'id' => $vendor->id,
                    'user_id' => $vendor->user_id,
                    'name' => $vendor->user->name ?? null,
                    'store_name' => $vendor->store_name,
                    'store_slug' => $vendor->store_slug,
                    'logo' => $vendor->logo,
                    'is_active' => (bool) $vendor->is_active,
                ],
                'stats' => [
                    'total_sales' => round($totalSales, 2),
                    'orders' => $ordersCount,
                    'products' => $products->count(),
                    'stock_value' => round($stockValue, 2),
                ],
                'recent_orders' => $recentOrders,
            ],
        ]);
    }

    /**
     * Full order list for a vendor, filterable by status and paginated.
     */
    public function orders(Request $request, $userId): JsonResponse
    {
        $vendor = $this->resolveVendor($userId);

        if (! $vendor) {
            return response()->json(['message' => 'vendor_not_found'], 404);
        }

        $perPage = (int) $request->query('per_page', 15);
        $perPage = $perPage > 0 ? min($perPage, 100) : 15;

        $query = Order::where('vendor_id', $vendor->id)
            ->with(['items.product:id,name,main_image', 'profile', 'rider.user'])
            ->latest('id');

        if ($status = $request->query('order_status')) {
            $query->where('order_status', $status);
        }

        if ($paymentStatus = $request->query('payment_status')) {
            $query->where('payment_status', $paymentStatus);
        }

        if ($search = $request->query('search')) {
            $query->where('order_number', 'like', '%'.$search.'%');
        }

        $orders = $query->paginate($perPage);

        return response()->json([
            'message' => 'success',
            'data' => collect($orders->items())->map(fn (Order $order) => $this->transformOrder($order)),
            'meta' => [
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'per_page' => $orders->perPage(),
                'total' => $orders->total(),
            ],
        ]);
    }

    /**
     * A single order belonging to the vendor (for the "View" action).
     */
    public function show(Request $request, $userId, $orderId): JsonResponse
    {
        $vendor = $this->resolveVendor($userId);

        if (! $vendor) {
            return response()->json(['message' => 'vendor_not_found'], 404);
        }

        $order = Order::where('vendor_id', $vendor->id)
            ->with(['items.product', 'profile', 'rider.user'])
            ->find($orderId);

        if (! $order) {
            return response()->json(['message' => 'order_not_found'], 404);
        }

        return response()->json([
            'message' => 'success',
            'data' => $this->transformOrder($order),
        ]);
    }

    /**
     * Vendor updates the status of one of their own orders (for the "Update" action).
     */
    public function updateOrderStatus(Request $request, $userId, $orderId): JsonResponse
    {
        $vendor = $this->resolveVendor($userId);

        if (! $vendor) {
            return response()->json(['message' => 'vendor_not_found'], 404);
        }

        $order = Order::where('vendor_id', $vendor->id)->find($orderId);

        if (! $order) {
            return response()->json(['message' => 'order_not_found'], 404);
        }

        $validated = $request->validate([
            'order_status' => ['required', 'in:pending,confirmed,processing,shipped,delivered,cancelled,returned'],
        ]);

        $order->update([
            'order_status' => $validated['order_status'],
            'delivered_at' => $validated['order_status'] === 'delivered' ? now() : $order->delivered_at,
        ]);

        return response()->json([
            'message' => 'success',
            'data' => $this->transformOrder($order->fresh(['items.product', 'profile', 'rider.user'])),
        ]);
    }

    /**
     * Accepts either a user id or a vendor id (?by=vendor).
     */
    private function resolveVendor($userId): ?Vendor
    {
        if (request()->query('by') === 'vendor') {
            return Vendor::with('user')->find($userId);
        }

        return Vendor::with('user')->where('user_id', $userId)->first();
    }

    private function transformOrder(Order $order): array
    {
        $firstItem = $order->items->first();

        return [
            'id' => $order->id,
            'order_number' => $order->order_number,
            'title' => $firstItem->product_name ?? null,
            'items_count' => $order->items->count(),
            'subtotal' => (float) $order->subtotal,
            'delivery_fee' => (float) $order->delivery_fee,
            'discount' => (float) $order->discount,
            'tax' => (float) $order->tax,
            'total' => (float) $order->total,
            'order_status' => $order->order_status,
            'payment_status' => $order->payment_status,
            'placed_at' => $order->placed_at,
            'delivered_at' => $order->delivered_at,
            'customer' => $order->profile ? [
                'id' => $order->profile->id,
                'name' => $order->profile->full_name ?? null,
                'phone' => $order->profile->profilePhone ?? null,
                'address' => trim(($order->profile->address_line_1 ?? '').' '.($order->profile->address_line_2 ?? '')) ?: null,
            ] : null,
            'rider' => $order->relationLoaded('rider') && $order->rider ? [
                'id' => $order->rider->id,
                'name' => $order->rider->user->name ?? null,
            ] : null,
            'items' => $order->items->map(fn ($item) => [
                'id' => $item->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product_name,
                'product_image' => $item->product->main_image ?? null,
                'product_price' => (float) $item->product_price,
                'quantity' => (int) $item->quantity,
                'total' => (float) $item->total,
            ]),
        ];
    }
}
