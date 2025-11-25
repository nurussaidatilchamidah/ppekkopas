<?php

namespace App\Http\Controllers;

use App\Models\PemutakhiranData;
use Illuminate\Http\Request;

class PemutakhiranController extends Controller
{
   // Menampilkan semua data
   public function index(Request $request)
{
   $correctPassword = "kpsecret123";

   //----------------------------------------------------
    // 1. CEK: kalau TIDAK ada authenticated=1 → wajib password
    //----------------------------------------------------
    if (!$request->boolean('authenticated')) {

        // Belum submit apa pun → tampilkan form password
        if (!$request->has('password')) {
            return view('auth.simple-password', [
                'targetRoute' => route('pemutakhiran.index')
            ]);
        }

        // Jika password salah
        if ($request->password !== $correctPassword) {
            return view('auth.simple-password', [
                'error' => 'Password salah!',
                'targetRoute' => route('pemutakhiran.index')
            ]);
        }


      // Password benar → redirect pakai authenticated=1
        return redirect()->route('pemutakhiran.index', ['authenticated' => 1]);
    }

        $query = PemutakhiranData::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_usaha', 'like', "%$search%")
                ->orWhere('kelurahan', 'like', "%$search%")
                ->orWhere('kategori_usaha', 'like', "%$search%");
            });
        }

        // 🔹 Filter kelurahan (hanya 4 pilihan)
    $allowedKelurahan = ['Randusari', 'Gentong', 'Pohjentrek', 'Mandaranrejo'];
    if ($request->filled('kelurahan') && in_array($request->kelurahan, $allowedKelurahan)) {
        $query->where('kelurahan', $request->kelurahan);
    }

    // 🔹 Filter kategori usaha
    $allowedKategori = [
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
        'S. Aktivitas Jasa Lainnya'
    ];

    // 🔹 Filter kategori usaha (longgar biar data lama & baru ikut)
    if ($request->filled('kategori_usaha') && in_array($request->kategori_usaha, $allowedKategori)) {
        $prefix = substr($request->kategori_usaha, 0, 2); // ambil "N."
        $query->where('kategori_usaha', 'LIKE', $prefix . '%');
    }

        $perPage = $request->input('per_page', $request->session()->get('per_page', 10));

        // simpan ke session supaya tetap konsisten
        $request->session()->put('per_page', $perPage);

   if ($perPage === 'all') {
        $data = $query->orderBy('created_at', 'desc')->get();
        $isPaginated = false;
    } else {
        $perPage = (int) $perPage;
        $data = $query->orderBy('created_at', 'desc')->paginate($perPage)->withQueryString();
        $isPaginated = true;
    }

    return view('pemutakhiran.index', compact('data', 'perPage', 'isPaginated', 'allowedKelurahan', 'allowedKategori'));
    }

    public function create()
    {
        $prefill = session('prefill_data', []);
    return view('pemutakhiran.create', compact('prefill'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'kelurahan' => 'required|string',
            'rw' => 'required|string',
            'rt' => 'required|string',
            'nama_usaha' => 'required|string',
            'nama_pemilik' => 'nullable|string',
            'alamat_usaha' => 'nullable|string',
            'deskripsi_usaha' => 'required|string',
            'kategori_usaha' => 'required|string',
            'catatan' => 'nullable|string',
            'latlong' => 'required|string',
        ]);

        $koordinat = array_map('trim', explode(',', $request->latlong));
        $latitude = !empty($koordinat[0]) ? $koordinat[0] : null;
        $longitude = !empty($koordinat[1]) ? $koordinat[1] : null;


        PemutakhiranData::create([
            'kelurahan' => $request->kelurahan,
            'rw' => $request->rw,
            'rt' => $request->rt,
            'nama_usaha' => $request->nama_usaha,
            'nama_pemilik' => $request->nama_pemilik,
            'alamat_usaha' => $request->alamat_usaha,
            'deskripsi_usaha' => $request->deskripsi_usaha,
            'kategori_usaha' => $request->kategori_usaha,
            'catatan' => $request->catatan,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);

        //  SET SESSION UNTUK PREFILL PADA PENDAATAAN
session([
    'prefill_pendataan' => [
        'kelurahan' => $request->kelurahan,
        'rw' => $request->rw,
        'rt' => $request->rt,
        'nama_usaha' => $request->nama_usaha,
        'kategori_usaha' => $request->kategori_usaha,
    ]
]);


        return redirect()->route('dashboard')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = PemutakhiranData::findOrFail($id);
        return view('pemutakhiran.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'kelurahan' => 'required|string',
        'rw' => 'required|string',
        'rt' => 'required|string',
        'nama_usaha' => 'required|string',
        'nama_pemilik' => 'nullable|string',
        'alamat_usaha' => 'nullable|string',
        'deskripsi_usaha' => 'required|string',
        'kategori_usaha' => 'required|string',
        'catatan' => 'nullable|string',
        'latlong' => 'required|string',
    ]);
    
        $koordinat = $request->latlong ? explode(',', $request->latlong) : [null, null];

        $latitude = isset($koordinat[0]) && $koordinat[0] !== '' ? $koordinat[0] : null;
        $longitude = isset($koordinat[1]) && $koordinat[1] !== '' ? $koordinat[1] : null;


    $data = PemutakhiranData::findOrFail($id);
    $data->update([
        'kelurahan' => $request->kelurahan,
        'rw' => $request->rw,
        'rt' => $request->rt,
        'nama_usaha' => $request->nama_usaha,
        'nama_pemilik' => $request->nama_pemilik,
        'alamat_usaha' => $request->alamat_usaha,
        'deskripsi_usaha' => $request->deskripsi_usaha,
        'kategori_usaha' => $request->kategori_usaha,
        'catatan' => $request->catatan,
        'latitude' => $latitude,
        'longitude' => $longitude,
    ]);

    return redirect()->route('pemutakhiran.index')->with('success', 'Data berhasil diperbarui.');
    }


        public function show($id)
    {
        $data = PemutakhiranData::findOrFail($id);
        return view('pemutakhiran.show', compact('data'));
    }

        public function destroy($id)
    {
        $data = PemutakhiranData::findOrFail($id);
        $data->delete();

        return redirect()->route('pemutakhiran.index')->with('success', 'Data berhasil dihapus.');
    }

    
public function rekap()
{
    $kelurahanFilter = ['Randusari', 'Gentong', 'Pohjentrek', 'Mandaranrejo'];

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
        'S. Aktivitas Jasa Lainnya'
    ];

    $dataKelurahan = collect($kelurahanFilter);

    // 🔹 Rekap per kelurahan
    $rekapPerKelurahan = PemutakhiranData::select('kelurahan', \DB::raw('COUNT(*) as total'))
        ->whereIn('kelurahan', $kelurahanFilter)
        ->groupBy('kelurahan')
        ->get();

    // 🔹 Ambil data kategori mentah
    $rekapKategoriRaw = PemutakhiranData::select(
            'kelurahan',
            \DB::raw("TRIM(kategori_usaha) as kategori_usaha"),
            \DB::raw("COUNT(*) as total")
        )
        ->whereIn('kelurahan', $kelurahanFilter)
        ->groupBy('kelurahan', \DB::raw("TRIM(kategori_usaha)"))
        ->get();

    // 🔹 Susun rekap kategori fix (A–S)
    $rekapKategori = [];
    foreach ($kelurahanFilter as $kel) {
        $rows = collect($kategoriList)->map(fn($kat) => [
            'kategori_usaha' => $kat,
            'total' => 0
        ])->toArray();

        foreach ($rekapKategoriRaw->where('kelurahan', $kel) as $r) {
            $kategoriDb = trim($r->kategori_usaha);

            // Cari yang persis sama
            $key = array_search($kategoriDb, array_column($rows, 'kategori_usaha'));

            // Kalau tidak ada, cocokkan dengan prefix kode (A., B., dst.)
            if ($key === false) {
                foreach ($rows as $idx => $row) {
                    if (stripos($row['kategori_usaha'], substr($kategoriDb, 0, 2)) === 0) {
                        $key = $idx;
                        break;
                    }
                }
            }

            if ($key !== false) {
                $rows[$key]['total'] += $r->total; // ✅ pakai += supaya nambah, bukan overwrite
            }
        }

        $rekapKategori[$kel] = $rows;
    }

    // 🔹 Rekap per RT/RW
    $rekapRTRW = PemutakhiranData::select('kelurahan', 'rw', 'rt', \DB::raw('COUNT(*) as total'))
        ->whereIn('kelurahan', $kelurahanFilter)
        ->groupBy('kelurahan', 'rw', 'rt')
        ->orderBy('kelurahan')
        ->orderByRaw('CAST(rw AS UNSIGNED)')
        ->orderByRaw('CAST(rt AS UNSIGNED)')
        ->get()
        ->groupBy('kelurahan');

    // 🔹 Data lokasi usaha
    $lokasiUsaha = PemutakhiranData::select('nama_usaha', 'kelurahan', 'latitude', 'longitude')
        ->whereIn('kelurahan', $kelurahanFilter)
        ->whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->get();

    return view('pemutakhiran.rekap', compact(
        'dataKelurahan',
        'rekapPerKelurahan',
        'rekapKategori',
        'rekapRTRW',
        'lokasiUsaha'
    ));
}
}

