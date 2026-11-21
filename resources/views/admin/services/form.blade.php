@extends('admin.layouts.app')
@section('title', $service->exists ? 'Edit service' : 'Add service')
@section('content')
<div class="admin-page-heading">
    <h1>{{ $service->exists ? 'Edit service' : 'Add service' }}</h1>
</div>
<form class="admin-form" method="POST" action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}">
    @csrf
    @if ($service->exists) @method('PUT') @endif
    <div class="admin-form-grid">
        <div class="admin-field admin-field--full">
            <label>Title</label>
            <input name="title" value="{{ old('title', $service->title) }}" required>
            @error('title')<span class="field-error">{{ $message }}</span>@enderror
            @error('slug')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="admin-field">
            <label>Group</label>
            <input name="group_name" value="{{ old('group_name', $service->group_name) }}">
        </div>
        <div class="admin-field">
            <label>Duration label</label>
            <input name="duration_label" value="{{ old('duration_label', $service->duration_label) }}">
        </div>
        <div class="admin-field admin-field--full">
            <label>Description</label>
            <textarea name="description">{{ old('description', $service->description) }}</textarea>
        </div>
        <label class="admin-checkbox">
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $service->is_published ?? true))>
            Published on website
        </label>
    </div>
    <div class="admin-form-actions">
        <a class="btn btn-outline" href="{{ route('admin.services.index') }}">Cancel</a>
        <button class="btn btn-primary" type="submit">Save service</button>
    </div>
</form>
@endsection
