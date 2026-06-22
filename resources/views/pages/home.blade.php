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
     HERO — Mobile slider / Desktop four panels
     ============================================================ --}}
    <section class="relative overflow-hidden bg-ink" style="height:72vh; min-height:420px; max-height:680px;">

        {{-- ── MOBILE SLIDER (hidden on sm+) ── --}}
        <div class="sm:hidden h-full" x-data="{
            current: 0,
            slides: [
                { img: '/images/fleet/salon.jpg', eyebrow: 'Salon Car', title: 'Executive' },
                { img: '/images/fleet/highlander.jpg', eyebrow: 'Toyota Highlander', title: 'Off-Road Safari' },
                { img: '/images/fleet/landcruiser.jpg', eyebrow: 'Land Cruiser', title: 'City & Highway' },
                { img: '/images/fleet/minibus.jpg', eyebrow: 'Minibus', title: 'Group Travel' }
            ],
            touchStartX: 0,
            timer: null,
            next() { this.current = (this.current + 1) % this.slides.length },
            prev() { this.current = (this.current - 1 + this.slides.length) % this.slides.length },
            startTouch(e) { this.touchStartX = e.touches[0].clientX },
            endTouch(e) {
                const diff = this.touchStartX - e.changedTouches[0].clientX;
                if (Math.abs(diff) > 40) { diff > 0 ? this.next() : this.prev() }
            },
            init() { this.timer = setInterval(() => this.next(), 4000) }
        }" @touchstart.passive="startTouch($event)"
            @touchend.passive="endTouch($event)">

            <template x-for="(slide, i) in slides" :key="i">
                <div x-show="current === i" x-transition:enter="transition-opacity duration-700"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0">
                    <img :src="slide.img" :alt="slide.title" class="w-full h-full object-cover object-center"
                        fetchpriority="high">
                    <div class="absolute inset-0 bg-ink/35"></div>
                    <div class="absolute bottom-12 inset-x-0 px-6 py-6 bg-linear-to-t from-ink/80 to-transparent">
                        <p class="eyebrow text-accent mb-1" x-text="slide.eyebrow"></p>
                        <p class="font-display font-bold text-white text-2xl" x-text="slide.title"></p>
                    </div>
                </div>
            </template>

            {{-- Dot indicators --}}
            <div class="absolute bottom-4 inset-x-0 flex justify-center gap-2 z-20">
                <template x-for="(slide, i) in slides" :key="i">
                    <button @click="current = i; clearInterval(timer)"
                        class="w-2 h-2 rounded-full transition-all duration-300"
                        :class="current === i ? 'bg-accent w-5' : 'bg-white/40'" :aria-label="'Go to slide ' + (i + 1)">
                    </button>
                </template>
            </div>
        </div>

        {{-- ── DESKTOP PANELS (hidden on mobile) ── --}}
        <div class="hidden sm:flex h-full divide-x divide-white/10">

            <div class="hero-panel-enter group relative flex-1 overflow-hidden">
                <img src="/images/fleet/salon.jpg" alt="Executive Salon Car"
                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700"
                    fetchpriority="high" loading="eager">
                <div class="absolute inset-0 bg-ink/30 group-hover:bg-ink/15 transition-colors duration-500"></div>
                <div class="absolute bottom-0 inset-x-0 px-6 py-6 bg-linear-to-t from-ink/80 to-transparent">
                    <p class="eyebrow text-accent mb-1">Salon Car</p>
                    <p class="font-display font-bold text-white text-xl">Executive</p>
                </div>
            </div>

            <div class="hero-panel-enter group relative flex-1 overflow-hidden hidden md:block">
                <img src="/images/fleet/highlander.jpg" alt="Toyota Highlander SUV"
                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700"
                    loading="lazy">
                <div class="absolute inset-0 bg-ink/30 group-hover:bg-ink/15 transition-colors duration-500"></div>
                <div class="absolute bottom-0 inset-x-0 px-6 py-6 bg-linear-to-t from-ink/80 to-transparent">
                    <p class="eyebrow text-accent mb-1">Toyota Highlander</p>
                    <p class="font-display font-bold text-white text-xl">Off-Road Safari</p>
                </div>
            </div>

            <div class="hero-panel-enter group relative flex-1 overflow-hidden hidden lg:block">
                <img src="/images/fleet/landcruiser.jpg" alt="4WD Land Cruiser"
                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700"
                    loading="lazy">
                <div class="absolute inset-0 bg-ink/30 group-hover:bg-ink/15 transition-colors duration-500"></div>
                <div class="absolute bottom-0 inset-x-0 px-6 py-6 bg-linear-to-t from-ink/80 to-transparent">
                    <p class="eyebrow text-accent mb-1">Land Cruiser</p>
                    <p class="font-display font-bold text-white text-xl">City &amp; Highway</p>
                </div>
            </div>

            <div class="hero-panel-enter group relative flex-1 overflow-hidden hidden xl:block">
                <img src="/images/fleet/minibus.jpg" alt="Minibus Group Transfer"
                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700"
                    loading="lazy">
                <div class="absolute inset-0 bg-ink/30 group-hover:bg-ink/15 transition-colors duration-500"></div>
                <div class="absolute bottom-0 inset-x-0 px-6 py-6 bg-linear-to-t from-ink/80 to-transparent">
                    <p class="eyebrow text-accent mb-1">Minibus</p>
                    <p class="font-display font-bold text-white text-xl">Group Travel</p>
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
            <h1 data-reveal
                class="font-display font-black text-white uppercase tracking-tight leading-none mb-4
                       text-[2rem] sm:text-[2.75rem] lg:text-[3.75rem]">
                Car &amp; Driver Hire<br class="sm:hidden"> Across Ghana.
            </h1>
            <p data-reveal data-reveal-delay="120"
                class="text-white/70 text-xs sm:text-sm tracking-[0.18em] uppercase mb-8">
                Accra &nbsp;&middot;&nbsp; Cape Coast &nbsp;&middot;&nbsp; Kumasi &nbsp;&middot;&nbsp; Mole
                &nbsp;&middot;&nbsp; Tamale &nbsp;&middot;&nbsp; Bolgatanga &nbsp;&middot;&nbsp; Wa
                <span class="block mt-1 text-white/50 text-[10px] normal-case tracking-widest">Cross-border hire available
                    to Togo &amp; Benin</span>
            </p>
            <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" data-reveal data-reveal-delay="240"
                class="btn-shimmer inline-flex items-center gap-2.5 border border-white text-white font-semibold text-sm
                      px-8 py-3.5 rounded-sm hover:bg-white hover:text-accent transition-colors duration-200 tracking-wide">
                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path
                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                </svg>
                Book via WhatsApp
            </a>
        </div>
    </section>

    {{-- ============================================================
     DESTINATIONS — Car rentals across Ghana (SEO + internal links)
     ============================================================ --}}
    <section class="bg-bone py-20 lg:py-28 border-t border-mist">
        <div class="container-page">
            <div class="max-w-2xl mb-12 lg:mb-14" data-reveal>
                <p class="eyebrow text-accent mb-3">Where We Operate</p>
                <h2 class="font-display font-bold text-ink text-display-md tracking-tight">
                    Car rentals across Ghana
                </h2>
                <p class="text-stone text-base leading-relaxed mt-4">
                    Hire a car with a professional driver in every major city and destination — from the capital to
                    the northern savannah. Pick your location to see vehicles, routes and pricing.
                </p>
            </div>

            {{-- Featured destinations --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5" data-stagger data-stagger-delay="100">
                @foreach ([['slug' => 'accra-car-rentals', 'name' => 'Accra Car Rentals', 'body' => 'Greater Accra — Osu, East Legon, Airport City and Cantonments. Daily and weekly hire with a driver.'], ['slug' => 'tamale-car-rentals', 'name' => 'Tamale Car Rentals', 'body' => 'Northern Ghana hub — city transfers, airport pickups and onward trips to Mole and beyond.'], ['slug' => 'mole-national-park', 'name' => 'Mole National Park', 'body' => '4x4 safari transport to Mole and Larabanga with experienced driver-guides who know the route.']] as $dest)
                    <a href="{{ route('services.show', $dest['slug']) }}"
                        class="group relative flex flex-col justify-between bg-white border border-mist rounded-sm p-7 hover:border-accent hover:shadow-lg transition-all duration-200">
                        <div>
                            <p class="eyebrow text-accent mb-2">Most Popular</p>
                            <h3 class="font-display font-bold text-ink text-xl mb-2">{{ $dest['name'] }}</h3>
                            <p class="text-stone text-sm leading-relaxed">{{ $dest['body'] }}</p>
                        </div>
                        <span
                            class="mt-6 inline-flex items-center gap-1.5 text-sm font-semibold text-ink group-hover:text-accent transition-colors">
                            Explore
                            <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-0.5"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6l6 6-6 6" />
                            </svg>
                        </span>
                    </a>
                @endforeach
            </div>

            {{-- Secondary destinations --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-5" data-reveal>
                @foreach ([['slug' => 'cape-coast-car-rentals', 'name' => 'Cape Coast Car Rentals', 'body' => 'Coast and castles — Cape Coast, Elmina and Kakum day trips with a professional driver.'], ['slug' => 'kumasi-car-rentals', 'name' => 'Kumasi Car Rentals', 'body' => 'Ashanti Region — Kumasi city, airport and cultural tours with a driver who knows the area.']] as $dest)
                    <a href="{{ route('services.show', $dest['slug']) }}"
                        class="group flex items-center justify-between bg-white border border-mist rounded-sm px-7 py-6 hover:border-accent hover:shadow-lg transition-all duration-200">
                        <div class="pr-4">
                            <h3 class="font-display font-bold text-ink text-lg mb-1">{{ $dest['name'] }}</h3>
                            <p class="text-stone text-sm leading-relaxed">{{ $dest['body'] }}</p>
                        </div>
                        <svg class="w-5 h-5 shrink-0 text-stone-soft transition-all duration-200 group-hover:text-accent group-hover:translate-x-0.5"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6l6 6-6 6" />
                        </svg>
                    </a>
                @endforeach
            </div>

            <div class="mt-10" data-reveal>
                <a href="{{ route('services.index') }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-accent hover:text-accent-deep transition-colors">
                    See nationwide car rentals across Ghana
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6l6 6-6 6" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ============================================================
     FEATURES — editorial dark 3-col with ghost numbers
     ============================================================ --}}
    <section class="bg-ink">
        <div class="grid grid-cols-1 md:grid-cols-3 divide-y divide-charcoal-soft md:divide-y-0 md:divide-x md:divide-charcoal-soft"
            data-stagger data-stagger-delay="120">
            @foreach ([['num' => '01', 'title' => 'Driver Always Included', 'body' => 'Every booking comes with a vetted, uniformed professional driver. No self-drive — ever.'], ['num' => '02', 'title' => 'Premium Fleet', 'body' => 'From executive sedans to 4WD safari vehicles — every car cleaned, inspected and prepared before each journey.'], ['num' => '03', 'title' => '24 / 7 Service', 'body' => 'Early flights, late arrivals, midnight transfers. We operate around the clock, every day of the year.']] as $feat)
                <div class="relative px-10 py-14 lg:py-16 overflow-hidden">
                    <span
                        class="absolute bottom-2 right-6 font-display font-black leading-none text-white/4 select-none pointer-events-none"
                        style="font-size:7rem;">{{ $feat['num'] }}</span>
                    <div class="w-8 h-0.5 bg-accent mb-8"></div>
                    <h3 class="font-display font-bold text-white text-xl mb-3">{{ $feat['title'] }}</h3>
                    <p class="text-stone-soft text-sm leading-relaxed">{{ $feat['body'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ============================================================
     FLEET TICKER STRIP
     ============================================================ --}}
    <style>
        .uprise-ticker {
            animation: uprise-ticker-anim 28s linear infinite;
            will-change: transform;
        }

        @@keyframes uprise-ticker-anim {
            from {
                transform: translateX(0)
            }

            to {
                transform: translateX(-50%)
            }
        }
    </style>
    <section class="bg-charcoal border-y border-charcoal-soft overflow-hidden relative" style="height:48px;">
        <div class="uprise-ticker flex items-center whitespace-nowrap absolute left-0 top-0 h-full">
            @php $tickerItems = ['Executive', 'Salon Car', 'Toyota Highlander', 'Off-Road Safari', 'Land Cruiser', 'City &amp; Highway', 'Minibus', 'Group Travel']; @endphp
            @foreach (array_merge($tickerItems, $tickerItems) as $item)
                <span class="text-stone text-[11px] uppercase tracking-[0.25em] px-5">{{ $item }}</span>
                <span class="text-charcoal-soft select-none">&middot;</span>
            @endforeach
        </div>
        <div class="absolute right-0 top-0 h-full flex items-center z-10 pr-5"
            style="background:linear-gradient(to right, transparent, #111111 35%);">
            <a href="{{ route('fleet.index') }}"
                class="ml-8 shrink-0 inline-flex items-center gap-1.5 text-[11px] font-semibold text-white border border-white/25 px-4 py-1.5 uppercase tracking-widest hover:bg-white hover:text-ink transition-colors duration-200">
                Browse Fleet &rarr;
            </a>
        </div>
    </section>

    {{-- ============================================================
     WHY UPRISE — open layout with ghost numerals
     ============================================================ --}}
    <section class="bg-white py-20 lg:py-28 border-t border-mist overflow-hidden">
        <div class="container-page">

            <div class="text-center mb-14 lg:mb-18" data-reveal>
                <p class="eyebrow text-accent mb-3">Why Uprise</p>
                <h2 class="font-display font-bold text-ink text-display-md tracking-tight">
                    The Uprise standard.
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-6" data-stagger
                data-stagger-delay="100">
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
                    <div class="relative">
                        <span class="block font-display font-black leading-none text-ink/5 select-none mb-3 -ml-1"
                            style="font-size:5.5rem;">{{ $pillar['num'] }}</span>
                        <div class="w-6 h-0.5 bg-accent mb-4"></div>
                        <h3 class="font-display font-semibold text-ink text-base mb-2">{{ $pillar['title'] }}</h3>
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
        <section id="testimonials" class="bg-ink py-20 lg:py-28 border-t border-charcoal-soft">
            <div class="container-page">

                <div class="flex items-end justify-between mb-12 lg:mb-16 gap-4 flex-wrap">
                    <div>
                        <p class="eyebrow text-accent mb-3">Client Stories</p>
                        <h2 class="font-display font-bold text-white text-display-md tracking-tight">
                            What our clients say.
                        </h2>
                    </div>
                    <span class="font-display font-black text-white/5 select-none hidden lg:block -mb-3"
                        style="font-size:7rem;line-height:1;">&ldquo;</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-{{ min($testimonials->count(), 3) }} gap-5"
                    data-stagger data-stagger-delay="100">
                    @foreach ($testimonials->take(3) as $testimonial)
                        <article class="bg-charcoal border border-charcoal-soft p-7 flex flex-col">
                            {{-- Stars --}}
                            <div class="flex gap-0.5 mb-5" aria-label="{{ $testimonial->rating }} out of 5 stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span
                                        class="{{ $i <= $testimonial->rating ? 'text-accent' : 'text-charcoal-soft' }} text-base leading-none">★</span>
                                @endfor
                            </div>
                            {{-- Quote --}}
                            <blockquote class="text-stone-soft text-sm leading-relaxed flex-1 mb-6">
                                &ldquo;{{ $testimonial->content }}&rdquo;
                            </blockquote>
                            {{-- Author --}}
                            <footer class="flex items-center gap-3 pt-5 border-t border-charcoal-soft">
                                @if ($testimonial->hasMedia('avatar'))
                                    <img src="{{ $testimonial->getFirstMediaUrl('avatar', 'avatar') }}"
                                        alt="{{ $testimonial->author_name }}"
                                        class="w-9 h-9 rounded-full object-cover shrink-0" loading="lazy">
                                @else
                                    <div
                                        class="w-9 h-9 rounded-full bg-ink-deep flex items-center justify-center shrink-0">
                                        <span
                                            class="text-stone-soft font-semibold text-xs">{{ substr($testimonial->author_name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-semibold text-white text-sm leading-tight">
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
    <section class="bg-accent relative overflow-hidden">
        <div class="absolute top-0 inset-x-0 h-px bg-linear-to-r from-transparent via-white/20 to-transparent"></div>
        <div class="absolute bottom-0 inset-x-0 h-px bg-linear-to-r from-transparent via-white/20 to-transparent"></div>
        <div class="container-page relative z-10 py-20 lg:py-24 text-center">
            <p class="eyebrow text-white/70 mb-4" data-reveal>Ready to travel?</p>
            <h2 class="font-display font-bold text-white text-display-lg tracking-tight mb-4 max-w-2xl mx-auto" data-reveal
                data-reveal-delay="100">
                Your ride is one message away.
            </h2>
            <p class="text-stone-soft text-base mb-10 max-w-md mx-auto" data-reveal data-reveal-delay="200">
                Reach us on WhatsApp for instant booking confirmation. 24/7, every day of the year.
            </p>
            <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener"
                class="inline-flex items-center gap-2.5 border border-white text-white font-semibold px-8 py-4 rounded-sm
                  hover:bg-white hover:text-accent transition-colors duration-200 text-sm tracking-wide">
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
