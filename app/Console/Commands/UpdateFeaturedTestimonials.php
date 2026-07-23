<?php

namespace App\Console\Commands;

use App\Models\Testimonial;
use Illuminate\Console\Command;

class UpdateFeaturedTestimonials extends Command
{
    protected $signature = 'testimonials:update-featured';

    protected $description = 'Add Albert Thambiratnam as the featured testimonial and rename Solomon Mensah / Amara Diallo to Dola Young / Prof. Benz Kotzen. Safe to re-run.';

    public function handle(): int
    {
        Testimonial::updateOrCreate(
            ['author_name' => 'Albert Thambiratnam'],
            [
                'author_role' => 'Houston, Texas, USA',
                'content' => "Our guide Joseph was the absolute highlight of our trip to Ghana. His depth of knowledge went far beyond the tourist sites, helping us truly understand Ghanaian history and culture, and he made every step of the journey smooth, comfortable and safe. The Uprise team was just as impressive, with everything smoothly organized and clear, responsive communication on WhatsApp throughout. We will be recommending Ghana, and Uprise, to all our friends and family.",
                'rating' => 5,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 0,
            ],
        );
        $this->info('OK: Albert Thambiratnam set as featured testimonial.');

        $solomon = Testimonial::where('author_name', 'Solomon Mensah')->first();
        if ($solomon) {
            $solomon->update(['author_name' => 'Dola Young', 'author_role' => 'USA']);
            $this->info('OK: Solomon Mensah -> Dola Young.');
        } else {
            $this->warn('Skip: "Solomon Mensah" not found (already renamed or missing).');
        }

        $amara = Testimonial::where('author_name', 'Amara Diallo')->first();
        if ($amara) {
            $amara->update(['author_name' => 'Prof. Benz Kotzen', 'author_role' => 'USA']);
            $this->info('OK: Amara Diallo -> Prof. Benz Kotzen.');
        } else {
            $this->warn('Skip: "Amara Diallo" not found (already renamed or missing).');
        }

        return self::SUCCESS;
    }
}
