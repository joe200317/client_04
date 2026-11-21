@extends('layouts.app')

@section('title', 'Contact')

@section('content')
@include('partials.inner-hero', [
    'eyebrow' => 'Contact',
    'title' => 'Let’s Work Together',
    'intro' => 'Book a session, ask about corporate programs, or simply start a conversation.',
    'variant' => 'contact',
    'image' => asset('images/contact-banner.png'),
    'imageAlt' => 'Contact support — call, email and visit Mind Trainer',
])

<section class="contact-section section-wrap">
    <div class="contact-copy">
        <p class="eyebrow">Get in touch</p>
        <h2>Connect with Mind Trainer</h2>
        <p>Tell us about your goals — personal growth, team training or leadership coaching — and we will guide the next step.</p>

        <div class="contact-detail">
            <span class="round-icon gold-icon" aria-hidden="true">☎</span>
            <div>
                <strong>Phone</strong>
                <p>+91 98765 43210</p>
            </div>
        </div>
        <div class="contact-detail">
            <span class="round-icon gold-icon" aria-hidden="true">✉</span>
            <div>
                <strong>Email</strong>
                <p>hello@mindtrainer.in</p>
            </div>
        </div>
        <div class="contact-detail">
            <span class="round-icon gold-icon" aria-hidden="true">◎</span>
            <div>
                <strong>Location</strong>
                <p>Pune, Maharashtra, India</p>
            </div>
        </div>
    </div>

    <div class="contact-form">
        <h2>Send a Message</h2>

        @if (session('success'))
            <div class="form-alert">{{ session('success') }}</div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <label for="name">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required>
            @error('name')<span class="field-error">{{ $message }}</span>@enderror

            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required>
            @error('email')<span class="field-error">{{ $message }}</span>@enderror

            @include('partials.contact-topic-field')
            @include('partials.contact-book-order-fields')

            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
            @error('message')<span class="field-error">{{ $message }}</span>@enderror

            <button class="button button-primary" type="submit">Send Message →</button>
            <p class="form-note">We respond as soon as possible.</p>
        </form>
    </div>
</section>
@endsection
