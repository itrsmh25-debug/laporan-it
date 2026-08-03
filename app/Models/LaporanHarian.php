<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaporanHarian extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'nama_pelapor',
        'masalah',
        'tindak_lanjut',
        'shift_id',
        'unit_id',
        'teknisi_id',
        'status_tiket_id',
        'faktor_masalah_id',
        'teknisi_penerima_id',
    ];

    // Relasi ke MasterMapping untuk mengambil nama Shift
    public function shift(): BelongsTo
    {
        return $this->belongsTo(MasterMapping::class, 'shift_id');
    }

    // Relasi ke MasterMapping untuk mengambil nama Unit
    public function unit(): BelongsTo
    {
        return $this->belongsTo(MasterMapping::class, 'unit_id');
    }

    // Relasi ke MasterMapping untuk mengambil nama Teknisi
    public function teknisi(): BelongsTo
    {
        return $this->belongsTo(MasterMapping::class, 'teknisi_id');
    }

    // Relasi ke MasterMapping untuk mengambil Status Tiket
    public function statusTiket(): BelongsTo
    {
        return $this->belongsTo(MasterMapping::class, 'status_tiket_id');
    }

    // Relasi ke MasterMapping untuk mengambil Faktor Masalah
    public function faktorMasalah(): BelongsTo
    {
        return $this->belongsTo(MasterMapping::class, 'faktor_masalah_id');
    }

    public function teknisiPenerima()
    {
        return $this->belongsTo(MasterMapping::class, 'teknisi_penerima_id');
    }
}
