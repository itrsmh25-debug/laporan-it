<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('kode_aset')->unique();      // Contoh: AST-IT-001
            $table->string('nama_perangkat');          // Contoh: PC Server Nuha, Printer Kasir
            $table->string('merk')->nullable();         // Contoh: Epson, HP, Asus
            $table->text('spesifikasi')->nullable();    // Detail spek hardware perangkat
            $table->string('serial_number')->nullable(); // Serial Number perangkat (Opsional)
            $table->string('ip_address')->nullable();    // IP Address perangkat (Opsional)
            $table->string('mac_address')->nullable();   // MAC Address perangkat (Opsional)

            // Foreign Keys ke tabel master_mappings
            $table->foreignId('jenis_perangkat_id')->constrained('master_mappings')->onDelete('restrict');
            $table->foreignId('kondisi_id')->constrained('master_mappings')->onDelete('restrict');
            $table->foreignId('unit_id')->constrained('master_mappings')->onDelete('restrict'); // Lokasi penempatan

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
