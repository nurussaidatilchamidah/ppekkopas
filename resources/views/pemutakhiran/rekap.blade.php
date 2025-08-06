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

{{-- PETA INTERAKTIF (LEAFLET) --}}

<style>
    #map {
        width: 1200px;
        height: 500px;
        border: 2px solid #ddd;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .legend {
        background: white;
        padding: 10px;
        border-radius: 5px;
        line-height: 1.5;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        border: 1px solid #ccc;
    }

    .legend img {
        vertical-align: middle;
        margin-right: 8px;
        width: 12px;
        height: 20px;
    }
</style>

<div class="container mt-5">
    <h4 class="mb-4 fw-bold text-center" style="font-size: 1.2rem;">Peta Sebaran Usaha</h4>

    <div class="d-flex justify-content-center mb-5">
        <div id="map" class="rounded shadow-sm"></div>
    </div>
</div>

{{-- Leaflet CSS & JS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // Inisialisasi peta
    const map = L.map('map').setView([-7.640597, 112.911583], 13);

    // Tambahkan tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Data dari backend
    const dataUsaha = @json($lokasiUsaha);

    // Warna per kelurahan
    const kelurahanColors = {
        'Gentong': 'blue',
        'Mandaranrejo': 'red',
        'Pohjentrek': 'green',
        'Randusari': 'orange'
    };

    dataUsaha.forEach(item => {
        const kel = item.kelurahan?.trim();
        const warna = kelurahanColors[kel];

        if (item.latitude && item.longitude && warna) {
            // Buat custom icon
            const customIcon = L.icon({
                iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-${warna}.png`,
                shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            const marker = L.marker([item.latitude, item.longitude], { icon: customIcon }).addTo(map);
            const linkMaps = `https://www.google.com/maps?q=${item.latitude},${item.longitude}`;
            marker.bindPopup(`<strong>${item.nama_usaha}</strong><br><a href="${linkMaps}" target="_blank">📍 Lihat di Google Maps</a>`);
        }
    });

    // LEGEND
    const legend = L.control({ position: 'bottomright' });
    legend.onAdd = function () {
        const div = L.DomUtil.create('div', 'legend');
        div.innerHTML += "<strong>Keterangan Kelurahan</strong><br>";

        for (const [nama, warna] of Object.entries(kelurahanColors)) {
            const iconUrl = `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-${warna}.png`;
            div.innerHTML += `<img src="${iconUrl}"> ${nama}<br>`;
        }

        return div;
    };
    legend.addTo(map);
</script>

<!-- kanan: tombol kembali -->
    <div class="d-flex justify-content-end mt-3">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@endsection
