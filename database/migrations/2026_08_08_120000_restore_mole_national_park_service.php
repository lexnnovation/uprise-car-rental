<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * The mole-national-park service row went missing in production (likely
     * dropped during the Aug 2026 SQLite recovery, which truncates and
     * replaces the services table from whatever rows survived). It's still
     * hardcoded into the homepage, header nav, and footer, so it 404s from
     * multiple pages. Restores the exact row from ServiceSeeder without
     * touching the other 15 services. Uses updateOrInsert so this is a
     * no-op on installs where the row already exists.
     */
    public function up(): void
    {
        DB::table('services')->updateOrInsert(
            ['slug' => 'mole-national-park'],
            [
                'name' => 'Mole National Park Car Rentals',
                'icon' => 'sun',
                'hero_image_url' => '/images/services/mole-national-park.jpg',
                'sort_order' => 16,
                'is_active' => true,
                'short_description' => 'Mole National Park car rentals — dedicated 4×4 transport to and within Mole, Ghana\'s largest wildlife reserve and premier safari destination.',
                'description' => '<p>Mole National Park is Ghana\'s largest wildlife reserve and home to elephants, buffalo, antelope, warthogs, and over 300 bird species. Getting there and exploring it properly requires the right vehicle and a driver who knows the terrain.</p><p>Uprise provides purpose-built 4×4 Land Cruisers and Fortuners for Mole transfers from Accra or Tamale, as well as in-park transport for multi-day safari stays. Our drivers are experienced on the unpaved roads around Mole Motel and the park\'s interior tracks. We also arrange Larabanga Mosque stops and Damongo day trips en route.</p>',
                'meta_title' => 'Mole National Park Car Rentals | 4x4 Safari Transfer Ghana | Uprise',
                'meta_description' => 'Mole National Park car rentals — reliable 4x4 car hire for Mole, Ghana. Transfers from Accra or Tamale, in-park transport, experienced safari drivers. Book today.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    public function down(): void
    {
        // Data-recovery migration; don't delete the row on rollback.
    }
};
