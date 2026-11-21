@extends('layouts.app')

@section('title', 'Services')

@section('content')
@include('partials.inner-hero', [
    'eyebrow' => 'Services',
    'title' => 'Structured Training Programs',
    'intro' => 'Focused pathways to strengthen memory, focus, logic, agility, values and leadership.',
    'variant' => 'services',
    'image' => asset('images/services-banner.png'),
    'imageAlt' => 'Mind training services — focus, growth, mindfulness and achievement',
])

<section class="programs-section programs-page section-wrap">
    <div class="program-card-grid">
        @forelse ($services as $service)
            <article class="program-card">
                <div class="program-card-top">
                    <span class="program-type-pill">{{ $service->duration_label ?: 'Program' }}</span>
                </div>
                <h4>{{ $service->title }}</h4>
                <p>{{ $service->description }}</p>
                <div class="program-card-bottom">
                    <strong>{{ $service->group_name ?: 'Available on request' }}</strong>
                    <a href="{{ route('contact') }}">Enquire Now →</a>
                </div>
            </article>
        @empty
            <p style="grid-column: 1 / -1; color: #7a6a58;">No services published yet. Add them from the admin panel.</p>
        @endforelse
    </div>
</section>
@endsection
