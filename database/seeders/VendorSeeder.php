<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendorUsers = User::where('role', 'vendor')->orderBy('id')->get();

        $stores = [
            [
                'store_name' => 'Lahore Fashion House',
                'license' => 'LIC-VND-1001',
                'register' => 'REG-VND-1001',
                'address' => 'Shop 12, MM Alam Road',
                'vendor_city' => 'Lahore',
                'vendor_country' => 'Pakistan',
                'commission_rate' => 10.50,
            ],
            [
                'store_name' => 'Karachi Trend Store',
                'license' => 'LIC-VND-1002',
                'register' => 'REG-VND-1002',
                'address' => 'Shop 5, Dolmen Mall Clifton',
                'vendor_city' => 'Karachi',
                'vendor_country' => 'Pakistan',
                'commission_rate' => 12.00,
            ],
            [
                'store_name' => 'Islamabad Style Point',
                'license' => 'LIC-VND-1003',
                'register' => 'REG-VND-1003',
                'address' => 'Shop 8, Centaurus Mall',
                'vendor_city' => 'Islamabad',
                'vendor_country' => 'Pakistan',
                'commission_rate' => 8.75,
            ],
        ];

        foreach ($vendorUsers as $index => $user) {
            $store = $stores[$index] ?? $stores[$index % count($stores)];

            Vendor::create([
                'user_id' => $user->id,
                'store_name' => $store['store_name'],
                'store_slug' => Str::slug($store['store_name']),
                'logo' => 'images/vendors/'.Str::slug($store['store_name']).'.jpg',
                'license' => $store['license'],
                'register' => $store['register'],
                'address' => $store['address'],
                'vendor_city' => $store['vendor_city'],
                'vendor_country' => $store['vendor_country'],
                'commission_rate' => $store['commission_rate'],
                'is_active' => 1,
            ]);
        }
    }
}
