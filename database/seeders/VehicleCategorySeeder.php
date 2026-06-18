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
                'name' => 'Executive Sedan',
                'slug' => 'executive-sedan',
                'description' => 'Premium executive sedans for business travel and airport transfers. Immaculate interiors, professional drivers.',
                'icon' => 'bolt',
                'sort_order' => 1,
            ],
            [
                'name' => 'Executive SUV',
                'slug' => 'executive-suv',
                'description' => 'High-end SUVs combining comfort with capability. Ideal for families, executives and VIP clients.',
                'icon' => 'sparkles',
                'sort_order' => 2,
            ],
            [
                'name' => 'SUV',
                'slug' => 'suv',
                'description' => 'Spacious and dependable SUVs for group travel, upcountry trips and diverse terrain.',
                'icon' => 'truck',
                'sort_order' => 3,
            ],
            [
                'name' => 'Minivan & Sprinter',
                'slug' => 'minivan-sprinter',
                'description' => 'Versatile vans seating 7–12 passengers. Perfect for corporate groups, airport shuttles and events.',
                'icon' => 'users',
                'sort_order' => 4,
            ],
            [
                'name' => 'Coach & Bus',
                'slug' => 'coach-bus',
                'description' => 'Full-size coaches for large groups, conferences and long-distance travel across Ghana and West Africa.',
                'icon' => 'building-office',
                'sort_order' => 5,
            ],
            [
                'name' => '4×4 Safari',
                'slug' => '4x4-safari',
                'description' => 'Purpose-built 4×4 vehicles for safari tours, Mole National Park, and off-road West African destinations.',
                'icon' => 'sun',
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $data) {
            VehicleCategory::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
