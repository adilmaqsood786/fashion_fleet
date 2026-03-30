<?php

namespace Database\Seeders;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::insert([
            'order_id' => 1,
                'user_id' => 1,
                'payment_method' => 'Credit Card',
                'transaction_id' => 'TXN001',
                'amount' => 150000,
                'status' => 'Paid',
                'paid_at' => Carbon::now(),
            ],
            [
                'order_id' => 2,
                'user_id' => 2,
                'payment_method' => 'PayPal',
                'transaction_id' => 'TXN002',
                'amount' => 130000,
                'status' => 'Paid',
                'paid_at' => Carbon::now(),
            ],
            [
                'order_id' => 1,
                'user_id' => 2,
                'payment_method' => 'Bank Transfer',
                'transaction_id' => 'TXN003',
                'amount' => 260000,
                'status' => 'Pending',
                'paid_at' => null,
            ],
            [
                'order_id' => 2,
                'user_id' => 1,
                'payment_method' => 'Credit Card',
                'transaction_id' => 'TXN004',
                'amount' => 150000,
                'status' => 'Paid',
                'paid_at' => Carbon::now(),
            ],
            [
                'order_id' => 1,
                'user_id' => 1,
                'payment_method' => 'PayPal',
                'transaction_id' => 'TXN005',
                'amount' => 450000,
                'status' => 'Paid',
                'paid_at' => Carbon::now(),
            ],
            [
                'order_id' => 2,
                'user_id' => 2,
                'payment_method' => 'Bank Transfer',
                'transaction_id' => 'TXN006',
                'amount' => 260000,
                'status' => 'Pending',
                'paid_at' => null,
            ],
            [
                'order_id' => 1,
                'user_id' => 2,
                'payment_method' => 'Credit Card',
                'transaction_id' => 'TXN007',
                'amount' => 130000,
                'status' => 'Paid',
                'paid_at' => Carbon::now(),
            ],
            [
                'order_id' => 2,
                'user_id' => 1,
                'payment_method' => 'PayPal',
                'transaction_id' => 'TXN008',
                'amount' => 300000,
                'status' => 'Paid',
                'paid_at' => Carbon::now(),
            ],
            [
                'order_id' => 1,
                'user_id' => 1,
                'payment_method' => 'Bank Transfer',
                'transaction_id' => 'TXN009',
                'amount' => 150000,
                'status' => 'Paid',
                'paid_at' => Carbon::now(),
            ],
            [
                'order_id' => 2,
                'user_id' => 2,
                'payment_method' => 'Credit Card',
                'transaction_id' => 'TXN010',
                'amount' => 390000,
                'status' => 'Pending',
                'paid_at' => null,
            ],
        );
    }
}
