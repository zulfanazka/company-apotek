@include('layout.header')

{{-- Leaflet CSS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<section class="bg-white py-12 px-4">
    <h2 class="text-3xl font-bold text-center text-blue-600 mb-10">Hubungi Kami</h2>

    {{-- Leaflet Map --}}
    <div id="map" class="max-w-5xl mx-auto h-[400px] rounded-lg shadow-md z-10"></div>

    {{-- Form Tambah Lokasi --}}
    {{-- <form action="{{ route('locations.store') }}" method="POST" style="margin-bottom: 20px;">
        @csrf
        <input type="text" name="name" placeholder="Nama Lokasi" required>
        <input type="text" name="latitude" placeholder="Latitude" required>
        <input type="text" name="longitude" placeholder="Longitude" required>
        <button type="submit">Simpan</button>
    </form> --}}

    {{-- List Lokasi --}}
    {{-- <ul>
        @foreach ($locations as $location)
            <li>
                {{ $location->name }} ({{ $location->latitude }}, {{ $location->longitude }})
                <a href="{{ route('locations.edit', $location->id) }}">Edit</a>
                <form action="{{ route('locations.destroy', $location->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </li>
        @endforeach
    </ul> --}}

    {{-- tambah peta --}}
    {{-- <a href="{{ route('locations.create') }}">tambah peta</a> --}}
    <div class="max-w-5xl mx-auto my-6 flex justify-end">
        <a href="{{ route('locations.create') }}"
            class="inline-flex items-center px-5 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Peta
        </a>
    </div>



    {{-- Info Apotek --}}
    <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-center mt-12">
        @foreach ($locations as $location)
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition duration-300">
                <h3 class="font-semibold text-gray-900 text-lg mb-2">{{ $location->name }}</h3>
                <p class="text-sm text-gray-600 mb-4">Koordinat: {{ $location->latitude }}, {{ $location->longitude }}
                </p>
                <div class="text-sm text-gray-700 space-y-2">
                    <p><i class="fas fa-envelope text-blue-500 mr-2"></i>apotek@gmail.com</p>
                    <p><i class="fas fa-phone text-blue-500 mr-2"></i>12345678910</p>
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- Leaflet JS --}}
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

{{-- Leaflet Init Map --}}
<script>
    var map = L.map('map');

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
    }).addTo(map);

    var markers = [];

    @foreach ($locations as $location)
        var marker = L.marker([{{ $location->latitude }}, {{ $location->longitude }}])
            .addTo(map)
            .bindPopup("<strong>{{ $location->name }}</strong>");
        markers.push(marker.getLatLng());
    @endforeach

    if (markers.length > 0) {
        map.fitBounds(markers);
    } else {
        map.setView([0, 0], 2);
    }
</script>

@include('layout.footer')
