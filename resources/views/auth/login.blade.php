<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">

        <!-- Title -->
        <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

        <!-- Error Message -->
        @if ($errors->any())
            <div class="mb-4 text-red-500 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- success message --}}
        @if (session('success'))
            <div class="mb-4 text-green-500 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email -->
            <div class="mb-4">
                <label class="block text-sm mb-1">Email</label>
                <input type="email" name="email" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Masukkan email">
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label class="block text-sm mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Masukkan password">
            </div>

            <!-- Button -->
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
                Login
            </button>

            <p class="text-sm text-center mt-4">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register</a>
            </p>
        </form>

    </div>

</body>

</html>
