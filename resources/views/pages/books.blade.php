@extends('layouts.app')

@section('title', 'Books')

@section('content')
@include('partials.inner-hero', [
    'eyebrow' => 'Books',
    'title' => 'Reading for a Sharper Mind',
    'intro' => 'Titles on focus, memory, values and high performance from the Mind Trainer library.',
    'variant' => 'books',
    'image' => asset('images/books-banner.png'),
    'imageAlt' => 'Open books and library — Mind Trainer reading collection',
])

<section class="books-page section-wrap">
    <div class="book-grid">
        @forelse ($books as $book)
            <article class="book-card">
                @if ($book->cover_path)
                    <div class="book-cover book-cover--photo">
                        <img src="{{ \App\Support\Media::url($book->cover_path) }}" alt="{{ $book->title }}">
                    </div>
                @else
                    <div class="book-cover book-cover--{{ $book->cover_tone ?: 'gold' }}">
                        <span class="cover-kicker">Mind Trainer</span>
                        <strong>{{ $book->title }}</strong>
                        <span class="cover-symbol" aria-hidden="true">📖</span>
                        <span class="cover-author">Mind & Growth</span>
                    </div>
                @endif
                <div class="book-info">
                    <h3>{{ $book->title }}</h3>
                    <p>{{ $book->description }}</p>
                </div>
                <div class="book-bottom">
                    <a class="button button-outline book-buy-button" href="{{ route('contact') }}">Enquire</a>
                </div>
            </article>
        @empty
            <p style="grid-column: 1 / -1; color: #7a6a58;">No books published yet. Add them from the admin panel.</p>
        @endforelse
    </div>
</section>
@endsection
