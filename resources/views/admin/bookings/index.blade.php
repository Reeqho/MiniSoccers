@extends('layouts.master-admin')
@section('content')
    <div class="p-6 bg-white shadow-md rounded-2xl">

        <!-- Title -->
        <h2 class="mb-4 text-xl font-bold">Data Booking</h2>

        {{-- Search --}}
        <form action="{{ route('bookings.index') }}" method="GET" class="mb-4">
            <input type="text" name="search" placeholder="Cari..." class="w-full px-4 py-2 border rounded-lg md:w-1/3" value="{{ request('search') }}">
        </form>
        {{-- Message --}}
        @if (session('success'))
            <div class="p-3 mb-4 text-green-700 bg-green-100 rounded">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="p-3 mb-4 text-red-700 bg-red-100 rounded">
                {{ session('error') }}
            </div>
        @endif


        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-600">

                <!-- Header -->
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th class="px-6 py-3">User</th>
                        <th class="px-6 py-3">Lapangan</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Jam</th>
                        <th class="px-6 py-3">Total</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <!-- Body -->
                <tbody class="divide-y">

                    @foreach ($bookings as $booking)
                        <tr class="transition hover:bg-gray-50">

                            <!-- User -->
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $booking->user->name }}
                            </td>

                            <!-- Lapangan -->
                            <td class="px-6 py-4">
                                {{ $booking->field->name }}
                            </td>

                            <!-- Tanggal -->
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($booking->date)->format('d M Y') }}
                            </td>

                            <!-- Jam -->
                            <td class="px-6 py-4">
                                {{ $booking->start_time }} - {{ $booking->end_time }}
                            </td>

                            <!-- Harga -->
                            <td class="px-6 py-4 font-semibold text-green-600">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4">
                                @if ($booking->status == 'pending')
                                    <span
                                        class="px-3 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full">
                                        Pending
                                    </span>
                                @elseif ($booking->status == 'paid')
                                    <span class="px-3 py-1 text-xs font-semibold text-blue-700 bg-blue-100 rounded-full">
                                        Dibayar
                                    </span>
                                @elseif ($booking->status == 'completed')
                                    <span class="px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                                        Selesai
                                    </span>
                                @elseif ($booking->status == 'cancelled')
                                    <span class="px-3 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">
                                        Batal
                                    </span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="px-6 py-4 space-x-2 text-center">
                                <a href="{{ route('bookings.show', $booking->id) }}"
                                    class="px-3 py-1 text-xs text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                                    Detail
                                </a>
                                <form id="delete-form" action="{{ route('bookings.destroy', $booking->id) }}"
                                    method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 text-xs text-white bg-red-500 rounded-lg hover:bg-red-600"
                                        onclick="return confirm('Are you sure you want to delete this booking?')">
                                        Hapus </button>
                                </form>
                                {{-- <a href="#"
                                    class="px-3 py-1 text-xs text-white bg-red-500 rounded-lg hover:bg-red-600">
                                    Hapus
                                </a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $bookings->links() }}
        </div>
    </div>
@endsection
