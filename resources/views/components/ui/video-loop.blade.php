@props([
    'name', // basename in public/videos (expects .mp4 + .webm); poster at public/images/videos/{name}-poster.jpg
    'overlay' => false, // dark overlay so the clip reads as motion/atmosphere, not detail
    'poster' => null,
])

@php
    $posterUrl = $poster ?? asset('images/videos/' . $name . '-poster.jpg');
@endphp

<div {{ $attributes->merge(['class' => 'relative overflow-hidden bg-ink-deep']) }}>
    <video class="absolute inset-0 w-full h-full object-cover" autoplay muted loop playsinline preload="metadata"
        poster="{{ $posterUrl }}" aria-hidden="true" tabindex="-1"
        x-data x-init="if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) { $el.removeAttribute('autoplay'); $el.pause(); }">
        <source src="{{ asset('videos/' . $name . '.mp4') }}" type="video/mp4">
    </video>

    @if ($overlay)
        <div class="pointer-events-none absolute inset-0 bg-ink-deep/65"></div>
        <div class="pointer-events-none absolute inset-0 bg-linear-to-t from-ink-deep via-ink-deep/15 to-ink-deep/45"></div>
    @endif

    @if (trim($slot) !== '')
        <div class="relative z-10">{{ $slot }}</div>
    @endif
</div>
