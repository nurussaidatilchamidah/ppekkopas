@extends('layouts.app')

@section('content')

@php
    $perPage = $perPage ?? (is_object($data) && method_exists($data, 'perPage') ? $data->perPage() : 'all');
    $isPaginated = $isPaginated ?? (is_object($data) && method_exists($data, 'links'));
@endphp


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

    .filter {
        border: 3px solid #ccc;
        border-radius: 8px;
        padding: 4px 10px;
        font-size: 15px;
        height: 36px;
        flex: 1;
        max-width: 1000px;
    }

    .pagination {
        height: 40px; /* sama seperti btn dan select default */
        display: flex;
        align-items: center;
    }

    .pagination-wrapper {
            flex: 1;
    }

    .page-item .page-link {
    padding: 0.375rem 0.75rem; /* sesuaikan dengan tombol bootstrap */
    font-size: 0.9rem;
    border-radius: 0.375rem;
}
</style>

<div class="container mt-5">
    <h2 class="mb-4 fw-bold">Data Pemutakhiran Usaha</h2>
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-2 gap-2">
        <div>
            <a href="{{ route('pemutakhiran.create') }}" class="btn btn-primary" style="margin-left:-1px;">Tambah Data</a>
            <a href="{{ url('/pemutakhiran/export') }}" class="btn btn-success">Export Data</a>
        </div>

    @if(session('success'))
    @endif

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

    <form method="GET" action="{{ route('pemutakhiran.index') }}" class="mb-3 d-flex gap-2">
        {{-- Filter Kelurahan --}}
        <select name="kelurahan" class="form-control filter">
            <option value="">Kelurahan</option>
            @foreach($allowedKelurahan as $kel)
                <option value="{{ $kel }}" {{ request('kelurahan') == $kel ? 'selected' : '' }}>
                    {{ $kel }}
                </option>
            @endforeach
        </select>

        {{-- Filter Kategori Usaha --}}
        <select name="kategori_usaha" class="form-control filter">
            <option value="">Kategori Usaha</option>
            @foreach($allowedKategori as $kat)
                <option value="{{ $kat }}" {{ request('kategori_usaha') == $kat ? 'selected' : '' }}>
                    {{ $kat }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('pemutakhiran.index') }}" class="btn btn-secondary">
            Reset 
        </a>
    </form>
</div>


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
                <td class="text-center">
                    @if($isPaginated)
                        {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                    @else
                        {{ $loop->iteration }}
                    @endif
                </td>
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

@php
    if ($isPaginated) {
        $from = ($data->currentPage() - 1) * $data->perPage() + 1;
        $to = min($data->currentPage() * $data->perPage(), $data->total());
        $total = $data->total();
    } else {
        $from = $data->count() ? 1 : 0;
        $to = $data->count();
        $total = $data->count();
    }
@endphp

<div class="d-flex align-items-center mt-2 w-100">
    <!-- kiri: dropdown per page -->
    <div>
        <form action="{{ route('pemutakhiran.index') }}" method="GET" class="d-flex align-items-center">
            <label for="per_page" class="me-2 mb-0 fw-bold fs-17px">Tampilkan</label>
            <select name="per_page" id="per_page" class="form-select me-2" onchange="this.form.submit()" style="max-width: 200px;">
                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                <option value="all" {{ $perPage === 'all' ? 'selected' : '' }}>Semua</option>
            </select>
            <input type="hidden" name="search" value="{{ request('search') }}">
        </form>
    </div>

    <!-- tengah: pagination -->
    <div class="flex-grow-1 d-flex flex-column align-items-center" style="padding-top: 16px;">
        @if ($isPaginated)
            {{ $data->withQueryString()->links() }}
        @endif
        <div style="font-size: 0.9rem; text-align: center">
            Menampilkan {{ $from }} sampai {{ $to }} dari {{ $total }} hasil
        </div>
    </div>

    <!-- kanan: tombol kembali -->
    <div class="ms-auto">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@endsection
