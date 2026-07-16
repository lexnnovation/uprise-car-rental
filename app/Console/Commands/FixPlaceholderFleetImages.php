<?php

namespace App\Console\Commands;

use App\Models\Vehicle;
use App\Models\VehicleCategory;
use Illuminate\Console\Command;

class FixPlaceholderFleetImages extends Command
{
    protected $signature = 'fleet:fix-placeholder-images';

    protected $description = 'Rename placeholder vehicle records to their category name and attach a real hero photo from public/images/fleet/. Matches by category relationship, not hardcoded IDs, so it is safe across environments. Safe to re-run.';

    /**
     * category slug => [list of relative image paths under public/images/fleet/, generic category blurb]
     *
     * Vehicles within a category are assigned images in order (by id),
     * cycling through the list if there are more vehicles than images.
     */
    private const CATEGORY_MAP = [
        'saloon-sedan-cars' => [
            'images' => [
                'saloon-sedan-cars/2020-toyota-corolla_uprisetravel.jpg',
                'saloon-sedan-cars/honda_uprisetravel.jpg',
                'saloon-sedan-cars/2019-hyundai-uprisetravel.webp',
            ],
            'desc' => 'Comfortable executive sedan for airport transfers, business travel and city journeys.',
        ],
        'suv-4x4' => [
            'images' => [
                'suv-4x4/1/DSC09369.jpg',
                'suv-4x4/2/uprise_travel DSC02305.jpg',
                'suv-4x4/3/uprise_travel DSC02354.jpg',
                'suv-4x4/4/DSC09395.jpg',
            ],
            'desc' => 'Spacious, capable SUV for city travel, safaris and rougher terrain across Ghana.',
        ],
        'minivan-sprinter' => [
            'images' => [
                'minivan-sprinter/1/mini_van1_Uprise.jpg',
                'minivan-sprinter/2/mini_van2_Uprise.jpg',
            ],
            'desc' => 'Group-friendly van for family trips, small tours and airport pickups.',
        ],
        'coaster-bus' => [
            'images' => [
                'coaster-bus/toyota-coaster-bus-30-seater-high-roof-diesel.jpg',
            ],
            'desc' => 'Air-conditioned coaster for larger groups, conference shuttles and tours.',
        ],
        'coach-bus' => [
            'images' => [
                'coach-bus/45-seat-coach-bus-rental-accra-ghana-1c-7.jpg',
            ],
            'desc' => 'Large coach for big groups, corporate transfers and cross-border travel.',
        ],
    ];

    public function handle(): int
    {
        // Source photos are large camera originals; processing several
        // Spatie conversions (thumb/card/hero/og) in one process can
        // exceed a default 128M CLI memory_limit.
        @ini_set('memory_limit', '512M');

        foreach (self::CATEGORY_MAP as $categorySlug => $info) {
            $category = VehicleCategory::where('slug', $categorySlug)->first();
            if (! $category) {
                $this->warn("Skip: category '{$categorySlug}' not found.");
                continue;
            }

            $vehicles = Vehicle::where('vehicle_category_id', $category->id)->orderBy('id')->get();
            if ($vehicles->isEmpty()) {
                $this->warn("Skip: no vehicles in category '{$categorySlug}'.");
                continue;
            }

            $images = $info['images'];

            foreach ($vehicles as $i => $vehicle) {
                $imagePath = $images[$i % count($images)];
                $path = public_path('images/fleet/' . $imagePath);

                if (! file_exists($path)) {
                    $this->error("Missing file for vehicle {$vehicle->id}: {$path}");
                    continue;
                }

                $vehicle->name = $category->name;
                $vehicle->short_description = $info['desc'];
                $vehicle->hero_image_url = null;
                $vehicle->save();

                $vehicle->clearMediaCollection('hero');
                $vehicle->addMedia($path)->preservingOriginal()->toMediaCollection('hero');

                $this->info("OK: vehicle {$vehicle->id} -> '{$category->name}' ({$imagePath})");
            }
        }

        return self::SUCCESS;
    }
}
