@extends('layouts.app')

@section('title', 'Home')

@section('content')
@if (session('success'))
    <div class="section-wrap form-alert form-alert--toast" role="status">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="section-wrap form-alert form-alert--error" role="alert">
        Please check the enquiry form and try again.
    </div>
@endif

<section class="hero-banner reveal-on-scroll" aria-label="Mind Trainer hero" data-hero-slider>
    <div class="hero-banner-stack">
        <div class="hero-banner-frame">
            <div class="hero-slides">
                <article class="hero-slide is-active" data-duration="5000" aria-label="Main banner">
                    <img
                        src="{{ asset('images/hero-banner.jpg') }}"
                        alt="Unlock the Power of Your Mind — Corporate mind training for focus, memory, emotional balance and leadership"
                        width="1600"
                        height="700"
                        fetchpriority="high"
                    >
                    <div class="hero-banner-overlay">
                        <a class="hero-btn hero-btn--primary" href="{{ route('contact') }}">
                            Book 1-on-1 Session
                            <span aria-hidden="true">→</span>
                        </a>
                        <a class="hero-btn hero-btn--outline" href="{{ route('services') }}">
                            <span class="hero-btn-play" aria-hidden="true">▶</span>
                            Explore Programs
                        </a>
                    </div>
                </article>

                @foreach ($upcomingPrograms as $program)
                    <article
                        class="hero-slide hero-slide--event"
                        data-duration="3000"
                        aria-label="{{ $program->title }}"
                        data-event-open
                        data-event-id="{{ $program->id }}"
                        data-event-title="{{ $program->title }}"
                        data-event-meta="{{ collect([$program->event_date?->format('d M Y'), $program->location])->filter()->implode(' · ') }}"
                        data-event-description="{{ $program->description ?: ($program->subtitle ?: '') }}"
                    >
                        <img
                            src="{{ \App\Support\Media::url($program->image_path) }}"
                            alt="{{ $program->title }}"
                            width="1600"
                            height="700"
                            loading="lazy"
                        >
                        <div class="hero-event-overlay">
                            <p class="eyebrow">Upcoming Program</p>
                            <h2>{{ $program->title }}</h2>
                            @if ($program->subtitle)
                                <p class="hero-event-subtitle">{{ $program->subtitle }}</p>
                            @endif
                            <div class="hero-event-meta">
                                @if ($program->event_date)
                                    <span>{{ $program->event_date->format('d M Y') }}</span>
                                @endif
                                @if ($program->location)
                                    <span>{{ $program->location }}</span>
                                @endif
                            </div>
                            <button class="hero-btn hero-btn--primary" type="button" data-event-open>
                                Enquire Now →
                            </button>
                        </div>
                    </article>
                @endforeach
            </div>

            @if ($upcomingPrograms->isNotEmpty())
                <div class="hero-slider-dots" role="tablist" aria-label="Hero slides"></div>
            @endif
        </div>

        <section class="hero-benefits-row hero-benefits-row--banner" aria-label="Training benefits">
            @foreach ([
                ['Boost Memory', 'memory'],
                ['Improve Focus', 'focus'],
                ['Enhance Logic', 'logic'],
                ['Manage Stress', 'stress'],
                ['Build Leadership', 'leadership'],
                ['Increase Productivity', 'productivity'],
            ] as [$label, $icon])
                <div class="hero-benefit-item">
                    @include('partials.benefit-icon', ['name' => $icon])
                    <p>{!! str_replace(' ', '<br>', e($label)) !!}</p>
                </div>
            @endforeach
        </section>
    </div>
</section>

<section class="home-discover home-discover--wide section-wrap">
    <div class="home-discover-inner home-discover-inner--full reveal-on-scroll">
        <p class="eyebrow">About Us</p>
        <h2>Helping You Build a <span class="gradient-text">Stronger, Sharper Mind</span></h2>
        <p>We blend practical neuroscience, mindfulness and high-performance coaching to help professionals think clearer, lead better and perform under pressure.</p>
        <p>From one-on-one sessions to corporate workshops, every engagement is designed to strengthen attention, memory, emotional balance and leadership presence.</p>
        <a class="text-link" href="{{ route('about') }}" style="margin-top: 10px; width: fit-content;">Learn More About Us →</a>
    </div>
</section>

<section class="proof-strip proof-strip--after-about" id="why-learn" aria-label="Why Mind Trainer">
    <article class="proof-item reveal-on-scroll">
        <span class="proof-icon gold-wash" aria-hidden="true">★</span>
        <div>
            <h2>Expert Trainers</h2>
            <p>Guided by specialists in cognitive performance</p>
        </div>
    </article>
    <article class="proof-item reveal-on-scroll">
        <span class="proof-icon gold-wash" aria-hidden="true">↗</span>
        <div>
            <h2>10+ Years Experience</h2>
            <p>Proven methods for individuals and teams</p>
        </div>
    </article>
    <article class="proof-item reveal-on-scroll">
        <span class="proof-icon gold-wash" aria-hidden="true">✦</span>
        <div>
            <h2>Science-Backed</h2>
            <p>Practical tools rooted in mind training research</p>
        </div>
    </article>
    <article class="proof-item reveal-on-scroll">
        <span class="proof-icon gold-wash" aria-hidden="true">◆</span>
        <div>
            <h2>Personalized</h2>
            <p>Programs shaped around your goals and pace</p>
        </div>
    </article>
</section>

<section class="programs-section section-wrap" id="services">
    <div class="section-heading-row">
        <div>
            <p class="eyebrow">Our Programs</p>
            <h2>Structured Training <span class="gradient-text">Programs</span></h2>
        </div>
        <a class="text-link" href="{{ route('services') }}">View All Services →</a>
    </div>

    <div class="program-card-grid">
        @forelse ($services as $service)
            <article class="program-card">
                <div class="program-card-top">
                    <span class="program-type-pill">{{ $service->duration_label ?: ($service->group_name ?: 'Program') }}</span>
                </div>
                <h4>{{ $service->title }}</h4>
                <p>{{ $service->description }}</p>
                <div class="program-card-bottom">
                    <strong>Enquire</strong>
                    <a href="{{ route('contact') }}">Know more →</a>
                </div>
            </article>
        @empty
            <p style="grid-column: 1 / -1; color: #7a6a58;">Programs will appear here once added from admin.</p>
        @endforelse
    </div>

</section>

@if ($testimonials->isNotEmpty())
<section class="section-wrap" style="padding-top: 20px; padding-bottom: 10px;">
    <p class="eyebrow">What learners share</p>
    <h2 class="heading-display" style="font-size: clamp(26px, 3vw, 34px);">Testimonials</h2>
    <div class="program-card-grid" style="margin-top: 18px;">
        @foreach ($testimonials as $testimonial)
            <article class="program-card">
                <p>{{ $testimonial->quote }}</p>
                <div class="program-card-bottom">
                    <strong>{{ $testimonial->name }}</strong>
                    <span>{{ $testimonial->role }}</span>
                </div>
            </article>
        @endforeach
    </div>
</section>
@endif

<section class="contact-section section-wrap">
    <div class="contact-copy">
        <p class="eyebrow">Contact Us</p>
        <h2>Let’s Work Together</h2>
        <p>Ready to train your mind for clarity, confidence and peak performance? Reach out today.</p>
        <div class="contact-detail">
            <span class="round-icon gold-icon" aria-hidden="true">☎</span>
            <div><strong>Phone</strong><p>+91 98765 43210</p></div>
        </div>
        <div class="contact-detail">
            <span class="round-icon gold-icon" aria-hidden="true">✉</span>
            <div><strong>Email</strong><p>hello@mindtrainer.in</p></div>
        </div>
        <div class="contact-detail">
            <span class="round-icon gold-icon" aria-hidden="true">◎</span>
            <div><strong>Location</strong><p>Pune, Maharashtra, India</p></div>
        </div>
    </div>

    <div class="contact-form">
        <h2>Send a Message</h2>
        <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <label for="home-name">Name</label>
            <input id="home-name" name="name" type="text" required>
            <label for="home-email">Email</label>
            <input id="home-email" name="email" type="email" required>
            @include('partials.contact-topic-field', ['fieldId' => 'home-topic'])
            @include('partials.contact-book-order-fields', ['prefix' => 'home', 'orderBooks' => $orderBooks])
            <label for="home-message">Message</label>
            <textarea id="home-message" name="message" rows="4" required></textarea>
            <button class="button button-primary" type="submit">Send Message →</button>
        </form>
    </div>
</section>

@include('partials.event-enquiry-modal')
@endsection
