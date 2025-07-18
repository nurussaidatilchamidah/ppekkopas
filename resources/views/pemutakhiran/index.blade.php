@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 fw-bold">Data Pemutakhiran Usaha</h2>
    <a href="{{ route('pemutakhiran.create') }}" class="btn btn-primary mb-4">Tambah Data</a>

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
                <td>{{ $loop->iteration }}</td> {{-- Aman, pakai fitur bawaan Blade --}}
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
</div>
@endsection
