<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_downtimes', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_tiket')->unique();

            // Relasi ke master_mappings
            $table->unsignedBigInteger('sistem_layanan_id'); // Kategori Sistem / Layanan (misal: SIMRS, Jaringan, dll)
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai')->nullable();
            $table->integer('durasi_menit')->nullable();

            $table->text('penyebab');
            $table->text('tindakan_perbaikan');

            $table->unsignedBigInteger('status_id'); // Status Downtime (Open, Investigasi, Resolved, Closed)
            $table->string('pelapor');
            $table->unsignedBigInteger('teknisi_id'); // Teknisi Penanggung Jawab

            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Foreign Keys ke master_mappings
            $table->foreign('sistem_layanan_id')->references('id')->on('master_mappings')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('master_mappings')->onDelete('cascade');
            $table->foreign('teknisi_id')->references('id')->on('master_mappings')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_downtimes');
    }
};
