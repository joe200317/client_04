@extends('layouts.app')

@section('title', 'Blog')

@section('content')
@include('partials.inner-hero', [
    'eyebrow' => 'Blog',
    'title' => 'Insights for Mental Fitness',
    'intro' => 'Ideas and practices that support focus, memory, confidence and peak performance.',
    'variant' => 'blog',
    'image' => asset('images/blog-banner.png'),
    'imageAlt' => 'Writing and content creation — Mind Trainer blog',
])

<section class="blog-section section-wrap">
    <div class="blog-grid">
        @forelse ($posts as $post)
            <article class="blog-card {{ $post->image_path ? '' : 'blog-card--plain' }}">
                @if ($post->image_path)
                    <div class="blog-art">
                        <img src="{{ \App\Support\Media::url($post->image_path) }}" alt="{{ $post->title }}">
                    </div>
                @endif
                <div class="blog-card-body">
                    <div class="article-meta">
                        <span>{{ $post->tag ?: 'Mind Trainer' }}</span>
                        <span>{{ $post->read_time ?: '5 min read' }}</span>
                    </div>
                    @if ($post->published_at)
                        <p class="article-date">{{ $post->published_at->format('d M Y') }}</p>
                    @endif
                    <h2>{{ $post->title }}</h2>
                    @if ($post->excerpt)
                        <p class="article-summary">{{ $post->excerpt }}</p>
                    @endif
                    @if ($post->body)
                        <details class="article-details">
                            <summary>Read more <span>→</span></summary>
                            <p>{{ $post->body }}</p>
                        </details>
                    @endif
                </div>
            </article>
        @empty
            <p class="blog-empty">No blog posts yet. Add them from the admin panel.</p>
        @endforelse
    </div>
</section>
@endsection
