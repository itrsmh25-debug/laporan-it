<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_mappings', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // Menyimpan tipe: 'unit', 'shift', 'teknisi', 'status_tiket', 'faktor_masalah', 'jenis_perangkat', 'kondisi'
            $table->string('name'); // Menyimpan nilai/opsi parameter
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_mappings');
    }
};
