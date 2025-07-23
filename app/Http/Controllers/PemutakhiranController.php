<?php

namespace App\Http\Controllers;

use App\Models\PemutakhiranData;
use Illuminate\Http\Request;

class PemutakhiranController extends Controller
{
    public function index()
    {
        $data = PemutakhiranData::all();
        return view('pemutakhiran.index', compact('data'));
    }

    public function create()
    {
        return view('pemutakhiran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelurahan' => 'required|string',
            'rw' => 'required|string',
            'rt' => 'required|string',
            'nama_usaha' => 'required|string',
            'nama_pemilik' => 'required|string',
            'alamat_usaha' => 'required|string',
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