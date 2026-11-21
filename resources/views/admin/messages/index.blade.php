@extends('admin.layouts.app')
@section('title', 'Contact messages')
@section('content')
<div class="admin-page-heading">
    <h1>Contact messages</h1>
</div>
<p class="admin-intro">Messages submitted from the website contact form.</p>
<div class="admin-table-wrap">
    <table class="admin-table">
        <thead><tr><th>From</th><th>Topic</th><th>Message</th><th>Status</th><th></th></tr></thead>
        <tbody>
        @forelse ($messages as $message)
            <tr>
                <td>
                    <strong>{{ $message->name }}</strong><br>
                    <small>{{ $message->email }}</small>
                </td>
                <td>{{ $message->topic ?: '—' }}</td>
                <td>{{ \Illuminate\Support\Str::limit($message->message, 70) }}</td>
                <td>
                    <span class="admin-badge {{ $message->is_read ? 'admin-badge--draft' : 'admin-badge--live' }}">
                        {{ $message->is_read ? 'Read' : 'Unread' }}
                    </span>
                </td>
                <td class="admin-row-actions">
                    <a href="{{ route('admin.messages.show', $message) }}">View</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">No messages yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
{{ $messages->links() }}
@endsection
