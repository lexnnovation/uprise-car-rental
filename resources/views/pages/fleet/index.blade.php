@extends('layouts.app')

@php
    $title = 'Our Fleet — Car & Driver Hire in Ghana | Uprise Travel';
    $metaDescription =
        'Browse our fleet of vehicles available for hire with a professional driver across Ghana — Accra, Cape Coast, Kumasi, Mole, Tamale and more. Sedans, SUVs, minivans, and safari 4x4s.';
@endphp

@section('content')

    {{-- ============================================================
     PAGE HEADER
     ============================================================ --}}
    <section class="bg-ink-deep border-b border-charcoal-soft">
        <div class="container-page py-14 lg:py-20">
            <nav class="flex items-center gap-2 text-xs text-stone mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span aria-hidden="true">/</span>
                <span class="text-stone-soft">Fleet</span>
            </nav>
            <p class="eyebrow text-accent mb-3">Driver-Included Hire</p>
            <h1
                class="font-display font-bold text-white tracking-tight mb-4
                        text-[2rem] sm:text-[2.75rem] lg:text-[3.25rem]">
                Our Fleet
            </h1>
            <p class="text-stone-soft text-base max-w-xl leading-relaxed">
                Every vehicle comes with a vetted, professional driver.
                Choose by size or category — we'll match you to the right vehicle for your journey.
            </p>
        </div>
    </section>

    {{-- ============================================================
     CATEGORY FILTER BAR
     ============================================================ --}}
    @if ($categories->count() > 0)
        <div class="sticky top-16 lg:top-20 z-40 bg-charcoal border-b border-charcoal-soft">
            <div class="container-page">
                <div class="flex items-center gap-1.5 overflow-x-auto py-3 scrollbar-none">
                    <a href="{{ route('fleet.index') }}"
                        class="shrink-0 px-4 py-1.5 rounded-full text-xs font-semibold tracking-wide transition-colors duration-150
                               {{ !$activeCategory ? 'bg-accent text-white' : 'text-stone-soft hover:text-white hover:bg-charcoal-soft' }}">
                        All Vehicles
                    </a>
                    @foreach ($categories as $cat)
                        <a href="{{ route('fleet.index', ['category' => $cat->slug]) }}"
                            class="shrink-0 px-4 py-1.5 rounded-full text-xs font-semibold tracking-wide transition-colors duration-150
                                   {{ $activeCategory === $cat->slug ? 'bg-accent text-white' : 'text-stone-soft hover:text-white hover:bg-charcoal-soft' }}">
                            {{ $cat->name }}
                            <span class="opacity-60 ml-0.5">({{ $cat->vehicles_count }})</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- ============================================================
     VEHICLE GRID
     ============================================================ --}}
    <section class="bg-bone py-14 lg:py-20 min-h-[50vh]">
        <div class="container-page">

            @if ($vehicles->isEmpty())
                {{-- Empty state --}}
                <div class="text-center py-24">
                    <svg class="w-14 h-14 text-mist mx-auto mb-5" fill="none" stroke="currentColor" stroke-width="1.5"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                    </svg>
                    <p class="font-display font-semibold text-ink text-lg mb-2">No vehicles found</p>
                    <p class="text-stone text-sm mb-6">
                        {{ $activeCategory ? 'No vehicles in this category yet.' : 'The fleet is being updated. Check back soon.' }}
                    </p>
                    @if ($activeCategory)
                        <a href="{{ route('fleet.index') }}"
                            class="inline-flex items-center gap-1.5 text-sm font-semibold text-accent hover:text-accent-soft transition-colors">
                            &larr; View all vehicles
                        </a>
                    @endif
                </div>
            @else
                <p class="text-stone text-sm mb-8">
                    {{ $vehicles->count() }} {{ Str::plural('vehicle', $vehicles->count()) }}
                    {{ $activeCategory ? 'in this category' : 'available' }}
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($vehicles as $vehicle)
                        <article
                            class="group bg-white rounded-md overflow-hidden shadow-card hover:shadow-card-hover
                                        hover:ring-1 hover:ring-accent/20 transition-all duration-300 flex flex-col">

                            {{-- Image --}}
                            <a href="{{ route('fleet.show', $vehicle) }}"
                                class="block overflow-hidden aspect-video bg-charcoal shrink-0">
                                @if ($vehicle->hasMedia('hero'))
                                    <img src="{{ $vehicle->getFirstMediaUrl('hero', 'card') }}" alt="{{ $vehicle->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        loading="lazy">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-linear-to-br from-charcoal to-ink">
                                        <svg class="w-16 h-16 text-charcoal-soft/50" fill="none" stroke="currentColor"
                                            stroke-width="1" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                        </svg>
                                    </div>
                                @endif
                            </a>

                            {{-- Body --}}
                            <div class="p-5 flex flex-col flex-1">
                                <p class="eyebrow text-accent mb-2">{{ $vehicle->category->name }}</p>
                                <h2
                                    class="font-display font-bold text-ink text-lg leading-snug mb-3
                                            group-hover:text-accent transition-colors duration-200">
                                    <a href="{{ route('fleet.show', $vehicle) }}">{{ $vehicle->name }}</a>
                                </h2>

                                @if ($vehicle->short_description)
                                    <p class="text-stone text-sm leading-relaxed mb-4 flex-1 line-clamp-2">
                                        {{ $vehicle->short_description }}
                                    </p>
                                @else
                                    <div class="flex-1"></div>
                                @endif

                                {{-- Specs bar --}}
                                <div class="flex items-center gap-5 text-xs text-stone mb-5 border-t border-mist-soft pt-4">
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                                            stroke-width="1.75" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                        </svg>
                                        {{ $vehicle->passenger_count }} passengers
                                    </span>
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                                            stroke-width="1.75" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                        </svg>
                                        {{ $vehicle->luggage_count }} bags
                                    </span>
                                </div>

                                {{-- CTAs --}}
                                <div class="flex items-center gap-3">
                                    @php
                                        $enquireUrl =
                                            'https://wa.me/' .
                                            config('uprise.whatsapp.number') .
                                            '?text=' .
                                            urlencode(
                                                'Hi Uprise Travel, I\'d like to enquire about the ' .
                                                    $vehicle->name .
                                                    '.',
                                            );
                                    @endphp
                                    <a href="{{ $enquireUrl }}" target="_blank" rel="noopener"
                                        class="flex-1 inline-flex items-center justify-center gap-2 bg-accent text-white text-xs font-semibold
                                               px-4 py-2.5 rounded-sm hover:bg-accent-soft transition-colors duration-150 tracking-wide">
                                        <svg class="w-3.5 h-3.5 shrink-0" viewBox="0 0 24 24" fill="currentColor"
                                            aria-hidden="true">
                                            <path
                                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                        </svg>
                                        Enquire
                                    </a>
                                    <a href="{{ route('fleet.show', $vehicle) }}"
                                        class="inline-flex items-center gap-1 text-xs font-semibold text-stone hover:text-ink transition-colors tracking-wide">
                                        Details &rarr;
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif

        </div>
    </section>

    {{-- ============================================================
     DRIVER NOTICE BAND
     ============================================================ --}}
    <section class="bg-accent py-10">
        <div class="container-page flex flex-col sm:flex-row items-center justify-between gap-6 text-center sm:text-left">
            <div>
                <p class="font-display font-bold text-white text-lg mb-1">All rentals include a professional driver.</p>
                <p class="text-white/80 text-sm">We do not offer self-drive options — every booking comes with a vetted
                    driver.</p>
            </div>
            <a href="{{ 'https://wa.me/' . config('uprise.whatsapp.number') . '?text=' . urlencode(config('uprise.whatsapp.default_message')) }}"
                target="_blank" rel="noopener"
                class="shrink-0 inline-flex items-center gap-2 bg-white text-accent font-semibold text-sm px-6 py-3 rounded-sm
                      hover:bg-bone transition-colors duration-150 tracking-wide">
                Book via WhatsApp
            </a>
        </div>
    </section>

@endsection
