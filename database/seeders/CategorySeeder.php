<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Category::insert([
             // 🔹 Parent Categories
            [
                'name' => 'Electronics',
                'slug' => 'electronics',
                'image' => null,
                'parent_id' => null,
                'is_active' => 1,
            ],
            [
                'name' => 'Fashion',
                'slug' => 'fashion',
                'image' => null,
                'parent_id' => null,
                'is_active' => 1,
            ],
            [
                'name' => 'Home & Living',
                'slug' => 'home-living',
                'image' => null,
                'parent_id' => null,
                'is_active' => 1,
            ],
            [
                'name' => 'Books',
                'slug' => 'books',
                'image' => null,
                'parent_id' => null,
                'is_active' => 1,
            ],

            // 🔹 Child Categories (linked with parents above)
            [
                'name' => 'Mobiles',
                'slug' => 'mobiles',
                'image' => null,
                'parent_id' => 1, // Electronics
                'is_active' => 1,
            ],
            [
                'name' => 'Laptops',
                'slug' => 'laptops',
                'image' => null,
                'parent_id' => 1, // Electronics
                'is_active' => 1,
            ],
            [
                'name' => 'Men Clothing',
                'slug' => 'men-clothing',
                'image' => null,
                'parent_id' => 2, // Fashion
                'is_active' => 1,
            ],
            [
                'name' => 'Women Clothing',
                'slug' => 'women-clothing',
                'image' => null,
                'parent_id' => 2, // Fashion
                'is_active' => 1,
            ],
            [
                'name' => 'Furniture',
                'slug' => 'furniture',
                'image' => null,
                'parent_id' => 3, // Home & Living
                'is_active' => 1,
            ],
            [
                'name' => 'Kitchen',
                'slug' => 'kitchen',
                'image' => null,
                'parent_id' => 3, // Home & Living
                'is_active' => 1,
            ],
         ]);
    }
}
