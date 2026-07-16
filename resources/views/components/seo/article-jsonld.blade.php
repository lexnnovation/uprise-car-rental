@props(['post'])

@php
    use Illuminate\Support\Js;
    $image = $post->hasMedia('featured') ? $post->getFirstMediaUrl('featured', 'og') : asset('images/og-default.jpg');
@endphp

<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Article",
    "headline": {!! Js::encode($post->title) !!},
    "description": {!! Js::encode($post->meta_description ?: $post->excerpt) !!},
    "image": {!! Js::encode($image) !!},
    "datePublished": {!! Js::encode($post->published_at?->toIso8601String()) !!},
    "dateModified": {!! Js::encode($post->updated_at->toIso8601String()) !!},
    "author": {
        "@@type": "Person",
        "name": {!! Js::encode($post->author_name ?: config('uprise.brand.name')) !!}
    },
    "publisher": {
        "@@type": "Organization",
        "name": {!! Js::encode(config('uprise.brand.name')) !!},
        "logo": {
            "@@type": "ImageObject",
            "url": {!! Js::encode(asset('images/uprise-logo.png')) !!}
        }
    },
    "mainEntityOfPage": {
        "@@type": "WebPage",
        "@@id": {!! Js::encode(route('blog.show', $post)) !!}
    }
}
</script>
