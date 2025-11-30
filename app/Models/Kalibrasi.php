<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Kalibrasi extends Model
{
    use HasFactory;
    
    protected $table = 'kalibrasi';
    protected $fillable = [
        'nama_alat',
        'merk_alat',
        'tipe_alat',
        'tanggal_kalibrasi',
        'model_tipe',
        'no_seri',
        'no_order',
        'nama_pemilik',
        'alamat_pemilik',
        'nama_ruang',
        'lokasi_kalibrasi',
        'hasil',
        'metode_kerja'

    ];
    protected $casts = [
        'tanggal_kalibrasi' => 'date',
    ];

    public function laporanKalibrasi()
    {
        return $this->hasOne(\App\Models\LaporanKalibrasi::class, 'kalibrasi_id');
    }
}
