@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Detail Pendataan Usaha</h2>

    <table class="table table-bordered">
        <tr><th>Kelurahan</th><td>{{ $data->kelurahan }}</td></tr>
        <tr><th>RW</th><td>{{ $data->rw }}</td></tr>
        <tr><th>RT</th><td>{{ $data->rt }}</td></tr>
        <tr><th>Nama Usaha</th><td>{{ $data->nama_usaha }}</td></tr>
        <tr><th>Kategori Usaha</th><td>{{ $data->kategori_usaha }}</td></tr> 
        <tr><th>Jumlah Tenaga Kerja</th><td>{{ $data->jumlah_tenaga_kerja }}</td></tr>
        <tr><th>Pendapatan/Tahun</th><td>{{ $data->pendapatan_per_bulan }}</td></tr>
        <tr><th>Pengeluaran</th><td>{{ $data->pengeluaran_operasional }}</td></tr>
        <tr><th>Nilai Aset Gedung</th><td>{{ $data->nilai_aset_gedung_dan_kendaraan }}</td></tr>
        <tr><th>Nilai Aset Mesin</th><td>{{ $data->nilai_aset_mesin_dan_alat_produksi_lain }}</td></tr>
        <tr><th>Izin Usaha</th><td>{{ $data->izin_usaha ?? '-' }}</td></tr>
        <tr><th>Catatan</th><td>{{ $data->catatan ?? '-' }}</td></tr>
    </table>
    <a href="{{ route('pendataan.index') }}" class="btn btn-secondary mt-4">Kembali</a>
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
@endsection
