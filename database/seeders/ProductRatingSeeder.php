<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\ProductRating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Ratings are only created for delivered orders, one per line item,
     * written by the customer who actually placed that order.
     */
    public function run(): void
    {
        $reviews = [
            ['rating' => 5, 'review' => 'Excellent quality! The fabric and stitching quality exceeded my expectations. Fast delivery too.'],
            ['rating' => 4, 'review' => 'Good value for money. Nice fit and comfortable to wear. Would order again.'],
            ['rating' => 5, 'review' => 'Loved it! Exactly as shown in the pictures. Highly recommend this store.'],
            ['rating' => 3, 'review' => 'Decent product. Its okay for the price, but the color was slightly different than expected.'],
        ];

        $deliveredOrders = Order::where('order_status', 'delivered')->with('items')->get();

        $reviewIndex = 0;

        foreach ($deliveredOrders as $order) {
            foreach ($order->items as $item) {
                $review = $reviews[$reviewIndex % count($reviews)];
                $reviewIndex++;

                ProductRating::create([
                    'product_id' => $item->product_id,
                    'order_id' => $order->id,
                    'user_id' => $order->user_id,
                    'rating' => $review['rating'],
                    'review' => $review['review'],
                    'is_approved' => true,
                ]);
            }
        }
    }
}
