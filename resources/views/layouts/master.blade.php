<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>MiniSoccer - Booking Lapangan Futsal</title>
</head>

<body>
    {{-- navbar --}}
    <nav class="navbar">
        @include('layouts.navbar')
    </nav>
    {{-- content --}}
    <main class="main-content">
        @yield('content')
    </main>
    {{-- footer --}}
    <footer class="footer" >
        @include('layouts.footer')
    </footer>
</body>

</html>
