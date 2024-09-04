<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin1 =  User::create([
            'name' => 'Admin',
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'info@mavenprojects.cc',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'type' => 'System User',
            'status' => 'Active'

        ]);
        $admin1->assignRole('admin');

        $admin2 =  User::create([
            'name' => 'Muhammad Anees',
            'first_name' => 'Muhammad',
            'last_name' => 'Anees',
            'email' => 'm.anees@admin.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'type' => 'System User',
            'status' => 'Active'

        ]);
        $admin2->assignRole('admin');
    }
}
