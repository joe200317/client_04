@extends('admin.layouts.app')
@section('title', 'Change login')
@section('content')
<div class="admin-page-heading">
    <h1>Change login</h1>
</div>
<p class="admin-intro">Update your admin name, email, or password.</p>
<form class="admin-form" method="POST" action="{{ route('admin.profile.update') }}">
    @csrf
    @method('PUT')
    <div class="admin-form-grid">
        <div class="admin-field">
            <label>Name</label>
            <input name="name" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="admin-field">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="admin-field admin-field--full">
            <label>Current password</label>
            <input type="password" name="current_password">
            @error('current_password')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="admin-field">
            <label>New password</label>
            <input type="password" name="password">
            @error('password')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="admin-field">
            <label>Confirm new password</label>
            <input type="password" name="password_confirmation">
        </div>
    </div>
    <div class="admin-form-actions">
        <button class="btn btn-primary" type="submit">Save changes</button>
    </div>
</form>
@endsection
