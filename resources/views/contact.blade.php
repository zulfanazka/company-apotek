@include('layout.header')

{{-- Leaflet CSS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<section class="bg-white py-12 px-4">
    <h2 class="text-3xl font-bold text-center text-blue-600 mb-10">Hubungi Kami</h2>

    {{-- Leaflet Map --}}
    <div id="map" class="max-w-5xl mx-auto h-[400px] rounded-lg shadow-md z-10"></div>

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
