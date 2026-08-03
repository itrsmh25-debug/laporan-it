<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanHakAkses extends Model
{
    // Menentukan nama tabel secara eksplisit
    protected $table = 'permintaan_hak_akses';

    // Mass Assignment protection
    protected $fillable = [
        'nama_lengkap',
        'nik_penduduk',
        'tempat_lahir',
        'tanggal_lahir',
        'unit',
        'lulusan',
        'no_str',
        'tgl_terbit_str',
        'no_sip',
        'tgl_terbit_sip',
        'nip',
        'hp_whatsapp',
        'alamat_ktp',
        'pendidikan',
        'email'
    ];

    /**
     * Casts: Mengubah string tanggal menjadi objek Carbon secara otomatis.
     * Ini memudahkan saat menampilkan data di Blade.
     */
    protected $casts = [
        'tanggal_lahir'  => 'date',
        'tgl_terbit_str' => 'date',
        'tgl_terbit_sip' => 'date',
    ];
}
