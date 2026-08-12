<?php

namespace Database\Seeders;

use App\Models\Rider;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RiderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $riderUsers = User::where('role', 'rider')->orderBy('id')->get();

        $fleet = [
            ['vehicle_type' => 'Bike', 'vehicle_number' => 'LEA-1234', 'license_number' => 'LIC-RID-001', 'is_available' => 1, 'is_verified' => 1],
            ['vehicle_type' => 'Bike', 'vehicle_number' => 'KHI-5678', 'license_number' => 'LIC-RID-002', 'is_available' => 1, 'is_verified' => 1],
            ['vehicle_type' => 'Car', 'vehicle_number' => 'ISB-1111', 'license_number' => 'LIC-RID-003', 'is_available' => 0, 'is_verified' => 1],
        ];

        foreach ($riderUsers as $index => $user) {
            $vehicle = $fleet[$index] ?? $fleet[$index % count($fleet)];

            Rider::create([
                'user_id' => $user->id,
                'vehicle_type' => $vehicle['vehicle_type'],
                'vehicle_number' => $vehicle['vehicle_number'],
                'license_number' => $vehicle['license_number'],
                'is_available' => $vehicle['is_available'],
                'is_verified' => $vehicle['is_verified'],
            ]);
        }
    }
}
