@extends('admin.layouts.app')
@section('title', 'Message')
@section('content')
<div class="admin-page-heading">
    <h1>Message</h1>
    <a class="btn btn-outline" href="{{ route('admin.messages.index') }}">Back to messages</a>
</div>
<div class="admin-form">
    <div class="admin-detail-grid">
        <div class="admin-detail-item">
            <span>From</span>
            <strong>{{ $message->name }} ({{ $message->email }})</strong>
        </div>
        <div class="admin-detail-item">
            <span>Topic</span>
            <strong>{{ $message->topic ?: '—' }}</strong>
        </div>
        <div class="admin-detail-item">
            <span>Received</span>
            <strong>{{ $message->created_at?->format('d M Y, h:i A') }}</strong>
        </div>
        <div class="admin-detail-item">
            <span>Message</span>
            <p>{{ $message->message }}</p>
        </div>
    </div>
    <div class="admin-form-actions">
        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Delete this message?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline" type="submit">Delete message</button>
        </form>
    </div>
</div>
@endsection
