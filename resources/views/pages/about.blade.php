@extends('layouts.app')

@php
    $title = 'About Uprise Travel | Car & Driver Hire in Ghana';
    $metaDescription =
        'Uprise Travel is Ghana\'s premier chauffeur and car rental service. Based in Accra, we cover all major destinations including Cape Coast, Kumasi, Mole, Tamale, Bolgatanga and Wa — plus cross-border hire to Togo and Benin.';
@endphp

@section('content')

    {{-- PAGE HEADER --}}
    <section class="bg-ink-deep border-b border-charcoal-soft">
        <div class="container-page py-14 lg:py-20">
            <nav class="flex items-center gap-2 text-xs text-stone mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span>/</span>
                <span class="text-stone-soft">About</span>
            </nav>
            <p class="eyebrow text-accent mb-3" data-reveal>About Uprise Travel</p>
            <h1 data-reveal data-reveal-delay="80"
                class="font-display font-bold text-white tracking-tight mb-4
                        text-[2rem] sm:text-[2.75rem] lg:text-[3.25rem] max-w-2xl">
                Ghana's premier chauffeur &amp; car rental service.
            </h1>
            <p data-reveal data-reveal-delay="160" class="text-stone-soft text-base max-w-xl leading-relaxed">
                Based in Accra — covering Accra, Cape Coast, Kumasi, Mole, Tamale, Bolgatanga, Wa and cross-border to Togo
                &amp; Benin with professional drivers who know every road.
            </p>
        </div>
    </section>

    {{-- MISSION --}}
    <section class="bg-bone py-14 lg:py-20">
        <div class="container-page">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <div data-reveal="fade-left">
                    <p class="eyebrow text-accent mb-3">Who We Are</p>
                    <h2 class="font-display font-bold text-ink text-display-sm tracking-tight mb-6">
                        Reliable transport, every time.
                    </h2>
                    <div class="space-y-4 text-stone text-sm leading-relaxed">
                        <p>
                            Uprise Travel was built to solve a real problem — the difficulty of finding
                            safe, reliable, and professional ground transportation in Ghana.
                            Whether you're landing at Kotoka International Airport, planning a safari
                            through Mole National Park, or need an executive car for a multi-day
                            corporate itinerary, we deliver without compromise.
                        </p>
                        <p>
                            Every vehicle in our fleet comes with a vetted, professional driver.
                            We do not offer self-drive rentals. That's not a limitation — it's our standard.
                            Our clients travel with confidence because someone who knows the roads, the
                            checkpoints, and the local context is always behind the wheel.
                        </p>
                        <p>
                            We serve diaspora visitors, corporate travellers, NGO and development sector
                            professionals, tour groups, and anyone who wants to explore Ghana
                            without the stress of navigating it alone.
                        </p>
                    </div>
                </div>

                {{-- Stat cards --}}
                <div class="grid grid-cols-2 gap-4" data-stagger data-stagger-delay="80">
                    @foreach ([['num' => '7', 'label' => 'Destinations in Ghana', 'sub' => 'Accra · Cape Coast · Kumasi · Mole · Tamale · Bolgatanga · Wa'], ['num' => '100%', 'label' => 'Driver-included bookings', 'sub' => 'No self-drive — ever'], ['num' => '24 / 7', 'label' => 'WhatsApp availability', 'sub' => 'Reach us any time'], ['num' => '10+', 'label' => 'Years in Ghana travel', 'sub' => 'Experience you can rely on']] as $stat)
                        <div class="bg-white rounded-md p-5 shadow-card">
                            <p class="font-display font-bold text-accent text-3xl leading-none mb-2">{{ $stat['num'] }}</p>
                            <p class="font-semibold text-ink text-sm mb-1">{{ $stat['label'] }}</p>
                            <p class="text-stone text-xs leading-snug">{{ $stat['sub'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- COVERAGE --}}
    <section class="bg-ink border-y border-charcoal-soft py-14 lg:py-20">
        <div class="container-page">
            <div class="text-center mb-12" data-reveal>
                <p class="eyebrow text-accent mb-3">Coverage</p>
                <h2 class="font-display font-bold text-white text-display-sm tracking-tight">
                    Where we operate.
                </h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 max-w-4xl mx-auto" data-stagger
                data-stagger-delay="70">
                @foreach ([['country' => 'Accra', 'cities' => 'Kotoka Airport · Osu · Airport Hills · East Legon'], ['country' => 'Cape Coast', 'cities' => 'Cape Coast Castle · Kakum · Elmina'], ['country' => 'Kumasi', 'cities' => 'Kumasi Central · Manhyia · Kejetia'], ['country' => 'Mole', 'cities' => 'Mole National Park · Larabanga'], ['country' => 'Tamale · Bolgatanga · Wa', 'cities' => 'Northern Region destinations'], ['country' => 'Cross-Border', 'cities' => 'Togo (Lomé) · Benin (Cotonou) — on request']] as $loc)
                    <div class="bg-charcoal rounded-md p-5 border border-charcoal-soft">
                        <p class="font-display font-semibold text-white text-base mb-2">{{ $loc['country'] }}</p>
                        <p class="text-stone-soft text-xs leading-relaxed">{{ $loc['cities'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- WHY UPRISE --}}
    <section class="bg-bone py-14 lg:py-20">
        <div class="container-page">
            <div class="text-center mb-12" data-reveal>
                <p class="eyebrow text-accent mb-3">Our Standards</p>
                <h2 class="font-display font-bold text-ink text-display-sm tracking-tight">
                    The Uprise difference.
                </h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10" data-stagger data-stagger-delay="80">
                @foreach ([
            ['num' => '01', 'title' => 'Vetted Professional Drivers', 'body' => 'Every driver is thoroughly background-checked, trained in hospitality, and knows the roads across Ghana.'],
            ['num' => '02', 'title' => 'Flight Monitoring', 'body' => 'We track every incoming flight in real time. Your driver adjusts for delays automatically — no waiting, no surprises.'],
            ['num' => '03', 'title' => 'WhatsApp Booking', 'body' => 'Send us a message and get a confirmation within hours. No complicated forms, no waiting on hold.'],
            ['num' => '04', 'title' => 'Flexible Itineraries', 'body' => 'Half-day, full-day, multi-day or one-way transfers — we adapt to your schedule, not the other way around.'],
            ['num' => '05', 'title' => 'Cross-Border Available', 'body' => 'Need to travel from Ghana into Togo or Benin? Our drivers handle border crossings, documentation, and local logistics.'],
            ['num' => '06', 'title' => 'Transparent Pricing', 'body' => 'Quotes are clear, all-inclusive, and confirmed before your trip. No surprise charges at the end of the journey.'],
        ] as $item)
                    <div class="relative">
                        <span class="block font-display font-black leading-none text-ink/5 select-none mb-3 -ml-1"
                            style="font-size:5rem;">{{ $item['num'] }}</span>
                        <div class="w-6 h-0.5 bg-accent mb-4"></div>
                        <h3 class="font-display font-semibold text-ink text-base mb-2">{{ $item['title'] }}</h3>
                        <p class="text-stone text-sm leading-relaxed">{{ $item['body'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- TESTIMONIALS --}}
    @if ($testimonials->isNotEmpty())
        <section class="bg-ink border-t border-charcoal-soft py-14 lg:py-20">
            <div class="container-page">
                <p class="eyebrow text-accent mb-3 text-center">What Clients Say</p>
                <h2 class="font-display font-bold text-white text-display-sm tracking-tight text-center mb-12">
                    Trusted by travellers.
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" data-stagger data-stagger-delay="90">
                    @foreach ($testimonials as $t)
                        <blockquote class="bg-charcoal rounded-md p-6 flex flex-col">
                            <div class="flex gap-0.5 mb-4">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 {{ $i < ($t->rating ?? 5) ? 'text-accent' : 'text-charcoal-soft' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <p class="text-stone-soft text-sm leading-relaxed flex-1 mb-5 italic">
                                "{{ $t->body }}"
                            </p>
                            <footer class="mt-auto">
                                <p class="font-semibold text-white text-sm">{{ $t->author_name }}</p>
                                @if ($t->author_title || $t->author_location)
                                    <p class="text-stone text-xs mt-0.5">
                                        {{ collect([$t->author_title, $t->author_location])->filter()->implode(' · ') }}
                                    </p>
                                @endif
                            </footer>
                        </blockquote>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- FLEET SHOWCASE --}}
    <x-vehicle.showcase eyebrow="Our Fleet" title="Cars ready for your next trip"
        subtitle="From saloon cars to 4×4s, vans and coaches — every vehicle comes with a vetted, professional driver." />

    {{-- PART OF UPRISE TRAVEL & TOURS --}}
    <section class="bg-white py-14 lg:py-20 border-t border-mist">
        <div class="container-page max-w-3xl" data-reveal>
            <p class="eyebrow text-accent mb-3">One brand, full service</p>
            <h2 class="font-display font-bold text-ink text-display-sm tracking-tight mb-4">
                Part of Uprise Travel &amp; Tours
            </h2>
            <p class="text-stone text-base leading-relaxed">
                This site is the dedicated car-rental arm of
                <a href="{{ config('uprise.brand.parent_url') }}" target="_blank" rel="noopener"
                    class="text-accent font-medium underline underline-offset-2 hover:text-accent-deep transition-colors">{{ config('uprise.brand.parent_name') }}</a>,
                our established travel brand offering chauffeur and car rental services, guided tours and full-service travel across
                Ghana and West Africa. Book a car and driver here, or explore the wider range of services on the main
                Uprise Travel &amp; Tours site.
            </p>
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-accent py-14">
        <div class="container-page flex flex-col sm:flex-row items-center justify-between gap-6 text-center sm:text-left">
            <div data-reveal="fade-left">
                <p class="font-display font-bold text-white text-xl mb-1">Ready to book your journey?</p>
                <p class="text-white/80 text-sm">Tell us your travel dates and we'll handle everything.</p>
            </div>
            <div class="flex flex-col sm:flex-row items-center gap-3 shrink-0">
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center gap-2 border border-white text-white font-semibold text-sm
                          px-6 py-3 rounded-sm hover:bg-white hover:text-accent transition-colors tracking-wide">
                    Send an Enquiry
                </a>
                <a href="{{ 'https://wa.me/' . config('uprise.whatsapp.number') . '?text=' . urlencode(config('uprise.whatsapp.default_message')) }}"
                    target="_blank" rel="noopener"
                    class="inline-flex items-center gap-2 border border-white/40 text-white font-semibold text-sm
                          px-6 py-3 rounded-sm hover:bg-white/10 transition-colors tracking-wide">
                    WhatsApp Us
                </a>
            </div>
        </div>
    </section>

@endsection
