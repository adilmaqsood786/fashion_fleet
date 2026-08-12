<?php

namespace Database\Seeders;

use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * One delivery record per order that has a rider assigned, with a
     * status mirroring the order's own status.
     */
    public function run(): void
    {
        $statusMap = [
            'delivered' => 'delivered',
            'shipped' => 'in_transit',
            'processing' => 'picked_up',
            'confirmed' => 'pending',
        ];

        $orders = Order::whereNotNull('rider_id')->get();

        foreach ($orders as $order) {
            $deliveryStatus = $statusMap[$order->order_status] ?? 'pending';

            Delivery::create([
                'order_id' => $order->id,
                'rider_id' => $order->rider_id,
                'pickup_time' => $order->placed_at,
                'delivered_time' => $order->order_status === 'delivered' ? $order->delivered_at : null,
                'delivery_status' => $deliveryStatus,
                'notes' => null,
            ]);
        }
    }
}
