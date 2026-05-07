<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    public function run(): void
    {
        $features = [
            ['name' => 'Air Conditioning',       'slug' => 'air-conditioning',    'icon' => 'wind',            'sort_order' => 1],
            ['name' => 'Wi-Fi On Board',          'slug' => 'wifi',                'icon' => 'wifi',            'sort_order' => 2],
            ['name' => 'Leather Seats',           'slug' => 'leather-seats',       'icon' => 'check-badge',     'sort_order' => 3],
            ['name' => 'Complimentary Water',     'slug' => 'complimentary-water', 'icon' => 'beaker',          'sort_order' => 4],
            ['name' => 'Phone Charger',           'slug' => 'phone-charger',       'icon' => 'bolt',            'sort_order' => 5],
            ['name' => 'Privacy Partition',       'slug' => 'privacy-partition',   'icon' => 'eye-slash',       'sort_order' => 6],
            ['name' => 'Professional Driver',     'slug' => 'professional-driver', 'icon' => 'identification',  'sort_order' => 7],
            ['name' => 'Flight Monitoring',       'slug' => 'flight-monitoring',   'icon' => 'paper-airplane',  'sort_order' => 8],
            ['name' => '24/7 Availability',       'slug' => '24-7-availability',   'icon' => 'clock',           'sort_order' => 9],
            ['name' => 'Meet & Greet',            'slug' => 'meet-and-greet',      'icon' => 'hand-raised',     'sort_order' => 10],
            ['name' => 'Luggage Assistance',      'slug' => 'luggage-assistance',  'icon' => 'archive-box',     'sort_order' => 11],
            ['name' => 'Child Seat on Request',   'slug' => 'child-seat',          'icon' => 'heart',           'sort_order' => 12],
        ];

        foreach ($features as $data) {
            Feature::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
