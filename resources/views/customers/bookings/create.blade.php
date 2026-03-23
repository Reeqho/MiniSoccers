@extends('layouts.master')

@section('title', 'Booking Lapangan')

@section('content')

    <div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow">

        <h2 class="text-xl font-bold mb-4">
            Booking: {{ $field->name }}
        </h2>

        {{-- error --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.booking.store', $field->id) }}" method="POST">
            @csrf

            <input type="hidden" name="field_id" value="{{ $field->id }}">

            <!-- Tanggal -->
            <div class="mb-4">
                <label class="block text-sm mb-1">Tanggal</label>
                <input type="date" name="date" required class="w-full px-4 py-2 border rounded-lg">
            </div>

            <!-- Jam Mulai -->
            <div class="mb-4">
                <label class="block text-sm mb-1">Jam Mulai</label>
                <select name="start_time" id="start_time" class="w-full px-4 py-2 border rounded-lg">
                </select>
            </div>

            <!-- Jam Selesai -->
            <div class="mb-4">
                <label class="block text-sm mb-1">Jam Selesai</label>
                <select name="end_time" id="end_time" class="w-full px-4 py-2 border rounded-lg">
                </select>
            </div>

            <!-- Harga -->
            <div class="mb-4">
                <p class="text-sm text-gray-500">Harga per jam</p>
                <p class="font-semibold text-green-600">
                    Rp {{ number_format($field->price_per_hour, 0, ',', '.') }}
                </p>
            </div>

            <!-- Total -->
            <div class="mb-6">
                <p class="text-sm text-gray-500">Estimasi Total</p>
                <p id="total" class="text-lg font-bold text-green-600">Rp 0</p>
            </div>

            <button class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                Booking Sekarang
            </button>

        </form>

    </div>

    {{-- <!-- SCRIPT HITUNG HARGA -->
    <script>
        const price = {{ $field->price_per_hour }};

        const startInput = document.querySelector('input[name="start_time"]');
        const endInput = document.querySelector('input[name="end_time"]');
        const totalEl = document.getElementById('total');

        function calculate() {
            if (startInput.value && endInput.value) {
                let start = new Date(`1970-01-01T${startInput.value}`);
                let end = new Date(`1970-01-01T${endInput.value}`);

                let hours = (end - start) / 1000 / 60 / 60;

                if (hours > 0) {
                    let total = hours * price;
                    totalEl.innerText = 'Rp ' + total.toLocaleString('id-ID');
                }
            }
        }

        startInput.addEventListener('change', calculate);
        endInput.addEventListener('change', calculate);
    </script> --}}

    {{-- disable jam yang bentrok --}}
    <script>
        const fieldId = {{ $field->id }};
        const dateInput = document.querySelector('input[name="date"]');
        const startSelect = document.getElementById('start_time');
        const endSelect = document.getElementById('end_time');

        const price = {{ $field->price_per_hour }};
        const totalEl = document.getElementById('total');

        // generate jam 08:00 - 22:00
        function generateOptions(bookings = []) {
            startSelect.innerHTML = '';
            endSelect.innerHTML = '';

            endSelect.querySelectorAll('option').forEach(option => {
                let optTime = new Date(`1970-01-01T${option.value}`);
                let startTime = new Date(`1970-01-01T${startSelect.value}`);

                option.disabled = optTime <= startTime;
            });

            for (let i = 8; i <= 22; i++) {
                let time = (i < 10 ? '0' + i : i) + ':00';

                let disabled = bookings.some(b => {
                    let t = new Date(`1970-01-01T${time}`);
                    let start = new Date(`1970-01-01T${b.start_time}`);
                    let end = new Date(`1970-01-01T${b.end_time}`);

                    return t >= start && t < end;
                });
                let option1 = new Option(time, time, false, false);
                let option2 = new Option(time, time, false, false);

                if (disabled) {
                    option1.disabled = true;
                    option2.disabled = true;
                }
                startSelect.add(option1);
                endSelect.add(option2);
            }
        }

        // fetch booking
        dateInput.addEventListener('change', async () => {
            let date = dateInput.value;

            if (!date) return;

            let res = await fetch(`/bookings/check/${fieldId}?date=${date}`);
            let bookings = await res.json();

            generateOptions(bookings);
        });

        // hitung harga
        function calculate() {
            let start = startSelect.value;
            let end = endSelect.value;

            if (start && end) {
                let s = new Date(`1970-01-01T${start}`);
                let e = new Date(`1970-01-01T${end}`);

                if (e <= s) {
                    alert('Jam selesai harus lebih besar dari jam mulai');
                    totalEl.innerText = 'Rp 0';
                    return setTimeout(() => endSelect.value = '', 100);
                }

                let hours = (e - s) / 1000 / 60 / 60;

                if (hours > 0) {
                    let total = hours * price;
                    totalEl.innerText = 'Rp ' + total.toLocaleString('id-ID');
                }
            }
        }



        startSelect.addEventListener('change', calculate);
        endSelect.addEventListener('change', calculate);
    </script>

@endsection
