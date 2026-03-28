<?php

namespace Database\Seeders;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vendor::insert([
              // Record 1
            [
                'company_name'     => 'Alpha Traders',
                'first_name'      => 'Ali',
                'last_name'       => 'Khan',
                'father_name'     => 'Ahmed Khan',
                'slug'            => Str::slug('Alpha Traders'),
                'description'     => 'Electronics wholesale supplier',
                'logo'            => 'alpha.png',
                'email'           => 'alpha'.time().'@mail.com',
                'contact_number'  => '0300'.rand(1000000,9999999),
                'licenses'        => 'LIC-12345',
                'address'         => 'Lahore, Pakistan',
                'bank_name'       => 'HBL',
                'account_number'  => 'ACC'.rand(10000000,99999999),
                'account_title'   => 'Alpha Traders',
                'iban'            => 'PK36SCBL0000001123456702',
                'payment_method'  => 'Bank Transfer',
                'status'          => 'active',
                'is_verified'     => '1',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],

            [
                'company_name'     => 'Beta Solutions',
                'first_name'      => 'Usman',
                'last_name'       => 'Raza',
                'father_name'     => 'Rashid Raza',
                'slug'            => Str::slug('Beta Solutions'),
                'description'     => 'IT services provider',
                'logo'            => 'beta.png',
                'email'           => 'beta'.time().'@mail.com',
                'contact_number'  => '0311'.rand(1000000,9999999),
                'licenses'        => 'LIC-67890',
                'address'         => 'Karachi, Pakistan',
                'bank_name'       => 'UBL',
                'account_number'  => 'ACC'.rand(20000000,29999999),
                'account_title'   => 'Beta Solutions',
                'iban'            => 'PK12HABB0000002234567890',
                'payment_method'  => 'JazzCash',
                'status'          => 'active',
                'is_verified'     => '0',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],

            [
                'company_name'     => 'Gamma Enterprises',
                'first_name'      => 'Hassan',
                'last_name'       => 'Ali',
                'father_name'     => 'Imran Ali',
                'slug'            => Str::slug('Gamma Enterprises'),
                'description'     => 'Construction materials supplier',
                'logo'            => 'gamma.png',
                'email'           => 'gamma'.time().'@mail.com',
                'contact_number'  => '0322'.rand(1000000,9999999),
                'licenses'        => 'LIC-54321',
                'address'         => 'Islamabad, Pakistan',
                'bank_name'       => 'Meezan Bank',
                'account_number'  => 'ACC'.rand(30000000,39999999),
                'account_title'   => 'Gamma Enterprises',
                'iban'            => 'PK87MEZN0000003345678901',
                'payment_method'  => 'EasyPaisa',
                'status'          => 'inactive',
                'is_verified'     => '1',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);
    }
}
