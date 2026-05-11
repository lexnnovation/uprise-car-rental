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
            <p class="eyebrow text-accent mb-3">About Uprise Travel</p>
            <h1
                class="font-display font-bold text-white tracking-tight mb-4
                        text-[2rem] sm:text-[2.75rem] lg:text-[3.25rem] max-w-2xl">
                Ghana's premier chauffeur &amp; car rental service.
            </h1>
            <p class="text-stone-soft text-base max-w-xl leading-relaxed">
                Based in Accra — covering Accra, Cape Coast, Kumasi, Mole, Tamale, Bolgatanga, Wa and cross-border to Togo
                &amp; Benin with professional drivers who know every road.
            </p>
        </div>
    </section>

    {{-- MISSION --}}
    <section class="bg-bone py-14 lg:py-20">
        <div class="container-page">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <div>
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
                <div class="grid grid-cols-2 gap-4">
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
            <div class="text-center mb-12">
                <p class="eyebrow text-accent mb-3">Coverage</p>
                <h2 class="font-display font-bold text-white text-display-sm tracking-tight">
                    Where we operate.
                </h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 max-w-4xl mx-auto">
                @foreach ([['country' => 'Accra', 'cities' => 'Kotoka Airport · Osu · Airport Hills · East Legon'], ['country' => 'Cape Coast', 'cities' => 'Cape Coast Castle · Kakum · Elmina'], ['country' => 'Kumasi', 'cities' => 'Kumasi Central · Manhyia · Kejetia'], ['country' => 'Mole', 'cities' => 'Mole National Park · Larabanga'], ['country' => 'Tamale · Bolgatanga · Wa', 'cities' => 'Northern Region destinations'], ['country' => 'Cross-Border', 'cities' => 'Togo (Lomé) · Benin (Cotonou) — on request']] as $loc)
                    <div class="bg-ink rounded-md p-5">
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
            <div class="text-center mb-12">
                <p class="eyebrow text-accent mb-3">Our Standards</p>
                <h2 class="font-display font-bold text-ink text-display-sm tracking-tight">
                    The Uprise difference.
                </h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">
                @foreach ([
            ['icon' => 'M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z', 'title' => 'Vetted Professional Drivers', 'body' => 'Every driver is thoroughly background-checked, trained in hospitality, and knows the roads across West Africa.'],
            ['icon' => 'M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5', 'title' => 'Flight Monitoring', 'body' => 'We track every incoming flight in real time. Your driver adjusts for delays automatically — no waiting, no surprises.'],
            ['icon' => 'M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z', 'title' => 'WhatsApp Booking', 'body' => 'Send us a message and get a confirmation within hours. No complicated forms, no waiting on hold.'],
            ['icon' => 'M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z', 'title' => 'Flexible Itineraries', 'body' => 'Half-day, full-day, multi-day or one-way transfers — we adapt to your schedule, not the other way around.'],
            ['icon' => 'M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418', 'title' => 'Cross-Border Available', 'body' => 'Need to travel from Ghana into Togo or Benin? Our drivers handle border crossings, documentation, and local logistics.'],
            ['icon' => 'M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z', 'title' => 'Transparent Pricing', 'body' => 'Quotes are clear, all-inclusive, and confirmed before your trip. No surprise charges at the end of the journey.'],
        ] as $item)
                    <div class="bg-white rounded-md p-6 shadow-card">
                        <div class="w-10 h-10 rounded-full bg-ink flex items-center justify-center mb-4 shrink-0">
                            <svg class="w-4.5 h-4.5 text-accent" fill="none" stroke="currentColor" stroke-width="1.75"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}" />
                            </svg>
                        </div>
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
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
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

    {{-- CTA --}}
    <section class="bg-accent py-14">
        <div class="container-page flex flex-col sm:flex-row items-center justify-between gap-6 text-center sm:text-left">
            <div>
                <p class="font-display font-bold text-white text-xl mb-1">Ready to book your journey?</p>
                <p class="text-white/80 text-sm">Tell us your travel dates and we'll handle everything.</p>
            </div>
            <div class="flex flex-col sm:flex-row items-center gap-3 shrink-0">
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center gap-2 bg-white text-accent font-semibold text-sm
                          px-6 py-3 rounded-sm hover:bg-bone transition-colors tracking-wide">
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
