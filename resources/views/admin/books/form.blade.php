@extends('admin.layouts.app')
@section('title', $book->exists ? 'Edit book' : 'Add book')
@section('content')
<div class="admin-page-heading">
    <h1>{{ $book->exists ? 'Edit book' : 'Add book' }}</h1>
</div>
<form class="admin-form" method="POST" enctype="multipart/form-data" action="{{ $book->exists ? route('admin.books.update', $book) : route('admin.books.store') }}">
    @csrf
    @if ($book->exists) @method('PUT') @endif
    <div class="admin-form-grid">
        <div class="admin-field admin-field--full">
            <label>Title</label>
            <input name="title" value="{{ old('title', $book->title) }}" required>
            @error('title')<span class="field-error">{{ $message }}</span>@enderror
            @error('slug')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="admin-field admin-field--full">
            <label>Description</label>
            <textarea name="description">{{ old('description', $book->description) }}</textarea>
        </div>
        <div class="admin-field">
            <label>Cover tone</label>
            <select name="cover_tone">
                @foreach (['gold','cream','amber','sand','bronze'] as $tone)
                    <option value="{{ $tone }}" @selected(old('cover_tone', $book->cover_tone ?: 'gold') === $tone)>{{ $tone }}</option>
                @endforeach
            </select>
        </div>
        <div class="admin-field">
            <label>Price</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $book->price) }}">
        </div>
        <div class="admin-field admin-field--full">
            <label>Cover image</label>
            <input type="file" name="cover" accept="image/*">
            @if ($book->cover_path)
                <img src="{{ \App\Support\Media::url($book->cover_path) }}" alt="" style="margin-top:10px;max-width:160px;border-radius:8px;border:1px solid #eadfca;">
            @endif
        </div>
        <label class="admin-checkbox">
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $book->is_published ?? true))>
            Published on website
        </label>
    </div>
    <div class="admin-form-actions">
        <a class="btn btn-outline" href="{{ route('admin.books.index') }}">Cancel</a>
        <button class="btn btn-primary" type="submit">Save book</button>
    </div>
</form>
@endsection
