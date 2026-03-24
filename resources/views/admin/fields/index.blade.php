@extends('layouts.master-admin')
@section('content')
    <div class="p-6 bg-white rounded-2xl shadow-md">
        {{-- success message --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Data Lapangan</h2>
            <a href="{{ route('fields.create') }}"
                class="px-4 py-2 text-sm text-white bg-green-500 rounded-lg hover:bg-green-600">
                + Tambah Lapangan
            </a>
        </div>

        {{-- Search --}}
        <form action="{{ route('fields.index') }}" method="GET" class="mb-4">
            <input type="text" name="search" placeholder="Cari..." class="px-4 py-2 border rounded-lg w-full md:w-1/3" value="{{ request('search') }}">
        </form>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-600">

                <!-- Head -->
                <thead class="bg-gray-100 text-xs uppercase text-gray-700">
                    <tr>
                        <th class="px-6 py-3">Nama</th>
                        <th class="px-6 py-3">Tipe</th>
                        <th class="px-6 py-3">Harga / Jam</th>
                        <th class="px-6 py-3">Deskripsi</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <!-- Body -->
                <tbody class="divide-y">
                    @foreach ($fields as $field)
                        <tr class="hover:bg-gray-50 transition">

                            <!-- Nama -->
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $field->name }}
                            </td>

                            <!-- Tipe -->
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-700 rounded-full">
                                    {{ $field->type }}
                                </span>
                            </td>

                            <!-- Harga -->
                            <td class="px-6 py-4 font-semibold text-green-600">
                                Rp {{ number_format($field->price_per_hour, 0, ',', '.') }}
                            </td>

                            <!-- Deskripsi -->
                            <td class="px-6 py-4 max-w-xs truncate">
                                {{ $field->description }}
                            </td>

                            <!-- Aksi -->
                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="{{ route('fields.edit', $field->id) }}"
                                    class="px-3 py-1 text-xs text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                                    Edit
                                </a>
                                <a href="{{ route('fields.show', $field->id) }}"
                                    class="px-3 py-1 text-xs text-white bg-green-500 rounded-lg hover:bg-green-600">
                                    Detail
                                </a>
                                <form action="{{ route('fields.destroy', $field->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 text-xs text-white bg-red-500 rounded-lg hover:bg-red-600" onclick="return confirm('Are you sure you want to delete this field?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
    <div class="mt-4">
        {{ $fields->links() }}
    </div>
@endsection
