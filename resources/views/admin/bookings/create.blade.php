 @extends('layouts.app')

 @section('content')

     <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded-2xl shadow-lg">

         <h1 class="text-2xl font-bold mb-6 text-gray-700">
             Booking Lapangan ⚽
         </h1>

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

         <form action="{{ route('bookings.store') }}" method="POST">
             @csrf

             {{-- Pilih Lapangan --}}
             <div class="mb-4">
                 <label class="block mb-2 font-semibold">Lapangan</label>
                 <select name="field_id" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                     <option value="">-- Pilih Lapangan --</option>
                     @foreach ($fields as $field)
                         <option value="{{ $field->id }}">
                             {{ $field->name }} - Rp {{ number_format($field->price_per_hour) }}/jam
                         </option>
                     @endforeach
                 </select>
             </div>

             {{-- Tanggal --}}
             <div class="mb-4">
                 <label class="block mb-2 font-semibold">Tanggal</label>
                 <input type="date" name="date" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
             </div>

             {{-- Jam Mulai --}}
             <div class="mb-4">
                 <label class="block mb-2 font-semibold">Jam Mulai</label>
                 <input type="time" name="start_time"
                     class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
             </div>

             {{-- Jam Selesai --}}
             <div class="mb-4">
                 <label class="block mb-2 font-semibold">Jam Selesai</label>
                 <input type="time" name="end_time"
                     class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
             </div>

             {{-- Tombol --}}
             <div class="flex justify-between mt-6">
                 <a href="{{ route('bookings.index') }}"
                     class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500">
                     Kembali
                 </a>

                 <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                     Booking Sekarang
                 </button>
             </div>

         </form>
     </div>

 @endsection
