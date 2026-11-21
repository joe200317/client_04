@props([
    'eyebrow' => '',
    'title',
    'intro' => '',
    'compact' => false,
    'variant' => 'default',
    'image' => null,
    'imageAlt' => '',
])

<section class="inner-hero inner-hero--{{ $variant }} {{ $image ? 'inner-hero--has-image' : '' }} {{ $compact ? 'inner-hero--compact' : '' }}">
    <div class="inner-hero-content">
        <div class="inner-hero-copy">
            @if ($eyebrow !== '')
                <p class="eyebrow">{{ $eyebrow }}</p>
            @endif
            <h1>{{ $title }}</h1>
            @if ($intro !== '')
                <p class="inner-intro">{{ $intro }}</p>
            @endif
        </div>

        <div class="inner-hero-visual {{ $image ? 'inner-hero-visual--photo' : '' }}" @if (! $image) aria-hidden="true" @endif>
            @if ($image)
                <img
                    class="inner-hero-photo"
                    src="{{ $image }}"
                    alt="{{ $imageAlt }}"
                    width="900"
                    height="520"
                    loading="eager"
                    decoding="async"
                >
            @else
                @include('partials.inner-hero-visual', ['variant' => $variant])
            @endif
        </div>
    </div>
</section>
