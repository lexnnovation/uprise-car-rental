@props([
    'eyebrow' => 'The Fleet',
    'title' => 'A car for every journey',
    'subtitle' => 'Every vehicle comes with a vetted, professional driver. Browse the fleet and book the one that fits your trip.',
    'limit' => 3,
    'bg' => 'bg-bone',
    'categories' => null,
    'cols' => 3,
    'picks' => [],
])

@php
    $allEntries = \App\Services\FleetPhotoScanner::entries();

    if ($categories) {
        // Preserve the given category order, and honour a specific item
        // pick per category (e.g. ['suv-4x4' => '2']) instead of always
        // taking the first photo found for that category.
        $showcaseEntries = collect($categories)
            ->map(function ($slug) use ($allEntries, $picks) {
                $matches = $allEntries->where('category_slug', $slug)->values();
                if ($matches->isEmpty()) {
                    return null;
                }

                if (isset($picks[$slug])) {
                    $picked = $matches->firstWhere('item', $picks[$slug]);
                    if ($picked) {
                        return $picked;
                    }
                }

                return $matches->first();
            })
            ->filter()
            ->values();
    } else {
        $showcaseEntries = $allEntries->unique('category_slug')->values();
    }

    $showcaseEntries = $showcaseEntries->take($limit);

    $gridClass = $cols === 4
        ? 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-4'
        : 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3';
@endphp

@if ($showcaseEntries->isNotEmpty())
    <section class="{{ $bg }} py-16 lg:py-24 border-t border-mist">
        <div class="container-page">

            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-10 lg:mb-12">
                <div class="max-w-xl" data-reveal>
                    <p class="eyebrow text-accent mb-3">{{ $eyebrow }}</p>
                    <h2 class="font-display font-bold text-ink text-display-sm tracking-tight">{{ $title }}</h2>
                    @if ($subtitle)
                        <p class="text-stone text-base leading-relaxed mt-4">{{ $subtitle }}</p>
                    @endif
                </div>
                <a href="{{ route('fleet.index') }}"
                    class="shrink-0 text-sm font-semibold text-accent hover:text-accent-deep transition-colors">
                    View all vehicles &rarr;
                </a>
            </div>

            <div class="grid {{ $gridClass }} gap-6" data-stagger data-stagger-delay="100">
                @foreach ($showcaseEntries as $entry)
                    <a href="{{ route('fleet.group', ['category' => $entry['category_slug'], 'item' => $entry['item']]) }}"
                        class="group flex flex-col bg-white border border-mist rounded-md overflow-hidden hover:shadow-lg hover:border-accent/40 transition-all duration-200">
                        <div class="relative aspect-[4/3] overflow-hidden bg-charcoal">
                            <img src="{{ $entry['cover'] }}" alt="{{ $entry['category_name'] }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                loading="lazy">
                            @if ($entry['photo_count'] > 1)
                                <span class="absolute bottom-3 right-3 inline-flex items-center gap-1.5 bg-ink/80 text-white text-xs font-semibold px-2.5 py-1 rounded-full">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                    </svg>
                                    {{ $entry['photo_count'] }}
                                </span>
                            @endif
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <h3 class="font-display font-bold text-ink text-xl leading-snug group-hover:text-accent transition-colors duration-200">
                                {{ $entry['category_name'] }}
                            </h3>
                            <p class="text-stone text-sm font-medium mt-auto pt-4 border-t border-mist-soft">
                                Professional driver included
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </section>
@endif
