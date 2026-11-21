@php
    $variant = $variant ?? 'default';
@endphp

@if ($variant === 'gallery')
    <div class="gallery-collage" aria-hidden="true">
        <span class="gallery-collage__beam"></span>
        <span class="gallery-collage__orb gallery-collage__orb--a"></span>
        <span class="gallery-collage__orb gallery-collage__orb--b"></span>
        <span class="gallery-collage__leaf gallery-collage__leaf--left"></span>
        <span class="gallery-collage__leaf gallery-collage__leaf--right"></span>

        <article class="gallery-polaroid gallery-polaroid--one">
            <span class="gallery-polaroid__shot gallery-polaroid__shot--peak"></span>
            <strong>Rise</strong>
        </article>
        <article class="gallery-polaroid gallery-polaroid--two">
            <span class="gallery-polaroid__shot gallery-polaroid__shot--mind"></span>
            <strong>Mind</strong>
        </article>
        <article class="gallery-polaroid gallery-polaroid--three">
            <span class="gallery-polaroid__shot gallery-polaroid__shot--learn"></span>
            <strong>Learn</strong>
        </article>
        <article class="gallery-polaroid gallery-polaroid--four">
            <span class="gallery-polaroid__shot gallery-polaroid__shot--calm"></span>
            <strong>Calm</strong>
        </article>

        <div class="gallery-camera">
            <span class="gallery-camera__body"></span>
            <span class="gallery-camera__lens"></span>
            <span class="gallery-camera__flash"></span>
        </div>
        <div class="gallery-film"></div>
    </div>
@else
    <div class="hero-visual hero-visual--{{ $variant }}">
        <span class="hero-visual__glow"></span>
        <span class="hero-visual__ring"></span>
        <span class="hero-visual__ring hero-visual__ring--soft"></span>

        @switch($variant)
            @case('about')
                <svg class="hero-visual__icon" viewBox="0 0 120 120" fill="none">
                    <path d="M60 18c-12 0-22 10-22 22 0 18 22 40 22 40s22-22 22-40c0-12-10-22-22-22Z" stroke="#c9a227" stroke-width="3"/>
                    <circle cx="60" cy="40" r="10" fill="#e0bc4a"/>
                    <path d="M34 92c8-12 18-18 26-18s18 6 26 18" stroke="#a8861a" stroke-width="3" stroke-linecap="round"/>
                </svg>
                @break

            @case('services')
                <svg class="hero-visual__icon" viewBox="0 0 120 120" fill="none">
                    <rect x="22" y="28" width="28" height="28" rx="8" fill="#e0bc4a"/>
                    <rect x="70" y="28" width="28" height="28" rx="8" fill="#c9a227"/>
                    <rect x="22" y="70" width="28" height="28" rx="8" fill="#c9a227"/>
                    <rect x="70" y="70" width="28" height="28" rx="8" fill="#e0bc4a"/>
                </svg>
                @break

            @case('books')
                <svg class="hero-visual__icon" viewBox="0 0 120 120" fill="none">
                    <path d="M28 30h34c8 0 14 6 14 14v52c-8-5-14-6-20-6H28V30Z" fill="#e0bc4a"/>
                    <path d="M92 30H58c-8 0-14 6-14 14v52c8-5 14-6 20-6h28V30Z" fill="#c9a227"/>
                    <path d="M60 38v52" stroke="#fff9ee" stroke-width="2"/>
                </svg>
                @break

            @case('blog')
                <svg class="hero-visual__icon" viewBox="0 0 120 120" fill="none">
                    <rect x="30" y="24" width="60" height="72" rx="10" fill="#fff9ee" stroke="#c9a227" stroke-width="3"/>
                    <path d="M44 42h32M44 56h32M44 70h22" stroke="#a8861a" stroke-width="3" stroke-linecap="round"/>
                </svg>
                @break

            @case('contact')
                <svg class="hero-visual__icon" viewBox="0 0 120 120" fill="none">
                    <rect x="24" y="34" width="72" height="48" rx="10" fill="#fff9ee" stroke="#c9a227" stroke-width="3"/>
                    <path d="M28 40l32 22 32-22" stroke="#a8861a" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                @break

            @case('mission')
                <svg class="hero-visual__icon" viewBox="0 0 120 120" fill="none">
                    <circle cx="60" cy="60" r="34" stroke="#c9a227" stroke-width="3"/>
                    <circle cx="60" cy="60" r="18" stroke="#e0bc4a" stroke-width="3"/>
                    <circle cx="60" cy="60" r="6" fill="#a8861a"/>
                    <path d="M60 18v12M60 90v12M18 60h12M90 60h12" stroke="#c9a227" stroke-width="3" stroke-linecap="round"/>
                </svg>
                @break

            @default
                <svg class="hero-visual__icon" viewBox="0 0 120 120" fill="none">
                    <path d="M38 78c8-28 18-42 22-48 4 6 14 20 22 48" stroke="#c9a227" stroke-width="3" stroke-linecap="round"/>
                    <circle cx="60" cy="36" r="10" fill="#e0bc4a"/>
                    <path d="M34 86h52" stroke="#a8861a" stroke-width="3" stroke-linecap="round"/>
                </svg>
        @endswitch

        <div class="hero-visual__chips">
            @foreach ([
                'about' => ['Clarity', 'Focus', 'Growth'],
                'services' => ['Memory', 'Focus', 'Leadership'],
                'books' => ['Learn', 'Apply', 'Grow'],
                'blog' => ['Ideas', 'Practice', 'Insight'],
                'contact' => ['Talk', 'Plan', 'Begin'],
                'mission' => ['Purpose', 'Impact', 'Vision'],
                'default' => ['Mind', 'Train', 'Perform'],
            ][$variant] ?? ['Mind', 'Train', 'Perform'] as $chip)
                <span>{{ $chip }}</span>
            @endforeach
        </div>
    </div>
@endif
