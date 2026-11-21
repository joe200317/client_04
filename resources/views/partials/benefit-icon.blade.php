@php
    $name = $name ?? 'memory';
@endphp

<span class="hero-benefit-icon" aria-hidden="true">
@switch($name)
    @case('memory')
        {{-- Brain --}}
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9.5 4.2a3.2 3.2 0 0 0-3 4.8A3.1 3.1 0 0 0 8 15.2h1.2"/>
            <path d="M14.5 4.2a3.2 3.2 0 0 1 3 4.8A3.1 3.1 0 0 1 16 15.2h-1.2"/>
            <path d="M12 3.8v16.4"/>
            <path d="M9.2 8.2h2.2M12.6 10.8h2.2M9.2 13.4h2.2"/>
            <path d="M8.2 17.8c.9 1.4 2.2 2.2 3.8 2.2s2.9-.8 3.8-2.2"/>
        </svg>
        @break
    @case('focus')
        {{-- Target with arrow --}}
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="13" r="7"/>
            <circle cx="11" cy="13" r="3.5"/>
            <circle cx="11" cy="13" r="1.1" fill="currentColor"/>
            <path d="M14.2 9.8 20 4"/>
            <path d="M16.2 4H20v3.8"/>
        </svg>
        @break
    @case('logic')
        {{-- Lightning bolt --}}
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
            <path d="M13 2 5.5 13.5h5L9.5 22 18.5 10h-5L13 2Z"/>
        </svg>
        @break
    @case('stress')
        {{-- Lotus --}}
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 19c-2.2-1.8-3.6-3.8-3.6-6.1 0-2 1.4-3.4 3.6-4.8 2.2 1.4 3.6 2.8 3.6 4.8 0 2.3-1.4 4.3-3.6 6.1Z"/>
            <path d="M7.2 17.2c-1.8-1.6-2.8-3.3-2.8-5.1 0-2.1 1.5-3.5 3.6-4.6"/>
            <path d="M16.8 17.2c1.8-1.6 2.8-3.3 2.8-5.1 0-2.1-1.5-3.5-3.6-4.6"/>
            <path d="M12 8.2V5.5"/>
            <path d="M9.8 6.2 8.4 4.4"/>
            <path d="M14.2 6.2 15.6 4.4"/>
        </svg>
        @break
    @case('leadership')
        {{-- People / team --}}
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="7.2" r="2.4"/>
            <path d="M7.5 19.5v-1.6A3.4 3.4 0 0 1 10.9 14.5h2.2a3.4 3.4 0 0 1 3.4 3.4v1.6"/>
            <circle cx="5.2" cy="9" r="1.8"/>
            <path d="M2.8 19.5v-1.1A2.6 2.6 0 0 1 5.4 15.8h1"/>
            <circle cx="18.8" cy="9" r="1.8"/>
            <path d="M17.6 15.8h1a2.6 2.6 0 0 1 2.6 2.6v1.1"/>
        </svg>
        @break
    @case('productivity')
        {{-- Growth chart --}}
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 19V5"/>
            <path d="M4 19h16"/>
            <path d="M8 15v-3"/>
            <path d="M12 15V9"/>
            <path d="M16 15V7"/>
            <path d="M14.5 5.5 19 5l-.5 4.5"/>
            <path d="m9 11 3-3 2.2 1.5 4.3-4"/>
        </svg>
        @break
@endswitch
</span>
