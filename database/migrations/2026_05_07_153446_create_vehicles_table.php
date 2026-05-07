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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_category_id')
                ->constrained()
                ->restrictOnDelete();

            // Identity
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('short_description', 500)->nullable();
            $table->longText('description')->nullable();

            // Specs
            $table->unsignedSmallInteger('passenger_count')->default(4);
            $table->unsignedSmallInteger('luggage_count')->default(2);

            // Operational state — string enum for SQLite/MySQL portability
            $table->string('status', 32)->default('available')
                ->comment('available | unavailable | coming_soon');
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('sort_order')->default(0);

            // SEO triplet (per-vehicle override; falls back to defaults)
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 320)->nullable();

            // Publication
            $table->timestamp('published_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'is_featured', 'sort_order']);
            $table->index(['vehicle_category_id', 'sort_order']);
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
