@extends('layouts.app')

@php
    $title = 'Uprise Travel Car Rentals | ' . $category->name . ' Photos';
    $metaDescription = 'Photos of our ' . $category->name . ' — available for hire with a professional driver across Ghana and West Africa.';
    $ogImage = $images->first();
@endphp

@section('content')

    <x-seo.breadcrumb-jsonld :crumbs="[
        ['name' => 'Home', 'url' => route('home')],
        ['name' => 'Fleet', 'url' => route('fleet.index')],
        ['name' => $category->name, 'url' => route('fleet.group', ['category' => $category->slug, 'item' => $item])],
    ]" />

    {{-- ============================================================
     HERO IMAGE
     ============================================================ --}}
    <div class="relative bg-ink-deep overflow-hidden" style="min-height: 46vh;">
        <img src="{{ $images->first() }}" alt="{{ $category->name }}"
            class="absolute inset-0 w-full h-full object-cover object-center" fetchpriority="high" loading="eager">
        <div class="absolute inset-0 bg-ink-deep/55"></div>
        <div class="absolute inset-0 bg-linear-to-t from-ink-deep via-ink-deep/20 to-transparent"></div>

        {{-- Breadcrumb over image --}}
        <div class="relative z-10 container-page pt-6">
            <nav class="flex items-center gap-2 text-xs text-white/60" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span>/</span>
                <a href="{{ route('fleet.index') }}" class="hover:text-white transition-colors">Fleet</a>
                <span>/</span>
                <span class="text-white/90">{{ $category->name }}</span>
            </nav>
        </div>

        {{-- Title overlay --}}
        <div class="relative z-10 container-page pb-10 pt-6 flex items-end" style="min-height: 34vh;">
            <div data-reveal>
                <p class="eyebrow text-accent mb-3">Fleet</p>
                <h1 class="font-display font-bold text-white tracking-tight
                            text-[2rem] sm:text-[2.75rem] lg:text-[3.5rem]">
                    {{ $category->name }}
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

                {{-- LEFT: Photo gallery --}}
                <div class="lg:col-span-2" data-reveal="fade-left">
                    <h2 class="font-display font-bold text-ink text-lg mb-5">Photos</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach ($images as $image)
                            <div class="aspect-[4/3] rounded-md overflow-hidden bg-charcoal">
                                <img src="{{ $image }}" alt="{{ $category->name }} — photo {{ $loop->iteration }}"
                                    class="w-full h-full object-cover"
                                    loading="{{ $loop->first ? 'eager' : 'lazy' }}">
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- RIGHT: Enquiry sidebar --}}
                <div class="lg:col-span-1" data-reveal="fade-right">
                    <div class="sticky top-28 space-y-4">

                        <div class="bg-ink rounded-md p-6 text-center">
                            <p class="eyebrow text-accent mb-3">Book This Vehicle Type</p>
                            <h3 class="font-display font-bold text-white text-lg mb-2">{{ $category->name }}</h3>
                            <p class="text-stone-soft text-sm mb-6 leading-relaxed">
                                Send us a WhatsApp message and we'll confirm your booking quickly.
                            </p>
                            <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener"
                                class="w-full inline-flex items-center justify-center gap-2.5 bg-accent text-white font-semibold
                                       text-sm px-5 py-3.5 rounded-sm hover:bg-accent-soft transition-colors duration-200 tracking-wide">
                                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                                Book via WhatsApp
                            </a>
                            <div class="mt-4 pt-4 border-t border-charcoal-soft space-y-2 text-left">
                                <div class="flex items-center gap-2.5 text-xs text-stone-soft">
                                    <svg class="w-3.5 h-3.5 text-accent shrink-0" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                    Professional driver included
                                </div>
                                <div class="flex items-center gap-2.5 text-xs text-stone-soft">
                                    <svg class="w-3.5 h-3.5 text-accent shrink-0" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                    Ghana-wide & cross-border coverage
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

@endsection
