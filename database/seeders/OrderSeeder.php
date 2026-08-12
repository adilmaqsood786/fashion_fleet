<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Creates orders together with their line items so subtotal/total stay
     * consistent, spanning every order_status/payment_status combination.
     */
    public function run(): void
    {
        $customers = User::where('role', 'customer')->orderBy('id')->get();
        $riders = User::where('role', 'rider')->orderBy('id')->get();
        $vendors = Vendor::orderBy('id')->get();
        $products = Product::orderBy('id')->get();

        $riderRecords = \App\Models\Rider::orderBy('id')->get();

        $plan = [
            ['status' => 'delivered', 'payment' => 'paid', 'rider' => true, 'daysAgo' => 5],
            ['status' => 'shipped', 'payment' => 'paid', 'rider' => true, 'daysAgo' => 1],
            ['status' => 'processing', 'payment' => 'pending', 'rider' => true, 'daysAgo' => 0],
            ['status' => 'confirmed', 'payment' => 'paid', 'rider' => false, 'daysAgo' => 0],
            ['status' => 'pending', 'payment' => 'pending', 'rider' => false, 'daysAgo' => 0],
            ['status' => 'delivered', 'payment' => 'paid', 'rider' => true, 'daysAgo' => 10],
            ['status' => 'cancelled', 'payment' => 'refunded', 'rider' => false, 'daysAgo' => 3],
            ['status' => 'shipped', 'payment' => 'paid', 'rider' => true, 'daysAgo' => 0],
            ['status' => 'delivered', 'payment' => 'paid', 'rider' => true, 'daysAgo' => 15],
            ['status' => 'pending', 'payment' => 'pending', 'rider' => false, 'daysAgo' => 0],
        ];

        foreach ($plan as $index => $entry) {
            $customer = $customers[$index % $customers->count()];
            $vendor = $vendors[$index % $vendors->count()];
            $profile = UserProfile::where('user_id', $customer->id)->first();

            // 1-2 items per order, taken from the vendor's own catalogue.
            $vendorProducts = $products->where('vendor_id', $vendor->id)->values();
            $items = $vendorProducts->isNotEmpty()
                ? $vendorProducts->take(2)
                : $products->slice($index, 2)->values();

            $subtotal = 0;
            $lineItems = [];

            foreach ($items as $product) {
                $quantity = ($index % 2) + 1;
                $lineTotal = (float) $product->sale_price * $quantity;
                $subtotal += $lineTotal;

                $lineItems[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_price' => $product->sale_price,
                    'quantity' => $quantity,
                    'total' => $lineTotal,
                ];
            }

            $deliveryFee = 150;
            $discount = $index % 3 === 0 ? 200 : 0;
            $tax = round($subtotal * 0.02, 2);
            $total = $subtotal + $deliveryFee - $discount + $tax;

            $placedAt = now()->subDays($entry['daysAgo']);
            $deliveredAt = $entry['status'] === 'delivered' ? $placedAt->copy()->addDay() : null;

            $order = Order::create([
                'user_id' => $customer->id,
                'vendor_id' => $vendor->id,
                'rider_id' => $entry['rider'] ? $riderRecords[$index % $riderRecords->count()]->id : null,
                'profile_id' => $profile->id,
                'order_number' => 'FF-'.str_pad((string) ($index + 1001), 4, '0', STR_PAD_LEFT),
                'subtotal' => $subtotal,
                'delivery_fee' => $deliveryFee,
                'discount' => $discount,
                'tax' => $tax,
                'total' => $total,
                'payment_status' => $entry['payment'],
                'order_status' => $entry['status'],
                'notes' => null,
                'placed_at' => $placedAt,
                'delivered_at' => $deliveredAt,
            ]);

            foreach ($lineItems as $lineItem) {
                $order->items()->create($lineItem);
            }
        }
    }
}
