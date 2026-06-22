<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * SEO: pair "chauffeur" with "car rentals" on the Executive Chauffeur
     * service so it surfaces for car-rental searches. Operates by slug so it
     * is safe on production data. Slug is intentionally left unchanged.
     */
    public function up(): void
    {
        DB::table('services')->where('slug', 'executive-chauffeur')->update([
            'name' => 'Executive Chauffeur & Car Rentals',
            'short_description' => 'Hourly and daily executive chauffeur and car rental hire. Discreet, professional, always on time.',
            'meta_title' => 'Executive Chauffeur & Car Rental Service Ghana | Hourly & Daily Hire | Uprise',
            'meta_description' => 'Premium executive chauffeur and car rental hire in Ghana. Professional, discreet drivers by the hour or day. Executive sedans and SUVs. Book your Accra car rental today.',
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('services')->where('slug', 'executive-chauffeur')->update([
            'name' => 'Executive Chauffeur',
            'short_description' => 'Hourly and daily executive chauffeur hire. Discreet, professional, always on time.',
            'meta_title' => 'Executive Chauffeur Service Ghana | Hourly & Daily Hire | Uprise',
            'meta_description' => 'Premium executive chauffeur hire in Ghana. Professional, discreet drivers by the hour or day. Executive sedans and SUVs. Book your Accra chauffeur today.',
            'updated_at' => now(),
        ]);
    }
};
