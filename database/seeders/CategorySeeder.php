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
         // Root category
        $parent = Category::create([
            'name' => 'Clothing',
            'parent_id' => null,
            'status' => 'active',
        ]);

        // Child category 1
        Category::create([
            'name' => 'Men',
            'parent_id' => $parent->id,
            'status' => 'active',
        ]);

        // Child category 2
        Category::create([
            'name' => 'Women',
            'parent_id' => $parent->id,
            'status' => 'active',
        ]);
    }
}
