<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * One payment record per order, amount/status derived from the order.
     */
    public function run(): void
    {
        $methods = ['Credit Card', 'Debit Card', 'JazzCash', 'EasyPaisa', 'Cash on Delivery', 'Bank Transfer'];

        $orders = Order::orderBy('id')->get();

        foreach ($orders as $index => $order) {
            $status = match ($order->payment_status) {
                'paid' => 'Paid',
                'refunded' => 'Refunded',
                default => 'Pending',
            };

            Payment::create([
                'order_id' => $order->id,
                'user_id' => $order->user_id,
                'payment_method' => $methods[$index % count($methods)],
                'transaction_id' => $status === 'Pending' ? null : 'TXN-'.str_pad((string) ($index + 1), 5, '0', STR_PAD_LEFT),
                'amount' => $order->total,
                'status' => $status,
                'paid_at' => $status === 'Paid' ? $order->placed_at : null,
            ]);
        }
    }
}
