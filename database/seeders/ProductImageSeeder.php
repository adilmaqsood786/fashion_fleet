<?php

namespace Database\Seeders;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductImage::insert([
                        [
                'product_id' => 1,
                'image_path' => 'images/products/iphone13_1.jpg',
                'sort_order' => 1,
            ],
            [
                'product_id' => 1,
                'image_path' => 'images/products/iphone13_2.jpg',
                'sort_order' => 2,
            ],
            [
                'product_id' => 1,
                'image_path' => 'images/products/iphone13_3.jpg',
                'sort_order' => 3,
            ],
            // [
            //     'product_id' => 2,
            //     'image_path' => 'images/products/samsung_s21_1.jpg',
            //     'sort_order' => 3,
            // ],
            // [
            //     'product_id' => 2,
            //     'image_path' => 'images/products/samsung_s21_2.jpg',
            //     'sort_order' => 2,
            // ],
            // // [
            //     'product_id' => 2,
            //     'image_path' => 'images/products/samsung_s21_3.jpg',
            //     'sort_order' => 3,
            // ],
            // [
            //     'product_id' => 1,
            //     'image_path' => 'images/products/iphone13_4.jpg',
            //     'sort_order' => 4,
            // ],
            // [
            //     'product_id' => 2,
            //     'image_path' => 'images/products/samsung_s21_4.jpg',
            //     'sort_order' => 4,
            // ],
            // [
            //     'product_id' => 1,
            //     'image_path' => 'images/products/iphone13_5.jpg',
            //     'sort_order' => 5,
            // ],
            // [
            //     'product_id' => 2,
            //     'image_path' => 'images/products/samsung_s21_5.jpg',
            //     'sort_order' => 5,
            // ],
        ]);
    }
}
