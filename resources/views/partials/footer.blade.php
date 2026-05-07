@php
    $whatsappUrl =
        'https://wa.me/' .
        config('uprise.whatsapp.number') .
        '?text=' .
        urlencode(config('uprise.whatsapp.default_message'));
    $contact = config('uprise.contact');
    $social = config('uprise.social');
    $quickLinks = [
        ['label' => 'Fleet', 'href' => '/fleet'],
        ['label' => 'Services', 'href' => '/services'],
        ['label' => 'About', 'href' => '/about'],
        ['label' => 'Contact', 'href' => '/contact'],
        ['label' => 'FAQs', 'href' => '/faqs'],
    ];
    $serviceLinks = [
        ['label' => 'Airport Transfer', 'href' => '/services/airport-transfer'],
        ['label' => 'Executive Chauffeur', 'href' => '/services/executive-chauffeur'],
        ['label' => 'Corporate Travel', 'href' => '/services/corporate-travel'],
        ['label' => 'Safari & Wildlife', 'href' => '/services/safari-wildlife'],
        ['label' => 'Wedding Car', 'href' => '/services/wedding-car'],
        ['label' => 'Cross-Border', 'href' => '/services/cross-border-travel'],
    ];
@endphp

<footer class="bg-ink border-t border-charcoal-soft">

    {{-- Main footer grid --}}
    <div class="container-page py-16 lg:py-20">
        <div class="grid grid-cols-1 gap-12 md:grid-cols-2 lg:grid-cols-4">

            {{-- Brand column --}}
            <div class="lg:col-span-1">
                <a href="{{ route('home') }}" class="inline-block mb-4">
                    <span class="font-display font-bold text-white text-2xl tracking-tight">UPRISE</span>
                </a>
                <p class="text-stone text-sm leading-relaxed mb-6">
                    {{ config('uprise.brand.tagline') }}
                </p>
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener"
                    class="inline-flex items-center gap-2 border border-gold text-gold text-xs font-semibold px-4 py-2.5 rounded-sm hover:bg-gold hover:text-ink transition-colors duration-200 tracking-wide">
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
                </ul>
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
                            <a href="tel:{{ config('uprise.contact.phone_us') }}"
                                class="hover:text-white transition-colors duration-150">
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
                    <li class="leading-relaxed">
                        {{ $contact['address']['street'] }}<br>
                        {{ $contact['address']['city'] }}, {{ $contact['address']['country'] }}
                    </li>
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
                <a href="/privacy" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="/terms" class="hover:text-white transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>

</footer>
