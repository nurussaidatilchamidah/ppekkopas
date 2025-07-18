
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 fw-bold">Data Pendataan Usaha</h2>
    <a href="{{ route('pendataan.create') }}" class="btn btn-primary mb-4">Tambah Data</a>

    @if(session('success'))
    @endif


<style>
    .title-text {
        font-size: 26px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .table th, .table td {
        white-space: nowrap;
        font-size: 16px; /* Lebih besar dari sebelumnya (12px) */
        padding: 12px; /* Tambahan padding agar tidak terlalu rapat */
        vertical-align: middle;
    }

    .table-wrapper {
        overflow-x: auto;
        width: 100%;
    }

    .container {
        max-width: 95%;
        margin: 0 auto;
    }

    .btn {
        font-size: 16px; /* Ukuran tombol */
    }
</style>

  <div class="table-wrapper">
        <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Kelurahan</th>
                <th>RW</th>
                <th>RT</th>
                <th>Nama Usaha</th>
                <th>Kategori Usaha</th>
                <th>Jumlah Tenaga Kerja</th>
                <th>Pendapatan</th>
                <th>Pengeluaran</th>
                <th>Nilai Aset Gedung</th>
                <th>Nilai Aset Mesin</th>
                <th>Izin Usaha</th>
                <th>Catatan</th>
                <th>Koordinat (Lat,Long)</th> 
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kelurahan }}</td>
                <td>{{ $item->rw }}</td>
                <td>{{ $item->rt }}</td>
                <td>{{ $item->nama_usaha }}</td>
                <td>{{ $item->kategori_usaha }}</td>
                <td>{{ $item->jumlah_tenaga_kerja }}</td>
                <td>Rp {{ number_format($item->pendapatan_per_bulan, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($item->pengeluaran_operasional, 0, ',', '.') }}</td>
                <td>{{ number_format($item->nilai_aset_gedung_dan_kendaraan, 0, ',', '.') }}</td>
                <td>{{ number_format($item->nilai_aset_mesin_dan_alat_produksi_lain, 0, ',', '.') }}</td>
                <td>{{ $item->izin_usaha }}</td>
                <td>{{ $item->catatan }}</td>
                <td>{{ $item->latitude }}, {{ $item->longitude }}</td> <!-- Gabungkan di sini -->
                <td>
                    <a href="{{ route('pendataan.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('pendataan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('pendataan.destroy', $item->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
