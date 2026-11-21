@extends('admin.layouts.app')
@section('title', 'Book orders')
@section('content')
<div class="admin-page-heading">
    <h1>Book orders</h1>
</div>
<p class="admin-intro">Track book purchase enquiries from the website.</p>
<div class="admin-table-wrap">
    <table class="admin-table">
        <thead><tr><th>Customer</th><th>Book</th><th>Status</th><th></th></tr></thead>
        <tbody>
        @forelse ($orders as $order)
            <tr>
                <td>
                    <strong>{{ $order->customer_name }}</strong><br>
                    <small>{{ $order->customer_email }}</small>
                </td>
                <td>{{ $order->book?->title ?? '—' }}</td>
                <td>
                    <span class="admin-badge admin-badge--draft">{{ $order->status }}</span>
                </td>
                <td class="admin-row-actions">
                    <a href="{{ route('admin.orders.show', $order) }}">View</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">No orders yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
{{ $orders->links() }}
@endsection
