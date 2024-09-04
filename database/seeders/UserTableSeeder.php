<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       $user1 =  User::create([
            'name' => 'Taylor Swift',
            'first_name'=>'Taylor',
            'last_name'=>'Swift',
            'email' => 'taylor.swift@user.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'type' => 'System User',
            'status' => 'Active'
        ]);
        $user1->assignRole('user');

        $user2 =  User::create([
            'name' => 'Asim Khan',
            'first_name'=>'Asim',
            'last_name'=>'Khan',
            'email' => 'asim.khan@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'type' => 'System User',
            'status' => 'Active'

        ]);
        $user2->assignRole('user');

        $user3 =  User::create([
            'name' => 'Gurbaaz Khan',
            'first_name'=>'Gurbaaz',
            'last_name'=>'Khan',
            'email' => 'gurbaaz.khan@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'type' => 'System User',
            'status' => 'Active'

        ]);
        $user3->assignRole('user');

        $user4 =  User::create([
            'name' => 'Muhammad Bilal',
            'first_name'=>'Muhammad',
            'last_name'=>'Bilal',
            'email' => 'm.bilal@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'type' => 'System User',
            'status' => 'Active'

        ]);
        $user4->assignRole('user');

        $user5 =  User::create([
            'name' => 'User',
            'first_name'=>'User',
            'last_name'=>'Person',
            'email' => 'user@user.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'type' => 'Admin',
            'status' => 'Active'

        ]);
        $user5->assignRole('user');
    }
}
