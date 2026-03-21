<div class="nav-container">
    <a href="/" class="nav-logo">⚽ MiniSoccer</a>
    <ul class="nav-links">
        <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
        <li><a href="/fields" class="{{ request()->is('fields*') ? 'active' : '' }}">Lapangan</a></li>
        <li><a href="/bookings" class="{{ request()->is('bookings*') ? 'active' : '' }}">Booking</a></li>
        {{-- logout --}}
        <li>
            <form action="/logout" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="nav-link-btn">Logout</button>
            </form>
        </li>
    </ul>
</div>
