@extends('admin.layouts.app')
@section('title', 'Books')
@section('content')
<div class="admin-page-heading">
    <h1>Books</h1>
    <a class="btn btn-primary" href="{{ route('admin.books.create') }}">Add book</a>
</div>
<p class="admin-intro">Books shown here can appear on the public Books page when published.</p>
<div class="admin-table-wrap">
    <table class="admin-table">
        <thead><tr><th>Title</th><th>Status</th><th></th></tr></thead>
        <tbody>
        @forelse ($books as $book)
            <tr>
                <td><strong>{{ $book->title }}</strong></td>
                <td>
                    <span class="admin-badge {{ $book->is_published ? 'admin-badge--live' : 'admin-badge--draft' }}">
                        {{ $book->is_published ? 'Published' : 'Hidden' }}
                    </span>
                </td>
                <td class="admin-row-actions">
                    <a href="{{ route('admin.books.edit', $book) }}">Edit</a>
                    <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Delete this book?')">
                        @csrf @method('DELETE')
                        <button class="danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="3">No books yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
{{ $books->links() }}
@endsection
