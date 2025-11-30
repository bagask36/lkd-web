<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKalibrasi extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'laporan_kalibrasis';

    // Kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'kalibrasi_id',
        'nama_alat',
        'merk',
        'no_seri',
        'tgl_kalibrasi',
        'tgl_next_kalibrasi',
        'hasil',
        'teknisi',
        'file_path',
        'nilai_setting',
        'nilai_pengukuran',
        'u_a_value',
        'rata_rata', // Tambahkan ini
        'standar_deviasi', // Tambahkan ini
        'nilai_koreksi' // Tambahkan ini
    ];

    // Jika mau format tanggal otomatis
    protected $casts = [
        'tgl_kalibrasi' => 'date',
        'tgl_next_kalibrasi' => 'date',
        'nilai_setting' => 'double',
        'nilai_pengukuran' => 'array'
    ];

    public function kalibrasi()
    {
        return $this->belongsTo(\App\Models\Kalibrasi::class);
    }
}
