@include('layout.header')

{{-- Leaflet CSS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<section class="bg-white py-12 px-4 min-h-screen">
    <h2 class="text-3xl font-bold text-center text-blue-600 mb-10">Lokasi Kami</h2>

    {{-- Leaflet Map --}}
    <div id="map" class="max-w-5xl mx-auto h-[400px] rounded-lg shadow-md z-10 mb-10"></div>

    {{-- Search Produk --}}
    <div class="max-w-5xl mx-auto mb-8">
        <form action="{{ route('locations.index') }}" method="GET" class="flex gap-4">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Cari produk..." 
                class="flex-grow px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <button type="submit" 
                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                Cari
            </button>
        </form>
    </div>

    {{-- Tabel hasil pencarian produk --}}
    @if(isset($products) && $products->count() > 0)
        <div class="max-w-5xl mx-auto overflow-x-auto">
            <table class="min-w-full border border-gray-300 rounded-md">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left">Nama Produk</th>
                        <th class="px-6 py-3 text-left">Stok</th>
                        <th class="px-6 py-3 text-left">Lokasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        @foreach ($product->locations as $location)
                            <tr class="border-t border-gray-200">
                                <td class="px-6 py-3">{{ $product->name }}</td>
                                <td class="px-6 py-3">{{ $location->pivot->stock }}</td>
                                <td class="px-6 py-3">{{ $location->name }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    @elseif(request()->has('search'))
        <p class="text-center text-gray-600 mt-6">Produk tidak ditemukan di lokasi manapun.</p>
    @endif

    {{-- Daftar lokasi --}}
    <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-center mt-12">
        @foreach ($locations as $location)
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition duration-300">
                <h3 class="font-semibold text-gray-900 text-lg mb-2">{{ $location->name }}</h3>
                <p class="text-sm text-gray-600 mb-4">Koordinat: {{ $location->latitude }}, {{ $location->longitude }}</p>
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
    var map = L.map('map').setView([-7.7956, 110.3695], 12); // Default Yogyakarta

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
    }
</script>

@include('layout.footer')
