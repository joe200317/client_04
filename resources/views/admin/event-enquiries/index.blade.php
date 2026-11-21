@extends('admin.layouts.app')
@section('title', 'Event enquiries')
@section('content')
<div class="admin-page-heading">
    <h1>Event enquiries</h1>
</div>
<p class="admin-intro">Enquiries submitted from upcoming event slides on the website.</p>
<div class="admin-table-wrap">
    <table class="admin-table">
        <thead>
            <tr>
                <th>From</th>
                <th>Event</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @forelse ($enquiries as $enquiry)
            <tr>
                <td>
                    <strong>{{ $enquiry->name }}</strong><br>
                    <small>{{ $enquiry->email }}</small>
                </td>
                <td>{{ $enquiry->event?->title ?: '—' }}</td>
                <td>
                    <span class="admin-badge {{ $enquiry->is_read ? 'admin-badge--draft' : 'admin-badge--live' }}">
                        {{ $enquiry->is_read ? 'Read' : 'Unread' }}
                    </span>
                </td>
                <td class="admin-row-actions">
                    <a href="{{ route('admin.event-enquiries.show', $enquiry) }}">View</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">No event enquiries yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
{{ $enquiries->links() }}
@endsection
