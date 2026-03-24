@extends('layouts.master-admin')

@section('title', 'Detail Lapangan')

@section('content')

    <div class="max-w-4xl mx-auto">

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <!-- Image -->
            <img src="{{ $field->image ? asset('storage/' . $field->image) : 'https://via.placeholder.com/800x300' }}"
                class="w-full h-64 object-cover">

            <!-- Content -->
            <div class="p-6">

                <!-- Header -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold">
                        {{ $field->name }}
                    </h2>

                    <span class="px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded-full">
                        {{ $field->type }}
                    </span>
                </div>

                <!-- Harga -->
                <div class="mb-4">
                    <p class="text-sm text-gray-500">Harga per jam</p>
                    <p class="text-lg font-semibold text-green-600">
                        Rp {{ number_format($field->price_per_hour, 0, ',', '.') }}
                    </p>
                </div>

                <!-- Deskripsi -->
                <div class="mb-6">
                    <p class="text-sm text-gray-500 mb-1">Deskripsi</p>
                    <p class="text-gray-700">
                        {{ $field->description ?? '-' }}
                    </p>
                </div>

                <!-- Action -->
                <div class="flex gap-3">

                    <a href="{{ route('fields.edit', $field->id) }}"
                        class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                        Edit
                    </a>

                    <a href="{{ route('fields.index') }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                        Kembali
                    </a>

                </div>

            </div>

        </div>

        <!-- 🔥 Optional: Booking terkait -->
        <div class="mt-6 bg-white p-6 rounded-xl shadow">

            <h3 class="text-lg font-bold mb-4">Booking Lapangan Ini</h3>
            {{-- search --}}
            <form action="{{ route('fields.show', $field->id) }}" method="GET" class="mb-4">
                <input type="text" name="search" placeholder="Cari booking..."
                    class="px-4 py-2 border rounded-lg w-full md:w-1/3" value="{{ request('search') }}">
            </form>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">

                    <thead class="bg-gray-100 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-2">User</th>
                            <th class="px-4 py-2">Tanggal</th>
                            <th class="px-4 py-2">Jam</th>
                            <th class="px-4 py-2">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y text-center">
                        @forelse($bookings as $booking)
                            <tr>
                                <td class="px-4 py-2 text-start">{{ $booking->user->name }}</td>
                                <td class="px-4 py-2">{{ $booking->date }}</td>
                                <td class="px-4 py-2">
                                    {{ $booking->start_time }} - {{ $booking->end_time }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ ucfirst($booking->status) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-500">
                                    Belum ada booking
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- paginate --}}
                <div class="mb-4">
                    {{ $bookings->links() }}
                </div>
            </div>

        </div>

    </div>

@endsection
