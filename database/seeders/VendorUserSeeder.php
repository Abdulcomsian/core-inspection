<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class VendorUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendor =  User::create([
            'name' => 'Vendor',
            'first_name' => 'Vendor',
            'last_name' => 'User',
            'email' => 'vendor@vendor.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'type' => 'System User',
            'status' => 'Active'

        ]);
        $vendor->assignRole('vendor_user');

        $vendor2 =  User::create([
            'name' => 'John Doe',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@vendor.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'type' => 'System User',
            'status' => 'Active'

        ]);
        $vendor2->assignRole('vendor_user');
    }
}
