@extends('admin.layouts.app')

@section('title', 'Overview')

@section('content')
    <div class="admin-page-heading">
        <h1>Overview</h1>
    </div>
    <p class="admin-intro">Manage website content from one place. Publish items to show them on the public Mind Trainer site.</p>

    <div class="admin-stat-grid">
        <div class="admin-stat-card"><span>Books</span><strong>{{ $stats['books'] }}</strong></div>
        <div class="admin-stat-card"><span>Services</span><strong>{{ $stats['services'] }}</strong></div>
        <div class="admin-stat-card"><span>Upcoming events</span><strong>{{ $stats['events'] }}</strong></div>
        <div class="admin-stat-card"><span>Gallery</span><strong>{{ $stats['gallery'] }}</strong></div>
        <div class="admin-stat-card"><span>Testimonials</span><strong>{{ $stats['testimonials'] }}</strong></div>
        <div class="admin-stat-card"><span>Blog posts</span><strong>{{ $stats['blog'] }}</strong></div>
        <div class="admin-stat-card"><span>Book orders</span><strong>{{ $stats['orders'] }}</strong></div>
        <div class="admin-stat-card"><span>Unread event enquiries</span><strong>{{ $stats['event_enquiries'] }}</strong></div>
        <div class="admin-stat-card"><span>Unread messages</span><strong>{{ $stats['messages'] }}</strong></div>
    </div>
@endsection
