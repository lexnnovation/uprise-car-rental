@php
    $whatsappUrl =
        'https://wa.me/' .
        config('uprise.whatsapp.number') .
        '?text=' .
        urlencode(config('uprise.whatsapp.default_message'));
    $nav = [
        ['label' => 'Fleet', 'href' => route('fleet.index')],
        [
            'label' => 'Rent a Car',
            'href' => route('services.index'),
            'children' => [
                ['label' => 'Ghana Car Rentals', 'href' => route('services.show', 'ghana-car-rentals')],
                ['label' => 'Accra Car Rentals', 'href' => route('services.show', 'accra-car-rentals')],
                ['label' => 'Accra Airport Pickups', 'href' => route('services.show', 'accra-airport-pickups')],
                ['label' => 'Tamale Airport Pickups', 'href' => route('services.show', 'tamale-airport-pickups')],
                ['label' => 'Tamale Car Rentals', 'href' => route('services.show', 'tamale-car-rentals')],
                ['label' => 'Kumasi Car Rentals', 'href' => route('services.show', 'kumasi-car-rentals')],
                ['label' => 'Cape Coast Car Rentals', 'href' => route('services.show', 'cape-coast-car-rentals')],
                ['label' => 'Mole National Park Car Rentals', 'href' => route('services.show', 'mole-national-park')],
            ],
        ],
        ['label' => 'About', 'href' => route('about')],
        ['label' => 'Contact', 'href' => route('contact')],
    ];
@endphp

<header x-data="{ open: false, scrolled: false }" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 40 })"
    x-effect="document.body.style.overflow = open ? 'hidden' : ''" @keydown.escape.window="open = false"
    :class="scrolled ? 'shadow-sticky' : ''"
    class="fixed inset-x-0 top-0 z-50 bg-ink transition-shadow duration-300">

    {{-- Announcement bar --}}
    <div class="bg-orange">
        <div class="container-page text-[11px] text-ink tracking-wide py-2 flex flex-wrap items-center justify-center sm:justify-between gap-x-4 gap-y-1">

            {{-- Contacts column --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-x-3 gap-y-0.5">
                <span class="font-bold">Available 24/7:</span>
                <div class="flex items-center gap-x-2 whitespace-nowrap">
                    <a href="tel:+233249507413" class="inline-flex items-center gap-1 font-semibold hover:text-ink/70 transition-colors">
                        <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M6.62 10.79a15.53 15.53 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.02-.24 11.36 11.36 0 0 0 3.57.57 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.57a1 1 0 0 1-.25 1.02l-2.2 2.2z"/>
                        </svg>
                        <span><span class="font-bold">Ghana</span> +233 (0) 249 507 413</span></a>
                    <span aria-hidden="true">&middot;</span>
                    <a href="tel:+18886462266" class="inline-flex items-center gap-1 font-semibold hover:text-ink/70 transition-colors">
                        <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M6.62 10.79a15.53 15.53 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.02-.24 11.36 11.36 0 0 0 3.57.57 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.57a1 1 0 0 1-.25 1.02l-2.2 2.2z"/>
                        </svg>
                        <span><span class="font-bold">USA</span> +1 888 646 2266</span></a>
                </div>
            </div>

            {{-- Message column --}}
            <div class="flex flex-wrap items-center justify-center gap-x-2 gap-y-1">
                <span>Every booking includes a professional driver</span>
                <span aria-hidden="true">&middot;</span>
                <a href="{{ $whatsappUrl }}"
                    class="font-semibold underline underline-offset-2 hover:text-ink/70 transition-colors">Book via
                    WhatsApp &rarr;</a>
            </div>

        </div>
    </div>

    <div class="container-page">
        <div class="flex h-14 items-center justify-between lg:h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 shrink-0 leading-none">
                <img src="{{ asset('images/uprise-logo.png') }}" alt="Uprise Travel" class="h-9 w-auto shrink-0">
                <span class="flex flex-col leading-none gap-0.5">
                    <span class="font-display font-bold text-white text-xl tracking-tight leading-none">
                        UPRISE TRAVEL
                    </span>
                    <span class="flex justify-between w-full text-accent text-[8px] font-semibold uppercase leading-none">
                        <span>C</span><span>A</span><span>R</span><span>R</span><span>E</span><span>N</span><span>T</span><span>A</span><span>L</span><span>S</span>
                    </span>
                </span>
            </a>

            {{-- Desktop nav --}}
            <nav class="hidden lg:flex items-center gap-8" aria-label="Main navigation">
                @foreach ($nav as $item)
                    @if (isset($item['children']))
                        <div class="relative" x-data="{ drop: false }" @mouseenter="drop = true"
                            @mouseleave="drop = false">
                            <button @click="drop = !drop"
                                class="flex items-center gap-1 text-sm font-medium text-stone-soft hover:text-white transition-colors duration-150 tracking-wide"
                                :aria-expanded="drop">
                                {{ $item['label'] }}
                                <svg class="w-3 h-3 transition-transform duration-200" :class="drop ? 'rotate-180' : ''"
                                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="drop" x-transition:enter="transition ease-out duration-150"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-100"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-1"
                                class="absolute top-full left-1/2 -translate-x-1/2 mt-3 w-60 bg-charcoal border border-charcoal-soft rounded-md shadow-lg py-1.5 z-50">
                                @foreach ($item['children'] as $child)
                                    <a href="{{ $child['href'] }}"
                                        class="block px-4 py-2.5 text-sm text-stone-soft hover:text-white hover:bg-charcoal-soft transition-colors duration-150">
                                        {{ $child['label'] }}
                                    </a>
                                @endforeach
                                <div class="border-t border-charcoal-soft mt-1.5 pt-1.5">
                                    <a href="{{ $item['href'] }}"
                                        class="block px-4 py-2.5 text-sm text-accent font-semibold hover:text-accent-soft transition-colors duration-150">
                                        View All Services &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ $item['href'] }}"
                            class="text-sm font-medium text-stone-soft hover:text-white transition-colors duration-150 tracking-wide">
                            {{ $item['label'] }}
                        </a>
                    @endif
                @endforeach
            </nav>

            {{-- Desktop CTA --}}
            <div class="hidden lg:flex items-center gap-4">
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener"
                    class="inline-flex items-center gap-2 bg-accent text-white text-sm font-semibold px-5 py-2.5 rounded-sm hover:bg-accent-soft transition-colors duration-200 tracking-wide">
                    {{-- WhatsApp icon --}}
                    <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                    Book Now
                </a>
            </div>

            {{-- Mobile hamburger --}}
            <button @click="open = !open" class="lg:hidden p-2 text-stone-soft hover:text-white transition-colors"
                :aria-expanded="open" aria-label="Toggle navigation">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                </svg>
                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

        </div>
    </div>

    {{-- Mobile full-screen menu --}}
    <template x-teleport="body">
        <div x-show="open" x-cloak
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[80] flex flex-col bg-ink lg:hidden" role="dialog" aria-modal="true"
            aria-label="Site menu">

            {{-- Top bar --}}
            <div class="flex h-16 shrink-0 items-center justify-between border-b border-charcoal-soft px-6">
                <a href="{{ route('home') }}" @click="open = false"
                    class="flex items-center gap-2.5 leading-none">
                    <img src="{{ asset('images/uprise-logo.png') }}" alt="Uprise Travel" class="h-9 w-auto shrink-0">
                    <span class="flex flex-col leading-none gap-0.5">
                        <span class="font-display font-bold text-white text-xl tracking-tight leading-none">
                            UPRISE TRAVEL
                        </span>
                        <span class="flex justify-between w-full text-accent text-[8px] font-semibold uppercase leading-none">
                            <span>C</span><span>A</span><span>R</span><span>R</span><span>E</span><span>N</span><span>T</span><span>A</span><span>L</span><span>S</span>
                        </span>
                    </span>
                </a>
                <button @click="open = false" class="-mr-2 p-2 text-stone-soft hover:text-white transition-colors"
                    aria-label="Close menu">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Nav --}}
            <nav class="flex-1 overflow-y-auto px-6 py-8" aria-label="Mobile navigation"
                x-show="open"
                x-transition:enter="transition ease-out duration-300 delay-100"
                x-transition:enter-start="opacity-0 translate-y-3" x-transition:enter-end="opacity-100 translate-y-0">
                @foreach ($nav as $item)
                    @if (isset($item['children']))
                        <div x-data="{ expanded: false }" class="border-b border-charcoal-soft/60">
                            <button @click="expanded = !expanded"
                                class="flex w-full items-center justify-between py-5 text-2xl font-display font-semibold text-white"
                                :aria-expanded="expanded">
                                {{ $item['label'] }}
                                <svg class="w-5 h-5 text-stone-soft transition-transform duration-200"
                                    :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="expanded" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 -translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0" class="pb-4 pl-1">
                                @foreach ($item['children'] as $child)
                                    <a href="{{ $child['href'] }}" @click="open = false"
                                        class="block py-2.5 text-base text-stone-soft hover:text-white transition-colors">
                                        {{ $child['label'] }}
                                    </a>
                                @endforeach
                                <a href="{{ $item['href'] }}" @click="open = false"
                                    class="block py-2.5 text-base font-semibold text-accent hover:text-accent-soft transition-colors">
                                    View All Services &rarr;
                                </a>
                            </div>
                        </div>
                    @else
                        <a href="{{ $item['href'] }}" @click="open = false"
                            class="block border-b border-charcoal-soft/60 py-5 text-2xl font-display font-semibold text-white hover:text-accent-soft transition-colors">
                            {{ $item['label'] }}
                        </a>
                    @endif
                @endforeach
            </nav>

            {{-- Footer CTA + contacts --}}
            <div class="shrink-0 space-y-4 border-t border-charcoal-soft px-6 py-6">
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener"
                    class="flex w-full items-center justify-center gap-2 rounded-sm bg-accent px-5 py-4 text-sm font-semibold text-white hover:bg-accent-soft transition-colors">
                    <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                    Book via WhatsApp
                </a>
                <div class="flex items-center justify-center gap-3 text-xs text-stone-soft">
                    <a href="tel:+233249507413" class="hover:text-white transition-colors">
                        <span class="font-semibold text-white">Ghana</span> +233 249 507 413</a>
                    <span aria-hidden="true">&middot;</span>
                    <a href="tel:+18886462266" class="hover:text-white transition-colors">
                        <span class="font-semibold text-white">USA</span> +1 888 646 2266</a>
                </div>
            </div>

        </div>
    </template>
</header>

{{-- Spacer so content doesn't hide behind fixed header (nav h-14/h-16 + bar ~33px) --}}
<div class="h-20.25 lg:h-22.25 bg-ink"></div>
