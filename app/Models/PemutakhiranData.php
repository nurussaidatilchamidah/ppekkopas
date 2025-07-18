<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemutakhiranData extends Model
{
    use HasFactory;

    protected $table = 'pemutakhiran_data';
    
    protected $fillable = [
        'kelurahan',
        'rw',
        'rt',
        'nama_usaha',
        'nama_pemilik',
        'alamat_usaha',
        'deskripsi_usaha',
        'kategori_usaha',
        'catatan',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    // Accessor untuk koordinat
    public function getKoordinatAttribute()
    {
        return "{$this->latitude},{$this->longitude}";
    }
}