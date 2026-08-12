<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Rider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RiderController extends Controller
{
    /**
     * Dashboard summary for a rider: today's earnings/deliveries, new
     * requests awaiting action, the current active delivery, and recent
     * completed history. Pass a user id (or a rider id with ?by=rider).
     */
    public function dashboard(Request $request, $userId): JsonResponse
    {
        $rider = $this->resolveRider($userId);

        if (! $rider) {
            return response()->json(['message' => 'rider_not_found'], 404);
        }

        $today = now()->toDateString();

        $todayDeliveredQuery = Order::where('rider_id', $rider->id)
            ->where('order_status', 'delivered')
            ->whereDate('delivered_at', $today);

        $todayEarnings = (float) $todayDeliveredQuery->clone()->sum('delivery_fee');
        $todayDeliveries = $todayDeliveredQuery->clone()->count();

        $newRequests = Order::where('rider_id', $rider->id)
            ->whereIn('order_status', ['pending', 'confirmed'])
            ->with(['vendor', 'profile'])
            ->latest('id')
            ->get();

        $activeDelivery = Order::where('rider_id', $rider->id)
            ->whereIn('order_status', ['processing', 'shipped'])
            ->with(['vendor', 'profile'])
            ->latest('id')
            ->first();

        $recentHistory = Order::where('rider_id', $rider->id)
            ->where('order_status', 'delivered')
            ->with(['vendor', 'profile'])
            ->latest('delivered_at')
            ->limit((int) $request->query('history_limit', 5))
            ->get();

        return response()->json([
            'message' => 'success',
            'data' => [
                'rider' => [
                    'id' => $rider->id,
                    'user_id' => $rider->user_id,
                    'name' => $rider->user->name ?? null,
                    'vehicle_type' => $rider->vehicle_type,
                    'vehicle_number' => $rider->vehicle_number,
                    'is_available' => $rider->is_available,
                    'is_verified' => (bool) $rider->is_verified,
                ],
                'stats' => [
                    'today_earnings' => round($todayEarnings, 2),
                    'today_deliveries' => $todayDeliveries,
                    // Not tracked in the current schema — no rider rating or
                    // online-hours source exists yet, so these are left null
                    // rather than fabricated.
                    'rating' => null,
                    'online_hours' => null,
                ],
                'new_requests' => [
                    'count' => $newRequests->count(),
                    'orders' => $newRequests->map(fn (Order $order) => $this->transformSummary($order)),
                ],
                'active_delivery' => $activeDelivery ? $this->transformSummary($activeDelivery) : null,
                'recent_history' => $recentHistory->map(fn (Order $order) => $this->transformSummary($order)),
            ],
        ]);
    }

    /**
     * Accepts either a user id or a rider id (?by=rider).
     */
    private function resolveRider($userId): ?Rider
    {
        if (request()->query('by') === 'rider') {
            return Rider::with('user')->find($userId);
        }

        return Rider::with('user')->where('user_id', $userId)->first();
    }

    private function transformSummary(Order $order): array
    {
        return [
            'id' => $order->id,
            'order_number' => $order->order_number,
            'pickup_location' => $order->vendor->store_name ?? null,
            'amount' => (float) $order->delivery_fee,
            'total' => (float) $order->total,
            'order_status' => $order->order_status,
            'customer_name' => $order->profile->full_name ?? null,
            'placed_at' => $order->placed_at,
            'delivered_at' => $order->delivered_at,
        ];
    }

    /**
     * Orders assigned to the authenticated rider.
     */
    public function orders(Request $request): JsonResponse
    {
        $rider = $request->user()->rider;

        if (! $rider) {
            return response()->json(['message' => 'rider_not_found'], 404);
        }

        $query = Order::where('rider_id', $rider->id)
            ->with(['vendor', 'profile', 'items.product:id,name,main_image'])
            ->latest('id');

        if ($status = $request->query('order_status')) {
            $query->where('order_status', $status);
        }

        $perPage = (int) $request->query('per_page', 15);
        $perPage = $perPage > 0 ? min($perPage, 100) : 15;

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
     * A single order assigned to the authenticated rider.
     */
    public function showOrder(Request $request, Order $order): JsonResponse
    {
        $rider = $request->user()->rider;

        if (! $rider || $order->rider_id !== $rider->id) {
            return response()->json(['message' => 'order_not_found'], 404);
        }

        return response()->json([
            'message' => 'success',
            'data' => $this->transformOrder($order->load(['vendor', 'profile', 'items.product'])),
        ]);
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
            'notes' => $order->notes,
            'placed_at' => $order->placed_at,
            'delivered_at' => $order->delivered_at,
            'vendor' => $order->relationLoaded('vendor') && $order->vendor ? [
                'id' => $order->vendor->id,
                'store_name' => $order->vendor->store_name,
                'address' => $order->vendor->address,
            ] : null,
            'customer' => $order->relationLoaded('profile') && $order->profile ? [
                'id' => $order->profile->id,
                'name' => $order->profile->full_name ?? null,
                'phone' => $order->profile->profilePhone ?? null,
                'address' => trim(($order->profile->address_line_1 ?? '').' '.($order->profile->address_line_2 ?? '')) ?: null,
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
