@props(['faqs'])

@php use Illuminate\Support\Js; @endphp

<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
        @foreach ($faqs as $faq)
        {
            "@@type": "Question",
            "name": {!! Js::encode($faq->question) !!},
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": {!! Js::encode($faq->answer) !!}
            }
        }@if (! $loop->last),@endif
        @endforeach
    ]
}
</script>
