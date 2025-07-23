@extends('layouts.app')

@section('content')
<h2 class="mb-5 text-center fw-bold mt-5" style="font-size: 2.2rem;">
    Selamat Datang di Aplikasi Pendataan Potensi Ekonomi Kelurahan
</h2>

<div class="d-flex flex-column align-items-center justify-content-start px-0">

    <!-- Card Pemutakhiran Data -->
    <div class="card mb-4" style="width: 95vw;">
        <div class="card-header card-header-bps">
            <h5 class="card-title mb-0">
              Pemutakhiran Usaha
            </h5>
        </div>
        <div class="card-body">
             <p class="card-text mb-2" style="font-size: 0.9rem;">
                 <i class="fas fa-sync-alt me-2 fs-5"></i>     
                     Kelola Data Pemutakhiran
            </p>  
            <a href="{{ route('pemutakhiran.create') }}" class="btn btn-bps-warning w-100">
                <i class="fas fa-plus"></i> Tambah Data Baru
            </a>
        </div>
    </div>

    <!-- Card Pendataan Usaha -->
    <div class="card" style="width: 95vw;">
        <div class="card-header card-header-bps">
            <h5 class="card-title mb-0">
              Pendataan Usaha
            </h5>
        </div>
        <div class="card-body">
  		<p class="card-text mb-2" style="font-size: 0.9rem;">
                 <i class="fas fa-database me-2 fs-5"></i>     
                     Kelola Data Pendataan
            </p>            <a href="{{ route('pendataan.create') }}" class="btn btn-bps-warning w-100">
                <i class="fas fa-plus"></i> Tambah Data Baru
            </a>
        </div>
    </div>

</div>
@endsection
