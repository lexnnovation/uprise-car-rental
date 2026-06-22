<?php

namespace Database\Seeders;

use App\Models\VehicleCategory;
use Illuminate\Database\Seeder;

class VehicleCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'SUV & 4X4',
                'slug' => 'suv-4x4',
                'description' => 'Rugged SUVs and 4×4s for upcountry trips, safari and diverse terrain across Ghana and West Africa.',
                'icon' => 'truck',
                'sort_order' => 1,
            ],
            [
                'name' => 'Saloon / Sedan Cars',
                'slug' => 'saloon-sedan-cars',
                'description' => 'Comfortable saloon and sedan cars for city travel, business trips and airport transfers.',
                'icon' => 'bolt',
                'sort_order' => 2,
            ],
            [
                'name' => 'Mini Van & Sprinters',
                'slug' => 'minivan-sprinter',
                'description' => 'Versatile vans seating 7–12 passengers. Perfect for groups, airport shuttles and events.',
                'icon' => 'users',
                'sort_order' => 3,
            ],
            [
                'name' => 'Coaster Bus',
                'slug' => 'coaster-bus',
                'description' => 'Mid-size Coaster buses for medium groups, tours and long-distance comfort.',
                'icon' => 'building-office',
                'sort_order' => 4,
            ],
            [
                'name' => 'Coach & Buses',
                'slug' => 'coach-bus',
                'description' => 'Full-size coaches for large groups, conferences and long-distance travel.',
                'icon' => 'building-office-2',
                'sort_order' => 5,
            ],
        ];

        foreach ($categories as $data) {
            VehicleCategory::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
