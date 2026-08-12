<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tree = [
            'Men' => ['Shirts', 'T-Shirts', 'Jeans & Trousers', 'Shoes'],
            'Women' => ['Dresses & Suits', 'Tops & Kurtis', 'Jeans & Trousers', 'Shoes'],
            'Children' => ['Boys Clothing', 'Girls Clothing', 'Kids Shoes'],
        ];

        foreach ($tree as $parentName => $children) {
            $parent = CategoryProduct::create([
                'name' => $parentName,
                'slug' => Str::slug($parentName),
                'image' => 'images/categories/'.Str::slug($parentName).'.jpg',
                'parent_id' => null,
                'is_active' => 1,
            ]);

            foreach ($children as $childName) {
                CategoryProduct::create([
                    'name' => $parentName.' '.$childName,
                    'slug' => Str::slug($parentName.' '.$childName),
                    'image' => 'images/categories/'.Str::slug($parentName.'-'.$childName).'.jpg',
                    'parent_id' => $parent->id,
                    'is_active' => 1,
                ]);
            }
        }
    }
}
