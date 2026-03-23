@extends('layouts.master')

@section('title', 'Pilih Lapangan')

@section('content')

    <div class="p-6">

        <!-- Title -->
        <h1 class="text-2xl font-bold mb-6">Pilih Lapangan</h1>

        {{-- error --}}
        @if (session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- success --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            @foreach ($fields as $field)
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">

                    <!-- Image -->
                    <img src="{{ $field->image ? asset('storage/' . $field->image) : 'https://via.placeholder.com/400x200' }}"
                        class="w-full h-40 object-cover">

                    <!-- Content -->
                    <div class="p-4">

                        <!-- Nama -->
                        <h2 class="text-lg font-bold mb-1">
                            {{ $field->name }}
                        </h2>

                        <!-- Tipe -->
                        <span class="text-xs px-2 py-1 bg-blue-100 text-blue-700 rounded-full">
                            {{ $field->type }}
                        </span>

                        <!-- Harga -->
                        <p class="mt-2 text-green-600 font-semibold">
                            Rp {{ number_format($field->price_per_hour, 0, ',', '.') }} / jam
                        </p>

                        <!-- Deskripsi -->
                        <p class="text-sm text-gray-500 mt-2 line-clamp-2">
                            {{ $field->description }}
                        </p>

                        <!-- Button -->
                        <a href="{{ route('user.bookings.create', $field->id) }}"
                            class="block mt-4 text-center bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                            Booking Sekarang
                        </a>

                    </div>
                </div>
            @endforeach

        </div>

    </div>

@endsection
