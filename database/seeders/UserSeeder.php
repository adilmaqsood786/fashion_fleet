<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('12345678');

        $users = [
            // Admin
            ['name' => 'Ayesha Siddiqui', 'email' => 'admin@fashionfleet.pk', 'userPhone' => '03001110001', 'role' => 'admin', 'status' => 1],

            // Vendors (store owners)
            ['name' => 'Bilal Ahmed', 'email' => 'bilal.vendor@fashionfleet.pk', 'userPhone' => '03011110002', 'role' => 'vendor', 'status' => 1],
            ['name' => 'Sana Malik', 'email' => 'sana.vendor@fashionfleet.pk', 'userPhone' => '03021110003', 'role' => 'vendor', 'status' => 1],
            ['name' => 'Hamza Sheikh', 'email' => 'hamza.vendor@fashionfleet.pk', 'userPhone' => '03031110004', 'role' => 'vendor', 'status' => 1],

            // Customers
            ['name' => 'Ali Raza', 'email' => 'ali.raza@example.com', 'userPhone' => '03041110005', 'role' => 'customer', 'status' => 1],
            ['name' => 'Fatima Noor', 'email' => 'fatima.noor@example.com', 'userPhone' => '03051110006', 'role' => 'customer', 'status' => 1],
            ['name' => 'Usman Tariq', 'email' => 'usman.tariq@example.com', 'userPhone' => '03061110007', 'role' => 'customer', 'status' => 1],
            ['name' => 'Zara Bhatti', 'email' => 'zara.bhatti@example.com', 'userPhone' => '03071110008', 'role' => 'customer', 'status' => 1],
            ['name' => 'Hassan Iqbal', 'email' => 'hassan.iqbal@example.com', 'userPhone' => '03081110009', 'role' => 'customer', 'status' => 1],

            // Riders
            ['name' => 'Kamran Yousaf', 'email' => 'kamran.rider@fashionfleet.pk', 'userPhone' => '03091110010', 'role' => 'rider', 'status' => 1],
            ['name' => 'Adeel Chaudhry', 'email' => 'adeel.rider@fashionfleet.pk', 'userPhone' => '03101110011', 'role' => 'rider', 'status' => 1],
            ['name' => 'Waqas Anjum', 'email' => 'waqas.rider@fashionfleet.pk', 'userPhone' => '03111110012', 'role' => 'rider', 'status' => 1],
        ];

        foreach ($users as &$user) {
            $user['password'] = $password;
            $user['email_verified_at'] = now();
            $user['created_at'] = now();
            $user['updated_at'] = now();
        }

        User::insert($users);
    }
}
