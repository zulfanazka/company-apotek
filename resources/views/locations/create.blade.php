@extends('layouts.main')

@section('content')
@include('layout.header')

{{-- Leaflet CSS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<section class="bg-white py-12 px-6 min-h-screen flex flex-col items-center">
    <div class="max-w-6xl w-full flex flex-col md:flex-row gap-8 mb-12">

        {{-- Form Input Lokasi --}}
        <div class="md:w-1/2 bg-gray-50 p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-6 text-blue-600">Tambah Lokasi Baru</h2>
            <form action="{{ route('locations.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block mb-1 font-medium text-gray-700">Nama Lokasi</label>
                    <input type="text" name="name" id="name" placeholder="Masukkan nama lokasi" required
                        value="{{ old('name') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="alamat" class="block mb-1 font-medium text-gray-700">Alamat</label>
                    <textarea name="alamat" id="alamat" placeholder="Masukkan alamat lengkap" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('alamat') }}</textarea>
                </div>

                <div>
                    <label for="latitude" class="block mb-1 font-medium text-gray-700">Latitude</label>
                    <input type="text" name="latitude" id="latitude" placeholder="Masukkan latitude" required
                        value="{{ old('latitude') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="longitude" class="block mb-1 font-medium text-gray-700">Longitude</label>
                    <input type="text" name="longitude" id="longitude" placeholder="Masukkan longitude" required
                        value="{{ old('longitude') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit"
                    class="w-full py-3 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition">
                    Simpan Lokasi
                </button>
                <button 
                onclick="window.history.back()" 
                class="w-full py-3 bg-gray-300 text-gray-700 font-semibold rounded-md hover:bg-gray-400 transition"
                type="button"
                >
                Kembali
                </button>
            </form>
        </div>

        {{-- Map di Kanan --}}
        <div class="md:w-1/2 rounded-lg shadow-md overflow-hidden">
            <div id="map" class="h-[400px] w-full"></div>
        </div>

    </div>

    {{-- Daftar Lokasi di Bawah --}}
    <div class="max-w-6xl w-full">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Daftar Lokasi</h3>
        <ul class="space-y-4">
            @foreach ($locations as $location)
                <li class="flex justify-between items-center bg-gray-100 p-4 rounded-md shadow-sm hover:shadow-md transition">
                    <div>
                        <strong class="text-blue-600">{{ $location->name }}</strong>
                        <p class="text-sm text-gray-600">{{ $location->alamat }}</p>
                        <p class="text-sm text-gray-600">({{ $location->latitude }}, {{ $location->longitude }})</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('locations.edit', $location->id) }}"
                            class="text-white bg-blue-600 px-4 py-2 rounded-md hover:bg-blue-700 transition">
                            Edit
                        </a>
                        <form action="{{ route('locations.destroy', $location->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus lokasi ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</section>

{{-- Leaflet JS --}}
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

{{-- Leaflet Init Map --}}
<script>
    var map = L.map('map').setView([0, 0], 2);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
    }).addTo(map);

    var markers = [];

    @foreach ($locations as $location)
        var marker = L.marker([{{ $location->latitude }}, {{ $location->longitude }}])
            .addTo(map)
            .bindPopup("<strong>{{ $location->name }}</strong><br>{{ $location->alamat ?? '' }}");
        markers.push(marker.getLatLng());
    @endforeach

    if (markers.length > 0) {
        map.fitBounds(markers);
    }

    // Tambahkan variabel marker klik untuk bisa dihapus/dipindah
    var clickMarker;

    // Event listener klik peta
    map.on('click', function(e) {
        var lat = e.latlng.lat.toFixed(7);
        var lng = e.latlng.lng.toFixed(7);

        // Update input form
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;

        // Jika marker sebelumnya ada, hapus
        if (clickMarker) {
            map.removeLayer(clickMarker);
        }

        // Tambahkan marker baru di posisi klik
        clickMarker = L.marker([lat, lng], { draggable: true }).addTo(map);

        // Jika marker drag, update input juga
        clickMarker.on('dragend', function(event) {
            var position = event.target.getLatLng();
            document.getElementById('latitude').value = position.lat.toFixed(7);
            document.getElementById('longitude').value = position.lng.toFixed(7);
        });
    });
</script>


@include('layout.footer')
@endsection
