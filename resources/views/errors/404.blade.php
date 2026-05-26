@extends('layouts.app')

@php
    $title = 'Page Not Found | Uprise Travel';
    $metaDescription = 'The page you are looking for could not be found.';
@endphp

@section('content')

    <section class="bg-ink-deep min-h-[70vh] flex items-center">
        <div class="container-page py-20 text-center">

            <p class="font-display font-bold text-accent text-7xl mb-4">404</p>
            <h1 class="font-display font-bold text-white text-3xl sm:text-4xl mb-4">
                Page not found
            </h1>
            <p class="text-stone-soft text-base max-w-md mx-auto mb-10">
                The page you're looking for doesn't exist or may have been moved.
                Let's get you back on the road.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}"
                    class="inline-flex items-center justify-center gap-2 bg-accent text-white font-semibold
                           text-sm px-6 py-3 rounded-sm hover:bg-accent-soft transition-colors tracking-wide">
                    Go to Homepage
                </a>
                <a href="{{ route('fleet.index') }}"
                    class="inline-flex items-center justify-center gap-2 border border-white/20 text-white
                           font-semibold text-sm px-6 py-3 rounded-sm hover:border-white/50 transition-colors tracking-wide">
                    Browse Fleet
                </a>
                <a href="{{ route('services.index') }}"
                    class="inline-flex items-center justify-center gap-2 border border-white/20 text-white
                           font-semibold text-sm px-6 py-3 rounded-sm hover:border-white/50 transition-colors tracking-wide">
                    Our Services
                </a>
            </div>

        </div>
    </section>

@endsection
