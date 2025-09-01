<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TabulasiController extends Controller
{
    public function tabulasi(Request $request)
    {
        $kelurahan = $request->input('kelurahan', 'Gentong', 'Mandaranrejo', 'Pohjentrek', 'Randusari');

        // Data Gentong
        $data['Gentong'] = [
            'kategori' => [
                ['kategori' => 'Pertanian, Perikanan, dan Kehutanan', 'jumlah' => 0],
                ['kategori' => 'Pertambangan, Energi, dan Konstruksi', 'jumlah' => 5],
                ['kategori' => 'Industri Pengolahan', 'jumlah' => 54],
                ['kategori' => 'Perdagangan Besar dan Eceran, Reparasi Mobil dan Sepeda Motor', 'jumlah' => 103],
                ['kategori' => 'Penyediaan Akomodasi dan Makan Minum', 'jumlah' => 125],
                ['kategori' => 'Jasa-jasa Lainnya', 'jumlah' => 78],
            ],

            'skalaPekerja' => [
                ['skala' => 'Mikro', 'jumlah' => 331, 'persentase' => 90.68],
                ['skala' => 'Kecil', 'jumlah' => 32, 'persentase' => 8.77],
                ['skala' => 'Menengah', 'jumlah' => 2, 'persentase' => 0.55],
            ],

            'skalaAset' => [
                ['skala' => 'Mikro', 'jumlah' => 241, 'persentase' => 66.03],
                ['skala' => 'Kecil', 'jumlah' => 115, 'persentase' => 31.51],
                ['skala' => 'Menengah', 'jumlah' => 9, 'persentase' => 2.47],
            ],

            'jenisAset' => [
                ['jenis' => 'Gedung dan Kendaraan', 'nilai' => 119314420, 'persentase' => 79.93],
                ['jenis' => 'Mesin dan Alat Produksi Lain', 'nilai' => 29951017, 'persentase' => 20.07],
            ],

            'badanUsaha' => [
                ['badan' => 'Usaha Perorangan', 'jumlah' => 348, 'persentase' => 95.34],
                ['badan' => 'Koperasi dan BUMKel', 'jumlah' => 0, 'persentase' => 0],
                ['badan' => 'Yayasan', 'jumlah' => 7, 'persentase' => 1.92],
                ['badan' => 'Badan Hukum Lainnya (PT, CV, dll)', 'jumlah' => 10, 'persentase' => 2.74],
            ],

            'ntbKategori' => [
                ['kategori' => 'Pertanian, Perikanan, dan Kehutanan', 'ntb' => 0],
                ['kategori' => 'Pertambangan, Energi, dan Konstruksi', 'ntb' => 44750000],
                ['kategori' => 'Industri Pengolahan', 'ntb' => 529703550],
                ['kategori' => 'Perdagangan Besar dan Eceran, Reparasi Mobil dan Sepeda Motor', 'ntb' => 10946456744],
                ['kategori' => 'Penyediaan Akomodasi dan Makan Minum', 'ntb' => 9525641026],
                ['kategori' => 'Jasa-jasa Lainnya', 'ntb' => 5486932941],
            ],
        ];

       
        // Data Mandaranrejo
        $data['Mandaranrejo'] = [
            'kategori' => [
                ['kategori' => 'Pertanian, Perikanan, dan Kehutanan', 'jumlah' => 6],
                ['kategori' => 'Pertambangan, Energi, dan Konstruksi', 'jumlah' => 1],
                ['kategori' => 'Industri Pengolahan', 'jumlah' => 20],
                ['kategori' => 'Perdagangan Besar dan Eceran, Reparasi Mobil dan Sepeda Motor', 'jumlah' => 71],
                ['kategori' => 'Penyediaan Akomodasi dan Makan Minum', 'jumlah' => 83],
                ['kategori' => 'Jasa-jasa Lainnya', 'jumlah' => 39],
            ],

            'skalaPekerja' => [
                ['skala' => 'Mikro', 'jumlah' => 209, 'persentase' => 95.00],
                ['skala' => 'Kecil', 'jumlah' => 11, 'persentase' => 5.00],
                ['skala' => 'Menengah', 'jumlah' => 0, 'persentase' => 0.00],
            ],

            'skalaAset' => [
                ['skala' => 'Mikro', 'jumlah' => 184, 'persentase' => 83.64],
                ['skala' => 'Kecil', 'jumlah' => 27, 'persentase' => 12.27],
                ['skala' => 'Menengah', 'jumlah' => 9, 'persentase' => 4.09],
            ],

            'jenisAset' => [
                ['jenis' => 'Gedung dan Kendaraan', 'nilai' => 44293912, 'persentase' => 73.59],
                ['jenis' => 'Mesin dan Alat Produksi Lain', 'nilai' => 15893077, 'persentase' => 26.41],
            ],

            'badanUsaha' => [
                ['badan' => 'Usaha Perorangan', 'jumlah' => 211, 'persentase' => 95.91],
                ['badan' => 'Koperasi dan BUMKel', 'jumlah' => 3, 'persentase' => 1.36],
                ['badan' => 'Yayasan', 'jumlah' => 3, 'persentase' => 1.36],
                ['badan' => 'Badan Hukum Lainnya (PT, CV, dll)', 'jumlah' => 3, 'persentase' => 1.36],
            ],

            'ntbKategori' => [
                ['kategori' => 'Pertanian, Perikanan, dan Kehutanan', 'ntb' => 441585366],
                ['kategori' => 'Pertambangan, Energi, dan Konstruksi', 'ntb' => 139101626],
                ['kategori' => 'Industri Pengolahan', 'ntb' => 847926829],
                ['kategori' => 'Perdagangan Besar dan Eceran, Reparasi Mobil dan Sepeda Motor', 'ntb' => 5618493225],
                ['kategori' => 'Penyediaan Akomodasi dan Makan Minum', 'ntb' => 3392893784],
                ['kategori' => 'Jasa-jasa Lainnya', 'ntb' => 6275800976],
            ],
        ];

        // Data Pohjentrek
        $data['Pohjentrek'] = [
            'kategori' => [
                ['kategori' => 'Pertanian, Perikanan, dan Kehutanan', 'jumlah' => 9],
                ['kategori' => 'Pertambangan, Energi, dan Konstruksi', 'jumlah' => 4],
                ['kategori' => 'Industri Pengolahan', 'jumlah' => 46],
                ['kategori' => 'Perdagangan Besar dan Eceran, Reparasi Mobil dan Sepeda Motor', 'jumlah' => 70],
                ['kategori' => 'Penyediaan Akomodasi dan Makan Minum', 'jumlah' => 135],
                ['kategori' => 'Jasa-jasa Lainnya', 'jumlah' => 64],
            ],

            'skalaPekerja' => [
                ['skala' => 'Mikro', 'jumlah' => 312, 'persentase' => 95.12],
                ['skala' => 'Kecil', 'jumlah' => 16, 'persentase' => 4.88],
                ['skala' => 'Menengah', 'jumlah' => 0, 'persentase' => 0.00],
            ],

            'skalaAset' => [
                ['skala' => 'Mikro', 'jumlah' => 274, 'persentase' => 83.54],
                ['skala' => 'Kecil', 'jumlah' => 40, 'persentase' => 12.19],
                ['skala' => 'Menengah', 'jumlah' => 14, 'persentase' => 4.27],
            ],

            'jenisAset' => [
                ['jenis' => 'Gedung dan Kendaraan', 'nilai' => 66038196, 'persentase' => 73.59],
                ['jenis' => 'Mesin dan Alat Produksi Lain', 'nilai' => 23695133, 'persentase' => 26.41],
            ],

            'badanUsaha' => [
                ['badan' => 'Usaha Perorangan', 'jumlah' => 314, 'persentase' => 95.73],
                ['badan' => 'Koperasi dan BUMKel', 'jumlah' => 5, 'persentase' => 1.52],
                ['badan' => 'Yayasan', 'jumlah' => 5, 'persentase' => 1.52],
                ['badan' => 'Badan Hukum Lainnya (PT, CV, dll)', 'jumlah' => 4, 'persentase' => 1.22],
            ],

            'ntbKategori' => [
                ['kategori' => 'Pertanian, Perikanan, dan Kehutanan', 'ntb' => 362000000],
                ['kategori' => 'Pertambangan, Energi, dan Konstruksi', 'ntb' => 501933333],
                ['kategori' => 'Industri Pengolahan', 'ntb' => 1166000000],
                ['kategori' => 'Perdagangan Besar dan Eceran, Reparasi Mobil dan Sepeda Motor', 'ntb' => 5394844444],
                ['kategori' => 'Penyediaan Akomodasi dan Makan Minum', 'ntb' => 5667587096],
                ['kategori' => 'Jasa-jasa Lainnya', 'ntb' => 11829376000],
            ],
        ];

        // Data Randusari
        $data['Randusari'] = [
            'kategori' => [
                ['kategori' => 'Pertanian, Perikanan, dan Kehutanan', 'jumlah' => 4],
                ['kategori' => 'Pertambangan, Energi, dan Konstruksi', 'jumlah' => 0],
                ['kategori' => 'Industri Pengolahan', 'jumlah' => 159],
                ['kategori' => 'Perdagangan Besar dan Eceran, Reparasi Mobil dan Sepeda Motor', 'jumlah' => 3],
                ['kategori' => 'Penyediaan Akomodasi dan Makan Minum', 'jumlah' => 19],
                ['kategori' => 'Jasa-jasa Lainnya', 'jumlah' => 29],
            ],

            'skalaPekerja' => [
                ['skala' => 'Mikro', 'jumlah' => 210, 'persentase' => 98.13],
                ['skala' => 'Kecil', 'jumlah' => 3, 'persentase' => 1.40],
                ['skala' => 'Menengah', 'jumlah' => 1, 'persentase' => 0.47],
            ],

            'skalaAset' => [
                ['skala' => 'Mikro', 'jumlah' => 206, 'persentase' => 96.26],
                ['skala' => 'Kecil', 'jumlah' => 7, 'persentase' => 3.27],
                ['skala' => 'Menengah', 'jumlah' => 1, 'persentase' => 0.47],
            ],

            'jenisAset' => [
                ['jenis' => 'Gedung dan Kendaraan', 'nilai' => 71256534, 'persentase' => 81.23],
                ['jenis' => 'Mesin dan Alat Produksi Lain', 'nilai' => 16468159, 'persentase' => 18.77],
            ],

            'badanUsaha' => [
                ['badan' => 'Usaha Perorangan', 'jumlah' => 211, 'persentase' => 98.60],
                ['badan' => 'Koperasi dan BUMKel', 'jumlah' => 0, 'persentase' => 0],
                ['badan' => 'Yayasan', 'jumlah' => 0, 'persentase' => 0],
                ['badan' => 'Badan Hukum Lainnya (PT, CV, dll)', 'jumlah' => 3, 'persentase' => 1.40],
            ],

            'ntbKategori' => [
                ['kategori' => 'Pertanian, Perikanan, dan Kehutanan', 'ntb' => 48300000],
                ['kategori' => 'Pertambangan, Energi, dan Konstruksi', 'ntb' => 0],
                ['kategori' => 'Industri Pengolahan', 'ntb' => 13043986415],
                ['kategori' => 'Perdagangan Besar dan Eceran, Reparasi Mobil dan Sepeda Motor', 'ntb' => 1761000000],
                ['kategori' => 'Penyediaan Akomodasi dan Makan Minum', 'ntb' => 2191544444],
                ['kategori' => 'Jasa-jasa Lainnya', 'ntb' => 3972116080],
            ],
        ];


        $tabel = $data[$kelurahan] ?? $data['kelurahan'];

        return view('pendataan.tabulasi', compact('tabel', 'kelurahan'));
    }
}
