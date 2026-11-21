@extends('admin.layouts.app')
@section('title', $item->exists ? 'Edit gallery item' : 'Add gallery item')
@section('content')
<div class="admin-page-heading">
    <h1>{{ $item->exists ? 'Edit gallery item' : 'Add gallery item' }}</h1>
</div>
<form class="admin-form" method="POST" enctype="multipart/form-data" action="{{ $item->exists ? route('admin.gallery.update', $item) : route('admin.gallery.store') }}">
    @csrf
    @if ($item->exists) @method('PUT') @endif
    <div class="admin-form-grid">
        <div class="admin-field admin-field--full">
            <label>Title</label>
            <input name="title" value="{{ old('title', $item->title) }}" required>
        </div>
        <div class="admin-field admin-field--full">
            <label>Caption</label>
            <textarea name="caption">{{ old('caption', $item->caption) }}</textarea>
        </div>
        <div class="admin-field admin-field--full">
            <label>Image {{ $item->exists ? '(optional)' : '' }}</label>
            <input type="file" name="image" accept="image/*" @required(! $item->exists)>
        </div>
        @if ($item->image_path)
            <p class="admin-media-preview">
                <img src="{{ \App\Support\Media::url($item->image_path) }}" alt="">
            </p>
        @endif
        <label class="admin-checkbox">
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $item->is_published ?? true))>
            Published on website
        </label>
    </div>
    <div class="admin-form-actions">
        <a class="btn btn-outline" href="{{ route('admin.gallery.index') }}">Cancel</a>
        <button class="btn btn-primary" type="submit">Save item</button>
    </div>
</form>
@endsection
