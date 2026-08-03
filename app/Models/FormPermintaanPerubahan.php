<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormPermintaanPerubahan extends Model
{
    protected $fillable = [
        'nama_pemohon',
        'unit_id',
        'shift_id',
        'nip',
        'nomor_ext',
        'data_pasien',
        'jenis_permintaan_id',
        'uraian_alasan',
        'bukti_dukung',
        // Tambahkan kolom baru di bawah ini agar bisa di-update
        'status',
        'teknisi_id'
    ];

    // Relasi ke MasterMapping untuk jenis permintaan
    public function jenisPermintaan()
    {
        return $this->belongsTo(MasterMapping::class, 'jenis_permintaan_id');
    }

    // Relasi ke MasterMapping untuk teknisi yang mengerjakan
    public function teknisi()
    {
        return $this->belongsTo(MasterMapping::class, 'teknisi_id');
    }

    public function unit()
    {
        return $this->belongsTo(MasterMapping::class, 'unit_id');
    }
}
