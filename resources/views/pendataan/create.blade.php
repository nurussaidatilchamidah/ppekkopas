
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 h2 class="mb-4">Tambah Data Pendataan</h2>
    <form action="{{ route('pendataan.store') }}" method="POST">
         @csrf

          <div class="row">
            <!-- Kolom kiri -->
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
                    'Bangilan','Kebonsari','Karanganyar','Trajeng','Mayangan','Panggungrejo','Mandaranrejo',
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
            <label for="kategori_usaha" class="form-label">Kategori Usaha<span class="text-danger fw-bold" style="font-size: 1.3em;">*</span></label>
            <select name="kategori_usaha" class="form-control" required>
                <option value="" disabled {{ old('kategori_usaha') ? '' : 'selected' }}>-- Pilih Kategori Usaha --</option>
                @foreach(['A. Pertanian, Kehutanan, dan Perikanan', 'B. Pertambangan dan Penggalian', 'C. Industri Pengolahan', 'D. Pengadaan Listrik, Gas, Uap/Air Panas dan Udara Dingin', 'E. Pengadaan Air, Pengelolaan Sampah, Limbah, dan Daur Ulang',
                'F. Konstruksi', 'G. Perdagangan Besar dan Eceran, Reparasi Mobil dan Sepeda Motor', 'H. Transportasi dan Pergudangan', 'I. Penyediaan Akomodasi dan Makan Minum',
                'J. Informasi dan Komunikasi','K. Jasa Keuangan dan Asuransi','L. Real Estat','M. Aktivitas Profesional, Ilmiah, dan Teknis','N. Aktivitas Penyewaan dan Sewa Guna Usaha tanpa Hak Opsi, Ketenagakerjaan, Agen Perjalanan dan Penunjang Usaha Lainnya',
                 'O. Administrasi Pemerintahan, Pertahanan, dan Jaminan Sosial Wajib','P. Jasa Pendidikan', 
                'Q. Jasa Kesehatan dan Kegiatan Sosial','R. Kesenian, Hiburan, dan Rekreasi', 'S. Aktivitas Jasa Lainnya'] as $item)
                <option value="{{ $item }}" {{ session('prefill_pendataan.kategori_usaha') == $item ? 'selected' : '' }}>{{ $item }}</option>
                @endforeach
            </select>
        </div>

    <div class="mb-3">
            <label for="jumlah">Jumlah Tenaga Kerja<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
            <input type="number" name="jumlah_tenaga_kerja" class="form-control" min="1" required Placeholder="Jumlah tenaga kerja wajib diisi Minimal 1">
        </div>
    </div>

    <!-- Kolom kanan -->
    <div class="col-md-6">
    <div class="mb-3">
         <label for="pendapatan"> Pendapatan/Omset per Tahun<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
        <input type="text" id="pendapatan" class="form-control" placeholder="Pendapatan per tahun minimal Rp.100.000">
        <input type="hidden" name="pendapatan_per_bulan" id="pendapatan_hidden">
    </div>

     <div class="mb-3">
         <label for="pengeluaran">Pengeluaran Operasional<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
        <input type="text" id="pengeluaran" class="form-control" required placeholder="Pengeluaran tidak boleh lebih besar dari pendapatan">
        <input type="hidden" name="pengeluaran_operasional" id="pengeluaran_hidden">
    </div>

    <div class="mb-3">
        <label for="nilai_aset_gedung_dan_kendaraan">Nilai Aset Gedung dan Kendaraan<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
        <input type="text" id="aset_gedung" class="form-control" required placeholder="Nilai aset gedung dan kendaraan minimal Rp.100.000">
        <input type="hidden" name="nilai_aset_gedung_dan_kendaraan" id="nilai_aset_gedung_kendaraan_hidden">
    </div>

    <div class="mb-3">
        <label for="nilai_aset_mesin_dan_alat_produksi_lain">Nilai Aset Mesin dan Alat Produksi Lain<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
        <input type="text" id="aset_mesin" class="form-control" required placeholder="Nilai aset mesin dan alat produksi lain minimal Rp.100.000">
        <input type="hidden" name="nilai_aset_mesin_dan_alat_produksi_lain" id="nilai_aset_mesin_alat_hidden">
    </div>

    <div class="mb-3">
        <label for="bentukusaha" class="form-label">Bentuk Badan Usaha<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
            <select name="izin_usaha" class="form-control" required>
                <option value="" disabled selected>-- Pilih Bentuk Badan Usaha --</option>
                @foreach(['Perseroan (PT/NV, PT Persero, PT Tbk, Pt Persero Tbk, Perseroan Daerah, Perseroan Perorangan','Yayasan',
                    'Koperasi','BUMKel','Persekutuan Komanditer (CV)','Persekutuan Firma','Usaha Orang/Perseorangan'] as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                @endforeach 
            </select>
    </div>
   
     <div class="mb-3">
         <label for="catatan">Catatan </label>
        <input type="longtext" name="catatan" class="form-control" placeholder="Catatan tidak wajib diisi (opsional)">
    </div>
</div>

  <div class="row">
            <div class="col-12 d-flex justify-content-between mt-4 px-3">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
</div>
    </form>
</div>


<script>
    function formatRupiah(angka) {
        let number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return split[1] != undefined ? 'Rp ' + rupiah + ',' + split[1] : 'Rp ' + rupiah;
    }

    // Pendapatan
    const pendapatanInput = document.getElementById('pendapatan');
    const pendapatanHidden = document.getElementById('pendapatan_hidden');
    pendapatanInput.addEventListener('keyup', function () {
        const unformatted = this.value.replace(/[^0-9]/g, '');
        pendapatanHidden.value = unformatted;
        this.value = formatRupiah(this.value);
    });

    // Pengeluaran
    const pengeluaranInput = document.getElementById('pengeluaran');
    const pengeluaranHidden = document.getElementById('pengeluaran_hidden');
    pengeluaranInput.addEventListener('keyup', function () {
        const unformatted = this.value.replace(/[^0-9]/g, '');
        pengeluaranHidden.value = unformatted;
        this.value = formatRupiah(this.value);
    });

    // Aset gedung
    const asetGedungInput = document.getElementById('aset_gedung');
    const asetGedungHidden = document.getElementById('nilai_aset_gedung_kendaraan_hidden');
    asetGedungInput.addEventListener('keyup', function () {
        const unformatted = this.value.replace(/[^0-9]/g, '');
        asetGedungHidden.value = unformatted;
        this.value = formatRupiah(this.value);
    });

    // Aset mesin
    const asetMesinInput = document.getElementById('aset_mesin');
    const asetMesinHidden = document.getElementById('nilai_aset_mesin_alat_hidden');
    asetMesinInput.addEventListener('keyup', function () {
        const unformatted = this.value.replace(/[^0-9]/g, '');
        asetMesinHidden.value = unformatted;
        this.value = formatRupiah(this.value);
    });

    document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('form').addEventListener('submit', function(e) {
        let errors = [];

        // Validasi SELECT
        const kelurahan = document.querySelector('select[name="kelurahan"]');
        const rw = document.querySelector('select[name="rw"]');
        const rt = document.querySelector('select[name="rt"]');
        const kategoriUsaha = document.querySelector('select[name="kategori_usaha"]');

        if (!kelurahan.value) errors.push("Kelurahan wajib dipilih.");
        if (!rw.value) errors.push("RW wajib dipilih.");
        if (!rt.value) errors.push("RT wajib dipilih.");
        if (!kategoriUsaha.value) errors.push("Kategori usaha wajib dipilih.");

        // Validasi INPUT
        const namaUsaha = document.querySelector('input[name="nama_usaha"]');
        if (!namaUsaha.value.trim()) errors.push("Nama usaha wajib diisi.");

        const jumlahTenagaKerja = document.querySelector('input[name="jumlah_tenaga_kerja"]');
        if (!jumlahTenagaKerja.value || parseInt(jumlahTenagaKerja.value) < 1)
            errors.push("Jumlah tenaga kerja minimal 1.");

        const pendapatan = document.getElementById('pendapatan_hidden').value;
        if (!pendapatan || parseInt(pendapatan) < 100100)
            errors.push("Pendapatan per bulan minimal Rp.100.000.");

        const pengeluaran = document.getElementById('pengeluaran_hidden').value;
        if (!pengeluaran || parseInt(pengeluaran) > parseInt(pendapatan))
            errors.push("Pengeluaran tidak boleh lebih besar dari pendapatan.");

        const asetGedung = document.getElementById('nilai_aset_gedung_kendaraan_hidden').value;
        if (!asetGedung || parseInt(asetGedung) <= 0)
            errors.push("Nilai aset gedung dan kendaraan wajib diisi.");

        const asetMesin = document.getElementById('nilai_aset_mesin_alat_hidden').value;
        if (!asetMesin || parseInt(asetMesin) <= 0)
            errors.push("Nilai aset mesin dan alat produksi wajib diisi.");

        // Tampilkan semua error
        if (errors.length > 0) {
            e.preventDefault();
            alert(errors.join('\n'));
        }
    });
});
</script>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        

<style>
    ::placeholder {
        font-style: italic;
        color: #cfd8e0ff;
        font-size: 0.8em;
    }
</style>
@endsection
