<?php

namespace Database\Seeders;
use App\Models\CategoryProduct;
use Illuminate\Support\Str;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         CategoryProduct::create([
            'name' => 'Electronics',
            'slug' => Str::slug('Electronics'),
            'image' => 'electronics.jpg',
            'parent_id' => null,
            'is_active' => 1,
        ]);

        CategoryProduct::create([
            'name' => 'Mobile Phones',
            'slug' => Str::slug('Mobile Phones'),
            'image' => 'mobiles.jpg',
            'parent_id' => 1,
            'is_active' => 1,
        ]);

        CategoryProduct::create([
            'name' => 'Laptops',
            'slug' => Str::slug('Laptops'),
            'image' => 'laptops.jpg',
            'parent_id' => 1,
            'is_active' => 1,
        ]);
    }
}
