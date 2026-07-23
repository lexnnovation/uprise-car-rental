<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#000000">

    <title>{{ $title ?? config('app.name') }}</title>
    @isset($metaDescription)
        <meta name="description" content="{{ $metaDescription }}">
    @endisset

    {{-- Canonical --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    @php
        $ogImage = $ogImage ?? (config('uprise.seo.default_og_image') ?? asset('images/og-default.jpg'));
    @endphp
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $title ?? config('app.name') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $ogImage }}">
    @isset($metaDescription)
        <meta property="og:description" content="{{ $metaDescription }}">
    @endisset

    {{-- Twitter / X card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? config('app.name') }}">
    <meta name="twitter:image" content="{{ $ogImage }}">
    @isset($metaDescription)
        <meta name="twitter:description" content="{{ $metaDescription }}">
    @endisset

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="/favicon.png">

    {{-- JSON-LD: WebSite --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "WebSite",
        "name": "{{ config('uprise.brand.name') }}",
        "url": "{{ config('app.url') }}"
    }
    </script>

    {{-- JSON-LD: LocalBusiness (one entry per physical location) --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@graph": [
            @foreach (config('uprise.contact.locations') as $key => $location)
            {
                "@@type": "LocalBusiness",
                "@@id": "{{ config('app.url') }}/#{{ $key }}",
                "name": "{{ config('uprise.brand.name') }} — {{ $location['label'] }}",
                "description": "{{ config('uprise.brand.short_tagline') }}",
                "url": "{{ config('app.url') }}",
                "telephone": "{{ config('uprise.contact.phone_e164') }}",
                "email": "{{ config('uprise.contact.email') }}",
                "image": "{{ asset('images/og-default.jpg') }}",
                "address": {
                    "@@type": "PostalAddress",
                    "streetAddress": "{{ $location['street'] }}",
                    "addressLocality": "{{ $location['city'] }}",
                    "addressRegion": "{{ $location['region'] }}",
                    "addressCountry": "{{ $location['country_code'] }}"
                },
                "openingHours": "Mo-Su 00:00-24:00",
                "areaServed": [
                    { "@@type": "City", "name": "Accra" },
                    { "@@type": "City", "name": "Tamale" },
                    { "@@type": "TouristAttraction", "name": "Mole National Park" },
                    { "@@type": "City", "name": "Cape Coast" },
                    { "@@type": "City", "name": "Kumasi" },
                    { "@@type": "Country", "name": "Ghana" }
                ],
                "priceRange": "$$",
                "parentOrganization": {
                    "@@type": "Organization",
                    "name": "{{ config('uprise.brand.parent_name') }}",
                    "url": "{{ config('uprise.brand.parent_url') }}"
                },
                "sameAs": [
                    "{{ config('uprise.social.instagram') }}",
                    "{{ config('uprise.social.facebook') }}",
                    "{{ config('uprise.brand.parent_url') }}"
                ]
            }@if (!$loop->last),@endif
            @endforeach
        ]
    }
    </script>

    {{-- Bunny Fonts: Inter (body) + Manrope (display) --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600|manrope:500,600,700,800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')
</head>

<body class="antialiased">

    <a href="#main-content"
        class="sr-only focus:not-sr-only focus:absolute focus:z-[100] focus:top-4 focus:left-4 focus:bg-white focus:text-ink focus:px-4 focus:py-2.5 focus:rounded-sm focus:font-semibold focus:text-sm">
        Skip to main content
    </a>

    @include('partials.header')

    <main id="main-content" tabindex="-1">
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>

</html>
