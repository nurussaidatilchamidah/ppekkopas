<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pendataan_usaha', function (Blueprint $table) {
            $table->id();
            $table->string('kelurahan');
            $table->string('rw');
            $table->string('rt');
            $table->string('nama_usaha');
            $table->string('kategori_usaha');
            $table->integer('jumlah_tenaga_kerja');
            $table->decimal('pendapatan_per_bulan', 15, 2);
            $table->decimal('pengeluaran_operasional', 15, 2);
            $table->decimal('nilai_aset_gedung_dan_kendaraan', 15, 2);
            $table->decimal('nilai_aset_mesin_dan_alat_produksi_lain', 15, 2);
            $table->string('izin_usaha');
            $table->text('catatan')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendataan_usaha');
    }
};