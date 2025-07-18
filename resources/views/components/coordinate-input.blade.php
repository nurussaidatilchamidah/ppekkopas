@props(['latitude' => null, 'longitude' => null])

<div class="coordinate-input">
    <div class="row">
        <div class="col-md-6">
            <label for="latitude" class="form-label">Latitude <span class="text-danger">*</span></label>
            <input type="text" 
                   class="form-control" 
                   id="latitude" 
                   name="latitude" 
                   value="{{ old('latitude', $latitude) }}" 
                   placeholder="Contoh: -7.9666204"
                   required>
        </div>
        <div class="col-md-6">
            <label for="longitude" class="form-label">Longitude <span class="text-danger">*</span></label>
            <input type="text" 
                   class="form-control" 
                   id="longitude" 
                   name="longitude" 
                   value="{{ old('longitude', $longitude) }}" 
                   placeholder="Contoh: 112.6326321"
                   required>
        </div>
    </div>
    
    <div class="mt-3">
        <button type="button" class="btn btn-bps-warning" onclick="getCurrentLocation()">
            <i class="fas fa-location-arrow"></i> Gunakan Lokasi Saat Ini
        </button>
        <button type="button" class="btn btn-bps-primary" onclick="openMapPicker()">
            <i class="fas fa-map"></i> Pilih dari Peta
        </button>
    </div>
    
    <!-- Map untuk memilih lokasi -->
    <div class="mt-3">
        <div id="coordinate-map" style="height: 300px; width: 100%;"></div>
    </div>
</div>

<script>
let map;
let marker;

function initMap() {
    // Default ke koordinat Pasuruan
    const defaultLat = {{ $latitude ?? -7.9666204 }};
    const defaultLng = {{ $longitude ?? 112.6326321 }};
    
    map = new google.maps.Map(document.getElementById('coordinate-map'), {
        center: { lat: defaultLat, lng: defaultLng },
        zoom: 13
    });
    
    marker = new google.maps.Marker({
        position: { lat: defaultLat, lng: defaultLng },
        map: map,
        draggable: true,
        title: 'Drag untuk memilih lokasi'
    });
    
    // Update input saat marker di-drag
    marker.addListener('dragend', function() {
        const position = marker.getPosition();
        document.getElementById('latitude').value = position.lat().toFixed(8);
        document.getElementById('longitude').value = position.lng().toFixed(8);
    });
    
    // Klik peta untuk memindahkan marker
    map.addListener('click', function(event) {
        marker.setPosition(event.latLng);
        document.getElementById('latitude').value = event.latLng.lat().toFixed(8);
        document.getElementById('longitude').value = event.latLng.lng().toFixed(8);
    });
}

function getCurrentLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            
            document.getElementById('latitude').value = lat.toFixed(8);
            document.getElementById('longitude').value = lng.toFixed(8);
            
            map.setCenter({ lat: lat, lng: lng });
            marker.setPosition({ lat: lat, lng: lng });
        }, function() {
            alert('Gagal mendapatkan lokasi. Pastikan GPS diaktifkan.');
        });
    } else {
        alert('Browser tidak mendukung geolocation.');
    }
}

function openMapPicker() {
    // Smooth scroll ke peta
    document.getElementById('coordinate-map').scrollIntoView({ 
        behavior: 'smooth' 
    });
}

// Initialize map when page loads
document.addEventListener('DOMContentLoaded', function() {
    initMap();
});
</script>