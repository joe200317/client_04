@extends('admin.layouts.app')
@section('title', 'Create admin')
@section('content')
<div class="admin-page-heading">
    <h1>Create admin</h1>
</div>
<p class="admin-intro">Add another person who can manage website content.</p>
<form class="admin-form" method="POST" action="{{ route('admin.admins.store') }}">
    @csrf
    <div class="admin-form-grid">
        <div class="admin-field">
            <label>Name</label>
            <input name="name" value="{{ old('name') }}" required>
            @error('name')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="admin-field">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="admin-field">
            <label>Password</label>
            <input type="password" name="password" required>
            @error('password')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="admin-field">
            <label>Confirm password</label>
            <input type="password" name="password_confirmation" required>
        </div>
    </div>
    <div class="admin-form-actions">
        <button class="btn btn-primary" type="submit">Create admin</button>
    </div>
</form>

<div class="admin-table-wrap" style="margin-top:24px;">
    <table class="admin-table">
        <thead><tr><th>Existing admins</th><th>Email</th></tr></thead>
        <tbody>
            @foreach ($admins as $admin)
                <tr>
                    <td><strong>{{ $admin->name }}</strong></td>
                    <td>{{ $admin->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
