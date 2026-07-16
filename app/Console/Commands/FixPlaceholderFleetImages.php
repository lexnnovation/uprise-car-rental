<?php

namespace App\Console\Commands;

use App\Models\Vehicle;
use Illuminate\Console\Command;

class FixPlaceholderFleetImages extends Command
{
    protected $signature = 'fleet:fix-placeholder-images';

    protected $description = 'Rename placeholder vehicle records to their category name and attach a real hero photo from public/images/fleet/. Safe to re-run.';

    /**
     * vehicle id => [relative path under public/images/fleet/, generic category blurb]
     */
    private const MAP = [
        3  => ['image' => 'saloon-sedan-cars/2020-toyota-corolla_uprisetravel.jpg', 'desc' => 'Comfortable executive sedan for airport transfers, business travel and city journeys.'],
        4  => ['image' => 'saloon-sedan-cars/honda_uprisetravel.jpg', 'desc' => 'Comfortable executive sedan for airport transfers, business travel and city journeys.'],
        5  => ['image' => 'saloon-sedan-cars/2019-hyundai-uprisetravel.webp', 'desc' => 'Comfortable executive sedan for airport transfers, business travel and city journeys.'],
        6  => ['image' => 'suv-4x4/1/DSC09369.jpg', 'desc' => 'Spacious, capable SUV for city travel, safaris and rougher terrain across Ghana.'],
        7  => ['image' => 'suv-4x4/2/uprise_travel DSC02305.jpg', 'desc' => 'Spacious, capable SUV for city travel, safaris and rougher terrain across Ghana.'],
        9  => ['image' => 'suv-4x4/3/uprise_travel DSC02354.jpg', 'desc' => 'Spacious, capable SUV for city travel, safaris and rougher terrain across Ghana.'],
        10 => ['image' => 'suv-4x4/4/DSC09395.jpg', 'desc' => 'Spacious, capable SUV for city travel, safaris and rougher terrain across Ghana.'],
        8  => ['image' => 'minivan-sprinter/1/mini_van1_Uprise.jpg', 'desc' => 'Group-friendly van for family trips, small tours and airport pickups.'],
        11 => ['image' => 'minivan-sprinter/2/mini_van2_Uprise.jpg', 'desc' => 'Group-friendly van for family trips, small tours and airport pickups.'],
        12 => ['image' => 'coaster-bus/toyota-coaster-bus-30-seater-high-roof-diesel.jpg', 'desc' => 'Air-conditioned coaster for larger groups, conference shuttles and tours.'],
        13 => ['image' => 'coach-bus/45-seat-coach-bus-rental-accra-ghana-1c-7.jpg', 'desc' => 'Large coach for big groups, corporate transfers and cross-border travel.'],
    ];

    public function handle(): int
    {
        // Source photos are large camera originals; processing several
        // Spatie conversions (thumb/card/hero/og) in one process can
        // exceed a default 128M CLI memory_limit.
        @ini_set('memory_limit', '512M');

        foreach (self::MAP as $id => $info) {
            $vehicle = Vehicle::with('category')->find($id);
            if (! $vehicle) {
                $this->warn("Skip: vehicle {$id} not found.");
                continue;
            }

            $path = public_path('images/fleet/' . $info['image']);
            if (! file_exists($path)) {
                $this->error("Missing file for vehicle {$id}: {$path}");
                continue;
            }

            $categoryName = $vehicle->category->name ?? $vehicle->name;

            $vehicle->name = $categoryName;
            $vehicle->short_description = $info['desc'];
            $vehicle->hero_image_url = null;
            $vehicle->save();

            $vehicle->clearMediaCollection('hero');
            $vehicle->addMedia($path)->preservingOriginal()->toMediaCollection('hero');

            $this->info("OK: vehicle {$id} -> '{$categoryName}' ({$info['image']})");
        }

        return self::SUCCESS;
    }
}
