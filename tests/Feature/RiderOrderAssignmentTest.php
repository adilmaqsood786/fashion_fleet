<?php

use App\Models\Order;
use App\Models\Rider;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

test('an admin can assign an order and a rider can only see their own assigned orders', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $assignedRiderUser = User::factory()->create(['role' => 'rider']);
    $otherRiderUser = User::factory()->create(['role' => 'rider']);
    $assignedRider = Rider::create([
        'user_id' => $assignedRiderUser->id,
        'vehicle_type' => 'Bike',
        'vehicle_number' => 'ABC-123',
        'license_number' => 'LIC-123',
        'is_available' => 1,
        'is_verified' => 1,
    ]);
    $otherRider = Rider::create([
        'user_id' => $otherRiderUser->id,
        'vehicle_type' => 'Bike',
        'vehicle_number' => 'DEF-456',
        'license_number' => 'LIC-456',
        'is_available' => 1,
        'is_verified' => 1,
    ]);
    $order = createOrder();
    $otherOrder = createOrder($otherRider);

    $this->actingAs($admin)
        ->post(route('orderAssignRider', $order), ['rider_id' => $assignedRider->id])
        ->assertRedirect();

    expect($order->fresh())
        ->rider_id->toBe($assignedRider->id)
        ->delivery_status->toBe('Assigned');

    $this->actingAs($assignedRiderUser)
        ->get(route('riderOrders.index'))
        ->assertOk()
        ->assertSee($order->order_number)
        ->assertDontSee($otherOrder->order_number);
});

test('a rider can progress only their own assigned order delivery status', function () {
    $riderUser = User::factory()->create(['role' => 'rider']);
    $rider = Rider::create([
        'user_id' => $riderUser->id,
        'vehicle_type' => 'Bike',
        'vehicle_number' => 'ABC-123',
        'license_number' => 'LIC-123',
        'is_available' => 1,
        'is_verified' => 1,
    ]);
    $otherRider = Rider::create([
        'user_id' => User::factory()->create(['role' => 'rider'])->id,
        'vehicle_type' => 'Bike',
        'vehicle_number' => 'DEF-456',
        'license_number' => 'LIC-456',
        'is_available' => 1,
        'is_verified' => 1,
    ]);
    $order = createOrder($rider);
    $otherOrder = createOrder($otherRider);

    $this->actingAs($riderUser)
        ->post(route('riderOrders.updateDeliveryStatus', $order), ['delivery_status' => 'Picked Up'])
        ->assertRedirect();

    expect($order->fresh()->delivery_status)->toBe('Picked Up');

    $this->actingAs($riderUser)
        ->post(route('riderOrders.updateDeliveryStatus', $otherOrder), ['delivery_status' => 'Picked Up'])
        ->assertForbidden();
});

function createOrder(?Rider $rider = null): Order
{
    $customer = User::factory()->create(['role' => 'customer']);
    $vendor = Vendor::create([
        'user_id' => User::factory()->create(['role' => 'vendor'])->id,
        'store_name' => fake()->company(),
        'store_slug' => fake()->unique()->slug(),
        'commission_rate' => 10,
    ]);
    $profile = UserProfile::create([
        'user_id' => $customer->id,
        'full_name' => $customer->name,
        'address_line_1' => fake()->streetAddress(),
        'address_line_2' => fake()->secondaryAddress(),
        'postal_code' => fake()->postcode(),
        'country' => fake()->country(),
        'latitude' => 0,
        'longitude' => 0,
        'is_default' => true,
    ]);

    return Order::create([
        'user_id' => $customer->id,
        'vendor_id' => $vendor->id,
        'rider_id' => $rider?->id,
        'profile_id' => $profile->id,
        'order_number' => fake()->unique()->bothify('ORD-####'),
        'subtotal' => 100,
        'delivery_fee' => 10,
        'discount' => 0,
        'tax' => 0,
        'total' => 110,
        'payment_status' => 'pending',
        'order_status' => 'confirmed',
        'delivery_status' => $rider ? 'Assigned' : 'Unassigned',
    ]);
}
