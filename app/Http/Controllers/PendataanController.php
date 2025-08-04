<?php

namespace App\Http\Controllers;

use App\Models\PendataanUsaha;
use Illuminate\Http\Request;

class PendataanController extends Controller
{
    // Menampilkan semua data
   public function index(Request $request)
{
    $query = PendataanUsaha::query();

    if ($request->has('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nama_usaha', 'like', "%$search%")
              ->orWhere('kelurahan', 'like', "%$search%")
              ->orWhere('kategori_usaha', 'like', "%$search%");
        });
    }

     $perPage = $request->get('per_page', 10); // default: 10

   if ($perPage === 'all') {
        $data = $query->orderBy('created_at', 'desc')->get();
        $isPaginated = false;
    } else {
        $perPage = (int) $perPage;
        $data = $query->orderBy('created_at', 'desc')->paginate($perPage)->withQueryString();
        $isPaginated = true;
    }

    return view('pendataan.index', compact('data', 'perPage', 'isPaginated'));
    }

    // Menampilkan form tambah
    public function create()
    {
        $prefill = session('prefill_data', []);
        return view('pendataan.create', compact('prefill'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'kelurahan' => 'required|string',
            'rw' => 'required|string',
            'rt' => 'required|string',
            'nama_usaha' => 'required|string',
            'kategori_usaha' => 'required|string',
            'jumlah_tenaga_kerja' => 'required|numeric|min:1',
            'pendapatan_per_bulan' => 'required|numeric|min:100000',
            'pengeluaran_operasional' => 'required|numeric|lte:pendapatan_per_bulan|min:100000',
            'nilai_aset_gedung_dan_kendaraan' => 'required|numeric|min:100000',
            'nilai_aset_mesin_dan_alat_produksi_lain' => 'required|numeric|min:100000',
            'izin_usaha' => 'nullable|string',
            'catatan' => 'nullable|string',
            'latlong' => 'nullable|string',
        ]);

        if ($request->filled('latlong')) {
                    [$latitude, $longitude] = explode(',', $request->latlong);
                    $latitude = trim($latitude) ?: null;
                    $longitude = trim($longitude) ?: null;
                } else {
                    $latitude = null;
                    $longitude = null;
                }

        // Simpan data ke DB
        PendataanUsaha::create([
            'kelurahan' => $request->kelurahan,
            'rw' => $request->rw,
            'rt' => $request->rt,
            'nama_usaha' => $request->nama_usaha,
            'kategori_usaha' => $request->kategori_usaha,
            'jumlah_tenaga_kerja' => $request->jumlah_tenaga_kerja,
            'pendapatan_per_bulan' => $request->pendapatan_per_bulan,
            'pengeluaran_operasional' => $request->pengeluaran_operasional,
            'nilai_aset_gedung_dan_kendaraan' => $request->nilai_aset_gedung_dan_kendaraan,
            'nilai_aset_mesin_dan_alat_produksi_lain' => $request->nilai_aset_mesin_dan_alat_produksi_lain,
            'izin_usaha' => $request->izin_usaha,
            'catatan' => $request->catatan,
            'latlong' => $request->latlong,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);

       // ✅ SET SESSION UNTUK PREFILL PADA PENDAATAAN
session([
    'prefill_pendataan' => [
        'kelurahan' => $request->kelurahan,
        'rw' => $request->rw,
        'rt' => $request->rt,
        'nama_usaha' => $request->nama_usaha,
        'kategori_usaha' => $request->kategori_usaha,
    ]
]);


        return redirect()->route('dashboard')->with('success', 'Data berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $data = PendataanUsaha::findOrFail($id);
        return view('pendataan.edit', compact('data'));
    }

    // Proses update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'kelurahan' => 'required|string',
            'rw' => 'required|string',
            'rt' => 'required|string',
            'nama_usaha' => 'required|string',
            'kategori_usaha' => 'required|string',
            'jumlah_tenaga_kerja' => 'required|numeric|min:1',
            'pendapatan_per_bulan' => 'required|numeric|min:100000',
            'pengeluaran_operasional' => 'required|numeric|lte:pendapatan_per_bulan|min:100000',
            'nilai_aset_gedung_dan_kendaraan' => 'required|numeric|min:100000',
            'nilai_aset_mesin_dan_alat_produksi_lain' => 'required|numeric|min:100000',
            'izin_usaha' => 'nullable|string',
            'catatan' => 'nullable|string',
            'latlong' => 'nullable|string',
        ]);

    if ($request->filled('latlong')) {
                [$latitude, $longitude] = explode(',', $request->latlong);
                $latitude = trim($latitude) ?: null;
                $longitude = trim($longitude) ?: null;
            } else {
                $latitude = null;
                $longitude = null;
            }

        $data = PendataanUsaha::findOrFail($id);
        $data->update([
            'kelurahan' => $request->kelurahan,
            'rw' => $request->rw,
            'rt' => $request->rt,
            'nama_usaha' => $request->nama_usaha,
            'kategori_usaha' => $request->kategori_usaha,
            'jumlah_tenaga_kerja' => $request->jumlah_tenaga_kerja,
            'pendapatan_per_bulan' => $request->pendapatan_per_bulan,
            'pengeluaran_operasional' => $request->pengeluaran_operasional,
            'nilai_aset_gedung_dan_kendaraan' => $request->nilai_aset_gedung_dan_kendaraan,
            'nilai_aset_mesin_dan_alat_produksi_lain' => $request->nilai_aset_mesin_dan_alat_produksi_lain,
            'izin_usaha' => $request->izin_usaha,
            'catatan' => $request->catatan,
            'latlong' => $request->latlong,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);

        return redirect()->route('dashboard')->with('success', 'Data berhasil diperbarui.');
    }

    // Hapus data
    public function destroy($id)
    {
        $data = PendataanUsaha::findOrFail($id);
        $data->delete();

        return redirect()->route('pendataan.index')->with('success', 'Data berhasil dihapus.');
    }

    // Tampilkan detail data (opsional)
    public function show($id)
    {
        $data = PendataanUsaha::findOrFail($id);
        return view('pendataan.show', compact('data'));
    }
}
