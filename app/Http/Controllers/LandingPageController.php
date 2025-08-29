<?php

namespace App\Http\Controllers;

use App\Models\PemutakhiranData;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    public function index()
    {
        $kelurahanFilter = ['Randusari', 'Gentong', 'Pohjentrek', 'Mandaranrejo'];

        // 🔹 Daftar kategori fix (A–S, sesuai KBLI)
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

        // 🔹 Rekap total per kelurahan
        $rekapPerKelurahan = PemutakhiranData::select('kelurahan', DB::raw('COUNT(*) as total'))
            ->whereIn('kelurahan', $kelurahanFilter)
            ->groupBy('kelurahan')
            ->get();

        // 🔹 Ambil data kategori mentah (trim biar spasi/huruf beda nggak bikin dobel)
        $rekapKategoriRaw = PemutakhiranData::select(
                'kelurahan',
                DB::raw("TRIM(kategori_usaha) as kategori_usaha"),
                DB::raw('COUNT(*) as total')
            )
            ->whereIn('kelurahan', $kelurahanFilter)
            ->groupBy('kelurahan', DB::raw("TRIM(kategori_usaha)"))
            ->get();

        // 🔹 Susun rekap berdasarkan kategori fix (A–S), isi dengan data yang sudah dinormalisasi
        $rekapKategori = [];
        foreach ($kelurahanFilter as $kel) {
            $rows = collect($kategoriList)->map(fn($kat) => [
                'kategori_usaha' => $kat,
                'total' => 0
            ])->toArray();

            foreach ($rekapKategoriRaw->where('kelurahan', $kel) as $r) {
                $kategoriDb = trim($r->kategori_usaha);

                // Cari kategori yang match
                $key = array_search($kategoriDb, array_column($rows, 'kategori_usaha'));

                // Kalau ada yang nyeleneh (misal beda spasi), cocokan pakai LIKE
                if ($key === false) {
                    foreach ($rows as $idx => $row) {
                        if (stripos($row['kategori_usaha'], substr($kategoriDb, 0, 2)) === 0) {
                            $key = $idx;
                            break;
                        }
                    }
                }

                if ($key !== false) {
                    $rows[$key]['total'] += $r->total;
                }
            }

            $rekapKategori[$kel] = $rows;
        }

        // 🔹 Data lokasi peta
        $lokasiUsaha = PemutakhiranData::select('nama_usaha', 'kelurahan', 'latitude', 'longitude')
            ->whereIn('kelurahan', $kelurahanFilter)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get()
            ->map(fn($item) => [
                'nama_usaha' => $item->nama_usaha,
                'kelurahan' => $item->kelurahan,
                'latitude' => $item->latitude,
                'longitude' => $item->longitude
            ])->toArray();

        return view('dashboard', compact(
            'kategoriList',
            'rekapPerKelurahan',
            'rekapKategori',
            'lokasiUsaha'
        ));
    }
}
