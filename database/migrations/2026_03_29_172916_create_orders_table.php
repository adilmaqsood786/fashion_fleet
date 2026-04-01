<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('vendor_id')->constrained('vendors');
            $table->foreignId('rider_id')->nullable()->constrained('riders'); 
            $table->foreignId('profile_id')->constrained('user_profiles');

            $table->string('order_number')->unique();
            $table->decimal('subtotal');
            $table->decimal('delivery_fee');
            $table->decimal('discount');
            $table->decimal('tax');
            $table->decimal('total');
            $table->string('payment_status'); 
            $table->string('order_status');   
            $table->text('notes')->nullable();
            $table->dateTime('placed_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
