<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login — Mind Trainer</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-auth-body">
    <div class="admin-auth-card">
        <div class="admin-brand"><span>M</span> Mind Trainer</div>
        <h1>Admin Login</h1>
        <p>Sign in to manage website content, events, and messages.</p>

        <form method="POST" action="{{ route('admin.login.attempt') }}">
            @csrf
            <div class="admin-field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')<span class="field-error">{{ $message }}</span>@enderror
            </div>
            <div class="admin-field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
            </div>
            <label class="admin-checkbox">
                <input type="checkbox" name="remember"> Remember me
            </label>
            <button class="btn btn-primary" type="submit" style="width: 100%;">Sign in</button>
        </form>
    </div>
</body>
</html>
