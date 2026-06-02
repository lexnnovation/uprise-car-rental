@extends('layouts.app')

@php
    $title = 'Our Services — Car & Driver Hire in Ghana | Uprise Travel';
    $metaDescription =
        'Airport transfers, executive chauffeur, safari tours, Cape Coast day trips, and corporate travel across Ghana — Accra, Kumasi, Mole, Tamale and more. Cross-border hire to Togo & Benin available. All with a professional driver.';
@endphp

@section('content')

    {{-- ============================================================
     PAGE HEADER
     ============================================================ --}}
    <section class="bg-ink-deep border-b border-charcoal-soft">
        <div class="container-page py-14 lg:py-20">
            <nav class="flex items-center gap-2 text-xs text-stone mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span>/</span>
                <span class="text-stone-soft">Our Services</span>
            </nav>
            <p class="eyebrow text-accent mb-3" data-reveal>How We Serve You</p>
            <h1 data-reveal data-reveal-delay="80"
                class="font-display font-bold text-white tracking-tight mb-4
                        text-[2rem] sm:text-[2.75rem] lg:text-[3.25rem]">
                Every journey, perfected.
            </h1>
            <p data-reveal data-reveal-delay="160" class="text-stone-soft text-base max-w-xl leading-relaxed">
                From airport arrivals to multi-day safaris — every service includes a vetted, professional driver.
                No self-drive options. Just reliable, comfortable travel across Ghana and beyond.
            </p>
        </div>
    </section>

    {{-- ============================================================
     SERVICES GRID
     ============================================================ --}}
    <section class="bg-bone py-14 lg:py-20">
        <div class="container-page">

            @if ($services->isEmpty())
                <div class="text-center py-24">
                    <p class="font-display font-semibold text-ink text-lg mb-2">Services coming soon.</p>
                    <p class="text-stone text-sm">Check back shortly or reach us via WhatsApp.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6" data-stagger data-stagger-delay="150">
                    @foreach ($services as $i => $service)
                        <article
                            class="group relative bg-white rounded-md overflow-hidden shadow-card
                                        hover:shadow-card-hover hover:ring-1 hover:ring-accent/20
                                        transition-all duration-300 flex">

                            {{-- Accent side bar --}}
                            <div class="w-1 shrink-0 bg-mist group-hover:bg-accent transition-colors duration-300"></div>

                            {{-- Body --}}
                            <div class="flex flex-col p-6 flex-1">

                                {{-- Number + name --}}
                                <div class="flex items-start gap-4 mb-4">
                                    <span
                                        class="font-display font-bold text-3xl text-mist leading-none shrink-0
                                                 group-hover:text-accent transition-colors duration-300 mt-0.5">
                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                    <h2
                                        class="font-display font-bold text-ink text-xl leading-snug
                                                group-hover:text-accent transition-colors duration-200">
                                        <a href="{{ route('services.show', $service) }}" class="stretched-link">
                                            {{ $service->name }}
                                        </a>
                                    </h2>
                                </div>

                                {{-- Description --}}
                                <p class="text-stone text-sm leading-relaxed mb-6 flex-1">
                                    {{ $service->short_description }}
                                </p>

                                {{-- CTA row --}}
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('services.show', $service) }}"
                                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-accent
                                               hover:text-accent-soft transition-colors tracking-wide">
                                        Learn more
                                        <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform"
                                            fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                        </svg>
                                    </a>
                                    @php
                                        $url =
                                            'https://wa.me/' .
                                            config('uprise.whatsapp.number') .
                                            '?text=' .
                                            urlencode(
                                                'Hi Uprise Travel, I\'d like to enquire about your ' .
                                                    $service->name .
                                                    ' service.',
                                            );
                                    @endphp
                                    <a href="{{ $url }}" target="_blank" rel="noopener"
                                        class="text-xs font-semibold text-stone hover:text-ink transition-colors tracking-wide">
                                        Enquire via WhatsApp →
                                    </a>
                                </div>
                            </div>

                            {{-- Optional hero image (right, landscape) --}}
                            @php
                                $svcCardImg = $service->hasMedia('hero')
                                    ? $service->getFirstMediaUrl('hero', 'card')
                                    : $service->hero_image_url;
                            @endphp
                            @if ($svcCardImg)
                                <div class="hidden sm:block w-44 shrink-0 overflow-hidden">
                                    <img src="{{ $svcCardImg }}" alt="{{ $service->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        loading="lazy">
                                </div>
                            @endif

                        </article>
                    @endforeach
                </div>
            @endif

        </div>
    </section>

    {{-- ============================================================
     COVERAGE BAND
     ============================================================ --}}
    <section class="bg-ink border-t border-charcoal-soft py-14">
        <div class="container-page">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                <div data-reveal="fade-left">
                    <p class="eyebrow text-accent mb-3">Coverage</p>
                    <h2 class="font-display font-bold text-white text-display-sm tracking-tight mb-4">
                        Ghana-wide, with cross-border hire available.
                    </h2>
                    <p class="text-stone-soft text-sm leading-relaxed max-w-md">
                        Based in Accra, we cover Accra, Cape Coast, Kumasi, Mole, Tamale, Bolgatanga and Wa.
                        Cross-border hire to Togo and Benin is available on request.
                    </p>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3" data-stagger data-stagger-delay="60">
                    @foreach (['Accra', 'Cape Coast', 'Kumasi', 'Mole', 'Tamale', 'Bolgatanga', 'Wa', 'Togo (Cross-border)', 'Benin (Cross-border)'] as $country)
                        <div class="bg-charcoal rounded-sm px-4 py-3 text-center">
                            <p class="font-semibold text-white text-sm">{{ $country }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
     CTA BAND
     ============================================================ --}}
    <section class="bg-accent py-12">
        <div class="container-page flex flex-col sm:flex-row items-center justify-between gap-6 text-center sm:text-left">
            <div data-reveal="fade-left">
                <p class="font-display font-bold text-white text-lg mb-1">Not sure which service you need?</p>
                <p class="text-white/80 text-sm">Tell us your journey and we'll suggest the best option.</p>
            </div>
            <a href="{{ 'https://wa.me/' . config('uprise.whatsapp.number') . '?text=' . urlencode(config('uprise.whatsapp.default_message')) }}"
                target="_blank" rel="noopener"
                class="shrink-0 inline-flex items-center gap-2 border border-white text-white font-semibold text-sm
                      px-6 py-3 rounded-sm hover:bg-white hover:text-accent transition-colors duration-150 tracking-wide">
                Chat with us on WhatsApp
            </a>
        </div>
    </section>

@endsection
