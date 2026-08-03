<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permintaan_hak_akses', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nik_penduduk');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('unit');
            $table->string('lulusan');
            $table->string('no_str');
            $table->date('tgl_terbit_str');
            $table->string('no_sip')->nullable();
            $table->date('tgl_terbit_sip')->nullable();
            $table->string('nip')->nullable();
            $table->string('hp_whatsapp');
            $table->text('alamat_ktp');
            $table->string('pendidikan');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_hak_akses');
    }
};
