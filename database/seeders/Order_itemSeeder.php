<?php

namespace Database\Seeders;
use App\Models\Order_item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Order_itemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order_item::insert([
             [
                'order_id' => 1,
                'product_id' => 1,
                'product_name' => 'iPhone 13',
                'product_price' => 150000,
                'quantity' => 1,
                'total' => 150000,
            ],
            // [
            //     'order_id' => 2,
            //     'product_id' => 2,
            //     'product_name' => 'Samsung S21',
            //     'product_price' => 130000,
            //     'quantity' => 1,
            //     'total' => 130000,
            // ],
            // [
            //     'order_id' => 1,
            //     'product_id' => 2,
            //     'product_name' => 'Samsung S21',
            //     'product_price' => 130000,
            //     'quantity' => 2,
            //     'total' => 260000,
            // ],
            // [
            //     'order_id' => 2,
            //     'product_id' => 1,
            //     'product_name' => 'iPhone 13',
            //     'product_price' => 150000,
            //     'quantity' => 1,
            //     'total' => 150000,
            // ],
            // [
            //     'order_id' => 1,
            //     'product_id' => 1,
            //     'product_name' => 'iPhone 13',
            //     'product_price' => 150000,
            //     'quantity' => 3,
            //     'total' => 450000,
            // ],
            // [
            //     'order_id' => 2,
            //     'product_id' => 2,
            //     'product_name' => 'Samsung S21',
            //     'product_price' => 130000,
            //     'quantity' => 2,
            //     'total' => 260000,
            // ],
            // [
            //     'order_id' => 1,
            //     'product_id' => 2,
            //     'product_name' => 'Samsung S21',
            //     'product_price' => 130000,
            //     'quantity' => 1,
            //     'total' => 130000,
            // ],
            // [
            //     'order_id' => 2,
            //     'product_id' => 1,
            //     'product_name' => 'iPhone 13',
            //     'product_price' => 150000,
            //     'quantity' => 2,
            //     'total' => 300000,
            // ],
            // [
            //     'order_id' => 1,
            //     'product_id' => 1,
            //     'product_name' => 'iPhone 13',
            //     'product_price' => 150000,
            //     'quantity' => 1,
            //     'total' => 150000,
            // ],
            // [
            //     'order_id' => 2,
            //     'product_id' => 2,
            //     'product_name' => 'Samsung S21',
            //     'product_price' => 130000,
            //     'quantity' => 3,
            //     'total' => 390000,
            // ],
        ]);
    }
}
