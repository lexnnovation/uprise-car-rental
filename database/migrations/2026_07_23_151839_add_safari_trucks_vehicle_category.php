<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $now = now();

        DB::table('vehicle_categories')->updateOrInsert(
            ['slug' => 'safari-trucks'],
            [
                'name' => 'Safari Trucks',
                'description' => 'Rugged 4x4 trucks built for safari routes and off-road terrain across Ghana\'s national parks.',
                'icon' => 'sun',
                'sort_order' => 6,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        );
    }

    public function down(): void
    {
        DB::table('vehicle_categories')->where('slug', 'safari-trucks')->delete();
    }
};
