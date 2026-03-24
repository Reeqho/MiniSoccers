@extends('layouts.master')

@section('title', 'Riwayat Booking')

@section('content')

    <div class="p-6">

        <h1 class="text-2xl font-bold mb-6">Riwayat Booking</h1>

        {{-- success message --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Berhasil! </strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-gray-600">

                    <thead class="bg-gray-100 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-3">Lapangan</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Jam</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @forelse($bookings as $booking)
                            <tr class="hover:bg-gray-50 text-center">

                                <!-- Lapangan -->
                                <td class="px-4 py-3 font-medium">
                                    {{ $booking->field->name }}
                                </td>

                                <!-- Tanggal -->
                                <td class="px-4 py-3">
                                    {{ \Carbon\Carbon::parse($booking->date)->format('d M Y') }}
                                </td>

                                <!-- Jam -->
                                <td class="px-4 py-3">
                                    {{ $booking->start_time }} - {{ $booking->end_time }}
                                </td>

                                <!-- Total -->
                                <td class="px-4 py-3 text-green-600 font-semibold">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                </td>

                                <!-- Status -->
                                <td class="px-4 py-3">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full
                                @if ($booking->status == 'pending') bg-yellow-100 text-yellow-700
                                @elseif($booking->status == 'paid') bg-blue-100 text-blue-700
                                @elseif($booking->status == 'completed') bg-green-100 text-green-700
                                @else bg-red-100 text-red-700 @endif
                            ">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>

                                <!-- Aksi -->
                                <td class="px-4 py-3 text-center">

                                    @if ($booking->status == 'pending')
                                        <a href="{{ route('user.booking.payment', $booking->id) }}"
                                            class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-xs">
                                            Bayar
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif

                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-6 text-gray-500">
                                    Belum ada booking
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>

    </div>

@endsection
