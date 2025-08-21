<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    public function index()
    {

        $allowedKelurahan = ['Randusari', 'Gentong', 'Pohjentrek', 'Mandaranrejo'];
        // Inisialisasi semua kelurahan dengan nilai 0
        $kelurahanData = array_fill_keys($allowedKelurahan, 0);

        $kelurahanFilter = ['Randusari', 'Gentong', 'Pohjentrek', 'Mandaranrejo'];
        $dataKelurahan = collect($kelurahanFilter);
        
        // Total usaha per kelurahan (untuk bar chart)
        $rekapPerKelurahan = DB::table('pendataan_usaha')
            ->select('kelurahan', DB::raw('COUNT(*) as total'))
            ->whereIn('kelurahan', $kelurahanFilter)
            ->groupBy('kelurahan')
            ->orderBy('kelurahan')
            ->get()
            ->toArray();

        // Rekap per kategori per kelurahan (untuk 4 pie)
        $rekapKategoriRaw = DB::table('pendataan_usaha')
            ->select('kelurahan', 'kategori_usaha', DB::raw('COUNT(*) as total'))
            ->whereIn('kelurahan', $kelurahanFilter)
            ->groupBy('kelurahan', 'kategori_usaha')
            ->get();

        // Kelompokkan: kelurahan => [ {kategori_usaha, total}, ... ]
        $rekapKategori = $rekapKategoriRaw
            ->groupBy('kelurahan')
            ->map(fn($rows) => $rows->values())
            ->toArray();

        // Data lokasi untuk peta
        $lokasiUsaha = DB::table('pendataan_usaha')
            ->select('nama_usaha', 'kategori_usaha', 'kelurahan', 'latitude', 'longitude')
            ->whereIn('kelurahan', $kelurahanFilter)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get()
            ->toArray();

        // 19 kategori (persis seperti di halaman rekap)
        $kategoriList = [
            'A. Pertanian, Kehutanan, dan Perikanan',
            'B. Pertambangan dan Penggalian',
            'C. Industri Pengolahan',
            'D. Pengadaan Listrik, Gas, Uap/Air Panas dan Udara Dingin',
            'E. Pengadaan Air, Pengelolaan Sampah, Limbah, dan Daur Ulang',
            'F. Konstruksi',
            'G. Perdagangan Besar dan Eceran, Reparasi Mobil dan Sepeda Motor',
            'H. Transportasi dan Pergudangan',
            'I. Penyediaan Akomodasi dan Makan Minum',
            'J. Informasi dan Komunikasi',
            'K. Jasa Keuangan dan Asuransi',
            'L. Real Estat',
            'M. Aktivitas Profesional, Ilmiah, dan Teknis',
            'N. Aktivitas Penyewaan dan Sewa Guna Usaha tanpa Hak Opsi, Ketenagakerjaan, Agen Perjalanan dan Penunjang Usaha Lainnya',
            'O. Administrasi Pemerintahan, Pertahanan, dan Jaminan Sosial Wajib',
            'P. Jasa Pendidikan',
            'Q. Jasa Kesehatan dan Kegiatan Sosial',
            'R. Kesenian, Hiburan, dan Rekreasi',
            'S. Aktivitas Jasa Lainnya',
        ];

        

        return view('dashboard', compact(
            'kategoriList', 'rekapPerKelurahan', 'rekapKategori', 'lokasiUsaha'
        ));
    }
}