@extends('layouts.app')

@section('content')
<h2 class="mb-2 text-center fw-bold mt-5" style="font-size: 2.2rem;">
    Selamat Datang di Aplikasi Pendataan Potensi Ekonomi Kelurahan
</h2>


<div class="row">
<div class="d-flex align-items-center justify-content-center" style="min-height: 70vh;">

        <div class="card">
             <div class="card-header card-header-bps">
                <h5 class="card-title mb-0">
                    <i class="fas fa-sync-alt"></i> Pemutakhiran Data
                </h5>
        </div>
        <div class="card-body">
                <p class="card-text" style="font-size: 1.2rem;">Kelola Data Pemutakhiran</p>
                </a>
                <a href="{{ route('pemutakhiran.create') }}" class="btn btn-bps-warning w-100">
                    <i class="fas fa-plus"></i> Tambah Data Baru
                </a>
        </div>
    </div>

        <div class="card">
            <div class="card-header card-header-bps">
                <h5 class="card-title mb-0">
                    <i class="fas fa-database"></i> Pendataan Usaha
                </h5>
            </div>
            <div class="card-body">
                <p class="card-text" style="font-size: 1.2rem;">Kelola Data Pendataan Baru</p>
                </a>
                <a href="{{ route('pendataan.create') }}" class="btn btn-bps-warning w-100">
                    <i class="fas fa-plus"></i> Tambah Data Baru
                </a>


            </div>
        </div>
    </div>
</div>

@endsection