
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 fw-bold">Data Pendataan Usaha</h2>
       <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
<div>
    <a href="{{ route('pendataan.create') }}" class="btn btn-primary">Tambah Data</a>
    <a href="{{ url('/pendataan/export') }}" class="btn btn-success">Export Data</a>
</div>
   
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
        font-size: 16px; 
        padding: 12px; 
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
        font-size: 16px; 
        margin-left: 10px;
    }

     .custom-search-input {
        border: 3px solid #ccc;
        border-radius: 8px;
        flex: 1;
        min-width: 300px;
        max-width: 100%;
        padding: 4px 10px;
        font-size: 15px;
        height: 36px;
    }

    .custom-search-input:focus {
        border-color: #f0ad4e;
        box-shadow: 0 0 0 0.2rem rgba(240, 173, 78, 0.25);
    }

    .search-container {
        flex: 1;
        max-width: 100%;
        display: flex;
        justify-content: flex-end;
        gap: 2px;
    }

    .btn-warning {
        background-color: #f0ad4e;
        border-color: #eea236;
    }

    .btn-warning:hover {
        background-color: #ec971f;
        border-color: #d58512;
    }

</style>

<!-- search -->
<form action="{{ route('pendataan.index') }}" method="GET" class="d-flex flex-grow-1 justify-content-end" role="search" style="max-width: 100%;">
        <input 
            type="text" 
            name="search" 
            class="form-control custom-search-input" 
placeholder="Cari berdasarkan kelurahan, nama usaha atau kategori usaha....."             
value="{{ request('search') }}"
            style="min-width: 300px;">
        <button class="btn btn-warning text-white" type="submit" title="Cari">
            <i class="fas fa-search"></i>
        </button>
    </form>
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
                <th>Bentuk Usaha</th>
                <th>Catatan</th>
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

<!-- pagination -->
    <div class="d-flex justify-content-center">
        {{ $data->withQueryString()->links() }}
    </div>
 
</div>
<!-- kembali -->
     <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
     </div>
@endsection
