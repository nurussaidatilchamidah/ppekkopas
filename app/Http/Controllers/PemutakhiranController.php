<?php

namespace App\Http\Controllers;

use App\Models\PemutakhiranData;
use Illuminate\Http\Request;

class PemutakhiranController extends Controller
{
    public function index(Request $request) //search
    {
        $query = PemutakhiranData::query();

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

    return view('pemutakhiran.index', compact('data', 'perPage', 'isPaginated'));
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

    return redirect()->route('dashboard')->with('success', 'Data berhasil diperbarui.');
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
}