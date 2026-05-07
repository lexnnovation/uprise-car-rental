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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();

            // Identity
            $table->string('full_name');
            $table->string('email');
            $table->string('phone', 32);

            // Trip
            $table->string('pickup_location')->nullable();
            $table->string('destination')->nullable();
            $table->date('travel_date_start')->nullable();
            $table->date('travel_date_end')->nullable();
            $table->unsignedSmallInteger('passenger_count')->nullable();

            // Optional context — nullable FKs (avoid polymorphism noise)
            $table->foreignId('vehicle_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->foreignId('service_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->text('notes')->nullable();

            // Pipeline
            $table->string('source', 32)->default('web_form')
                ->comment('web_form | whatsapp_click | vehicle_page | service_page | landing_page');
            $table->string('status', 32)->default('new')
                ->comment('new | contacted | qualified | won | lost');

            // Spam / analytics
            $table->ipAddress('ip')->nullable();
            $table->string('user_agent', 512)->nullable();

            $table->timestamps();

            $table->index(['status', 'created_at']);
            $table->index(['source', 'created_at']);
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
