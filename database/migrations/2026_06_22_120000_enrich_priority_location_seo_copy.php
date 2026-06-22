<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * SEO: weave high-intent phrase variants ("rent a car in X", "X car
     * rentals") into the priority location pages — Accra, Tamale and Mole.
     * Operates by slug so it is production-safe. Mirrors ServiceSeeder.
     */
    public function up(): void
    {
        $copy = [
            'accra-car-rentals' => [
                'meta_title' => 'Accra Car Rentals | Rent a Car in Accra with Driver | Uprise Travel',
                'short_description' => 'Rent a car in Accra with a professional driver — daily and weekly Accra car rentals across Airport Hills, Osu, East Legon, Cantonments and the greater Accra region.',
                'meta_description' => 'Rent a car in Accra with a professional driver. Daily and weekly Accra car rentals across Osu, East Legon, Airport City and Greater Accra. Book your Accra car rental today.',
            ],
            'tamale-car-rentals' => [
                'meta_title' => 'Tamale Car Rentals | Rent a Car in Tamale with Driver | Uprise Travel',
                'short_description' => 'Rent a car in Tamale with a driver — Tamale car rentals across Northern Ghana, ideal for NGO work, development-sector travel and northern region exploration.',
                'meta_description' => 'Rent a car in Tamale with a professional driver. Tamale car rentals across Northern Ghana — NGO travel, Mole National Park trips and northern region exploration.',
            ],
            'mole-national-park' => [
                'meta_title' => 'Mole National Park Car Rentals | 4x4 Safari Transfer Ghana | Uprise',
                'short_description' => 'Mole National Park car rentals — dedicated 4×4 transport to and within Mole, Ghana\'s largest wildlife reserve and premier safari destination.',
                'meta_description' => 'Mole National Park car rentals — reliable 4x4 car hire for Mole, Ghana. Transfers from Accra or Tamale, in-park transport, experienced safari drivers. Book today.',
            ],
        ];

        foreach ($copy as $slug => $fields) {
            DB::table('services')->where('slug', $slug)->update($fields + ['updated_at' => now()]);
        }
    }

    public function down(): void
    {
        // Non-reversible content tweak; previous copy is recoverable from git history.
    }
};
