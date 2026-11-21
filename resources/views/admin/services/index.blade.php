@extends('admin.layouts.app')
@section('title', 'Services')
@section('content')
<div class="admin-page-heading">
    <h1>Services</h1>
    <a class="btn btn-primary" href="{{ route('admin.services.create') }}">Add service</a>
</div>
<p class="admin-intro">Manage training programs that appear on Home and Services pages.</p>
<div class="admin-table-wrap">
    <table class="admin-table">
        <thead><tr><th>Title</th><th>Group</th><th>Status</th><th></th></tr></thead>
        <tbody>
        @forelse ($services as $service)
            <tr>
                <td>
                    <strong>{{ $service->title }}</strong>
                    @if ($service->duration_label)<br><small>{{ $service->duration_label }}</small>@endif
                </td>
                <td>{{ $service->group_name ?: '—' }}</td>
                <td>
                    <span class="admin-badge {{ $service->is_published ? 'admin-badge--live' : 'admin-badge--draft' }}">
                        {{ $service->is_published ? 'Published' : 'Hidden' }}
                    </span>
                </td>
                <td class="admin-row-actions">
                    <a href="{{ route('admin.services.edit', $service) }}">Edit</a>
                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">No services yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
{{ $services->links() }}
@endsection
