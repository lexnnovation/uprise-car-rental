<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Restructure the fleet into 5 size-based categories, dropping the
     * Executive tier. Operates by slug so it is safe on production data
     * regardless of row IDs.
     */
    public function up(): void
    {
        $now = now();

        $idBySlug = fn (string $slug) => DB::table('vehicle_categories')->where('slug', $slug)->value('id');

        // 1. Ensure the target categories exist (create new, rename existing).
        $targets = [
            [
                'slug' => 'suv-4x4',
                'name' => 'SUV & 4X4',
                'description' => 'Rugged SUVs and 4×4s for upcountry trips, safari and diverse terrain across Ghana and West Africa.',
                'icon' => 'truck',
                'sort_order' => 1,
            ],
            [
                'slug' => 'saloon-sedan-cars',
                'name' => 'Saloon / Sedan Cars',
                'description' => 'Comfortable saloon and sedan cars for city travel, business trips and airport transfers.',
                'icon' => 'bolt',
                'sort_order' => 2,
            ],
            [
                'slug' => 'minivan-sprinter',
                'name' => 'Mini Van & Sprinters',
                'description' => 'Versatile vans seating 7–12 passengers. Perfect for groups, airport shuttles and events.',
                'icon' => 'users',
                'sort_order' => 3,
            ],
            [
                'slug' => 'coaster-bus',
                'name' => 'Coaster Bus',
                'description' => 'Mid-size Coaster buses for medium groups, tours and long-distance comfort.',
                'icon' => 'building-office',
                'sort_order' => 4,
            ],
            [
                'slug' => 'coach-bus',
                'name' => 'Coach & Buses',
                'description' => 'Full-size coaches for large groups, conferences and long-distance travel.',
                'icon' => 'building-office-2',
                'sort_order' => 5,
            ],
        ];

        foreach ($targets as $t) {
            $existing = $idBySlug($t['slug']);
            if ($existing) {
                DB::table('vehicle_categories')->where('id', $existing)->update([
                    'name' => $t['name'],
                    'description' => $t['description'],
                    'icon' => $t['icon'],
                    'sort_order' => $t['sort_order'],
                    'is_active' => true,
                    'updated_at' => $now,
                ]);
            } else {
                DB::table('vehicle_categories')->insert($t + [
                    'is_active' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        // 2. Remap vehicles from old categories to the new scheme (by slug).
        //    NOTE: order matters — move the Coaster out of coach-bus BEFORE
        //    coach-bus is repurposed as the (empty) "Coach & Buses".
        $remap = [
            'coach-bus' => 'coaster-bus',      // existing Coaster -> Coaster Bus
            'executive-sedan' => 'saloon-sedan-cars',
            'executive-suv' => 'suv-4x4',
            'suv' => 'suv-4x4',
            '4x4-safari' => 'suv-4x4',
        ];

        foreach ($remap as $from => $to) {
            $fromId = $idBySlug($from);
            $toId = $idBySlug($to);
            if ($fromId && $toId) {
                DB::table('vehicles')->where('vehicle_category_id', $fromId)
                    ->update(['vehicle_category_id' => $toId, 'updated_at' => $now]);
            }
        }

        // 3. Remove the now-unused legacy categories.
        DB::table('vehicle_categories')
            ->whereIn('slug', ['executive-sedan', 'executive-suv', 'suv', '4x4-safari'])
            ->delete();
    }

    /**
     * Best-effort reverse: restores the legacy category rows. Vehicle
     * re-assignment is lossy and is not reversed.
     */
    public function down(): void
    {
        $now = now();

        $legacy = [
            ['slug' => 'executive-sedan', 'name' => 'Executive Sedan', 'icon' => 'bolt', 'sort_order' => 1],
            ['slug' => 'executive-suv', 'name' => 'Executive SUV', 'icon' => 'sparkles', 'sort_order' => 2],
            ['slug' => 'suv', 'name' => 'SUV', 'icon' => 'truck', 'sort_order' => 3],
            ['slug' => '4x4-safari', 'name' => '4×4 Safari', 'icon' => 'sun', 'sort_order' => 6],
        ];

        foreach ($legacy as $row) {
            DB::table('vehicle_categories')->updateOrInsert(
                ['slug' => $row['slug']],
                $row + ['is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            );
        }

        DB::table('vehicle_categories')->where('slug', 'coaster-bus')->delete();

        DB::table('vehicle_categories')->where('slug', 'minivan-sprinter')
            ->update(['name' => 'Minivan & Sprinter', 'sort_order' => 4, 'updated_at' => $now]);
        DB::table('vehicle_categories')->where('slug', 'coach-bus')
            ->update(['name' => 'Coach & Bus', 'icon' => 'building-office', 'sort_order' => 5, 'updated_at' => $now]);
    }
};
