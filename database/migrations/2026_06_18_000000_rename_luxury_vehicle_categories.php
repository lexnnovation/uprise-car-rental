<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('vehicle_categories')
            ->where('slug', 'luxury-sedan')
            ->update(['slug' => 'executive-sedan', 'name' => 'Executive Sedan']);

        DB::table('vehicle_categories')
            ->where('slug', 'luxury-suv')
            ->update(['slug' => 'executive-suv', 'name' => 'Executive SUV']);
    }

    public function down(): void
    {
        DB::table('vehicle_categories')
            ->where('slug', 'executive-sedan')
            ->update(['slug' => 'luxury-sedan', 'name' => 'Luxury Sedan']);

        DB::table('vehicle_categories')
            ->where('slug', 'executive-suv')
            ->update(['slug' => 'luxury-suv', 'name' => 'Luxury SUV']);
    }
};
