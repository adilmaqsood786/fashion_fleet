<?php

namespace Database\Seeders;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vendor::insert([
            [
            'name' => 'Nike',
            'slug' => 'nike',
            'description' => 'Sportswear brand',
            'logo' => 'nike.png',
            'status' => 'active',
             'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Adidas',
            'slug' => 'adidas',
            'description' => 'Athletic apparel brand',
            'logo' => 'adidas.png',
            'status' => 'active',
             'created_at' => now(),
             'updated_at' => now(),
            ]

        ]);
    }
}
