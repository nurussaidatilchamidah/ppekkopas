<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemutakhiran_data', function (Blueprint $table) {
            $table->id();
            $table->string('kelurahan'); 
            $table->string('rw');
            $table->string('rt');
            $table->string('nama_usaha');
            $table->string('nama_pemilik')->nullable();
            $table->string('alamat_usaha')->nullable();
            $table->text('deskripsi_usaha');
            $table->string('kategori_usaha');
            $table->longText('catatan')->nullable();
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemutakhiran_data');
    }
};
