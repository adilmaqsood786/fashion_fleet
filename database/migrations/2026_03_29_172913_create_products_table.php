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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('vendors')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('category_products')->onDelete('cascade');
            $table->string('name');
            $table->string('slug'); 
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('sku')->nullable(); 
            $table->decimal('price');
            $table->decimal('sale_price');
            $table->integer('stock');
            $table->string('main_image')->nullable();
            $table->boolean('is_active');
            $table->boolean('is_featured');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
