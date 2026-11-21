@extends('admin.layouts.app')
@section('title', 'Blog')
@section('content')
<div class="admin-page-heading">
    <h1>Blog</h1>
    <a class="btn btn-primary" href="{{ route('admin.blog.create') }}">Add post</a>
</div>
<p class="admin-intro">Publish articles that appear on the public Blog page.</p>
<div class="admin-table-wrap">
    <table class="admin-table">
        <thead><tr><th>Title</th><th>Tag</th><th>Status</th><th></th></tr></thead>
        <tbody>
        @forelse ($posts as $post)
            <tr>
                <td><strong>{{ $post->title }}</strong></td>
                <td>{{ $post->tag ?: '—' }}</td>
                <td>
                    <span class="admin-badge {{ $post->is_published ? 'admin-badge--live' : 'admin-badge--draft' }}">
                        {{ $post->is_published ? 'Published' : 'Hidden' }}
                    </span>
                </td>
                <td class="admin-row-actions">
                    <a href="{{ route('admin.blog.edit', $post) }}">Edit</a>
                    <form action="{{ route('admin.blog.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">No posts yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
{{ $posts->links() }}
@endsection
