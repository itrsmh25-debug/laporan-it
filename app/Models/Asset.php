<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_aset',
        'nama_perangkat',
        'merk',
        'spesifikasi',
        'serial_number',
        'ip_address',
        'mac_address',
        'jenis_perangkat_id',
        'kondisi_id',
        'unit_id',
    ];

    // Relasi mengambil data nama Jenis Perangkat
    public function jenisPerangkat(): BelongsTo
    {
        return $this->belongsTo(MasterMapping::class, 'jenis_perangkat_id');
    }

    // Relasi mengambil data nama Kondisi
    public function kondisi(): BelongsTo
    {
        return $this->belongsTo(MasterMapping::class, 'kondisi_id');
    }

    // Relasi mengambil data nama Unit / Ruangan penempatan
    public function unit(): BelongsTo
    {
        return $this->belongsTo(MasterMapping::class, 'unit_id');
    }
}
