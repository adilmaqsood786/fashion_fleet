<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use App\Models\ProductRating;
use App\Models\ProductRating;

class ProductRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductRating::insert([
  [
                'product_id' => 1,
                'order_id' => 1,
                'user_id' => 1,
                'rating' => 5,
                'title' => 'Excellent product!',
                'review' => 'This product exceeded my expectations. Very high quality and fast delivery. Will definitely buy again.',
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'order_id' => 2,
                'user_id' => 2,
                'rating' => 4,
                'title' => 'Good value for money',
                'review' => 'Pretty good product for the price. A few minor issues but overall satisfied.',
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3,
                'order_id' => 3,
                'user_id' => 3,
                'rating' => 3,
                'title' => 'Average product',
                'review' => 'Its okay, nothing special. Works as described but could be better.',
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
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
        ]);
    }
}
