@extends('layouts.app')

@php
    $title = 'Travel & Chauffeur Insights | Uprise Travel Blog';
    $metaDescription =
        'Guides, tips and stories on chauffeur travel, airport transfers, safari trips and touring Ghana and West Africa with a professional driver.';
@endphp

@push('head')
    @if ($posts->currentPage() > 1)
        <link rel="prev" href="{{ $posts->previousPageUrl() }}">
    @endif
    @if ($posts->hasMorePages())
        <link rel="next" href="{{ $posts->nextPageUrl() }}">
    @endif
@endpush

@section('content')

    <x-seo.breadcrumb-jsonld :crumbs="[
        ['name' => 'Home', 'url' => route('home')],
        ['name' => 'Blog', 'url' => route('blog.index')],
    ]" />

    {{-- ============================================================
     PAGE HEADER
     ============================================================ --}}
    <section class="bg-ink-deep border-b border-charcoal-soft">
        <div class="container-page py-14 lg:py-20">
            <nav class="flex items-center gap-2 text-xs text-stone mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span>/</span>
                <span class="text-stone-soft">Blog</span>
            </nav>
            <p class="eyebrow text-accent mb-3" data-reveal>The Journal</p>
            <h1 data-reveal data-reveal-delay="80"
                class="font-display font-bold text-white tracking-tight mb-4
                        text-[2rem] sm:text-[2.75rem] lg:text-[3.25rem]">
                Travel & chauffeur insights.
            </h1>
            <p data-reveal data-reveal-delay="160" class="text-stone-soft text-base max-w-xl leading-relaxed">
                Guides, tips and stories on getting around Ghana and West Africa — airport transfers, safaris,
                executive travel and more.
            </p>
        </div>
    </section>

    {{-- ============================================================
     POSTS GRID
     ============================================================ --}}
    <section class="bg-bone py-14 lg:py-20">
        <div class="container-page">

            @if ($posts->isEmpty())
                <div class="text-center py-24">
                    <p class="font-display font-semibold text-ink text-lg mb-2">No articles yet.</p>
                    <p class="text-stone text-sm">Check back soon for new stories.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" data-stagger data-stagger-delay="120">
                    @foreach ($posts as $post)
                        <a href="{{ route('blog.show', $post) }}"
                            class="group bg-white rounded-md overflow-hidden shadow-card hover:shadow-card-hover
                                   hover:ring-1 hover:ring-accent/20 transition-all duration-300 flex flex-col">

                            <div class="overflow-hidden aspect-video bg-charcoal">
                                @if ($post->hasMedia('featured'))
                                    <img src="{{ $post->getFirstMediaUrl('featured', 'card') }}" alt="{{ $post->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        loading="lazy">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-10 h-10 text-charcoal-soft/40" fill="none" stroke="currentColor"
                                            stroke-width="1" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <div class="flex flex-col p-6 flex-1">
                                <div class="flex items-center gap-2 text-xs text-stone mb-3">
                                    @if ($post->published_at)
                                        <time datetime="{{ $post->published_at->toIso8601String() }}">
                                            {{ $post->published_at->format('M j, Y') }}
                                        </time>
                                        <span aria-hidden="true">&middot;</span>
                                    @endif
                                    <span>{{ $post->readTimeMinutes() }} min read</span>
                                </div>

                                <h2 class="font-display font-bold text-ink text-lg leading-snug mb-3
                                            group-hover:text-accent transition-colors duration-200">
                                    {{ $post->title }}
                                </h2>

                                <p class="text-stone text-sm leading-relaxed flex-1">
                                    {{ $post->summary() }}
                                </p>

                                <div class="mt-5 inline-flex items-center gap-2 text-sm font-bold text-accent
                                            group-hover:text-accent-soft transition-colors tracking-wide">
                                    Read more
                                    <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none"
                                        stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if ($posts->hasPages())
                    <nav class="flex items-center justify-center gap-2 mt-14" aria-label="Blog pagination">
                        @if ($posts->onFirstPage())
                            <span class="px-4 py-2 text-sm text-stone/40 cursor-not-allowed">&larr; Previous</span>
                        @else
                            <a href="{{ $posts->previousPageUrl() }}"
                                class="px-4 py-2 text-sm font-medium text-ink hover:text-accent transition-colors">
                                &larr; Previous
                            </a>
                        @endif

                        <span class="text-sm text-stone px-2">
                            Page {{ $posts->currentPage() }} of {{ $posts->lastPage() }}
                        </span>

                        @if ($posts->hasMorePages())
                            <a href="{{ $posts->nextPageUrl() }}"
                                class="px-4 py-2 text-sm font-medium text-ink hover:text-accent transition-colors">
                                Next &rarr;
                            </a>
                        @else
                            <span class="px-4 py-2 text-sm text-stone/40 cursor-not-allowed">Next &rarr;</span>
                        @endif
                    </nav>
                @endif
            @endif

        </div>
    </section>

@endsection
