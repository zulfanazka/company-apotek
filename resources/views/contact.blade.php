@include('layout.header')

{{-- Leaflet CSS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<section class="bg-white py-12 px-4">
    <h2 class="text-3xl font-bold text-center text-blue-600 mb-10">Lokasi Apotik Rajawali</h2>

    {{-- Leaflet Map --}}
    <div id="map" class="max-w-5xl mx-auto h-[400px] rounded-lg shadow-md z-10"></div>

    </br>
    <h2 class="text-3xl font-bold text-center text-blue-600 mb-10">Hubungi Kami</h2>

    {{-- Info Apotek --}}
<div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-center mt-12">
    @foreach ($locations as $location)
        <a href="#" 
           class="block bg-white p-6 rounded-lg shadow hover:shadow-lg transition duration-300 no-underline location-card flex flex-col justify-between"
           data-id="{{ $location->id }}"
           style="min-height: 280px; text-align: left;">
           
            <div>
                <h3 class="font-semibold text-gray-900 text-xl mb-3">{{ $location->name }}</h3>
                <p class="text-sm text-gray-600 mb-4">Koordinat: {{ $location->latitude }}, {{ $location->longitude }}</p>
            </div>

            <div class="text-sm text-gray-700 space-y-3">
                <p class="flex items-center"><i class="fas fa-envelope text-blue-500 mr-2"></i>apotekrajawali@gmail.com</p>
                <p class="flex items-center"><i class="fas fa-phone text-blue-500 mr-2"></i>+62 345678910</p>
                <p class="flex items-center"><i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>{{ $location->alamat ?? '-' }}</p>
            </div>
        </a>
    @endforeach
</div>

</section>

{{-- Leaflet JS --}}
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    var map = L.map('map');

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
    }).addTo(map);

    var markers = {};
    var markerGroup = L.featureGroup().addTo(map);

    @foreach ($locations as $location)
        var marker = L.marker([{{ $location->latitude }}, {{ $location->longitude }}])
            .bindPopup(`
                <strong>{{ $location->name }}</strong><br>
                <span>{{ $location->alamat }}</span><br>
                <a href="{{ route('lihatbarang', ['location' => $location->id]) }}" class="text-blue-600 underline hover:text-blue-800" target="_blank">Lihat Barang</a>
            `);
        marker.addTo(markerGroup);
        markers[{{ $location->id }}] = marker;
    @endforeach

    if (Object.keys(markers).length > 0) {
        map.fitBounds(markerGroup.getBounds());
    } else {
        map.setView([-7.7956, 110.3695], 12);
    }

    // Event listener untuk klik card
    document.querySelectorAll('.location-card').forEach(function(card) {
        // Di bagian event klik card:
        card.addEventListener('click', function(e) {
    e.preventDefault();
    var id = this.getAttribute('data-id');
    var marker = markers[id];
    if (marker) {
        // Fly to posisi marker dengan zoom 16 dan pastikan marker di tengah
        map.flyTo(marker.getLatLng(), 16);

        // Buka popup setelah animasi selesai (delay)
        setTimeout(() => {
            marker.openPopup();
        }, 1000); // sesuaikan delay sesuai durasi flyTo
    }
});


    });
</script>

@include('layout.footer')
