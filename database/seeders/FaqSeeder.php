<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            // General
            [
                'question' => 'Do you operate 24 hours a day, 7 days a week?',
                'answer' => 'Yes. Uprise operates around the clock, 365 days a year — including public holidays. Whether your flight lands at 3 AM or you need an early-morning corporate pickup, we\'re available.',
                'category' => 'General',
                'sort_order' => 1,
            ],
            [
                'question' => 'Which areas of Ghana do you cover?',
                'answer' => 'We operate primarily in Greater Accra and cover the full country for long-distance transfers. Popular routes include Accra–Kumasi, Accra–Cape Coast, Accra–Tamale, and connections to all regional airports. We also handle cross-border trips into Togo, Benin, Ivory Coast and Nigeria.',
                'category' => 'General',
                'sort_order' => 2,
            ],
            [
                'question' => 'How do I make a booking?',
                'answer' => 'The fastest way is to use our inquiry form or WhatsApp us directly. Provide your pickup location, destination, date and time, and passenger count — and our team will confirm your booking within 30 minutes during business hours.',
                'category' => 'General',
                'sort_order' => 3,
            ],
            [
                'question' => 'What payment methods do you accept?',
                'answer' => 'We accept Mobile Money (MTN, Vodafone, AirtelTigo), bank transfer, and cash. Corporate accounts are invoiced monthly. Card payments are available on request.',
                'category' => 'General',
                'sort_order' => 4,
            ],
            [
                'question' => 'Can I cancel or change a booking?',
                'answer' => 'Yes. Cancellations made more than 4 hours before the scheduled pickup are fully refunded. Changes to time or pickup location can be made up to 2 hours before departure via WhatsApp.',
                'category' => 'General',
                'sort_order' => 5,
            ],

            // Airport
            [
                'question' => 'Do you offer flight tracking for airport pickups?',
                'answer' => 'Yes. We monitor all incoming flights in real time using your flight number. If your flight is delayed or arrives early, your driver adjusts automatically — you will never be left waiting at arrivals.',
                'category' => 'Airport',
                'sort_order' => 1,
            ],
            [
                'question' => 'How far in advance should I book an airport transfer?',
                'answer' => 'We recommend booking at least 24 hours in advance for guaranteed vehicle and driver assignment. That said, we accommodate same-day bookings subject to availability — contact us via WhatsApp for urgent requests.',
                'category' => 'Airport',
                'sort_order' => 2,
            ],
            [
                'question' => 'What happens if my flight is delayed significantly?',
                'answer' => 'Your driver waits. We include up to 60 minutes of complimentary waiting time for all airport arrivals. For longer delays, our team will keep in contact with you and ensure your driver is available when you land.',
                'category' => 'Airport',
                'sort_order' => 3,
            ],
            [
                'question' => 'Do you cover Kumasi and Takoradi airports?',
                'answer' => 'Yes. We service Kumasi International Airport (KMS) and Takoradi Airport in addition to Kotoka International Airport (ACC). Long-distance transfers between these airports and any Ghanaian city are available on request.',
                'category' => 'Airport',
                'sort_order' => 4,
            ],

            // Fleet
            [
                'question' => 'Can I request a specific vehicle model?',
                'answer' => 'Yes. When submitting your inquiry, simply mention the vehicle preference. We\'ll confirm availability and match you to the closest option. Popular requests include the Mercedes-Benz S-Class, Range Rover Sport, and Mercedes V-Class Sprinter.',
                'category' => 'Fleet',
                'sort_order' => 1,
            ],
            [
                'question' => 'Are child seats available?',
                'answer' => 'Yes, child seats and booster seats are available on request at no extra charge. Please mention your requirement when booking so we can fit the appropriate seat before your pickup.',
                'category' => 'Fleet',
                'sort_order' => 2,
            ],
            [
                'question' => 'How many passengers can your vehicles accommodate?',
                'answer' => 'Our fleet ranges from 3-passenger luxury sedans up to 50-seat coaches. Sedans seat 3 comfortably with luggage; Sprinters seat 7–12; our Toyota Coaster and full coaches seat 30–50. Contact us for large group requirements.',
                'category' => 'Fleet',
                'sort_order' => 3,
            ],

            // Chauffeur
            [
                'question' => 'Are your drivers professionally trained and vetted?',
                'answer' => 'All Uprise drivers hold valid Ghanaian commercial driving licenses, pass a comprehensive background check, and complete our in-house service and hospitality training before their first assignment. Regular refresher training ensures consistent standards.',
                'category' => 'Chauffeur',
                'sort_order' => 1,
            ],
            [
                'question' => 'Can I hire a driver for multiple days or a full week?',
                'answer' => 'Absolutely. Multi-day and weekly chauffeur hire is available and often preferred by visiting executives and delegations. Your driver will be exclusively assigned to you for the duration, available from early morning to late evening.',
                'category' => 'Chauffeur',
                'sort_order' => 2,
            ],

            // Safari
            [
                'question' => 'Do you operate safaris to Mole National Park?',
                'answer' => 'Yes. Mole National Park is one of our most popular routes. We offer day-trip and multi-day packages from Accra in purpose-built 4×4 vehicles. Our driver-guides are experienced in navigating the park and can coordinate accommodation at Mole Motel or Zaina Lodge on request.',
                'category' => 'Safari',
                'sort_order' => 1,
            ],
        ];

        foreach ($faqs as $data) {
            Faq::updateOrCreate(
                ['question' => $data['question']],
                $data,
            );
        }
    }
}
