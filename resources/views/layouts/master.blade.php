@vite(['resources/css/app.css', 'resources/js/app.js'])
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
     <title>@yield('title')</title>
    {{-- <title>MiniSoccer - Booking Lapangan Futsal</title> --}}
</head>

<body>
    {{-- navbar --}}
    <nav class="navbar">
        @include('layouts.navbar')
    </nav>
    {{-- content --}}

    <main class="{{ request()->is('/') ? 'main-content-home' : 'main-content' }}">
        @yield('content')
    </main>
    {{-- footer --}}
    <div class="push">
        <footer class="footer">
            @include('layouts.footer')
        </footer>
    </div>

</body>

</html>
