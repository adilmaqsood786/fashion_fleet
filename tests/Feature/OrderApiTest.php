<?php

use Illuminate\Support\Facades\Route;

test('the order API exposes the CRUD routes', function () {
    expect(Route::getRoutes()->getByName('orders.store')?->uri())->toBe('api/orders')
        ->and(Route::getRoutes()->getByName('orders.update')?->methods())->toContain('PUT', 'PATCH')
        ->and(Route::getRoutes()->getByName('orders.destroy')?->methods())->toContain('DELETE');
});

test('creating an order requires the essential order data', function () {
    $this->postJson('/api/orders')
        ->assertUnprocessable()
        ->assertJsonValidationErrors([
            'vendor_id',
            'profile_id',
            'payment_status',
            'order_status',
            'product_id',
            'quantity',
        ]);
});
