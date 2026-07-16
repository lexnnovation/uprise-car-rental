@extends('layouts.app')

@php
    $title = $post->meta_title ?: $post->title . ' | Uprise Travel Blog';
    $metaDescription = $post->meta_description ?: $post->summary();
    $ogImage = $post->hasMedia('og')
        ? $post->getFirstMediaUrl('og', 'og')
        : ($post->hasMedia('featured') ? $post->getFirstMediaUrl('featured', 'og') : null);
    $whatsappUrl =
        'https://wa.me/' . config('uprise.whatsapp.number') . '?text=' . urlencode(config('uprise.whatsapp.default_message'));
@endphp

@section('content')

    <x-seo.article-jsonld :post="$post" />
    <x-seo.breadcrumb-jsonld :crumbs="[
        ['name' => 'Home', 'url' => route('home')],
        ['name' => 'Blog', 'url' => route('blog.index')],
        ['name' => $post->title, 'url' => route('blog.show', $post)],
    ]" />

    {{-- ============================================================
     HERO IMAGE
     ============================================================ --}}
    <div class="relative bg-ink-deep overflow-hidden" style="min-height: 48vh;">
        @if ($post->hasMedia('featured'))
            <img src="{{ $post->getFirstMediaUrl('featured', 'hero') }}" alt="{{ $post->title }}"
                class="absolute inset-0 w-full h-full object-cover object-center" fetchpriority="high" loading="eager">
            <div class="absolute inset-0 bg-ink-deep/55"></div>
            <div class="absolute inset-0 bg-linear-to-t from-ink-deep via-ink-deep/20 to-transparent"></div>
        @else
            <div class="absolute inset-0 flex items-center justify-center bg-linear-to-br from-charcoal to-ink">
                <svg class="w-24 h-24 text-charcoal-soft/30" fill="none" stroke="currentColor" stroke-width="1"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
            </div>
        @endif

        {{-- Breadcrumb over image --}}
        <div class="relative z-10 container-page pt-6">
            <nav class="flex items-center gap-2 text-xs text-white/60" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span>/</span>
                <a href="{{ route('blog.index') }}" class="hover:text-white transition-colors">Blog</a>
                <span>/</span>
                <span class="text-white/90">{{ $post->title }}</span>
            </nav>
        </div>

        {{-- Title overlay --}}
        <div class="relative z-10 container-page pb-10 pt-6 flex items-end" style="min-height: 36vh;">
            <div class="max-w-3xl">
                <p class="eyebrow text-accent mb-3">Article</p>
                <h1 class="font-display font-bold text-white tracking-tight mb-4
                            text-[2rem] sm:text-[2.75rem] lg:text-[3.25rem]">
                    {{ $post->title }}
                </h1>
                <div class="flex flex-wrap items-center gap-3 text-sm text-white/70">
                    @if ($post->author_name)
                        <span class="font-semibold text-white">{{ $post->author_name }}</span>
                        <span aria-hidden="true">&middot;</span>
                    @endif
                    @if ($post->published_at)
                        <time datetime="{{ $post->published_at->toIso8601String() }}">
                            {{ $post->published_at->format('F j, Y') }}
                        </time>
                        <span aria-hidden="true">&middot;</span>
                    @endif
                    <span>{{ $post->readTimeMinutes() }} min read</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================
     MAIN CONTENT
     ============================================================ --}}
    <section class="bg-bone py-14 lg:py-20">
        <div class="container-page">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-16">

                {{-- LEFT: Article body --}}
                <article class="lg:col-span-2">
                    <div class="prose prose-stone max-w-none text-base leading-relaxed">
                        {!! $post->body !!}
                    </div>

                    @if ($post->author_name)
                        <div class="mt-12 pt-8 border-t border-mist flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-charcoal flex items-center justify-center shrink-0">
                                <span class="text-white font-semibold text-lg">{{ substr($post->author_name, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="font-semibold text-ink text-sm">{{ $post->author_name }}</p>
                                @if ($post->author_role)
                                    <p class="text-stone text-xs mt-0.5">{{ $post->author_role }}</p>
                                @endif
                            </div>
                        </div>
                    @endif
                </article>

                {{-- RIGHT: Enquiry sidebar --}}
                <div class="lg:col-span-1">
                    <div class="sticky top-28 space-y-4">

                        <div class="bg-ink rounded-md p-6 text-center">
                            <p class="eyebrow text-accent mb-3">Plan Your Trip</p>
                            <h3 class="font-display font-bold text-white text-lg mb-2">Ready to travel?</h3>
                            <p class="text-stone-soft text-sm mb-6 leading-relaxed">
                                Send us a WhatsApp message and we'll help plan your journey with a professional driver.
                            </p>
                            <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener"
                                class="w-full inline-flex items-center justify-center gap-2.5 bg-accent text-white font-semibold
                                       text-sm px-5 py-3.5 rounded-sm hover:bg-accent-soft transition-colors duration-200 tracking-wide">
                                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                                Book via WhatsApp
                            </a>
                        </div>

                        <a href="{{ route('blog.index') }}"
                            class="flex items-center gap-1.5 text-sm text-stone hover:text-ink transition-colors font-medium">
                            &larr; Back to Blog
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ============================================================
     RELATED POSTS
     ============================================================ --}}
    @if ($related->isNotEmpty())
        <section class="bg-ink py-14 lg:py-20 border-t border-charcoal-soft">
            <div class="container-page">
                <p class="eyebrow text-accent mb-3">Keep Reading</p>
                <h2 class="font-display font-bold text-white text-display-sm tracking-tight mb-10">
                    More from the journal
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($related as $rel)
                        <article
                            class="group bg-charcoal rounded-md overflow-hidden hover:ring-1 hover:ring-accent/30 transition-all duration-300">
                            <a href="{{ route('blog.show', $rel) }}" class="block overflow-hidden aspect-video bg-ink">
                                @if ($rel->hasMedia('featured'))
                                    <img src="{{ $rel->getFirstMediaUrl('featured', 'card') }}" alt="{{ $rel->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        loading="lazy">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-12 h-12 text-charcoal-soft/40" fill="none" stroke="currentColor"
                                            stroke-width="1" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                    </div>
                                @endif
                            </a>
                            <div class="p-5">
                                <h3
                                    class="font-display font-semibold text-white text-base mb-1 group-hover:text-accent transition-colors">
                                    <a href="{{ route('blog.show', $rel) }}">{{ $rel->title }}</a>
                                </h3>
                                <div class="flex items-center gap-3 text-stone-soft text-xs mt-3">
                                    @if ($rel->published_at)
                                        <time datetime="{{ $rel->published_at->toIso8601String() }}">
                                            {{ $rel->published_at->format('M j, Y') }}
                                        </time>
                                        <span aria-hidden="true">&middot;</span>
                                    @endif
                                    <span>{{ $rel->readTimeMinutes() }} min read</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection
