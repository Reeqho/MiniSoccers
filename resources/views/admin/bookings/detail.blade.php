@extends('layouts.master-admin')
@section('content')
    <div class="max-w-4xl mx-auto p-6">
        <!-- Card -->
        <div class="bg-white shadow-lg rounded-2xl p-6">


            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">
                    Detail Booking</h2>
                <span
                    class="px-4 py-1 text-sm font-semibold rounded-full
        @if ($booking->status == 'pending') bg-yellow-100 text-yellow-700
        @elseif($booking->status == 'paid') bg-blue-100 text-blue-700
        @elseif($booking->status == 'completed') bg-green-100 text-green-700
        @else bg-red-100 text-red-700 @endif
      ">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>

            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- User -->
                <div>
                    <p class="text-sm text-gray-500">Nama User</p>
                    <p class="font-semibold text-lg">{{ $booking->user->name }}</p>
                </div>

                <!-- Lapangan -->
                <div>
                    <p class="text-sm text-gray-500">Lapangan</p>
                    <p class="font-semibold text-lg">{{ $booking->field->name }}</p>
                </div>

                <!-- Tanggal -->
                <div>
                    <p class="text-sm text-gray-500">Tanggal</p>
                    <p class="font-semibold">
                        {{ \Carbon\Carbon::parse($booking->date)->format('d M Y') }}
                    </p>
                </div>

                <!-- Jam -->
                <div>
                    <p class="text-sm text-gray-500">Jam</p>
                    <p class="font-semibold">
                        {{ $booking->start_time }} - {{ $booking->end_time }}
                    </p>
                </div>

                <!-- Harga -->
                <div>
                    <p class="text-sm text-gray-500">Total Harga</p>
                    <p class="font-semibold text-green-600 text-lg">
                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                    </p>
                </div>

                <!-- Dibuat -->
                <div>
                    <p class="text-sm text-gray-500">Dibuat Pada</p>
                    <p class="font-semibold">
                        {{ $booking->created_at->format('d M Y H:i') }}
                    </p>
                </div>

            </div>

            <!-- Divider -->
            <hr class="my-6">
            <!-- Deskripsi dan Durasi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 my-6">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Deskripsi Lapangan</p>
                    <p class="text-gray-700">
                        {{ $booking->field->description ?? 'Tidak ada deskripsi' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 mb-1">Durasi</p>
                    <p class="text-gray-700">
                        @php
                            $start = \Carbon\Carbon::parse($booking->start_time);
                            $end = \Carbon\Carbon::parse($booking->end_time);
                            $duration = $start->diffInHours($end);
                        @endphp
                        Durasi: {{ $duration }} jam
                    </p>
                </div>
            </div>

            <!-- Divider -->
            <hr class="my-6">

            <!-- Action -->
            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('bookings.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                    Kembali
                </a>

                <a href="{{ route('bookings.edit', $booking->id) }}"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    Edit
                </a>
                {{-- hapus --}}
                <form id="delete-form" action="{{ route('bookings.destroy', $booking->id) }}" method="POST"
                    class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600"
                        onclick="return confirm('Are you sure you want to delete this booking?')">
                        Hapus </button>
                </form>


            </div>
        </div>
    </div>
@endsection
