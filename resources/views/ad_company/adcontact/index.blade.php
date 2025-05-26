@extends('layouts.main')

@section('content')
@include('layout.header')

<section class="bg-gray-50 py-12 px-6 min-h-screen">
    <div class="max-w-7xl mx-auto space-y-8">

        <h1 class="text-4xl font-bold text-blue-600 text-center mb-12">Kelola Lokasi Apotek</h1>

        <div class="flex justify-end mb-6">
            <a href="{{ route('locations.create') }}" 
               class="inline-flex items-center px-5 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition duration-300">
                Tambah Lokasi Baru
            </a>
        </div>

        <div class="space-y-6">
            @foreach ($locations as $location)
                <div class="bg-white rounded-lg shadow p-6 flex items-center space-x-6 hover:shadow-lg transition duration-300">
                    <div class="flex-1">
                        <h2 class="text-xl font-semibold text-gray-900">{{ $location->name }}</h2>
                        <p class="text-gray-600">Alamat: {{ $location->alamat ?? '-' }}</p>
                        <p class="text-gray-600">Koordinat: {{ $location->latitude }}, {{ $location->longitude }}</p>
                        <p class="text-gray-600 mt-2">
                            <i class="fas fa-envelope text-blue-500 mr-2"></i>apotek@gmail.com
                        </p>
                        <p class="text-gray-600">
                            <i class="fas fa-phone text-blue-500 mr-2"></i>12345678910
                        </p>
                    </div>
                    <div class="flex space-x-4">
                        <a href="{{ route('locations.edit', $location->id) }}" 
                           class="px-4 py-2 bg-yellow-400 rounded text-white font-semibold hover:bg-yellow-500 transition">
                            Edit
                        </a>
                        <form action="{{ route('locations.destroy', $location->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus lokasi ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-4 py-2 bg-red-600 rounded text-white font-semibold hover:bg-red-700 transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

@include('layout.footer')
@endsection