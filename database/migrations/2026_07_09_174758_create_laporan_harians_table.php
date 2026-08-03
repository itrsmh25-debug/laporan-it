<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_harians', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');

            // Pastikan tipe data sama dengan id di master_mappings (biasanya unsignedBigInteger)
            $table->unsignedBigInteger('shift_id');
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('teknisi_id');
            $table->unsignedBigInteger('faktor_masalah_id');
            $table->unsignedBigInteger('status_tiket_id');
            $table->unsignedBigInteger('teknisi_penerima_id')->nullable();

            $table->text('masalah');
            $table->string('nama_pelapor');
            $table->text('tindak_lanjut')->nullable();
            $table->timestamps();

            // Buat relasi ke master_mappings
            $table->foreign('shift_id')->references('id')->on('master_mappings')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('master_mappings')->onDelete('cascade');
            $table->foreign('teknisi_id')->references('id')->on('master_mappings')->onDelete('cascade');
            $table->foreign('faktor_masalah_id')->references('id')->on('master_mappings')->onDelete('cascade');
            $table->foreign('status_tiket_id')->references('id')->on('master_mappings')->onDelete('cascade');
            $table->foreign('teknisi_penerima_id')->references('id')->on('master_mappings')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
