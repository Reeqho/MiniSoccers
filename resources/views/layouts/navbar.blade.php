<div class="nav-container">
    <a href="/" class="nav-logo">⚽ MiniSoccer</a>
    <ul class="nav-links">
        <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ route('field.list') }}" class="{{ request()->is('field*') ? 'active' : '' }}">Booking Now</a></li>
        <li><a href="{{ route('user.bookings.history') }}" class="{{ request()->is('booking-history') ? 'active' : '' }}">History</a></li>
        {{-- <li><a href="{{ route('bookings.index') }}" class="{{ request()->is('bookings*') ? 'active' : '' }}">Booking</a></li> --}}
        {{-- logout --}}
        <li>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="nav-link-btn">Logout</button>
            </form>
        </li>
    </ul>
</div>
