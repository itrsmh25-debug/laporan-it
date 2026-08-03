<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKerusakan extends Model
{
    // Tambahkan baris ini
    protected $table = 'laporan_kerusakan';

    // Jangan lupa tambahkan juga fillable agar bisa di-input
    protected $fillable = [
        'asset_id',
        'deskripsi_kerusakan',
        'foto_bukti',
        'rekomendasi',
        'alasan_rekomendasi',
        'estimasi_biaya'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}
