@props([
    'eyebrow' => 'The Fleet',
    'title' => 'A car for every journey',
    'subtitle' => 'Every vehicle comes with a vetted, professional driver. Browse the fleet and book the one that fits your trip.',
    'limit' => 3,
    'bg' => 'bg-bone',
])

@php
    $showcaseVehicles = \App\Models\Vehicle::published()
        ->available()
        ->with('category')
        ->orderByDesc('is_featured')
        ->ordered()
        ->limit($limit)
        ->get();
@endphp

@if ($showcaseVehicles->isNotEmpty())
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

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" data-stagger data-stagger-delay="100">
                @foreach ($showcaseVehicles as $vehicle)
                    @php
                        $cardImg = $vehicle->hasMedia('hero')
                            ? $vehicle->getFirstMediaUrl('hero', 'card')
                            : $vehicle->hero_image_url;
                    @endphp
                    <a href="{{ route('fleet.show', $vehicle) }}"
                        class="group flex flex-col bg-white border border-mist rounded-md overflow-hidden hover:shadow-lg hover:border-accent/40 transition-all duration-200">
                        <div class="aspect-[4/3] overflow-hidden bg-charcoal">
                            @if ($cardImg)
                                <img src="{{ $cardImg }}" alt="{{ $vehicle->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    loading="lazy">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-linear-to-br from-charcoal to-ink">
                                    <svg class="w-14 h-14 text-charcoal-soft/50" fill="none" stroke="currentColor"
                                        stroke-width="1" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <p class="eyebrow text-accent mb-2">{{ $vehicle->category->name ?? 'Vehicle' }}</p>
                            <h3 class="font-display font-bold text-ink text-lg leading-snug mb-3 group-hover:text-accent transition-colors duration-200">
                                {{ $vehicle->name }}
                            </h3>
                            <div class="mt-auto flex items-center gap-5 text-xs text-stone border-t border-mist-soft pt-4">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                    </svg>
                                    {{ $vehicle->passenger_count }} passengers
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                    </svg>
                                    {{ $vehicle->luggage_count }} bags
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </section>
@endif
