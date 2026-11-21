@php
    $links = [
        ['route' => 'home', 'label' => 'Home'],
        ['route' => 'about', 'label' => 'About Us'],
        ['route' => 'services', 'label' => 'Services'],
        ['route' => 'books', 'label' => 'Books'],
        ['route' => 'gallery', 'label' => 'Gallery'],
        ['route' => 'mission-vision', 'label' => 'Mission & Vision'],
        ['route' => 'blog', 'label' => 'Blog'],
        ['route' => 'contact', 'label' => 'Contact'],
    ];
@endphp

<header class="site-header">
    <div class="header-inner">
        <a class="brand" href="{{ route('home') }}" aria-label="Mind Trainer home">
            <svg class="brand-mark" viewBox="0 0 44 44" aria-hidden="true">
                <path d="M20.8 5.5c-3.8-3-9.2-.3-9.2 4.5-4.8.5-6.9 6.1-3.5 9.6-3.1 3.8-.8 8.9 3.6 9.5-.2 5 5.2 7.9 9.1 4.8V5.5Z" fill="#e0bc4a"></path>
                <path d="M23.2 5.5c3.8-3 9.2-.3 9.2 4.5 4.8.5 6.9 6.1 3.5 9.6 3.1 3.8.8 8.9-3.6 9.5.2 5-5.2 7.9-9.1 4.8V5.5Z" fill="#c9a227"></path>
                <path d="M22 5v30M14 12l5 3m-8 6 8 1m-5 7 5-3m11-14-5 3m8 6-8 1m5 7-5-3" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="1.8"></path>
            </svg>
            <span class="brand-copy">
                <strong>Mind Trainer</strong>
                <small>Unlock the Power of Your Mind</small>
            </span>
        </a>

        <button class="menu-toggle" type="button" aria-label="Open navigation" aria-expanded="false" aria-controls="primary-navigation">
            <span></span><span></span><span></span>
        </button>

        <nav class="primary-navigation" id="primary-navigation" aria-label="Main navigation">
            @foreach ($links as $link)
                <a
                    href="{{ route($link['route']) }}"
                    class="{{ request()->routeIs($link['route']) ? 'is-active' : '' }}"
                    @if (request()->routeIs($link['route'])) aria-current="page" @endif
                >{{ $link['label'] }}</a>
            @endforeach
        </nav>

        <a class="header-cta" href="{{ route('contact') }}">Get Started <span aria-hidden="true">→</span></a>
    </div>
</header>
