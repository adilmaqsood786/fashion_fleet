<?php

namespace Database\Seeders;
use App\Models\Rider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RiderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rider::insert([
             [
                'user_id' => 1,
                'vehicle_type' => 'Bike',
                'vehicle_number' => 'LEA-1234',
                'license_number' => 'LIC001',
                'is_available' => 1,
                'is_verified' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'vehicle_type' => 'Car',
                'vehicle_number' => 'KHI-5678',
                'license_number' => 'LIC002',
                'is_available' => 1,
                'is_verified' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'vehicle_type' => 'Bike',
                'vehicle_number' => 'ISB-1111',
                'license_number' => 'LIC003',
                'is_available' => 0,
                'is_verified' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'vehicle_type' => 'Bike',
                'vehicle_number' => 'FSD-2222',
                'license_number' => 'LIC004',
                'is_available' => 1,
                'is_verified' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'vehicle_type' => 'Car',
                'vehicle_number' => 'MLT-3333',
                'license_number' => 'LIC005',
                'is_available' => 1,
                'is_verified' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'vehicle_type' => 'Bike',
                'vehicle_number' => 'PSH-4444',
                'license_number' => 'LIC006',
                'is_available' => 0,
                'is_verified' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'vehicle_type' => 'Bike',
                'vehicle_number' => 'QTA-5555',
                'license_number' => 'LIC007',
                'is_available' => 1,
                'is_verified' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'vehicle_type' => 'Car',
                'vehicle_number' => 'SKT-6666',
                'license_number' => 'LIC008',
                'is_available' => 1,
                'is_verified' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'vehicle_type' => 'Bike',
                'vehicle_number' => 'HYD-7777',
                'license_number' => 'LIC009',
                'is_available' => 0,
                'is_verified' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'vehicle_type' => 'Car',
                'vehicle_number' => 'RWP-8888',
                'license_number' => 'LIC010',
                'is_available' => 1,
                'is_verified' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
