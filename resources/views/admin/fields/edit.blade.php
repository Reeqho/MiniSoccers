@extends('layouts.master-admin')
@section('content')
    <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded-2xl shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-700">
            Edit Lapangan ⚽
        </h1>

        {{-- Back Button --}}
        {{-- <a href="{{ route('fields.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500">
            Kembali
        </a> --}}
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

        <form action="{{ route('fields.update', $field->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Nama Lapangan --}}
            <div class="mb-4">
                <label class="block mb-2 font-semibold">Nama Lapangan</label>
                <input type="text" name="name" value="{{ old('name', $field->name) }}"
                    class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-green-400" placeholder="Contoh: Lapangan A">
            </div>

            {{-- Tipe --}}
            <div class="mb-4">
                <label class="block mb-2 font-semibold">Tipe</label>
                <select name="type" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-green-400">
                    <option value="">-- Pilih Tipe --</option>
                    <option value="Rumput Sintetis" {{ old('type', $field->type) == 'Rumput Sintetis' ? 'selected' : '' }}>
                        Rumput Sintetis</option>
                    <option value="Vinyl Indoor" {{ old('type', $field->type) == 'Vinyl Indoor' ? 'selected' : '' }}>Vinyl
                        Indoor</option>
                </select>
            </div>

            {{-- Harga --}}
            <div class="mb-4">
                <label class="block mb-2 font-semibold">Harga per Jam</label>
                <input type="number" name="price_per_hour" value="{{ old('price_per_hour', $field->price_per_hour) }}"
                    class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-green-400" placeholder="150000">
            </div>

            {{-- Deskripsi --}}
            <div class="mb-4">
                <label class="block mb-2 font-semibold">Deskripsi</label>
                <textarea name="description" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-green-400" rows="3"
                    placeholder="Deskripsi lapangan">{{ old('description', $field->description) }}</textarea>
            </div>

            {{-- Gambar --}}
            <div class="mb-4">
                <label class="block mb-2 font-semibold">Gambar Lapangan</label>
                <input type="file" name="image" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-green-400">
                @if ($field->image)
                    <p class="text-sm text-gray-500 mt-1">Gambar saat ini:</p>
                    <img src="{{ asset('storage/' . $field->image) }}" alt="Gambar Lapangan" class="w-32 h-32 object-cover mt-2">
                @endif
            </div>

            {{-- Tombol --}}
            <div class="flex justify-between mt-6">
                <a href="{{ route('fields.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500">
                    Kembali
                </a>

                {{-- confirm message button --}}
                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600"
                    onclick="return confirm('Are you sure you want to save this field?')">
                    Simpan
                </button>
            </div>

        </form>
    </div>
@endsection
