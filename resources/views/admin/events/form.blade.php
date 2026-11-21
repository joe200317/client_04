@extends('admin.layouts.app')
@section('title', $event->exists ? 'Edit event' : 'Add event')
@section('content')
<div class="admin-page-heading">
    <h1>{{ $event->exists ? 'Edit event' : 'Add event' }}</h1>
</div>
<form class="admin-form" method="POST" enctype="multipart/form-data" action="{{ $event->exists ? route('admin.events.update', $event) : route('admin.events.store') }}">
    @csrf
    @if ($event->exists) @method('PUT') @endif
    <div class="admin-form-grid">
        <div class="admin-field admin-field--full">
            <label>Title</label>
            <input name="title" value="{{ old('title', $event->title) }}" required>
        </div>
        <div class="admin-field">
            <label>Subtitle</label>
            <input name="subtitle" value="{{ old('subtitle', $event->subtitle) }}" placeholder="e.g. Corporate Workshop">
        </div>
        <div class="admin-field">
            <label>Event date</label>
            <input type="date" name="event_date" value="{{ old('event_date', optional($event->event_date)->format('Y-m-d')) }}">
        </div>
        <div class="admin-field">
            <label>Location</label>
            <input name="location" value="{{ old('location', $event->location) }}" placeholder="e.g. Pune / Online">
        </div>
        <div class="admin-field admin-field--full">
            <label>Description</label>
            <textarea name="description">{{ old('description', $event->description) }}</textarea>
        </div>
        <div class="admin-field admin-field--full">
            <label>Hero slider image {{ $event->exists ? '(leave empty to keep current)' : '' }}</label>
            <input type="file" name="image" accept="image/*" @required(! $event->exists)>
        </div>
        @if ($event->image_path)
            <p class="admin-media-preview">
                <img src="{{ \App\Support\Media::url($event->image_path) }}" alt="">
            </p>
        @endif
        <label class="admin-checkbox">
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $event->is_published ?? true))>
            Published on website
        </label>
    </div>
    <div class="admin-form-actions">
        <a class="btn btn-outline" href="{{ route('admin.events.index') }}">Cancel</a>
        <button class="btn btn-primary" type="submit">Save event</button>
    </div>
</form>
@endsection
