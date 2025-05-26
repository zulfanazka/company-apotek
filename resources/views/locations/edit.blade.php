@include('layout.header')

{{-- Leaflet CSS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<section class="bg-white py-12 px-6 min-h-screen flex items-center justify-center">
    <div class="max-w-6xl w-full flex flex-col md:flex-row gap-10 bg-white shadow-lg rounded-lg p-8">

        {{-- Form Edit Lokasi --}}
        <div class="md:w-1/2">
            <h1 class="text-4xl font-bold text-blue-600 mb-8">Edit Lokasi</h1>
            <form action="{{ route('locations.update', $location->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Nama Lokasi --}}
                <div>
                    <label for="name" class="block mb-2 font-semibold text-blue-700">Nama Lokasi</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name', $location->name) }}"
                        required
                        placeholder="Masukkan nama lokasi"
                        class="w-full px-5 py-3 border-2 border-blue-300 rounded-md focus:outline-none focus:border-blue-600 transition"
                    >
                </div>

                {{-- Alamat --}}
                <div>
                    <label for="alamat" class="block mb-2 font-semibold text-blue-700">Alamat</label>
                    <textarea
                        name="alamat"
                        id="alamat"
                        rows="3"
                        placeholder="Masukkan alamat lengkap"
                        class="w-full px-5 py-3 border-2 border-blue-300 rounded-md focus:outline-none focus:border-blue-600 transition"
                    >{{ old('alamat', $location->alamat) }}</textarea>
                </div>

                {{-- Latitude --}}
                <div>
                    <label for="latitude" class="block mb-2 font-semibold text-blue-700">Latitude</label>
                    <input
                        type="text"
                        name="latitude"
                        id="latitude"
                        value="{{ old('latitude', $location->latitude) }}"
                        required
                        placeholder="Masukkan latitude"
                        class="w-full px-5 py-3 border-2 border-blue-300 rounded-md focus:outline-none focus:border-blue-600 transition"
                    >
                </div>

                {{-- Longitude --}}
                <div>
                    <label for="longitude" class="block mb-2 font-semibold text-blue-700">Longitude</label>
                    <input
                        type="text"
                        name="longitude"
                        id="longitude"
                        value="{{ old('longitude', $location->longitude) }}"
                        required
                        placeholder="Masukkan longitude"
                        class="w-full px-5 py-3 border-2 border-blue-300 rounded-md focus:outline-none focus:border-blue-600 transition"
                    >
                </div>

                {{-- Submit Button --}}
                <button
                    type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-md font-bold hover:bg-blue-700 transition"
                >
                    Perbarui Lokasi
                </button>
            </form>
        </div>

        {{-- Peta Leaflet --}}
        <div class="md:w-1/2 rounded-lg overflow-hidden shadow-lg">
            <div id="map" class="h-[450px] w-full rounded-md"></div>
            <p class="text-center text-blue-600 mt-3 font-semibold text-sm">
                Geser pin di peta untuk mengubah koordinat lokasi
            </p>
        </div>

    </div>
</section>

{{-- Leaflet JS --}}
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

{{-- Leaflet Init Map --}}
<script>
    var map = L.map('map').setView([{{ $location->latitude }}, {{ $location->longitude }}], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
    }).addTo(map);

    var marker = L.marker([{{ $location->latitude }}, {{ $location->longitude }}], {
        draggable: true
    }).addTo(map);

    marker.on('dragend', function(e) {
        var latLng = e.target.getLatLng();
        document.getElementById('latitude').value = latLng.lat.toFixed(6);
        document.getElementById('longitude').value = latLng.lng.toFixed(6);
    });
</script>

@include('layout.footer')
