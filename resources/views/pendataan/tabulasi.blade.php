@extends('layouts.app')

@section('content')
<style>
    h4 {
        font-size: 1.1rem;
    }

    /* hanya header tabel */
    .table thead th {
        font-size: 0.9rem;
        vertical-align: middle;
        border-bottom: 1px solid black !important;
    }

    /* isi tabel */
    .table tbody td {
        font-size: 0.9rem;
        vertical-align: middle;
    }
    
    .filter-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
        max-width: 450px;
    }

    .filter-wrapper select {
        border: 2px solid #ccc;
        border-radius: 8px;
        padding: 4px 10px;
        font-size: 15px;
        height: 38px;
        flex: 1;
    }
</style>

<div class="container my-5">
    <h2 class="mb-5 text-center fw-bold mt-5" style="font-size: 1.8rem; font-family: Arial, sans-serif; font-style: italic;">Tabulasi Pendataan</h2>

    <!-- Filter -->
    <form method="GET" class="mb-4">
        <div class="filter-wrapper">
            <select name="kelurahan" class="form-select" onchange="this.form.submit()">
                <option value="Gentong" {{ $kelurahan=='Gentong'?'selected':'' }}>Gentong</option>
                <option value="Mandaranrejo" {{ $kelurahan=='Mandaranrejo'?'selected':'' }}>Mandaranrejo</option>
                <option value="Pohjentrek" {{ $kelurahan=='Pohjentrek'?'selected':'' }}>Pohjentrek</option>
                <option value="Randusari" {{ $kelurahan=='Randusari'?'selected':'' }}>Randusari</option>
            </select>

            <a href="{{ route('pendataan.tabulasi') }}" class="btn btn-secondary">
                Reset
            </a>
        </div>
    </form>
    
    <!-- Rekap 1 -->
    <div class="mb-4">
        <h4 class="fw-bold pb-2 mb-4" style="color: #121213ff; border-bottom: 3px solid black;">
            Jumlah Usaha Menurut Kategori
        </h4>
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead>
                <tr><th>Kategori</th><th>Usaha (Unit)</th></tr>
            </thead>
            <tbody>
                @foreach($tabel['kategori'] as $row)
                <tr>
                    <td>{{ $row['kategori'] }}</td>
                    <td>{{ $row['jumlah'] }}</td>
                </tr>
                @endforeach
                <tr class="fw-bold table-light">
                    <td>Total</td>
                    <td>{{ array_sum(array_column($tabel['kategori'], 'jumlah')) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Rekap 2 -->
    <div class="mb-4">
        <h4 class="fw-bold pb-2 mb-4 mt-5" style="color: #121213ff; border-bottom: 3px solid black;">
            Jumlah dan Persentase Usaha Menurut Skala Usaha / Jumlah Pekerja
        </h4>
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead>
                <tr><th>Skala Usaha</th><th>Jumlah (Unit)</th><th>Persentase</th></tr>
            </thead>
            <tbody>
                @foreach($tabel['skalaPekerja'] as $row)
                <tr>
                    <td>{{ $row['skala'] }}</td>
                    <td>{{ $row['jumlah'] }}</td>
                    <td>{{ $row['persentase'] }}%</td>
                </tr>
                @endforeach
                <tr class="fw-bold table-light">
                    <td>Total</td>
                    <td>{{ array_sum(array_column($tabel['skalaPekerja'], 'jumlah')) }}</td>
                    <td>100%</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Rekap 3 -->
    <div class="mb-4">
        <h4 class="fw-bold pb-2 mb-4 mt-5" style="color: #121213ff; border-bottom: 3px solid black;">
            Jumlah dan Persentase Usaha Menurut Skala Usaha / Nilai Aset        
        </h4>
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead>
                <tr><th>Skala Usaha</th><th>Jumlah (Unit)</th><th>Persentase</th></tr>
            </thead>
            <tbody>
                @foreach($tabel['skalaAset'] as $row)
                <tr>
                    <td>{{ $row['skala'] }}</td>
                    <td>{{ $row['jumlah'] }}</td>
                    <td>{{ $row['persentase'] }}%</td>
                </tr>
                @endforeach
                <tr class="fw-bold table-light">
                    <td>Total</td>
                    <td>{{ array_sum(array_column($tabel['skalaAset'], 'jumlah')) }}</td>
                    <td>100%</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Rekap 4 -->
    <div class="mb-4">
        <h4 class="fw-bold pb-2 mb-4 mt-5" style="color: #121213ff; border-bottom: 3px solid black;">
            Rata-Rata Nilai Aset Menurut Jenisnya        
        </h4>
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead>
                <tr><th>Jenis Aset</th><th>Nilai (Rupiah)</th><th>Persentase</th></tr>
            </thead>
            <tbody>
                @foreach($tabel['jenisAset'] as $row)
                <tr>
                    <td>{{ $row['jenis'] }}</td>
                    <td>{{ number_format($row['nilai'],0,',','.') }}</td>
                    <td>{{ $row['persentase'] }}%</td>
                </tr>
                @endforeach
                <tr class="fw-bold table-light">
                    <td>Total</td>
                    <td>{{ number_format(array_sum(array_column($tabel['jenisAset'], 'nilai')),0,',','.') }}</td>
                    <td>100%</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Rekap 5 -->
    <div class="mb-4">
        <h4 class="fw-bold pb-2 mb-4 mt-5" style="color: #121213ff; border-bottom: 3px solid black;">
            Jumlah Persentase Usaha Menurut Badan Usaha
        </h4>
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead>
                <tr><th>Badan Usaha</th><th>Jumlah (Unit)</th><th>Persentase</th></tr>
            </thead>
            <tbody>
                @foreach($tabel['badanUsaha'] as $row)
                <tr>
                    <td>{{ $row['badan'] }}</td>
                    <td>{{ $row['jumlah'] }}</td>
                    <td>{{ $row['persentase'] }}%</td>
                </tr>
                @endforeach
                <tr class="fw-bold table-light">
                    <td>Total</td>
                    <td>{{ array_sum(array_column($tabel['badanUsaha'], 'jumlah')) }}</td>
                    <td>100%</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Rekap 6 -->
    <div class="mb-4">
        <h4 class="fw-bold pb-2 mb-4 mt-5" style="color: #121213ff; border-bottom: 3px solid black;">
            Nilai NTB Menurut Kategori Usaha
        </h4>
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead>
                <tr><th>Kategori</th><th>NTB (Rupiah)</th></tr>
            </thead>
            <tbody>
                @foreach($tabel['ntbKategori'] as $row)
                <tr>
                    <td>{{ $row['kategori'] }}</td>
                    <td>{{ number_format($row['ntb'],0,',','.') }}</td>
                </tr>
                @endforeach
                <tr class="fw-bold table-light">
                    <td>Total</td>
                    <td>{{ number_format(array_sum(array_column($tabel['ntbKategori'], 'ntb')),0,',','.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end mt-3">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
    </div>

</div>
@endsection
