@extends('layouts.app')

@php
    $title = 'Server Error | Uprise Travel';
    $metaDescription = 'Something went wrong on our end. Please try again shortly.';
@endphp

@section('content')

    <section class="bg-ink-deep min-h-[70vh] flex items-center">
        <div class="container-page py-20 text-center">

            <p class="font-display font-bold text-accent text-7xl mb-4">500</p>
            <h1 class="font-display font-bold text-white text-3xl sm:text-4xl mb-4">
                Something went wrong
            </h1>
            <p class="text-stone-soft text-base max-w-md mx-auto mb-10">
                We're experiencing a technical issue on our end. Please try again in a moment
                or reach us directly via WhatsApp.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}"
                    class="btn-shimmer inline-flex items-center justify-center gap-2 bg-white text-ink font-semibold
                           text-sm px-6 py-3 rounded-lg hover:bg-ink hover:text-white transition-colors tracking-wide">
                    Go to Homepage
                </a>
                <a href="{{ 'https://wa.me/' . config('uprise.whatsapp.number') . '?text=' . urlencode(config('uprise.whatsapp.default_message')) }}"
                    target="_blank" rel="noopener"
                    class="inline-flex items-center justify-center gap-2 border border-white/20 text-white
                           font-semibold text-sm px-6 py-3 rounded-sm hover:border-white/50 transition-colors tracking-wide">
                    Chat on WhatsApp
                </a>
            </div>

        </div>
    </section>

@endsection
