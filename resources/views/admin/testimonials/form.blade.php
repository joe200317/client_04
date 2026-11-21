@extends('admin.layouts.app')
@section('title', $testimonial->exists ? 'Edit testimonial' : 'Add testimonial')
@section('content')
<div class="admin-page-heading">
    <h1>{{ $testimonial->exists ? 'Edit testimonial' : 'Add testimonial' }}</h1>
</div>
<form class="admin-form" method="POST" action="{{ $testimonial->exists ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}">
    @csrf
    @if ($testimonial->exists) @method('PUT') @endif
    <div class="admin-form-grid">
        <div class="admin-field">
            <label>Name</label>
            <input name="name" value="{{ old('name', $testimonial->name) }}" required>
        </div>
        <div class="admin-field">
            <label>Role</label>
            <input name="role" value="{{ old('role', $testimonial->role) }}">
        </div>
        <div class="admin-field admin-field--full">
            <label>Quote</label>
            <textarea name="quote" required>{{ old('quote', $testimonial->quote) }}</textarea>
        </div>
        <label class="admin-checkbox">
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $testimonial->is_published ?? true))>
            Published on website
        </label>
    </div>
    <div class="admin-form-actions">
        <a class="btn btn-outline" href="{{ route('admin.testimonials.index') }}">Cancel</a>
        <button class="btn btn-primary" type="submit">Save testimonial</button>
    </div>
</form>
@endsection
