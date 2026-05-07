@extends('layouts.app')

@php
    $title = ($vehicle->meta_title ?: $vehicle->name . ' | Uprise Travel Fleet');
    $metaDescription = $vehicle->meta_description ?: $vehicle->short_description;
@endphp

@section('content')

    {{-- ============================================================
     HERO IMAGE
     ============================================================ --}}
    <div class="relative bg-ink-deep overflow-hidden" style="min-height: 52vh;">
        @if ($vehicle->hasMedia('hero'))
            <img src="{{ $vehicle->getFirstMediaUrl('hero', 'hero') }}"
                 alt="{{ $vehicle->name }}"
                 class="absolute inset-0 w-full h-full object-cover object-center"
                 fetchpriority="high" loading="eager">
            <div class="absolute inset-0 bg-ink-deep/55"></div>
            <div class="absolute inset-0 bg-linear-to-t from-ink-deep via-ink-deep/20 to-transparent"></div>
        @else
            <div class="absolute inset-0 flex items-center justify-center bg-linear-to-br from-charcoal to-ink">
                <svg class="w-24 h-24 text-charcoal-soft/30" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                </svg>
            </div>
        @endif

        {{-- Breadcrumb over image --}}
        <div class="relative z-10 container-page pt-6">
            <nav class="flex items-center gap-2 text-xs text-white/60" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span>/</span>
                <a href="{{ route('fleet.index') }}" class="hover:text-white transition-colors">Fleet</a>
                @if ($vehicle->category)
                    <span>/</span>
                    <a href="{{ route('fleet.index', ['category' => $vehicle->category->slug]) }}"
                       class="hover:text-white transition-colors">{{ $vehicle->category->name }}</a>
                @endif
                <span>/</span>
                <span class="text-white/90">{{ $vehicle->name }}</span>
            </nav>
        </div>

        {{-- Vehicle name overlay --}}
        <div class="relative z-10 container-page pb-10 pt-6 flex items-end" style="min-height: 40vh;">
            <div>
                <p class="eyebrow text-accent mb-3">{{ $vehicle->category->name ?? 'Fleet' }}</p>
                <h1 class="font-display font-bold text-white tracking-tight
                            text-[2rem] sm:text-[2.75rem] lg:text-[3.5rem]">
                    {{ $vehicle->name }}
                </h1>
            </div>
        </div>
    </div>

    {{-- ============================================================
     MAIN CONTENT
     ============================================================ --}}
    <section class="bg-bone py-14 lg:py-20">
        <div class="container-page">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-16">

                {{-- LEFT: Details --}}
                <div class="lg:col-span-2 space-y-10">

                    {{-- Short description --}}
                    @if ($vehicle->short_description)
                        <p class="text-ink text-lg leading-relaxed font-medium">
                            {{ $vehicle->short_description }}
                        </p>
                    @endif

                    {{-- Specs --}}
                    <div>
                        <h2 class="font-display font-bold text-ink text-lg mb-5">Vehicle Specs</h2>
                        <dl class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            <div class="bg-white rounded-md p-4 shadow-card">
                                <dt class="eyebrow text-stone mb-2">Passengers</dt>
                                <dd class="font-display font-bold text-ink text-2xl">{{ $vehicle->passenger_count }}</dd>
                            </div>
                            <div class="bg-white rounded-md p-4 shadow-card">
                                <dt class="eyebrow text-stone mb-2">Luggage</dt>
                                <dd class="font-display font-bold text-ink text-2xl">{{ $vehicle->luggage_count }} bags</dd>
                            </div>
                            <div class="bg-white rounded-md p-4 shadow-card">
                                <dt class="eyebrow text-stone mb-2">Driver</dt>
                                <dd class="font-display font-bold text-accent text-base mt-1">Included</dd>
                            </div>
                        </dl>
                    </div>

                    {{-- Features --}}
                    @if ($vehicle->features->isNotEmpty())
                        <div>
                            <h2 class="font-display font-bold text-ink text-lg mb-5">Features & Amenities</h2>
                            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach ($vehicle->features as $feature)
                                    <li class="flex items-start gap-3 text-sm text-stone">
                                        <svg class="w-4 h-4 text-accent shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                        </svg>
                                        <span class="font-medium text-ink">{{ $feature->name }}</span>
                                        @if ($feature->description)
                                            <span class="text-stone"> — {{ $feature->description }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Full description --}}
                    @if ($vehicle->description)
                        <div>
                            <h2 class="font-display font-bold text-ink text-lg mb-5">About This Vehicle</h2>
                            <div class="prose prose-stone max-w-none text-sm leading-relaxed">
                                {!! $vehicle->description !!}
                            </div>
                        </div>
                    @endif

                    {{-- Gallery --}}
                    @if ($vehicle->hasMedia('gallery'))
                        <div>
                            <h2 class="font-display font-bold text-ink text-lg mb-5">Gallery</h2>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                @foreach ($vehicle->getMedia('gallery') as $image)
                                    <img src="{{ $image->getUrl('card') }}"
                                         alt="{{ $vehicle->name }}"
                                         class="w-full aspect-video object-cover rounded-md"
                                         loading="lazy">
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

                {{-- RIGHT: Enquiry sidebar --}}
                <div class="lg:col-span-1">
                    <div class="sticky top-28 space-y-4">

                        {{-- WhatsApp CTA card --}}
                        <div class="bg-ink rounded-md p-6 text-center">
                            <p class="eyebrow text-accent mb-3">Book This Vehicle</p>
                            <h3 class="font-display font-bold text-white text-lg mb-2">{{ $vehicle->name }}</h3>
                            <p class="text-stone-soft text-sm mb-6 leading-relaxed">
                                Send us a WhatsApp message and we'll confirm your booking within a few hours.
                            </p>
                            <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener"
                                class="w-full inline-flex items-center justify-center gap-2.5 bg-accent text-white font-semibold
                                       text-sm px-5 py-3.5 rounded-sm hover:bg-accent-soft transition-colors duration-200 tracking-wide">
                                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                                Book via WhatsApp
                            </a>
                            <div class="mt-4 pt-4 border-t border-charcoal-soft space-y-2 text-left">
                                <div class="flex items-center gap-2.5 text-xs text-stone-soft">
                                    <svg class="w-3.5 h-3.5 text-accent shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                    </svg>
                                    Professional driver included
                                </div>
                                <div class="flex items-center gap-2.5 text-xs text-stone-soft">
                                    <svg class="w-3.5 h-3.5 text-accent shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                    </svg>
                                    Ghana & West Africa coverage
                                </div>
                                <div class="flex items-center gap-2.5 text-xs text-stone-soft">
                                    <svg class="w-3.5 h-3.5 text-accent shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                    </svg>
                                    Flexible itineraries
                                </div>
                            </div>
                        </div>

                        {{-- Contact alternatives --}}
                        <div class="bg-white rounded-md p-5 shadow-card space-y-3 text-sm">
                            <p class="font-semibold text-ink text-xs eyebrow mb-3">Or contact us directly</p>
                            <a href="tel:{{ config('uprise.contact.phone_e164') }}"
                               class="flex items-center gap-2.5 text-stone hover:text-ink transition-colors">
                                <svg class="w-4 h-4 text-accent shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>
                                </svg>
                                {{ config('uprise.contact.phone') }}
                            </a>
                            <a href="mailto:{{ config('uprise.contact.email') }}"
                               class="flex items-center gap-2.5 text-stone hover:text-ink transition-colors">
                                <svg class="w-4 h-4 text-accent shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                                </svg>
                                {{ config('uprise.contact.email') }}
                            </a>
                        </div>

                        {{-- Back to fleet --}}
                        <a href="{{ route('fleet.index') }}"
                           class="flex items-center gap-1.5 text-sm text-stone hover:text-ink transition-colors font-medium">
                            &larr; Back to Fleet
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ============================================================
     RELATED VEHICLES
     ============================================================ --}}
    @if ($related->isNotEmpty())
        <section class="bg-ink py-14 lg:py-20 border-t border-charcoal-soft">
            <div class="container-page">
                <p class="eyebrow text-accent mb-3">More in {{ $vehicle->category->name ?? 'Our Fleet' }}</p>
                <h2 class="font-display font-bold text-white text-display-sm tracking-tight mb-10">
                    Similar vehicles
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($related as $rel)
                        <article class="group bg-charcoal rounded-md overflow-hidden hover:ring-1 hover:ring-accent/30 transition-all duration-300">
                            <a href="{{ route('fleet.show', $rel) }}" class="block overflow-hidden aspect-video bg-ink">
                                @if ($rel->hasMedia('hero'))
                                    <img src="{{ $rel->getFirstMediaUrl('hero', 'card') }}" alt="{{ $rel->name }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-12 h-12 text-charcoal-soft/40" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/>
                                        </svg>
                                    </div>
                                @endif
                            </a>
                            <div class="p-5">
                                <h3 class="font-display font-semibold text-white text-base mb-1 group-hover:text-accent transition-colors">
                                    <a href="{{ route('fleet.show', $rel) }}">{{ $rel->name }}</a>
                                </h3>
                                <div class="flex items-center gap-4 text-stone-soft text-xs mt-3">
                                    <span>{{ $rel->passenger_count }} passengers</span>
                                    <span>{{ $rel->luggage_count }} bags</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection
