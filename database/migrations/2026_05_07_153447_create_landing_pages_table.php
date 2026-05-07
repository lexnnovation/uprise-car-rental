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
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('heading')->nullable();
            $table->string('intro', 500)->nullable();
            $table->longText('body')->nullable();

            // Per-page structured FAQs (renders as <FAQPage> JSON-LD)
            $table->json('faqs')->nullable();

            // SEO triplet
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 320)->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamp('published_at')->nullable();

            $table->timestamps();

            $table->index(['is_active', 'published_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_pages');
    }
};
