<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendors = Vendor::orderBy('id')->get();
        $categories = CategoryProduct::whereNotNull('parent_id')->get()->keyBy('name');

        $vendorFor = fn (int $index) => $vendors[$index % $vendors->count()]->id;
        $categoryId = fn (string $name) => $categories[$name]->id ?? null;

        $products = [
            [
                'name' => 'Khaadi Women Printed Lawn 3-Piece Suit',
                'category' => 'Women Dresses & Suits',
                'short_description' => 'Unstitched lawn 3-piece suit with digital print and embroidered dupatta.',
                'description' => 'A breezy summer lawn suit from Khaadi featuring a printed shirt, trouser and embroidered chiffon dupatta. Perfect for everyday wear and casual outings.',
                'sku' => 'KHD-W-1001',
                'price' => 6500,
                'sale_price' => 5490,
                'stock' => 25,
            ],
            [
                'name' => 'Gul Ahmed Men Slim-Fit Cotton Shirt',
                'category' => 'Men Shirts',
                'short_description' => '100% cotton slim-fit formal shirt.',
                'description' => 'A crisp, breathable cotton shirt from Gul Ahmed tailored in a slim fit, ideal for office wear or smart-casual occasions.',
                'sku' => 'GA-M-1002',
                'price' => 3200,
                'sale_price' => 2790,
                'stock' => 40,
            ],
            [
                'name' => 'Outfitters Men Slim Fit Denim Jeans',
                'category' => 'Men Jeans & Trousers',
                'short_description' => 'Stretchable slim fit denim jeans.',
                'description' => 'Comfort-stretch denim jeans from Outfitters with a modern slim fit, five-pocket styling and durable stitching.',
                'sku' => 'OUT-M-1003',
                'price' => 4500,
                'sale_price' => 3990,
                'stock' => 35,
            ],
            [
                'name' => 'Chinyere Women Embroidered Kurti',
                'category' => 'Women Tops & Kurtis',
                'short_description' => 'Hand-embroidered lawn kurti.',
                'description' => 'An elegant embroidered kurti from Chinyere crafted in soft lawn fabric with intricate thread-work detailing on the neckline.',
                'sku' => 'CHY-W-1004',
                'price' => 3800,
                'sale_price' => 3250,
                'stock' => 28,
            ],
            [
                'name' => 'Bonanza Satrangi Women Stitched 2-Piece Suit',
                'category' => 'Women Dresses & Suits',
                'short_description' => 'Ready to wear embroidered 2-piece suit.',
                'description' => 'A stitched two-piece suit from Bonanza Satrangi featuring embroidered motifs, perfect for festive and semi-formal wear.',
                'sku' => 'BNZ-W-1005',
                'price' => 7200,
                'sale_price' => 6490,
                'stock' => 18,
            ],
            [
                'name' => 'J. Men Casual Check Shirt',
                'category' => 'Men Shirts',
                'short_description' => 'Yarn-dyed checkered casual shirt.',
                'description' => 'A relaxed-fit checkered casual shirt from J. (Junaid Jamshed), woven from breathable yarn-dyed cotton fabric.',
                'sku' => 'J-M-1006',
                'price' => 3500,
                'sale_price' => 2990,
                'stock' => 32,
            ],
            [
                'name' => 'Stylo Kids Boys Printed T-Shirt & Shorts Set',
                'category' => 'Children Boys Clothing',
                'short_description' => 'Cotton t-shirt and shorts co-ord set.',
                'description' => 'A comfortable cotton t-shirt and shorts set for boys from Stylo Kids, designed for all-day play and comfort.',
                'sku' => 'STY-B-1007',
                'price' => 2200,
                'sale_price' => 1890,
                'stock' => 45,
            ],
            [
                'name' => 'Ideas by Gul Ahmed Girls Party Frock',
                'category' => 'Children Girls Clothing',
                'short_description' => 'Net party frock with embellishments.',
                'description' => 'A vibrant party wear frock for girls from Ideas by Gul Ahmed featuring layered net fabric and embellished detailing.',
                'sku' => 'IGA-G-1008',
                'price' => 4200,
                'sale_price' => 3690,
                'stock' => 20,
            ],
            [
                'name' => 'Servis Men Leather Formal Shoes',
                'category' => 'Men Shoes',
                'short_description' => 'Genuine leather lace-up formal shoes.',
                'description' => 'Classic lace-up formal shoes from Servis, crafted from genuine leather with a cushioned insole for all-day comfort.',
                'sku' => 'SRV-M-1009',
                'price' => 5500,
                'sale_price' => 4990,
                'stock' => 22,
            ],
            [
                'name' => 'Borjan Women Casual Sneakers',
                'category' => 'Women Shoes',
                'short_description' => 'Lightweight casual canvas sneakers.',
                'description' => 'Trendy and lightweight casual sneakers from Borjan, made with breathable canvas uppers and a cushioned sole.',
                'sku' => 'BRJ-W-1010',
                'price' => 4800,
                'sale_price' => 4290,
                'stock' => 30,
            ],
        ];

        foreach ($products as $index => $product) {
            Product::create([
                'vendor_id' => $vendorFor($index),
                'category_id' => $categoryId($product['category']),
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'short_description' => $product['short_description'],
                'description' => $product['description'],
                'sku' => $product['sku'],
                'price' => $product['price'],
                'sale_price' => $product['sale_price'],
                'stock' => $product['stock'],
                'main_image' => 'images/products/'.Str::slug($product['name']).'.jpg',
                'is_active' => 1,
                'is_featured' => $index % 3 === 0 ? 1 : 0,
            ]);
        }
    }
}
