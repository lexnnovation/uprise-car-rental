@extends('layouts.app')

@php
    $title = 'Uprise Travel Car Rentals | Privacy Policy';
    $metaDescription = 'Privacy Policy for Uprise Travel Car Rentals — Ghana car hire and rental service. How we collect, use and protect your personal information.';
@endphp

@section('content')

    {{-- PAGE HEADER --}}
    <section class="bg-ink-deep border-b border-charcoal-soft">
        <div class="container-page py-14 lg:py-20">
            <nav class="flex items-center gap-2 text-xs text-stone mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span>/</span>
                <span class="text-stone-soft">Privacy Policy</span>
            </nav>
            <p class="eyebrow text-accent mb-3">Legal</p>
            <h1 class="font-display font-bold text-white tracking-tight mb-4
                        text-[2rem] sm:text-[2.75rem] lg:text-[3.25rem]">
                Privacy Policy
            </h1>
            <p class="text-stone-soft text-sm">Last updated: {{ date('F Y') }}</p>
        </div>
    </section>

    {{-- CONTENT --}}
    <section class="bg-bone py-14 lg:py-20">
        <div class="container-page">
            <div class="max-w-3xl mx-auto prose prose-stone prose-sm sm:prose">

                <p>Uprise Travel ("we", "us", "our") operates the website <strong>uprisetravelgh.com</strong> and provides car hire and car rental services in Ghana. This Privacy Policy explains how we collect, use, and protect information you provide when using our website or booking services.</p>

                <h2>1. Information We Collect</h2>
                <p>We collect information you provide directly to us, including:</p>
                <ul>
                    <li>Name, email address, and phone number submitted via our contact or booking forms</li>
                    <li>Travel details including pickup locations, destinations, and dates</li>
                    <li>Messages sent to us via WhatsApp or email</li>
                    <li>Basic usage data collected automatically (pages visited, browser type, device type)</li>
                </ul>

                <h2>2. How We Use Your Information</h2>
                <p>We use your information solely to:</p>
                <ul>
                    <li>Respond to your booking enquiries and confirm reservations</li>
                    <li>Coordinate your transportation arrangements</li>
                    <li>Contact you regarding your booking or follow up after your journey</li>
                    <li>Improve the quality of our service</li>
                </ul>
                <p>We do not sell, rent, or share your personal information with third parties for marketing purposes.</p>

                <h2>3. WhatsApp Communication</h2>
                <p>When you contact us via WhatsApp, your phone number and message content are visible to our team. WhatsApp conversations are subject to WhatsApp's own privacy policy in addition to this policy. We use WhatsApp exclusively for booking and customer communication purposes.</p>

                <h2>4. HubSpot Forms</h2>
                <p>Our booking forms are powered by HubSpot CRM. When you submit a form, your information is stored securely in HubSpot and accessible only to the Uprise Travel team. HubSpot's privacy policy applies to data processed through their platform.</p>

                <h2>5. Cookies</h2>
                <p>Our website may use basic cookies to improve your browsing experience. These cookies do not collect personally identifiable information. You can disable cookies in your browser settings at any time.</p>

                <h2>6. Data Retention</h2>
                <p>We retain your information for as long as necessary to provide our services and comply with legal obligations. If you would like us to delete your data, please contact us at <a href="mailto:{{ config('uprise.contact.email') }}">{{ config('uprise.contact.email') }}</a>.</p>

                <h2>7. Your Rights</h2>
                <p>You have the right to:</p>
                <ul>
                    <li>Request access to the personal data we hold about you</li>
                    <li>Request correction or deletion of your data</li>
                    <li>Withdraw consent for us to contact you at any time</li>
                </ul>

                <h2>8. Security</h2>
                <p>We take reasonable precautions to protect your information. However, no method of transmission over the internet is 100% secure, and we cannot guarantee absolute security.</p>

                <h2>9. Governing Law</h2>
                <p>This Privacy Policy is governed by the laws of the Republic of Ghana.</p>

                <h2>10. Contact Us</h2>
                <p>If you have any questions about this Privacy Policy, please contact us:</p>
                <ul>
                    <li>Email: <a href="mailto:{{ config('uprise.contact.email') }}">{{ config('uprise.contact.email') }}</a></li>
                    <li>Phone: {{ config('uprise.contact.phone') }}</li>
                    <li>Address: {{ config('uprise.contact.address.street') }}, {{ config('uprise.contact.address.city') }}, {{ config('uprise.contact.address.country') }}</li>
                </ul>

            </div>
        </div>
    </section>

@endsection
