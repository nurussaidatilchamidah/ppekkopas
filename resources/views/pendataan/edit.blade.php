@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Edit Data Pendataan</h2>

    <form action="{{ route('pendataan.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Kolom kiri -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="kelurahan" class="form-label">Kelurahan<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
                    <select name="kelurahan" class="form-control" required>
                        <option value="">-- Pilih Kelurahan --</option>
                        @foreach(['Krapyakrejo','Bukir','Sebani','Gentong','Gadingrejo','Randusari','Petahunan','Karangketug','Pohjentrek','Wirogunan','Tembokrejo','Purutrejo','Kebonagung','Purworejo','Sekargadung','Blandongan','Bakalan','Krampyangan','Bungulkidul','Kepel','Tapaan','Pekucen','Pertamanan','Bungullor','Kandangsapi','Bangilan','Kebonsari','Karanganyar','Trajeng','Mayangan','Panggungrejo','Madaranrejo','Ngemplakrejo','Tambaan'] as $item)
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
                        @foreach(['001','002','003','004','005','006','007','008','009','010','011','012','013','014','015','016','017','018','019','020'] as $item)
                            <option value="{{ $item }}" {{ $data->rt == $item ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nama_usaha" class="form-label">Nama Usaha<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
                    <input type="text" name="nama_usaha" class="form-control" value="{{ old('nama_usaha', $data->nama_usaha) }}" required>
                </div>

                <div class="mb-3">
                    <label for="kategori_usaha" class="form-label">Kategori Usaha<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
                    <select name="kategori_usaha" class="form-control" required>
                        <option value="">-- Pilih Kategori Usaha --</option>
                        @foreach(['A. Pertanian, Kehutanan, dan Perikanan', 'B. Pertambangan dan Penggalian', 'C. Industri Pengolahan', 'D. Pengadaan Listrik, Gas, Uap/Air Panas dan Udara Dingin', 'E. Pengadaan Air, Pengelolaan Sampah, Limbah, dan Daur Ulang',
                        'F. Konstruksi', 'G. Perdagangan Besar dan Eceran, Reparasi Mobil dan Sepeda Motor', 'H. Transportasi dan Pergudangan', 'I. Penyediaan Akomodasi dan Makan Minum',
                        'J. Informasi dan Komunikasi','K. Jasa Keuangan dan Asuransi','L. Real Estat','M. Aktivitas Profesional, Ilmiah, dan Teknis','N. Aktivitas Penyewaan dan Sewa Guna Usaha tanpa Hak Opsi, Ketenagakerjaan, Agen Perjalanan dan Penunjang Usaha Lainnya',
                        'O. Administrasi Pemerintahan, Pertahanan, dan Jaminan Sosial Wajib','P. Jasa Pendidikan', 
                        'Q. Jasa Kesehatan dan Kegiatan Sosial','R. Kesenian, Hiburan, dan Rekreasi', 'S. Aktivitas Jasa Lainnya'] as $item)
                            <option value="{{ $item }}" {{ $data->kategori_usaha == $item ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jumlah_tenaga_kerja" class="form-label">Jumlah Tenaga Kerja<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
                    <input type="number" name="jumlah_tenaga_kerja" class="form-control" value="{{ old('jumlah_tenaga_kerja', $data->jumlah_tenaga_kerja) }}" required>
                </div>
            </div>

            <!-- Kolom kanan -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="pendapatan" class="form-label">Pendapatan/Tahun<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
                    <input type="text" id="pendapatan" class="form-control" value="{{ old('pendapatan_per_bulan', $data->pendapatan_per_bulan) }}" required>
                    <input type="hidden" name="pendapatan_per_bulan" id="pendapatan_hidden">
                </div>

                <div class="mb-3">
                    <label for="pengeluaran" class="form-label">Pengeluaran Operasional<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
                    <input type="text" id="pengeluaran" class="form-control" value="{{ old('pengeluaran_operasional', $data->pengeluaran_operasional) }}" required>
                    <input type="hidden" name="pengeluaran_operasional" id="pengeluaran_hidden">
                </div>

                <div class="mb-3">
                    <label for="nilai_aset_gedung_dan_kendaraan" class="form-label">Aset Gedung & Kendaraan<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
                    <input type="text" id="aset_gedung" class="form-control" value="{{ number_format(old('nilai_aset_gedung_dan_kendaraan', $data->nilai_aset_gedung_dan_kendaraan), 0, ',', '.') }}" required>
                    <input type="hidden" name="nilai_aset_gedung_dan_kendaraan" id="nilai_aset_gedung_kendaraan_hidden">
                </div>

                <div class="mb-3">
                    <label for="nilai_aset_mesin_dan_alat_produksi_lain" class="form-label">Aset Mesin & Produksi<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
                    <input type="text" id="aset_mesin" class="form-control" value="{{ number_format(old('nilai_aset_mesin_dan_alat_produksi_lain', $data->nilai_aset_mesin_dan_alat_produksi_lain), 0, ',', '.') }}" required>
                    <input type="hidden" name="nilai_aset_mesin_dan_alat_produksi_lain" id="nilai_aset_mesin_alat_hidden">
                </div>

        <div class="mb-3">
            <label for="bentukusaha" class="form-label">Bentuk Badan Usaha<span class="text-danger" fw-bold style="font-size: 1.3em;">*</span></label>
            <select name="izin_usaha" class="form-control" required>
                <option value="" disabled selected>-- Pilih Bentuk Badan Usaha --</option>
                @foreach(['Perseroan (PT/NV, PT Persero, PT Tbk, Pt Persero Tbk, Perseroan Daerah, Perseroan Perorangan','Yayasan',
                    'Koperasi','BUMKel','Persekutuan Komanditer (CV)','Persekutuan Firma','Usaha Orang/Perseorangan'] as $item)
                    <option value="{{ $item }}" {{ (old('izin_usaha', $data->izin_usaha ?? '') == $item) ? 'selected' : '' }}>
                        {{ $item }}
                    </option>
                @endforeach 
            </select>
        </div>

                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea name="catatan" class="form-control">{{ old('catatan', $data->catatan) }}</textarea>
                </div>
    </div>

        <!-- BUTTONS -->
        <div class="row">
            <div class="col-12 d-flex justify-content-between mt-4 px-3">
                <a href="{{ route('pendataan.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </div>
    </form>
</div>

<script>
    function formatRupiah(angka) {
        return angka.replace(/[^,\d]/g, '').toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function unformatRupiah(angka) {
        return angka.replace(/\./g, '');
    }

    document.addEventListener("DOMContentLoaded", function () {
        const fields = [
            { textId: 'pendapatan', hiddenId: 'pendapatan_hidden' },
            { textId: 'pengeluaran', hiddenId: 'pengeluaran_hidden' },
            { textId: 'aset_gedung', hiddenId: 'nilai_aset_gedung_kendaraan_hidden' },
            { textId: 'aset_mesin', hiddenId: 'nilai_aset_mesin_alat_hidden' }
        ];

        fields.forEach(field => {
            const textInput = document.getElementById(field.textId);
            const hiddenInput = document.getElementById(field.hiddenId);

            if (textInput && hiddenInput) {
                textInput.value = formatRupiah(textInput.value);
                hiddenInput.value = unformatRupiah(textInput.value);

                textInput.addEventListener('input', () => {
                    textInput.value = formatRupiah(textInput.value);
                    hiddenInput.value = unformatRupiah(textInput.value);
                });
            }
        });
    });
</script>
@endsection
