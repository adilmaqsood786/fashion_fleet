<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    User::insert(
        [
                    [
            'first_name' => 'Ali',
            'last_name' => 'Khan',
            'father_name' => 'Ahmed Khan',
            'email' =>fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->numerify('03#########'),
            'address' => 'Lahore',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'first_name' => 'Usman',
            'last_name' => 'Ali',
            'father_name' => 'Rashid Ali',
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->numerify('03#########'),
            'address' => 'Karachi',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'first_name' => 'Hamza',
            'last_name' => 'Sheikh',
            'father_name' => 'Aslam Sheikh',
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->numerify('03#########'),
            'address' => 'Islamabad',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'first_name' => 'Bilal',
            'last_name' => 'Malik',
            'father_name' => 'Tariq Malik',
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->numerify('03#########'),
            'address' => 'Faisalabad',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'first_name' => 'Zain',
            'last_name' => 'Butt',
            'father_name' => 'Saeed Butt',
            'email' =>fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->numerify('03#########'),
            'address' => 'Multan',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'first_name' => 'Saad',
            'last_name' => 'Raza',
            'father_name' => 'Imran Raza',
            'email' =>fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->numerify('03#########'),
            'address' => 'Rawalpindi',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'first_name' => 'Hassan',
            'last_name' => 'Jutt',
            'father_name' => 'Akram Jutt',
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->numerify('03#########'),
            'address' => 'Sialkot',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'first_name' => 'Talha',
            'last_name' => 'Qureshi',
            'father_name' => 'Naveed Qureshi',
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->numerify('03#########'),
            'address' => 'Peshawar',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'first_name' => 'Umar',
            'last_name' => 'Farooq',
            'father_name' => 'Farooq Ahmed',
            'email' =>fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->numerify('03#########'),
            'address' => 'Quetta',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'first_name' => 'Ahmad',
            'last_name' => 'Shah',
            'father_name' => 'Ghulam Shah',
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->numerify('03#########'),
            'address' => 'Gujranwala',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        ]
    );
    }
}
