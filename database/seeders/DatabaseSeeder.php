<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);



        $this->call([
         CategorySeeder::class,
         UserSeeder::class,
         VendorSeeder::class,
         CategorySeeder::class,
         UserProfileSeeder::class,
         RiderSeeder::class,
         ProductSeeder::class,
         Product_imageSeeder::class,
         OrderSeeder::class,
         Order_itemSeeder::class,
         DeliverySeeder::class,
         PaymentSeeder::class

        ]);
    }
}
