<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * SEO: lead vehicle page <title> tags with "Car Rental with Driver"
     * instead of "Chauffeur". Operates on live rows, replacing only the
     * meta_title token so descriptions (which use "chauffeur" naturally)
     * are left intact.
     */
    public function up(): void
    {
        DB::table('vehicles')
            ->where('meta_title', 'like', '%Chauffeur%')
            ->select('id', 'meta_title')
            ->get()
            ->each(function ($vehicle) {
                DB::table('vehicles')->where('id', $vehicle->id)->update([
                    'meta_title' => str_replace('Chauffeur', 'Car Rental with Driver', $vehicle->meta_title),
                    'updated_at' => now(),
                ]);
            });
    }

    public function down(): void
    {
        DB::table('vehicles')
            ->where('meta_title', 'like', '%Car Rental with Driver%')
            ->select('id', 'meta_title')
            ->get()
            ->each(function ($vehicle) {
                DB::table('vehicles')->where('id', $vehicle->id)->update([
                    'meta_title' => str_replace('Car Rental with Driver', 'Chauffeur', $vehicle->meta_title),
                    'updated_at' => now(),
                ]);
            });
    }
};
