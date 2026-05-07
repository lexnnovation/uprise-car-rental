<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Vehicle;
use App\Models\VehicleCategory;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        // Pull categories and features keyed by slug for clean lookups
        $cats = VehicleCategory::pluck('id', 'slug');
        $feats = Feature::pluck('id', 'slug');

        $vehicles = [
            [
                'slug' => 'mercedes-benz-s-class',
                'category' => 'luxury-sedan',
                'name' => 'Mercedes-Benz S-Class',
                'short_description' => 'The pinnacle of executive travel. Long-wheelbase rear cabin with massage seats, ambient lighting and total privacy.',
                'description' => '<p>The Mercedes-Benz S-Class is the definitive chauffeur\'s limousine — chosen by heads of state, CEOs and discerning travellers worldwide. The long-wheelbase variant provides unmatched rear-passenger comfort with individual reclining seats, a panoramic sunroof, and optional rear-seat entertainment.</p><p>Available for airport transfers, executive hire by the hour, VIP event arrivals and diplomatic transport across Greater Accra.</p>',
                'passenger_count' => 3,
                'luggage_count' => 2,
                'is_featured' => true,
                'sort_order' => 1,
                'meta_title' => 'Mercedes-Benz S-Class Chauffeur | Luxury Airport Transfer Accra',
                'meta_description' => 'Travel in a chauffeur-driven Mercedes-Benz S-Class in Accra, Ghana. Executive airport transfers, hourly hire and VIP transport. Book now.',
                'published_at' => now(),
                'features' => ['air-conditioning', 'wifi', 'leather-seats', 'complimentary-water', 'phone-charger', 'privacy-partition', 'professional-driver', 'flight-monitoring', '24-7-availability', 'meet-and-greet', 'luggage-assistance'],
            ],
            [
                'slug' => 'mercedes-benz-e-class',
                'category' => 'luxury-sedan',
                'name' => 'Mercedes-Benz E-Class',
                'short_description' => 'Executive elegance for business transfers and airport pickups. MBUX infotainment and premium leather throughout.',
                'description' => '<p>The Mercedes-Benz E-Class strikes the perfect balance between executive presence and everyday practicality. With a spacious rear cabin, Burmester sound system and MBUX connectivity, your journey is productive and comfortable from door to door.</p><p>A favourite for corporate transfers, inter-city business travel and premium airport pickups across Accra and Greater Accra.</p>',
                'passenger_count' => 3,
                'luggage_count' => 2,
                'is_featured' => true,
                'sort_order' => 2,
                'meta_title' => 'Mercedes-Benz E-Class Chauffeur Accra | Corporate Transfer Ghana',
                'meta_description' => 'Chauffeur-driven Mercedes-Benz E-Class in Accra. Corporate transfers, airport pickup, hourly executive hire across Ghana. Professional driver.',
                'published_at' => now(),
                'features' => ['air-conditioning', 'wifi', 'leather-seats', 'complimentary-water', 'phone-charger', 'professional-driver', 'flight-monitoring', '24-7-availability', 'meet-and-greet'],
            ],
            [
                'slug' => 'bmw-5-series',
                'category' => 'luxury-sedan',
                'name' => 'BMW 5 Series',
                'short_description' => 'Dynamic executive sedan with a sporting character and a cabin designed for rear-seat productivity.',
                'description' => '<p>The BMW 5 Series brings a more dynamic character to executive transportation without compromising on rear-seat refinement. Panoramic glass roof, heated leather seats and BMW\'s iDrive connectivity system make longer journeys feel effortless.</p><p>Ideal for executives who prefer a sportier feel without sacrificing the professionalism of a chauffeur-driven transfer.</p>',
                'passenger_count' => 3,
                'luggage_count' => 2,
                'is_featured' => false,
                'sort_order' => 3,
                'meta_title' => 'BMW 5 Series Chauffeur Ghana | Executive Car Hire Accra',
                'meta_description' => 'Chauffeur-driven BMW 5 Series in Accra, Ghana. Airport transfers, corporate hire, executive travel. Professional driver, always on time.',
                'published_at' => now(),
                'features' => ['air-conditioning', 'wifi', 'leather-seats', 'complimentary-water', 'phone-charger', 'professional-driver', '24-7-availability'],
            ],
            [
                'slug' => 'range-rover-sport',
                'category' => 'luxury-suv',
                'name' => 'Range Rover Sport',
                'short_description' => 'Commanding presence, luxury interior and serious capability. The choice for VIPs who demand versatility.',
                'description' => '<p>Few vehicles command as much respect on Accra\'s roads as the Range Rover Sport. Elevated ride height, premium leather interior, Meridian audio and a powerful V8 presence make this the preferred choice for executives, government officials and VIP clients.</p><p>Equally at home on smooth Cantonments boulevards or the rougher roads to upcountry destinations. Available with privacy glass and a dedicated chauffeur.</p>',
                'passenger_count' => 4,
                'luggage_count' => 3,
                'is_featured' => true,
                'sort_order' => 4,
                'meta_title' => 'Range Rover Sport Chauffeur Ghana | Luxury SUV Hire Accra',
                'meta_description' => 'Chauffeur-driven Range Rover Sport in Ghana. VIP executive transport, airport transfer and upcountry travel. Book your luxury SUV today.',
                'published_at' => now(),
                'features' => ['air-conditioning', 'wifi', 'leather-seats', 'complimentary-water', 'phone-charger', 'professional-driver', '24-7-availability', 'meet-and-greet', 'luggage-assistance'],
            ],
            [
                'slug' => 'lexus-lx',
                'category' => 'luxury-suv',
                'name' => 'Lexus LX',
                'short_description' => 'Ultra-luxury 7-seater SUV. Japanese craftsmanship meets African road reliability.',
                'description' => '<p>The Lexus LX represents the pinnacle of Japanese luxury SUV engineering. With seating for up to 7 passengers across three rows, individual climate zones, a Mark Levinson audio system and the legendary Toyota Land Cruiser platform beneath, it is equally suited to Accra city transfers and the roads to Northern Ghana.</p>',
                'passenger_count' => 7,
                'luggage_count' => 4,
                'is_featured' => false,
                'sort_order' => 5,
                'meta_title' => 'Lexus LX Chauffeur Ghana | 7-Seat Luxury SUV Hire',
                'meta_description' => 'Chauffeur-driven Lexus LX in Ghana. 7-seater luxury SUV for family groups, executives and VIP transport. Available 24/7.',
                'published_at' => now(),
                'features' => ['air-conditioning', 'wifi', 'leather-seats', 'complimentary-water', 'phone-charger', 'professional-driver', '24-7-availability'],
            ],
            [
                'slug' => 'mercedes-benz-v-class',
                'category' => 'minivan-sprinter',
                'name' => 'Mercedes-Benz V-Class',
                'short_description' => 'Luxury MPV for groups of up to 7. Facing seats, panoramic roof and business-class cabin refinement.',
                'description' => '<p>The Mercedes-Benz V-Class redefines what a people carrier can be. Configured with four individual captain\'s chairs in a face-to-face business-jet arrangement, a panoramic roof and the full Mercedes multimedia suite, this is the go-to vehicle for small delegations, family groups and airport transfers when everyone wants to travel together without sacrificing comfort.</p>',
                'passenger_count' => 7,
                'luggage_count' => 6,
                'is_featured' => true,
                'sort_order' => 6,
                'meta_title' => 'Mercedes V-Class Hire Ghana | Luxury Minivan Accra',
                'meta_description' => 'Chauffeur-driven Mercedes-Benz V-Class in Ghana. 7-seat luxury people carrier for groups, airport transfers and corporate travel.',
                'published_at' => now(),
                'features' => ['air-conditioning', 'wifi', 'leather-seats', 'complimentary-water', 'phone-charger', 'professional-driver', '24-7-availability', 'luggage-assistance'],
            ],
            [
                'slug' => 'toyota-land-cruiser',
                'category' => '4x4-safari',
                'name' => 'Toyota Land Cruiser 200',
                'short_description' => 'The gold standard of African overland travel. Built for any terrain Ghana has to offer.',
                'description' => '<p>No vehicle has earned its reputation on African roads more thoroughly than the Toyota Land Cruiser. Our 200-series Land Cruisers are maintained to the highest standard and configured for long-distance comfort: cold-air AC, USB charging, and ample luggage capacity. Whether you\'re heading to Mole National Park, the Upper East Region or across the border into Burkina Faso, this is the vehicle that will get you there and back.</p>',
                'passenger_count' => 7,
                'luggage_count' => 5,
                'is_featured' => true,
                'sort_order' => 7,
                'meta_title' => 'Toyota Land Cruiser Hire Ghana | Safari 4x4 Transport',
                'meta_description' => 'Toyota Land Cruiser hire in Ghana for safaris, upcountry travel and cross-border trips. Experienced driver-guides. Mole National Park specialists.',
                'published_at' => now(),
                'features' => ['air-conditioning', 'complimentary-water', 'phone-charger', 'professional-driver', '24-7-availability'],
            ],
            [
                'slug' => 'toyota-fortuner',
                'category' => 'suv',
                'name' => 'Toyota Fortuner',
                'short_description' => 'Reliable, spacious and capable. A popular choice for business and family travel across Ghana.',
                'description' => '<p>The Toyota Fortuner delivers the dependability and road presence that Ghana\'s varied terrain demands. With seating for 6, a powerful diesel engine and proven reliability on routes from Accra to the Northern regions, it is a smart choice for families, small groups and corporate transfers where city SUV refinement meets real-world capability.</p>',
                'passenger_count' => 6,
                'luggage_count' => 4,
                'is_featured' => false,
                'sort_order' => 8,
                'meta_title' => 'Toyota Fortuner Hire Ghana | SUV Transport Accra',
                'meta_description' => 'Toyota Fortuner hire with professional driver in Ghana. 6-seat SUV for family groups, upcountry travel and corporate transfers.',
                'published_at' => now(),
                'features' => ['air-conditioning', 'complimentary-water', 'professional-driver', '24-7-availability'],
            ],
            [
                'slug' => 'toyota-hiace-minibus',
                'category' => 'minivan-sprinter',
                'name' => 'Toyota HiAce Minibus',
                'short_description' => '12-seat minibus — the workhorse of group transfers. Reliable, comfortable and always on time.',
                'description' => '<p>When your group exceeds 7 but a full coach feels excessive, the Toyota HiAce is the ideal solution. Seating 12 comfortably with luggage space, full air conditioning and a driver trained for group logistics, it handles airport shuttles, conference transfers and event pick-ups with efficiency and reliability.</p>',
                'passenger_count' => 12,
                'luggage_count' => 8,
                'is_featured' => false,
                'sort_order' => 9,
                'meta_title' => 'Minibus Hire Ghana | Toyota HiAce Group Transfer Accra',
                'meta_description' => '12-seat Toyota HiAce minibus hire in Ghana. Airport shuttles, conference transfers and group transport. Professional driver, competitive rates.',
                'published_at' => now(),
                'features' => ['air-conditioning', 'complimentary-water', 'professional-driver', '24-7-availability', 'luggage-assistance'],
            ],
            [
                'slug' => 'toyota-coaster-bus',
                'category' => 'coach-bus',
                'name' => 'Toyota Coaster Coach',
                'short_description' => '30-seat air-conditioned coach for large groups, conference shuttles and corporate fleet needs.',
                'description' => '<p>For conferences, corporate retreats, wedding guest shuttles and large tour groups, the Toyota Coaster provides comfortable seating for up to 30 passengers with full air conditioning, overhead luggage racks and a wide aisle. Paired with an experienced Uprise driver-coordinator, your group moves as one — on time and in comfort.</p>',
                'passenger_count' => 30,
                'luggage_count' => 20,
                'is_featured' => false,
                'sort_order' => 10,
                'meta_title' => 'Coach Hire Ghana | 30-Seat Bus for Groups & Events Accra',
                'meta_description' => '30-seat Toyota Coaster coach hire in Ghana. Conference shuttles, wedding guest transport and large group transfers. Book your bus today.',
                'published_at' => now(),
                'features' => ['air-conditioning', 'complimentary-water', 'professional-driver', '24-7-availability', 'luggage-assistance'],
            ],
        ];

        foreach ($vehicles as $data) {
            $featureSlugs = $data['features'];
            unset($data['features']);
            $categorySlugs = $data['category'];
            unset($data['category']);

            $data['vehicle_category_id'] = $cats[$categorySlugs];

            $vehicle = Vehicle::updateOrCreate(
                ['slug' => $data['slug']],
                $data,
            );

            // Sync features via pivot — idempotent
            $vehicle->features()->sync(
                $feats->only($featureSlugs)->values()->all()
            );
        }
    }
}
