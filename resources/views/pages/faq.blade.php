@extends('layouts.app')

@php
    $title = 'Uprise Travel Car Rentals | FAQ';
    $metaDescription =
        'Answers to common questions about car and driver hire in Ghana and West Africa — booking, pricing, coverage, driver policy, airport transfers and more.';
@endphp

@section('content')

    <x-seo.faqpage-jsonld :faqs="$faqs" />
    <x-seo.breadcrumb-jsonld :crumbs="[
        ['name' => 'Home', 'url' => route('home')],
        ['name' => 'FAQ', 'url' => route('faq')],
    ]" />

    {{-- PAGE HEADER --}}
    <section class="bg-ink-deep border-b border-charcoal-soft">
        <div class="container-page py-14 lg:py-20">
            <nav class="flex items-center gap-2 text-xs text-stone mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span>/</span>
                <span class="text-stone-soft">FAQ</span>
            </nav>
            <p class="eyebrow text-accent mb-3" data-reveal>Questions & Answers</p>
            <h1 data-reveal data-reveal-delay="80"
                class="font-display font-bold text-white tracking-tight mb-4
                        text-[2rem] sm:text-[2.75rem] lg:text-[3.25rem]">
                Frequently asked questions.
            </h1>
            <p data-reveal data-reveal-delay="160" class="text-stone-soft text-base max-w-xl leading-relaxed">
                Everything you need to know about hiring a car and driver with Uprise Travel.
                Can't find your answer?
                <a href="{{ route('contact') }}"
                    class="text-accent hover:text-accent-soft underline underline-offset-2 transition-colors">Get in
                    touch.</a>
            </p>
        </div>
    </section>

    {{-- FAQ ACCORDION --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="container-page">
            <div class="max-w-3xl mx-auto">

                @if ($grouped->isEmpty())
                    <div class="text-center py-24">
                        <p class="font-display font-semibold text-ink text-lg mb-2">No FAQs yet.</p>
                        <p class="text-stone text-sm mb-6">Check back soon, or reach us directly.</p>
                        <a href="{{ route('contact') }}"
                            class="inline-flex items-center gap-2 bg-accent text-white font-semibold text-sm px-6 py-3 rounded-sm hover:bg-accent-soft transition-colors">
                            Contact us
                        </a>
                    </div>
                @else
                    @foreach ($grouped as $category => $items)
                        <div class="mb-16 last:mb-0" data-reveal>

                            {{-- Category section marker --}}
                            @if ($category)
                                <div class="flex items-center gap-4 mb-8">
                                    <span class="font-display font-black text-ink/6 select-none leading-none"
                                        style="font-size:2.5rem">{{ str_pad($loop->index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    <h2 class="font-display font-semibold text-ink tracking-[0.12em] uppercase text-xs shrink-0">
                                        {{ $category }}
                                    </h2>
                                    <div class="flex-1 h-px bg-mist"></div>
                                </div>
                            @endif

                            {{-- Accordion items --}}
                            <div class="divide-y divide-mist-soft">
                                @foreach ($items as $faq)
                                    <div x-data="{ open: false }" class="group py-1">

                                        {{-- Question trigger --}}
                                        <button @click="open = !open"
                                            class="w-full flex items-start justify-between gap-6 py-5 text-left"
                                            :aria-expanded="open">
                                            <span class="font-display font-semibold text-ink/80 text-[0.9375rem] leading-snug
                                                         transition-colors duration-200 group-hover:text-ink"
                                                :class="open ? 'text-accent!' : ''">
                                                {{ $faq->question }}
                                            </span>
                                            <span class="shrink-0 mt-0.5 w-6 h-6 rounded-full border border-mist flex items-center justify-center
                                                         transition-all duration-200"
                                                :class="open ? 'bg-accent border-accent' : 'group-hover:border-stone'">
                                                <svg class="w-2.5 h-2.5 transition-transform duration-200"
                                                    :class="open ? 'rotate-180 text-white' : 'text-stone'"
                                                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </span>
                                        </button>

                                        {{-- Answer panel --}}
                                        <div x-show="open"
                                            x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 -translate-y-1"
                                            x-transition:enter-end="opacity-100 translate-y-0"
                                            x-transition:leave="transition ease-in duration-150"
                                            x-transition:leave-start="opacity-100 translate-y-0"
                                            x-transition:leave-end="opacity-0 -translate-y-1"
                                            class="pb-6">
                                            <div class="text-stone text-sm leading-relaxed max-w-2xl">
                                                {!! nl2br(e($faq->answer)) !!}
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>

                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>

    {{-- STILL HAVE QUESTIONS CTA --}}
    <section class="bg-bone border-t border-mist py-14 lg:py-20">
        <div class="container-page">
            <div class="max-w-3xl mx-auto">

                <p class="eyebrow text-accent mb-4">Still not sure?</p>
                <h2 class="font-display font-bold text-ink text-display-sm tracking-tight mb-8">
                    We're a message away.
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <a href="{{ route('contact') }}"
                        class="group flex items-center justify-between gap-4 bg-white border border-mist rounded-md px-6 py-5
                               hover:border-accent/40 hover:shadow-card-hover transition-all duration-200">
                        <div>
                            <p class="font-display font-semibold text-ink text-sm mb-1">Send an enquiry</p>
                            <p class="text-stone text-xs leading-relaxed">Tell us about your trip and we'll respond with options.</p>
                        </div>
                        <svg class="w-4 h-4 text-accent shrink-0 group-hover:translate-x-0.5 transition-transform" fill="none"
                            stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>

                    <a href="{{ 'https://wa.me/' . config('uprise.whatsapp.number') . '?text=' . urlencode(config('uprise.whatsapp.default_message')) }}"
                        target="_blank" rel="noopener"
                        class="group flex items-center justify-between gap-4 bg-white border border-mist rounded-md px-6 py-5
                               hover:border-accent/40 hover:shadow-card-hover transition-all duration-200">
                        <div>
                            <p class="font-display font-semibold text-ink text-sm mb-1">Chat on WhatsApp</p>
                            <p class="text-stone text-xs leading-relaxed">Same-day replies, quick confirmations, 24/7.</p>
                        </div>
                        <svg class="w-4 h-4 text-accent shrink-0 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                    </a>

                </div>
            </div>
        </div>
    </section>

    {{-- FLEET SHOWCASE --}}
    <x-vehicle.showcase bg="bg-bone" eyebrow="The Fleet" title="See the cars behind the answers"
        subtitle="Sedans, SUVs, vans and coaches — all with a professional driver. Browse the full fleet." />

@endsection
