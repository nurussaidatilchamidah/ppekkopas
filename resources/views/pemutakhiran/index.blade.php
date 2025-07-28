@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 fw-bold">Data Pemutakhiran Usaha</h2>
   <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <a href="{{ route('pemutakhiran.create') }}" class="btn btn-primary">Tambah Data</a>
        <a href="{{ url('/pemutakhiran/export') }}" class="btn btn-success">Export Data</a>
    </div>

    @if(session('success'))
    @endif

    
<style>
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
        padding: 2px 14px;
        font-size: 17px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<!-- search -->
<form action="{{ route('pemutakhiran.index') }}" method="GET" class="d-flex flex-grow-1 justify-content-end" role="search" style="max-width: 100%;">
        <input 
            type="text" 
            name="search" 
            class="form-control custom-search-input" 
            placeholder="Cari berdasarkan kelurahan, nama usaha atau kategori usaha....."             value="{{ request('search') }}"
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
                <th>Nama Pemilik</th>
                <th>Alamat Usaha</th>
                <th>Deskripsi Usaha</th>
                <th>Kategori Usaha</th>
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
                <td>{{ $item->nama_pemilik }}</td>
                <td>{{ $item->alamat_usaha }}</td>
                <td>{{ $item->deskripsi_usaha }}</td>
                <td>{{ $item->kategori_usaha }}</td>
                <td>{{ $item->catatan }}</td>
                <td>{{ $item->latitude }}, {{ $item->longitude }}</td> 
                <td>
                    <a href="{{ route('pemutakhiran.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('pemutakhiran.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('pemutakhiran.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
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
@endsection
