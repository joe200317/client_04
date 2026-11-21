@extends('layouts.app')

@section('title', 'Mission & Vision')

@section('content')
@include('partials.inner-hero', [
    'eyebrow' => 'Mission & Vision',
    'title' => 'Why We Train Minds',
    'intro' => 'Our purpose is to make mental fitness accessible, practical and transformative for every professional.',
    'variant' => 'mission',
    'image' => asset('images/mission-banner.png'),
    'imageAlt' => 'Vision and mission journey toward clear goals',
])

<section class="section-wrap" style="padding-top: 20px;">
    <div class="mission-vision-jump">
        <a href="#mission">Mission</a>
        <a href="#vision">Vision</a>
    </div>
</section>

<section class="mission-vision-section section-wrap" id="mission">
    <div class="section-heading-row">
        <div>
            <p class="eyebrow">01 Mission</p>
            <h2>Empower people with practical mind-training systems</h2>
        </div>
    </div>
    <div class="mission-vision-content">
        <div class="info-copy">
            <p class="mission-vision-intro">Improve focus, memory, emotional balance and leadership performance.</p>
            <p>Mind Trainer helps individuals and organizations build mental fitness through workshops, coaching and structured programs that fit real work and life demands.</p>
        </div>
        <div class="quote-card">
            <span class="quote-mark" aria-hidden="true">“</span>
            <p>Unlock the Power of Your Mind.</p>
        </div>
    </div>
</section>

<section class="mission-vision-section section-wrap" id="vision">
    <div class="section-heading-row">
        <div>
            <p class="eyebrow">02 Vision</p>
            <h2>A world where mental fitness is a shared standard</h2>
        </div>
    </div>
    <div class="mission-vision-content mission-vision-content--quote-left">
        <div class="quote-card">
            <span class="quote-mark" aria-hidden="true">“</span>
            <p>Teams that think clearly, lead wisely and perform without burnout.</p>
        </div>
        <div class="info-copy">
            <p class="mission-vision-intro">Clarity, discipline and impact — for every learner.</p>
            <p>We envision workplaces and communities where focus, resilience and purposeful leadership are trained as intentionally as any professional skill.</p>
        </div>
    </div>

    <div class="value-grid">
        @foreach ([
            ['01', 'Integrity', 'We teach only what we practice and measure.'],
            ['02', 'Compassion', 'Growth happens best in a supportive space.'],
            ['03', 'Excellence', 'We pursue clarity, craft and continuous improvement.'],
        ] as [$num, $title, $text])
            <article class="value-card">
                <span class="value-number">{{ $num }}</span>
                <h3>{{ $title }}</h3>
                <p>{{ $text }}</p>
            </article>
        @endforeach
    </div>
</section>
@endsection
