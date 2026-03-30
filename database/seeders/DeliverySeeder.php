<?php

namespace Database\Seeders;
use App\Models\Delivery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Delivery::insert([
                [
                'order_id' => 1,
                'rider_id' => 1,
                'pickup_time' => now(),
                'delivered_time' => now(),
                'delivery_status' => 'delivered',
                'notes' => null,
            ],
            [
                'order_id' => 2,
                'rider_id' => 2,
                'pickup_time' => now(),
                'delivered_time' => null,
                'delivery_status' => 'pending',
                'notes' => null,
            ],
            [
                'order_id' => 1,
                'rider_id' => 1,
                'pickup_time' => now(),
                'delivered_time' => null,
                'delivery_status' => 'processing',
                'notes' => null,
            ],
            [
                'order_id' => 2,
                'rider_id' => 2,
                'pickup_time' => now(),
                'delivered_time' => now(),
                'delivery_status' => 'delivered',
                'notes' => null,
            ],
            [
                'order_id' => 1,
                'rider_id' => 1,
                'pickup_time' => now(),
                'delivered_time' => null,
                'delivery_status' => 'pending',
                'notes' => null,
            ],
            [
                'order_id' => 2,
                'rider_id' => 2,
                'pickup_time' => now(),
                'delivered_time' => now(),
                'delivery_status' => 'delivered',
                'notes' => null,
            ],
            [
                'order_id' => 1,
                'rider_id' => 1,
                'pickup_time' => now(),
                'delivered_time' => null,
                'delivery_status' => 'processing',
                'notes' => null,
            ],
            [
                'order_id' => 2,
                'rider_id' => 2,
                'pickup_time' => now(),
                'delivered_time' => now(),
                'delivery_status' => 'delivered',
                'notes' => null,
            ],
            [
                'order_id' => 1,
                'rider_id' => 1,
                'pickup_time' => now(),
                'delivered_time' => null,
                'delivery_status' => 'pending',
                'notes' => null,
            ],
            [
                'order_id' => 2,
                'rider_id' => 2,
                'pickup_time' => now(),
                'delivered_time' => now(),
                'delivery_status' => 'delivered',
                'notes' => null,
            ],
        ]);
    }
}
