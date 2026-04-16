<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
             [
                'name' => 'Admin User',
                'email' => 'admin'.time().'@mail.com',
                'userPhone' => '0300'.rand(1000000,9999999),
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'status' => 1,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Vendor User',
                'email' => 'vendor'.time().'@mail.com',
                'userPhone' => '0311'.rand(1000000,9999999),
                'password' => Hash::make('12345678'),
                'role' => 'vendor',
                'status' => 1,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Customer User',
                'email' => 'customer'.time().'@mail.com',
                'userPhone' => '0322'.rand(1000000,9999999),
                'password' => Hash::make('12345678'),
                'role' => 'customer',
                'status' => 0,
                'email_verified_at' => null,
                'created_at' => now(),
                'updated_at' => now(),

            ]
                ]);
    }
}
