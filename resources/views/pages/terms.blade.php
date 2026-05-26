@extends('layouts.app')

@php
    $title = 'Terms of Service | Uprise Travel';
    $metaDescription = 'Terms of Service for Uprise Travel — Ghana car hire and chauffeur service. Booking conditions, cancellation policy, and service terms.';
@endphp

@section('content')

    {{-- PAGE HEADER --}}
    <section class="bg-ink-deep border-b border-charcoal-soft">
        <div class="container-page py-14 lg:py-20">
            <nav class="flex items-center gap-2 text-xs text-stone mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span>/</span>
                <span class="text-stone-soft">Terms of Service</span>
            </nav>
            <p class="eyebrow text-accent mb-3">Legal</p>
            <h1 class="font-display font-bold text-white tracking-tight mb-4
                        text-[2rem] sm:text-[2.75rem] lg:text-[3.25rem]">
                Terms of Service
            </h1>
            <p class="text-stone-soft text-sm">Last updated: {{ date('F Y') }}</p>
        </div>
    </section>

    {{-- CONTENT --}}
    <section class="bg-bone py-14 lg:py-20">
        <div class="container-page">
            <div class="max-w-3xl mx-auto prose prose-stone prose-sm sm:prose">

                <p>By booking or using services provided by Uprise Travel ("we", "us", "our"), you agree to the following terms and conditions. Please read them carefully.</p>

                <h2>1. Services</h2>
                <p>Uprise Travel provides driver-included car hire and chauffeur services in Ghana and cross-border to neighbouring countries. <strong>All bookings include a professional driver — we do not offer self-drive rentals.</strong></p>

                <h2>2. Bookings & Confirmation</h2>
                <ul>
                    <li>Bookings are accepted via WhatsApp, our website contact form, or HubSpot booking forms.</li>
                    <li>A booking is confirmed only when you receive a written confirmation from us via WhatsApp or email.</li>
                    <li>We reserve the right to decline bookings at our discretion.</li>
                </ul>

                <h2>3. Pricing & Payment</h2>
                <ul>
                    <li>All prices are quoted in Ghanaian Cedis (GHS) or US Dollars (USD) as agreed.</li>
                    <li>Quotes are inclusive of driver, fuel, and tolls unless otherwise stated.</li>
                    <li>Prices are confirmed at the time of booking and are subject to change before confirmation.</li>
                    <li>Payment terms will be specified at the time of booking. A deposit may be required to secure your reservation.</li>
                </ul>

                <h2>4. Cancellations & Refunds</h2>
                <ul>
                    <li><strong>More than 48 hours notice:</strong> Full refund of any deposit paid.</li>
                    <li><strong>24–48 hours notice:</strong> 50% of the booking value may be retained.</li>
                    <li><strong>Less than 24 hours notice:</strong> No refund. Full payment may be due.</li>
                    <li>Cancellations must be communicated in writing via WhatsApp or email.</li>
                    <li>In the event that Uprise Travel cancels your booking, a full refund will be issued.</li>
                </ul>

                <h2>5. Driver Policy</h2>
                <ul>
                    <li>All drivers are vetted, licensed, and professionally trained.</li>
                    <li>Drivers operate at all times in accordance with Ghanaian traffic laws.</li>
                    <li>Clients must not request drivers to violate traffic laws or engage in unsafe practices.</li>
                    <li>Uprise Travel reserves the right to substitute any driver without notice.</li>
                </ul>

                <h2>6. Passenger Conduct</h2>
                <p>Passengers are expected to treat drivers and vehicles with respect. Uprise Travel reserves the right to terminate a journey without refund if a passenger behaves in a manner that endangers the driver or damages the vehicle.</p>

                <h2>7. Liability</h2>
                <ul>
                    <li>Uprise Travel maintains appropriate vehicle insurance for all journeys.</li>
                    <li>We are not liable for delays caused by traffic, road conditions, weather, or circumstances beyond our control.</li>
                    <li>We are not responsible for loss or damage to personal belongings left in vehicles.</li>
                    <li>Our liability is limited to the value of the booked service.</li>
                </ul>

                <h2>8. Cross-Border Travel</h2>
                <p>Cross-border journeys to Togo, Benin, and other countries are subject to border regulations, documentation requirements, and conditions beyond our control. The client is responsible for ensuring valid travel documents. Uprise Travel will assist with logistics but cannot guarantee border crossing times or outcomes.</p>

                <h2>9. Changes to These Terms</h2>
                <p>We reserve the right to update these Terms of Service at any time. Continued use of our services constitutes acceptance of the updated terms.</p>

                <h2>10. Governing Law</h2>
                <p>These Terms of Service are governed by the laws of the Republic of Ghana. Any disputes will be subject to the exclusive jurisdiction of the courts of Ghana.</p>

                <h2>11. Contact Us</h2>
                <p>For questions about these terms, contact us:</p>
                <ul>
                    <li>Email: <a href="mailto:{{ config('uprise.contact.email') }}">{{ config('uprise.contact.email') }}</a></li>
                    <li>Phone: {{ config('uprise.contact.phone') }}</li>
                </ul>

            </div>
        </div>
    </section>

@endsection
