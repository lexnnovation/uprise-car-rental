@props(['crumbs'])

@php use Illuminate\Support\Js; @endphp

<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "BreadcrumbList",
    "itemListElement": [
        @foreach ($crumbs as $crumb)
        {
            "@@type": "ListItem",
            "position": {{ $loop->iteration }},
            "name": {!! Js::encode($crumb['name']) !!},
            "item": {!! Js::encode($crumb['url']) !!}
        }@if (! $loop->last),@endif
        @endforeach
    ]
}
</script>
