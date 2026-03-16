<div class="nav-container">
    <a href="/" class="nav-logo">⚽ MiniSoccer</a>
    <ul class="nav-links">
        <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
        <li><a href="/fields" class="{{ request()->is('fields*') ? 'active' : '' }}">Lapangan</a></li>
        <li><a href="/bookings" class="{{ request()->is('bookings*') ? 'active' : '' }}">Booking</a></li>
    </ul>
</div>
