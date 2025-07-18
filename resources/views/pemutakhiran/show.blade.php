@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Detail Pemutakhiran Usaha</h2>

    <table class="table table-bordered">
        <tr><th>Kelurahan</th><td>{{ $data->kelurahan }}</td></tr>
        <tr><th>RW</th><td>{{ $data->rw }}</td></tr>
        <tr><th>RT</th><td>{{ $data->rt }}</td></tr>
        <tr><th>Nama Usaha</th><td>{{ $data->nama_usaha }}</td></tr>
        <tr><th>Nama Pemilik</th><td>{{ $data->nama_pemilik }}</td></tr>
        <tr><th>Alamat Usaha</th><td>{{ $data->alamat_usaha }}</td></tr>
        <tr><th>Deskripsi Usaha</th><td>{{ $data->deskripsi_usaha}}</td></tr>
        <tr><th>Kategori Usaha</th><td>{{ $data->kategori_usaha }}</td></tr>
        <tr><th>Catatan</th><td>{{ $data->catatan ?? '-' }}</td></tr>
        <tr><th>Koordinat (Lat, Long)</th><td>{{ $data->latitude }},{{ $data->longitude }}</td></tr>
    </table>

        <h5 class="mt-4">Lokasi Usaha:</h5>
    <div id="map"></div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
    #map {
        height: 350px;
        width: 100%;
        margin-top: 20px;
        border-radius: 8px;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var lat = {{ $data->latitude ?? 0 }};
        var lng = {{ $data->longitude ?? 0 }};

        var map = L.map('map').setView([lat, lng], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        L.marker([lat, lng]).addTo(map)
            .bindPopup("Lokasi Usaha")
            .openPopup();
    });
</script>

    <a href="{{ route('pemutakhiran.index') }}" class="btn btn-secondary mt-5">Kembali</a>
</div>
@endsection
