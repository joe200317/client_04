@extends('admin.layouts.app')
@section('title', 'Upcoming Events')
@section('content')
<div class="admin-page-heading">
    <h1>Upcoming Events</h1>
    <a class="btn btn-primary" href="{{ route('admin.events.create') }}">Add event</a>
</div>
<p class="admin-intro">Published events with an image rotate in the home hero slider (banner 5s, then each event 3s).</p>
<div class="admin-table-wrap">
    <table class="admin-table">
        <thead><tr><th>Image</th><th>Title</th><th>Date</th><th>Location</th><th>Status</th><th></th></tr></thead>
        <tbody>
        @forelse ($events as $event)
            <tr>
                <td>
                    @if ($event->image_path)
                        <img src="{{ \App\Support\Media::url($event->image_path) }}" alt="" style="width:72px;height:44px;object-fit:cover;border-radius:8px;border:1px solid #eadfca;">
                    @else
                        —
                    @endif
                </td>
                <td>
                    <strong>{{ $event->title }}</strong>
                    @if ($event->subtitle)<br><small>{{ $event->subtitle }}</small>@endif
                </td>
                <td>{{ $event->event_date?->format('d M Y') ?: '—' }}</td>
                <td>{{ $event->location ?: '—' }}</td>
                <td>
                    <span class="admin-badge {{ $event->is_published ? 'admin-badge--live' : 'admin-badge--draft' }}">
                        {{ $event->is_published ? 'Published' : 'Hidden' }}
                    </span>
                </td>
                <td class="admin-row-actions">
                    <a href="{{ route('admin.events.edit', $event) }}">Edit</a>
                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">No upcoming events yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
{{ $events->links() }}
@endsection
