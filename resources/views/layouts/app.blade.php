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
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    {{-- JSON-LD: LocalBusiness --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "LocalBusiness",
        "name": "{{ config('uprise.brand.name') }}",
        "description": "{{ config('uprise.brand.short_tagline') }}",
        "url": "{{ config('app.url') }}",
        "telephone": "{{ config('uprise.contact.phone_e164') }}",
        "email": "{{ config('uprise.contact.email') }}",
        "image": "{{ asset('images/og-default.jpg') }}",
        "address": {
            "@@type": "PostalAddress",
            "streetAddress": "{{ config('uprise.contact.address.street') }}",
            "addressLocality": "{{ config('uprise.contact.address.city') }}",
            "addressRegion": "{{ config('uprise.contact.address.region') }}",
            "addressCountry": "{{ config('uprise.contact.address.country_code') }}"
        },
        "geo": {
            "@@type": "GeoCoordinates",
            "latitude": "5.6037",
            "longitude": "-0.1870"
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
        "sameAs": [
            "{{ config('uprise.social.instagram') }}",
            "{{ config('uprise.social.facebook') }}"
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

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>

</html>
