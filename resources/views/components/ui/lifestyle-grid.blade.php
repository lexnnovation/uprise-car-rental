@props(['photos'])

@php
    // Filename -> caption. Falls back to a generic caption for any photo
    // dropped into public/images/lifestyle/ without an explicit entry here.
    $captions = [
        'uprise travel rentals0.jpg' => 'Airport Pickups',
        'uprise travel rentals1.jpg' => 'Group Tours',
        'uprise travel rentals2.jpg' => 'City Tours',
        'uprise travel rentals3.jpg' => 'Group Travel',
        'uprise travel rentals4.jpg' => 'On the Road',
        'uprise travel rentals5.jpg' => 'Private Charters',
        'uprise travel rentals6.jpg' => 'Safari Drives',
    ];

    $items = $photos
        ->values()
        ->map(function ($url) use ($captions) {
            $name = rawurldecode(basename((string) parse_url($url, PHP_URL_PATH)));

            return [
                'url' => $url,
                'caption' => $captions[$name] ?? 'Uprise Travel',
            ];
        });

    $blocks = $items->values()->chunk(4);
@endphp

@if ($items->isNotEmpty())
    <section class="bg-bone py-20 lg:py-28 border-t border-mist overflow-hidden" x-data="{
        open: false,
        active: 0,
        items: @js($items),
        show(i) { this.active = i; this.open = true; },
        close() { this.open = false; },
        next() { this.active = (this.active + 1) % this.items.length; },
        prev() { this.active = (this.active - 1 + this.items.length) % this.items.length; },
    }" @keydown.escape.window="close()" @keydown.right.window="if (open) next()" @keydown.left.window="if (open) prev()">
        <div class="container-page">

            <div class="max-w-2xl mb-10 lg:mb-12" data-reveal>
                <p class="eyebrow text-accent mb-3">The Journey</p>
                <h2 class="font-display font-bold text-ink text-display-md tracking-tight">
                    Real clients. Real journeys.
                </h2>
            </div>

            {{-- Mobile: 2-col CSS masonry --}}
            <div class="columns-2 gap-[3px] md:hidden">
                @foreach ($items as $i => $item)
                    <button type="button" @click="show({{ $i }})"
                        class="block w-full mb-[3px] break-inside-avoid rounded-sm overflow-hidden relative group">
                        <img src="{{ $item['url'] }}" alt="{{ $item['caption'] }}"
                            class="w-full object-cover transition-transform duration-500 group-hover:scale-[1.02]"
                            loading="lazy">
                        <div class="absolute inset-x-0 bottom-0 bg-linear-to-t from-ink/80 to-transparent px-3 py-2.5">
                            <p class="text-white text-xs font-semibold text-left">{{ $item['caption'] }}</p>
                        </div>
                    </button>
                @endforeach
            </div>

            {{-- Desktop: asymmetric 3-col grid, repeated in blocks of 4 --}}
            <div class="hidden md:block space-y-[3px]">
                @foreach ($blocks as $block)
                    @php $b = $block->values(); $globalOffset = $loop->index * 4; @endphp

                    @if ($b->count() === 4)
                        <div class="grid grid-cols-3 gap-[3px]" style="grid-template-rows: 240px 240px;">
                            @foreach ([['col-start-1 row-start-1 row-span-2', 0], ['col-start-2 row-start-1', 1], ['col-start-2 row-start-2', 2], ['col-start-3 row-start-1 row-span-2', 3]] as [$pos, $idx])
                                @php $item = $b[$idx]; $globalIndex = $globalOffset + $idx; @endphp
                                <button type="button" @click="show({{ $globalIndex }})"
                                    class="{{ $pos }} rounded-sm overflow-hidden relative group">
                                    <img src="{{ $item['url'] }}" alt="{{ $item['caption'] }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.02]"
                                        loading="lazy">
                                    <div
                                        class="absolute inset-x-0 bottom-0 bg-linear-to-t from-ink/80 to-transparent px-4 py-3.5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <p class="text-white text-sm font-semibold text-left">{{ $item['caption'] }}</p>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    @else
                        <div class="grid gap-[3px]" style="grid-template-columns: repeat({{ $b->count() }}, minmax(0, 1fr)); height: 240px;">
                            @foreach ($b as $idx => $item)
                                @php $globalIndex = $globalOffset + $idx; @endphp
                                <button type="button" @click="show({{ $globalIndex }})"
                                    class="rounded-sm overflow-hidden relative group">
                                    <img src="{{ $item['url'] }}" alt="{{ $item['caption'] }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.02]"
                                        loading="lazy">
                                    <div
                                        class="absolute inset-x-0 bottom-0 bg-linear-to-t from-ink/80 to-transparent px-4 py-3.5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <p class="text-white text-sm font-semibold text-left">{{ $item['caption'] }}</p>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>

        </div>

        {{-- Lightbox modal --}}
        <div x-show="open" x-cloak x-transition.opacity.duration.200ms
            class="fixed inset-0 z-50 bg-ink-deep/95 flex items-center justify-center p-4 sm:p-8" @click.self="close()">

            <button type="button" @click="close()" aria-label="Close"
                class="absolute top-5 right-5 w-10 h-10 rounded-full border border-white/25 text-white flex items-center justify-center hover:bg-white hover:text-ink transition-colors duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <button type="button" @click="prev()" aria-label="Previous photo"
                class="hidden sm:flex absolute left-5 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full border border-white/25 text-white items-center justify-center hover:bg-white hover:text-ink transition-colors duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button type="button" @click="next()" aria-label="Next photo"
                class="hidden sm:flex absolute right-5 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full border border-white/25 text-white items-center justify-center hover:bg-white hover:text-ink transition-colors duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <div class="max-w-4xl w-full" @click.stop>
                <img :src="items[active] ? items[active].url : ''" :alt="items[active] ? items[active].caption : ''"
                    class="w-full max-h-[75vh] object-contain rounded-sm">
                <p class="text-white text-sm font-semibold text-center mt-4" x-text="items[active] ? items[active].caption : ''">
                </p>
            </div>
        </div>
    </section>
@endif
