@extends('layouts.app')

@php
    $title = $service->meta_title ?: 'Uprise Travel Car Rentals | ' . $service->name;
    $metaDescription = $service->meta_description ?: $service->short_description;
@endphp

@section('content')

    <x-seo.breadcrumb-jsonld :crumbs="[
        ['name' => 'Home', 'url' => route('home')],
        ['name' => 'Our Services', 'url' => route('services.index')],
        ['name' => $service->name, 'url' => route('services.show', $service)],
    ]" />

    {{-- ============================================================
     HERO
     ============================================================ --}}
    <div class="relative bg-ink-deep overflow-hidden" style="min-height: 46vh;">

        @php
            $serviceHero = $service->hasMedia('hero')
                ? $service->getFirstMediaUrl('hero', 'hero')
                : $service->hero_image_url;
        @endphp
        @if ($serviceHero)
            <img src="{{ $serviceHero }}" alt="{{ $service->name }}"
                class="absolute inset-0 w-full h-full object-cover object-center" fetchpriority="high" loading="eager">
            <div class="absolute inset-0 bg-ink-deep/60"></div>
            <div class="absolute inset-0 bg-linear-to-t from-ink-deep via-ink-deep/20 to-transparent"></div>
        @else
            {{-- Decorative pattern fallback --}}
            <div class="absolute inset-0 bg-linear-to-br from-charcoal via-ink to-ink-deep"></div>
            <div class="absolute inset-0 opacity-5"
                style="background-image: radial-gradient(circle, #00599A 1px, transparent 1px); background-size: 32px 32px;">
            </div>
        @endif

        {{-- Breadcrumb --}}
        <div class="relative z-10 container-page pt-6">
            <nav class="flex items-center gap-2 text-xs text-white/60" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span>/</span>
                <a href="{{ route('services.index') }}" class="hover:text-white transition-colors">Our Services</a>
                <span>/</span>
                <span class="text-white/90">{{ $service->name }}</span>
            </nav>
        </div>

        {{-- Title --}}
        <div class="relative z-10 container-page pb-12 pt-8 flex items-end" style="min-height: 38vh;">
            <div>
                <p class="eyebrow text-accent mb-3">Our Services</p>
                <h1
                    class="font-display font-bold text-white tracking-tight
                            text-[2rem] sm:text-[2.75rem] lg:text-[3.5rem]">
                    {{ $service->name }}
                </h1>
            </div>
        </div>
    </div>

    {{-- ============================================================
     MAIN CONTENT
     ============================================================ --}}
    <section class="bg-bone py-14 lg:py-20">
        <div class="container-page">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-10 lg:gap-14">

                {{-- DESCRIPTION (mobile 1st · desktop top-left) --}}
                <div class="lg:col-span-2 lg:col-start-1 lg:row-start-1 space-y-8" data-reveal="fade-left">

                    {{-- Short description --}}
                    @if ($service->short_description)
                        <p class="text-ink text-lg leading-relaxed font-medium border-l-4 border-accent pl-5">
                            {{ $service->short_description }}
                        </p>
                    @endif

                    {{-- Full description --}}
                    @if ($service->description)
                        <div class="prose prose-stone prose-sm sm:prose max-w-none">
                            {!! $service->description !!}
                        </div>
                    @else
                        {{-- Fallback when no long-form content yet --}}
                        <div class="bg-white rounded-md p-6 shadow-card space-y-4">
                            <p class="font-display font-semibold text-ink text-base">What's included</p>
                            <ul class="space-y-3">
                                @foreach (['Professional, vetted driver for the full journey', 'Comfortable, well-maintained vehicle', 'Flexible pickup and drop-off locations', 'Ghana-wide & cross-border coverage', 'WhatsApp booking confirmation — fast'] as $bullet)
                                    <li class="flex items-start gap-3 text-sm text-stone">
                                        <svg class="w-4 h-4 text-accent shrink-0 mt-0.5" fill="none"
                                            stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.5 12.75l6 6 9-13.5" />
                                        </svg>
                                        {{ $bullet }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                {{-- BOOKING FORM (mobile 2nd — right after description · desktop right column) --}}
                <div class="lg:col-span-3 lg:col-start-3 lg:row-start-1 lg:row-span-2" data-reveal="fade-right">
                    <div class="sticky top-28 bg-white rounded-md shadow-card p-8">
                        <div class="mb-6">
                            <p class="eyebrow text-accent mb-3">Make a Booking</p>
                            <h2 class="font-display font-bold text-ink text-2xl tracking-tight mb-2">
                                Request {{ $service->name }}
                            </h2>
                            <p class="text-stone text-sm leading-relaxed">
                                Fill in your details and we'll get back to you promptly.
                            </p>
                        </div>
                        <script src="https://js.hsforms.net/forms/embed/6121051.js" defer></script>
                        <div class="hs-form-frame" data-region="na1" data-form-id="ac79e8ee-2fd9-4210-b9b4-e39c330d7793"
                            data-portal-id="6121051"></div>
                    </div>
                </div>

                {{-- BOOKING SUPPORT (mobile 3rd · desktop bottom-left) --}}
                <div class="lg:col-span-2 lg:col-start-1 lg:row-start-2 space-y-8" data-reveal="fade-left">

                    {{-- Explore fleet CTA --}}
                    <div class="flex items-center gap-4">
                        <a href="{{ route('fleet.index') }}"
                            class="inline-flex items-center gap-2 border border-ink/15 text-ink font-semibold text-sm
                                   px-5 py-3 rounded-sm hover:border-ink/40 transition-colors duration-150 tracking-wide">
                            Browse our fleet &rarr;
                        </a>
                    </div>

                    {{-- WhatsApp booking card --}}
                    <div class="bg-ink rounded-md p-6 text-center">
                        <p class="eyebrow text-accent mb-3">Book This Service</p>
                        <h3 class="font-display font-bold text-white text-base mb-2">{{ $service->name }}</h3>
                        <p class="text-stone-soft text-sm mb-6 leading-relaxed">
                            Message us on WhatsApp with your travel dates and we'll confirm your booking quickly.
                        </p>
                        <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener"
                            class="btn-shimmer w-full inline-flex items-center justify-center gap-2.5 bg-white text-ink font-semibold
                                       text-sm px-5 py-3.5 rounded-lg hover:bg-ink hover:text-white transition-colors duration-200 tracking-wide">
                            <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                            Enquire via WhatsApp
                        </a>

                        <div class="mt-4 pt-4 border-t border-charcoal-soft space-y-2 text-left">
                            <div class="flex items-center gap-2.5 text-xs text-stone-soft">
                                <svg class="w-3.5 h-3.5 text-accent shrink-0" fill="none" stroke="currentColor"
                                    stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                Driver always included
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-stone-soft">
                                <svg class="w-3.5 h-3.5 text-accent shrink-0" fill="none" stroke="currentColor"
                                    stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                Confirmation within hours
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-stone-soft">
                                <svg class="w-3.5 h-3.5 text-accent shrink-0" fill="none" stroke="currentColor"
                                    stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                Flexible itineraries
                            </div>
                        </div>
                    </div>

                    {{-- Direct contacts --}}
                    <div class="bg-white rounded-md p-5 shadow-card space-y-3">
                        <p class="eyebrow text-stone mb-3">Or contact us directly</p>
                        <a href="tel:{{ config('uprise.contact.phone_e164') }}"
                            class="flex items-center gap-2.5 text-sm text-stone hover:text-ink transition-colors">
                            <svg class="w-4 h-4 text-accent shrink-0" fill="none" stroke="currentColor"
                                stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                            {{ config('uprise.contact.phone') }}
                        </a>
                        <a href="tel:{{ config('uprise.contact.phone_us_e164') }}"
                            class="flex items-center gap-2.5 text-sm text-stone hover:text-ink transition-colors">
                            <svg class="w-4 h-4 text-accent shrink-0" fill="none" stroke="currentColor"
                                stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                            {{ config('uprise.contact.phone_us') }}
                            <span class="text-xs text-stone-soft">(US)</span>
                        </a>
                        <a href="mailto:{{ config('uprise.contact.email') }}"
                            class="flex items-center gap-2.5 text-sm text-stone hover:text-ink transition-colors">
                            <svg class="w-4 h-4 text-accent shrink-0" fill="none" stroke="currentColor"
                                stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            {{ config('uprise.contact.email') }}
                        </a>
                    </div>

                    <a href="{{ route('services.index') }}"
                        class="flex items-center gap-1.5 text-sm text-stone hover:text-ink transition-colors font-medium">
                        &larr; All Services
                    </a>

                </div>

            </div>
        </div>
    </section>

    {{-- ============================================================
     OTHER SERVICES
     ============================================================ --}}
    @if ($related->isNotEmpty())
        <section class="bg-ink border-t border-charcoal-soft py-14 lg:py-20">
            <div class="container-page">
                <p class="eyebrow text-accent mb-3">Also Available</p>
                <h2 class="font-display font-bold text-white text-display-sm tracking-tight mb-10">
                    More services
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    @foreach ($related as $rel)
                        <a href="{{ route('services.show', $rel) }}"
                            class="group flex items-start gap-4 bg-charcoal rounded-md p-5
                                   hover:ring-1 hover:ring-accent/30 transition-all duration-200">
                            <span
                                class="font-display font-bold text-xl text-charcoal-soft group-hover:text-accent transition-colors shrink-0 mt-0.5">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <div>
                                <h3
                                    class="font-display font-semibold text-white text-sm mb-1 group-hover:text-accent transition-colors">
                                    {{ $rel->name }}
                                </h3>
                                <p class="text-stone-soft text-xs leading-relaxed line-clamp-2">
                                    {{ $rel->short_description }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <x-ui.lifestyle-grid :photos="$photos" />

@endsection
