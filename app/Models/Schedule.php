<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'teknisi_id', // Menggantikan user_id
        'date',
        'shift'
    ];

    // Relasi ke MasterMapping untuk mengambil data teknisi
    public function teknisi()
    {
        return $this->belongsTo(MasterMapping::class, 'teknisi_id');
    }
}
