<?php
// app/Models/LaporanMaintenance.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanMaintenance extends Model
{
    use HasFactory;

    protected $table = 'laporan_maintenance';
    
    protected $fillable = [
        'nama_alat',
        'merk',
        'no_seri',
        'tgl_maintenance',
        'tindakan',
        'hasil',
        'teknisi'
    ];
}