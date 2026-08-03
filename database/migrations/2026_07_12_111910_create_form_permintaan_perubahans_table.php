<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_permintaan_perubahans', function (Blueprint $table) {
            $table->id();

            // Informasi Pemohon
            $table->string('nama_pemohon');
            $table->string('bagian_unit');
            $table->string('nip')->nullable();
            $table->string('nomor_ext')->nullable();

            // Data Terkait Pasien (Opsional)
            $table->string('data_pasien')->nullable();

            // Jenis Permintaan (Relasi ke MasterMapping)
            $table->foreignId('jenis_permintaan_id')->constrained('master_mappings');

            // Detail Permintaan
            $table->text('uraian_alasan');

            // File Bukti (Simpan path file)
            $table->string('bukti_dukung')->nullable();

            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->foreignId('teknisi_id')->nullable()->constrained('master_mappings');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_permintaan_perubahans');
    }
};
