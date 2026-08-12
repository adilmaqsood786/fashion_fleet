<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Order_itemSeeder extends Seeder
{
    /**
     * Order items are created together with their parent order in
     * OrderSeeder so subtotal/total stay consistent. Nothing to do here.
     */
    public function run(): void
    {
        //
    }
}
