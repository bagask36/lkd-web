<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    
    protected $table = 'maintenance';
    protected $fillable = [
        'nama_alat',
        'merk_alat',
        'tipe_alat',
        'tanggal_kalibrasi',
    ];
    protected $casts = [
        'tanggal_kalibrasi' => 'date',
    ];
}
