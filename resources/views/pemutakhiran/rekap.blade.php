@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h2 class="mb-5 text-center fw-bold mt-5" style="font-size: 1.8rem; font-family: Arial, sans-serif; font-style: italic;">Rekapitulasi Data</h2>

    {{-- Tabel 1: Jumlah Usaha per Kelurahan --}}
<style>
    h4 {
        font-size: 1.1rem;
    }
    .table th, .table td {
        font-size: 0.85rem;
        vertical-align: middle;
    }
    .badge.fs-6 {
        font-size: 0.85rem;
        padding: 0.4em 0.8em;
    }
</style>

    <div class="mb-4">
        <h4 class="fw-bold border-bottom pb-2 mb-3" style="color: #121213ff;">
        Rekap Seluruh Usaha di masing-masing Kelurahan
        </h4>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-light">
                <tr class="text-center">
                    <th>No</th>
                    <th>Kelurahan</th>
                    <th>Jumlah Usaha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rekapPerKelurahan as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->kelurahan }}</td>
                        <td>{{ $item->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Tabel 2-5: Rekap per RT/RW (tiap kelurahan) --}}
    <style>
    h4 {
        font-size: 1.1rem;
    }
    h5 {
        font-size: 1.0rem;
    }
    .table th, .table td {
        font-size: 0.85rem;
        vertical-align: middle;
    }
    .badge.fs-6 {
        font-size: 0.85rem;
        padding: 0.4em 0.8em;
    }
</style>
    
    <div class="mb-3">
        <h4 class="fw-bold border-bottom pb-2 mb-3 mt-5" style="color: #121213ff;">
        Rekap Usaha per RT/RW setiap Kelurahan
        </h4>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-light">
                <tr class="text-center">
        @foreach ($rekapRTRW as $kelurahan => $items)
            <h5 class="mt-4" style="font-style: italic;">{{ $kelurahan }}</h5>
        <table class="table table-bordered table-hover table-striped align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>RW</th>
                        <th>RT</th>
                        <th>Jumlah Usaha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row->rw }}</td>
                            <td>{{ $row->rt }}</td>
                            <td>{{ $row->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>

    {{-- Tabel 6: Jumlah Usaha per Kategori per Kelurahan --}}
    @php
    $kategoriList = [
        'A. Pertanian, Kehutanan, dan Perikanan',
        'B. Pertambangan dan Penggalian',
        'C. Industri Pengolahan',
        'D. Pengadaan Listrik, Gas, Uap/Air Panas dan Udara Dingin',
        'E. Pengadaan Air, Pengelolaan Sampah, Limbah, dan Daur Ulang',
        'F. Konstruksi',
        'G. Perdagangan Besar dan Eceran, Reparasi Mobil dan Sepeda Motor',
        'H. Transportasi dan Pergudangan',
        'I. Penyediaan Akomodasi dan Makan Minum',
        'J. Informasi dan Komunikasi',
        'K. Jasa Keuangan dan Asuransi',
        'L. Real Estat',
        'M. Aktivitas Profesional, Ilmiah, dan Teknis',
        'N. Aktivitas Penyewaan dan Sewa Guna Usaha tanpa Hak Opsi, Ketenagakerjaan, Agen Perjalanan dan Penunjang Usaha Lainnya',
        'O. Administrasi Pemerintahan, Pertahanan, dan Jaminan Sosial Wajib',
        'P. Jasa Pendidikan',
        'Q. Jasa Kesehatan dan Kegiatan Sosial',
        'R. Kesenian, Hiburan, dan Rekreasi',
        'S. Aktivitas Jasa Lainnya',
    ];
@endphp

<style>
    h4 {
        font-size: 1.1rem;
    }
  
    .table th, .table td {
        font-size: 0.85rem;
        vertical-align: middle;
    }
    .badge.fs-6 {
        font-size: 0.85rem;
        padding: 0.4em 0.8em;
    }
</style>
    
    <div class="mb-3">
        <h4 class="fw-bold border-bottom pb-2 mb-5 mt-5" style="color: #121213ff;">
        Rekap Usaha per Kelurahan Menurut Kategori Usaha
        </h4>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-light">
                <tr class="text-center">
                    <th style="min-width: 60px;">No</th>
                    <th style="min-width: 150px;">Kelurahan</th>
                    @foreach ($kategoriList as $kat)
                        <th style="min-width: 220px;">{{ $kat }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($rekapKategori as $kel => $data)
                    <tr class="{{ $loop->iteration % 2 == 0 ? 'table-light' : '' }}">
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $kel }}</td>
                        @foreach ($kategoriList as $kat)
                            @php
                                $found = $data->firstWhere('kategori_usaha', $kat);
                            @endphp
                            <td class="text-center">{{ $found ? $found->total : 0 }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- PETA INTERAKTIF (LEAFLET)  --}}

<style>
    #map {
        width: 1200px;
        height: 500px;
        border: 2px solid #ddd;
        border-radius: 8px;
        margin-bottom: 20px; /* jarak ke bawah */
    }       
</style>

<div class="container mt-5">
    <h4 class="mb-4 fw-bold text-center" style="font-size: 1.2rem;">Peta Sebaran Usaha</h4>

    <div class="d-flex justify-content-center mb-5">
        <div id="map" class="rounded shadow-sm"></div>
    </div>
</div>

{{-- Leaflet CSS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

{{-- Leaflet JS --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // Inisialisasi Peta
    const map = L.map('map').setView([-7.640597, 112.911583], 13); // Pusat di Pasuruan

    // Tambah Layer Peta OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Data lokasi usaha dari PHP
    const dataUsaha = @json($lokasiUsaha);

    // Tambahkan marker
    dataUsaha.forEach(item => {
        if (item.latitude && item.longitude) {
            const marker = L.marker([item.latitude, item.longitude]).addTo(map);
            const linkMaps = `https://www.google.com/maps?q=${item.latitude},${item.longitude}`;

            marker.bindPopup(`<strong>${item.nama_usaha}</strong><br><a href="${linkMaps}" target="_blank">📍 Lihat di Google Maps</a>`);
        }
    });
</script>

<!-- kanan: tombol kembali -->
    <div class="d-flex justify-content-end mt-3">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@endsection
