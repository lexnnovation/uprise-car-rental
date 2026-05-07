<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Airport Transfer',
                'slug' => 'airport-transfer',
                'icon' => 'paper-airplane',
                'sort_order' => 1,
                'short_description' => 'Seamless door-to-door airport transfers across Ghana. We monitor your flight in real time so you never wait.',
                'description' => '<p>Arriving at Kotoka International Airport or Kumasi Airport? Uprise takes the stress out of your journey. Our professional drivers track your flight status in real time and adjust pickup timing automatically for delays. Expect a name-board meet-and-greet at arrivals, ice-cold complimentary water, and swift, silent transit to your destination.</p><p>We cover all major airports in Ghana and can arrange cross-border airport pickups on request. Available 24/7, 365 days a year.</p>',
                'meta_title' => 'Airport Transfer Ghana | Kotoka Airport Pickup & Drop-off | Uprise',
                'meta_description' => 'Professional airport transfer service in Ghana. Flight tracking, meet & greet at Kotoka International Airport (ACC) and Kumasi Airport. Available 24/7.',
            ],
            [
                'name' => 'Executive Chauffeur',
                'slug' => 'executive-chauffeur',
                'icon' => 'star',
                'sort_order' => 2,
                'short_description' => 'Hourly and daily executive chauffeur hire. Discreet, professional, always on time.',
                'description' => '<p>For business leaders, diplomats and VIP clients who demand more than a taxi. Our executive chauffeur service puts a professionally-trained, English-speaking driver at your disposal by the hour or day. Whether it\'s a full day of back-to-back meetings in Accra or a multi-city itinerary across Ghana, your chauffeur will keep you on schedule, informed, and relaxed.</p><p>All executive chauffeur vehicles are immaculately maintained premium sedans or luxury SUVs, fitted with Wi-Fi, phone charging, and chilled beverages on request.</p>',
                'meta_title' => 'Executive Chauffeur Service Ghana | Hourly & Daily Hire | Uprise',
                'meta_description' => 'Premium executive chauffeur hire in Ghana. Professional, discreet drivers by the hour or day. Luxury sedans and SUVs. Book your Accra chauffeur today.',
            ],
            [
                'name' => 'Corporate Travel',
                'slug' => 'corporate-travel',
                'icon' => 'briefcase',
                'sort_order' => 3,
                'short_description' => 'Dedicated fleet management for businesses. Centrally billed, monthly reporting, priority dispatch.',
                'description' => '<p>Uprise partners with corporations, embassies, NGOs and multinationals across Ghana to manage their ground transportation needs end-to-end. From daily executive commutes to conference shuttle fleets, we operate as a seamless extension of your operations team.</p><p>Benefits include centralized billing with detailed monthly reporting, a dedicated account manager, priority vehicle allocation, and a diverse fleet capable of handling single VIP pickups or 200-seat conference shuttles simultaneously.</p>',
                'meta_title' => 'Corporate Transportation Ghana | Business Fleet Services | Uprise',
                'meta_description' => 'Corporate ground transportation for businesses and embassies in Ghana. Dedicated fleet, central billing, monthly reporting. Request a corporate account.',
            ],
            [
                'name' => 'Safari & Wildlife Tours',
                'slug' => 'safari-wildlife',
                'icon' => 'sun',
                'sort_order' => 4,
                'short_description' => 'Guided 4×4 safari excursions to Mole National Park, Kakum, Paga Crocodile Pond and across Northern Ghana.',
                'description' => '<p>Ghana\'s natural wonders deserve a vehicle that can handle them. Our purpose-built 4×4 Land Cruisers and Fortuners are the transport of choice for Mole National Park safaris, Kakum National Park canopy walks, the Paga Crocodile Pond, Wli Waterfalls and the upper regions of Ghana.</p><p>Packages are fully customizable: day trip from Accra, multi-day northern Ghana circuits, or bespoke West Africa overland journeys. All safari vehicles come with experienced drivers who double as local guides.</p>',
                'meta_title' => 'Ghana Safari Transport | Mole National Park 4x4 Tours | Uprise',
                'meta_description' => 'Reliable 4x4 safari transport to Mole National Park, Kakum and Northern Ghana. Experienced driver-guides, Land Cruisers, customizable tours. Book now.',
            ],
            [
                'name' => 'Group & Event Transfers',
                'slug' => 'group-event-transfers',
                'icon' => 'users',
                'sort_order' => 5,
                'short_description' => 'Minivans, coaches and coordinated fleets for conferences, weddings, concerts and large events.',
                'description' => '<p>Moving groups seamlessly is a logistical art. Uprise has transported guest lists for international conferences at AICC, wedding parties across Greater Accra, festival-goers, and corporate team outings with fleets of 2 to 20 vehicles operating in tight coordination.</p><p>Our event transport coordinator works with your team in advance to map routes, stagger pickup windows and ensure every guest arrives on time. Vehicles range from 7-seater Sprinters to 30-seat coaches depending on your group size.</p>',
                'meta_title' => 'Group Transport Ghana | Event Shuttle Service Accra | Uprise',
                'meta_description' => 'Professional group and event transportation in Ghana. Minivans, coaches, coordinated fleets for conferences, weddings and corporate events. Get a quote.',
            ],
            [
                'name' => 'Wedding Car Service',
                'slug' => 'wedding-car',
                'icon' => 'heart',
                'sort_order' => 6,
                'short_description' => 'Luxury bridal cars and coordinated guest shuttles for your perfect day.',
                'description' => '<p>Your wedding day deserves perfection at every turn. Uprise provides beautifully presented luxury vehicles for bridal parties, a dedicated coordinator to manage your transport schedule, and a support team on-site throughout the event. We handle the logistics so you can focus entirely on your most important day.</p><p>Choose from our fleet of premium sedans, luxury SUVs and Sprinters. We also coordinate guest shuttle services between venues for larger celebrations.</p>',
                'meta_title' => 'Wedding Car Hire Ghana | Bridal Transportation Accra | Uprise',
                'meta_description' => 'Luxury wedding car hire in Ghana. Bridal cars, guest shuttles, on-site coordination. Beautiful fleet for your perfect wedding day in Accra and beyond.',
            ],
            [
                'name' => 'Cross-Border Travel',
                'slug' => 'cross-border-travel',
                'icon' => 'globe-alt',
                'sort_order' => 7,
                'short_description' => 'Accra to Lagos, Lomé, Abidjan and beyond — experienced drivers, immaculate vehicles, border-crossing expertise.',
                'description' => '<p>West Africa\'s most important business corridors connect Accra to Lagos, Lomé, Cotonou, Abidjan and Ouagadougou. Uprise operates premium cross-border transport on these routes with drivers who know the border procedures, road conditions and optimal routes by heart.</p><p>All vehicles are fully insured for cross-border travel, properly documented for ECOWAS transit, and stocked for long-haul comfort. We also handle Togo, Benin, and Ivory Coast routes for diplomatic and corporate clients.</p>',
                'meta_title' => 'Cross-Border Transport West Africa | Accra to Lagos, Lomé | Uprise',
                'meta_description' => 'Premium cross-border ground transportation from Ghana to Nigeria, Togo, Benin and Ivory Coast. Experienced drivers, fully insured. Book your cross-border transfer.',
            ],
        ];

        foreach ($services as $data) {
            Service::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
