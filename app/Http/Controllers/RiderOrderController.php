<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRiderDeliveryStatusRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RiderOrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::whereBelongsTo(auth()->user()->rider)
            ->with(['user', 'profile', 'vendor', 'items.product'])
            ->latest('placed_at')
            ->get();

        return view('rider_orders.index', compact('orders'));
    }

    public function updateDeliveryStatus(UpdateRiderDeliveryStatusRequest $request, Order $order): RedirectResponse
    {
        $deliveryStatus = $request->validated('delivery_status');

        $order->update([
            'delivery_status' => $deliveryStatus,
            'delivered_at' => $deliveryStatus === 'Delivered' ? now() : $order->delivered_at,
        ]);

        return back()->with('success', 'Delivery status updated.');
    }
}
