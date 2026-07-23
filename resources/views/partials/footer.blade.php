@php
    $whatsappUrl =
        'https://wa.me/' .
        config('uprise.whatsapp.number') .
        '?text=' .
        urlencode(config('uprise.whatsapp.default_message'));
    $contact = config('uprise.contact');
    $social = config('uprise.social');
    $quickLinks = [
        ['label' => 'Fleet', 'href' => route('fleet.index')],
        ['label' => 'Services', 'href' => route('services.index')],
        ['label' => 'About', 'href' => route('about')],
        ['label' => 'Contact', 'href' => route('contact')],
        ['label' => 'FAQs', 'href' => route('faq')],
    ];
    $serviceLinks = [
        ['label' => 'Accra Car Rentals', 'href' => route('services.show', 'accra-car-rentals')],
        ['label' => 'Tamale Car Rentals', 'href' => route('services.show', 'tamale-car-rentals')],
        ['label' => 'Mole National Park', 'href' => route('services.show', 'mole-national-park')],
        ['label' => 'Cape Coast Car Rentals', 'href' => route('services.show', 'cape-coast-car-rentals')],
        ['label' => 'Kumasi Car Rentals', 'href' => route('services.show', 'kumasi-car-rentals')],
        ['label' => 'Ghana Car Rentals', 'href' => route('services.show', 'ghana-car-rentals')],
    ];
@endphp

<footer class="bg-ink border-t border-charcoal-soft">

    {{-- Main footer grid --}}
    <div class="container-page py-16 lg:py-20">
        <div class="grid grid-cols-1 gap-12 md:grid-cols-2 lg:grid-cols-4">

            {{-- Brand column --}}
            <div class="lg:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 mb-4 leading-none">
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
                <p class="text-stone text-sm leading-relaxed mb-4">
                    {{ config('uprise.brand.tagline') }}
                </p>
                <p class="text-stone-soft text-xs leading-relaxed mb-6">
                    Part of
                    <a href="{{ config('uprise.brand.parent_url') }}" target="_blank" rel="noopener"
                        class="text-stone underline underline-offset-2 hover:text-white transition-colors">{{ config('uprise.brand.parent_name') }}</a>
                    — {{ config('uprise.brand.parent_blurb') }}.
                </p>
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener"
                    class="btn-shimmer inline-flex items-center gap-2 bg-white text-ink text-xs font-semibold px-4 py-2.5 rounded-lg hover:bg-ink hover:text-white transition-colors duration-200 tracking-wide">
                    Book via WhatsApp
                </a>
            </div>

            {{-- Quick links --}}
            <div>
                <h3 class="text-white text-xs font-semibold tracking-[0.15em] uppercase mb-5">Quick Links</h3>
                <ul class="space-y-3">
                    @foreach ($quickLinks as $link)
                        <li>
                            <a href="{{ $link['href'] }}"
                                class="text-stone text-sm hover:text-white transition-colors duration-150">
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                    <li>
                        <a href="{{ asset('documents/uprise-rental-agreement.docx') }}" download
                            class="text-stone text-sm hover:text-white transition-colors duration-150">
                            Rental Agreement
                        </a>
                    </li>
                </ul>
                <p class="mt-1 text-stone-soft text-xs leading-relaxed">
                    Download, complete and return via
                    <a href="mailto:{{ $contact['email'] }}"
                        class="underline underline-offset-2 hover:text-white transition-colors">email</a>
                    or
                    <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener"
                        class="underline underline-offset-2 hover:text-white transition-colors">WhatsApp</a>.
                </p>
            </div>

            {{-- Services links --}}
            <div>
                <h3 class="text-white text-xs font-semibold tracking-[0.15em] uppercase mb-5">Services</h3>
                <ul class="space-y-3">
                    @foreach ($serviceLinks as $link)
                        <li>
                            <a href="{{ $link['href'] }}"
                                class="text-stone text-sm hover:text-white transition-colors duration-150">
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h3 class="text-white text-xs font-semibold tracking-[0.15em] uppercase mb-5">Contact</h3>
                <ul class="space-y-3 text-sm text-stone">
                    <li>
                        <span class="text-stone-soft text-xs tracking-wide">Ghana</span><br>
                        <a href="tel:{{ $contact['phone_e164'] }}"
                            class="hover:text-white transition-colors duration-150">
                            {{ $contact['phone'] }}
                        </a>
                    </li>
                    @if (config('uprise.contact.phone_us'))
                        <li>
                            <span class="text-stone-soft text-xs tracking-wide">USA</span><br>
                            <a href="tel:+18886462266" class="hover:text-white transition-colors duration-150">
                                {{ config('uprise.contact.phone_us') }}
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="mailto:{{ $contact['email'] }}"
                            class="hover:text-white transition-colors duration-150">
                            {{ $contact['email'] }}
                        </a>
                    </li>
                    @foreach ($contact['locations'] as $location)
                        <li class="leading-relaxed">
                            <span class="text-stone-soft text-xs tracking-wide">{{ $location['label'] }}</span><br>
                            {{ $location['street'] }}<br>
                            {{ $location['city'] }}, {{ $location['country'] }}
                        </li>
                    @endforeach
                    <li class="text-stone-soft">{{ $contact['hours'] }}</li>
                </ul>

                {{-- Social links --}}
                @if (array_filter($social))
                    <div class="flex gap-4 mt-6">
                        @if ($social['instagram'])
                            <a href="{{ $social['instagram'] }}" target="_blank" rel="noopener"
                                class="text-stone hover:text-white transition-colors text-xs font-semibold tracking-wide uppercase">IG</a>
                        @endif
                        @if ($social['facebook'])
                            <a href="{{ $social['facebook'] }}" target="_blank" rel="noopener"
                                class="text-stone hover:text-white transition-colors text-xs font-semibold tracking-wide uppercase">FB</a>
                        @endif
                        @if ($social['linkedin'])
                            <a href="{{ $social['linkedin'] }}" target="_blank" rel="noopener"
                                class="text-stone hover:text-white transition-colors text-xs font-semibold tracking-wide uppercase">LI</a>
                        @endif
                        @if ($social['tiktok'])
                            <a href="{{ $social['tiktok'] }}" target="_blank" rel="noopener"
                                class="text-stone hover:text-white transition-colors text-xs font-semibold tracking-wide uppercase">TT</a>
                        @endif
                    </div>
                @endif
            </div>

        </div>
    </div>

    {{-- Bottom bar --}}
    <div class="border-t border-charcoal-soft">
        <div
            class="container-page py-5 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-stone">
            <p>&copy; {{ date('Y') }} {{ config('uprise.brand.legal_name') }}. All rights reserved.</p>
            <div class="flex gap-5">
                <a href="{{ route('privacy') }}" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="{{ route('terms') }}" class="hover:text-white transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>

</footer>
