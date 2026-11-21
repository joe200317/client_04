@props([
    'eyebrow' => '',
    'title',
    'accent' => '',
    'subtitle' => '',
])

<section class="ribbon-glow relative overflow-hidden border-b border-cream-dark/40">
    <div class="container-site py-16 sm:py-20">
        @if ($eyebrow !== '')
            <p class="section-label animate-fade-up mb-3">{{ $eyebrow }}</p>
        @endif
        <h1 class="heading-display animate-fade-up-delay max-w-3xl">
            {{ $title }}
            @if ($accent !== '')
                <span class="gold-shimmer italic">{{ $accent }}</span>
            @endif
        </h1>
        @if ($subtitle !== '')
            <p class="animate-fade-up-delay-2 mt-4 max-w-2xl text-base leading-relaxed text-muted sm:text-lg">
                {{ $subtitle }}
            </p>
        @endif
    </div>
</section>
