<?php

namespace App\Http\Controllers;

use App\Models\PemutakhiranData;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    public function index()
    {
        $kelurahanFilter = ['Randusari', 'Gentong', 'Pohjentrek', 'Mandaranrejo'];

        // Rekap total per kelurahan
        $rekapPerKelurahan = PemutakhiranData::select('kelurahan', DB::raw('COUNT(*) as total'))
            ->whereIn('kelurahan', $kelurahanFilter)
            ->groupBy('kelurahan')
            ->get();

        // Ambil semua kategori unik dari DB (sudah di-TRIM biar bersih)
        $kategoriList = PemutakhiranData::select(DB::raw("TRIM(kategori_usaha) as kategori_usaha"))
            ->distinct()
            ->orderBy('kategori_usaha', 'asc')
            ->pluck('kategori_usaha')
            ->toArray();

        // Rekap kategori per kelurahan
        $rekapKategoriRaw = PemutakhiranData::select(
                'kelurahan',
                DB::raw("TRIM(kategori_usaha) as kategori_usaha"),
                DB::raw('COUNT(*) as total')
            )
            ->whereIn('kelurahan', $kelurahanFilter)
            ->groupBy('kelurahan', 'kategori_usaha')
            ->get();

        // Susun hasil rekap berdasarkan kategoriList
        $rekapKategori = [];
        foreach ($kelurahanFilter as $kel) {
            $rows = collect($kategoriList)->map(fn($kat) => [
                'kategori_usaha' => $kat,
                'total' => 0
            ])->toArray();

            foreach ($rekapKategoriRaw->where('kelurahan', $kel) as $r) {
                $kategoriDb = trim($r->kategori_usaha);

                $key = array_search($kategoriDb, array_column($rows, 'kategori_usaha'));
                if ($key !== false) {
                    $rows[$key]['total'] = $r->total;
                }
            }

            $rekapKategori[$kel] = $rows;
        }

        // Data peta
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

        return view('dashboard', compact('kategoriList', 'rekapPerKelurahan', 'rekapKategori', 'lokasiUsaha'));
    }
}
