@extends('admin.layouts.app')
@section('title', 'Event enquiry')
@section('content')
<div class="admin-page-heading">
    <h1>Event enquiry</h1>
    <a class="btn btn-outline" href="{{ route('admin.event-enquiries.index') }}">Back to enquiries</a>
</div>
<div class="admin-form">
    <div class="admin-detail-grid">
        <div class="admin-detail-item">
            <span>Event</span>
            <strong>{{ $enquiry->event?->title ?: '—' }}</strong>
        </div>
        <div class="admin-detail-item">
            <span>From</span>
            <strong>{{ $enquiry->name }} ({{ $enquiry->email }})</strong>
        </div>
        <div class="admin-detail-item">
            <span>Phone</span>
            <strong>{{ $enquiry->phone ?: '—' }}</strong>
        </div>
        <div class="admin-detail-item">
            <span>Received</span>
            <strong>{{ $enquiry->created_at?->format('d M Y, h:i A') }}</strong>
        </div>
        <div class="admin-detail-item">
            <span>Message</span>
            <p>{{ $enquiry->message }}</p>
        </div>
    </div>
    <div class="admin-form-actions">
        <form action="{{ route('admin.event-enquiries.destroy', $enquiry) }}" method="POST" onsubmit="return confirm('Delete this enquiry?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline" type="submit">Delete enquiry</button>
        </form>
    </div>
</div>
@endsection
