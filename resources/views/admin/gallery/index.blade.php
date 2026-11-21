@extends('admin.layouts.app')
@section('title', 'Gallery')
@section('content')
<div class="admin-page-heading">
    <h1>Gallery</h1>
    <a class="btn btn-primary" href="{{ route('admin.gallery.create') }}">Add image</a>
</div>
<p class="admin-intro">Images published here appear on the public Gallery page.</p>
<div class="admin-table-wrap">
    <table class="admin-table">
        <thead><tr><th>Title</th><th>Status</th><th></th></tr></thead>
        <tbody>
        @forelse ($items as $item)
            <tr>
                <td><strong>{{ $item->title }}</strong></td>
                <td>
                    <span class="admin-badge {{ $item->is_published ? 'admin-badge--live' : 'admin-badge--draft' }}">
                        {{ $item->is_published ? 'Published' : 'Hidden' }}
                    </span>
                </td>
                <td class="admin-row-actions">
                    <a href="{{ route('admin.gallery.edit', $item) }}">Edit</a>
                    <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="3">No gallery items yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
{{ $items->links() }}
@endsection
