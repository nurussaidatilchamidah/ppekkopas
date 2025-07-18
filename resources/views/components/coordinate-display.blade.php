@props(['latitude', 'longitude', 'address' => null])

<div class="coordinate-display">
    <div class="row">
        <div class="col-md-6">
            <strong>Koordinat:</strong><br>
            Latitude: {{ $latitude }}<br>
            Longitude: {{ $longitude }}
        </div>
        <div class="col-md-6">
            <a href="https://www.google.com/maps?q={{ $latitude }},{{ $longitude }}" 
               target="_blank" 
               class="btn btn-sm btn-bps-primary">
                <i class="fas fa-map-marker-alt"></i> Lihat di Google Maps
            </a>
        </div>
    </div>
    
    <!-- Mini Map -->
    <div class="mt-3">
        <div id="map-{{ md5($latitude.$longitude) }}" style="height: 200px; width: 100%;"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mapId = 'map-{{ md5($latitude.$longitude) }}';
    const lat = {{ $latitude }};
    const lng = {{ $longitude }};
    
    const map = new google.maps.Map(document.getElementById(mapId), {
        center: { lat: lat, lng: lng },
        zoom: 15
    });
    
    const marker = new google.maps.Marker({
        position: { lat: lat, lng: lng },
        map: map,
        title: 'Lokasi Usaha'
    });
    
    // Reverse geocoding untuk mendapatkan alamat
    const geocoder = new google.maps.Geocoder();
    geocoder.geocode({ location: { lat: lat, lng: lng } }, (results, status) => {
        if (status === 'OK' && results[0]) {
            const infoWindow = new google.maps.InfoWindow({
                content: `
                    <div>
                        <strong>Alamat:</strong><br>
                        ${results[0].formatted_address}
                    </div>
                `
            });
            
            marker.addListener('click', () => {
                infoWindow.open(map, marker);
            });
        }
    });
});
</script>