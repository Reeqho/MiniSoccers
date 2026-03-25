@extends('layouts.master-admin')

@section('title', 'Konfirmasi Pembayaran')

@section('content')

    <div class="p-6">

        <h1 class="text-2xl font-bold mb-6">Konfirmasi Pembayaran</h1>
        {{-- success message --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Berhasil! </strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- search --}}
        <form action="{{ route('admin.payments.confirmation') }}" method="GET" class="mb-4">
            <div class="flex items-center">
                <input type="text" name="search" placeholder="Cari pembayaran..." value="{{ request('search') }}"
                    class="w-full px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded-r-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Cari
                </button>
            </div>
        </form>

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-gray-600">

                    <thead class="bg-gray-100 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-3">User</th>
                            <th class="px-4 py-3">Lapangan</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3">Metode</th>
                            <th class="px-4 py-3">Bukti</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @forelse($payments as $payment)
                            <tr class="hover:bg-gray-50">

                                <td class="px-4 py-3">
                                    {{ $payment->booking->user->name }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $payment->booking->field->name }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $payment->booking->date }}
                                </td>

                                <td class="px-4 py-3 text-green-600 font-semibold">
                                    Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ ucfirst($payment->method) }}
                                </td>

                                <!-- Bukti -->
                                <td class="px-4 py-3">
                                    @if ($payment->proof)
                                        <a href="{{ asset('storage/' . $payment->proof) }}" target="_blank"
                                            class="text-blue-500 underline text-xs">
                                            Lihat
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>

                                <!-- Status -->
                                <td class="px-4 py-3">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full
                                @if ($payment->status == 'pending') bg-yellow-100 text-yellow-700
                                @elseif($payment->status == 'success') bg-green-100 text-green-700
                                @else bg-red-100 text-red-700 @endif
                            ">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </td>

                                <!-- Aksi -->
                                <td class="px-4 py-3 text-center">

                                    @if ($payment->status == 'pending')
                                        <form action="{{ route('admin.payments.approve', $payment->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            <button class="px-2 py-1 bg-green-500 text-white rounded text-xs">
                                                Approve
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.payments.reject', $payment->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            <button class="px-2 py-1 bg-red-500 text-white rounded text-xs">
                                                Reject
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif

                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-6 text-gray-500">
                                    Tidak ada pembayaran
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
                {{-- paginate --}}
                <div class="p-4">
                    {{ $payments->links() }}
                </div>
            </div>

        </div>

    </div>

@endsection
