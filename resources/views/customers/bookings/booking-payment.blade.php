@extends('layouts.master')

@section('title', 'Pembayaran')

@section('content')

    <div class="max-w-2xl mx-auto p-6">

        <h1 class="text-2xl font-bold mb-6">Pembayaran</h1>

        <div class="bg-white rounded-xl shadow p-6">

            <!-- Detail Booking -->
            <h2 class="text-lg font-semibold mb-4">Detail Booking</h2>

            <div class="space-y-2 text-sm">
                <p><strong>Lapangan:</strong> {{ $booking->field->name }}</p>
                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($booking->date)->format('d M Y') }}</p>
                <p><strong>Jam:</strong> {{ $booking->start_time }} - {{ $booking->end_time }}</p>
            </div>

            <!-- Total -->
            <div class="mt-4">
                <p class="text-sm text-gray-500">Total Pembayaran</p>
                <p class="text-xl font-bold text-green-600">
                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                </p>
            </div>

            <!-- Info Transfer -->
            <div class="mt-4 p-4 bg-gray-100 rounded-lg text-sm">
                <p><strong>Bank BCA</strong></p>
                <p>No Rekening: 1234567890</p>
                <p>Atas Nama: Mini Soccer</p>
            </div>
            <br>

            <!-- Form Upload Bukti -->
            <form action="{{ route('user.payments.store', $booking->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- metode -->
                <select name="payment_method" class="w-full px-4 py-2 border rounded-lg mb-4">
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="Cash">Bayar di Tempat</option>
                </select>

                <!-- bukti -->
                <input type="file" name="proof" class="w-full border rounded-lg px-4 py-2 mb-4">

                <button class="w-full bg-blue-500 text-white py-2 rounded-lg">
                    Bayar Sekarang
                </button>
            </form>

        </div>

    </div>

    {{-- script --}}
    <script>
        // Jika Metode pembayaran bayar di tempat, disable input file dan sembunyikan info transfer
        const paymentMethodSelect = document.querySelector('select[name="payment_method"]');
        const proofInput = document.querySelector('input[name="proof"]');
        const transferInfo = document.querySelector('.bg-gray-100');

        paymentMethodSelect.addEventListener('change', function() {
            if (this.value === 'cash') {
                // proofInput.disabled = true;
                transferInfo.style.display = 'none';
            } else {
                // proofInput.disabled = false;
                transferInfo.style.display = 'block';
            }
        })
    </script>

@endsection
