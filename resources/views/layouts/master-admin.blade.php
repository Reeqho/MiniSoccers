<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md min-h-screen p-4">
            <h2 class="text-xl font-bold mb-6">Mini Soccer</h2>

            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-200">
                    Dashboard
                </a>

                <a href="{{ route('bookings.index') }}" class="block px-4 py-2 hover:bg-gray-200 rounded-lg">
                    Booking
                </a>

                <a href="{{ route('fields.index') }}" class="block px-4 py-2 hover:bg-gray-200 rounded-lg">
                    Lapangan
                </a>
            </nav>
        </aside>

        <!-- Content -->
        <div class="flex-1">

            <!-- Navbar -->
            <div class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <h1 class="text-xl font-bold">@yield('title')</h1>

                <div class="flex items-center gap-4">
                    <span>{{ auth()->user()->name }}</span>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="px-3 py-1 bg-red-500 text-white rounded-lg">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Main Content -->
            <main class="p-6">
                @yield('content')
            </main>

        </div>

    </div>

</body>

</html>
