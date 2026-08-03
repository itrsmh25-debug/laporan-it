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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            // Merujuk ke id di tabel master_mappings
            $table->foreignId('teknisi_id')->constrained('master_mappings')->onDelete('cascade');
            $table->date('date');
            $table->string('shift', 5); // P, S, M, MD, L, C
            $table->timestamps();

            $table->unique(['teknisi_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
