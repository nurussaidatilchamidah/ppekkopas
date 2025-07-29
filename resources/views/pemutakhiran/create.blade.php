@extends('layouts.app')

@section('content')

@php
    $oldData = session('pendataan');
@endphp


<div class="container mt-5">
    <h2 class="mb-4">Tambah Data Pemutakhiran</h2>
    <form action="{{ route('pemutakhiran.store') }}" method="POST">
        @csrf

        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
            <div class="mb-3">
            <label for="kelurahan" class="form-label">Kelurahan<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
            <select name="kelurahan" class="form-control" required>
                <option value="" disabled {{ session('prefill_pendataan.kelurahan') ? '' : 'selected' }}>-- Pilih Kelurahan --</option>
                @foreach([
                    'Krapyakrejo','Bukir','Sebani','Gentong','Gadingrejo','Randusari',
                    'Petahunan','Karangketug','Pohjentrek','Wirogunan','Tembokrejo','Purutrejo',
                    'Kebonagung','Purworejo','Sekargadung','Blandongan','Bakalan','Krampyangan',
                    'Bugulkidul','Kepel','Tapaan','Pekucen','Pertamanan','Bugullor','Kandangsapi',
                    'Bangilan','Kebonsari','Karanganyar','Trajeng','Mayangan','Panggungrejo','Madaranrejo',
                    'Ngemplakrejo','Tambaan'
                ] as $item)
                    <option value="{{ $item }}" {{ session('prefill_pendataan.kelurahan') == $item ? 'selected' : '' }}>{{ $item }}</option>
                @endforeach
            </select>
        </div>

     <div class="mb-3">
            <label for="rw" class="form-label">RW<span class="text-danger fw-bold" style="font-size: 1.3em;">*</span></label>
            <select name="rw" class="form-control" required>
                <option value="" disabled {{ session('prefill_pendataan.rw') ? '' : 'selected' }}>-- Pilih RW --</option>
                @foreach(['001', '002', '003', '004', '005', '006', '007', '008', '009', '010','011','012'] as $item)
                    <option value="{{ $item }}" {{ session('prefill_pendataan.rw') == $item ? 'selected' : '' }}>{{ $item }}</option>
                @endforeach
            </select>
    </div>

    <div class="mb-3">
        <label for="rt" class="form-label">RT<span class="text-danger fw-bold" style="font-size: 1.3em;">*</span></label>
        <select name="rt" class="form-control" required>
            <option value="" disabled {{ session('prefill_pendataan.rt') ? '' : 'selected' }}>-- Pilih RT --</option>
            @foreach(['001', '002', '003', '004', '005', '006', '007', '008', '009', '010',
            '011','012','013','014','015','016','017','018','019','020'] as $item)
                <option value="{{ $item }}" {{ session('prefill_pendataan.rt') == $item ? 'selected' : '' }}>{{ $item }}</option>
            @endforeach 
        </select>
    </div>

    <div class="mb-3">
        <label for="nama_usaha">Nama Usaha<span class="text-danger fw-bold" style="font-size: 1.3em;">*</span></label>
        <input type="text" name="nama_usaha" class="form-control" required placeholder="Nama usaha wajib diisi" 
        value="{{ session('prefill_pendataan.nama_usaha') }}">
    </div>

    <div class="mb-3">
         <label for="rt">Nama Pemilik</label>
        <input type="text" name="nama_pemilik" class="form-control" placeholder="Nama pemilik tidak wajib diisi">
    </div>
</div>

     <!-- Kolom Kanan -->
    <div class="col-md-6">
    <div class="mb-3">
         <label for="rt"> Alamat Usaha</label>
        <input type="text" name="alamat_usaha" class="form-control" placeholder="Alamat usaha tidak wajib diisi">
    </div>

     <div class="mb-3">
         <label for="rt">Deskripsi Usaha<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
        <input type="text" name="deskripsi_usaha" class="form-control" required placeholder="Deskripsi usaha wajib diisi">
    </div>

    <div class="mb-3">
            <label for="kategori_usaha" class="form-label">Kategori Usaha<span class="text-danger fw-bold" style="font-size: 1.3em;">*</span></label>
            <select name="kategori_usaha" class="form-control" required>
                <option value="" disabled {{ old('kategori_usaha') ? '' : 'selected' }}>-- Pilih Kategori Usaha --</option>
                @foreach(
                ['A. Pertanian, Kehutanan, dan Perikanan', 'B. Pertambangan dan Penggalian', 'C. Industri Pengolahan', 'D. Pengadaan Listrik, Gas, Uap/Air Panas dan Udara Dingin', 'E. Pengadaan Air, Pengelolaan Sampah, Limbah, dan Daur Ulang',
                'F. Konstruksi', 'G. Perdagangan Besar dan Eceran, Reparasi Mobil dan Sepeda Motor', 'H. Transportasi dan Pergudangan', 'I. Penyediaan Akomodasi dan Makan Minum',
                'J. Informasi dan Komunikasi','K. Jasa Keuangan dan Asuransi','L. Real Estat','M. Aktivitas Profesional, Ilmiah, dan Teknis','N. Aktivitas Penyewaan dan Sewa Guna Usaha tanpa Hak Opsi, Ketenagakerjaan, 
                Agen Perjalanan dan Penunjang Usaha Lainnya',
                 'O. Administrasi Pemerintahan, Pertahanan, dan Jaminan Sosial Wajib','P. Jasa Pendidikan', 
                'Q. Jasa Kesehatan dan Kegiatan Sosial','R. Kesenian, Hiburan, dan Rekreasi', 'S. Aktivitas Jasa Lainnya'
                ] as $item)
                <option value="{{ $item }}" {{ session('prefill_pendataan.kategori_usaha') == $item ? 'selected' : '' }}>{{ $item }}</option>
                @endforeach
            </select>
        </div>

     <div class="mb-3">
         <label for="rt">Catatan</label>
        <input type="longtext" name="catatan" class="form-control" placeholder="Catatan tidak wajib diisi">
    </div>

        <div class="mb-3">
            <label for="latlong">Ambil Koordinat<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
            <div class="input-group">
                <input type="text" id="latlong" name="latlong" placeholder="Titik koordinat wajib diisi" class="form-control" value="{{ old('latlong') }}" readonly required>
                <button type="button" class="btn btn-primary" onclick="getLocation()">Ambil Koordinat</button>
            </div>
            <small class="text-muted">Klik tombol untuk mengambil koordinat dari lokasi saat ini.</small>
        </div>
</div>
</div>

<div class="my-3">
    <button id="btn-center-map" class="btn btn-outline-primary mb-2">📍 Pusatkan ke Lokasi Saya</button>
    <div id="map"></div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    
    <script>
    let marker; // global marker
    let map; // global map

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            alert("Browser Anda tidak mendukung Geolocation.");
        }
    }

    function showPosition(position) {
        const lat = position.coords.latitude.toFixed(6);
        const lng = position.coords.longitude.toFixed(6);
        const latlng = `${lat},${lng}`;
        document.getElementById("latlong").value = latlng;

        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker([lat, lng]).addTo(map);
        map.flyTo([lat, lng], 16, {
        animate: true,
        duration: 1.5 // durasi animasi dalam detik
    });
}

    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                alert("User menolak permintaan geolocation.");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("Informasi lokasi tidak tersedia.");
                break;
            case error.TIMEOUT:
                alert("Permintaan lokasi melebihi batas waktu.");
                break;
            case error.UNKNOWN_ERROR:
                alert("Terjadi kesalahan yang tidak diketahui.");
                break;
        }
    }

    // Inisialisasi peta setelah DOM siap
    document.addEventListener("DOMContentLoaded", function() {
        map = L.map('map').setView([-7.6450, 112.9076], 13); // Lokasi awal
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        map.on('click', function(e) {
            var lat = e.latlng.lat.toFixed(6);
            var lng = e.latlng.lng.toFixed(6);
            var latlng = lat + ',' + lng;

            document.getElementById('latlong').value = latlng;

            if (marker) {
                map.removeLayer(marker);
            }

            marker = L.marker([lat, lng]).addTo(map);
        });

        document.getElementById('btn-center-map').addEventListener('click', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude.toFixed(6);
                    const lng = position.coords.longitude.toFixed(6);
                    map.flyTo([lat, lng], 16, {
                    animate: true,
                    duration: 1.5
                });
                    if (marker) {
                        map.removeLayer(marker);
                    }
                    marker = L.marker([lat, lng]).addTo(map);
                    document.getElementById('latlong').value = `${lat},${lng}`;
                }, showError);
            } else {
                alert("Browser Anda tidak mendukung Geolocation.");
            }
        });
    });
</script>

        <style>
           #map {
        height: 300px;
        width: 100%;
        margin-bottom: 1rem;
        border: 1px solid #ccc;
        border-radius: 10px;
    }
            
        ::placeholder {
            font-style: italic;
            color: #cfd8e0ff;
            font-size: 0.8em;
        }

        #btn-center-map {
            display: inline-block;
        }
        </style>
        

        <div class="d-flex justify-content-between mt-3">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
</div>
</form>

@endsection