@extends('layouts.app')

@section('title', 'About Us')

@section('content')
@include('partials.inner-hero', [
    'eyebrow' => 'About Us',
    'title' => 'Helping You Build a Stronger, Sharper Mind',
    'intro' => 'Mind Trainer partners with professionals and organizations to unlock clarity, focus and sustainable high performance.',
    'variant' => 'about',
    'image' => asset('images/about-banner.png'),
    'imageAlt' => 'Meditation and growth journey — Mind Trainer About Us',
])

<section class="info-content section-wrap">
    <div class="info-copy">
        <p>Founded with a simple belief — that mental fitness is as essential as physical fitness — Mind Trainer designs programs that strengthen attention, memory, emotional regulation and leadership presence.</p>
        <p>From one-on-one coaching to corporate workshops, every engagement is practical, science-informed and tailored to real workplace challenges.</p>
        <p>Our trainers combine cognitive tools, mindfulness practices and performance coaching so individuals and teams can think clearer and perform with calm confidence.</p>
        <a class="button button-primary" href="{{ route('contact') }}">Book a Session →</a>
    </div>
    <div class="quote-card">
        <span class="quote-mark" aria-hidden="true">“</span>
        <p>Train the mind. Transform performance.</p>
    </div>
</section>

<section class="values-section section-wrap">
    <p class="eyebrow">What Sets Us Apart</p>
    <h2>Expert guidance with a <span class="gradient-text">personal approach</span></h2>
    <div class="value-grid">
        @foreach ([
            ['01', 'Expert Trainers', 'Seasoned facilitators with deep coaching experience.'],
            ['02', 'Science-Backed Methods', 'Tools grounded in cognitive and behavioral science.'],
            ['03', 'Personalized Approach', 'Flexible pathways for individuals and teams.'],
        ] as [$num, $title, $text])
            <article class="value-card">
                <span class="value-number">{{ $num }}</span>
                <h3>{{ $title }}</h3>
                <p>{{ $text }}</p>
            </article>
        @endforeach
    </div>
</section>

<section class="page-cta section-wrap">
    <div>
        <p class="eyebrow">10+ Years in Mind Training</p>
        <h2>Ready to sharpen your focus and leadership?</h2>
    </div>
    <a class="button button-primary" href="{{ route('contact') }}">Get Started →</a>
</section>
@endsection
