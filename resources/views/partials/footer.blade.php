<footer class="site-footer">
    <div class="footer-inner">
        <a class="brand footer-brand" href="{{ route('home') }}">
            <span class="footer-mark" aria-hidden="true">M</span>
            <span class="brand-copy">
                <strong>Mind Trainer</strong>
                <small>Unlock the Power of Your Mind</small>
            </span>
        </a>

        <p>Corporate mind training for focus, memory, leadership and peak performance</p>

        <nav class="footer-links" aria-label="Footer">
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('services') }}">Services</a>
            <a href="{{ route('books') }}">Books</a>
            <a href="{{ route('gallery') }}">Gallery</a>
            <a href="{{ route('mission-vision') }}">Mission & Vision</a>
            <a href="{{ route('contact') }}">Contact</a>
        </nav>

        <span class="copyright">© {{ date('Y') }} Mind Trainer</span>
    </div>
</footer>
