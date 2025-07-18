<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendataanUsaha extends Model
{
    use HasFactory;

    protected $table = 'pendataan_usaha';

    protected $fillable = [
        'kelurahan',
        'rw',
        'rt',
        'nama_usaha',
        'kategori_usaha',
        'jumlah_tenaga_kerja',
        'pendapatan_per_bulan',
        'pengeluaran_operasional',
        'nilai_aset_gedung_dan_kendaraan', 
        'nilai_aset_mesin_dan_alat_produksi_lain',
        'izin_usaha',
        'catatan',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'pendapatan_per_bulan'     => 'decimal:2',
        'pengeluaran_operasional'  => 'decimal:2',
        'nilai_aset_gedung_dan_kendaraan'        => 'decimal:2',
        'nilai_aset_mesin_dan_alat_produksi_lain'         => 'decimal:2',
        'latitude'                 => 'decimal:8',
        'longitude'                => 'decimal:8',
    ];

    // Accessor untuk menggabungkan koordinat
    public function getKoordinatAttribute()
    {
        return "{$this->latitude},{$this->longitude}";
    }
}
