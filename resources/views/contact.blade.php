@include('layout.header')

{{-- Leaflet CSS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />

<style>
  #suggestions {
    list-style: none;
    padding: 0;
    margin-top: 0.25rem;
    max-height: 200px;
    overflow-y: auto;
    border: 1px solid #ccc;
    border-radius: 0.25rem;
    background: white;
    position: absolute;
    width: 100%;
    z-index: 1000;
  }
  #suggestions li {
    padding: 0.5rem;
    cursor: pointer;
  }
  #suggestions li:hover {
    background-color: #bee3f8;
  }
</style>

<section class="bg-white py-12 px-4">
    <h2 class="text-3xl font-bold text-center text-blue-600 mb-10">Lokasi Apotik Rajawali</h2>

    {{-- Leaflet Map --}}
    <div id="map" class="max-w-5xl mx-auto h-[600px] rounded-lg shadow-md z-10 mb-6"></div>

    {{-- Search Input --}}
    <div style="position: relative; max-width: 500px; margin: 0 auto 1.5rem;">
      <input id="search" type="text" placeholder="Cari alamat..." class="border rounded px-3 py-2 w-full" autocomplete="off" />
      <ul id="suggestions"></ul>
    </div>

    {{-- Dropdown tujuan & tombol tampilkan rute --}}
    <div class="max-w-5xl mx-auto flex justify-center items-center gap-4 mb-10">
      <select id="dest-location" class="border rounded px-3 py-2 w-72">
        <option value="">-- Pilih Apotek --</option>
        @foreach ($locations as $location)
          <option value="{{ $location->latitude }},{{ $location->longitude }}">
            {{ $location->name }}
          </option>
        @endforeach
      </select>
      <button id="show-route" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
        Tampilkan Rute
      </button>
    </div>

    <h2 class="text-3xl font-bold text-center text-blue-600 mb-10">Hubungi Kami</h2>

    {{-- Info Apotek --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-left max-w-6xl mx-auto mt-12">
      @foreach ($locations as $location)
        <a href="#" 
           class="block bg-white p-6 rounded-lg shadow hover:shadow-lg transition duration-300 no-underline location-card flex flex-col justify-between"
           data-id="{{ $location->id }}"
           style="min-height: 280px;">
           
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
<script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>

<script>
  var map = L.map('map').setView([-7.7956, 110.3695], 12);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
  }).addTo(map);

  var markerGroup = L.featureGroup().addTo(map);

  // Buat array JS lokasi dari PHP Laravel
  const lokasiData = [
    @foreach ($locations as $location)
      {
        id: {{ $location->id }},
        lat: {{ $location->latitude }},
        lng: {{ $location->longitude }}
      },
    @endforeach
  ];

  // Tambahkan marker ke peta dan markerGroup
  @foreach ($locations as $location)
    L.marker([{{ $location->latitude }}, {{ $location->longitude }}])
      .bindPopup(`
        <strong>{{ $location->name }}</strong><br>
        <span>{{ $location->alamat }}</span><br>
        <a href="{{ route('lihatbarang', ['location' => $location->id]) }}" target="_blank">Lihat Barang</a>
      `)
      .addTo(markerGroup);
  @endforeach

  if(markerGroup.getLayers().length > 0) {
    map.fitBounds(markerGroup.getBounds());
  }

  var routingControl = null;
  var searchMarker = null;
  var selectedStartLatLng = null;

  const input = document.getElementById('search');
  const suggestions = document.getElementById('suggestions');

  // Autocomplete Nominatim
  input.addEventListener('input', async () => {
    const query = input.value.trim();
    if (query.length < 3) {
      suggestions.innerHTML = '';
      return;
    }
    const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&addressdetails=1&limit=5&accept-language=id`;

    try {
      const response = await fetch(url);
      const results = await response.json();

      suggestions.innerHTML = results.map(place => `
        <li data-lat="${place.lat}" data-lon="${place.lon}">${place.display_name}</li>
      `).join('');

      suggestions.querySelectorAll('li').forEach(item => {
        item.addEventListener('click', () => {
          input.value = item.textContent;
          suggestions.innerHTML = '';

          const lat = parseFloat(item.dataset.lat);
          const lon = parseFloat(item.dataset.lon);

          selectedStartLatLng = L.latLng(lat, lon);

          if(searchMarker) {
            map.removeLayer(searchMarker);
          }
          // Buat marker awal yang draggable
          searchMarker = L.marker(selectedStartLatLng, { draggable: true }).addTo(map);
          map.setView(selectedStartLatLng, 16);

          // Update waypoint routing saat marker awal digeser
          searchMarker.on('dragend', function(e) {
            selectedStartLatLng = e.target.getLatLng();
            input.value = `Lat: ${selectedStartLatLng.lat.toFixed(6)}, Lon: ${selectedStartLatLng.lng.toFixed(6)}`;
            if (routingControl) {
              var waypoints = routingControl.getWaypoints();
              waypoints[0].latLng = selectedStartLatLng;
              routingControl.setWaypoints(waypoints);
            }
          });
        });
      });

    } catch (error) {
      console.error('Gagal fetch autocomplete:', error);
      suggestions.innerHTML = '';
    }
  });

  // Hide suggestions on outside click
  document.addEventListener('click', function(event) {
    if(!input.contains(event.target) && !suggestions.contains(event.target)) {
      suggestions.innerHTML = '';
    }
  });

  document.getElementById('show-route').addEventListener('click', function() {
    if (!selectedStartLatLng) {
      alert('Mohon pilih alamat awal dari hasil pencarian.');
      return;
    }
    var destVal = document.getElementById('dest-location').value;
    if (!destVal) {
      alert('Mohon pilih tujuan apotek.');
      return;
    }

    var destCoords = destVal.split(',');
    var latDest = parseFloat(destCoords[0]);
    var lngDest = parseFloat(destCoords[1]);

    if(routingControl) {
      map.removeControl(routingControl);
    }

    routingControl = L.Routing.control({
      waypoints: [
        selectedStartLatLng,
        L.latLng(latDest, lngDest)
      ],
      routeWhileDragging: false,  // Nonaktifkan update otomatis saat drag marker bawaan
      showAlternatives: true,
      draggableWaypoints: false,  // Nonaktifkan drag waypoints bawaan
      addWaypoints: false,
      altLineOptions: {
        styles: [
          {color: 'black', opacity: 0.15, weight: 9},
          {color: 'white', opacity: 0.8, weight: 6},
          {color: 'blue', opacity: 0.6, weight: 2}
        ]
      },
      createMarker: function() { return null; }  // Jangan buat marker bawaan routing control
    }).addTo(map);
  });

  // Event click pada card lokasi: zoom ke marker dan buka popup
  document.querySelectorAll('.location-card').forEach(card => {
    card.addEventListener('click', function(e) {
      e.preventDefault();
      const id = parseInt(this.dataset.id);
      const lokasi = lokasiData.find(loc => loc.id === id);
      if (!lokasi) return;

      let targetMarker = null;
      markerGroup.eachLayer(function(marker) {
        if (marker.getLatLng().lat === lokasi.lat && marker.getLatLng().lng === lokasi.lng) {
          targetMarker = marker;
        }
      });

      if (targetMarker) {
        map.setView(targetMarker.getLatLng(), 16, { animate: true });
        targetMarker.openPopup();
      }
    });
  });
</script>


@include('layout.footer')
