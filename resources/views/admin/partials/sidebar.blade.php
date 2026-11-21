<aside class="admin-sidebar" id="admin-sidebar">
    <p class="admin-nav-label">Manage</p>
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'is-current' : '' }}">Overview</a>
    <a href="{{ route('admin.books.index') }}" class="{{ request()->routeIs('admin.books.*') ? 'is-current' : '' }}">Books</a>
    <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'is-current' : '' }}">Services</a>
    <a href="{{ route('admin.events.index') }}" class="{{ request()->routeIs('admin.events.*') ? 'is-current' : '' }}">Upcoming Events</a>
    <a href="{{ route('admin.gallery.index') }}" class="{{ request()->routeIs('admin.gallery.*') ? 'is-current' : '' }}">Gallery</a>
    <a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials.*') ? 'is-current' : '' }}">Testimonials</a>
    <a href="{{ route('admin.blog.index') }}" class="{{ request()->routeIs('admin.blog.*') ? 'is-current' : '' }}">Blog</a>
    <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'is-current' : '' }}">Book orders</a>
    <a href="{{ route('admin.event-enquiries.index') }}" class="{{ request()->routeIs('admin.event-enquiries.*') ? 'is-current' : '' }}">Event enquiries</a>
    <a href="{{ route('admin.messages.index') }}" class="{{ request()->routeIs('admin.messages.*') ? 'is-current' : '' }}">Contact messages</a>

    <p class="admin-nav-label" style="margin-top: 22px;">Administration</p>
    <a href="{{ route('admin.admins.create') }}" class="{{ request()->routeIs('admin.admins.*') ? 'is-current' : '' }}">Create admin</a>
    <a href="{{ route('admin.profile.edit') }}" class="{{ request()->routeIs('admin.profile.*') ? 'is-current' : '' }}">Change login</a>
</aside>
