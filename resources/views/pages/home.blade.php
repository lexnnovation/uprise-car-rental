@extends('layouts.app')

@php
    $title = 'Car Rental with Driver in Ghana | Uprise Travel';
    $metaDescription =
        'Hire a car and driver anywhere in Ghana — Accra, Cape Coast, Kumasi, Mole, Tamale, Bolgatanga and Wa. Airport transfers, safari tours, executive hire and cross-border travel to Togo & Benin. All rentals include a professional driver.';
    $whatsappUrl =
        'https://wa.me/' .
        config('uprise.whatsapp.number') .
        '?text=' .
        urlencode(config('uprise.whatsapp.default_message'));
@endphp

@section('content')

    {{-- ============================================================
     HERO — Four car types side by side
     ============================================================ --}}
    <section class="relative overflow-hidden bg-ink" style="height:72vh; min-height:420px; max-height:680px;">

        <div class="flex h-full divide-x divide-white/10">

            {{-- Panel 1: Executive Salon --}}
            <div class="group relative flex-1 overflow-hidden">
                <img src="/images/fleet/salon.jpg" alt="Executive Salon Car"
                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700"
                    fetchpriority="high" loading="eager">
                <div class="absolute inset-0 bg-ink/30 group-hover:bg-ink/15 transition-colors duration-500"></div>
                <div class="absolute bottom-0 inset-x-0 px-6 py-6 bg-linear-to-t from-ink/80 to-transparent">
                    <p class="eyebrow text-accent mb-1">Executive</p>
                    <p class="font-display font-bold text-white text-lg">Salon Car</p>
                </div>
            </div>

            {{-- Panel 2: SUV / Highlander --}}
            <div class="group relative flex-1 overflow-hidden">
                <img src="/images/fleet/highlander.jpg" alt="Toyota Highlander SUV"
                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700"
                    loading="lazy">
                <div class="absolute inset-0 bg-ink/30 group-hover:bg-ink/15 transition-colors duration-500"></div>
                <div class="absolute bottom-0 inset-x-0 px-6 py-6 bg-linear-to-t from-ink/80 to-transparent">
                    <p class="eyebrow text-accent mb-1">Premium SUV</p>
                    <p class="font-display font-bold text-white text-lg">Toyota Highlander</p>
                </div>
            </div>

            {{-- Panel 3: 4WD / Land Cruiser --}}
            <div class="group relative flex-1 overflow-hidden">
                <img src="/images/fleet/landcruiser.jpg" alt="4WD Land Cruiser"
                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700"
                    loading="lazy">
                <div class="absolute inset-0 bg-ink/30 group-hover:bg-ink/15 transition-colors duration-500"></div>
                <div class="absolute bottom-0 inset-x-0 px-6 py-6 bg-linear-to-t from-ink/80 to-transparent">
                    <p class="eyebrow text-accent mb-1">4WD Safari</p>
                    <p class="font-display font-bold text-white text-lg">Land Cruiser</p>
                </div>
            </div>

            {{-- Panel 4: Minibus --}}
            <div class="group relative flex-1 overflow-hidden">
                <img src="/images/fleet/minibus.jpg" alt="Minibus Group Transfer"
                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700"
                    loading="lazy">
                <div class="absolute inset-0 bg-ink/30 group-hover:bg-ink/15 transition-colors duration-500"></div>
                <div class="absolute bottom-0 inset-x-0 px-6 py-6 bg-linear-to-t from-ink/80 to-transparent">
                    <p class="eyebrow text-accent mb-1">Group Travel</p>
                    <p class="font-display font-bold text-white text-lg">Minibus</p>
                </div>
            </div>

        </div>

        {{-- Top gradient for nav readability --}}
        <div class="absolute inset-x-0 top-0 h-28 bg-linear-to-b from-ink/50 to-transparent pointer-events-none z-10"
            aria-hidden="true"></div>

    </section>

    {{-- ============================================================
     ACCENT BAND — Sixt orange → Uprise blue
     ============================================================ --}}
    <section class="bg-accent py-12 lg:py-16">
        <div class="container-page text-center">
            <h1
                class="font-display font-black text-white uppercase tracking-tight leading-none mb-4
                       text-[2rem] sm:text-[2.75rem] lg:text-[3.75rem]">
                Car &amp; Driver Hire<br class="sm:hidden"> Across Ghana.
            </h1>
            <p class="text-white/70 text-xs sm:text-sm tracking-[0.18em] uppercase mb-8">
                Accra &nbsp;&middot;&nbsp; Cape Coast &nbsp;&middot;&nbsp; Kumasi &nbsp;&middot;&nbsp; Mole
                &nbsp;&middot;&nbsp; Tamale &nbsp;&middot;&nbsp; Bolgatanga &nbsp;&middot;&nbsp; Wa
                <span class="block mt-1 text-white/50 text-[10px] normal-case tracking-widest">Cross-border hire available
                    to Togo &amp; Benin</span>
            </p>
            <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener"
                class="inline-flex items-center gap-2.5 bg-white text-accent font-bold text-sm
                      px-8 py-3.5 rounded-sm hover:bg-bone transition-colors duration-200 tracking-wide">
                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path
                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                </svg>
                Book via WhatsApp
            </a>
        </div>
    </section>

    {{-- ============================================================
     FEATURES — Sixt-style 3-col icon + title + body
     ============================================================ --}}
    <section class="bg-white border-b border-mist py-14 lg:py-16">
        <div class="container-page">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:divide-x md:divide-mist">

                @foreach ([
            [
                'icon' => 'M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z',
                'title' => 'Driver Always Included',
                'body' => 'Every booking comes with a vetted, uniformed professional driver. No self-drive — ever.',
            ],
            [
                'icon' => 'M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12',
                'title' => 'Premium Fleet',
                'body' => 'From executive sedans to 4WD safari vehicles — every car cleaned, inspected and prepared before each journey.',
            ],
            [
                'icon' => 'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z',
                'title' => '24 / 7 Service',
                'body' => 'Early flights, late arrivals, midnight transfers. We operate around the clock, every day of the year.',
            ],
        ] as $feat)
                    <div class="flex items-start gap-4 md:px-10 first:pl-0 last:pr-0">
                        <svg class="w-8 h-8 text-ink shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $feat['icon'] }}" />
                        </svg>
                        <div>
                            <h3 class="font-display font-bold text-ink text-base mb-1.5">{{ $feat['title'] }}</h3>
                            <p class="text-stone text-sm leading-relaxed">{{ $feat['body'] }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    {{-- ============================================================
     FLEET CTA STRIP
     ============================================================ --}}
    <section class="bg-bone border-t border-mist">
        <div class="container-page py-6 flex items-center justify-between gap-4">
            <p class="text-stone text-sm">
                Sedans, SUVs, minibuses, safari 4WDs &amp; luxury vans — all with professional drivers.
            </p>
            <a href="{{ route('fleet.index') }}"
                class="shrink-0 inline-flex items-center gap-1.5 text-sm font-semibold text-ink
                      border border-ink px-5 py-2.5 rounded-sm hover:bg-ink hover:text-white transition-colors duration-200 tracking-wide">
                Browse full fleet &rarr;
            </a>
        </div>
    </section>

    {{-- ============================================================
     SERVICES
     ============================================================ --}}
    <section id="services" class="bg-white py-20 lg:py-28 border-t border-mist">
        <div class="container-page">

            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-12 lg:mb-16 gap-4">
                <div>
                    <p class="eyebrow text-stone mb-3">How We Serve You</p>
                    <h2 class="font-display font-bold text-ink text-display-md tracking-tight">
                        Every journey, perfected.
                    </h2>
                </div>
                <a href="/services"
                    class="text-sm font-semibold text-accent hover:text-accent-soft transition-colors shrink-0">
                    View all services &rarr;
                </a>
            </div>

            {{-- Service directory list (mirrors nav dropdown) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 divide-y divide-mist md:divide-y-0">
                @foreach ($services as $i => $service)
                    @if ($i % 2 === 0 && !$loop->first)
                        {{-- Add top divider on second column rows for desktop --}}
                    @endif
                    <a href="/services/{{ $service->slug }}"
                        class="group flex items-start gap-5 py-6 border-b border-mist last:border-b-0
                               md:border-b md:nth-last-[-n+2]:border-b-0 hover:bg-mist-soft -mx-4 px-4 rounded-sm transition-colors duration-150">

                        {{-- Number --}}
                        <span
                            class="font-display font-bold text-2xl text-mist shrink-0 w-8 text-right leading-tight mt-0.5
                                     group-hover:text-accent transition-colors duration-150">
                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </span>

                        {{-- Content --}}
                        <div class="flex-1 min-w-0">
                            <h3
                                class="font-display font-semibold text-ink text-base mb-1 group-hover:text-accent transition-colors duration-150">
                                {{ $service->name }}
                            </h3>
                            <p class="text-stone text-sm leading-relaxed line-clamp-2">
                                {{ $service->short_description }}
                            </p>
                        </div>

                        {{-- Arrow --}}
                        <svg class="w-4 h-4 text-mist shrink-0 mt-1 group-hover:text-accent group-hover:translate-x-0.5 transition-all duration-150"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                @endforeach
            </div>

        </div>
    </section>

    {{-- ============================================================
     WHY UPRISE
     ============================================================ --}}
    <section class="bg-bone py-20 lg:py-28 border-t border-mist">
        <div class="container-page">

            <div class="text-center mb-14 lg:mb-18">
                <p class="eyebrow text-accent mb-3">Why Uprise</p>
                <h2 class="font-display font-bold text-ink text-display-md tracking-tight">
                    The Uprise standard.
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ([
            [
                'num' => '01',
                'title' => 'Flight Monitoring',
                'body' => 'We track every incoming flight in real time. Your driver adjusts automatically — no waiting, no surprises.',
            ],
            [
                'num' => '02',
                'title' => 'Professional Drivers',
                'body' => 'Vetted, uniformed, trained in hospitality. Every Uprise driver is a professional representative of your journey.',
            ],
            [
                'num' => '03',
                'title' => '24/7 Availability',
                'body' => 'Early flights, late arrivals, midnight requests. We operate around the clock, every day of the year.',
            ],
            [
                'num' => '04',
                'title' => 'Immaculate Fleet',
                'body' => 'Every vehicle is cleaned, inspected and prepared before each assignment. The standard never slips.',
            ],
        ] as $pillar)
                    <div class="flex flex-col bg-white rounded-md p-6 border border-mist">
                        <span class="font-display font-bold text-4xl text-mist mb-5">{{ $pillar['num'] }}</span>
                        <h3 class="font-display font-semibold text-ink text-lg mb-3">{{ $pillar['title'] }}</h3>
                        <p class="text-stone text-sm leading-relaxed">{{ $pillar['body'] }}</p>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- ============================================================
     TESTIMONIALS
     ============================================================ --}}
    @if ($testimonials->isNotEmpty())
        <section id="testimonials" class="bg-white py-20 lg:py-28 border-t border-mist">
            <div class="container-page">

                <div class="text-center mb-12 lg:mb-16">
                    <p class="eyebrow text-stone mb-3">Client Stories</p>
                    <h2 class="font-display font-bold text-ink text-display-md tracking-tight">
                        What our clients say.
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-{{ min($testimonials->count(), 3) }} gap-6">
                    @foreach ($testimonials->take(3) as $testimonial)
                        <article class="bg-bone rounded-md p-7 border border-mist flex flex-col">
                            {{-- Stars --}}
                            <div class="flex gap-0.5 mb-5" aria-label="{{ $testimonial->rating }} out of 5 stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span
                                        class="{{ $i <= $testimonial->rating ? 'text-accent' : 'text-mist' }} text-base leading-none">★</span>
                                @endfor
                            </div>
                            {{-- Quote --}}
                            <blockquote class="text-ink text-sm leading-relaxed flex-1 mb-6">
                                &ldquo;{{ $testimonial->content }}&rdquo;
                            </blockquote>
                            {{-- Author --}}
                            <footer class="flex items-center gap-3 pt-5 border-t border-mist-soft">
                                @if ($testimonial->hasMedia('avatar'))
                                    <img src="{{ $testimonial->getFirstMediaUrl('avatar', 'avatar') }}"
                                        alt="{{ $testimonial->author_name }}"
                                        class="w-10 h-10 rounded-full object-cover shrink-0" loading="lazy">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-ink flex items-center justify-center shrink-0">
                                        <span
                                            class="text-bone font-semibold text-sm">{{ substr($testimonial->author_name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-semibold text-ink text-sm leading-tight">
                                        {{ $testimonial->author_name }}</p>
                                    <p class="text-stone text-xs mt-0.5">{{ $testimonial->author_role }}</p>
                                </div>
                            </footer>
                        </article>
                    @endforeach
                </div>

            </div>
        </section>
    @endif

    {{-- ============================================================
     CTA BAND
     ============================================================ --}}
    <section class="bg-ink-deep relative overflow-hidden">
        <div class="absolute inset-0 bg-linear-to-r from-ink-deep via-charcoal/30 to-ink-deep pointer-events-none"></div>
        <div class="absolute top-0 inset-x-0 h-px bg-linear-to-r from-transparent via-accent/50 to-transparent"></div>
        <div class="absolute bottom-0 inset-x-0 h-px bg-linear-to-r from-transparent via-accent/30 to-transparent"></div>
        <div class="container-page relative z-10 py-20 lg:py-24 text-center">
            <p class="eyebrow text-accent mb-4">Ready to travel?</p>
            <h2 class="font-display font-bold text-white text-display-lg tracking-tight mb-4 max-w-2xl mx-auto">
                Your ride is one message away.
            </h2>
            <p class="text-stone-soft text-base mb-10 max-w-md mx-auto">
                Reach us on WhatsApp for instant booking confirmation. 24/7, every day of the year.
            </p>
            <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener"
                class="inline-flex items-center gap-2.5 bg-accent text-white font-semibold px-8 py-4 rounded-sm
                  hover:bg-accent-soft transition-colors duration-200 text-sm tracking-wide">
                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path
                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                </svg>
                Book via WhatsApp
            </a>
        </div>
    </section>

    {{-- ============================================================
     FAQ
     ============================================================ --}}
    @if ($faqs->isNotEmpty())
        <section id="faq" class="bg-white py-20 lg:py-28 border-t border-mist">
            <div class="container-page">

                <div class="text-center mb-12 lg:mb-16">
                    <p class="eyebrow text-stone mb-3">Frequently Asked</p>
                    <h2 class="font-display font-bold text-ink text-display-md tracking-tight">
                        Questions & answers.
                    </h2>
                </div>

                <div class="max-w-3xl mx-auto" x-data="{ active: null }">
                    @foreach ($faqs as $i => $faq)
                        <div class="border-b border-mist first:border-t">
                            <button @click="active = active === {{ $i }} ? null : {{ $i }}"
                                class="w-full flex items-start justify-between gap-6 py-5 text-left group"
                                :aria-expanded="active === {{ $i }}">
                                <span
                                    class="font-semibold text-ink text-sm sm:text-base group-hover:text-stone transition-colors leading-snug">
                                    {{ $faq->question }}
                                </span>
                                <span
                                    class="text-accent text-xl font-light leading-none shrink-0 mt-0.5 transition-transform duration-200"
                                    :class="active === {{ $i }} ? 'rotate-45' : ''">+</span>
                            </button>
                            <div x-show="active === {{ $i }}"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 -translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 -translate-y-1" class="pb-5 pr-10">
                                <p class="text-stone text-sm sm:text-base leading-relaxed">{{ $faq->answer }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-10">
                    <a href="{{ route('faq') }}"
                        class="text-sm font-semibold text-ink hover:text-stone transition-colors underline underline-offset-4">
                        View all FAQs →
                    </a>
                </div>

            </div>
        </section>
    @endif

@endsection
