<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('hero_image_url')->nullable()->after('description');
            $table->json('gallery_images')->nullable()->after('hero_image_url');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->string('hero_image_url')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn(['hero_image_url', 'gallery_images']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('hero_image_url');
        });
    }
};
