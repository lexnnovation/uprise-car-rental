<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            // Content — order matters: categories + features before vehicles
            VehicleCategorySeeder::class,
            FeatureSeeder::class,
            VehicleSeeder::class,
            ServiceSeeder::class,
            TestimonialSeeder::class,
            FaqSeeder::class,
        ]);
    }
}
