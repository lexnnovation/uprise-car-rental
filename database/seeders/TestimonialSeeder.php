<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'author_name' => 'Solomon Mensah',
                'author_role' => 'CEO, Mensah Capital',
                'content' => 'Uprise has completely changed how I think about ground transport in Accra. My driver is always 10 minutes early, the Mercedes is always immaculate, and I\'ve never once had to worry about a pickup. It\'s the closest thing to a private concierge service I\'ve experienced in Ghana.',
                'rating' => 5,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'author_name' => 'Amara Diallo',
                'author_role' => 'Events Director, Kempinski Hotel Gold Coast',
                'content' => 'We\'ve used Uprise for three major international conferences at our property. Each time, they coordinated 12–15 vehicles for delegate shuttles without a single hitch. The professionalism of their drivers genuinely impressed our international guests. They\'ve become our exclusive transport partner.',
                'rating' => 5,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'author_name' => 'Dr. Yaa Asante-Boateng',
                'author_role' => 'Physician, Kumasi',
                'content' => 'I booked a 4×4 for a trip to Mole National Park and the experience was extraordinary. The driver knew every trail, we spotted elephants within the first hour, and the vehicle was fully equipped for the journey. I\'ve recommended Uprise to every colleague planning a northern Ghana trip.',
                'rating' => 5,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'author_name' => 'James Harrington',
                'author_role' => 'Regional Director, Standard Chartered Ghana',
                'content' => 'As an expat in Accra, reliable airport transfers were my biggest pain point. Uprise solved it completely. Flight monitoring means my driver is always there even when I land late, and the WhatsApp coordination is incredibly convenient. Worth every pesewa.',
                'rating' => 5,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'author_name' => 'Sarah Kyei-Baffour',
                'author_role' => 'Corporate Travel Manager, Tullow Oil Ghana',
                'content' => 'Managing executive ground transport for 40+ staff across Accra used to be a constant headache. Since moving to Uprise\'s corporate account, it\'s completely hands-off. Monthly invoicing, detailed trip reports, and a dedicated account manager who actually answers the phone. Highly recommended.',
                'rating' => 5,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($testimonials as $data) {
            Testimonial::updateOrCreate(
                ['author_name' => $data['author_name'], 'author_role' => $data['author_role']],
                $data,
            );
        }
    }
}
