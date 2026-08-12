<?php

namespace Database\Seeders;

use App\Models\Product;
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
        $products = Product::orderBy('id')->get();

        foreach ($products as $product) {
            foreach (range(1, 3) as $sort) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'images/products/'.$product->slug.'-'.$sort.'.jpg',
                    'sort_order' => $sort,
                ]);
            }
        }
    }
}
