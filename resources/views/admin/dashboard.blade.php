@extends('layouts.master-admin')

@section('title', 'Dashboard')

@section('content')

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

    <div class="bg-white p-4 rounded-xl shadow">
        <p class="text-sm text-gray-500">Total Booking</p>
        <h2 class="text-2xl font-bold">{{ $totalBookings }}</h2>
    </div>

    <div class="bg-white p-4 rounded-xl shadow">
        <p class="text-sm text-gray-500">Total Lapangan</p>
        <h2 class="text-2xl font-bold">{{ $totalFields }}</h2>
    </div>

    <div class="bg-white p-4 rounded-xl shadow">
        <p class="text-sm text-gray-500">Pendapatan</p>
        <h2 class="text-2xl font-bold text-green-600">
            Rp {{ number_format($totalRevenue, 0, ',', '.') }}
        </h2>
    </div>

</div>

<!-- Recent Booking -->
<div class="bg-white p-6 rounded-xl shadow">

    <h2 class="text-lg font-bold mb-4">Booking Terbaru</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-gray-600">

            <thead class="bg-gray-100 text-xs uppercase">
                <tr>
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">Lapangan</th>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @foreach($recentBookings as $booking)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $booking->user->name }}</td>
                    <td class="px-4 py-2">{{ $booking->field->name }}</td>
                    <td class="px-4 py-2">{{ $booking->date }}</td>

                    <td class="px-4 py-2">
                        <span class="px-2 py-1 text-xs rounded-full
                            @if($booking->status == 'pending') bg-yellow-100 text-yellow-700
                            @elseif($booking->status == 'paid') bg-blue-100 text-blue-700
                            @elseif($booking->status == 'completed') bg-green-100 text-green-700
                            @else bg-red-100 text-red-700
                            @endif
                        ">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>

@endsection