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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
             $table->string('company_name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name');
            $table->string('slug');
            $table->string('description');
            $table->string('logo');
            $table->string('email')->unique();
            $table->string('contact_number')->unique();
            $table->string('licenses');
            $table->string('address');
            $table->string('bank_name');
            $table->string('account_number')->unique();
            $table->string('account_title');
            $table->string('iban');
            $table->string('payment_method');
            $table->string('status');
            $table->string('is_verified');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
