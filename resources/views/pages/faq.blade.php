@extends('layouts.app')

@php
    $title = 'Frequently Asked Questions | Uprise Travel';
    $metaDescription = 'Answers to common questions about car and driver hire in Ghana and West Africa — booking, pricing, coverage, driver policy, airport transfers and more.';
@endphp

@section('content')

    {{-- PAGE HEADER --}}
    <section class="bg-ink-deep border-b border-charcoal-soft">
        <div class="container-page py-14 lg:py-20">
            <nav class="flex items-center gap-2 text-xs text-stone mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span>/</span>
                <span class="text-stone-soft">FAQ</span>
            </nav>
            <p class="eyebrow text-accent mb-3">Questions & Answers</p>
            <h1 class="font-display font-bold text-white tracking-tight mb-4
                        text-[2rem] sm:text-[2.75rem] lg:text-[3.25rem]">
                Frequently asked questions.
            </h1>
            <p class="text-stone-soft text-base max-w-xl leading-relaxed">
                Everything you need to know about hiring a car and driver with Uprise Travel.
                Can't find your answer?
                <a href="{{ route('contact') }}" class="text-accent hover:text-accent-soft underline underline-offset-2 transition-colors">Get in touch.</a>
            </p>
        </div>
    </section>

    {{-- FAQ ACCORDION --}}
    <section class="bg-bone py-14 lg:py-20">
        <div class="container-page">
            <div class="max-w-3xl mx-auto">

                @if ($grouped->isEmpty())
                    <div class="text-center py-20">
                        <p class="font-display font-semibold text-ink text-lg mb-2">No FAQs yet.</p>
                        <p class="text-stone text-sm mb-6">Check back soon, or reach us directly.</p>
                        <a href="{{ route('contact') }}"
                           class="inline-flex items-center gap-2 bg-accent text-white font-semibold text-sm px-6 py-3 rounded-sm hover:bg-accent-soft transition-colors">
                            Contact us
                        </a>
                    </div>

                @else
                    @foreach ($grouped as $category => $items)
                        <div class="mb-12 last:mb-0">

                            {{-- Category heading --}}
                            @if ($category)
                                <h2 class="font-display font-bold text-ink text-lg mb-6 pb-3 border-b border-mist flex items-center gap-3">
                                    <span class="w-1.5 h-5 bg-accent rounded-full shrink-0"></span>
                                    {{ $category }}
                                </h2>
                            @endif

                            {{-- Accordion items --}}
                            <div class="space-y-2">
                                @foreach ($items as $faq)
                                    <div x-data="{ open: false }"
                                         class="bg-white rounded-md shadow-card overflow-hidden
                                                hover:ring-1 hover:ring-accent/20 transition-shadow duration-200">

                                        {{-- Question trigger --}}
                                        <button @click="open = !open"
                                                class="w-full flex items-start justify-between gap-4 px-5 py-4 text-left"
                                                :aria-expanded="open">
                                            <span class="font-display font-semibold text-ink text-sm leading-snug pr-2"
                                                  :class="open ? 'text-accent' : ''">
                                                {{ $faq->question }}
                                            </span>
                                            <span class="shrink-0 mt-0.5">
                                                <svg class="w-4 h-4 text-stone transition-transform duration-200"
                                                     :class="open ? 'rotate-180 text-accent' : ''"
                                                     fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
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
                                             class="px-5 pb-5 border-t border-mist-soft">
                                            <div class="pt-4 text-stone text-sm leading-relaxed prose prose-sm prose-stone max-w-none">
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
    <section class="bg-ink border-t border-charcoal-soft py-14 lg:py-20">
        <div class="container-page">
            <div class="max-w-3xl mx-auto grid grid-cols-1 sm:grid-cols-2 gap-6">

                <div class="bg-charcoal rounded-md p-6">
                    <p class="eyebrow text-accent mb-3">Send an enquiry</p>
                    <p class="font-display font-semibold text-white text-base mb-4">
                        Have a specific trip in mind?
                    </p>
                    <p class="text-stone-soft text-sm mb-5 leading-relaxed">
                        Fill out our booking form and we'll get back to you with options and pricing.
                    </p>
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center gap-2 bg-accent text-white font-semibold text-sm
                              px-5 py-3 rounded-sm hover:bg-accent-soft transition-colors tracking-wide">
                        Book a journey
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                </div>

                <div class="bg-charcoal rounded-md p-6">
                    <p class="eyebrow text-accent mb-3">Chat with us</p>
                    <p class="font-display font-semibold text-white text-base mb-4">
                        Prefer WhatsApp?
                    </p>
                    <p class="text-stone-soft text-sm mb-5 leading-relaxed">
                        Message us directly for same-day replies and quick confirmations.
                    </p>
                    <a href="{{ 'https://wa.me/' . config('uprise.whatsapp.number') . '?text=' . urlencode(config('uprise.whatsapp.default_message')) }}"
                       target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 border border-accent text-accent font-semibold text-sm
                              px-5 py-3 rounded-sm hover:bg-accent hover:text-white transition-colors tracking-wide">
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Open WhatsApp
                    </a>
                </div>

            </div>
        </div>
    </section>

@endsection
