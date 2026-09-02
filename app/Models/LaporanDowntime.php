<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanDowntime extends Model
{
    use HasFactory;

    protected $table = 'laporan_downtimes';

    protected $fillable = [
        'nomor_tiket',
        'sistem_layanan_id',
        'teknisi_id',
        'status_id',
        'waktu_mulai',
        'waktu_selesai',
        'durasi_menit',
        'penyebab',
        'tindakan_perbaikan',
        'pelapor', // Pastikan ini ada (sesuaikan dengan nama kolom di database Anda)
        'keterangan',
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    // Definisi Relasi
    public function sistemLayanan()
    {
        return $this->belongsTo(MasterMapping::class, 'sistem_layanan_id');
    }

    public function statusDowntime()
    {
        return $this->belongsTo(MasterMapping::class, 'status_id');
    }

    public function teknisi()
    {
        return $this->belongsTo(MasterMapping::class, 'teknisi_id');
    }
}
