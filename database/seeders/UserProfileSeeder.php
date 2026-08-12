<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = User::where('role', 'customer')->orderBy('id')->get();

        $addresses = [
            [
                'address_line_1' => 'House 45, Street 12, Gulberg III',
                'address_line_2' => 'Near Liberty Market',
                'city' => 'Lahore',
                'state' => 'Punjab',
                'postal_code' => '54000',
                'latitude' => 31.5204,
                'longitude' => 74.3587,
            ],
            [
                'address_line_1' => 'Flat 3B, Block 6, PECHS',
                'address_line_2' => 'Near Shaheed-e-Millat Road',
                'city' => 'Karachi',
                'state' => 'Sindh',
                'postal_code' => '75400',
                'latitude' => 24.8607,
                'longitude' => 67.0011,
            ],
            [
                'address_line_1' => 'House 21, Street 5, F-8/2',
                'address_line_2' => 'Near Kohsar Market',
                'city' => 'Islamabad',
                'state' => 'ICT',
                'postal_code' => '44000',
                'latitude' => 33.6844,
                'longitude' => 73.0479,
            ],
            [
                'address_line_1' => 'House 7, Model Town Extension',
                'address_line_2' => 'Block C',
                'city' => 'Faisalabad',
                'state' => 'Punjab',
                'postal_code' => '38000',
                'latitude' => 31.4504,
                'longitude' => 73.1350,
            ],
            [
                'address_line_1' => 'House 33, Satellite Town',
                'address_line_2' => 'Sector D',
                'city' => 'Rawalpindi',
                'state' => 'Punjab',
                'postal_code' => '46000',
                'latitude' => 33.5651,
                'longitude' => 73.0169,
            ],
        ];

        foreach ($customers as $index => $user) {
            $address = $addresses[$index] ?? $addresses[$index % count($addresses)];

            UserProfile::create([
                'user_id' => $user->id,
                'full_name' => $user->name,
                'address_line_1' => $address['address_line_1'],
                'address_line_2' => $address['address_line_2'],
                'city' => $address['city'],
                'state' => $address['state'],
                'postal_code' => $address['postal_code'],
                'country' => 'Pakistan',
                'latitude' => $address['latitude'],
                'longitude' => $address['longitude'],
                'is_default' => 1,
            ]);
        }
    }
}
