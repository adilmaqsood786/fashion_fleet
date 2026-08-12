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
            ['rating' => 5, 'title' => 'Excellent quality!', 'review' => 'The fabric and stitching quality exceeded my expectations. Fast delivery too.'],
            ['rating' => 4, 'title' => 'Good value for money', 'review' => 'Nice fit and comfortable to wear. Would order again.'],
            ['rating' => 5, 'title' => 'Loved it', 'review' => 'Exactly as shown in the pictures. Highly recommend this store.'],
            ['rating' => 3, 'title' => 'Decent product', 'review' => 'Its okay for the price, but the color was slightly different than expected.'],
        ];

        $deliveredOrders = Order::where('order_status', 'delivered')->with('items')->get();

        $reviewIndex = 0;

        foreach ($deliveredOrders as $order) {
            foreach ($order->items as $item) {
                $review = $reviews[$reviewIndex % count($reviews)];
                $reviewIndex++;

<<<<<<< HEAD
                ProductRating::create([
                    'product_id' => $item->product_id,
                    'order_id' => $order->id,
                    'user_id' => $order->user_id,
                    'rating' => $review['rating'],
                    'title' => $review['title'],
                    'review' => $review['review'],
                    'is_approved' => true,
                ]);
            }
        }
=======
        'rating' => rand(3, 5),
        'review' => 'Auto generated review for testing purposes',

        'is_approved' => true,
        'created_at' => now(),
        'updated_at' => now(),
    ];
}

\DB::table('product_ratings')->insert($ratings);
//   [
//                 'product_id' => 1,
//                 'order_id' => 1,
//                 'user_id' => 1,
//                 'rating' => 5,
//                 'title' => 'Excellent product!',
//                 'review' => 'This product exceeded my expectations. Very high quality and fast delivery. Will definitely buy again.',
//                 'is_approved' => true,
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],
//             [
//                 'product_id' => 2,
//                 'order_id' => 2,
//                 'user_id' => 2,
//                 'rating' => 4,
//                 'title' => 'Good value for money',
//                 'review' => 'Pretty good product for the price. A few minor issues but overall satisfied.',
//                 'is_approved' => true,
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],
//             [
//                 'product_id' => 3,
//                 'order_id' => 3,
//                 'user_id' => 3,
//                 'rating' => 3,
//                 'title' => 'Average product',
//                 'review' => 'Its okay, nothing special. Works as described but could be better.',
//                 'is_approved' => true,
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ],
            // [
            //     'product_id' => 1,
            //     'order_id' => 4,
            //     'user_id' => 4,
            //     'rating' => 5,
            //     'title' => 'Absolutely love it!',
            //     'review' => 'Best purchase I made this year. Highly recommended to everyone!',
            //     'is_approved' => true,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'product_id' => 4,
            //     'order_id' => 5,
            //     'user_id' => 5,
            //     'rating' => 2,
            //     'title' => 'Disappointed',
            //     'review' => 'The product arrived damaged and customer service was slow to respond.',
            //     'is_approved' => false,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'product_id' => 2,
            //     'order_id' => 6,
            //     'user_id' => 1,
            //     'rating' => 4,
            //     'title' => 'Very satisfied',
            //     'review' => 'Great product, works perfectly. Shipping was quick too.',
            //     'is_approved' => true,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'product_id' => 5,
            //     'order_id' => 7,
            //     'user_id' => 2,
            //     'rating' => 5,
            //     'title' => 'Amazing quality!',
            //     'review' => 'Top notch quality. Better than I expected. Will recommend to friends.',
            //     'is_approved' => true,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'product_id' => 3,
            //     'order_id' => 8,
            //     'user_id' => 3,
            //     'rating' => 3,
            //     'title' => 'Its fine',
            //     'review' => 'Does the job but nothing extraordinary. Price could be lower.',
            //     'is_approved' => true,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'product_id' => 1,
            //     'order_id' => 9,
            //     'user_id' => 4,
            //     'rating' => 4,
            //     'title' => 'Good but has flaws',
            //     'review' => 'Overall good product but there is room for improvement in packaging.',
            //     'is_approved' => false,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'product_id' => 4,
            //     'order_id' => 10,
            //     'user_id' => 5,
            //     'rating' => 5,
            //     'title' => 'Perfect!',
            //     'review' => 'Exactly what I needed. Fast shipping and great communication from seller.',
            //     'is_approved' => true,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
>>>>>>> 3eae94efffc3be2c83a561ef922120c105aefa09
    }
}
