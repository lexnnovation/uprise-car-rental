<?php

namespace App\Console\Commands;

use App\Models\Service;
use Illuminate\Console\Command;

class FixServiceTitles extends Command
{
    protected $signature = 'services:fix-titles';

    protected $description = 'Standardize service meta_title brand suffix to "Uprise Travel Car Rentals" and remove "Chauffeur" wording. Safe to re-run.';

    private const MAP = [
        'airport-transfer' => 'Airport Transfer Ghana | Kotoka Airport Pickup & Drop-off | Uprise Travel Car Rentals',
        'executive-chauffeur' => 'Executive Car Rental Service Ghana | Hourly & Daily Hire | Uprise Travel Car Rentals',
        'corporate-travel' => 'Corporate Transportation Ghana | Business Fleet Services | Uprise Travel Car Rentals',
        'safari-wildlife' => 'Ghana Safari Transport | Mole National Park 4x4 Tours | Uprise Travel Car Rentals',
        'group-event-transfers' => 'Group Transport Ghana | Event Shuttle Service Accra | Uprise Travel Car Rentals',
        'wedding-car' => 'Wedding Car Hire Ghana | Bridal Transportation Accra | Uprise Travel Car Rentals',
        'cape-coast-day-tours' => 'Cape Coast Day Tours Ghana | Cruise Ship Shore Excursions | Uprise Travel Car Rentals',
        'cross-border-travel' => 'Cross-Border Transport West Africa | Accra to Lagos, Lomé | Uprise Travel Car Rentals',
        'ghana-car-rentals' => 'Ghana Car Rentals with Driver | Nationwide Hire | Uprise Travel Car Rentals',
        'accra-car-rentals' => 'Accra Car Rentals | Rent a Car in Accra with Driver | Uprise Travel Car Rentals',
        'accra-airport-pickups' => 'Accra Airport Pickup | Kotoka International Airport Transfer | Uprise Travel Car Rentals',
        'tamale-airport-pickups' => 'Tamale Airport Pickup | Northern Ghana Airport Transfer | Uprise Travel Car Rentals',
        'tamale-car-rentals' => 'Tamale Car Rentals | Rent a Car in Tamale with Driver | Uprise Travel Car Rentals',
        'kumasi-car-rentals' => 'Kumasi Car Rentals with Driver | Ashanti Region Hire | Uprise Travel Car Rentals',
        'cape-coast-car-rentals' => 'Cape Coast Car Rentals | Central Region Driver Hire | Uprise Travel Car Rentals',
        'mole-national-park' => 'Mole National Park Car Rentals | 4x4 Safari Transfer Ghana | Uprise Travel Car Rentals',
    ];

    public function handle(): int
    {
        foreach (self::MAP as $slug => $title) {
            $service = Service::where('slug', $slug)->first();

            if (! $service) {
                $this->warn("Skip: service '{$slug}' not found.");
                continue;
            }

            $service->meta_title = $title;
            $service->save();

            $this->info("OK: {$slug} -> '{$title}'");
        }

        return self::SUCCESS;
    }
}
