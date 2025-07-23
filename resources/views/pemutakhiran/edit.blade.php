@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Edit Data Pemutakhiran</h2>
    <form action="{{ route('pemutakhiran.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="kelurahan" class="form-label">Kelurahan<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
                    <select name="kelurahan" class="form-control" required>
                        <option value="">-- Pilih Kelurahan --</option>
                        @foreach([
                            'Krapyakrejo','Bukir','Sebani','Gentong','Gadingrejo','Randusari',
                            'Petahunan','Karangketug','Pohjentrek','Wirogunan','Tembokrejo','Purutrejo',
                            'Kebonagung','Purworejo','Sekargadung','Blandongan','Bakalan','Krampyangan',
                            'Bungulkidul','Kepel','Tapaan','Pekucen','Pertamanan','Bungullor','Kandangsapi',
                            'Bangilan','Kebonsari','Karanganyar','Trajeng','Mayangan','Panggungrejo','Madaranrejo',
                            'Ngemplakrejo','Tambaan'
                        ] as $item)
                            <option value="{{ $item }}" {{ $data->kelurahan == $item ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="rw" class="form-label">RW<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
                    <select name="rw" class="form-control" required>
                        <option value="">-- Pilih RW --</option>
                        @foreach(['001', '002', '003', '004', '005', '006', '007', '008', '009', '010','011','012'] as $item)
                            <option value="{{ $item }}" {{ $data->rw == $item ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="rt" class="form-label">RT<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
                    <select name="rt" class="form-control" required>
                        <option value="">-- Pilih RT --</option>
                        @foreach(['001', '002', '003', '004', '005', '006', '007', '008', '009', '010',
                            '011','012','013','014','015','016','017','018','019','020'] as $item)
                            <option value="{{ $item }}" {{ $data->rt == $item ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nama_usaha" class="form-label">Nama Usaha<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
                    <input type="text" name="nama_usaha" class="form-control" value="{{ $data->nama_usaha }}" required>
                </div>

                <div class="mb-3">
                    <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
                    <input type="text" name="nama_pemilik" class="form-control" value="{{ $data->nama_pemilik }}" required>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="alamat_usaha" class="form-label">Alamat Usaha</label>
                    <input type="text" name="alamat_usaha" class="form-control" value="{{ $data->alamat_usaha }}" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi_usaha" class="form-label">Deskripsi Usaha<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
                    <input type="text" name="deskripsi_usaha" class="form-control" value="{{ $data->deskripsi_usaha }}" required>
                </div>

                <div class="mb-3">
                    <label for="kategori_usaha" class="form-label">Kategori Usaha<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
                    <select name="kategori_usaha" class="form-control" required>
                        <option value="">-- Pilih Kategori Usaha --</option>
                        @foreach([
                            'Pertanian, Kehutanan, dan Perikanan', 'Pertambangan dan Penggalian', 'Industri Pengolahan',
                            'Pengadaan Listrik dan Gas', 'Pengadaan Air; Pengelolaan Sampah, Limbah, dan Daur Ulang',
                            'Konstruksi', 'Perdagangan Besar dan Eceran, Reparasi Mobil dan Sepeda Motor',
                            'Transportasi dan Pergudangan/Transportation and Storage', 'Penyediaan Akomodasi dan Makan Minum',
                            'Informasi dan Komunikasi','Jasa Keuangan dan Asuransi','Real Estate','Jasa Perusahaan',
                            'Administrasi Pemerintahan, Pertahanan, dan Jaminan Sosial Wajib','Jasa Pendidikan',
                            'Jasa Kesehatan dan Kegiatan Sosial','Jasa Lainnya'
                        ] as $item)
                            <option value="{{ $item }}" {{ $data->kategori_usaha == $item ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <input type="text" name="catatan" class="form-control" value="{{ $data->catatan }}">
                </div>

                <div class="mb-3">
                    <label for="latlong">Edit Koordinat<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
                    <div class="input-group">
                        <input type="text" id="latlong" name="latlong" class="form-control"
                            value="{{ old('latlong', $data->latitude . ',' . $data->longitude) }}" readonly required>
                        <button type="button" class="btn btn-primary" onclick="getLocation()">Koordinat Baru</button>
                    </div>
                    <small class="text-muted">Klik tombol untuk mengambil koordinat baru dari lokasi saat ini.</small>
                </div>
            </div>
        </div>

        <!-- MAP -->
        <div class="row">
            <div class="col-12">
                <div id="map" class="my-3"></div>
            </div>
        </div>

        <!-- BUTTONS -->
        <div class="row">
            <div class="col-12 d-flex justify-content-between mt-4 px-3">
                <a href="{{ route('pemutakhiran.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </div>
    </form>
</div>

<!-- Leaflet MAP -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
    #map {
        height: 300px;
        width: 100%;
    }
</style>

@php
    $defaultLat = old('latlong') ? explode(',', old('latlong'))[0] : $data->latitude;
    $defaultLng = old('latlong') ? explode(',', old('latlong'))[1] : $data->longitude;
@endphp

<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            alert("Browser Anda tidak mendukung Geolocation.");
        }
    }

    function showPosition(position) {
        const lat = position.coords.latitude;
        const long = position.coords.longitude;
        document.getElementById("latlong").value = `${lat},${long}`;
    }

    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED: alert("User menolak permintaan geolocation."); break;
            case error.POSITION_UNAVAILABLE: alert("Informasi lokasi tidak tersedia."); break;
            case error.TIMEOUT: alert("Permintaan lokasi melebihi batas waktu."); break;
            default: alert("Terjadi kesalahan yang tidak diketahui."); break;
        }
    }

    var map = L.map('map').setView([{{ $defaultLat }}, {{ $defaultLng }}], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var marker = L.marker([{{ $defaultLat }}, {{ $defaultLng }}]).addTo(map);

    map.on('click', function(e) {
        var lat = e.latlng.lat.toFixed(6);
        var lng = e.latlng.lng.toFixed(6);
        document.getElementById('latlong').value = lat + ',' + lng;

        if (marker) {
            map.removeLayer(marker);
        }

        marker = L.marker([lat, lng]).addTo(map);
    });
</script>
@endsection
