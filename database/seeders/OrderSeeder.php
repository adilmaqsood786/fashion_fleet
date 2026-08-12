<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Rider;
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
     * consistent. Each rider gets a deliberate mix (two delivered today, one
     * delivered a few days ago, two new requests, one active delivery) so
     * the rider dashboard API has real data to summarise, plus a couple of
     * unassigned orders for the admin's assignment queue.
     */
    public function run(): void
    {
        $customers = User::where('role', 'customer')->orderBy('id')->get();
        $vendors = Vendor::orderBy('id')->get();
        $products = Product::orderBy('id')->get();
        $riders = Rider::orderBy('id')->get();

        $plan = [];

        // 6 orders per rider: 2 delivered today, 1 delivered a few days ago
        // (history), 2 new requests awaiting action, 1 active delivery.
        foreach ($riders as $riderIndex => $rider) {
            $plan[] = ['status' => 'delivered', 'payment' => 'paid', 'riderIndex' => $riderIndex, 'placedHoursAgo' => 8, 'deliveredHoursAgo' => 2];
            $plan[] = ['status' => 'delivered', 'payment' => 'paid', 'riderIndex' => $riderIndex, 'placedHoursAgo' => 12, 'deliveredHoursAgo' => 6];
            $plan[] = ['status' => 'delivered', 'payment' => 'paid', 'riderIndex' => $riderIndex, 'placedDaysAgo' => 4, 'deliveredHoursAfterPlaced' => 5];
            $plan[] = ['status' => 'pending', 'payment' => 'pending', 'riderIndex' => $riderIndex, 'placedHoursAgo' => 1];
            $plan[] = ['status' => 'confirmed', 'payment' => 'paid', 'riderIndex' => $riderIndex, 'placedHoursAgo' => 1];
            $plan[] = ['status' => $riderIndex % 2 === 0 ? 'processing' : 'shipped', 'payment' => 'paid', 'riderIndex' => $riderIndex, 'placedHoursAgo' => 3];
        }

        // A couple of orders still waiting for the admin to assign a rider.
        $plan[] = ['status' => 'pending', 'payment' => 'pending', 'riderIndex' => null, 'placedHoursAgo' => 2];
        $plan[] = ['status' => 'cancelled', 'payment' => 'refunded', 'riderIndex' => null, 'placedDaysAgo' => 3, 'deliveredHoursAfterPlaced' => null];

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

            if (isset($entry['placedDaysAgo'])) {
                $placedAt = now()->subDays($entry['placedDaysAgo']);
            } else {
                $placedAt = now()->subHours($entry['placedHoursAgo']);
            }

            $deliveredAt = null;
            if ($entry['status'] === 'delivered') {
                $deliveredAt = isset($entry['deliveredHoursAgo'])
                    ? now()->subHours($entry['deliveredHoursAgo'])
                    : $placedAt->copy()->addHours($entry['deliveredHoursAfterPlaced']);
            }

            $order = Order::create([
                'user_id' => $customer->id,
                'vendor_id' => $vendor->id,
                'rider_id' => $entry['riderIndex'] !== null ? $riders[$entry['riderIndex']]->id : null,
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
