@extends('admin.layouts.app')
@section('title', 'Order details')
@section('content')
<div class="admin-page-heading">
    <h1>Order #{{ $order->id }}</h1>
    <a class="btn btn-outline" href="{{ route('admin.orders.index') }}">Back to orders</a>
</div>
<div class="admin-form">
    <div class="admin-detail-grid">
        <div class="admin-detail-item"><span>Customer</span><strong>{{ $order->customer_name }}</strong></div>
        <div class="admin-detail-item"><span>Email</span><strong>{{ $order->customer_email }}</strong></div>
        <div class="admin-detail-item"><span>Phone</span><strong>{{ $order->customer_phone ?: '—' }}</strong></div>
        <div class="admin-detail-item"><span>Book</span><strong>{{ $order->book?->title ?? '—' }}</strong></div>
        <div class="admin-detail-item"><span>Quantity</span><strong>{{ $order->quantity }}</strong></div>
        <div class="admin-detail-item"><span>Message</span><p>{{ $order->message ?: '—' }}</p></div>
    </div>
    <form method="POST" action="{{ route('admin.orders.update', $order) }}" style="margin-top:18px;">
        @csrf
        @method('PATCH')
        <div class="admin-form-grid">
            <div class="admin-field">
                <label>Status</label>
                <select name="status">
                    @foreach (['new','processing','completed','cancelled'] as $status)
                        <option value="{{ $status }}" @selected($order->status === $status)>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="admin-form-actions">
            <button class="btn btn-primary" type="submit">Update status</button>
        </div>
    </form>
</div>
@endsection
