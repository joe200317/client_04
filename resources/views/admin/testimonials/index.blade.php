@extends('admin.layouts.app')
@section('title', 'Testimonials')
@section('content')
<div class="admin-page-heading">
    <h1>Testimonials</h1>
    <a class="btn btn-primary" href="{{ route('admin.testimonials.create') }}">Add testimonial</a>
</div>
<p class="admin-intro">Learner quotes shown on the home page when published.</p>
<div class="admin-table-wrap">
    <table class="admin-table">
        <thead><tr><th>Name</th><th>Quote</th><th>Status</th><th></th></tr></thead>
        <tbody>
        @forelse ($testimonials as $testimonial)
            <tr>
                <td>
                    <strong>{{ $testimonial->name }}</strong>
                    @if ($testimonial->role)<br><small>{{ $testimonial->role }}</small>@endif
                </td>
                <td>{{ \Illuminate\Support\Str::limit($testimonial->quote, 80) }}</td>
                <td>
                    <span class="admin-badge {{ $testimonial->is_published ? 'admin-badge--live' : 'admin-badge--draft' }}">
                        {{ $testimonial->is_published ? 'Published' : 'Hidden' }}
                    </span>
                </td>
                <td class="admin-row-actions">
                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}">Edit</a>
                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">No testimonials yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
{{ $testimonials->links() }}
@endsection
