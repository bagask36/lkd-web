<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKalibrasiSet extends Model
{
    use HasFactory;

    protected $table = 'laporan_kalibrasi_sets';

    protected $fillable = [
        'laporan_kalibrasi_id',
        'nilai_setting',
        'nilai_pengukuran',
        'rata_rata',
        'standar_deviasi',
        'u_a_value',
        'nilai_koreksi',
    ];

    protected $casts = [
        'nilai_setting' => 'double',
        'nilai_pengukuran' => 'array',
        'rata_rata' => 'double',
        'standar_deviasi' => 'double',
        'u_a_value' => 'double',
        'nilai_koreksi' => 'double',
    ];

    public function laporan()
    {
        return $this->belongsTo(LaporanKalibrasi::class, 'laporan_kalibrasi_id');
    }
}

