@extends('layouts.app')

@php
    $title = 'Contact & Booking Enquiry | Uprise Travel';
    $metaDescription =
        'Get in touch with Uprise Travel to book a car with driver in Ghana. Covering Accra, Cape Coast, Kumasi, Mole, Tamale and more. Cross-border to Togo & Benin available.';
@endphp

@section('content')

    {{-- PAGE HEADER --}}
    <section class="bg-ink-deep border-b border-charcoal-soft">
        <div class="container-page py-14 lg:py-20">
            <nav class="flex items-center gap-2 text-xs text-stone mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span>/</span>
                <span class="text-stone-soft">Contact</span>
            </nav>
            <p class="eyebrow text-accent mb-3">Get in Touch</p>
            <h1
                class="font-display font-bold text-white tracking-tight mb-4 text-[2rem] sm:text-[2.75rem] lg:text-[3.25rem]">
                Plan your journey with us.
            </h1>
            <p class="text-stone-soft text-base max-w-xl leading-relaxed">
                Tell us where you're going and when — we'll take care of the rest.
                All bookings include a professional driver.
            </p>
        </div>
    </section>

    {{-- MAIN --}}
    <section class="bg-bone py-14 lg:py-20">
        <div class="container-page">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-16">

                {{-- FORM --}}
                <div class="lg:col-span-2">

                    @if ($success)
                        <div class="mb-8 flex items-start gap-4 bg-accent/10 border border-accent/30 rounded-md p-5">
                            <svg class="w-5 h-5 text-accent shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="font-semibold text-ink text-sm mb-1">Enquiry received — thank you!</p>
                                <p class="text-stone text-sm">We'll be in touch within a few hours. For faster response,
                                    message us on WhatsApp.</p>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
                            <ul class="text-red-700 text-sm space-y-1 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6" novalidate>
                        @csrf

                        {{-- Name + Email --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="full_name" class="block text-xs font-semibold text-ink tracking-wide mb-1.5">
                                    Full Name <span class="text-accent">*</span>
                                </label>
                                <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}"
                                    placeholder="Your full name" required
                                    class="w-full bg-white border rounded-sm px-4 py-2.5 text-sm text-ink placeholder-stone-soft
                                           focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition
                                           @error('full_name') border-red-400 @else border-mist @enderror">
                            </div>
                            <div>
                                <label for="email" class="block text-xs font-semibold text-ink tracking-wide mb-1.5">
                                    Email Address <span class="text-accent">*</span>
                                </label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    placeholder="you@example.com" required
                                    class="w-full bg-white border rounded-sm px-4 py-2.5 text-sm text-ink placeholder-stone-soft
                                           focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition
                                           @error('email') border-red-400 @else border-mist @enderror">
                            </div>
                        </div>

                        {{-- Phone + Passengers --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="phone" class="block text-xs font-semibold text-ink tracking-wide mb-1.5">
                                    Phone Number
                                </label>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                    placeholder="+1 000 000 0000"
                                    class="w-full bg-white border border-mist rounded-sm px-4 py-2.5 text-sm text-ink placeholder-stone-soft
                                           focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition">
                            </div>
                            <div>
                                <label for="passenger_count"
                                    class="block text-xs font-semibold text-ink tracking-wide mb-1.5">
                                    Number of Passengers <span class="text-accent">*</span>
                                </label>
                                <input type="number" id="passenger_count" name="passenger_count"
                                    value="{{ old('passenger_count', 1) }}" min="1" max="50" required
                                    class="w-full bg-white border rounded-sm px-4 py-2.5 text-sm text-ink
                                           focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition
                                           @error('passenger_count') border-red-400 @else border-mist @enderror">
                            </div>
                        </div>

                        {{-- Pickup + Destination --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="pickup_location"
                                    class="block text-xs font-semibold text-ink tracking-wide mb-1.5">
                                    Pickup Location <span class="text-accent">*</span>
                                </label>
                                <input type="text" id="pickup_location" name="pickup_location"
                                    value="{{ old('pickup_location') }}" placeholder="e.g. Kotoka International Airport"
                                    required
                                    class="w-full bg-white border rounded-sm px-4 py-2.5 text-sm text-ink placeholder-stone-soft
                                           focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition
                                           @error('pickup_location') border-red-400 @else border-mist @enderror">
                            </div>
                            <div>
                                <label for="destination" class="block text-xs font-semibold text-ink tracking-wide mb-1.5">
                                    Destination
                                </label>
                                <input type="text" id="destination" name="destination" value="{{ old('destination') }}"
                                    placeholder="e.g. Cape Coast, Mole NP, Lomé"
                                    class="w-full bg-white border border-mist rounded-sm px-4 py-2.5 text-sm text-ink placeholder-stone-soft
                                           focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition">
                            </div>
                        </div>

                        {{-- Dates --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="travel_date_start"
                                    class="block text-xs font-semibold text-ink tracking-wide mb-1.5">
                                    Travel Date <span class="text-accent">*</span>
                                </label>
                                <input type="date" id="travel_date_start" name="travel_date_start"
                                    value="{{ old('travel_date_start') }}" min="{{ date('Y-m-d') }}" required
                                    class="w-full bg-white border rounded-sm px-4 py-2.5 text-sm text-ink
                                           focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition
                                           @error('travel_date_start') border-red-400 @else border-mist @enderror">
                            </div>
                            <div>
                                <label for="travel_date_end"
                                    class="block text-xs font-semibold text-ink tracking-wide mb-1.5">
                                    Return / End Date
                                </label>
                                <input type="date" id="travel_date_end" name="travel_date_end"
                                    value="{{ old('travel_date_end') }}" min="{{ date('Y-m-d') }}"
                                    class="w-full bg-white border border-mist rounded-sm px-4 py-2.5 text-sm text-ink
                                           focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition">
                            </div>
                        </div>

                        {{-- Service + Vehicle --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="service_id" class="block text-xs font-semibold text-ink tracking-wide mb-1.5">
                                    Service Type
                                </label>
                                <select id="service_id" name="service_id"
                                    class="w-full bg-white border border-mist rounded-sm px-4 py-2.5 text-sm text-ink
                                           focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition">
                                    <option value="">— Select a service —</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}"
                                            {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                            {{ $service->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="vehicle_id" class="block text-xs font-semibold text-ink tracking-wide mb-1.5">
                                    Preferred Vehicle
                                </label>
                                <select id="vehicle_id" name="vehicle_id"
                                    class="w-full bg-white border border-mist rounded-sm px-4 py-2.5 text-sm text-ink
                                           focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition">
                                    <option value="">— No preference —</option>
                                    @foreach ($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}"
                                            {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                            {{ $vehicle->category->name ?? '' }} — {{ $vehicle->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Notes --}}
                        <div>
                            <label for="notes" class="block text-xs font-semibold text-ink tracking-wide mb-1.5">
                                Additional Notes
                            </label>
                            <textarea id="notes" name="notes" rows="4"
                                placeholder="Any special requirements, flight number, hotel, or extra stops…"
                                class="w-full bg-white border border-mist rounded-sm px-4 py-2.5 text-sm text-ink placeholder-stone-soft
                                       focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition resize-none">{{ old('notes') }}</textarea>
                        </div>

                        {{-- Submit --}}
                        <div class="flex items-center gap-4 pt-2">
                            <button type="submit"
                                class="inline-flex items-center gap-2.5 bg-accent text-white font-semibold
                                       text-sm px-8 py-3.5 rounded-sm hover:bg-accent-soft active:bg-accent-deep
                                       transition-colors duration-150 tracking-wide">
                                Send Enquiry
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </button>
                            <p class="text-xs text-stone">We respond within a few hours.</p>
                        </div>

                    </form>
                </div>

                {{-- SIDEBAR --}}
                <div class="lg:col-span-1">
                    <div class="sticky top-28 space-y-5">

                        {{-- WhatsApp --}}
                        <div class="bg-ink rounded-md p-6">
                            <p class="eyebrow text-accent mb-3">Faster response</p>
                            <p class="text-white font-semibold text-sm mb-4">Message us directly on WhatsApp for same-day
                                confirmation.</p>
                            <a href="{{ 'https://wa.me/' . config('uprise.whatsapp.number') . '?text=' . urlencode(config('uprise.whatsapp.default_message')) }}"
                                target="_blank" rel="noopener"
                                class="w-full inline-flex items-center justify-center gap-2.5 bg-accent text-white font-semibold
                                      text-sm px-5 py-3 rounded-sm hover:bg-accent-soft transition-colors duration-150 tracking-wide">
                                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="currentColor"
                                    aria-hidden="true">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                                Open WhatsApp
                            </a>
                        </div>

                        {{-- Contact details --}}
                        <div class="bg-white rounded-md p-5 shadow-card space-y-4">
                            <p class="eyebrow text-stone mb-1">Contact Details</p>

                            <div class="flex items-start gap-3 text-sm">
                                <svg class="w-4 h-4 text-accent shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                    stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                                <div>
                                    <a href="tel:{{ config('uprise.contact.phone_e164') }}"
                                        class="block text-ink hover:text-accent transition-colors font-medium">
                                        {{ config('uprise.contact.phone') }}
                                    </a>
                                    <span class="text-stone text-xs">Ghana · {{ config('uprise.contact.hours') }}</span>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 text-sm">
                                <svg class="w-4 h-4 text-accent shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                    stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                                <div>
                                    <a href="tel:+18886462266"
                                        class="block text-ink hover:text-accent transition-colors font-medium">
                                        {{ config('uprise.contact.phone_us') }}
                                    </a>
                                    <span class="text-stone text-xs">USA · {{ config('uprise.contact.hours_us') }}</span>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 text-sm">
                                <svg class="w-4 h-4 text-accent shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                    stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                                <a href="mailto:{{ config('uprise.contact.email') }}"
                                    class="text-ink hover:text-accent transition-colors font-medium">
                                    {{ config('uprise.contact.email') }}
                                </a>
                            </div>

                            <div class="flex items-start gap-3 text-sm pt-2 border-t border-mist-soft">
                                <svg class="w-4 h-4 text-accent shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                    stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                <div class="text-stone">
                                    <p>{{ config('uprise.contact.address.street') }}</p>
                                    <p>{{ config('uprise.contact.address.city') }},
                                        {{ config('uprise.contact.address.country') }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Driver notice --}}
                        <div class="rounded-md bg-accent/8 border border-accent/20 p-4 text-xs text-stone leading-relaxed">
                            <span class="font-semibold text-ink">Driver always included.</span>
                            {{ config('uprise.policy.driver_included_notice') }}
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
