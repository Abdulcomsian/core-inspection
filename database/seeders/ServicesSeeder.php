<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;
class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'International Sign Language',
                'user_id'=>1,
                'price' => 200,
            ], [
                'name' => 'Mobility Guides',
                'user_id'=>1,
                'price' => 300,
            ], [
                'name' => 'Live & Closed Captioning',
                'user_id'=>1,
                'price' => 400,
            ], [
                'name' => 'Personal Assistants',
                'user_id'=>1,
                'price' => 200,
            ], [
                'name' => 'Tactile sign language',
                'user_id'=>1,
                'price' => 400,
            ], [
                'name' => 'Ugandan Sign language',
                'user_id'=>1,
                'price' => 500,
            ]
        ];

        foreach ($services as $service) {
            ServiceCategory::create($service);
        }
    }
}
