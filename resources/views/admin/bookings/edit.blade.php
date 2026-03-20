@extends('layouts.master')
@section('content')
    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white shadow-lg rounded-2xl p-6">
            <h2 class="text-2xl font-bold mb-6">Edit Booking</h2>

            {{-- Error --}}
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- User -->
                    <div>
                        <label class="block text-sm mb-1">User</label>
                        <select name="user_id" class="w-full px-4 py-2 border rounded-lg">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $booking->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Field -->
                    <div>
                        <label class="block text-sm mb-1">Lapangan</label>
                        <select name="field_id" class="w-full px-4 py-2 border rounded-lg">
                            @foreach ($fields as $field)
                                <option value="{{ $field->id }}"
                                    {{ $booking->field_id == $field->id ? 'selected' : '' }}>
                                    {{ $field->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date -->
                    <div>
                        <label class="block text-sm mb-1">Tanggal</label>
                        <input type="date" name="date" value="{{ $booking->date }}"
                            class="w-full px-4 py-2 border rounded-lg">
                    </div>

                    <!-- Start Time -->
                    <div>
                        <label class="block text-sm mb-1">Jam Mulai</label>
                        <input type="time" name="start_time" value="{{ $booking->start_time }}"
                            class="w-full px-4 py-2 border rounded-lg">
                    </div>

                    <!-- End Time -->
                    <div>
                        <label class="block text-sm mb-1">Jam Selesai</label>
                        <input type="time" name="end_time" value="{{ $booking->end_time }}"
                            class="w-full px-4 py-2 border rounded-lg">
                    </div>

                    <!-- Total Price -->
                    <div>
                        <label class="block text-sm mb-1">Total Harga</label>
                        <input type="number" name="total_price" value="{{ $booking->total_price }}"
                            class="w-full px-4 py-2 border rounded-lg">
                    </div>

                    <!-- Status -->
                    <div class="md:col-span-2">
                        <label class="block text-sm mb-1">Status</label>
                        <select name="status" class="w-full px-4 py-2 border rounded-lg">
                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $booking->status == 'paid' ? 'selected' : '' }}>Dibayar</option>
                            <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Selesai
                            </option>
                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Batal
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Button -->
                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('bookings.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                        Batal
                    </a>

                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
