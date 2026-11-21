@php
    $name = $name ?? 'brain';
@endphp

@switch($name)
    @case('brain')
        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
            <path d="M9 4a3 3 0 00-3 3v1a3 3 0 00-1.5 5.6V17a3 3 0 003 3h1"/><path d="M15 4a3 3 0 013 3v1a3 3 0 011.5 5.6V17a3 3 0 01-3 3h-1"/><path d="M12 4v16M9 9h3M12 12h3M9 15h3"/>
        </svg>
        @break
    @case('target')
        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
            <circle cx="12" cy="12" r="8"/><circle cx="12" cy="12" r="4"/><circle cx="12" cy="12" r="1.5" fill="currentColor"/>
        </svg>
        @break
    @case('puzzle')
        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
            <path d="M10 4h4v3a2 2 0 104 0V4h2v6h-3a2 2 0 100 4h3v6h-6v-3a2 2 0 10-4 0v3H4v-6h3a2 2 0 100-4H4V4h6v3a2 2 0 104 0V4z"/>
        </svg>
        @break
    @case('rocket')
        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
            <path d="M14 4c3 1 5 4 6 8-4 1-7 3-8 6-4-1-7-4-8-8 4-1 7-3 10-6z"/><circle cx="14" cy="10" r="1.5"/><path d="M6 16l-2 4 4-2"/>
        </svg>
        @break
    @case('book')
        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
            <path d="M4 5.5A2.5 2.5 0 016.5 3H20v16H6.5A2.5 2.5 0 004 16.5v-11z"/><path d="M4 16.5A2.5 2.5 0 016.5 19H20"/>
        </svg>
        @break
    @case('levels')
        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
            <path d="M4 19h16M7 15h10M9 11h6M11 7h2"/>
        </svg>
        @break
    @default
        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><circle cx="12" cy="12" r="6"/></svg>
@endswitch
