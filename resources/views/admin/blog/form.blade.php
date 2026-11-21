@extends('admin.layouts.app')
@section('title', $post->exists ? 'Edit post' : 'Add post')
@section('content')
<div class="admin-page-heading">
    <h1>{{ $post->exists ? 'Edit post' : 'Add post' }}</h1>
</div>
<form class="admin-form" method="POST" enctype="multipart/form-data" action="{{ $post->exists ? route('admin.blog.update', $post) : route('admin.blog.store') }}">
    @csrf
    @if ($post->exists) @method('PUT') @endif
    <div class="admin-form-grid">
        <div class="admin-field admin-field--full">
            <label>Title</label>
            <input name="title" value="{{ old('title', $post->title) }}" required>
            @error('title')<span class="field-error">{{ $message }}</span>@enderror
            @error('slug')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="admin-field">
            <label>Tag</label>
            <input name="tag" value="{{ old('tag', $post->tag) }}">
        </div>
        <div class="admin-field">
            <label>Read time</label>
            <input name="read_time" value="{{ old('read_time', $post->read_time) }}">
        </div>
        <div class="admin-field admin-field--full">
            <label>Excerpt</label>
            <textarea name="excerpt">{{ old('excerpt', $post->excerpt) }}</textarea>
        </div>
        <div class="admin-field admin-field--full">
            <label>Body</label>
            <textarea name="body">{{ old('body', $post->body) }}</textarea>
        </div>
        <div class="admin-field admin-field--full">
            <label>Image</label>
            <input type="file" name="image" accept="image/*">
        </div>
        @if ($post->image_path)
            <p class="admin-media-preview">
                <img src="{{ \App\Support\Media::url($post->image_path) }}" alt="">
            </p>
        @endif
        <label class="admin-checkbox">
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $post->is_published ?? true))>
            Published on website
        </label>
    </div>
    <div class="admin-form-actions">
        <a class="btn btn-outline" href="{{ route('admin.blog.index') }}">Cancel</a>
        <button class="btn btn-primary" type="submit">Save post</button>
    </div>
</form>
@endsection
