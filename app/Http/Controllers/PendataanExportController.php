<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\PendataanUsaha;

class PendataanExportController extends Controller
{
    public function exportCsv()
    {
        $data = PendataanUsaha::all();
        
        $filename = "pendataan_usaha.csv";
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            // Sesuaikan header CSV dengan kolom pada tabel kamu
            fputcsv($file, ['kelurahan', 'rw', 'rt' ,'nama_usaha', 'kategori_usaha', 'jumlah_tenaga_kerja','pendapatan_per_bulan','pengeluaran_operasional','nilai_aset_gedung_dan_kendaraan', 'nilai_aset_mesin_dan_alat_produksi_lain','izin_usaha','catatan','latlong', 'latitude','longitude']);
            foreach ($data as $row) {
                fputcsv($file, [
                    $row->kelurahan,
                    $row->rw,
                    $row->rt,
                    $row->nama_usaha,
                    $row->kategori_usaha,
                    $row->jumlah_usaha,
                    $row->jumlah_tenaga_kerja,
                    $row->pendapatan_per_bulan,
                    $row->pengeluaran_operasional,
                    $row->nilai_aset_gedung_dan_kendaraan,
                    $row->nilai_aset_mesin_dan_alat_produksi_lain,
                    $row->izin_usaha,
                    $row->jumlah_tenaga_kerja,
                    $row->catatan,
                    $row->latlong,
                    $row->latitude,
                    $row->longitude,
                ]);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
