@extends('layouts.app')

@section('title', 'Gallery')

@section('content')
@include('partials.inner-hero', [
    'eyebrow' => 'Gallery',
    'title' => 'Moments of Growth',
    'intro' => 'Workshops, coaching sessions and community moments from the Mind Trainer journey.',
    'variant' => 'gallery',
    'image' => asset('images/gallery-banner.png'),
    'imageAlt' => 'Camera and photo memories — Mind Trainer gallery',
])

<section class="gallery-page section-wrap">
    <div class="gallery-grid">
        @forelse ($items as $item)
            <figure class="gallery-card">
                <img src="{{ \App\Support\Media::url($item->image_path) }}" alt="{{ $item->title }}" loading="lazy">
                <figcaption>
                    <strong>{{ $item->title }}</strong>
                    @if ($item->caption)<p>{{ $item->caption }}</p>@endif
                </figcaption>
            </figure>
        @empty
            <p style="grid-column: 1 / -1; color: #7a6a58;">No gallery images yet. Add them from the admin panel.</p>
        @endforelse
    </div>
</section>
@endsection
