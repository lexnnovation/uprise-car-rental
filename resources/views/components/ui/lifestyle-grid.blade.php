@props(['photos'])

@if ($photos->isNotEmpty())
    @php $p = $photos->values(); @endphp

    <section class="bg-bone py-20 lg:py-28 border-t border-mist overflow-hidden">
        <div class="container-page">

            <div class="max-w-2xl mb-10 lg:mb-12" data-reveal>
                <p class="eyebrow text-accent mb-3">The Journey</p>
                <h2 class="font-display font-bold text-ink text-display-md tracking-tight">
                    Real clients. Real journeys.
                </h2>
            </div>

            {{-- Mobile: 2-col CSS masonry --}}
            <div class="columns-2 gap-[3px] md:hidden">
                @foreach ($p as $url)
                    <div class="mb-[3px] break-inside-avoid rounded-sm overflow-hidden group">
                        <img src="{{ $url }}" alt="Uprise client journey"
                             class="w-full object-cover transition-transform duration-500 group-hover:scale-[1.02]"
                             loading="lazy">
                    </div>
                @endforeach
            </div>

            {{-- Desktop: asymmetric 3-col grid --}}
            <div class="hidden md:grid grid-cols-3 gap-[3px]"
                 style="grid-template-rows: 240px 240px;">

                @if ($p->get(0))
                    <div class="col-start-1 row-start-1 row-span-2 rounded-sm overflow-hidden group">
                        <img src="{{ $p[0] }}" alt="Uprise journey"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.02]"
                             loading="lazy">
                    </div>
                @endif

                @if ($p->get(1))
                    <div class="col-start-2 row-start-1 rounded-sm overflow-hidden group">
                        <img src="{{ $p[1] }}" alt="Uprise journey"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.02]"
                             loading="lazy">
                    </div>
                @endif

                @if ($p->get(2))
                    <div class="col-start-2 row-start-2 rounded-sm overflow-hidden group">
                        <img src="{{ $p[2] }}" alt="Uprise journey"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.02]"
                             loading="lazy">
                    </div>
                @endif

                @if ($p->get(3))
                    <div class="col-start-3 row-start-1 row-span-2 rounded-sm overflow-hidden group">
                        <img src="{{ $p[3] }}" alt="Uprise journey"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.02]"
                             loading="lazy">
                    </div>
                @endif

            </div>

        </div>
    </section>
@endif
