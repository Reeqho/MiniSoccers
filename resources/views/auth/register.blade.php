{{-- resources/views/auth/register.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">

    <h2 class="text-2xl font-bold text-center mb-6">Register</h2>

    <!-- Error -->
    @if ($errors->any())
        <div class="mb-4 text-red-500 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label class="block text-sm mb-1">Nama</label>
            <input type="text" name="name" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400"
                placeholder="Masukkan nama">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-sm mb-1">Email</label>
            <input type="email" name="email" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400"
                placeholder="Masukkan email">
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label class="block text-sm mb-1">Password</label>
            <input type="password" name="password" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400"
                placeholder="Masukkan password">
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <label class="block text-sm mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400"
                placeholder="Ulangi password">
        </div>

        <!-- Button -->
        <button type="submit"
            class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600">
            Register
        </button>

        <!-- Link login -->
        <p class="text-sm text-center mt-4">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a>
        </p>

    </form>

</div>

</body>
</html>